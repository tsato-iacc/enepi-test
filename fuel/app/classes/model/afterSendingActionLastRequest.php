<?php

class Model_AfterSendingActionLastRequest extends \Orm\Model
{
    protected static $_table_name = 'lpgas_after_sending_action_last_requests';

    protected static $_properties = [
        'id',
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
