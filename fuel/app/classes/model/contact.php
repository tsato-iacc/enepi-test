<?php

use \Helper\ValidateReplacer;
use \Helper\Simulation;
use JpPrefecture\JpPrefecture;

/**
 * class Lpgas::CompanyServiceFeature
 */
class Model_Contact extends \Orm\Model_Soft
{
    protected static $_table_name = 'lpgas_contacts';

    protected static $_properties = [
        'id',
        'name',
        'furigana',
        'zip_code',
        'prefecture_code',
        'address',
        'address2' => [
            'default' => '',
        ],
        'new_zip_code',
        'new_prefecture_code',
        'new_address',
        'new_address2' => [
            'default' => '',
        ],
        'house_age',
        'tel',
        'email',
        'original_contact_id',
        'from_kakaku' => [
            'default' => false,
        ],
        'from_enechange' => [
            'default' => false,
        ],
        'sent_auto_estimate_req' => [
            'default' => false,
        ],
        'gas_meter_checked_month',
        'gas_used_years',
        'gas_used_amount',
        'gas_latest_billing_amount',
        'gas_contracted_shop_name' => [
            'default' => '',
        ],
        'moving_scheduled_date',
        'body',
        'house_kind',
        'ownership_kind' => [
            'default' => 0,
        ],
        'estimate_kind',
        'apartment_owner' => [
            'default' => 0,
        ],
        'number_of_rooms',
        'number_of_active_rooms',
        'estate_management_company_name',
        'using_cooking_stove' => [
            'default' => false,
        ],
        'using_bath_heater_with_gas_hot_water_supply' => [
            'default' => false,
        ],
        'using_other_gas_machine' => [
            'default' => false,
        ],
        'status' => [
            'default' => 0,
        ],
        'status_reason' => [
            'default' => 0,
        ],
        'user_status' => [
            'default' => 0,
        ],
        'terminal' => [
            'default' => 0,
        ],
        'token',
        'pin',
        'admin_memo',
        'pr_tracking_parameter_id',
        'priority_degree' => [
            'default' => 0,
        ],
        'desired_option' => [
            'default' => 0,
        ],
        'preferred_contact_time_between' => [
            'default' => 0,
        ],
        'reason_not_auto_sendable' => [
            'default' => null,
        ],
        'is_seen' => [
            'default' => 1,
        ],
        'house_hold' => [
            'default' => null,
        ],
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static $_observers = [
        'Orm\\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'mysql_timestamp' => true,
        ],
        'Orm\\Observer_UpdatedAt' => [
            'events' => ['before_update'],
            'mysql_timestamp' => true,
        ],
        'Orm\\Observer_Typing'
    ];

    protected static $_belongs_to = [
        'tracking' => [
            'key_from' => 'pr_tracking_parameter_id',
        ],
    ];

    protected static $_has_many = [
        'estimates',
        'callings',
        'calling_histories' => [
            'model_to' => 'Model_CallingHistory',
        ],
    ];

    protected static $_has_one = [
        'contact_geocode',
    ];

    private $_unit_price = null;
    private $_reasons = [];

