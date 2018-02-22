<?php

class Model_AfterSendingAction extends \Orm\Model
{
    protected static $_table_name = 'lpgas_after_sending_actions';

    protected static $_properties = [
        'id',
        'estimate_id',
        'estimate_change_log_id',
        'archived' => [
            'default' => 0,
        ],
        'note',
        'at',
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
        'estimate',
        'history' => [
            'model_to' => 'Model_Estimate_History',
            'key_from' => 'estimate_change_log_id',
        ],
    ];

    public static function validate($factory = null)
    {
        $val = Validation::forge($factory);

        switch ($factory)
        {
            default:
                $val->add('name', 'name');

                break;
        }
        
        return $val;
    }
}
