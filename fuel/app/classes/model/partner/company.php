<?php

class Model_Partner_Company extends \Orm\Model
{
    protected static $_table_name = 'partner_companies';

    protected static $_properties = [
        'id',
        'company_name',
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

    protected static $_has_one = [
        'company' => [
            'key_to' => 'partner_company_id',
        ],
    ];

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object
     */
    public static function validate($tracking = null, $factory = null)
    {
        $val = ValidateReplacer::forge();
        $val->add_callable('AddValidation');

        if ($tracking === null)
            return $val;

        // $val->add('name', 'name')->add_rule('required')->add_rule('match_pattern', '/\A[a-z0-9_\-]*\z/')->add_rule('unique', 'pr_tracking_parameters.name', $tracking->id);

        // $val->add_field('cv_point', 'cv_point', 'required|match_collection[estimate,verbal_ok]');
        // $val->add_field('conversion_tag', 'conversion_tag', 'max_length[5000]');
        // $val->add_field('render_conversion_tag_only_if_match', 'render_conversion_tag_only_if_match', 'match_value[1]');
        // $val->add_field('auto_sendable', 'auto_sendable', 'match_value[1]');
        
        return $val;
    }
}
