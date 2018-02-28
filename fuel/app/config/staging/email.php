<?php

return [
  'defaults' => [
    'useragent' => null,
    'driver' => 'ses',
    'from' => [
      'email' => 'stg-info@enepi.jp',
      'name' => '[STAGING] エネピ',
    ],
    'return_path' => false,
    'wordwrap' => null,
    'newline' => "\r\n",
  ],
];
