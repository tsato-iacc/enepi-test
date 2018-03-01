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

/**
 * EnepiAuth basic login driver
 *
 * @package     Fuel
 * @subpackage  Eauth
 */
abstract class Eauth_Login_Enepiauth extends \Eauth_Login_Driver
{
	/**
	 * Load the config and setup the remember-me session if needed
	 */
	public static function _init()
	{
		\Config::load('enepiauth', true);

		// setup the remember-me session object if needed
		if (\Config::get('enepiauth.remember_me.enabled', false))
		{
			static::$remember_me = \Session::forge(array(
				'driver' => 'cookie',
				'cookie' => array(
					'cookie_name' => \Config::get('enepiauth.remember_me.cookie_name', 'rmcookie'),
				),
				'encrypt_cookie' => true,
				'expire_on_close' => false,
				'expiration_time' => \Config::get('enepiauth.remember_me.expiration', 86400 * 31),
			));
		}
	}

	/**
	 * @var  Database_Result  when login succeeded
	 */
	protected $user = null;

	/**
	 * @var  array  value for guest login
	 */
	protected static $guest_login = array(
		'id' => 0,
		// 'username' => 'guest',
		'group' => '0',
		'login_hash' => false,
		'email' => false,
	);

	/**
	 * @var  array  enepiAuth class config
	 */
	protected $config = array(
		'drivers' => array('group' => array('Enepigroup')),
		'additional_fields' => array('profile_fields'),
	);

	/**
	 * Check for login
	 *
	 * @return  bool
	 */
	protected function perform_check()
	{
		// fetch the username and login hash from the session
		$email    = \Session::get($this->get_session_email_name());
		$login_hash  = \Session::get($this->get_session_hash_name());
		$login_id  = \Session::get($this->get_session_login_id());

		// only worth checking if there's both a email and login-hash
		if ( ! empty($email) and ! empty($login_hash))
		{
			if (is_null($this->user) or ($this->user['email'] != $email and $this->user != static::$guest_login))
			{
				$this->user = \DB::select_array(\Config::get('enepiauth.table_columns', array('*')))
					->where('email', '=', $email)
					->and_where('id', '=', $login_id)
					->from($this->get_table_name())
					->execute(\Config::get('simpleauth.db_connection'))->current();
			}

			// return true when login was verified, and either the hash matches or multiple logins are allowed
			if ($this->user and (\Config::get('enepiauth.multiple_logins', false) or $this->user['login_hash'] === $login_hash))
			{
				return true;
			}
		}


		// not logged in, do we have remember-me active and a stored user_id?
		elseif (static::$remember_me and $user_id = static::$remember_me->get('user_id', null))
		{
			return $this->force_login($user_id);
		}

		// no valid login when still here, ensure empty session and optionally set guest_login
		$this->user = \Config::get('enepiauth.guest_login', true) ? static::$guest_login : false;
		\Session::delete($this->get_session_email_name());
		\Session::delete($this->get_session_hash_name());
		\Session::delete($this->get_session_login_id());

		return false;
	}

	/**
	 * Check the user exists
	 *
	 * @return  bool
	 */
	public function validate_user($email = '', $password = '', $id = null)
	{
		$email = trim($email) ?: trim(\Input::post(\Config::get('enepiauth.username_post_key', 'username')));
		$password = trim($password) ?: trim(\Input::post(\Config::get('enepiauth.password_post_key', 'password')));

		if (empty($email) or empty($password))
		{
			return false;
		}

		$user = \DB::select_array(\Config::get('enepiauth.table_columns', array('*')));
		$user->where_open();
		$user->where('email', '=', $email);

		if ($id)
		{
			$user->and_where('id', '=', $id);	
		}
		
		$user->where_close();
		$user->from($this->get_table_name());
		$user = $user->execute(\Config::get('enepiauth.db_connection'))->current();

		if ($user && $user['encrypted_password'] == sha1("--{$user['salt']}--{$password}--"))
			return $user;

		return false;
	}

