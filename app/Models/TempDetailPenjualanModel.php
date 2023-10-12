<?php

namespace App\Models;

use CodeIgniter\Model;

class TempDetailPenjualanModel extends Model
{
    protected $table            = 'tempdetailpenjualan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_penjualan', 'id_buku', 'jumlah', 'subtotal'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'id_penjualan'      => 'required',
        'id_buku'           => 'required',
        'jumlah'            => 'required|integer'
    ];
    protected $validationMessages   = [
        'id_penjualan'  => [
            'required'  =>  'id penjualan belum dibuat'
        ],
        'id_buku'  => [
            'required'  =>  'id buku belum diinput'
        ],
        'jumlah'  => [
            'required'  =>  'masukan jumlah buku',
            'integer'   =>  'jumlah harus bentuk angka'
        ],
    ];
    public function tampildata($limit, $page, $urut)
    {
        return $this->table('tempdetailpenjualan')->select('*')->orderBy('id', $urut)->paginate($limit, 'default', $page);
    }
}