    private $_zip_code = null;
    private $_prefecture_code = null;
    private $_address = null;

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object or null if factory is null
     */
    public static function validate($factory = null)
    {
        $val = ValidateReplacer::forge();

        $val->add_field('lpgas_contact.house_hold', 'house_hold', 'numeric_between[2,7]');

        $val->add_field('lpgas_contact.using_cooking_stove', 'using_cooking_stove', 'match_value[1]');
        $val->add_field('lpgas_contact.using_bath_heater_with_gas_hot_water_supply', 'using_bath_heater_with_gas_hot_water_supply', 'match_value[1]');
        $val->add_field('lpgas_contact.using_other_gas_machine', 'using_other_gas_machine', 'match_value[1]');

        $val->add_field('lpgas_contact.name', 'name', 'required|max_length[20]');
        $val->add_field('lpgas_contact.furigana', 'furigana', 'max_length[20]');
        $val->add_field('lpgas_contact.tel', 'tel', 'required|match_pattern[/^(\d{10,11})$/]');
        $val->add_field('lpgas_contact.email', 'email', 'required|valid_email');


        if ($factory != 'old_form')
        {
            $val->add_field('lpgas_contact.house_kind', 'house_kind', 'required|match_collection[detached,store_ex,apartment]');

            if (\Input::post('lpgas_contact.zip_code'))
            {
                $val->add_field('lpgas_contact.zip_code', 'zip_code', 'required|valid_string[numeric]');
                $val->add_field('lpgas_contact.prefecture_code', 'prefecture_code', 'required_with[lpgas_contact.zip_code]|valid_string[numeric]');
                $val->add_field('lpgas_contact.address', 'address', 'required_with[lpgas_contact.zip_code]');
            }
            else
            {
                $val->add_field('lpgas_contact.new_zip_code', 'new_zip_code', 'required|valid_string[numeric]');
                $val->add_field('lpgas_contact.new_prefecture_code', 'new_prefecture_code', 'required_with[lpgas_contact.new_zip_code]|valid_string[numeric]');
                $val->add_field('lpgas_contact.new_address', 'new_address', 'required_with[lpgas_contact.new_zip_code]');
            }
        }

        switch ($factory)
        {
            case 'old_form':
                $val->add_field('lpgas_contact.zip_code', 'zip_code', 'required|valid_string[numeric]');
                $val->add_field('lpgas_contact.prefecture_code', 'prefecture_code', 'required|valid_string[numeric]');
                $val->add_field('lpgas_contact.address', 'address', 'required|max_length[100]');
                $val->add_field('lpgas_contact.address2', 'address2', 'max_length[100]');
                $val->add_field('lpgas_contact.house_age', 'house_age', 'valid_string[numeric]');
                $val->add_field('lpgas_contact.gas_used_years', 'gas_used_years', 'valid_string[numeric]');
                $val->add_field('lpgas_contact.body', 'body', 'max_length[2000]');

                if (\Input::post('apartment_form') || \Input::post('lpgas_contact.estimate_kind') == 'new_contract')
                {
                    $val->add_field('lpgas_contact.new_zip_code', 'new_zip_code', 'required|valid_string[numeric]');
                    $val->add_field('lpgas_contact.new_prefecture_code', 'new_prefecture_code', 'required|valid_string[numeric]');
                    $val->add_field('lpgas_contact.new_address', 'new_address', 'required|max_length[100]');

                    $val->add_field('lpgas_contact.gas_used_amount', 'gas_used_amount', 'match_pattern[/^[0-9]*[.]?[0-9]+$/]');
                    $val->add_field('lpgas_contact.gas_meter_checked_month', 'gas_meter_checked_month', 'numeric_between[1,12]');
                    $val->add_field('lpgas_contact.gas_latest_billing_amount', 'gas_latest_billing_amount', 'valid_string[numeric]');
                }
                
                if (\Input::post('lpgas_contact.estimate_kind') == 'change_contract')
                {
                    $val->add_field('lpgas_contact.gas_used_amount', 'gas_used_amount', 'required|match_pattern[/^[0-9]*[.]?[0-9]+$/]');
                    $val->add_field('lpgas_contact.gas_meter_checked_month', 'gas_meter_checked_month', 'required|numeric_between[1,12]');
                    $val->add_field('lpgas_contact.gas_latest_billing_amount', 'gas_latest_billing_amount', 'required|valid_string[numeric]');
                    $val->add_field('lpgas_contact.gas_contracted_shop_name', 'gas_contracted_shop_name', 'required|max_length[50]');
                }

                if (\Input::post('lpgas_contact.estimate_kind') == 'new_contract')
                {
                    $val->add_field('lpgas_contact.moving_scheduled_date', 'moving_scheduled_date', 'match_pattern[/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/]');
                    $val->add_field('lpgas_contact.gas_contracted_shop_name', 'gas_contracted_shop_name', 'max_length[50]');
                }

                if (\Input::post('apartment_form'))
                {
                    $val->add_field('lpgas_contact.house_kind', 'house_kind', 'required|match_value[apartment]');
                    $val->add_field('lpgas_contact.apartment_owner', 'apartment_owner', 'required|match_value[1]');

                    $val->add_field('lpgas_contact.gas_contracted_shop_name', 'gas_contracted_shop_name', 'required|max_length[50]');
                    $val->add_field('lpgas_contact.number_of_rooms', 'number_of_rooms', 'required|valid_string[numeric]');
                    $val->add_field('lpgas_contact.number_of_active_rooms', 'number_of_active_rooms', 'valid_string[numeric]');
                    $val->add_field('lpgas_contact.estate_management_company_name', 'estate_management_company_name', 'max_length[50]');
                }
                else
                {
                    $val->add_field('lpgas_contact.ownership_kind', 'ownership_kind', 'required|match_collection[owner,borrower,unit_owner]');
                    $val->add_field('lpgas_contact.estimate_kind', 'estimate_kind', 'required|match_collection[change_contract,new_contract]');
                }

                break;

            case 'change_contract':
                if (!\Input::post('lpgas_contact.house_hold'))
                {
                    $val->add_field('lpgas_contact.gas_used_amount', 'gas_used_amount', 'required|match_pattern[/^[0-9]*[.]?[0-9]+$/]');
                }
                else
                {
                    $val->add_field('lpgas_contact.gas_used_amount', 'gas_used_amount', 'match_pattern[/^[0-9]*[.]?[0-9]+$/]');
                }

                $val->add_field('lpgas_contact.estimate_kind', 'estimate_kind', 'required|match_collection[change_contract,new_contract]');
                $val->add_field('lpgas_contact.gas_meter_checked_month', 'gas_meter_checked_month', 'required|match_collection[january,february,march,april,may,june,july,august,september,october,november,december]');
                $val->add_field('lpgas_contact.gas_latest_billing_amount', 'gas_latest_billing_amount', 'required|valid_string[numeric]');
                $val->add_field('lpgas_contact.gas_contracted_shop_name', 'gas_contracted_shop_name', 'required|max_length[50]');

                break;

            case 'new_contract':
                if (!\Input::post('lpgas_contact.house_hold'))
                {
                    $val->add_field('lpgas_contact.gas_used_amount', 'gas_used_amount', 'match_pattern[/^[0-9]*[.]?[0-9]+$/]');
                }

                $val->add_field('lpgas_contact.estimate_kind', 'estimate_kind', 'required|match_collection[change_contract,new_contract]');
                $val->add_field('lpgas_contact.gas_meter_checked_month', 'gas_meter_checked_month', 'match_collection[january,february,march,april,may,june,july,august,september,october,november,december]');
                $val->add_field('lpgas_contact.gas_latest_billing_amount', 'gas_latest_billing_amount', 'valid_string[numeric]');
                $val->add_field('lpgas_contact.gas_contracted_shop_name', 'gas_contracted_shop_name', 'max_length[50]');
                break;

            case 'apartment':
                if (!\Input::post('lpgas_contact.house_hold'))
                {
                    $val->add_field('lpgas_contact.gas_used_amount', 'gas_used_amount', 'match_pattern[/^[0-9]*[.]?[0-9]+$/]');
                }

                $val->add_field('lpgas_contact.gas_meter_checked_month', 'gas_meter_checked_month', 'match_collection[january,february,march,april,may,june,july,august,september,october,november,december]');
                $val->add_field('lpgas_contact.gas_latest_billing_amount', 'gas_latest_billing_amount', 'valid_string[numeric]');
                $val->add_field('lpgas_contact.gas_contracted_shop_name', 'gas_contracted_shop_name', 'max_length[50]');

                $val->add_field('lpgas_contact.number_of_rooms', 'number_of_rooms', 'required|valid_string[numeric]');
                $val->add_field('lpgas_contact.number_of_active_rooms', 'number_of_active_rooms', 'valid_string[numeric]');
                $val->add_field('lpgas_contact.estate_management_company_name', 'estate_management_company_name', 'max_length[50]');
                break;
            
            default:
                return null;

                break;
        }
        
        return $val;
    }

