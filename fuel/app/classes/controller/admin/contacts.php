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
 * The Admin LpgasCallings Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller_Admin
 */
class Controller_Admin_Contacts extends Controller_Admin
{
    /**
     * Show list
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        $val = Validation::forge();

        // UPGRADE ME, Use group by than where in
        $conditions = [
            'where' => [],
            'related' => [
                'estimates' => [
                    'where' => [],
                ],
                'calling_histories',
                'tracking',
            ],
        ];

        $related_where = $this->updateConditions($conditions);
        $total_items = \Model_Contact::count($conditions);

        $pager = \Pagination::forge('contacts', [
            'name' => 'bootstrap4',
            'total_items' => $total_items,
            'per_page' => 50,
            'uri_segment' => 'page',
            'num_links' => 20,
        ]);

        $conditions['order_by'] = ['id' => 'desc'];
        
        if ($related_where)
        {
            $conditions['rows_limit'] = $pager->per_page;
            $conditions['rows_offset'] = $pager->offset;
        }
        else
        {
            $conditions['limit'] = $pager->per_page;
            $conditions['offset'] = $pager->offset;
        }

        $contacts = \Model_Contact::find('all', $conditions);

        $this->template->title = 'contacts';
        $this->template->content = View::forge('admin/contacts/index', [
            'val' => $val,
            'contacts' => $contacts,
            'total_items' => $total_items,
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
        if (!$contact = \Model_Contact::find($id, ['related' => ['calling_histories' => ['order_by' => ['id' => 'desc']]]]))
            throw new HttpNotFoundException;

        $this->template->title = 'Contact edit';
        $this->template->content = View::forge('admin/contacts/edit', [
            'contact' => $contact,
            'val' => Validation::forge(),
            'val_c' => Validation::forge('calling'),
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
        if (!$contact = \Model_Contact::find($id, ['related' => ['calling_histories' => ['order_by' => ['id' => 'desc']]]]))
            throw new HttpNotFoundException;

        $val = \Model_Contact::admin_validate();

        if ($val->run())
        {
            $contact->set($val->validated());

            $contact->house_kind = \Config::get('models.contact.house_kind.'.$val->validated('house_kind'));
            $contact->ownership_kind = \Config::get('models.contact.ownership_kind.'.$val->validated('ownership_kind'));
            $contact->user_status = \Config::get('models.contact.user_status.'.$val->validated('user_status'));
            $contact->house_age = $val->validated('house_age') ? $val->validated('house_age') : null;
            $contact->number_of_active_rooms = $val->validated('number_of_active_rooms') ? $val->validated('number_of_active_rooms') : null;

            $contact->using_cooking_stove = $val->validated('using_cooking_stove') ? 1 : 0;
            $contact->using_bath_heater_with_gas_hot_water_supply = $val->validated('using_bath_heater_with_gas_hot_water_supply') ? 1 : 0;
            $contact->using_other_gas_machine = $val->validated('using_other_gas_machine') ? 1 : 0;
            
            if ($contact->save())
            {
                Session::set_flash('success', 'OK');
                Response::redirect("admin/contacts/{$id}/edit");
            }
        }

        Session::set_flash('error', 'FAIL');

        $this->template->title = 'Contact edit';
        $this->template->content = View::forge('admin/contacts/edit', [
            'contact' => $contact,
            'val' => $val,
            'val_c' => Validation::forge('calling'),
        ]);
    }

    /**
     * Show list
     *
     * @access  public
     * @return  Response
     */
    public function action_estimate_index($id)
    {
        if (!$contact = \Model_Contact::find($id, ['related' => ['estimates' => ['related' => ['company']]]]))
            throw new HttpNotFoundException;

        $this->template->title = 'Estimates';
        $this->template->content = View::forge('admin/contacts/estimates_index', [
            'estimates' => $contact->estimates,
            'id' => $id,
        ]);
    }

    /**
     * Create
     *
     * @access  public
     * @return  Response
     */
    public function action_estimate_create($id)
    {
        if (!$contact = \Model_Contact::find($id, ['related' => ['estimates' => ['related' => ['company']]]]))
            throw new HttpNotFoundException;
        
        $new_estimates = $this->getNewEstimates($contact);

        $this->template->title = 'New estimate';
        $this->template->content = View::forge('admin/contacts/estimate_create', [
            'contact' => $contact,
            'new_estimates' => $new_estimates,
            'val' => Validation::forge(),
        ]);
    }

