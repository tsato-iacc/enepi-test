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
            'cascade_delete' => true,
        ],
    ];

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object or null if factory is null
     */
    public static function validate($factory = null)
    {
        $val = Validation::forge();

        $val->add_field('house_kind', 'house_kind', 'required|match_collection[0,1,2]');
        $val->add_field('using_cooking_stove', 'using_cooking_stove', 'required|match_collection[1,0]');
        $val->add_field('using_bath_heater_with_gas_hot_water_supply', 'using_bath_heater_with_gas_hot_water_supply', 'required|match_collection[1,0]');
        $val->add_field('using_other_gas_machine', 'using_other_gas_machine', 'required|match_collection[1,0]');

        switch ($factory)
        {
            case 'store':
                $val->add_field('basic_price', 'basic_price', 'required|valid_string[numeric]');
                $val->add_field('fuel_adjustment_cost', 'fuel_adjustment_cost', 'required|valid_string[numeric]');

                $val->add_field('notes', 'notes', 'max_length[2000]');
                $val->add_field('set_plan', 'set_plan', 'max_length[2000]');
                $val->add_field('other_set_plan', 'other_set_plan', 'max_length[2000]');

                foreach (\Input::post('prices', []) as $key => $v)
                {
                    $val->add_field("prices.{$key}.unit_price", 'unit_price', 'required|valid_string[numeric]');
                    $val->add_field("prices.{$key}.under_limit", 'under_limit', 'required|valid_string[numeric]');
                    $val->add_field("prices.{$key}.upper_limit", 'upper_limit', 'valid_string[numeric]');
                }
                break;
            default:
                break;
        }

        return $val;
    }

    /**
     * [validate description]
     * @param  string $factory Validation rules factory
     * @return mixed           Return Fuel\Core\Validation object or null if factory is null
     */
    public static function validate_estimate()
    {
        $val = Validation::forge();

        $val->add_field('basic_price', 'basic_price', 'required|valid_string[numeric]');
        $val->add_field('fuel_adjustment_cost', 'fuel_adjustment_cost', 'required|valid_string[numeric]');

        $val->add_field('notes', 'notes', 'max_length[2000]');
        $val->add_field('set_plan', 'set_plan', 'max_length[2000]');
        $val->add_field('other_set_plan', 'other_set_plan', 'max_length[2000]');

        foreach (\Input::post('prices', []) as $key => $v)
        {
            $val->add_field("prices.{$key}.unit_price", 'unit_price', 'required|valid_string[numeric]');
            $val->add_field("prices.{$key}.under_limit", 'under_limit', 'required|valid_string[numeric]');
            $val->add_field("prices.{$key}.upper_limit", 'upper_limit', 'valid_string[numeric]');
        }

        return $val;
    }
}