    /**
     * Wrapper for save model
     * @param  [type]  $cascade         [description]
     * @param  boolean $use_transaction [description]
     * @return bool                     Return parrent result
     */
    public function save($cascade = null, $use_transaction = false)
    {
        $result = false;

        $this->updateGeocode();
        
        if ($this->is_new())
        {
            $this->token = \Str::random('hexdec', 32);
            $this->pin   = \Str::random('numeric', 4);

            $has_estimates = $this->tryToSendEstimates();

            if ($has_estimates == false)
            {
                $this->reason_not_auto_sendable = implode(',', $this->_reasons);
                $this->calling = new \Model_Calling();
            }

            if ($result = parent::save($cascade, $use_transaction))
            {
                $this->notifyAdminNewCustomer();
                $this->notifyNewCustomer();
                
                if ($has_estimates)
                    $this->sendSmsToNewCustomer();
            }
        }
        else
        {
            if ($this->status == \Config::get('models.contact.status.cancelled') || $this->status == \Config::get('models.contact.status.contracted'))
                $this->user_status = \Config::get('models.contact.user_status.no_action');

            $result = parent::save($cascade, $use_transaction);
        }

        return $result;
    }

    public function notifyAdminNewCustomer()
    {
        \Log::info('notifyAdminNewCustomer');
        // FIX ME (move to package?)
        // \Package::load('email');
        // $email = \Email::forge();
        // $email->to(\Config::get('enepi.company.email'), \Config::get('enepi.company.service_name'));
        // $email->subject("{$this->name}様よりLPガスに関する問い合わせがありました");
        // $email->html_body(\View::forge('email/notifyAdminNewCustomer', ['contact' => $this]));
        // $email->send();
    }

