<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\PenerbitModel;

class BukuModel extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_penerbit','id_buku','judul','penulis','harga','stok','cover','created_at','updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'id_penerbit' => 'required',
        'judul'     =>  'required',
        'penulis'   =>  'required',
        'harga'     =>  'required',
        'stok'      =>  'required'
    ];

    protected $validationMessages = [
        'id_penerbit'     => [
            'required'        => 'Silahkan masukan id penerbit Buku'
        ],
        'judul'     => [
            'required'  => 'Silahkan masukan Judul Buku'
        ],
        'penulis'     => [
            'required'  => 'Silahkan masukan Penulis Buku'
        ],
        'harga'     => [
            'required'  => 'Silahkan masukan Harga Buku'
        ],
        'stok'     => [
            'required'  => 'Silahkan masukan Stok Buku'
        ]
    ];

    public function cari($keyword)
    {
        return $this->table('buku')->select('buku.id, buku.id_penerbit, buku.id_buku, buku.judul, penerbit.nama_penerbit, buku.penulis, buku.harga, buku.stok, buku.cover, buku.created_at, buku.updated_at')->join('penerbit', 'penerbit.id_penerbit=buku.id_penerbit', 'LEFT')
        ->like('buku.id_penerbit', $keyword)->orLike('buku.id_buku', $keyword)->orLike('buku.judul', $keyword)->orLike('buku.penulis',$keyword)->orLike('penerbit.nama_penerbit', $keyword);
    }
    public function tampildata($limit, $page, $urut)
    {
        return $this->table('buku')->select('buku.id, buku.id_penerbit, buku.id_buku, buku.judul, penerbit.nama_penerbit, buku.penulis, buku.harga, buku.stok, buku.cover, buku.created_at, buku.updated_at')->join('penerbit', 'penerbit.id_penerbit=buku.id_penerbit', 'LEFT')->orderBy('id', $urut)->paginate($limit, 'default', $page);
    }
}
