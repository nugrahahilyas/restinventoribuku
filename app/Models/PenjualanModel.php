<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table            = 'penjualan';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_penjualan', 'total'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'id_penjualan'  =>  'required'
    ];
    protected $validationMessages   = [
        'id_penjualan'  => [
            'required'  =>  'id penjualan belum dibuat'
        ]
    ];
    public function tampildata($limit, $page, $urut)
    {
        return $this->table('penjualan')->select('*')->orderBy('id', $urut)->paginate($limit, 'default', $page);
    }
}
