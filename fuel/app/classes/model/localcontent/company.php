<?php

class Model_Localcontent_Company extends \Orm\Model
{
    protected static $_table_name = 'announcement_companies';

    protected static $_properties = [
        'id',
        'prefecture_code',
        'prefecture_name',
        'city_code',
        'city_name',
        'zip_code',
        'name',
        'address',
        'announcement_type',
        'announcement_date',
   ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];
}
