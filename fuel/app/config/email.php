<?php

return [
  'defaults' => [
    'useragent' => null,
    'driver' => 'smtp',
    'from' => [
      'email' => 'info@enepi.jp',
      'name' => 'Enepi',
    ],
    'return_path' => false,
    'wordwrap' => null,
    'smtp' => [
      'host' => getenv('SMTP_HOSTNAME'),
      'port' => 587,
      'username' => getenv('SMTP_USERNAME'),
      'password' => getenv('SMTP_PASSWORD'),
      'timeout' => 30,
      'starttls' => true,
    ],
    'newline' => "\r\n",
  ],
];
