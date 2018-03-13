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

use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;

class Twilio
{
    public static function sms($to, $msg = "")
    {
        $client = self::getClient();

        if (self::isNumberValid($to))
        {
            $result = $client->messages->create($to, [
                    'from' => \Config::get('enepi.twilio.from'),
                    'body' => $msg,
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
        $body = "認証コード：{$contact->pin}\nこのコードをenepi本人確認画面で入力してください。";
        $result = 1;
        $sid = null;

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
                    
                    $response = $client->messages->create($to, [
                            'from' => \Config::get('enepi.twilio.from'),
                            'body' => $body
                        ]
                    );

                    if ($response->status == 'queued' && $response->sid)
                    {
                        $sid = $response->sid;
                    }
                    else
                    {
                        throw new RestException("Failed to send sms to {$to}", 1, 1);
                    }
                }
                catch (RestException $e)
                {
                    $body = $e->getMessage();
                    $result = 0;
                    \Log::error($e);
                }
            }
        }
        // Invalid phone number
        else
        {
            $body = 'Invalid phone number';
            $result = 0;
        }

        $record = new \Model_Twilio([
            'lpgas_contact_id' => $contact->id,
            'cannonical_to' => $to,
            'to' => $contact->tel,
            'from' => \Config::get('enepi.twilio.from'),
            'body' => $body,
            'result' => $result,
            'sid' => $sid,
        ]);

        $record->save();
  }

    public static function notifyCustomerPinByVoice(&$contact)
    {   
        $to = $contact->tel;
        $body = '';
        $result = 1;
        $sid = null;

        if (self::isNumberValid($to))
        {
            if (\Fuel::$env == \Fuel::DEVELOPMENT)
            {
                $email = \Email::forge();
                $email->to(\Config::get('enepi.service.email'), \Config::get('enepi.service.name'));
                $email->subject('Voice call');
                $email->html_body("TO:{$contact->tel} {$body}");
                $email->send();
            }
            else
            {
                try
                {
                    $client = self::getClient();

                    $response = $client->calls->create($to, \Config::get('enepi.twilio.from'), [
                        'url' => \Config::get('enepi.twilio.say_pin_url')
                    ]);

                    if ($response->status == 'queued' && $response->sid)
                    {
                        $sid = $response->sid;
                    }
                    else
                    {
                        throw new RestException("Failed to call to {$to}", 1, 1);
                    }
                }
                catch (RestException $e)
                {
                    $body = $e->getMessage();
                    $result = 0;
                    \Log::error($e);
                }
            }
        }
        // Invalid phone number
        else
        {
            $body = 'Invalid phone number';
            $result = 0;
        }

        $record = new \Model_Twilio([
            'lpgas_contact_id' => $contact->id,
            'cannonical_to' => $to,
            'to' => $contact->tel,
            'from' => \Config::get('enepi.twilio.from'),
            'body' => $body,
            'result' => $result,
            'sid' => $sid,
        ]);

        $record->save();
    }

    /**
     * Private methods
     */
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

        return true;
    }
}
