<?php

/**
 * class Model_Customer_Template
 */
class Model_Customer_Log extends \Orm\Model
{
    protected static $_table_name = 'customer_mail_logs';

    protected static $_properties = [
        'id',
        'admin_id',
        'contact_id',
        'email',
        'subject',
        'body',
        'send_status',
        'created_at',
    ];

    protected static $_observers = [
        'Orm\\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'mysql_timestamp' => true,
        ],
    ];
}
