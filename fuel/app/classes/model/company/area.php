<?php

/**
 * class Lpgas::CompanyGeocode
 */
class Model_Company_Area extends \Orm\Model
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
}
