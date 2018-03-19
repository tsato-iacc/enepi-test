<?php

namespace Fuel\Migrations;

use \Fuel\Core\DB;

class Add_ip_to_lpgas_simple_simulations
{
  public function up()
  {
    \DB::start_transaction();
    
    try
    {
      \DBUtil::add_fields('lpgas_simple_simulations', [
        'ip' => [
          'type' => 'varchar',
          'constraint' => 32,
          'null' => true,
          'default' => null,
          'after' => 'month',
        ],
      ]);

      \DB::commit_transaction();
    }
    catch (\Exception $e)
    {
      \DB::rollback_transaction();
      throw $e;
    }
  }

  public function down()
  {
    \DBUtil::drop_fields('lpgas_simple_simulations', [
      'ip',
    ]);
  }
}
