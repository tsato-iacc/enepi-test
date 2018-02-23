<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Helper;

use Aws\Ses\SesClient;
use Aws\Ses\Exception\SesException;

class Email_Driver_Ses extends \Email_Driver
{
  /**
   * SES send
   *
   * @return  bool    Success boolean.
   */
  protected function _send()
  {
    $client = SesClient::factory([

				// 無理やり既存使う
                                'credentials' => [
                                        'key'    => "AKIAI2NFTZUSEGDK5E4Q",
                                        'secret' => "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",
                                ],
      'version'=> "latest",
      'region' => "us-east-1"
    ]);

    $request = [];
    $request['Source'] = $this->build_from();
    $request['Destination']['ToAddresses'] = $this->build_to();
    $request['Message']['Subject']['Data'] = $this->subject;
    $request['Message']['Subject']['Charset'] = 'UTF-8';
    $request['Message']['Body']['Html']['Data'] = base64_decode($this->body);
    $request['Message']['Body']['Charset']['Data'] = 'UTF-8';

    try
    {
      $result = $client->sendEmail($request);
      $messageId = $result->get('MessageId');
    }
    catch (SesException $e)
    {
      \Log::error($e);

      return false;
    }

    return true;
  }

  /**
   * Build from
   *
   * @return array
   */
  protected function build_from()
  {
    return $this->config['from']['email'];
    // return "エネピ <{$this->config['from']['email']}>";
  }

  /**
   * Build recipient list
   *
   * @return array
   */
  protected function build_to()
  {
    $rcpt = [];

    foreach ($this->to as $key => $value)
    {
      if ($value['name'])
      {
        $rcpt[] = "{$value['name']} <{$value['email']}>";
      }
      else
      {
        $rcpt[] = "{$value['email']}";
      }
    }

    return $rcpt;
  }
}
