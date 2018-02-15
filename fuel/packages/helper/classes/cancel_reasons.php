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
    public static function getAdminGroups()
    {
        $groups = [];

        foreach (\Config::get('enepi.contact.cancel_reasons') as $group)
        {
            if (!in_array($group['group'], $groups))
                $groups[$group['group']] = $group['group'];
        }

        return $groups;
    }

    public static function getPartnerGroups()
    {
        $groups = [];

        foreach (\Config::get('enepi.contact.cancel_reasons') as $key => $group)
        {

            if (in_array($key, ['status_reason_unknown', 'status_reason_duplication', 'status_reason_abuse', 'status_reason_test', 'status_reason_resolved', 'status_reason_troublesome', 'status_reason_dont_remember']))
                continue;

            if (!in_array($group['group'], $groups))
                $groups[$group['group']] = $group['group'];
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
