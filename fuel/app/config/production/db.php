<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
    'default' => array(
        'type'        => 'mysqli',
        'connection'  => array(
            'hostname'   => getenv('RDS_HOSTNAME'),
            'port'       => getenv('RDS_PORT'),
            'database'   => getenv('RDS_DB_NAME'),
            'username'   => getenv('RDS_USERNAME'),
            'password'   => 'mi!8e$270e',
        )
    ),
);
