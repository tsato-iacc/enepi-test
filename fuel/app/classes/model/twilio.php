<?php

/**
 * class SmsLog
 */
class Model_Twilio extends \Orm\Model
{
    protected static $_table_name = 'sms_logs';

    protected static $_properties = [
        'id',
        'lpgas_contact_id',
        'cannonical_to',
        'to',
        'from',
        'body',
        'result',
        'sid',
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
        'contact' => [
            'key_from' => 'lpgas_contact_id',
        ],
    ];
}
