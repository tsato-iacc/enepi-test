<?php

class Model_CallingHistory extends \Orm\Model
{
    protected static $_table_name = 'lpgas_calling_histories';

    protected static $_properties = [
        'id',
        'contact_id',
        'admin_user_id',
        'calling_method',
        'note',
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

    protected static $_belongs_to = [
        'contact',
        'admin_user',
    ];

    // protected static $_has_many = [
    //     'estimates',
    // ];
    
    /**
     * View functions
     */
    public function oneLineString()
    {
        $date = \Helper\TimezoneConverter::convertFromString($this->created_at, 'admin_call_history');
        $method = \Config::get('views.calling_history.calling_method.'.$this->calling_method);

        return $date . " " . __('admin.calling_history.calling_method.'.$method);
    }
}
