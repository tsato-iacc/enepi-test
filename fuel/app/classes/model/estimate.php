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
        'estimate' => [
            'model_to' => 'Model_Contact',
            'key_from' => 'contact_id',
            'key_to' => 'id',
        ],
    ];

    protected static $_has_many = [
        'comments' => [
            'model_to' => 'Model_Estimate_Comment',
        ],
        'estimate_history' => [
            'model_to' => 'Model_Estimate_History',
        ],
        'prices' => [
            'model_to' => 'Model_Estimate_Price',
        ],
//         'companies'  => [
//             'model_to' => 'Model_Company',
//             'key_from' => 'company_id',
//             'key_to' => 'partner_company_id',
//         ],
    ];

    protected static $_has_one = [
        'company'  => [
            'model_to' => 'Model_Company',
            'key_to' => 'id',
            'key_from' => 'company_id',
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
        $result = false;
        // FIX ME
        // before_update { self.status_updated_at = Time.now if status_changed? }

        if ($this->is_new())
        {
            $this->uuid = \Str::random('uuid');
            $this->status_updated_at = \Date::time()->format('mysql_date_time');

            if ($result = parent::save($cascade, $use_transaction))
            {
                // FIX ME (move to package?)
                // \Package::load('email');
                // $email = \Email::forge();
                // $email->to(\Config::get('enepi.company.email'), \Config::get('enepi.company.service_name'));
                // $email->subject("紹介");
                // $email->html_body(\View::forge('email/admin/companyIntroduction', ['estimate' => $this]));
                // $email->send();
            }
        }
        else
        {
            $result = parent::save($cascade, $use_transaction);
            // FIX ME
            // after_save :update_contact_status // $this->updateContactStatus();
            // after_save { contact.add_to_callings if (sent_estimate_to_user? || verbal_ok?) && !auto? }
            // after_save :log_changes, if: -> { changed? }
        }

        return $result;
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

            $a = 1.0 / $pref_model[$contact->gas_meter_checked_month];

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

    public function cancel($admin_id, $status_reason)
    {
        $reason_val = \Helper\CancelReasons::getValueByName($status_reason);
        
        if ($this->status != \Config::get('models.estimate.status.cancelled') && $this->status != \Config::get('models.estimate.status.contracted') && $reason_val !== null)
        {
            $this->last_update_admin_user_id = $admin_id;
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
                    $this->contact->save();
                }

                $this->hasVerbal() ? \Helper\Notifier::notifyCompanyEstimateCancel($this) : \Helper\Notifier::notifyAdminEstimateCancel($this);

                return true;
            }
        }
        
        return false;
    }

    // 送客 ok_tentatively
    public function introduce($admin_id)
    {
        if ($this->status == \Config::get('models.estimate.status.sent_estimate_to_user'))
        {
            $this->last_update_admin_user_id = $admin_id;
            $this->status = \Config::get('models.estimate.status.verbal_ok');

            if ($this->save())
            {
                $this->contact->status = \Config::get('models.contact.status.verbal_ok');
                $this->contact->save();

                \Helper\Notifier::notifyCustomerIntroduce($this);
                \Helper\Notifier::notifyCompanyIntroduce($this);
                \Helper\Notifier::notifyAdminIntroduce($this);

                return true;
            }
        }
        
        return false;
    }

    // 送客 send_to_user
    public function present($admin_id)
    {
        if ($this->status == \Config::get('models.estimate.status.pending') || $this->status == \Config::get('models.estimate.status.sent_estimate_to_iacc'))
        {
            $this->last_update_admin_user_id = $admin_id;
            $this->status = \Config::get('models.estimate.status.sent_estimate_to_user');

            if ($this->save())
            {
                // CHECK ME
                \Helper\Notifier::notifyCustomerPresent($this);
                \Helper\Notifier::notifyAdminPresent($this);
                \Helper\Notifier::notifyCustomerPin($this->contact);

                return true;
            }
        }
        
        return false;
    }

    /**
     * View methods
     */
    public function getIntroduceDate()
    {
        if ($history = $this->estimate_history)
        {
            $introduce_arr = [];

            foreach ($history as $h)
            {
                if (isset($h->diff_json->status) && $h->diff_json->status->new == 'verbal_ok')
                {
                    $introduce_arr[] = $h->created_at;
                }
            }

            if ($introduce_arr)
            {
                $last = end($introduce_arr);
                
                return \Helper\TimezoneConverter::convertFromString($last, 'admin_table');
            }
        }

        return '-';
    }

    public function isExpired()
    {
        // CHECK ME
        return $this->expired_at && \Date::create_from_string($this->expired_at, 'mysql_date_time') <= \Date::forge();
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

    // through_verbal_ok
    private function hasVerbal()
    {
        if ($history = $this->estimate_history)
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

    // update_contact_status
    // private function updateContactStatus()
    // {

    // }
}
