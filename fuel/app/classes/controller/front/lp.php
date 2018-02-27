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

        if($id == "001")
        {

            $meta = [
                ['name' => 'description', 'content' => \Config::get('enepi.meta.default.description')],
                ['name' => 'keywords', 'content' => \Config::get('enepi.meta.default.keywords')],
                ['name' => 'charset', 'content' => 'utf-8'],
            ];

            $this->template = \View::forge('front/lp/show_001');
            $this->template->meta = $meta;
            $this->template->title = '1番安いガス料金を比較し、お得に乗り換えよう！';

        }

        elseif($id == "002")
        {

            $meta = [
                ['name' => 'description', 'content' => \Config::get('enepi.meta.default.description')],
                ['name' => 'keywords', 'content' => \Config::get('enepi.meta.default.keywords')],
                ['name' => 'charset', 'content' => 'utf-8'],
            ];

            $this->template = \View::forge('front/lp/show_002');
            $this->template->meta = $meta;
            $this->template->title = '大家さん必見！1番安いガス料金を比較し、お得に乗り換えよう！';

        }

        //return Response::forge(View::forge("front/lp/show_{$id}"));

    }


    public function action_slp($id = null)
    {

    	$dom = "http://iacc-cms-prod.s3-website-ap-northeast-1.amazonaws.com/uploads/static_file/file/lp/";
    	$url = "${dom}${id}";

    	$curl = Request::forge($url, 'curl');
    	$result = $curl->execute();
    	$result = str_replace("\"images", "\"${url}/images", $result);
    	$result = str_replace("\"css", "\"${url}/css", $result);
    	$result = str_replace("\"js", "\"${url}/js", $result);

    	print $result;
    	$this->template = \View::forge('front/lp/show_003');
    	//print "!!!";
    	return;


    }
}
