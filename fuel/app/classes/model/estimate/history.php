<?php

/**
 * class Lpgas::EstimateChangeLog
 */
class Model_Estimate_History extends \Orm\Model
{
    protected static $_table_name = 'lpgas_estimate_change_logs';

    protected static $_properties = [
        'id',
        'estimate_id',
        'admin_user_id',
        'partner_company_id',
        'user_id',
        'diff_json' => [
            'data_type' => 'json',
            'default' => [],
        ],
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
        'admin_user',
        'partner_company',
    ];
}
