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
    public function action_index($id)
    {
        if (!$company = \Model_Company::find($id, ['related' => ['offices']]))
            throw new HttpNotFoundException;

        $this->template->title = '営業拠点一覧';
        $this->template->content = View::forge('admin/companyOffices/index', [
            'val' => Validation::forge(),
            'company' => $company,
        ]);
    }

    /**
     * Store Company Office
     *
     * @access  public
     * @return  Response
     */
    public function action_store($id)
    {
        if (!$company = \Model_Company::find($id, ['related' => ['offices']]))
            throw new HttpNotFoundException;

        $val = Validation::forge();
        $val->add_field('zip_code', 'zip_code', 'required|valid_string[numeric]');
        $val->add_field('prefecture_code', 'prefecture_code', 'required|numeric_between[1,47]');
        $val->add_field('address', 'address', 'required|max_length[100]');

        if ($val->run())
        {
            $office = new \Model_Company_Office($val->validated());
            $company->offices[] = $office;

            \DB::start_transaction();
            try
            {
                if ($company->save())
                {
                    $company->geocodes[] = new \Model_Company_Geocode([
                        'company_office_id' => $office->id,
                        'address' => $val->validated('address'),
                        'lat' => 0,
                        'lng' => 0,
                    ]);

                    if ($company->save())
                    {
                        \DB::commit_transaction();
                        Session::set_flash('success', 'officeを追加しました');
                        Response::redirect("admin/companies/{$id}/offices");
                    }
                }
            }
            catch (\Exception $e)
            {
                \Log::error($e);
                \DB::rollback_transaction();
            }
        }

        Session::set_flash('error', 'officeを追加できませんでした');

        $this->template->title = '営業拠点一覧';
        $this->template->content = View::forge('admin/companyOffices/index', [
            'val' => $val,
            'company' => $company,
        ]);
    }

    /**
     * Delete Company Office
     *
     * @access  public
     * @return  Response
     */
    public function action_destroy($id, $office_id)
    {
        if (!\Model_Company::find($id))
            throw new HttpNotFoundException;

        if (!$office = \Model_Company_Office::find($office_id))
            throw new HttpNotFoundException;

        \DB::start_transaction();
        try
        {
            $office->delete();
            \DB::commit_transaction();
            Session::set_flash('success', 'officeを削除 OK');
        }
        catch (\Exception $e)
        {
            \Log::error($e);
            \DB::rollback_transaction();
            Session::set_flash('error', 'officeを削除 FAIL');
        }

        Response::redirect("admin/companies/{$id}/offices");
    }

    /**
     * Show list of Office's price
     *
     * @access  public
     * @return  Response
     */
    public function action_price_index($id, $office_id)
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
    public function action_price_destroy($id, $office_id, $price_id)
    {
        print "DELETE Office";exit;
        Response::redirect("admin/companies/{$id}/offices/{$office_id}");
    }

    /**
     * Show list of Office's area
     *
     * @access  public
     * @return  Response
     */
    public function action_area_index($id, $office_id)
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
    public function action_area_store($id, $office_id)
    {
        print "CREATE Office's area";exit;
        Response::redirect("admin/companies/{$id}/offices/{$office_id}");
    }

    /**
     * Delete Company Office
     *
     * @access  public
     * @return  Response
     */
    public function action_area_destroy($id, $office_id, $price_id)
    {
        print "DELETE Office";exit;
        Response::redirect("admin/companies/{$id}/offices");
    }
}
