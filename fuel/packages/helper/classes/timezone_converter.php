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

    public static function convertFromStringToUTC($date, $to = 'Y-m-d H:i:s', $from = 'Y-m-d', $day_end = false)
    {
        if ($utc = new \DateTime($date))
        {
            $utc->modify('-9 hour');
            
            if ($day_end)
            {
                $utc->modify('+1 day');
            }

            return $utc->format($to);
        }

        return '';
    }

    public static function areUTCDatesEqual($a, $b, $pattern = 'mysql_date_time')
    {
        if (!$a || !$b)
            return null;

        return \Date::create_from_string($a, $pattern) == \Date::create_from_string($b, $pattern);
    }
}
