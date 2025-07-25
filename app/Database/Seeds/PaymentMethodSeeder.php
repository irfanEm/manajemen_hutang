<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kode_metode' => 'PM001', 'nama_metode' => 'BANK BCA', 'created_at' => date('Y-m-d H:i:s')],
            ['kode_metode' => 'PM002', 'nama_metode' => 'BANK Mandiri', 'created_at' => date('Y-m-d H:i:s')],
            ['kode_metode' => 'PM003', 'nama_metode' => 'BANK BRI', 'created_at' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('payment_methods')->insertBatch($data);
    }
}
