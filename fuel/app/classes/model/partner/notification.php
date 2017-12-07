<?php

/**
 * class Lpgas::CompanyNotificationEmail
 */
class Model_Partner_Notification extends \Orm\Model
{
    protected static $_table_name = 'partner_company_notification_emails';

    protected static $_properties = [
        'id',
        'company_id',
        'email',
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
        'company',
    ];
}
