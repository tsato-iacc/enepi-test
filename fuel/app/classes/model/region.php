<?php

/**
 * class Region
 */
class Model_Region extends \Orm\Model
{
    protected static $_table_name = 'regions';

    protected static $_properties = [
        'id',
        'prefecture_code',
        'city_name',
    ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];
}
