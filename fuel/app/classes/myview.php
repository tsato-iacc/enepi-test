<?

class MyView{


	public static function label_tag(){

	}


	public static function title(){

	}

	public static function description(){

	}

	public static function image_tag($url){

		printf("<img src=\"%s\" />", $url);

	}

	public static function link_to($url, $hash){
/*
		$v_name			= (isset($name)) ? $name : "---";
		$v_class		= (isset($hash["class"])) ? $hash["class"] : "---";
		$v_value		= (isset($hash["value"])) ? $hash["value"] : "";
		$v_onclick		= (isset($hash["onclick"])) ? $hash["onclick"] : "";

		printf(" href=''",
				$tag_type,
				$v_name,
				$v_value,
				$v_class
				);
*/
	}

	public static function form_tag(){

	}

	public static function asset_url($url, $hash = null){

	}




	private static function multi_tag($tag_type, $name, $hash){

	    $v_name        = (isset($name)) ? $name : "---";
	    $v_class       = (isset($hash["class"])) ? $hash["class"] : "---";
	    $v_value       = (isset($hash["value"])) ? $hash["value"] : "";

	    printf("<input type='%s' name='%s' value='%s' class='%s' />",
	        $tag_type,
	        $v_name,
	        $v_value,
	        $v_class
	        );
	}


	public static function submit_tag($name, $hash){
	    Self::multi_tag("submit", $name, $hash);
	}

	public static function text_field($name, $hash){
	    Self::multi_tag("text", $name, $hash);
	}


}



?>