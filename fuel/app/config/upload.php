<?php

return [
  'max_size' => 1024 * 1024 * 5,
  'ext_whitelist' => ['png', 'jpg', 'jpeg', 'gif'],
  'type_whitelist' => ['image'],
  'mime_whitelist' => ['image/png', 'image/x-png', 'image/jpeg', 'image/gif'],
  'path' => APPPATH . 'tmp/',
  'randomize' => true,
];
