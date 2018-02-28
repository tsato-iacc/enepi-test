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
        $this->template->content = View::forge('admin/companyoffices/index', [
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
        $this->template->content = View::forge('admin/companyoffices/index', [
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
    public function action_prices_index($id, $geocode_id)
    {
        $company = \Model_Company::find($id);
        $geocode = \Model_Company_Geocode::find($geocode_id);

        if (!$company || !$geocode)
            throw new HttpNotFoundException;

        $this->template->title = '料金テーブル';
        $this->template->content = View::forge('admin/companyoffices/prices_index', [
            'company' => $company,
            'geocode' => $geocode,
            'count' => 24 - count($geocode->price_rules),
        ]);
    }

    /**
     * Create or edit price
     *
     * @access  public
     * @return  Response
     */
    public function action_prices_create($id, $geocode_id)
    {
        $company = \Model_Company::find($id);
        $geocode = \Model_Company_Geocode::find($geocode_id);
        $val = Model_PriceRule::validate();

        if (!$company || !$geocode || !$val->run(\Input::get()))
            throw new HttpNotFoundException;

        $price_rule = \Model_PriceRule::find('first', [
            'where' => [
                ['company_geocode_id', $geocode->id],
                ['using_cooking_stove', $val->validated('using_cooking_stove')],
                ['using_bath_heater_with_gas_hot_water_supply', $val->validated('using_bath_heater_with_gas_hot_water_supply')],
                ['using_other_gas_machine', $val->validated('using_other_gas_machine')],
                ['house_kind', $val->validated('house_kind')],
            ],
        ]);

        if (!$price_rule)
            $price_rule = \Model_PriceRule::forge($val->validated());

        $this->template->title = '料金テーブル';
        $this->template->content = View::forge('admin/companyoffices/prices_create', [
            'company' => $company,
            'geocode' => $geocode,
            'price_rule' => $price_rule,
        ]);
    }

    /**
     * Store or update price
     *
     * @access  public
     * @return  Response
     */
    public function action_prices_store($id, $geocode_id)
    {
        $company = \Model_Company::find($id);
        $geocode = \Model_Company_Geocode::find($geocode_id);
        $val = Model_PriceRule::validate('store');

        if (!$company || !$geocode)
            throw new HttpNotFoundException;

        if ($val->run())
        {
            if (count($val->validated('prices')) == 0)
                throw new Exception('Price rule must have one or more related prices');

            $price_rule = \Model_PriceRule::find('first', [
                'where' => [
                    ['company_geocode_id', $geocode->id],
                    ['using_cooking_stove', $val->validated('using_cooking_stove')],
                    ['using_bath_heater_with_gas_hot_water_supply', $val->validated('using_bath_heater_with_gas_hot_water_supply')],
                    ['using_other_gas_machine', $val->validated('using_other_gas_machine')],
                    ['house_kind', $val->validated('house_kind')],
                ],
            ]);

            if (!$price_rule)
                $price_rule = \Model_PriceRule::forge(['company_geocode_id' => $geocode->id]);

            $set = $val->validated();
            unset($set['prices']);
            $price_rule->set($set);
            
            \DB::start_transaction();
            try
            {
                foreach ($price_rule->prices as $price)
                {
                    $price->delete();
                }

                $price_rule->prices = [];
            
                foreach ($val->validated('prices') as $price)
                {
                    if (!$price['upper_limit'])
                        unset($price['upper_limit']);

                    $price_rule->prices[] = new \Model_PriceRule_Price($price);
                }
                
                if ($price_rule->save())
                {
                    \DB::commit_transaction();
                    Session::set_flash('success', "ID: {$id} OK");
                }

                return Response::redirect("admin/companies/{$id}/offices/{$geocode_id}/prices");
            }
            catch (\Exception $e)
            {
                \Log::error($e);
                \DB::rollback_transaction();
            }
        }
        
        Session::set_flash('error', "ID: {$id} FAIL");
        
        return Response::redirect("admin/companies/{$id}/offices/{$geocode_id}/prices");
    }

    /**
     * Delete Office's price
     *
     * @access  public
     * @return  Response
     */
    public function action_prices_destroy($id, $geocode_id, $price_id)
    {
        $company = \Model_Company::find($id);
        $geocode = \Model_Company_Geocode::find($geocode_id);

        if (!$company || !$geocode)
            throw new HttpNotFoundException;

        $price_rule = Model_PriceRule::find('first', ['where' => [['id', $price_id]]]);

        if (!$price_rule)
            throw new HttpNotFoundException;

        \DB::start_transaction();
        try
        {
            $price_rule->delete();
            \DB::commit_transaction();
            Session::set_flash('success', "ID: DELETE OK");

        }
        catch (\Exception $e)
        {
            \Log::error($e);
            \DB::rollback_transaction();
            Session::set_flash('error', "ID: {$id} FAIL");
        }
        
        return Response::redirect("admin/companies/{$id}/offices/{$geocode_id}/prices");
    }

    /**
     * Show list of Office's area
     *
     * @access  public
     * @return  Response
     */
    public function action_area_index($id, $office_id)
    {
        $company = \Model_Company::find($id);
        $geocode = \Model_Company_Geocode::find($office_id);

        if (!$company || !$geocode)
            throw new HttpNotFoundException;

        $conditions = [
            'where' => [
                ['company_geocode_id', $geocode->id]
            ]
        ];

        $total_items = \Model_Company_GeocodeZipCode::count($conditions);

        $pager = \Pagination::forge('zip_codes', [
            'name' => 'bootstrap4',
            'total_items' => $total_items,
            'per_page' => 100,
            'uri_segment' => 'page',
            'num_links' => 20,
        ]);

        $conditions['order_by'] = ['zip_code' => 'asc'];
        $conditions['limit'] = $pager->per_page;
        $conditions['offset'] = $pager->offset;

        $this->template->title = '対応可能市区町村';
        $this->template->content = View::forge('admin/companyoffices/area_index', [
            'id' => $id,
            'office_id' => $office_id,
            'zip_codes' => \Model_Company_GeocodeZipCode::find('all', $conditions),
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
        $company = \Model_Company::find($id);
        $geocode = \Model_Company_Geocode::find($office_id);

        if (!$company || !$geocode)
            throw new HttpNotFoundException;

        $zip_code = \Input::post('zip_code');

        if (!$zip_code)
        {
            Session::set_flash('error', '郵便番号を指定してださい');
            return Response::redirect("admin/companies/{$id}/offices/{$office_id}/area");
        }

        $pattern = '/ \(.*\)/';
        $zip_code = preg_replace($pattern, '', $zip_code);
        $zip_code = str_replace("\r", '', $zip_code);
        $zip_code = trim($zip_code);
        $zip_code = explode("\n", $zip_code);

        $geocode_ids = \Arr::pluck(\Model_Company_Geocode::find('all', ['where' => [['company_id', $company->id]]]), 'id');
        $overlap_zip_codes = \Arr::pluck(\Model_Company_GeocodeZipCode::find('all', ['where' => [['company_geocode_id', 'in', $geocode_ids], ['zip_code', 'in', $zip_code]]]), 'zip_code');
        
        if (count($overlap_zip_codes) > 0)
        {
            foreach ($overlap_zip_codes as $key => $value)
            {
                $k = array_search($value, $zip_code);
                unset($zip_code[$k]);
            }
            
            Session::set_flash('success', '重複した郵便番号の登録はスキップしました');

            if (count($zip_code) == 0)
                return Response::redirect("admin/companies/{$id}/offices/{$office_id}/area");
        }

        if (count($zip_code) > 1100)
        {
            Session::set_flash('success', '一度に登録できる郵便番号は1100件までです');
            return Response::redirect("admin/companies/{$id}/offices/{$office_id}/area");
        }

        foreach ($zip_code as $code)
        {
            $zip = \Model_ZipCode::find('first', ['where' => [['zip_code', $code]]]);
            $record = new \Model_Company_GeocodeZipCode([
                'company_geocode_id' => $geocode->id,
                'zip_code' => $code,
                'notes' => $zip->getAddress(),
            ]);

            $record->save();
        }

        if (count($overlap_zip_codes) == 0)
            Session::set_flash('success', "件保存しました");

        return Response::redirect("admin/companies/{$id}/offices/{$office_id}/area");
    }

    /**
     * Delete Company Office
     *
     * @access  public
     * @return  Response
     */
    public function action_area_destroy($id, $office_id, $zip)
    {
        $company = \Model_Company::find($id);
        $geocode = \Model_Company_Geocode::find($office_id);
        $zip = \Model_Company_GeocodeZipCode::find($zip);

        if (!$company || !$geocode || !$zip)
            throw new HttpNotFoundException;

        $zip->delete();

        Response::redirect("admin/companies/{$id}/offices/{$office_id}/area");
    }
}
