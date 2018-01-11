<?php
/**
 * Helper classes
 *
 * @package    Helper
 * @version    1.0
 * @author     Zazimko Alexey
 * @license    MIT License
 */

namespace Helper;

class TimezoneConverter
{
    public static function convertFromString($date, $to, $from = 'mysql_date_time')
    {
        if ($date)
          return \Date::create_from_string($date, $from)->set_timezone('Asia/Tokyo')->format($to);

        return '';
    }
}
