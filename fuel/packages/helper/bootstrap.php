<?php
/**
 * Helper classes
 *
 * @package    Helper
 * @version    1.0
 * @author     Zazimko Alexey
 * @license    MIT License
 */

\Autoloader::add_core_namespace('Helper');

\Autoloader::add_classes(array(
	/**
	 * Helper classes.
	 */
  'Helper\\Simulation'                        => __DIR__.'/classes/simulation.php',
  'Helper\\Tracking'                          => __DIR__.'/classes/tracking.php',
  'Helper\\ValidateReplacer'                  => __DIR__.'/classes/validate_replacer.php',
  'Helper\\TimezoneConverter'                 => __DIR__.'/classes/timezone_converter.php',
  'Helper\\AddValidation'                     => __DIR__.'/classes/add_validation.php',
  'Helper\\CancelReasons'                     => __DIR__.'/classes/cancel_reasons.php',
  'Helper\\Notifier'                          => __DIR__.'/classes/notifier.php',
));
