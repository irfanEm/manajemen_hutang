<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldToAgentsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('agents', [
            'tanggal_input_saldo' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'nama_agen'
            ],
            'sisa_hutang' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'after' => 'tanggal_input_saldo'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('agents',['tanggal_input_saldo', 'sisa_hutang']);
    }
}
