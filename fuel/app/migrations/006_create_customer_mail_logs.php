<?php

namespace Fuel\Migrations;

use \Fuel\Core\DB;

class Create_Customer_mail_logs
{
  public function up()
  {
    \DBUtil::create_table('customer_mail_logs', [
      'id' => [
        'constraint' => 11,
        'type' => 'int',
        'auto_increment' => true,
        'unsigned' => true
      ],
      'admin_id' => [
        'constraint' => 11,
        'type' => 'int',
        'unsigned' => true
      ],
      'contact_id' => [
        'constraint' => 11,
        'type' => 'int',
        'unsigned' => true
      ],
      'email' => [
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
      'send_status' => [
        'constraint' => 1,
        'type' => 'tinyint',
        'default' => 1,
        'unsigned' => true,
      ],
      'created_at' => [
        'type' => 'datetime',
        'null' => true,
        'default' => null,
      ],
    ], ['id']);
  }

  public function down()
  {
    \DBUtil::drop_table('customer_mail_logs');
  }
}
