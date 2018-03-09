<?php

return [
  'driver' => 'redis',
  'redis' => [
    'cookie_name' => 'enepissid',
    'database' => 'default',
  ],
  'expire_on_close' => false,
  'expiration_time' => 86400 * 30,
  'match_ua' => false,
];
