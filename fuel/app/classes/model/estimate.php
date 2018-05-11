<?php

class Model_Estimate extends \Orm\Model
{
    protected static $_table_name = 'lpgas_estimates';

    protected static $_properties = [
        'id',
        'uuid',
        'contact_id',
        'company_id',
        'status' => [
            'default' => 0,
        ],
        'status_updated_at',
        'status_reason' => [
            'default' => 0,
        ],
        'contracted_commission',
        'basic_price',
        'unit_price',
        'fuel_adjustment_cost',
        'notes',
        'set_plan',
        'other_set_plan',
        'expired_at',
        'construction_scheduled_date',
        'construction_finished_date',
        'visit_scheduled_date',
        'last_update_admin_user_id',
        'last_update_partner_company_id',
        'last_update_user_id',
        'auto' => [
            'default' => false,
        ],
        'contacted' => [
            'default' => false,
        ],
        'visited' => [
            'default' => false,
        ],
        'power_of_attorney_acquired' => [
            'default' => false,
        ],
        'company_contact_name',
        'preferred_contact_time',
        'is_read' => [
            'default' => 0,
        ],
        'created_at',
        'updated_at',
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
        'company',
        'contact',
    ];

    protected static $_has_many = [
        'comments' => [
            'model_to' => 'Model_Estimate_Comment',
        ],
        'prices' => [
            'model_to' => 'Model_Estimate_Price',
            'cascade_delete' => true,
        ],
        'histories' => [
            'model_to' => 'Model_Estimate_History',
        ],
    ];

    private $_savings_by_month = null;

    /**
     * Wrapper for save model
     * @param  [type]  $cascade         [description]
     * @param  boolean $use_transaction [description]
     * @return bool                     Return parrent result
     */
    public function save($cascade = null, $use_transaction = false)
    {
        if ($this->is_new())
        {
            $this->uuid = \Str::random('uuid');
            $this->status_updated_at = \Date::time()->format('mysql_date_time');
        }

        if ($this->is_changed('status'))
        {
            $this->status_updated_at = \Date::time()->format('mysql_date_time');
        }

        // Detect if model was changed
        $this->detectChanges();

        return parent::save($cascade, $use_transaction);
    }

    // FIX ME
    // public function delete()
    // {
    //     // after_destroy :update_contact_status_on_destroy
    // }

    public function savings_by_month(&$contact)
    {
        if (!$this->basic_price)
            return null;

        if ($this->_savings_by_month === null)
        {
            $savings_by_month = [];

            $pref_model = Simulation::getUsedAmount($contact->getPrefectureCode());

            if ($contact->gas_meter_checked_month && isset($pref_model[$contact->gas_meter_checked_month]))
            {
                $a = 1.0 / $pref_model[$contact->gas_meter_checked_month];
            }
            else
            {
                $a = 1.0;
            }

            foreach(range(1, 12) as $month)
            {
                $used_amount = $contact->gas_used_amount * $a * $pref_model[$month];

                $savings_by_month[$month] = [
                    'used_amount' => $used_amount,
                    'before_price' => round($contact->basicPrice() + $contact->unitPrice() * $used_amount, 0),
                    'after_price' => round($this->basic_price + $this->calculateDemandCost($used_amount), 0),
                ];
            }

            $this->_savings_by_month = $savings_by_month;
        }

        return $this->_savings_by_month;
    }

    public function total_savings_in_year(&$contact)
    {
        $savings_by_month = $this->savings_by_month($contact);

        if (!$savings_by_month)
            return null;

        $sum = 0;

        foreach ($savings_by_month as $month)
        {
            $sum += $month['before_price'] - $month['after_price'];
        }

        return $sum;
    }

