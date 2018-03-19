<?php

class Model_Simulation extends \Orm\Model
{
    protected static $_table_name = 'lpgas_simple_simulations';

    protected static $_properties = [
        'id',
        'prefecture_code',
        'city_code',
        'household',
        'amount_billed',
        'month',
        'ip',
        'created_at',
    ];

    protected static $_observers = [
        'Orm\\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'mysql_timestamp' => true,
        ],
        'Orm\\Observer_Typing'
    ];

    public static function validate($factory = null)
    {
        $val = Validation::forge();

        $val->add_field('prefecture_code', 'prefecture_code', 'required|valid_string[numeric]');
        $val->add_field('city_code', 'city_code', 'required|valid_string[numeric]');
        $val->add_field('household', 'household', 'required|match_collection[two_or_less_person_household,three_person_household,four_person_household,five_person_household,six_person_household,seven_or_more_person_household]');
        $val->add_field('month', 'month', 'required|match_collection[january,february,march,april,may,june,july,august,september,october,november,december]');
        $val->add_field('bill', 'bill', 'valid_string[numeric]');
        
        return $val;
    }
}
