<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerbitModel extends Model
{
    protected $table            = 'penerbit';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_penerbit','nama_penerbit','no_hp','prov','kota', 'kec','kel','kode_pos','alamat'];

    
    // validation rules
    protected $validationRules = [
        'no_hp' => 'required|max_length[15]'
    ];
    protected $validationMessages = [
        'no_hp'             => [
            'required'      => 'silahkan masukan no hp',
            'max_length'    => 'maksimal 15 karakter'
            ]
        ];
        
        // Dates
        protected $useTimestamps = true;
        protected $dateFormat    = 'datetime';
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';

        public function cari($keyword)
        {
            return $this->table('penerbit')->like('id_penerbit', $keyword)->orLike('nama_penerbit', $keyword)->orLike('alamat', $keyword)->orLike('no_hp', $keyword);
        }
}
