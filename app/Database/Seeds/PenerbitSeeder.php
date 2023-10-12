<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PenerbitSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
            'id_penerbit'       => 'NUMED',
            'nama_penerbit'     => 'Nuha Medika',
            'no_hp'             => '08111222333',
            'prov'              => 'Daerah Istimewa Yogyakarta',
            'kota'              => 'Yogyakarta',
            'kec'               => 'Mergangsan',
            'kel'               => 'Wirogunan',
            'kode_pos'          => '55151',
            'alamat'            => 'Mergangsan Yogyakarta',
            'created_at'        => time::now(),
            'updated_at'        => time::now()
        ],
            [
            'id_penerbit'       => 'PARAD',
            'nama_penerbit'     => 'Paradigma Yogyakarta',
            'no_hp'             => '08222333444',
            'prov'              => 'Daerah Istimewa Yogyakarta',
            'kota'              => 'Yogyakarta',
            'kec'               => 'Mergangsan',
            'kel'               => 'Wirogunan',
            'kode_pos'          => '55151',
            'alamat'            => 'Mergangsan Yogyakarta',
            'created_at'        => time::now(),
            'updated_at'        => time::now()
        ]
    ];

        $this->db->table('penerbit')->insertBatch($data);




        // data untuk pagination
        // $faker = \Faker\Factory::create('id_ID');

        // $banyakData = 20;

        // for ($i = 0; $i < $banyakData; $i++) {
        //     $data = [
        //         'id_penerbit' => strtoupper($faker->unique()->word()), 
        //         'nama_penerbit' => $faker->company(),
        //         'no_hp' => $faker->phoneNumber(),
        //         'prov' => $faker->city(), 
        //         'kota' => $faker->city(),
        //         'kec' => $faker->citySuffix(),
        //         'kel' => $faker->citySuffix(),
        //         'kode_pos' => $faker->postcode(), 
        //         'alamat' => $faker->address(),
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now(),
        //     ];

        //     // Gunakan Query Builder untuk memasukkan data
        //     $this->db->table('penerbit')->insert($data);
        // }
    }
}