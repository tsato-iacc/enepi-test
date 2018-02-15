<?php

class Model_AdminBatchEstimatePrice extends \Orm\Model
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
}
