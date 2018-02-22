<?php
use JpPrefecture\JpPrefecture;

class Controller_Admin_Csv extends Controller_Admin
{
    public function before()
    {
        parent::before();

        if (\Input::extension() != 'csv')
          throw new HttpNotFoundException;
        \Config::load('csv', true);
    }

    public function action_companies_estimates($id)
    {
        $conditions = [
            'where' => [
                ['company_id', $id]
            ],
            'related' => [
                'company' => [
                    'related' => [
                        'partner_company'
                    ],
                ],
                'contact',
            ],
            'order_by' => [
                'id' => 'desc',
            ]
        ];

        $estimates = \Model_Estimate::find('all', $conditions);

        $name = \Str::random('alpha', 16).'.csv';
        $this->createEstimateCsv($estimates, $name);

        return \File::download(APPPATH."/tmp/{$name}", "企業{$id} 見積り一覧.csv", null, null, true);
    }

    public function action_estimates()
    {
        $conditions = [
            'where' => [],
            'related' => [
                'company' => [
                    'related' => [
                        'partner_company',
                    ],
                ],
                'contact' => [
                    'where' => [],
                ],
            ],
            'order_by' => [
                'id' => 'desc',
            ]
        ];

        $this->updateEstimateConditions($conditions);
        $estimates = \Model_Estimate::find('all', $conditions);

        $name = \Str::random('alpha', 16).'.csv';
        $this->createEstimateCsv($estimates, $name);

        return \File::download(APPPATH."/tmp/{$name}", '見積り一覧.csv', null, null, true);
    }

    public function action_estimates_history()
    {
        $conditions = [
            'where' => [],
            'related' => [
                'company' => [
                    'related' => [
                        'partner_company',
                    ],
                ],
                'contact' => [
                    'where' => [],
                ],
            ],
            'order_by' => [
                'id' => 'desc',
            ],
        ];

        $this->updateEstimateConditions($conditions);
        $estimates = \Model_Estimate::find('all', $conditions);

        $ids = \Arr::pluck($estimates, 'id');

        $histories = \Model_Estimate_History::find('all',[
            'where' => [
                ['estimate_id', 'IN', $ids],
            ],
            'related' => [
                'admin_user',
                'partner_company',
            ],
            'order_by' => [
                'id' => 'desc',
            ],
        ]);

        $name = \Str::random('alpha', 16).'.csv';
        $this->createEstimateHistoryCsv($histories, $name);

        return \File::download(APPPATH."/tmp/{$name}", '見積り一覧.csv', null, null, true);
    }

    public function action_contacts_estimates($id)
    {
        $contact = \Model_Contact::find($id, ['related' => ['tracking', 'estimates' => ['related' => ['company']]]]);

        $name = \Str::random('alpha', 16).'.csv';

        if ($contact)
            $this->createEstimateCsv($contact->estimates, $name);

        return \File::download(APPPATH."/tmp/{$name}", "問い合わせ{$id} 見積り一覧.csv", null, null, true);
    }

    public function action_contacts()
    {
        $conditions = [
            'where' => [],
            'related' => [
                'estimates' => [
                    'where' => [],
                ],
                'tracking',
            ],
            'order_by' => [
                'id' => 'desc',
            ]
        ];

        $related_where = $this->updateContactConditions($conditions);
        $contacts = \Model_Contact::find('all', $conditions);

        $name = \Str::random('alpha', 16).'.csv';
        $this->createContactCsv($contacts, $name);

        return \File::download(APPPATH."/tmp/{$name}", '問い合わせ一覧.csv', null, null, true);
    }