    /**
     * Create
     *
     * @access  public
     * @return  Response
     */
    public function action_estimate_store($id)
    {
        if (!$contact = \Model_Contact::find($id, ['related' => ['estimates' => ['related' => ['company']]]]))
            throw new HttpNotFoundException;

        $val = Validation::forge();

        foreach (\Input::post('estimates', []) as $key => $v)
        {
            $val->add_field("estimates.{$key}.company_id", 'company_id', 'valid_string[numeric]');
            $val->add_field("estimates.{$key}.status", 'status', 'match_value[1]');
            $val->add_field("estimates.{$key}.contracted_commission", 'contracted_commission', "required_with[estimates.{$key}.company_id]|valid_string[numeric]");
        }

        if ($val->run() && array_filter(\Arr::pluck($val->validated('estimates'), 'company_id')))
        {
            foreach ($val->validated('estimates') as $estimate)
            {
                if (!$estimate['company_id'])
                    continue;

                $new_estimate = new \Model_Estimate([
                    'company_id' => $estimate['company_id'],
                    'contact_id' => $contact->id,
                    'contracted_commission' => $estimate['contracted_commission'],
                ]);

                $new_estimate->setCompanyPriceRule($contact);

                if ($new_estimate->save())
                {
                    $new_estimate->present($this->auth_user->id, !$estimate['status']);
                }
            }

            Session::set_flash('success', 'OK');
            return Response::redirect("admin/contacts/{$id}/estimates/create");
        }

        Session::set_flash('error', 'FAIL');

        $new_estimates = $this->getNewEstimates($contact);

        $this->template->title = 'New estimate';
        $this->template->content = View::forge('admin/contacts/estimate_create', [
            'contact' => $contact,
            'new_estimates' => $new_estimates,
            'val' => $val,
        ]);
    }

    /**
     * Cancel
     *
     * @access  public
     * @return  Response
     */
    public function action_cancel($id)
    {
        if (!$contact = \Model_Contact::find($id))
            throw new HttpNotFoundException;

        if ($reason = \Input::post('status_reason'))
        {
            $contact->cancel($this->auth_user, $reason);
            Session::set_flash('success', 'cancel');
        }
        else
        {
            Session::set_flash('error', 'cancelできませんでした');
        }

        Response::redirect('admin/contacts');
    }

    /**
     * Delete information about contact
     *
     * @access  public
     * @return  Response
     */
    public function action_destroy($id)
    {
        if (!$contact = \Model_Contact::find($id))
            throw new HttpNotFoundException;

        $contact->cancel($this->auth_user, 'status_reason_unknown');
        
        $contact->name ="削除済み";
        $contact->furigana ="さくじょずみ";
        $contact->zip_code ="000-0000";
        $contact->address ="削除済み";
        $contact->address2 ="削除済み";
        $contact->email ="info+deleted@enepi.jp";
        $contact->tel ="000-0000-0000";
        $contact->new_address = "さくじょずみ";
        $contact->new_address2 = "さくじょずみ";
        $contact->new_zip_code = "000-0000";
        $contact->deleted_at = \Date::forge(time())->format('mysql_date_time');
        
        
        if ($contact->save())
        {
            Session::set_flash('success', 'OK');
        }
        else
        {
            Session::set_flash('error', 'FAIL');
        }

        Response::redirect("admin/contacts/{$id}/edit");
    }

