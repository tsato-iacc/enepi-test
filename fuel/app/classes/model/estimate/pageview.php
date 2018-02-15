<?php

/**
 * class Lpgas::EstimateUserPageView
 */
class Model_Estimate_PageView extends \Orm\Model
{
    protected static $_table_name = 'lpgas_estimate_user_page_views';

    protected static $_properties = [
        'id',
        'contact_id',
        'estimate_id',
        'user_agent',
        'ip_address',
        'session_id',
        'referrer',
        'terminal',
        'authorized',
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
}
