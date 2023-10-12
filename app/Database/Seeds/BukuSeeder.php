<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run()
    {

        // ini data untuk percobaan fungsional
        $data = [
            [
                'id_penerbit'   => 'NUMED', // Ganti dengan id_penerbit yang sesuai
                'id_buku'       => 'NUMED001', 
                'judul'         => "Asuhan Kebidanan Maternitas", // Menggunakan realText untuk judul buku berbahasa Indonesia
                'penulis'       => "Erling Halland", // Nama penulis tetap dalam bahasa Indonesia
                'harga'         => "45000",
                'stok'          => 5,
                'cover'         => 'default.jpg'
            ],
            [
                'id_penerbit'   => 'PARAD', // Ganti dengan id_penerbit yang sesuai
                'id_buku'       => 'PARAD001', 
                'judul'         => "Hukum Pidana dan Hukum Perdata", // Menggunakan realText untuk judul buku berbahasa Indonesia
                'penulis'       => "Mason Greenwood", // Nama penulis tetap dalam bahasa Indonesia
                'harga'         => "76000",
                'stok'          => 7,
                'cover'         => 'default.jpg'
            ]
        ];
        
        // Insert the fake data into the database
        $this->db->table('buku')->insertBatch($data);


        // ini data untuk percobaan pagination
    //     // Load the Faker library
    //     $faker = \Faker\Factory::create('id_ID');

    //     // Define the number of fake records to generate
    //     $numRecords = 10;

    //     for ($i = 0; $i < $numRecords; $i++) {
    //         $data = [
    //             'id_penerbit'   => 'PARAD', // Ganti dengan id_penerbit yang sesuai
    //             // 'id_buku'       => 'PARAD' . strval($faker->unique()->randomNumber()), // Gunakan unique() untuk menghindari duplikasi
    //             'id_buku'       => 'PARAD' . strval($i), 
    //             'judul'         => $faker->realText(30), // Menggunakan realText untuk judul buku berbahasa Indonesia
    //             'penulis'       => $faker->name(), // Nama penulis tetap dalam bahasa Indonesia
    //             'harga'         => $faker->numberBetween(50000, 100000),
    //             'stok'          => $faker->numberBetween(1, 100),
    //             'cover'         => $faker->imageUrl()
    //         ];
            
    //         // Insert the fake data into the database
    //         $this->db->table('buku')->insert($data);
    // }
}
}