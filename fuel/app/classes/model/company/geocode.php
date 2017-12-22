<?php

/**
 * class Lpgas::CompanyGeocode
 */
class Model_Company_Geocode extends \Orm\Model
{
    protected static $_table_name = 'lpgas_company_geocodes';

    protected static $_properties = [
        'id',
        'company_id',
        'company_office_id',
        'lat',
        'lng',
        'address',
    ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];

    protected static $_has_many = [
        'zip_codes' => [
            'model_to' => 'Model_Company_GeocodeZipCode',
        ],
        'price_rules' => [
            'model_to' => 'Model_PriceRule',
        ],
    ];
}
