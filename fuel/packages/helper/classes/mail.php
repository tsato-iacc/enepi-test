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

class Mail
{

	public static function mail_send($from, $to, $subject, $body)
	{


		$client = \Aws\Ses\SesClient::factory(array(

			'credentials' => [
				'key'    => getenv("AWS_ACCESS_KEY_ID"),
				'secret' => getenv("AWS_SECRET_ACCESS_KEY"),
			],

			'version'=> "latest",
			'region' => "us-east-1"
		));


		$request = array();
		$request['Source'] = $from;
		$request['Destination']['ToAddresses'] = array($to);
		$request['Message']['Subject']['Data'] = $subject;
		$request['Message']['Body']['Text']['Data'] = $body;

		try {
			$result = $client->sendEmail($request);
			$messageId = $result->get('MessageId');
			//echo("Email sent! Message ID: $messageId"."\n");

		} catch (Exception $e) {
			//echo("The email was not sent. Error message: ");
			//echo($e->getMessage()."\n");
		}

	}



	public static function sms_send($to, $msg = "")
	{

		$client = new \Twilio\Rest\Client(
							getenv("TWILLIO_ACCOUNT_SID"),
							getenv("TWILLIO_AUTH_TOKEN")
						);

		// 080-1234-5678 → 818012345678
		$to = str_replace("-", "", $to);
		$to = "+81".substr($to, 1);
		if(strlen($to) != 13){
			return;
		}

		$client->messages->create(
				$to,
				array(
					'from' => getenv("TWILLIO_SMS_FROM"),
					'body' => $msg
				)
		);


	}

}
