<?php

/**
 * class Lpgas::CompanyOffice
 */
class Model_Company_Office extends \Orm\Model
{
    protected static $_table_name = 'lpgas_company_offices';

    protected static $_properties = [
        'id',
        'company_id',
        'prefecture_code',
        'zip_code',
        'address',
    ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];

    protected static $_has_one = [
        'geocode' => [
            'model_to' => 'Model_Company_Geocode',
        ],
    ];
}
