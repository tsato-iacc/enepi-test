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
class Controller_Front_Lpgas extends Controller_Front
{
    /**
     * Lpgas controller
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/lpgas/index', [
            'test' => 'test'
        ]);
    }

    /**
     * Lpgas controller
     *
     * @access  public
     * @return  Response
     */
    public function action_supportMap()
    {
        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/lpgas/supportMap', [
            'test' => 'test'
        ]);
    }

    /**
     * Lpgas controller
     *
     * @access  public
     * @return  Response
     */
    public function action_agreement()
    {
        $this->template = \View::forge('front/template_agreement');

        $meta = [
            ['name' => 'description', 'content' => 'OOooOOppp'],
            ['name' => 'keywords', 'content' => 'KKkkkKKkkk'],
            ['name' => 'puka', 'content' => 'suka'],
        ];

        $this->template->title = 'local_contents';
        $this->template->meta = $meta;
        $this->template->content = View::forge('front/lpgas/agreement', [
            'test' => 'test'
        ]);
    }
}
