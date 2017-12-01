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
 * The Admin CompanyOffices Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_CompanyOffices extends Controller_Admin
{
    /**
     * Show list of Company's Offices
     *
     * @access  public
     * @return  Response
     */
    public function action_index($company_id)
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/companyOffices/index', [
            'test' => 'test'
        ]);
    }

    /**
     * Store Company Office
     *
     * @access  public
     * @return  Response
     */
    public function action_store($company_id)
    {
        print "CREATE Office";exit;
        Response::redirect("admin/companies/{$company_id}/offices");
    }

    /**
     * Delete Company Office
     *
     * @access  public
     * @return  Response
     */
    public function action_destroy($company_id, $office_id)
    {
        print "DELETE Office";exit;
        Response::redirect("admin/companies/{$company_id}/offices");
    }

    /**
     * Show list of Office's price
     *
     * @access  public
     * @return  Response
     */
    public function action_price_index($company_id, $office_id)
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/companyOffices/price_index', [
            'test' => 'test'
        ]);
    }

    /**
     * Delete Office's price
     *
     * @access  public
     * @return  Response
     */
    public function action_price_destroy($company_id, $office_id, $price_id)
    {
        print "DELETE Office";exit;
        Response::redirect("admin/companies/{$company_id}/offices/{$office_id}");
    }

    /**
     * Show list of Office's area
     *
     * @access  public
     * @return  Response
     */
    public function action_area_index($company_id, $office_id)
    {
        $this->template->title = 'local_contents';
        $this->template->content = View::forge('admin/companyOffices/area_index', [
            'test' => 'test'
        ]);
    }

    /**
     * Store Office's area
     *
     * @access  public
     * @return  Response
     */
    public function action_area_store($company_id, $office_id)
    {
        print "CREATE Office's area";exit;
        Response::redirect("admin/companies/{$company_id}/offices/{$office_id}");
    }

    /**
     * Delete Company Office
     *
     * @access  public
     * @return  Response
     */
    public function action_area_destroy($company_id, $office_id, $price_id)
    {
        print "DELETE Office";exit;
        Response::redirect("admin/companies/{$id}/offices");
    }
}
