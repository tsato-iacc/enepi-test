<?php

class Model_LocalContentPrefecture extends \Orm\Model
{
    protected static $_table_name = 'lpgas_local_content_prefectures';

    protected static $_properties = [
        'id',
        'prefecture_code',
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
        'annual_average',
        'two_or_less_person_household',
        'three_person_household',
        'four_person_household',
        'five_person_household',
        'six_person_household',
        'seven_or_more_person_household',
        'basic_rate',
        'five_cubic_meters_price',
        'ten_cubic_meters_price',
        'twenty_cubic_meters_price',
        'fifty_cubic_meters_price',
        'five_cubic_meters_price_per_one',
        'ten_cubic_meters_price_per_one',
        'twenty_cubic_meters_price_per_one',
        'fifty_cubic_meters_price_per_one',
        'commodity_charge_criterion',
        'average_reduction_rate',
        'number_of_subjects',
        'number_of_approved_company'
   ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];

    protected static $_has_many = [
        'local_content_cities' => [
            'model_to' => 'Model_LocalContentCity',
        ],
    ];
}
