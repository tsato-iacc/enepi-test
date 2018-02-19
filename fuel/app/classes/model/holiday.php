<?php

class Model_Holiday extends \Orm\Model
{
    protected static $_table_name = 'new_year_holidays';

    protected static $_properties = [
        'id',
        'beg_at',
        'end_at',
        'holiday_text',
        'holiday_email_contact',
        'holiday_email_estimate_ok',
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

    public static function isHolliday()
    {
        if ($holiday = Model_Holiday::find('first'))
        {
            $now = new \DateTime();

            $beg_at = \DateTime::createFromFormat('Y-m-d H:i:s', $holiday->beg_at);
            $end_at = \DateTime::createFromFormat('Y-m-d H:i:s', $holiday->end_at);

            return $now >= $beg_at && $now <= $end_at;
        }

        return false;
    }

    public static function holiday_text()
    {
        if ($holiday = Model_Holiday::find('first'))
        {
            return str_replace("\n", "<br>", $holiday->holiday_text);
        }

        return '';
    }

    public static function holiday_email_contact()
    {
        if ($holiday = Model_Holiday::find('first'))
        {
            return str_replace("\n", "<br>", $holiday->holiday_email_contact);
        }

        return '';
    }

    public static function holiday_email_estimate_ok()
    {
        if ($holiday = Model_Holiday::find('first'))
        {
            return str_replace("\n", "<br>", $holiday->holiday_email_estimate_ok);
        }

        return '';
    }
}
