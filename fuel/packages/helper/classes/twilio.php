<?php
/**
 * Helper classes
*
* @package    Helper
* @version    1.0
* @author     Zazimko Alexey
* @license    MIT License
*/

namespace Helper;

use Twilio\Twiml;
use Twilio\Rest\Client;

class Twilio
{
    public static function sms($to, $msg = "")
    {
        $client = self::getClient();

        if (self::isNumberValid($to))
        {
            $client->messages->create($to, [
                    'from' => \Config::get('enepi.twilio.from'),
                    'body' => $msg
                ]
            );
        }
        // Invalid phone number
        else
        {
            // Do somthing
        }
    }

    public static function notifyCustomerPin(&$contact)
    {
        $to = $contact->tel;
        $body = "認証コード：{$contact->pin}\nこのコードをenepi本人確認画面で入力してください。";;

        if (self::isNumberValid($to))
        {
            if (\Fuel::$env == \Fuel::DEVELOPMENT)
            {
                $email = \Email::forge();
                $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
                $email->subject('SMS');
                $email->html_body("TO:{$contact->tel} {$body}");
                $email->send();
            }
            else
            {
                try
                {
                    $client = self::getClient();
                    
                    $client->messages->create($to, [
                            'from' => \Config::get('enepi.twilio.from'),
                            'body' => $body
                        ]
                    );
                }
                catch (RestException $e)
                {
                    $body = $e->getMessage();
                    \Log::error($e);
                }
            }
        }
        // Invalid phone number
        else
        {
            $body = 'Invalid phone number';
        }

        $record = new \Model_Twilio([
          'lpgas_contact_id' => $contact->id,
          'cannonical_to' => $to,
          'to' => $contact->tel,
          'from' => \Config::get('enepi.twilio.from'),
          'body' => $body,
          'result' => $body,
        ]);
  }

    public static function say_pin($to)
    {
        $to = "08057814850";

        $client = self::getClient();
        if (self::isNumberValid($to))
        {
            $call = $client->calls->create($to, $from,['url' => 'http://demo.twilio.com/docs/voice.xml']);

        }

        
        echo "Call status: " . $call->status . "<br />";
        echo "URI resource: " . $call->uri . "<br />";

        var_dump($call);

        //print $sid;

    }

    private static function getClient()
    {
        return new Client(\Config::get('enepi.twilio.sid'), \Config::get('enepi.twilio.token'));
    }

    // 080-1234-5678 → 818012345678
    private static function isNumberValid(&$to)
    {
        $to = str_replace("-", "", $to);
        $to = "+81".substr($to, 1);

        if (strlen($to) != 13)
        {
            \Log::warning('Invalid phone number');
            return false;
        }
    }
}
