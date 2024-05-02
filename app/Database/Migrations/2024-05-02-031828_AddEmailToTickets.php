<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailToTickets extends Migration
{
    public function up()
    {
        $fields = [
            'email_manager' => [
                'type' => 'VARCHAR',
                'constraint' => 255, // Điều chỉnh chiều dài của trường email tùy theo yêu cầu
                'null' => true,
                'after' => 'user_id' // Thay thế 'other_field' bằng tên trường muốn đặt sau
            ],
        ];
        $this->forge->addColumn('tickets', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tickets', 'email');
    }
}