	/**
	 * Login user
	 *
	 * @param   string
	 * @param   string
	 * @return  bool
	 */
	public function login($email = '', $password = '', $id = null)
	{
		if ( ! ($this->user = $this->validate_user($email, $password, $id)))
		{
			$this->user = \Config::get('enepiauth.guest_login', true) ? static::$guest_login : false;
			\Session::delete($this->get_session_email_name());
			\Session::delete($this->get_session_hash_name());
			\Session::delete($this->get_session_login_id());
			return false;
		}
		
		// register so Eauth::logout() can find us
		Eauth::_register_verified($this);

		\Session::set($this->get_session_email_name(), $this->user['email']);
		\Session::set($this->get_session_hash_name(), $this->create_login_hash());
		\Session::set($this->get_session_login_id(), $this->user['id']);

		\Session::instance()->rotate();
		return true;
	}

	/**
	 * Force login user
	 *
	 * @param   string
	 * @return  bool
	 */
	public function force_login($user_id = '')
	{
		if (empty($user_id))
		{
			return false;
		}

		$this->user = \DB::select_array(\Config::get('enepiauth.table_columns', array('*')))
			->where_open()
			->where('id', '=', $user_id)
			->where_close()
			->from($this->get_table_name())
			->execute(\Config::get('enepiauth.db_connection'))
			->current();

		if ($this->user == false)
		{
			$this->user = \Config::get('enepiauth.guest_login', true) ? static::$guest_login : false;
			\Session::delete($this->get_session_email_name());
			\Session::delete($this->get_session_hash_name());
			\Session::delete($this->get_session_login_id());
			return false;
		}

		\Session::set($this->get_session_email_name(), $this->user['email']);
		\Session::set($this->get_session_hash_name(), $this->create_login_hash());
		\Session::set($this->get_session_login_id(), $this->user['id']);

		// and rotate the session id, we've elevated rights
		\Session::instance()->rotate();

		// register so Eauth::logout() can find us
		Eauth::_register_verified($this);

		return true;
	}

	/**
	 * Logout user
	 *
	 * @return  bool
	 */
	public function logout()
	{
		$this->user = \Config::get('enepiauth.guest_login', true) ? static::$guest_login : false;
		\Session::delete($this->get_session_email_name());
		\Session::delete($this->get_session_hash_name());
		\Session::delete($this->get_session_login_id());
		return true;
	}

	/**
	 * Create new user
	 *
	 * @param   string
	 * @param   string
	 * @param   string  must contain valid email address
	 * @param   int     group id
	 * @param   Array
	 * @return  bool
	 */
	public function create_user($email, $password, $role = 0, $same_email = false)
	{
		$password = trim($password);
		$email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);

		if (empty($password) or empty($email))
		{
			throw new \EnepiUserUpdateException('Username, password or email address is not given, or email address is invalid', 1);
		}


		if (!$same_email)
		{
			$same_users = \DB::select_array(\Config::get('enepiauth.table_columns', array('*')))
				->where('email', '=', $email)
				->from($this->get_table_name())
				->execute(\Config::get('enepiauth.db_connection'));

			if ($same_users->count() > 0)
			{
				throw new \EnepiUserUpdateException('Username already exists', 3);
			}
		}

    $salt = \Str::random('sha1');

		$user = array(
			'encrypted_password' => $this->hash_password($salt, (string) $password),
			'salt'               => $salt,
			'email'              => $email,
			'role'               => $role,
			'last_login'         => '',
			'login_hash'         => '',
			'created_at'         => \Date::forge()->format('mysql'),
		);

		$result = \DB::insert($this->get_table_name())
			->set($user)
			->execute(\Config::get('enepiauth.db_connection'));

