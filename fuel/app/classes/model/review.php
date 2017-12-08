<?php

/**
 * class Review
 */
class Model_Review extends \Orm\Model
{
    protected static $_table_name = 'reviews';

    protected static $_properties = [
        'id',
        'reviewer_age',
        'reviewer_gender',
        'reviewer_occupation',
        'word_of_mouth',
        'contracted_or_considering',
        'with_enepi_or_not',
        'city_code',
        'prefecture_code',
        // 'created_at',
        // 'updated_at'
    ];

    protected static $_observers = [
        // 'Orm\\Observer_CreatedAt' => [
        //     'events' => ['before_insert'],
        //     'mysql_timestamp' => true,
        // ],
        // 'Orm\\Observer_UpdatedAt' => [
        //     'events' => ['before_update'],
        //     'mysql_timestamp' => true,
        // ],
        'Orm\\Observer_Typing'
    ];
}
