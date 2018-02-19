<?php

class Model_AdminUser extends \Orm\Model
{
    const ADMIN = 1;
    const MODERATOR = 2;
    const BANNED = 6;

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
        'role',
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

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object
     */
    public static function validate($user = null)
    {
        $val = Validation::forge();
        $val->add_callable('AddValidation');

        if ($user === null)
            return $val;

        $val->add('email', 'email')->add_rule('required')->add_rule('match_pattern', '/\A[\w+\-.]+@iacc\.co\.jp/i')->add_rule('unique', 'admin_users.email', $user->id);
        
        return $val;
    }

    public function isAdmin()
    {
        return $this->role == self::ADMIN;
    }
}
