<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Buku extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'constraint'     => 8,
            'auto_increment' => true,
        ],
        'id_penerbit' => [
            'type'           => 'VARCHAR',
            'constraint'     => '10',
        ],
        'id_buku' => [
            'type'           => 'VARCHAR',
            'constraint'     => '10',
            'unique'         => true
        ],
        'judul' => [
            'type'       => 'VARCHAR',
            'constraint' => '128',
        ],
        'penulis' => [
            'type'       => 'VARCHAR',
            'constraint' => '128',
        ],
        'harga' => [
            'type'       => 'DECIMAL',
            'constraint' => '10,2',
        ],
        'stok' => [
            'type'       => 'INT',
            'constraint' => '5',
        ],
        'cover' => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
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
    $this->forge->addForeignKey('id_penerbit', 'penerbit', 'id_penerbit');
    $this->forge->addKey('id', true);
    $this->forge->createTable('buku');
}

public function down()
{
    $this->forge->dropTable('buku');
}

}