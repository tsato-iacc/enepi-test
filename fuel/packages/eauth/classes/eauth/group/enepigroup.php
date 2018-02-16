<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Eauth;

class Eauth_Group_Enepigroup extends \Eauth_Group_Driver
{
	protected static $_valid_groups = array();

	public static function _init()
	{
		static::$_valid_groups = array_keys(\Config::get('enepiauth.groups', array()));
	}

	protected $config = array(
		'drivers' => array('acl' => array('Enepiacl')),
	);

	public function groups()
	{
		return static::$_valid_groups;
	}

	public function member($group, $user = null)
	{
		if ($user === null)
		{
			$groups = \Eauth::instance()->get_groups();
		}
		else
		{
			$groups = \Eauth::instance($user[0])->get_groups();
		}

		if ( ! $groups || ! in_array((int) $group, static::$_valid_groups))
		{
			return false;
		}

		return in_array(array($this->id, $group), $groups);
	}

	public function get_name($group = null)
	{
		if ($group === null)
		{
			if ( ! $login = \Eauth::instance() or ! is_array($groups = $login->get_groups()))
			{
				return false;
			}
			$group = isset($groups[0][1]) ? $groups[0][1] : null;
		}

		return \Config::get('enepiauth.groups.'.$group.'.name', null);
	}

	public function get_roles($group = null)
	{
		// When group is empty, attempt to get groups from a current login
		if ($group === null)
		{
			if ( ! $login = \Eauth::instance()
				or ! is_array($groups = $login->get_groups())
				or ! isset($groups[0][1]))
			{
				return array();
			}
			$group = $groups[0][1];
		}
		elseif ( ! in_array((int) $group, static::$_valid_groups))
		{
			return array();
		}

		$groups = \Config::get('enepiauth.groups');
		return $groups[(int) $group]['roles'];
	}
}

/* end of file simplegroup.php */
