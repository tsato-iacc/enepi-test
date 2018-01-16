<?php

class Model_Calling extends \Orm\Model
{
    protected static $_table_name = 'lpgas_callings';

    protected static $_properties = [
        'id',
        'contact_id',
        'archived' => [
            'default' => false,
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
        'contact',
    ];

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object
     */
    public static function validate()
    {
        $val = Validation::forge();

        // $val->add_field('partner_company.company_name', 'partner_company.company_name', 'required|max_length[50]');
        // $val->add_field('partner_company.email', 'partner_company.email', 'required|valid_email');

        // $val->add('company.tel', 'tel')->add_rule('required')->add_rule('match_pattern', '/^\d{2,3}[\s.-]?\d{4}[\s.-]?\d{4}$/')->add_rule('unique', 'lpgas_companies.tel', $partner_company->company->id);
        // $val->add('company.fax', 'fax')->add_rule('match_pattern', '/^\d{2,3}[\s.-]?\d{4}[\s.-]?\d{4}$/');
        // $val->add_field('company.homepage', 'homepage', 'max_length[120]');
        // $val->add_field('company.display_name', 'display_name', 'max_length[50]');

        // $val->add_field('company.zip_code', 'zip_code', 'required');
        // $val->add_field('company.prefecture_code', 'prefecture_code', 'required|numeric_between[1,47]');
        // $val->add_field('company.address', 'address', 'required');
        
        // // FIX ME Add number validation for array
        // $val->add('company_features', 'features');

        // $val->add_field('company.default_contracted_commission_s', 'default_contracted_commission_s', 'required|valid_string[numeric]');
        // $val->add_field('company.default_contracted_commission_w', 'default_contracted_commission_w', 'required|valid_string[numeric]');
        // $val->add_field('company.default_contracted_commission_sw', 'default_contracted_commission_sw', 'required|valid_string[numeric]');

        // $val->add('company.established_date', 'established_date')->add_rule('required')->add_rule('match_pattern', '/^\d{4}[\s.-]\d{2}[\s.-]\d{2}$/');
        // // $val->add_field('company.established_date', 'established_date', 'required|match_pattern[/^\d{4}[\s./]\d{2}[\s./]\d{2}$/]');
        // $val->add_field('company.capital', 'capital', 'valid_string[numeric]');
        // $val->add_field('company.group_company_text', 'group_company_text', 'max_length[100]');
        // $val->add_field('company.amount_of_sales', 'amount_of_sales', 'valid_string[numeric]');
        // $val->add_field('company.number_of_employee', 'number_of_employee', 'valid_string[numeric]');

        // $val->add_field('company.supply_area_text', 'supply_area_text', 'max_length[5000]');
        // $val->add_field('company.company_overview', 'company_overview', 'max_length[5000]');
        // $val->add_field('company.business_overview', 'business_overview', 'max_length[5000]');
        
        return $val;
    }
}