    /**
     * Privet methods
     */
    private function createEstimateCsv(&$estimates, &$name)
    {
        $headers = \Config::get('csv.estimate');
        $format = \Format::forge();

        \File::update(APPPATH.DIRECTORY_SEPARATOR.'/tmp/', $name, mb_convert_encoding($format->to_csv([$headers])."\n", 'SJIS'));

        foreach ($estimates as $estimate)
        {
            $line = [
                $estimate->contact_id,
                $estimate->uuid,
                $estimate->company->getCompanyName(),
                __('admin.estimate.status.'.\Config::get('views.estimate.status.'.$estimate->status)),
                $estimate->status_reason ? \Helper\CancelReasons::getNameByValue($estimate->status_reason) : '',
                $estimate->progress(),
                $estimate->contact->name,
                \Helper\TimezoneConverter::convertFromString($estimate->created_at, 'admin_table'),
                $estimate->contact->tel,
                $estimate->contact->email,
                $estimate->contact->zip_code ? $estimate->contact->zip_code : '-',
                $estimate->contact->prefecture_code ? JpPrefecture::findByCode($estimate->contact->prefecture_code)->nameKanji : '-',
                $estimate->contact->address ? $estimate->contact->address : '-',
                $estimate->contact->address2 ? $estimate->contact->address2 : '-',
                $estimate->contact->new_zip_code ? $estimate->contact->new_zip_code : '-',
                $estimate->contact->new_prefecture_code ? JpPrefecture::findByCode($estimate->contact->new_prefecture_code)->nameKanji : '-',
                $estimate->contact->new_address ? $estimate->contact->new_address : '-',
                $estimate->contact->new_address2 ? $estimate->contact->new_address2 : '-',
                $estimate->contact->moving_scheduled_date ? $estimate->contact->moving_scheduled_date : '-',
                __('admin.contact.house_kind.'.\Config::get('views.contact.house_kind.'.$estimate->contact->house_kind)),
                __('admin.contact.ownership_kind.'.\Config::get('views.contact.ownership_kind.'.$estimate->contact->ownership_kind)),
                $estimate->contact->house_age ? $estimate->contact->house_age : '-',
                $estimate->contact->estimate_kind == \Config::get('models.contact.estimate_kind.new_contract') ? '新規開設' : '現在住居',
                $estimate->contact->gas_meter_checked_month,
                $estimate->contact->gas_used_amount,
                $estimate->contact->gas_latest_billing_amount,
                $estimate->total_savings_in_year($estimate->contact),
                $estimate->contact->gas_contracted_shop_name,
                $estimate->contact->gas_used_years,
                implode('、', $estimate->contact->getGasMachines()),
                $estimate->notes,
                __('admin.contact.preferred_contact_time_between.'.$estimate->contact->preferred_contact_time_between),
                $estimate->contact->priority_degree == \Config::get('models.contact.priority_degree.regular') ? '通常' : '至急',
                __('admin.contact.desired_option.'.$estimate->contact->desired_option),
                $estimate->visit_scheduled_date,
                $estimate->construction_scheduled_date,
                $estimate->construction_finished_date,
                $estimate->contacted ? '◯' : '×',
                $estimate->visited ? '◯' : '×',
                $estimate->power_of_attorney_acquired ? '◯' : '×',
            ];

            \File::append(APPPATH.DIRECTORY_SEPARATOR.'/tmp/', $name, mb_convert_encoding($format->to_csv([$line])."\n", 'SJIS'));
        }
    }

    private function createContactCsv(&$contacts, &$name)
    {
        $headers = \Config::get('csv.contact');
        $format = \Format::forge();

        \File::update(APPPATH.DIRECTORY_SEPARATOR.'/tmp/', $name, mb_convert_encoding($format->to_csv([$headers])."\n", 'SJIS'));

        foreach ($contacts as $contact)
        {
            $line = [
                $contact->id,
                $contact->name,
                $contact->email,
                \Helper\TimezoneConverter::convertFromString($contact->created_at, 'admin_table'),
                \Helper\TimezoneConverter::convertFromString($contact->updated_at, 'admin_table'),
                $contact->deleted_at ? \Helper\TimezoneConverter::convertFromString($contact->deleted_at, 'admin_table') : '-',
                $contact->tracking ? $contact->tracking->display_name : '無し',
                __('admin.contact.terminal_types.'.$contact->terminal),
                $contact->tel,
                $contact->zip_code ? $contact->zip_code : '-',
                $contact->prefecture_code ? JpPrefecture::findByCode($contact->prefecture_code)->nameKanji : '-',
                $contact->address ? $contact->address : '-',
                $contact->address2 ? $contact->address2 : '-',
                $contact->new_zip_code ? $contact->new_zip_code : '-',
                $contact->new_prefecture_code ? JpPrefecture::findByCode($contact->new_prefecture_code)->nameKanji : '-',
                $contact->new_address ? $contact->new_address : '-',
                $contact->new_address2 ? $contact->new_address2 : '-',
                $contact->moving_scheduled_date ? $contact->moving_scheduled_date : '-',
                __('admin.contact.house_kind.'.\Config::get('views.contact.house_kind.'.$contact->house_kind)),
                __('admin.contact.ownership_kind.'.\Config::get('views.contact.ownership_kind.'.$contact->ownership_kind)),
                $contact->house_age ? $contact->house_age : '-',
                $contact->number_of_rooms ? $contact->number_of_rooms : '-',
                $contact->number_of_active_rooms ? $contact->number_of_active_rooms : '-',
                $contact->estate_management_company_name ? $contact->estate_management_company_name : '-',
                $contact->estimate_kind == \Config::get('models.contact.estimate_kind.new_contract') ? '新規開設' : '現在住居',
                $contact->apartment_owner ? '◯' : '×',
                $contact->gas_contracted_shop_name,
                $contact->gas_used_years,
                $contact->gas_meter_checked_month,
                $contact->gas_used_amount,
                $contact->gas_latest_billing_amount,
                implode('、', $contact->getGasMachines()),
                $contact->basicPrice(),
                $contact->unitPrice(),
                count($contact->estimates),
                __('admin.contact.status.'.\Config::get('views.contact.status.'.$contact->status)),
                __('admin.contact.user_status.'.\Config::get('views.contact.user_status.'.$contact->user_status)),
                $contact->status_reason ? \Helper\CancelReasons::getNameByValue($contact->status_reason) : '',
                __('admin.estimate.progress.'.$contact->getEstimateProgress()),
                $contact->admin_memo,
                $contact->sent_auto_estimate_req ? '◯' : '×',
                __('admin.contact.is_seen.'.\Config::get('views.contact.is_seen.'.$contact->is_seen)),
                \Uri::create('lpgas/contacts/:id?'.http_build_query(['pin' => $contact->pin, 'token' => $contact->token]), ['id' => $contact->id]),
                $contact->from_kakaku ? '◯' : '×',
                $contact->from_enechange ? '◯' : '×',
                __('admin.contact.preferred_contact_time_between.'.$contact->preferred_contact_time_between),
                $contact->priority_degree == \Config::get('models.contact.priority_degree.regular') ? '通常' : '至急',
                __('admin.contact.desired_option.'.$contact->desired_option),
                $contact->body,
            ];

            \File::append(APPPATH.DIRECTORY_SEPARATOR.'/tmp/', $name, mb_convert_encoding($format->to_csv([$line])."\n", 'SJIS'));
        }
    }
    
