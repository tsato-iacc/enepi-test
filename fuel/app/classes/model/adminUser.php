<?php

class Model_AdminUser extends \Orm\Model
{
    protected static $_table_name = 'admin_users';

    protected static $_properties = [
        'id',
        'email',
        'encrypted_password',
        'salt',
        'encrypted_password_reset_token',
        'password_reset_token_salt',
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
