<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPenjualanModel extends Model
{
    protected $table            = 'detailpenjualan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_penjualan', 'id_buku', 'jumlah', 'subtotal'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function tampildata($limit, $page, $urut)
    {
        return $this->table('detailpenjualan')->select('*')->orderBy('id', $urut)->paginate($limit, 'default', $page);
    }
}
