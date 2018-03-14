<?php

namespace Fuel\Migrations;

class Add_created_at_to_lpgas_simple_simulations
{
  public function up()
  {
    \DBUtil::add_fields('lpgas_simple_simulations', [
      'created_at' => [
        'type' => 'datetime',
      ],
    ]);
  }

  public function down()
  {
    \DBUtil::drop_fields('lpgas_simple_simulations', [
      'created_at',
    ]);
  }
}
