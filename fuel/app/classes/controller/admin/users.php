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
 * The Admin Users Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_Users extends Controller_Admin
{
    /**
     * Show list of users
     *
     * @access  public
     * @return  Response
     */
    public function get_index()
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/users/index', [
            'test' => 'test'
        ]);
    }

    /**
     * Create new user
     *
     * @access  public
     * @return  Response
     */
    public function get_create()
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/users/create', [
            'test' => 'test'
        ]);
    }



    public function get_new()
    {
    	$this->template->title = 'local_contents';
    	$this->template->content = View::forge('admin/users/create', [
    			'test' => 'test'
    	]);
    }



    /**
     * Save new user
     *
     * @access  public
     * @return  Response
     */
    public function post_store()
    {
        print "CREATE NEW USER";exit;
        Response::redirect('admin/users');
    }
}
