<?php

/**
 * Attempt to determine whether the app is EnepiAuth or OrmAuth based
 *
 * @return  string  normalized Auth driver
 */
if ( ! function_exists('normalize_driver_types'))
{
	function normalize_driver_types()
	{
		// get the drivers configured
		\Config::load('eauth', true);

		$drivers = \Config::get('eauth.driver', array());
		is_array($drivers) or $drivers = array($drivers);

		$results = array();

		foreach ($drivers as $driver)
		{
			// determine the driver classname
			$class = \Inflector::get_namespace($driver).'Eauth_Login_'.\Str::ucwords(\Inflector::denamespace($driver));

			// Auth's Enepiauth
			if ($class == 'Eauth_Login_Enepiauth' or $class == 'Eauth\Eauth_Login_Enepiauth')
			{
				$driver = 'Enepiauth';
			}

			elseif (class_exists($class))
			{
				// Extended fromm Auth's Enepiauth
				if (get_parent_class($class) == 'Eauth\Eauth_Login_Enepiauth')
				{
					$driver = 'Enepiauth';
				}
			}

			// store the normalized driver name
			in_array($driver, $results) or $results[] = $driver;
		}

		return $results;
	}
}
