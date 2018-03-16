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

class Chat
{
    public static function chat($room, $msg = "")
    {

    	$url = 'http://ca.iacc.tokyo/api/chat/chat.php';

    	$data = array(
    			"room" => $room,
    			"msg" => $msg
    	);
    	$data = http_build_query($data, "", "&");

    	$header = array(
    			"Content-Type: application/x-www-form-urlencoded",
    			"Content-Length: ".strlen($data)
    	);

    	$context = array(
    			"http" => array(
    					"method"  => "POST",
    					"header"  => implode("\r\n", $header),
    					"content" => $data
    			)
    	);

    	$html = file_get_contents($url, false, stream_context_create($context));
    	return $html;

    }
}
