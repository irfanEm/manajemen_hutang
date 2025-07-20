<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama' => 'Alpha Satu',
            'email' => 'alphasatu@superadmin.com',
            'password' => password_hash('alpha1', PASSWORD_DEFAULT),
            'role' => 'superadmin',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->table('users')->insert($data);
    }
}
