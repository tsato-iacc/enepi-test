<?php

/**
 * class Lpgas::ContactGeocode
 */
class Model_Contact_Geocode extends \Orm\Model
{
    protected static $_table_name = 'lpgas_contact_geocodes';

    protected static $_properties = [
        'id',
        'contact_id',
        'lat',
        'lng',
        'address',
    ];

    protected static $_observers = [
        'Orm\\Observer_Typing'
    ];
}
