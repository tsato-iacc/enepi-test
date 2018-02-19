<?php

return [
  'defaults' => [
    'driver' => 'smtp',
    'from' => [
      'email' => 'dev-info@enepi.jp',
      'name' => '[DEVELOP] エネピ',
    ],
    'return_path' => false,
    'wordwrap' => null,
    'smtp' => [
      'host' => 'mail',
      'port' => 25,
      'timeout' => 30,
      'starttls' => false,
    ],
    'newline' => "\r\n",
  ],
];
