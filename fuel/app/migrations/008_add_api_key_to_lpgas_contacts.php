<?php

namespace Fuel\Migrations;

use \Fuel\Core\DB;

class Add_api_key_to_lpgas_contacts
{
  public function up()
  {
    \DBUtil::add_fields('lpgas_contacts', [
      'api_key' => [
        'type' => 'varchar',
        'constraint' => 32,
        'null' => true,
        'default' => null,
      ],
    ]);
  }

  public function down()
  {
    \DBUtil::drop_fields('lpgas_contacts', [
      'api_key',
    ]);
  }
}
