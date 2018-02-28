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
	public static function makeImageUrl(&$company, $logo = true)
	{

		$fmt = "%s/uploads/partner_companies/%s/lpgas/companies/%s/%s";

		return sprintf($fmt,
				getenv("FUEL_ENV"),   // development/staging/production
				$company->partner_company_id,
				$company->id,
				$logo ? $company->lpgas_company_logo : $company->lpgas_company_image);

	}



	public static function image_tag_s3($key, $hash = null){

		$bucket = getenv("S3_BUCKET");

		$s3 = new \Aws\S3\S3Client(array(

				'version' => 'latest',
				'region'  => "ap-northeast-1",

				'credentials' => [
					'key'    => getenv("AWS_ACCESS_KEY_ID"),
					'secret' => getenv("AWS_SECRET_ACCESS_KEY"),
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

	public static function put_image($file, $key, $type)
	{
		$bucket = getenv("S3_BUCKET");

		$s3 = new \Aws\S3\S3Client(array(

				'version' => 'latest',
				'region'  => "ap-northeast-1",

				'credentials' => [
					'key'    => getenv("AWS_ACCESS_KEY_ID"),
					'secret' => getenv("AWS_SECRET_ACCESS_KEY"),
				],
		));

		$result = $s3->putObject([
        'Bucket'       => $bucket,
        'Key'          => $key,
        'SourceFile'   => $file,
        'ContentType'  => $type,
        'CacheControl' => 'max-age=2678400',
    ]);
	}

}
