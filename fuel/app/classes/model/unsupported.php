<?php

class Model_Unsupported extends \Orm\Model
{
    protected static $_table_name = 'lpgas_unsupported_prefectures';

    protected static $_properties = [
        'id',
        'prefecture_code',
        'pr_tracking_parameter_id',
    ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];
}
