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
	public static function mail_send_o($e)
	{

		$client = \Aws\Ses\SesClient::factory(array(
				'version'=> 'latest',
				'region' => "us-east-1",
				'key'    => 'AKIAI2NFTZUSEGDK5E4Q',
				'secret' => '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',


    			// 環境変数にしないと
    			'credentials' => [
    				'key'    => 'AKIAI2NFTZUSEGDK5E4Q',
    				'secret' => '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',
    			],
		));

		try {
			$result = $client->sendEmail([
					'Destination' => [
							'ToAddresses' => [
									"dfukushi@iacc.co.jp",
							],
					],
					'Message' => [
							'Body' => [
									'Html' => [
											'Charset' => "UTF-8",
											'Data' => "ああああああ",
									],
									'Text' => [
											'Charset' => "UTF-8",
											'Data' => "あああああ",
									],
							],
							'Subject' => [
									'Charset' => "UTF-8",
									'Data' => "タイトル",
							],
					],
					'Source' => "info@enepi.jp",
					// If you are not using a configuration set, comment or delete the
					// following line
					'ConfigurationSetName' => "ConfigSet",
			]);
			$messageId = $result->get('MessageId');
			echo("Email sent! Message ID: $messageId"."\n");

		} catch (SesException $error) {
			echo("The email was not sent. Error message: ".$error->getAwsErrorMessage()."\n");
		}
	}


	public static function mail_send($e)
	{

		define('REGION','us-east-1');


		$client = \Aws\Ses\SesClient::factory(array(

				'credentials' => [
						'key'    => 'AKIAI2NFTZUSEGDK5E4Q',
						'secret' => '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',
				],

				'version'=> 'latest',
				'region' => REGION
		));


		$request = array();
		$request['Source'] = "info@enepi.jp";
		$request['Destination']['ToAddresses'] = array("dfukushi@iacc.co.jp");
		$request['Message']['Subject']['Data'] = "サブジェクト";
		$request['Message']['Body']['Text']['Data'] = "ボディ";

		try {
			$result = $client->sendEmail($request);
			$messageId = $result->get('MessageId');
			//echo("Email sent! Message ID: $messageId"."\n");

		} catch (Exception $e) {
			//echo("The email was not sent. Error message: ");
			//echo($e->getMessage()."\n");
		}

	}

}
