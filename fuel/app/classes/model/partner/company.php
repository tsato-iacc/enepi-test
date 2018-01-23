<?php

class Model_Partner_Company extends \Orm\Model
{
    protected static $_table_name = 'partner_companies';

    protected static $_properties = [
        'id',
        'company_name',
        'email',
        'encrypted_password',
        'salt',
        'encrypted_password_reset_token',
        'password_reset_token_salt',
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

    protected static $_has_one = [
        'company' => [
            'key_to' => 'partner_company_id',
        ],
    ];

    protected static $_has_many = [
        'emails' => [
            'model_to' => 'Model_Partner_Email',
            'key_to' => 'company_id',
        ],
    ];

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object
     */
    public static function validate($partner_company = null)
    {
        $val = \Validation::forge();
        $val->add_callable('AddValidation');

        if ($partner_company === null)
            return $val;

        $val->add_field('partner_company.company_name', 'partner_company.company_name', 'required|max_length[50]');
        $val->add_field('partner_company.email', 'partner_company.email', 'required|valid_email');

        $val->add('company.tel', 'tel')->add_rule('required')->add_rule('match_pattern', '/^\d{2,3}[\s.-]?\d{4}[\s.-]?\d{4}$/')->add_rule('unique', 'lpgas_companies.tel', $partner_company->company->id);
        $val->add('company.fax', 'fax')->add_rule('match_pattern', '/^\d{2,3}[\s.-]?\d{4}[\s.-]?\d{4}$/');
        $val->add_field('company.homepage', 'homepage', 'max_length[120]');
        $val->add_field('company.display_name', 'display_name', 'max_length[50]');

        $val->add_field('company.zip_code', 'zip_code', 'required');
        $val->add_field('company.prefecture_code', 'prefecture_code', 'required|numeric_between[1,47]');
        $val->add_field('company.address', 'address', 'required');
        
        // FIX ME Add number validation for array
        $val->add('company_features', 'features');

        $val->add_field('company.default_contracted_commission_s', 'default_contracted_commission_s', 'required|valid_string[numeric]');
        $val->add_field('company.default_contracted_commission_w', 'default_contracted_commission_w', 'required|valid_string[numeric]');
        $val->add_field('company.default_contracted_commission_sw', 'default_contracted_commission_sw', 'required|valid_string[numeric]');

        $val->add('company.established_date', 'established_date')->add_rule('required')->add_rule('match_pattern', '/^\d{4}[\s.-]\d{2}[\s.-]\d{2}$/');
        // $val->add_field('company.established_date', 'established_date', 'required|match_pattern[/^\d{4}[\s./]\d{2}[\s./]\d{2}$/]');
        $val->add_field('company.capital', 'capital', 'valid_string[numeric]');
        $val->add_field('company.group_company_text', 'group_company_text', 'max_length[100]');
        $val->add_field('company.amount_of_sales', 'amount_of_sales', 'valid_string[numeric]');
        $val->add_field('company.number_of_employee', 'number_of_employee', 'valid_string[numeric]');

        $val->add_field('company.supply_area_text', 'supply_area_text', 'max_length[5000]');
        $val->add_field('company.company_overview', 'company_overview', 'max_length[5000]');
        $val->add_field('company.business_overview', 'business_overview', 'max_length[5000]');
        
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
            $password = \Str::random('hexdec', 16);
            $password_reset_token = \Str::random('hexdec', 16);

            $this->salt = \Str::random('sha1');
            $this->password_reset_token_salt = \Str::random('sha1');

            $this->encrypted_password = sha1("--{$this->salt}--{$password}--");
            $this->encrypted_password_reset_token = sha1("--{$this->password_reset_token_salt}--{$password_reset_token}--");
        }

        if ($result = parent::save($cascade, $use_transaction))
            $this->sendMailWithPassword();

        return $result;
    }

    // FIX ME
    private function sendMailWithPassword()
    {

    }

    public function getEmails()
    {
        $emails = [];
        $emails[] = $this->email;

        return $emails + \Arr::pluck($this->emails, 'email');
         
    }
}
