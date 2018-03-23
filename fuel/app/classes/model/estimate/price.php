<?php

/**
 * class Lpgas::EstimateUnitPrice
 */
class Model_Estimate_Price extends \Orm\Model
{
    protected static $_table_name = 'lpgas_estimate_unit_prices';

    protected static $_properties = [
        'id',
        'estimate_id',
        'under_limit',
        'upper_limit',
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
        'estimate',
    ];

    /**
     * View methods
     */
    public function getRangeLabel()
    {
        return $this->upper_limit? "{$this->under_limit}~{$this->upper_limit}㎥" : "";
    }
}
