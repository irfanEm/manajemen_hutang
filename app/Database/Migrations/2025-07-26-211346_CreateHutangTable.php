<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHutangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'id_hutang' => ['type' => 'VARCHAR', 'constraint' => 30], 
            'id_agent' => ['type' => 'INT', 'unsigned' => true], 
            'id_metode_pembayaran' => ['type' => 'INT', 'unsigned' => true], 
            'sisa_hutang' => ['type' => 'DECIMAL', 'constraint' => '15,2'], 
            'tanggal_hutang' => ['type' => 'DATETIME'], 
            'created_at' => ['type' => 'DATETIME', 'null' => true], 
            'updated_at' => ['type' => 'DATETIME', 'null' => true], 
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_agent', 'agents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_metode_pembayaran', 'payment_methods', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('hutangs');
    }

    public function down()
    {
        $this->forge->dropTable('hutangs');
    }
}
