<?php

/**
 * class Lpgas::PriceRuleUnitPrice
 */
class Model_PriceRule_Price extends \Orm\Model
{
    protected static $_table_name = 'lpgas_price_rule_unit_prices';

    protected static $_properties = [
        'id',
        'price_rule_id',
        'under_limit',
        'upper_limit' => [
            'default' => null,
        ],
        'unit_price',
        'created_at',
        'updated_at'
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
        'price_rule' => [
            'model_to' => 'Model_PriceRule',
            'key_from' => 'price_rule_id',
        ],
    ];
}
