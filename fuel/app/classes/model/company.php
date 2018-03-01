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
        'ng' => [
            'model_to' => 'Model_Company_Ng',
        ],
        'geocodes' => [
            'model_to' => 'Model_Company_Geocode',
        ],
        'estimates',
        'offices' => [
            'model_to' => 'Model_Company_Office',
        ],
        'company_service_features' => [
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

    private $_company_name = null;

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

    public function getCompanyName()
    {
        if ($this->_company_name === null)
        {
            if ($this->display_name)
            {
                $this->_company_name = $this->display_name;
            }
            else
            {
                $this->_company_name = $this->partner_company->company_name;
            }
        }

        return $this->_company_name;
    }

    public function getHeadOffice()
    {
        return \Model_Company_Geocode::find('first', ['where' => [['company_id', $this->id], ['company_office_id', null]]]);
    }

    public function getCommission(&$contact)
    {
        if ($contact->house_kind == \Config::get('models.house_kind.detached'))
        {
            if ($contact->using_cooking_stove && $contact->using_bath_heater_with_gas_hot_water_supply)
                return $this->default_contracted_commission_sw;
            
            if ($contact->using_cooking_stove && !$contact->using_bath_heater_with_gas_hot_water_supply)
                return $this->default_contracted_commission_s;

            if (!$contact->using_cooking_stove && $contact->using_bath_heater_with_gas_hot_water_supply)
                return $this->default_contracted_commission_w;
        }

        return null;
    }

    public function getNearestGeocode(&$contact)
    {
        $geocodes = \Model_Company_Geocode::find('all', [
            'where' => [
                ['company_id', $this->id]
            ],
            'related' => [
                'zip_codes' => [
                    'where' => [
                        ['zip_code', $contact->getZipCode()],
                    ],
                ],
            ],
        ]);

        return $geocodes ? array_shift($geocodes) : null;
    }

    public function isNgCompany(&$company_name)
    {
        if ($company_name)
        {
            if ($this->get('ng', ['where' => [['pattern', 'like', "%{$company_name}%"]]]))
                return true;
        }

        return false;
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