    public function notifyNewCustomer()
    {
        \Log::info('notifyNewCustomer');
        // \Package::load('email');
        // $email = \Email::forge();
        // $email->to($this->email, $this->name);
        // $email->subject('お問い合わせ頂き、ありがとうございます／プロパンガス一括見積もりサービス enepi（エネピ）運営事務局');
        // $email->html_body(\View::forge('email/notifyNewCustomer', ['contact' => $this]));
        // $email->send();
    }

    public function getZipCode()
    {
        if ($this->_zip_code === null)
        {
            if ($this->zip_code)
            {
                $this->_zip_code = $this->zip_code;
            }
            elseif ($this->new_zip_code)
            {
                $this->_zip_code = $this->new_zip_code;
            }
        }

        return $this->_zip_code;
    }

    public function getPrefectureCode()
    {
        if ($this->_prefecture_code === null)
        {
            if ($this->prefecture_code)
            {
                $this->_prefecture_code = $this->prefecture_code;
            }
            elseif ($this->new_prefecture_code)
            {
                $this->_prefecture_code = $this->new_prefecture_code;
            }
        }

        return $this->_prefecture_code;
    }

    public function getAddress()
    {
        if ($this->_address === null)
        {
            if ($this->address)
            {
                $this->_address = $this->address;
            }
            elseif ($this->new_address)
            {
                $this->_address = $this->new_address;
            }
        }

        return $this->_address;
    }

    public function basicPrice()
    {
        return Simulation::getBasicPrice($this->getPrefectureCode());
    }

    public function unitPrice()
    {
        if ($this->_unit_price === null)
        {
            if ($this->gas_latest_billing_amount && $this->gas_used_amount)
            {
                $basic_price = $this->basicPrice();
                $this->_unit_price = (($this->gas_latest_billing_amount / \Config::get('enepi.taxes.jp_acquisition_tax') - $basic_price)) / $this->gas_used_amount;
            }
            else
            {
                $this->_unit_price = 0;
            }
        }

        return $this->_unit_price;
    }

    public function cancel($admin_id, $reason)
    {
        if ($this->estimates)
        {
            $cancelled = \Config::get('models.estimate.status.cancelled');
            $status_reason = \Helper\CancelReasons::getValueByName($reason);

            foreach ($this->estimates as $estimate)
            {
                if ($estimate->status != $cancelled)
                    $estimate->cancel($admin_id, $status_reason);
            }
        }
        else
        {
            $this->status = \Config::get('models.contact.status.cancelled_before_estimate_req');
            $this->save();
        }
    }

    /**
     * View Methods
     */
    public function getStatusColor()
    {
        $color = '';

        if ($this->status == \Config::get('models.contact.status.pending'))
        {
            $color = 'danger';
        }
        elseif ($this->status == \Config::get('models.contact.status.sent_estimate_req'))
        {
            $color = 'warning';
        }
        elseif ($this->status == \Config::get('models.contact.status.cancelled') || $this->status == \Config::get('models.contact.status.cancelled_before_estimate_req'))
        {
            $color = 'secondary';
        }
        elseif ($this->status == \Config::get('models.contact.status.verbal_ok') || $this->status == \Config::get('models.contact.status.contracted'))
        {
            $color = 'success';
        }

        return $color;
    }

