<?

use JpPrefecture\Config;
use JpPrefecture\Prefecture;

class MyView{


	public static function admin_partner_company_emails_path(){

	}

	public static function edit_admin_partner_company_path(){
	}


	public static function admin_user_path(){

	}

	public static function format_datetime(){

		return "2017/12/25 10:00";

	}


    public static function label_tag(){

    }


    public static function title(){

    }

    public static function description(){

    }


    public static function image_tag_s3($key, $hash = null){

    	$bucket = "enepi";

    	$s3 = new Aws\S3\S3Client(array(

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



    public static function image_tag($url, $hash = null){

        if(!is_null($hash)){
            if(is_array($hash)){

                $v = "";
                $attr = "";

                foreach($hash as $k => $v){
                    $attr .= "{$k}=\"${v}\"";
                }

                printf("<img src=\"/assets/images/%s\" %s />", $url, $attr);

            }
        }else{
            printf("<img src=\"/assets/images/%s\" />", $url);
        }
    }

    /*
     * 【local_contents(地域別ガス料金検索ページ)の都道府県名】
     * 元々link_toメソッドを呼んでいたが重複するため新規に作成
     * 必要があればlink_toメソッドと統一したほうがよい？
     */
    public static function link_to_local_contents($name, $url, $hash){

        $v_name        = (isset($name)) ? $name : "---";
        $v_url         = (isset($url)) ? $url : "---";
        $v_style       = (isset($hash["style"])) ? $hash["style"] : "";

        printf("<a style=\"%s;\" href=\"%s\">%s</a>",
            $v_style,
            $v_url,
            $v_name
            );
    }


    public static function link_to_admin($name, $url, $hash = []){

    	$v_name        = (isset($name)) ? $name : "---";
    	$v_url         = (isset($url)) ? $url : "---";
    	$v_style       = (isset($hash["style"])) ? $hash["style"] : "";

    	printf("<a style=\"%s;\" href=\"%s\">%s</a>",
    			$v_style,
    			$v_url,
    			$v_name
    			);
    }


    public static function link_to($url, $hash){

    	if(is_array($hash)){

         	$v = "";
         	$attr = "";

         	foreach($hash as $k => $v){
         		$attr .= "{$k}=\"${v}\"";
         	}

         	return " href=\"${url}\" ${attr}";

         }

         return "<a href=\"${hash}\">${url}</a>";

    }

    public static function form_tag(){

    }

    public static function asset_url($url, $hash = null){
    	return $url;
    }

    public static function null_check($value = ''){
        return $value;
    }





    private static function multi_tag($tag_type, $name, $hash){

        $v_name        = (isset($name)) ? $name : "---";
        $attr = "";

        if(is_array($hash)){

            $v = "";

            foreach($hash as $k => $v){
                $attr .= "{$k}=\"${v}\"";
            }

        }

        printf("<input type='%s' name='%s'" .$attr. " />",
            $tag_type,
            $v_name
            );
    }


    public static function submit_tag($name, $hash){
        self::multi_tag("submit", $name, $hash);
    }

    public static function text_field($name, $hash){
        self::multi_tag("text", $name, $hash);
    }

    public static function checkbox_tag($name, $hash){
        self::multi_tag("checkbox", $name, $hash);
    }

    public static function create($uri){
        //Uri::uri_create($uri);
        print $uri;
    }

}



?>