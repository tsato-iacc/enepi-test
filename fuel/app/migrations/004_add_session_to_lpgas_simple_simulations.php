<?php

namespace Fuel\Migrations;

use \Fuel\Core\DB;

class Add_session_to_lpgas_simple_simulations
{
  public function up()
  {
    \DBUtil::add_fields('lpgas_simple_simulations', [
      'uuid' => [
        'type' => 'varchar',
        'constraint' => 36,
        'null' => true,
        'default' => null,
        'after' => 'id',
      ],
      'tr' => [
        'type' => 'varchar',
        'constraint' => 64,
        'null' => true,
        'default' => null,
        'after' => 'type',
      ],
    ]);

    \DBUtil::add_fields('lpgas_contacts', [
      'uuid' => [
        'type' => 'varchar',
        'constraint' => 36,
        'null' => true,
        'default' => null,
        'after' => 'id',
      ],
    ]);
  }

  public function down()
  {
    \DBUtil::drop_fields('lpgas_simple_simulations', [
      'uuid',
      'tr',
    ]);

    \DBUtil::drop_fields('lpgas_contacts', [
      'uuid',
    ]);
  }
}
