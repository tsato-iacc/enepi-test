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
));
