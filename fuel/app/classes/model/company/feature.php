<?php

/**
 * class Lpgas::CompanyFeature
 */
class Model_Company_Feature extends \Orm\Model
{
    protected static $_table_name = 'lpgas_master_company_features';

    protected static $_properties = [
        'id',
        'name',
        'description',
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
