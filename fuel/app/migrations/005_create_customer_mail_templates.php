<?php

namespace Fuel\Migrations;

use \Fuel\Core\DB;

class Create_Customer_mail_templates
{
  public function up()
  {
    \DBUtil::create_table('customer_mail_templates', [
      'id' => [
        'constraint' => 11,
        'type' => 'int',
        'auto_increment' => true,
        'unsigned' => true
      ],
      'name' => [
        'constraint' => 255,
        'type' => 'varchar'
      ],
      'subject' => [
        'constraint' => 255,
        'type' => 'varchar'
      ],
      'body' => [
        'type' => 'text',
      ],
    ], ['id']);
  }

  public function down()
  {
    \DBUtil::drop_table('customer_mail_templates');
  }
}
