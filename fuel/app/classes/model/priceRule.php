<?php

class Model_PriceRule extends \Orm\Model
{
    protected static $_table_name = 'lpgas_price_rules';

    protected static $_properties = [
        'id',
        'company_geocode_id',
        'house_kind',
        'using_cooking_stove',
        'using_bath_heater_with_gas_hot_water_supply',
        'using_other_gas_machine',
        'basic_price',
        'fuel_adjustment_cost',
        'notes',
        'set_plan',
        'other_set_plan'
    ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];

    protected static $_belongs_to = [
        'company_geocode',
    ];

    protected static $_has_many = [
        'prices' => [
            'model_to' => 'Model_PriceRule_Price',
            'key_from' => 'id',
            'key_to' => 'price_rule_id',
        ],
    ];
}
