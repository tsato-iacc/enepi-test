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
            // after_save :update_contact_status
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
        $this->last_update_admin_user_id = $admin_id;
        $this->status_reason = $status_reason;
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

    public function getStatusColor()
    {
        $color = '';

        if ($this->status == \Config::get('models.estimate.status.pending'))
        {
            $color = 'danger';
        }
        elseif ($this->status == \Config::get('models.estimate.status.cancelled'))
        {
            $color = 'secondary';
        }
        elseif ($this->status == \Config::get('models.estimate.status.sent_estimate_to_user') || $this->status == \Config::get('models.estimate.status.sent_estimate_to_iacc'))
        {
            $color = 'warning';
        }
        elseif ($this->status == \Config::get('models.estimate.status.verbal_ok') || $this->status == \Config::get('models.estimate.status.contracted'))
        {
            $color = 'success';
        }

        return $color;
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
}
