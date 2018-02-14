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
	public static function mail_send($e)
	{

		$client = \Aws\Ses\SesClient::factory(array(
				'version'=> 'latest',
				'region' => "us-east-1",

    			// 環境変数にしないと
    			'credentials' => [
    				'key'    => 'AKIAI2NFTZUSEGDK5E4Q',
    				'secret' => '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'
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

}
