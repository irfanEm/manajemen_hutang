<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'autoincrement' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 255],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'admin'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
