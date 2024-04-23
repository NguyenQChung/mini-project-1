<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Manager extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email' => 'admin@gmail.com',
                'name' => 'Admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT), // Thay 'password' bằng mật khẩu mong muốn
                'role' => 'manager',
            ]
        ];

        // Insert dữ liệu vào bảng users
        $this->db->table('users')->insertBatch($data);
    }
}
