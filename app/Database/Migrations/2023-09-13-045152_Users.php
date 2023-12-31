<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'unique'         => true
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'is_active' => [
                'type'           => 'BOOLEAN',
                'default'        => false
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true 
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true 
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
