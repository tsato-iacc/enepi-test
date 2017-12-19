<?php

use \Helper\Email;
use \Helper\ValidateReplacer;
use \Helper\Simulation;

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
        'reason_not_auto_sendable',
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
        'tracking',
    ];

    private $_unit_price = null;

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object or null if factory is null
     */
    public static function validate($factory = null)
    {
        $val = ValidateReplacer::forge();

        $val->add_field('lpgas_contact.house_hold', 'house_hold', 'numeric_between[2,7]');
        $val->add_field('lpgas_contact.house_kind', 'house_kind', 'required|match_collection[detached,store_ex,apartment]');

        $val->add_field('lpgas_contact.using_cooking_stove', 'using_cooking_stove', 'match_value[1]');
        $val->add_field('lpgas_contact.using_bath_heater_with_gas_hot_water_supply', 'using_bath_heater_with_gas_hot_water_supply', 'match_value[1]');
        $val->add_field('lpgas_contact.using_other_gas_machine', 'using_other_gas_machine', 'match_value[1]');

        $val->add_field('lpgas_contact.name', 'name', 'required|max_length[20]');
        $val->add_field('lpgas_contact.furigana', 'furigana', 'max_length[20]');
        $val->add_field('lpgas_contact.tel', 'tel', 'required|match_pattern[/^(\d{10,11})$/]');
        $val->add_field('lpgas_contact.email', 'email', 'required|valid_email');

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

        switch ($factory)
        {
            case 'old_form':
                # code...
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
        if ($this->is_new())
        {
            $this->token = \Str::random('hexdec', 32);
            $this->pin   = \Str::random('numeric', 4);

            if ($result = parent::save($cascade, $use_transaction))
            {
                $this->try_auto_sending_estimates();
                $this->notifyAdminNewCustomer();
                $this->notifyNewCustomer();
            }

            return $result;
        }
        else
        {
            return parent::save($cascade, $use_transaction);
        }
    }

    public function notifyAdminNewCustomer()
    {
        \Package::load('email');
        $email = \Email::forge();
        $email->to('info@enepi.jp', 'Enepi');
        $email->subject("{$this->name}様よりLPガスに関する問い合わせがありました");
        $email->html_body(\View::forge('email/notifyAdminNewCustomer', ['contact' => $this]));
        $email->send();
    }

    public function notifyNewCustomer()
    {
        \Package::load('email');
        $email = \Email::forge();
        $email->to($this->email, $this->name);
        $email->subject('お問い合わせ頂き、ありがとうございます／プロパンガス一括見積もりサービス enepi（エネピ）運営事務局');
        $email->html_body(\View::forge('email/notifyNewCustomer', ['contact' => $this]));
        $email->send();
    }

    private function try_auto_sending_estimates()
    {
        $this->unit_price();
        if (!$this->isAutoSendable())
            return;
        // print var_dump('aaa');exit;
        // $this->sent_auto_estimate_req = true;
        $this->save();

        if (false)
        {
            $this->send_sms();
        }
        else
        {
            // reasons_not_auto_sendable
        }
    }

    private function isAutoSendable()
    {
        // Test contact
        if (in_array($this->name, ['テスト', 'てすと', 'test', 'TEST']))
            return false;

        // Borrowed apartment
        if ($this->house_kind == \Config::get('models.contact.house_kind.apartment') && $this->ownership_kind == \Config::get('models.contact.ownership_kind.borrower'))
            return false;

        // Store
        if ($this->house_kind == \Config::get('models.contact.house_kind.store_ex'))
            return false;

        // Apartment owner
        if ($this->apartment_owner)
            return false;
        $this->unit_price();
    }

    private function send_sms()
    {

    }

    private function unit_price()
    {
        if ($this->_unit_price === null)
        {
            if ($this->gas_latest_billing_amount && $this->gas_used_amount)
            {
                $s = Simulation::getBasicPrice(12);
                print var_dump($v);exit;
            }
            else
            {
                $this->_unit_price = 0;
            }
        }

        

        return $this->_unit_price;
    }

    // \Config::get('enepi.taxes.jp_acquisition_tax')
}
