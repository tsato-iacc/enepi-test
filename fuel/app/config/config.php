<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

return array(

	/**
	 * Localization & internationalization settings
	 */
	'language'           => 'ja', // Default language
	'language_fallback'  => 'en', // Fallback language when file isn't available for default language
	'locale'             => 'ja_JP', // PHP set_locale() setting, null to not set

	/**
	 * DateTime settings
	 *
	 * server_gmt_offset	in seconds the server offset from gmt timestamp when time() is used
	 * default_timezone		optional, if you want to change the server's default timezone
	 */
	// 'server_gmt_offset'  => 0,
	'default_timezone'   => 'UTC',

	/**
	 * Security settings
	 */
	'security' => array(
    'csrf_autoload'            => true,

		/**
		 * A salt to make sure the generated security tokens are not predictable
		 */
		'token_salt'            => 'oD2it9EDonJdiiDdRGgPWGG7Ks9l4xXJ',

		/**
		 * Allow the Input class to use X headers when present
		 *
		 * Examples of these are HTTP_X_FORWARDED_FOR and HTTP_X_FORWARDED_PROTO, which
		 * can be faked which could have security implications
		 */
		'allow_x_headers'       => true,

		/**
     * This input filter can be any normal PHP function as well as 'xss_clean'
     *
     * WARNING: Using xss_clean will cause a performance hit.
     * How much is dependant on how much input data there is.
     *
     * Note: MUST BE DEFINED IN THE APP CONFIG FILE!
     */
    'uri_filter'       => ['htmlentities'],

    /**
     * This input filter can be any normal PHP function as well as 'xss_clean'
     *
     * WARNING: Using xss_clean will cause a performance hit.
     * How much is dependant on how much input data there is.
     *
     * Note: MUST BE DEFINED IN THE APP CONFIG FILE!
     */
    //'input_filter'             => array(),

    /**
     * This output filter can be any normal PHP function as well as 'xss_clean'
     *
     * WARNING: Using xss_clean will cause a performance hit.
     * How much is dependant on how much input data there is.
     *
     * Note: MUST BE DEFINED IN THE APP CONFIG FILE!
     */
    'output_filter'  => ['Security::htmlentities'],

    /**
     * With output encoding switched on all objects passed will be converted to strings or
     * throw exceptions unless they are instances of the classes in this array.
     */
    'whitelisted_classes' => [
      'Fuel\\Core\\Presenter',
      'Fuel\\Core\\Response',
      'Fuel\\Core\\View',
      'Fuel\\Core\\ViewModel',
      'Fuel\\Core\\Validation',
      'Closure',
    ],
	),

	/**
	 * To enable you to split up your additions to the framework, packages are
	 * used. You can define the basepaths for your packages here. By default
	 * empty, but to use them you can add something like this:
	 *      array(APPPATH.'modules'.DS)
	 *
	 * Paths MUST end with a directory separator (the DS constant)!
	 */
	'package_paths' => array(
		PKGPATH,
	),

	/**************************************************************************/
	/* Always Load                                                            */
	/**************************************************************************/
	'always_load'  => array(

		/**
		 * These packages are loaded on Fuel's startup.
		 * You can specify them in the following manner:
		 *
		 * array('auth'); // This will assume the packages are in PKGPATH
		 *
		 * // Use this format to specify the path to the package explicitly
		 * array(
		 *     array('auth'	=> PKGPATH.'auth/')
		 * );
		 */
		'packages' => [
			'orm',
			'helper',
		],

		/**
		 * Configs to autoload
		 *
		 * Examples: if you want to load 'session' config into a group 'session' you only have to
		 * add 'session'. If you want to add it to another group (example: 'auth') you have to
		 * add it like 'session' => 'auth'.
		 * If you don't want the config in a group use null as groupname.
		 */
		'config'  => [
      'enepi',
			'models',
		],

	),

);
