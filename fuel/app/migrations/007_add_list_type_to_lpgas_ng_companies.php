<?php

namespace Fuel\Migrations;

use \Fuel\Core\DB;

class Add_list_type_to_lpgas_ng_companies
{
  public function up()
  {
    \DBUtil::add_fields('lpgas_companies', [
      'list_type' => [
        'constraint' => '"black","white"',
        'type' => 'enum',
        'default' => 'black',
      ],
    ]);
  }

  public function down()
  {
    \DBUtil::drop_fields('lpgas_companies', [
      'list_type',
    ]);
  }
}