    private function createEstimateHistoryCsv(&$histories, &$name)
    {
        $headers = \Config::get('csv.estimates_history');
        $format = \Format::forge();

        \File::update(APPPATH.DIRECTORY_SEPARATOR.'/tmp/', $name, mb_convert_encoding($format->to_csv([$headers])."\n", 'SJIS'));

        foreach ($histories as $history)
        {
            if (isset($history->diff_json->uuid))
                continue;

            $user = '';

            if ($history->admin_user_id)
            {
                $user = $history->admin_user->email;
            }
            else if ($history->partner_company_id)
            {
                $user = $history->partner_company->company_name;
            }

            foreach ($history->diff_json as $key => $val)
            {
                if (in_array($key, ['updated_at', 'last_update_admin_user_id', 'last_update_partner_company_id']))
                {
                    continue;
                }

                if ($val->old == $val->new)
                    continue;

                $line = [
                    $history->estimate->uuid,
                    $user,
                    $key,
                    $val->old,
                    $val->new,
                    \Helper\TimezoneConverter::convertFromString($history->created_at, 'admin_table'),
                ];
                
                \File::append(APPPATH.DIRECTORY_SEPARATOR.'/tmp/', $name, mb_convert_encoding($format->to_csv([$line])."\n", 'SJIS'));
            }
        }
    }

    private function updateEstimateConditions(&$conditions)
    {
        // Where contact name equal
        if ($contact_name_equal = \Input::get('contact_name_equal'))
            $conditions['related']['contact']['where'][] = ['name', $contact_name_equal];
            
        // Where contact name like
        if ($contact_name_like = \Input::get('contact_name_like'))
            $conditions['related']['contact']['where'][] = ['name', 'LIKE', "%{$contact_name_like}%"];
        
        // Where company id equal
        if ($company_id = \Input::get('company_id'))
            $conditions['where'][] = ['company_id', $company_id];

        // Where company contact name like
        if ($company_contact_name_like = \Input::get('company_contact_name_like'))
            $conditions['where'][] = ['company_contact_name', 'LIKE', "%{$company_contact_name_like}%"];

        // Where tel equal
        if ($contact_tel_equal = \Input::get('contact_tel_equal'))
            $conditions['related']['contact']['where'][] = ['tel', $contact_tel_equal];

        // Where email equal
        if ($email_equal = \Input::get('email_equal'))
            $conditions['related']['contact']['where'][] = ['email', $email_equal];

        // Where status equal
        if ($status = \Input::get('status'))
            $conditions['where'][] = ['status', \Config::get('models.estimate.status.'.$status)];

        // Where estimate progress equal
        if ($estimate_progress = \Input::get('estimate_progress'))
        {
            switch ($estimate_progress)
            {
                case 'unknown':
                    $conditions['where'][] = ['contacted', false];
                    break;
                case 'contacted':
                    $conditions['where'][] = ['contacted', true];
                    $conditions['where'][] = ['visited', false];
                    break;
                case 'visited':
                    $conditions['where'][] = ['visited', true];
                    $conditions['where'][] = ['power_of_attorney_acquired', false];
                    break;
                case 'power_of_attorney_acquired':
                    $conditions['where'][] = ['power_of_attorney_acquired', true];
                    $conditions['where'][] = ['construction_scheduled_date', NULL];
                    break;
                case 'construction_scheduled_date':
                    $conditions['where'][] = ['construction_scheduled_date', 'IS NOT', NULL];
                    $conditions['where'][] = ['construction_finished_date', NULL];
                    break;
                case 'construction_finished_date':
                    $conditions['where'][] = ['construction_finished_date', 'IS NOT', NULL];
                    break;
            }
        }

        // Where contact created from
        if ($created_from = \Input::get('created_from'))
            $conditions['where'][] = ['created_at', '>=', \Helper\TimezoneConverter::convertFromStringToUTC($created_from)];;

        // Where contact created to
        if ($created_to = \Input::get('created_to'))
            $conditions['where'][] = ['created_at', '>=', \Helper\TimezoneConverter::convertFromStringToUTC($created_to)];

        if ($preferred_time = \Input::get('preferred_time'))
            $conditions['related']['contact']['where'][] = ['preferred_contact_time_between', $preferred_time];
    }

    private function updateContactConditions(&$conditions)
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
}
