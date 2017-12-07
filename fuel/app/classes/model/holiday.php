<?php

class Model_Holiday extends \Orm\Model
{
    protected static $_table_name = 'new_year_holidays';

    protected static $_properties = [
        'id',
        'beg_at',
        'end_at',
        'holiday_text',
        'holiday_email_contact',
        'holiday_email_estimate_ok',
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
