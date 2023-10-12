<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tempdetailpenjualan extends Migration
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
        ],
        'id_buku' => [
            'type'           => 'VARCHAR',
            'constraint'     => '10',
        ],
        'jumlah' => [
            'type'       => 'INT',
            'constraint' => '5'
        ],
        'subtotal' => [
            'type'       => 'DECIMAL',
            'constraint' => '10,2',
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
    $this->forge->createTable('tempdetailpenjualan');
}

public function down()
{
    $this->forge->dropTable('tempdetailpenjualan');
}
}