    public function getEstimateProgress()
    {
        $progress = "";

        if (array_filter(\Arr::pluck($this->estimates, 'construction_finished_date')))
        {
            $progress = 'construction_finished_date';
        }
        elseif (array_filter(\Arr::pluck($this->estimates, 'construction_scheduled_date')))
        {
            $progress = 'construction_scheduled_date';
        }
        elseif (array_filter(\Arr::pluck($this->estimates, 'power_of_attorney_acquired')))
        {
            $progress = 'power_of_attorney_acquired';
        }
        elseif (array_filter(\Arr::pluck($this->estimates, 'visited')))
        {
            $progress = 'visited';
        }
        elseif (array_filter(\Arr::pluck($this->estimates, 'contacted')))
        {
            $progress = 'contacted';
        }
        elseif (count($this->estimates))
        {
            $progress = 'unknown';
        }

        return $progress;
    }

    public function getCallingHistories($limit = 20)
    {
        if ($histories = Arr::sort($this->calling_histories, 'id', 'desc'))
        {
            return array_slice($histories, 0, $limit);
        }

        return [];
    }

    /**
     * Private methods
     */
    private function tryToSendEstimates()
    {
        if (!$this->isAutoSendable())
            return false;

        // FIX ME
        // Create relations [move email to conditions?]
        $area_zip_codes = \Model_Company_GeocodeZipCode::find('all', ['where' => [['zip_code', $this->getZipCode()]]]);
        $area_ids = \Arr::pluck($area_zip_codes, 'company_geocode_id');
        $area = \Model_Company_Geocode::find('all', ['where' => [['id', 'IN', $area_ids]]]);
        $companies_ids = Arr::unique(\Arr::pluck($area, 'company_id'));


        if (count($companies_ids))
        {
            $companies = \Model_Company::find('all', [
                'related' => [
                    'partner_company' => [
                        'where' => [
                            ['email', '!=', 'info@enepi.jp'],
                        ],
                    ],
                ],
                'where' => [
                    ['id', 'IN', $companies_ids],
                ]
            ]);

            if (!$companies)
            {
                // Unsupported area
                $this->_reasons[] = \Config::get('enepi.contact.reasons.unsupported_area');
                return false;
            }
        }
        else
        {
            // Unsupported area
            $this->_reasons[] = \Config::get('enepi.contact.reasons.unsupported_area');
            return false;
        }

        $estimates = [];
        $has_savings = false;
        $ng_companies = 0;

        foreach ($companies as $company)
        {
            if (!$company->estimate_req_sendable)
            {
                $ng_companies++;
                continue;
            }

            $estimate = new \Model_Estimate(['company_id' => $company->id, 'contact_id' => $this->id, 'auto' => true]);

            $nearest_geocode_id = $this->getNearestGeocodeId($company);

            if (!$nearest_geocode_id)
                continue;

            $price_rule = \Model_PriceRule::find('first', [
                'where' => [
                    ['company_geocode_id', $nearest_geocode_id],
                    ['using_cooking_stove' => $this->using_cooking_stove],
                    ['using_bath_heater_with_gas_hot_water_supply' => $this->using_bath_heater_with_gas_hot_water_supply],
                    ['using_other_gas_machine' => $this->using_other_gas_machine],
                    ['house_kind' => $this->house_kind],
                ]
            ]);

            if ($price_rule)
            {
                $estimate->set([
                    'basic_price' => $price_rule->basic_price,
                    'fuel_adjustment_cost' => $price_rule->fuel_adjustment_cost,
                    'notes' => $price_rule->notes,
                    'set_plan' => $price_rule->set_plan,
                    'other_set_plan' => $price_rule->other_set_plan,
                ]);

                $estimate_prices = [];

                foreach ($price_rule->prices as $price)
                {
                    $estimate_prices[] = new Model_Estimate_Price([
                        'under_limit' => $price->under_limit,
                        'upper_limit' => $price->upper_limit,
                        'unit_price' => $price->unit_price,
                    ]);
                }

                $estimate->prices = $estimate_prices;
            }

            $estimates[] = $estimate;

            if (!$has_savings && $estimate->total_savings_in_year($this) >= 0)
            {
                $has_savings = true;
            }
        }

        if ($has_savings)
        {
            $this->estimates = $estimates;
            $this->sent_auto_estimate_req = true;
            $this->status = \Config::get('models.contact.status.sent_estimate_req');
            
            return true;
        }
        elseif ($estimates && !$has_savings)
        {
            // If matching company found but savings is minus
            $this->_reasons[] = \Config::get('enepi.contact.reasons.no_savings');
        }
        elseif (count($companies) == $ng_companies)
        {
            // Only NG companies
            $this->_reasons[] = \Config::get('enepi.contact.reasons.ng_companies');
        }
        else
        {
            // Unknown reason
            $this->_reasons[] = \Config::get('enepi.contact.reasons.unknown_reason');
        }

        return false;
    }

