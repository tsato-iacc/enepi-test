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
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Front
 */
class Controller_Front_Welcome extends Controller_Front
{
    /**
     * The basic welcome message
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $meta = [
            ['name' => 'charset', 'content' => 'utf-8'],
        ];

        $this->template->title = 'プロパンガス(LPガス)の料金・価格比較でガス代を安く！';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/welcome/index', [
            'contact' => new \Model_Contact(),
            'month_selected' => '',
            'slots' => \Model_Slot::getSlots(),
        ]);
    }

    public function action_index2()
    {
    	$meta = [
    			['name' => 'description', 'content' => 'OOooOOppp'],
    			['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
    			['name' => 'puka', 'content' => 'suka'],
    	];

    	$this->template->title = 'TOP';
    	$this->template->meta = $meta;
    	$this->template->content = View::forge('front/welcome/index2', [
    			'test' => 'test'
    	]);
    }

    /**
     * The 404 action for the application.
     *
     * @access  public
     * @return  Response
     */
    public function action_404()
    {
        $this->template->title = 'ページが見つかりませんでした';
        $this->template->content = View::forge('front/welcome/404');
        return Response::forge($this->template, 404);
    }

    public function action_403()
    {
    	$this->template->title = '403 Forbidden';
    	$this->template->content = View::forge('front/welcome/403');
    	return Response::forge($this->template, 403);
    }

    public function action_500()
    {
        $this->template->title = 'ただいま混み合っております';
        $this->template->content = View::forge('front/welcome/500');
        return Response::forge($this->template, 500);
    }
}
