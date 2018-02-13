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
 * The Admin CompanyFeatures Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_CompanyFeatures extends Controller_Admin
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
        $this->template->content = View::forge('admin/companyFeatures/index', [
            'test' => 'test'
        ]);
    }

    /**
     * Store
     *
     * @access  public
     * @return  Response
     */
    public function action_store()
    {
        print "CREATE NEW CompanyFeatures";exit;
        Response::redirect("admin/company_features");
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
        $this->template->content = View::forge('admin/companyFeatures/edit', [
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
        print "UPDATE CompanyFeatures";exit;
        Response::redirect("admin/company_features/{$id}/edit");
    }

    /**
     * Delete CompanyFeatures
     *
     * @access  public
     * @return  Response
     */
    public function action_destroy($id)
    {
        print "DELETE CompanyFeatures";exit;
        Response::redirect("admin/company_features");
    }
}
