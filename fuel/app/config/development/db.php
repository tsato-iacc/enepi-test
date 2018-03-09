<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
    'default' => array(
        'profiling' => true
    ),

    'redis' => [
        'default' => [
            'hostname' => 'redis',
            'port' => 6379,
            'timeout' => null,
        ],
    ],
);
