<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Landing Page Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Front
 */
class Controller_Front_Lp extends Controller_Front
{
    /**
     * Show list of articles
     *
     * @access  public
     * @return  Response
     */
    public function action_index($id = null)
    {
        if ($id == "001")
        {
            $this->template = \View::forge('front/lp/show_001');
            $this->template->title = '1番安いガス料金を比較し、お得に乗り換えよう！';

            return;
        }

        elseif ($id == "002")
        {
            $this->template = \View::forge('front/lp/show_002');
            $this->template->title = '大家さん必見！1番安いガス料金を比較し、お得に乗り換えよう！';

            return;
        }

        elseif ($id == '004' || $id == '005')
        {
            $this->template = \View::forge('front/lp/show_004');
            $this->template->lp_005 = ($id == '005');
            
            return;
        }

        elseif ($id == 'form')
        {
            $this->template = \View::forge('front/lp/form');
            $this->template->title = '1番安いガス料金を比較し、お得に乗り換えよう！';

            return;
        }

        throw new HttpNotFoundException;
    }

    public function action_slp($id = null)
    {
    	$o_uri = explode("?", $_SERVER['REQUEST_URI'])[0];
    	$uri = str_replace("/s/", "", $_SERVER['REQUEST_URI']);

    	$dom = "http://iacc-cms-prod.s3-website-ap-northeast-1.amazonaws.com/uploads/static_file/file/${uri}";
    	$url = "${dom}";

    	$curl	= Request::forge($url, 'curl');
    	$result = $curl->execute();
    	$ct		= $curl->response_info("content_type");

    	if($ct == "text/html"){

    		$result = str_replace("\"images", "\"${o_uri}/images", $result);
    		$result = str_replace("\"css", "\"${o_uri}/css", $result);
    		$result = str_replace("\"js", "\"${o_uri}/js", $result);

    	}

    	$this->template = \Response::forge($result, 200, array('Content-Type' => $ct));
    	return;

    }
}
