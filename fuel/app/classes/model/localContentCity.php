<?php

class Model_LocalContentCity extends \Orm\Model
{
    protected static $_table_name = 'lpgas_local_content_cities';

    protected static $_properties = [
        'id',
        'prefecture_code',
        'city_code',
        'basic_rate',
        'commodity_charge',
        'average_usage',
        'five_cubic_meters_price',
        'ten_cubic_meters_price',
        'twenty_cubic_meters_price',
        'fifty_cubic_meters_price',
        'two_or_less_person_household',
        'three_person_household',
        'four_person_household',
        'five_person_household',
        'six_person_household',
        'seven_or_more_person_household'
    ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];

    protected static $_belongs_to = [
        'local_content_prefecture',
        'region',
    ];
}
