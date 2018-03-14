<?php

namespace Fuel\Migrations;

use \Fuel\Core\DB;

class Add_created_at_to_lpgas_simple_simulations
{
  public function up()
  {
    \DB::start_transaction();
    
    try
    {
      foreach ([1 => 'january', 2 => 'february', 3 => 'march', 4 => 'april', 5 => 'may', 6 => 'june', 7 => 'july', 8 => 'august', 9 => 'september', 10 => 'october', 11 => 'november', 12 => 'december'] as $number => $month)
      {
        $query = DB::update('lpgas_simple_simulations');
        $query->set([
            'month' => $number,
        ]);
        $query->where('month', $month);
        $query->execute();
      }

      \DBUtil::modify_fields('lpgas_simple_simulations', [
          'month' => ['constraint' => 2, 'type' => 'int'],
        ]
      );

      \DBUtil::add_fields('lpgas_simple_simulations', [
        'created_at' => [
          'type' => 'datetime',
          'null' => true,
          'default' => null,
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
      'created_at',
    ]);
  }
}
