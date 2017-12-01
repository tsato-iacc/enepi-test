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
 * The Admin LpgasCompanies Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_Companies extends Controller_Admin
{
    /**
     * Show list
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/companies/index', [
            'test' => 'test'
        ]);
    }

    /**
     * Edit
     *
     * @access  public
     * @return  Response
     */
    public function action_edit($id)
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/companies/edit', [
            'test' => 'test'
        ]);
    }

    /**
     * Update
     *
     * @access  public
     * @return  Response
     */
    public function action_update($id)
    {
        print "UPDATE COMPANY";exit;
        Response::redirect("admin/companies/{$id}/edit");
    }

    /**
     * Show list of estimates
     *
     * @access  public
     * @return  Response
     */
    public function action_estimates_index($id)
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/companies/estimates_index', [
            'test' => 'test'
        ]);
    }

    /**
     * Show list of NG Companies
     *
     * @access  public
     * @return  Response
     */
    public function action_ng_index($id)
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/companies/ng_index', [
            'test' => 'test'
        ]);
    }

    /**
     * Store NG Company
     *
     * @access  public
     * @return  Response
     */
    public function action_ng_store($id)
    {
        print "CREATE NG";exit;
        Response::redirect("admin/companies/{$id}/ng");
    }

    /**
     * Delete NG Company
     *
     * @access  public
     * @return  Response
     */
    public function action_ng_destroy($id, $ng_id)
    {
        print "DELETE NG";exit;
        Response::redirect("admin/companies/{$id}/ng");
    }
}
