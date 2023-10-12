<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penerbit extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'id_penerbit' => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'unique'         => true 
            ],
            'nama_penerbit' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'prov' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true 
            ],
            'kota' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true
            ],
            'kec' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true
            ],
            'kel' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true
            ],
            'kode_pos' => [
                'type'       => 'VARCHAR',
                'constraint' => '6',
                'null'       => true
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
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
        $this->forge->createTable('penerbit');
    }

    public function down()
    {
        $this->forge->dropTable('penerbit');
    }
}
