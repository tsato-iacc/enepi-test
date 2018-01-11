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
        // 'deleted_at',
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

    /**
     * Wrapper for save model
     * @param  [type]  $cascade         [description]
     * @param  boolean $use_transaction [description]
     * @return bool                     Return parrent result
     */
    public function save($cascade = null, $use_transaction = false)
    {
        if ($this->is_new())
        {
            $password = \Str::random('hexdec', 16);
            $password_reset_token = \Str::random('hexdec', 16);

            $this->salt = \Str::random('sha1');
            $this->password_reset_token_salt = \Str::random('sha1');

            $this->encrypted_password = sha1("--{$this->salt}--{$password}--");
            $this->encrypted_password_reset_token = sha1("--{$this->password_reset_token_salt}--{$password_reset_token}--");
        }

        if ($result = parent::save($cascade, $use_transaction))
            $this->sendMailWithPassword();

        return $result;
    }

    private function sendMailWithPassword()
    {
        
    }
}
