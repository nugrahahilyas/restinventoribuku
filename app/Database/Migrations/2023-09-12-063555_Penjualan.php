<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjualan extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'constraint'     => 8,
            'auto_increment' => true,
        ],
        'id_penjualan' => [
            'type'           => 'VARCHAR',
            'constraint'     => '10',
            'unique'         => true
        ],
        'total' => [
            'type'       => 'DECIMAL',
            'constraint' => '10,2',
            'null'      => true            
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
    $this->forge->createTable('penjualan');
}

public function down()
{
    $this->forge->dropTable('penjualan');
}
}
