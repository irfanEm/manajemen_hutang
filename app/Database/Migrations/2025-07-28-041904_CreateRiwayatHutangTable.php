<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRiwayatHutangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_agent' => ['type' => 'INT', 'unsigned' => true],
            'tipe_pembayaran' => ['type' => 'VARCHAR', 'constraint' => 50],
            'nominal' => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'tanggal_pembayaran' => ['type' => 'DATETIME'],
            'penginput' => ['type' => 'VARCHAR', 'constraint' => 50],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_agent', 'agents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('riwayat_hutang');
    }

    public function down()
    {
        $this->forge->dropTable('riwayat_hutang');
    }
}
