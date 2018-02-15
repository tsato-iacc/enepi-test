<?php

use JpPrefecture\JpPrefecture;

/**
 * class ZipCode
 */
class Model_ZipCode extends \Orm\Model
{
    protected static $_table_name = 'zip_codes';

    protected static $_properties = [
        'id',
        'zip_code',
        'prefecture_code',
        'city_name',
        'town_area_name',
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

    // public function full_name()
    // {
    //     $p = JpPrefecture::findByCode(13);
    // }
}
