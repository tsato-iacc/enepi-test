<?php

/**
 * class Lpgas::CompanyGeocodeZipCode
 */
class Model_Company_AreaZipCode extends \Orm\Model
{
    protected static $_table_name = 'lpgas_company_geocode_zip_codes';

    protected static $_properties = [
        'id',
        'company_geocode_id',
        'zip_code',
        'notes',
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
}
