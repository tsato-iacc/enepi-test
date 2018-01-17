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

class CancelReasons
{
    public static function getGroups()
    {
        $groups = [];

        foreach (\Config::get('enepi.contact.cancel_reasons') as $group)
        {
            if (!in_array($group['group'], $groups))
            {
                $groups[$group['group']] = $group['group'];
            }
        }

        return $groups;
    }

    public static function getReasonsByGroup($group_name)
    {
        $reasons = [];

        foreach (\Config::get('enepi.contact.cancel_reasons') as $k => $group)
        {
            if ($group['group'] == $group_name)
            {
                $reasons[$k] = $group['text'];
            }
        }

        return $reasons;
    }

    public static function getValueByName($name)
    {
        foreach (\Config::get('enepi.contact.cancel_reasons') as $k => $reason)
        {
            if ($k == $name)
            {
                return $reason['value'];
            }
        }

        return null;
    }

    public static function getNameByValue($value)
    {
        foreach (\Config::get('enepi.contact.cancel_reasons') as $reason)
        {
            if ($reason['value'] == $value)
            {
                return $reason['text'];
            }
        }

        return null;
    }
}
