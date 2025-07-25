<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AgentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kode_agen' => 'AG001', 'nama_agen' => 'Agen 001', 'created_at' => date('Y-m-d H:i:s')],
            ['kode_agen' => 'AG002', 'nama_agen' => 'Agen 002', 'created_at' => date('Y-m-d H:i:s')],
            ['kode_agen' => 'AG003', 'nama_agen' => 'Agen 003', 'created_at' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('agents')->insertBatch($data);
    }
}
