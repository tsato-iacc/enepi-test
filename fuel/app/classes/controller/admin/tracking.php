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
 * The Admin Tracking Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_Tracking extends Controller_Admin
{
    /**
     * Show list of tracking
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/tracking/index', [
            'test' => 'test'
        ]);
    }

    /**
     * Save new tracking
     *
     * @access  public
     * @return  Response
     */
    public function action_store()
    {
        print "CREATE NEW USER";exit;
        Response::redirect('admin/pr_tracking_parameters');
    }

    /**
     * Edit tracking
     *
     * @access  public
     * @return  Response
     */
    public function action_edit($id)
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/tracking/edit', [
            'test' => 'test'
        ]);
    }

    /**
     * Edit tracking
     *
     * @access  public
     * @return  Response
     */
    public function action_update($id)
    {
        print "UPDATE USER";exit;
        Response::redirect('admin/pr_tracking_parameters');
    }

    /**
     * Show statistics
     *
     * @access  public
     * @return  Response
     */
    public function action_statistics()
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/tracking/statistics', [
            'test' => 'test'
        ]);
    }
}
