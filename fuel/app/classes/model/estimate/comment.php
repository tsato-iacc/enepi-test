<?php

/**
 * class Lpgas::EstimateComment
 */
class Model_Estimate_Comment extends \Orm\Model
{
    protected static $_table_name = 'lpgas_estimate_comments';

    protected static $_properties = [
        'id',
        'estimate_id',
        'estimate_change_log_id',
        'comment',
        'created_at',
        'updated_at'
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

    protected static $_belongs_to = [
        'estimate',
        'history' => [
            'model_to' => 'Model_Estimate_History',
            'key_from' => 'estimate_change_log_id',
        ],
    ];
}
