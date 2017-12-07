<?php

/**
 * class Lpgas::CompanyServiceFeature
 */
class Model_Company_ServiceFeature extends \Orm\Model
{
    protected static $_table_name = 'lpgas_company_service_features';

    protected static $_properties = [
        'id',
        'company_id',
        'title',
        'body',
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
