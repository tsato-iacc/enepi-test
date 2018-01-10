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
        'supply_area_text',
        'lpgas_company_logo',
        'lpgas_company_image',
        'estimate_req_sendable',
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
        'estimates'  => [
            'model_to' => 'Model_Estimate',
            'key_from' => 'partner_company_id',
            'key_to' => 'company_id',
        ],
    ];

    protected static $_has_many = [
        'ng_companies' => [
            'model_to' => 'Model_NgCompany',
        ],
        'geocodes' => [
            'model_to' => 'Model_Company_Geocode',
        ],
        'offices' => [
            'model_to' => 'Model_Company_Office',
        ],
        'service_features' => [
            'model_to' => 'Model_Company_ServiceFeature',
        ],
    ];

    protected static $_many_many = [
        // 'features' => [
        //     'table_through' => 'lpgas_company_features',
        // ]
    ];
}
