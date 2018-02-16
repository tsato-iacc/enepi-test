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

\Autoloader::add_core_namespace('Eauth');

\Autoloader::add_classes(array(
	'Eauth\\Eauth'                        => __DIR__.'/classes/eauth.php',
	'Eauth\\EauthException'               => __DIR__.'/classes/eauth.php',

	'Eauth\\Eauth_Driver'                 => __DIR__.'/classes/eauth/driver.php',

	'Eauth\\Eauth_Acl_Driver'             => __DIR__.'/classes/eauth/acl/driver.php',
	'Eauth\\Eauth_Acl_Enepiacl'          => __DIR__.'/classes/eauth/acl/enepiacl.php',

	'Eauth\\Eauth_Group_Driver'           => __DIR__.'/classes/eauth/group/driver.php',
	'Eauth\\Eauth_Group_Enepigroup'      => __DIR__.'/classes/eauth/group/enepigroup.php',

	'Eauth\\Eauth_Login_Driver'           => __DIR__.'/classes/eauth/login/driver.php',
	'Eauth\\Eauth_Login_Enepiauth'        => __DIR__.'/classes/eauth/login/enepiauth.php',
	'Eauth\\Eauth_Login_Admin'        => __DIR__.'/classes/eauth/login/admin.php',
	'Eauth\\Eauth_Login_Partner'        => __DIR__.'/classes/eauth/login/partner.php',

	'Eauth\\EnepiUserUpdateException'   => __DIR__.'/classes/eauth/exceptions.php',
	'Eauth\\EnepiUserWrongPassword'     => __DIR__.'/classes/eauth/exceptions.php',
));
