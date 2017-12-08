<?php

/**
 * class PrTrackingParameterChangeLog
 */
class Model_Tracking_History extends \Orm\Model
{
    protected static $_table_name = 'lpgas_estimate_change_logs';

    protected static $_properties = [
        'id',
        'estimate_id',
        'admin_user_id',
        'partner_company_id',
        'user_id',
        'diff_json',
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
        'tracking',
        'admin_user',
    ];
}
