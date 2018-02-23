<?php

return [
  'defaults' => [
    'useragent' => null,
    'driver' => 'ses',
    'encoding' => 'base64',
    'from' => [
      'email' => 'info@enepi.jp',
      'name' => 'エネピ',
    ],
    'return_path' => false,
    'wordwrap' => null,
    'newline' => "\r\n",
  ],
];
