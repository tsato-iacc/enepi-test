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


class S3
{
	public static function makeImageUrl($e)
	{

		$fmt = "%s/uploads/partner_companies/%s/lpgas/companies/%s/%s";

		return sprintf($fmt,
				getenv("FUEL_ENV"),   // develpoer/staging/production
				$e->company->partner_company_id,
				$e->company->id,
				$e->company->lpgas_company_logo);

	}



	public static function image_tag_s3($key, $hash = null){

		$bucket = "enepi";

		$s3 = new \Aws\S3\S3Client(array(

				'version' => 'latest',
				'region'  => "ap-northeast-1",

				// 環境変数にしないと
				'credentials' => [
						'key'    => 'AKIAI2NFTZUSEGDK5E4Q',
						'secret' => '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'
				],
		));

		$command = $s3->getCommand('GetObject', [
				'Bucket' => $bucket,
				'Key'    => $key,
		]);

		$request = $s3->createPresignedRequest($command, '+20 minutes');
		$url = (string)$request->getUri();


		if(!is_null($hash)){
			if(is_array($hash)){

				$v = "";
				$attr = "";

				foreach($hash as $k => $v){
					$attr .= "{$k}=\"${v}\"";
				}

				printf("<img src=\"%s\" %s />", $url, $attr);

			}
		}else{
			printf("<img src=\"%s\" />", $url);
		}
	}


}
