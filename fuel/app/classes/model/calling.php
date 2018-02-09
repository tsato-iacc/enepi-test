<?php

class Model_Calling extends \Orm\Model
{
    protected static $_table_name = 'lpgas_callings';

    protected static $_properties = [
        'id',
        'contact_id',
        'archived' => [
            'default' => false,
        ],
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

    protected static $_conditions = [
        'order_by' => ['id' => 'desc'],
    ];

    protected static $_belongs_to = [
        'contact',
    ];

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object
     */
    public static function validate()
    {
        $val = Validation::forge();
        
        return $val;
    }

    public static function add(&$contact)
    {
        if (\Model_Calling::find('first', ['where' => [['contact_id' => $contact->id],['archived' => 0]]]))
            return;

        $call = new \Model_Calling(['contact_id' => $contact->id]);
        $call->save();
    }
}
