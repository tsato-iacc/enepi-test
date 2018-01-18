<?php

class Model_Company extends \Orm\Model
{
    protected static $_table_name = 'lpgas_companies';

    protected static $_properties = [
        'id',
        'partner_company_id',
        'display_name',
        'tel',
        'fax',
        'prefecture_code',
        'zip_code',
        'address',
        'default_contracted_commission_s',
        'default_contracted_commission_w',
        'default_contracted_commission_sw',
        'capital',
        'amount_of_sales',
        'number_of_employee',
        'homepage',
        'group_company_text',
        'company_overview',
        'business_overview',
        'service_features',
        'supply_area_text' => [
            'default' => '',
        ],
        'lpgas_company_logo',
        'lpgas_company_image',
        'estimate_req_sendable' => [
            'default' => true,
        ],
        'established_date',
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
        'partner_company' => [
            'model_to' => 'Model_Partner_Company'
        ],
    ];

    protected static $_has_many = [
        'ng_companies' => [
            'model_to' => 'Model_NgCompany',
        ],
        'geocodes' => [
            'model_to' => 'Model_Company_Geocode',
        ],
        'estimates',
        'offices' => [
            'model_to' => 'Model_Company_Office',
        ],
        'service_features' => [
            'model_to' => 'Model_Company_ServiceFeature',
        ],
    ];

    protected static $_many_many = [
        'features' => [
            'model_to' => 'Model_Company_Feature',
            'key_through_from' => 'company_id',
            'key_through_to' => 'master_company_feature_id',
            'table_through' => 'lpgas_company_features',
        ]
    ];

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object
     */
    public static function validate()
    {
        $val = Validation::forge();
        
        return $val;
    }

    /**
     * View methods
     */
    public static function getFormList()
    {
        $list = [];
        
        foreach (\Model_Company::find('all', ['related' => ['partner_company']]) as $company)
        {
            $list[$company->id] = $company->display_name ? $company->display_name : $company->partner_company->company_name;
        }

        return $list;
    }
}
