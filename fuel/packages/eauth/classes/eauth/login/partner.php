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
class Eauth_Login_Partner extends \Eauth_Login_Enepiauth
{
	protected function __construct(Array $config)
	{
		parent::__construct($config);
	}

	public function get_table_name()
	{
		return 'partner_companies';
	}

  public function get_session_email_name()
  {
    return 'partner_email';
  }

  public function get_session_hash_name()
  {
    return 'partner_hash';
  }
}

// end of file enepiauth.php