    /**
     * Private methods
     */
    private function updateConditions(&$conditions)
    {
        $related_where = false;

        // Where name equal
        if ($name_equal = \Input::get('name_equal'))
            $conditions['where'][] = ['name', $name_equal];
            
        // Where name like
        if ($name_like = \Input::get('name_like'))
            $conditions['where'][] = ['name', 'LIKE', "%{$name_like}%"];

        // Where tel equal
        if ($tel_equal = \Input::get('tel_equal'))
            $conditions['where'][] = ['tel', $tel_equal];

        // Where email equal
        if ($email_equal = \Input::get('email_equal'))
            $conditions['where'][] = ['email', $email_equal];

        // Where house kind equal
        if ($house_kind = \Input::get('house_kind'))
            $conditions['where'][] = ['house_kind', \Config::get('models.contact.house_kind.'.$house_kind)];

        // Where ownership kind equal
        if ($ownership_kind = \Input::get('ownership_kind'))
            $conditions['where'][] = ['ownership_kind', \Config::get('models.contact.ownership_kind.'.$ownership_kind)];

        // Where new_prefecture_code equal
        if ($new_pref_code = \Input::get('new_pref_code'))
            $conditions['where'][] = ['new_prefecture_code', $new_pref_code];

        // Where prefecture_code equal
        if ($pref_code = \Input::get('pref_code'))
            $conditions['where'][] = ['prefecture_code', $pref_code];

        // Where status equal
        if ($status = \Input::get('status'))
            $conditions['where'][] = ['status', \Config::get('models.contact.status.'.$status)];

        // Where user status equal
        if ($user_status = \Input::get('user_status'))
            $conditions['where'][] = ['user_status', \Config::get('models.contact.user_status.'.$user_status)];

        // Where contact created from
        if ($created_from = \Input::get('created_from'))
            $conditions['where'][] = ['created_at', '>=', \Helper\TimezoneConverter::convertFromStringToUTC($created_from)];

        // Where contact created to
        if ($created_to = \Input::get('created_to'))
            $conditions['where'][] = ['created_at', '<=', \Helper\TimezoneConverter::convertFromStringToUTC($created_to)];

        // Where introduce created from
        if ($introduced_from = \Input::get('introduced_from'))
        {
            $related_where = true;
            $conditions['related']['estimates']['where'][] = ['created_at', '>=', \Helper\TimezoneConverter::convertFromStringToUTC($introduced_from)];
        }

        // Where introduce created to
        if ($introduced_to = \Input::get('introduced_to'))
        {
            $related_where = true;
            $conditions['related']['estimates']['where'][] = ['created_at', '<=', \Helper\TimezoneConverter::convertFromStringToUTC($introduced_to)];
        }

        // Where estimate progress equal
        if ($estimate_progress = \Input::get('estimate_progress'))
        {
            $related_where = true;

            switch ($estimate_progress)
            {
                case 'unknown':
                    $conditions['related']['estimates']['where'][] = ['contacted', false];
                    break;
                case 'contacted':
                    $conditions['related']['estimates']['where'][] = ['contacted', true];
                    $conditions['related']['estimates']['where'][] = ['visited', false];
                    break;
                case 'visited':
                    $conditions['related']['estimates']['where'][] = ['visited', true];
                    $conditions['related']['estimates']['where'][] = ['power_of_attorney_acquired', false];
                    break;
                case 'power_of_attorney_acquired':
                    $conditions['related']['estimates']['where'][] = ['power_of_attorney_acquired', true];
                    $conditions['related']['estimates']['where'][] = ['construction_scheduled_date', NULL];
                    break;
                case 'construction_scheduled_date':
                    $conditions['related']['estimates']['where'][] = ['construction_scheduled_date', 'IS NOT', NULL];
                    $conditions['related']['estimates']['where'][] = ['construction_finished_date', NULL];
                    break;
                case 'construction_finished_date':
                    $conditions['related']['estimates']['where'][] = ['construction_finished_date', 'IS NOT', NULL];
                    break;
            }
        }

        return $related_where;
    }

    private function getNewEstimates(&$contact)
    {
        $sent_companies_ids = [];

        foreach ($contact->estimates as $estimate)
        {
            // FIX ME if estimate is expired add do not add to list
            $sent_companies_ids[] = $estimate->company->id;
        }

        $where = [];
        $where[] = ['estimate_req_sendable', true];

        if ($sent_companies_ids)
        {
            $where[] = ['id', 'NOT IN', $sent_companies_ids];
        }

        $companies = \Model_Company::find('all', [
            'where' => $where,
            'related' => [
                'geocodes' => [
                    'related' => [
                        'zip_codes' => [
                            'where' => [
                                ['zip_code', $contact->getZipCode()],
                            ],
                        ],
                    ],
                ],
                'partner_company' => [
                    'where' => [
                        ['email', '!=', 'info@enepi.jp'],
                    ],
                ],
            ],
        ]);

        $new_estimates = [];

        foreach ($companies as $company)
        {
            $estimate = new \Model_Estimate(['company_id' => $company->id, 'contact_id' => $contact->id, 'contracted_commission' => $company->getCommission($contact)]);

            $estimate->setCompanyPriceRule($contact);

            $new_estimates[] = $estimate;
        }

        return $new_estimates;
    }
}