    private function isAutoSendable($ignore_pr_tracking = false)
    {
        // Test contact
        if (in_array($this->name, ['テスト', 'てすと', 'test', 'TEST']) || $this->email == 'info@enepi.jp')
        {
            $this->_reasons[] = \Config::get('enepi.contact.reasons.test');
            return false;
        }

        // Borrowed apartment
        if ($this->house_kind == \Config::get('models.contact.house_kind.apartment') && $this->ownership_kind == \Config::get('models.contact.ownership_kind.borrower'))
        {
            $this->_reasons[] = \Config::get('enepi.contact.reasons.borrowed_apartment');
            return false;
        }

        // Store
        if ($this->house_kind == \Config::get('models.contact.house_kind.store_ex'))
        {
            $this->_reasons[] = \Config::get('enepi.contact.reasons.store');
            return false;
        }

        // Apartment owner
        if ($this->apartment_owner)
        {
            $this->_reasons[] = \Config::get('enepi.contact.reasons.apartment_owner');
            return false;
        }

        // Unit price equal 0
        if ($this->unitPrice() == 0)
        {
            $this->_reasons[] = \Config::get('enepi.contact.reasons.unit_price_zero');
            return false;
        }

        // Unit price less then
        if ($this->unitPrice() <= \Config::get('enepi.estimate.unit_price'))
        {
            $this->_reasons[] = \Config::get('enepi.contact.reasons.unit_price_less');
            return false;
        }
        
        // Check PR tracking
        if (!($ignore_pr_tracking || $this->tracking === null || $this->tracking->auto_sendable))
        {
            $this->_reasons[] = \Config::get('enepi.contact.reasons.pr_tracking');
            return false;
        }

        return true;
    }

    private function sendSmsToNewCustomer()
    {
        \Log::info('sendSmsToNewCustomer');
    }

    private function getNearestGeocodeId(&$company)
    {
        foreach ($company->geocodes as $geocode)
        {
            foreach ($geocode->zip_codes as $zip)
            {
                if ($zip->zip_code == $this->getZipCode())
                    return $geocode->id;
            }
        }

        return null;
    }

    private function updateGeocode()
    {
        // Only if address was changed?
        $address = JpPrefecture::findByCode($this->getPrefectureCode())->nameKanji . " " . $this->getAddress();

        if ($this->contact_geocode)
        {
            // if ($this->contact_geocode->address != $gaddress || $gcode->lat && $gcode->lng)
            // {
            //     $this->contact_geocode = $gaddress;
                // FIX ME
                // self.lat, self.lng = GeocodeFetcher.fetch_from_address(address)
                // $gcode->lat = 0.0;
                // $gcode->lat = 0.0;
            // }
        }
        else
        {
            $this->contact_geocode = new \Model_Contact_Geocode(['address' => $address]);
            // FIX ME
            // self.lat, self.lng = GeocodeFetcher.fetch_from_address(address)
            // $gcode->lat = 0.0;
            // $gcode->lat = 0.0;
        }
    }

    // private function addToCallingList()
    // {
    //     $condition = [
    //         'where' => [
    //             ['contact_id', $this->id],
    //             ['archived', false],
    //         ],
    //     ];

    //     if (\Model_Calling::find('first', $condition))
    //     {
    //         $calling = new \Model_Calling(['contact_id' => $this->id]);
    //         $calling->save();
    //     }
    // }
}