    public function cancel(&$auth_user, $status_reason = null)
    {
        $reason_val = $status_reason ? \Helper\CancelReasons::getValueByName($status_reason) : 0;

        if ($this->status != \Config::get('models.estimate.status.cancelled') && $this->status != \Config::get('models.estimate.status.contracted') && $reason_val !== null)
        {
            if ($auth_user instanceof \Model_AdminUser)
            {
                $this->last_update_admin_user_id = $auth_user->id;
            }
            else if ($auth_user instanceof \Model_Partner_Company)
            {
                $this->last_update_partner_company_id = $auth_user->id;
            }

            $this->status_reason = $reason_val;
            $this->status = \Config::get('models.estimate.status.cancelled');

            if ($this->save())
            {
                // 全ての見積りがキャンセルだったら、問い合わせもキャンセルに
                $statuses = \Arr::pluck($this->contact->estimates, 'status');

                if (count(array_unique($statuses)) === 1 && end($statuses) === \Config::get('models.estimate.status.cancelled'))
                {
                    $this->contact->status = \Config::get('models.contact.status.cancelled');
                    $this->contact->user_status = \Config::get('models.contact.user_status.no_action');
                    $this->status_reason = $status_reason;
                    $this->contact->save();
                }

                if ($this->hasVerbal())
                {
                    if ($auth_user instanceof \Model_AdminUser)
                    {
                        \Helper\Notifier::notifyCompanyEstimateCancelByAdmin($this);
                    }
                    else if ($auth_user instanceof \Model_Partner_Company)
                    {
                        \Helper\Notifier::notifyCompanyEstimateCancel($this);
                    }
                }

                \Helper\Notifier::notifyAdminEstimateCancel($this);

                return true;
            }
        }

        return false;
    }

    // 送客 ok_tentatively
    public function introduce($admin_id = null, $partner_id = null, $user_id = null)
    {
        if ($this->status == \Config::get('models.estimate.status.sent_estimate_to_user'))
        {
            if ($admin_id)
                $this->last_update_admin_user_id = $admin_id;

            if ($partner_id)
                $this->last_update_partner_company_id = $partner_id;

            if ($admin_id)
                $this->last_update_user_id = $user_id;

            $this->status = \Config::get('models.estimate.status.verbal_ok');

            if ($this->save())
            {
                \Helper\Notifier::notifyCustomerIntroduce($this);
                \Helper\Notifier::notifyCompanyIntroduce($this);
                \Helper\Notifier::notifyAdminIntroduce($this);

                return true;
            }
        }

        return false;
    }

    // 紹介 send_to_user
    public function present($admin_id, $change_status = true)
    {
        if ($this->status == \Config::get('models.estimate.status.pending') || $this->status == \Config::get('models.estimate.status.sent_estimate_to_iacc'))
        {
            $this->last_update_admin_user_id = $admin_id;
            $this->status = $change_status ? \Config::get('models.estimate.status.sent_estimate_to_user') : \Config::get('models.estimate.status.pending');

            if ($this->save())
            {
                $contact = $this->contact;

                if ($change_status)
                {
                    // Add to calling again if arhived
                    \Model_Calling::add($contact);

                    \Helper\Notifier::notifyCustomerPresent($this);
                    \Helper\Notifier::notifyAdminPresentContact($this);
                    \Helper\Notifier::notifyAdminPresentEstimate($this);
                }
                else
                {
                    \Helper\Notifier::notifyAdminPrePresent($this);
                }

                if ($change_status && $contact->status == \Config::get('models.contact.status.pending'))
                {
                    $contact->status = \Config::get('models.contact.status.sent_estimate_req');

                    if ($contact->save())
                    {
                        \Helper\Twilio::notifyCustomerPin($contact);
                    }
                }

                return true;
            }
        }

        return false;
    }

