<?php

class Model_Slot extends \Orm\Model
{
    protected static $_table_name = 'batch_estimate_prices';

    protected static $_properties = [
        'id',
        'estimate_id',
        'subject',
        'price',
        'estimate_created_at',
        'created_at',
    ];

    protected static $_observers = [
        'Orm\\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'mysql_timestamp' => true,
        ],
        'Orm\\Observer_Typing'
    ];

    public static function getSlots()
    {
        return \Model_Slot::find('all', [
            'order_by' => [
                'estimate_created_at' => 'desc'
            ],
            'limit' => \Config::get('enepi.slot.estimate_limit'),
        ]);
    }
}
