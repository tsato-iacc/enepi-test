<?php
use JpPrefecture\JpPrefecture;

class Controller_Partner_Csv extends Controller_Partner
{
    public function before()
    {
        parent::before();

        if (\Input::extension() != 'csv')
          throw new HttpNotFoundException;
        \Config::load('csv', true);
    }

    public function action_estimates()
    {
        $conditions = [
            'where' => [
                ['company_id', $this->auth_user->company->id],
            ],
            'related' => [
                'company' => [
                    'related' => [
                        'partner_company',
                    ],
                ],
                'contact' => [
                    'where' => [],
                ],
                'histories' => [
                    'where' => [
                        ['diff_json', 'LIKE', '%"verbal_ok"%'],
                    ],
                ],
            ],
            'order_by' => [
                'id' => 'desc',
            ]
        ];

        $this->updateEstimateConditions($conditions);
        $estimates = \Model_Estimate::find('all', $conditions);

        $this->checkPrivacy($estimates);

        $name = \Str::random('alpha', 16).'.csv';
        $this->createEstimateCsv($estimates, $name);

        return \File::download(APPPATH."/tmp/{$name}", '見積り一覧.csv', null, null, true);
    }

    /**
     * Privet methods
     */
    private function createEstimateCsv(&$estimates, &$name)
    {
        $headers = \Config::get('csv.partner_estimate');
        $format = \Format::forge();

        \File::update(APPPATH.DIRECTORY_SEPARATOR.'/tmp/', $name, mb_convert_encoding($format->to_csv([$headers])."\n", 'SJIS'));

        foreach ($estimates as $estimate)
        {
            $line = [
                $estimate->contact_id,
                $estimate->uuid,
                __('admin.estimate.status.'.\Config::get('views.estimate.status.'.$estimate->status)),
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
                $estimate->contact->gas_contracted_shop_name,
                $estimate->contact->gas_used_years,
                implode('、', $estimate->contact->getGasMachines()),
                //trim($estimate->notes, '\"'),
                str_replace("\"", "\"\"", trim($estimate->notes)),
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

    private function updateEstimateConditions(&$conditions)
    {
        // Where contact name equal
        if ($contact_name_equal = \Input::get('contact_name_equal'))
            $conditions['related']['contact']['where'][] = ['name', $contact_name_equal];
            
        // Where contact name like
        if ($contact_name_like = \Input::get('contact_name_like'))
            $conditions['related']['contact']['where'][] = ['name', 'LIKE', "%{$contact_name_like}%"];

        // Where company contact name like
        if ($company_contact_name_like = \Input::get('company_contact_name_like'))
            $conditions['where'][] = ['company_contact_name', 'LIKE', "%{$company_contact_name_like}%"];

        // Where status equal
        if ($status = \Input::get('status'))
            $conditions['where'][] = ['status', \Config::get('models.estimate.status.'.$status)];

        // Where new_prefecture_code equal
        if ($new_pref_code = \Input::get('new_pref_code'))
            $conditions['related']['contact']['where'][] = ['new_prefecture_code', $new_pref_code];

        // Where prefecture_code equal
        if ($pref_code = \Input::get('pref_code'))
            $conditions['related']['contact']['where'][] = ['prefecture_code', $pref_code];

        // Where contact created from
        if ($created_from = \Input::get('created_from'))
            $conditions['where'][] = ['created_at', '>=', \Helper\TimezoneConverter::convertFromStringToUTC($created_from)];;

        // Where contact created to
        if ($created_to = \Input::get('created_to'))
            $conditions['where'][] = ['created_at', '<=', \Helper\TimezoneConverter::convertFromStringToUTC($created_to, 'Y-m-d H:i:s', 'Y-m-d', true)];

        if ($preferred_time = \Input::get('preferred_time'))
            $conditions['related']['contact']['where'][] = ['preferred_contact_time_between', $preferred_time];
    }

    private function checkPrivacy(&$estimates)
    {
        $msg = '送客後に表示されます';

        foreach ($estimates as $estimate)
        {
            if (!($estimate->status == \Config::get('models.estimate.status.contracted') || $estimate->status == \Config::get('models.estimate.status.verbal_ok')))
            {
                $estimate->contact->name = $msg;
                $estimate->contact->furigana = $msg;
                $estimate->contact->email = $msg;
                $estimate->contact->tel = $msg;
                $estimate->contact->address2 = $msg;
                $estimate->contact->new_address2 = $msg;
            }
        }
    }
}
