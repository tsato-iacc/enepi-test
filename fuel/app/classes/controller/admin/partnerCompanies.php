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
 * The Admin PartnerCompanies Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_PartnerCompanies extends Controller_Admin
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
        $this->template->content = View::forge('admin/partnerCompanies/index', [
            'test' => 'test'
        ]);
    }

    /**
     * Create
     *
     * @access  public
     * @return  Response
     */
    public function action_create()
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/partnerCompanies/create', [
            'test' => 'test'
        ]);
    }

    public function action_new()
    {
    	$this->template->title = 'local_contents';
    	$this->template->content = View::forge('admin/partnerCompanies/create', [
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
        print "CREATE NEW COMPANY";exit;
        Response::redirect('admin/partner_companies');
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
        $this->template->content = View::forge('admin/partnerCompanies/edit', [
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
        Response::redirect('admin/partner_companies');
    }

    /**
     * Show list of emails
     *
     * @access  public
     * @return  Response
     */
    public function action_emails_index($id)
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/partnerCompanies/emails_index', [
            'test' => 'test'
        ]);
    }

    /**
     * Store email
     *
     * @access  public
     * @return  Response
     */
    public function action_emails_store($id)
    {
        print "CREATE NEW EMAIL";exit;
        Response::redirect("admin/partner_companies/{$id}/emails");
    }

    /**
     * Delete email
     *
     * @access  public
     * @return  Response
     */
    public function action_emails_destroy($id, $email_id)
    {
        print "DELETE EMAIL";exit;
        Response::redirect("admin/partner_companies/{$id}/emails");
    }
}
