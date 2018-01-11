<?php

/**
 * class PrTrackingParameterChangeLog
 */
class Model_Tracking_History extends \Orm\Model
{
    protected static $_table_name = 'pr_tracking_parameter_change_logs';

    protected static $_properties = [
        'id',
        'admin_user_id',
        'pr_tracking_parameter_id',
        'diff_json',
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

    protected static $_belongs_to = [
        'tracking' => [
            'key_from' => 'pr_tracking_parameter_id',
        ],
        'admin_user' => [
            'model_to' => 'Model_AdminUser',
            'key_from' => 'admin_user_id',
        ],
    ];
}
