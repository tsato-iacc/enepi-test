<?php

class Model_SimpleSimulation extends \Orm\Model
{
    protected static $_table_name = 'lpgas_simple_simulations';

    protected static $_properties = [
        'id',
        'prefecture_code',
        'city_code',
        'household',
        'amount_billed',
        'month',
        // 'created_at',
        // 'updated_at',
    ];

    protected static $_observers = [
        // 'Orm\\Observer_CreatedAt' => [
        //     'events' => ['before_insert'],
        //     'mysql_timestamp' => true,
        // ],
        // 'Orm\\Observer_UpdatedAt' => [
        //     'events' => ['before_update'],
        //     'mysql_timestamp' => true,
        // ],
        'Orm\\Observer_Typing'
    ];
}
