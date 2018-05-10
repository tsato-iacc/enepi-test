<?php

class Model_Company_Ng extends \Orm\Model
{
    protected static $_table_name = 'lpgas_ng_companies';

    protected static $_properties = [
        'id',
        'company_id',
        'pattern',
        'list_type',
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