		return ($result[1] > 0) ? $result[0] : false;
	}

	/**
	 * Update a user's properties
	 * Note: Username cannot be updated, to update password the old password must be passed as old_password
	 *
	 * @param   Array  properties to be updated including profile fields
	 * @param   string
	 * @return  bool
	 */
	public function update_user($values, $username = null)
	{
		throw new \Exception('FIX ME', 1);

		$username = $username ?: $this->user['username'];
		$current_values = \DB::select_array(\Config::get('enepiauth.table_columns', array('*')))
			->where('username', '=', $username)
			->from($this->get_table_name())
			->execute(\Config::get('enepiauth.db_connection'));

		if (empty($current_values))
		{
			throw new \EnepiUserUpdateException('Username not found', 4);
		}

		$update = array();
		if (array_key_exists('username', $values))
		{
			throw new \EnepiUserUpdateException('Username cannot be changed.', 5);
		}
		if (array_key_exists('password', $values))
		{
			if (empty($values['old_password'])
				or $current_values->get('password') != $this->hash_password(trim($values['old_password'])))
			{
				throw new \EnepiUserWrongPassword('Old password is invalid');
			}

			$password = trim(strval($values['password']));
			if ($password === '')
			{
				throw new \EnepiUserUpdateException('Password can\'t be empty.', 6);
			}
			$update['password'] = $this->hash_password($password);
			unset($values['password']);
		}
		if (array_key_exists('old_password', $values))
		{
			unset($values['old_password']);
		}
		if (array_key_exists('email', $values))
		{
			$email = filter_var(trim($values['email']), FILTER_VALIDATE_EMAIL);
			if ( ! $email)
			{
				throw new \EnepiUserUpdateException('Email address is not valid', 7);
			}
			$matches = \DB::select()
				->where('email', '=', $email)
				->where('id', '!=', $current_values[0]['id'])
				->from($this->get_table_name())
				->execute(\Config::get('enepiauth.db_connection'));
			if (count($matches))
			{
				throw new \EnepiUserUpdateException('Email address is already in use', 11);
			}
			$update['email'] = $email;
			unset($values['email']);
		}
		if (array_key_exists('group', $values))
		{
			if (is_numeric($values['group']))
			{
				$update['group'] = (int) $values['group'];
			}
			unset($values['group']);
		}
		if ( ! empty($values))
		{
			$profile_fields = @unserialize($current_values->get('profile_fields')) ?: array();
			foreach ($values as $key => $val)
			{
				if ($val === null)
				{
					unset($profile_fields[$key]);
				}
				else
				{
					$profile_fields[$key] = $val;
				}
			}
			$update['profile_fields'] = serialize($profile_fields);
		}

		$update['updated_at'] = \Date::forge()->format('mysql');

		$affected_rows = \DB::update($this->get_table_name())
			->set($update)
			->where('username', '=', $username)
			->execute(\Config::get('enepiauth.db_connection'));

		// Refresh user
		if ($this->user['username'] == $username)
		{
			$this->user = \DB::select_array(\Config::get('enepiauth.table_columns', array('*')))
				->where('username', '=', $username)
				->from($this->get_table_name())
				->execute(\Config::get('enepiauth.db_connection'))->current();
		}

		return $affected_rows > 0;
	}

	/**
	 * Change a user's password
	 *
	 * @param   string
	 * @param   string
	 * @param   string  username or null for current user
	 * @return  bool
	 */
	public function change_password($old_password, $new_password, $username = null)
	{
		throw new \Exception('FIX ME', 1);

		try
		{
			return (bool) $this->update_user(array('old_password' => $old_password, 'password' => $new_password), $username);
		}
		// Only catch the wrong password exception
		catch (EnepiUserWrongPassword $e)
		{
			return false;
		}
	}

	/**
	 * Generates new random password, sets it for the given username and returns the new password.
	 * To be used for resetting a user's forgotten password, should be emailed afterwards.
	 *
	 * @param   string  $username
	 * @return  string
	 */
	public function reset_password($username)
	{
		$new_password = \Str::random('alnum', 8);
		$password_hash = $this->hash_password($new_password);

		$affected_rows = \DB::update($this->get_table_name())
			->set(array('password' => $password_hash))
			->where('username', '=', $username)
			->execute(\Config::get('enepiauth.db_connection'));

		if ( ! $affected_rows)
		{
			throw new \EnepiUserUpdateException('Failed to reset password, user was invalid.', 8);
		}

		return $new_password;
	}

	/**
	 * Deletes a given user
	 *
	 * @param   string
	 * @return  bool
	 */
	public function delete_user($username)
	{
		if (empty($username))
		{
			throw new \EnepiUserUpdateException('Cannot delete user with empty username', 9);
		}

		$affected_rows = \DB::delete($this->get_table_name())
			->where('username', '=', $username)
			->execute(\Config::get('enepiauth.db_connection'));

		return $affected_rows > 0;
	}

	/**
	 * Creates a temporary hash that will validate the current login
	 *
	 * @return  string
	 */
	public function create_login_hash()
	{
		if (empty($this->user))
		{
			throw new \EnepiUserUpdateException('User not logged in, can\'t create login hash.', 10);
		}

		$last_login = \Date::forge()->format('mysql');
		$login_hash = sha1(\Config::get('enepiauth.login_hash_salt').$this->user['email'].$last_login);

		\DB::update($this->get_table_name())
			->set(array('last_login' => $last_login, 'login_hash' => $login_hash))
			->where('email', '=', $this->user['email'])
			->execute(\Config::get('enepiauth.db_connection'));

		$this->user['login_hash'] = $login_hash;

		return $login_hash;
	}

	/**
	 * Get the user's ID
	 *
	 * @return  Array  containing this driver's ID & the user's ID
	 */
	public function get_user_id()
	{
		if (empty($this->user))
		{
			return false;
		}

		return array($this->id, (int) $this->user['id']);
	}

	/**
	 * Get the user's groups
	 *
	 * @return  Array  containing the group driver ID & the user's group ID
	 */
	public function get_groups()
	{
		if (empty($this->user))
		{
			return false;
		}

		return array(array('Enepigroup', $this->user['group']));
	}

	/**
	 * Getter for user data
	 *
	 * @param  string  name of the user field to return
	 * @param  mixed  value to return if the field requested does not exist
	 *
	 * @return  mixed
	 */
	public function get($field, $default = null)
	{
		if (isset($this->user[$field]))
		{
			return $this->user[$field];
		}
		elseif (isset($this->user['profile_fields']))
		{
			return $this->get_profile_fields($field, $default);
		}

		return $default;
	}

	/**
	 * Get the user's emailaddress
	 *
	 * @return  string
	 */
	public function get_email()
	{
		return $this->get('email', false);
	}

	/**
	 * Get the user's screen name
	 *
	 * @return  string
	 */
	public function get_screen_name()
	{
		if (empty($this->user))
		{
			return false;
		}

		return $this->user['username'];
	}

	/**
	 * Get the user's profile fields
	 *
	 * @return  Array
	 */
	public function get_profile_fields($field = null, $default = null)
	{
		if (empty($this->user))
		{
			return false;
		}

		if (isset($this->user['profile_fields']))
		{
			is_array($this->user['profile_fields']) or $this->user['profile_fields'] = (@unserialize($this->user['profile_fields']) ?: array());
		}
		else
		{
			$this->user['profile_fields'] = array();
		}

		return is_null($field) ? $this->user['profile_fields'] : \Arr::get($this->user['profile_fields'], $field, $default);
	}

	/**
	 * Extension of base driver method to default to user group instead of user id
	 */
	public function has_access($condition, $driver = null, $user = null)
	{
		if (is_null($user))
		{
			$groups = $this->get_groups();
			$user = reset($groups);
		}
		return parent::has_access($condition, $driver, $user);
	}

	/**
	 * Extension of base driver because this supports a guest login when switched on
	 */
	public function guest_login()
	{
		return \Config::get('enepiauth.guest_login', true);
	}

	abstract public function get_table_name();

	abstract public function get_session_email_name();
	
	abstract public function get_session_hash_name();

	abstract public function get_session_login_id();
}

// end of file enepiauth.php