    public function setCompanyPriceRule(&$contact)
    {
        $nearest_geocode = $this->company->getNearestGeocode($contact);

        if (!$nearest_geocode)
            return false;

        $price_rule = \Model_PriceRule::find('first', [
            'where' => [
                ['company_geocode_id', $nearest_geocode->id],
                ['using_cooking_stove' => $contact->using_cooking_stove],
                ['using_bath_heater_with_gas_hot_water_supply' => $contact->using_bath_heater_with_gas_hot_water_supply],
                ['using_other_gas_machine' => $contact->using_other_gas_machine],
                ['house_kind' => $contact->house_kind],
            ]
        ]);

        if ($price_rule)
        {
            $this->set([
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

            $this->prices = $estimate_prices;
        }

        return true;
    }

    /**
     * View methods
     * Don't use permanently
     */
    // public function getIntroduceDate()
    // {
    //     if ($history = $this->histories)
    //     {
    //         $introduce_arr = [];

    //         foreach ($history as $h)
    //         {
    //             if (isset($h->diff_json->status) && $h->diff_json->status->new == 'verbal_ok')
    //             {
    //                 $introduce_arr[] = $h->created_at;
    //             }
    //         }

    //         if ($introduce_arr)
    //         {
    //             $last = end($introduce_arr);

    //             return \Helper\TimezoneConverter::convertFromString($last, 'admin_table');
    //         }
    //     }

    //     return '-';
    // }

    public function isExpired()
    {
        // CHECK ME
        return $this->expired_at && \Date::create_from_string($this->expired_at, 'mysql_date_time') <= \Date::forge();
    }

    public function ondemand_cost_math_exprs($contact)
    {
        $exprs = [];
        $count = 0;

        $u = $contact->gas_used_amount;

        foreach ($this->prices as $price)
        {
            $delta = $price->upper_limit - $price->under_limit;

            if (!$price->upper_limit || $u <= $delta)
            {
                $exprs[$count] = [$price->unit_price, $u];
                break;
            }
            else
            {
                $u -= $delta;
                $exprs[$count] = [$price->unit_price, $u];
            }

            $count++;
        }

        return $exprs;
    }

    public function progress()
    {
        if ($this->construction_finished_date)
            return __('admin.estimate.progress.construction_finished_date');

        if ($this->construction_scheduled_date)
            return __('admin.estimate.progress.construction_scheduled_date');

        if ($this->power_of_attorney_acquired)
            return __('admin.estimate.progress.power_of_attorney_acquired');

        if ($this->visited)
            return __('admin.estimate.progress.visited');

        if ($this->contacted)
            return __('admin.estimate.progress.contacted');

        return __('admin.estimate.progress.unknown');
    }

    /**
     * Private methods
     */
    private function calculateDemandCost($used_amount)
    {
        $sum = $this->fuel_adjustment_cost * $used_amount;

        $u = $used_amount;

        foreach ($this->prices as $price)
        {
            $delta = $price->upper_limit - $price->under_limit;

            if (!$price->upper_limit || $u <= $delta)
            {
                $sum += $price->unit_price * $u;
                break;
            }

            $u -= $delta;
            $sum += $price->unit_price * $delta;
        }

        return $sum;
    }

    private function detectChanges()
    {
        // Add to history if estimate changed
        $diff = $this->get_diff();

        // Reset model relations
        foreach ($diff[0] as $key => $value)
        {
            if (is_array($value))
                $diff[0][$key] = null;
        }
        foreach ($diff[1] as $key => $value)
        {
            if (is_array($value))
                $diff[1][$key] = null;
        }

        // Convert value to enum
        $diff[0] = \Helper\ModelReplacer::to_enum($this, $diff[0]);
        $diff[1] = \Helper\ModelReplacer::to_enum($this, $diff[1]);

        // Diff without value type (0 and '0' are equal)
        if ($changes = array_diff($diff[1], $diff[0]))
        {
            $prepared = [];

            foreach ($changes as $key => $value)
            {
                $prepared[$key] = [
                    'old' => $diff[0][$key],
                    'new' => $diff[1][$key],
                ];
            }

            $prepared['updated_at'] = [
                'old' => $this->updated_at ? \Date::create_from_string($this->updated_at, 'mysql_date_time')->format('mysql_json') : null,
                'new' => \Date::time()->format('mysql_json'),
            ];

            $admin_id = Eauth::instance('admin')->get('id');
            $partner_id = Eauth::instance('partner')->get('id');

            $history = new \Model_Estimate_History([
                'diff_json' => $prepared,
                'admin_user_id' => $admin_id && \Uri::segment(1) == 'admin' ? $admin_id : null,
                'partner_company_id' => $partner_id && \Uri::segment(1) == 'partner' ? $partner_id : null,
                'user_id' => isset($diff[1]['last_update_user_id']) ? $diff[1]['last_update_user_id'] : null,
            ]);

            $this->histories[] = $history;
        }
    }

    // through_verbal_ok
    private function hasVerbal()
    {
        if ($history = $this->histories)
        {
            foreach ($history as $h)
            {
                if (isset($h->diff_json->status) && $h->diff_json->status->new == 'verbal_ok')
                {
                    return true;
                }
            }
        }

        return false;
    }

    public function getStatusEst()
    {
        $status_est = '';

        if ($this->status == \Config::get('models.estimate.status.sent_estimate_to_user') || $this->status == \Config::get('models.estimate.status.verbal_ok') || $this->status == \Config::get('models.estimate.status.contracted'))
        {
            $status_est = 'ok';
        }
        elseif ($this->status == \Config::get('models.estimate.status.sent_estimate_to_iacc') || $this->status == \Config::get('models.estimate.status.pending') || $this->status == \Config::get('models.estimate.status.cancelled'))
        {
            $status_est = 'ng';
        }

        return $status_est;
    }
}
