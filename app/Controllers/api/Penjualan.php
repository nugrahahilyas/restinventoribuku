<?php

namespace App\Controllers\Api;

use App\Models\BukuModel;
use App\Models\PenjualanModel;
use App\Models\TempDetailPenjualanModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\DetailPenjualanModel;

class Penjualan extends ResourceController
{
  
    protected $penjualan;
    protected $tabeltemp;
    protected $buku;
    protected $detailpenjualan;
    use ResponseTrait;

    public function __construct()
    {
        $this->penjualan = new PenjualanModel();
        $this->tabeltemp = new TempDetailPenjualanModel();
        $this->buku = new BukuModel();
        $this->detailpenjualan = new DetailPenjualanModel();
    }

    public function index()
    {
        $limit = $this->request->getJsonVar('limit') ?? 6 ;
        $page = $this->request->getJsonVar('page') ?? 1 ;
        $urut = $this->request->getJsonVar('urut') ?? 'DESC' ;

        $data = $this->penjualan->tampildata($limit, $page, $urut);

        $response = [
            
            'data'      => $data,
            'pager'     => $this->penjualan->pager->getDetails()
        ];
        return $this->respond($response, 200);
    }

    public function lihatTemp($id = null)
    {
        $page = $this->request->getJsonVar('page') ?? 1 ;
        $limit = $this->request->getJsonVar('limit') ?? 6 ;
        $urut = $this->request->getJsonVar('urut') ?? 'DESC' ;

        $data = $this->tabeltemp->tampildata($limit, $page, $urut);

        $response = [
            'data'      => $data,
            'pager'     => $this->tabeltemp->pager->getDetails()
        ];
        return $this->respond($response, 200);
    }

    public function lihatDetailPenjualan($id = null)
    {
        $page = $this->request->getJsonVar('page') ?? 1 ;
        $limit = $this->request->getJsonVar('limit') ?? 6 ;
        $urut = $this->request->getJsonVar('urut') ?? 'DESC' ;
        

        $data = $this->detailpenjualan->tampildata($limit, $page, $urut);

        $response = [
            'data'      => $data,
            'pager'     => $this->detailpenjualan->pager->getDetails()
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {
        
        // validasi di tabel temp ada data atau tidak
        $temp = $this->tabeltemp->selectMax('id_penjualan', 'last_id_penjualan')->get()->getRow()->last_id_penjualan;
        $penjualan = $this->penjualan->selectMax('id_penjualan', 'last_id_penjualan')->get()->getRow()->last_id_penjualan;
        
        // jika di tabel temp dan penjualan kosong
        if($temp === null && $penjualan === null)
        {
            $resultgenerate = 'CUST00001';
        } 
        
        // jika $temp nya kosong dan tabel penjualannnya ada 
        elseif($temp === null && $penjualan !== null)
        {
                // $sequence = 1;
                $sequence = intval(substr($penjualan, -5)) + 1;
                $generateidpenjualan = sprintf("%05d", $sequence);
                $resultgenerate = 'CUST' . $generateidpenjualan;
        }
        // jika di tabel temp ada
        elseif ($temp !== null)
        {
            $resultgenerate = $temp;
        }

        // validasi id_buku ada di tabel buku tidak
        $id_buku = $this->request->getJsonVar('id_buku');

        $rowbuku = $this->buku->where('id_buku', $id_buku)->get()->getResultArray();

        if($rowbuku == null)
        {
            return $this->fail('id buku tidak ditemukan');
        }
        
        // menghitung subtotal
        $jumlah = $this->request->getJsonVar('jumlah');
        
        if(!is_numeric($jumlah))
        {
            return $this->fail('jumlah buku harus angka');
        }

        $hargabuku = $this->buku->select('harga')->where('id_buku', $id_buku)->get()->getRow()->harga;
        $subtotal = $jumlah * $hargabuku;
        
        $data = [
            'id_penjualan'  => $resultgenerate,
            'id_buku'       => $id_buku,
            'jumlah'        => $jumlah,
            'subtotal'      => $subtotal
        ];
        
        // validasi form simpan ke tabel temp
        if(!$this->tabeltemp->save($data))
        {
            return $this->fail($this->tabeltemp->errors());
        }
        
        //tampilkan semua data temp
        $datatemp = $this->tabeltemp->select('*')->orderBy('id', 'DESC')->get()->getResultArray();
        $response = [
            'status'    => 201,
            'error'     => null,
            'messages'  => [
                'success' => $datatemp
            ]
        ];
        return $this->respond($response, 201);
    }

    public function simpanPenjualan()
    {
        // simpan data di tabel penjualan
        $id_penjualan = $this->tabeltemp->selectMax('id_penjualan', 'last_id_penjualan')->get()->getRow()->last_id_penjualan;
        $total = $this->tabeltemp->selectSum('subtotal', 'sum_subtotal')->get()->getRow()->sum_subtotal;
        $datapenjualan = [
            'id_penjualan'  => $id_penjualan,
            'total'         => $total
        ];

        $temp = $this->tabeltemp->select('*')->get()->getResultArray();

        // jika data temp tidak ada 
        if(!$temp)
        {
            return $this->fail('input buku yang jual');
        }

        // validasi simpan penjualan
        if(!$this->penjualan->save($datapenjualan))
        {
            return $this->fail($this->penjualan->errors());
        } 
        
        // input temp ke tabel detailpenjualan
        foreach ($temp as $row)
        {
            $id_buku = $row['id_buku'];
            $jumlah = $row['jumlah'];
            $data = [
                'id_penjualan'  => $row['id_penjualan'],
                'id_buku'       => $id_buku,
                'jumlah'        => $jumlah,
                'subtotal'      => $row['subtotal']
            ];

            //kurangi stok di tabel buku
            $stok = $this->buku->select('stok')->where('id_buku', $id_buku)->get()->getRow()->stok;
            $resultstok = $stok - $jumlah;
            $this->buku->where('id_buku', $id_buku)->set('stok', $resultstok)->update();             

            //simpan data ke tabel detailpenjualan
            $this->detailpenjualan->save($data);
        }

        //kosongkan tabel temp
        $this->tabeltemp->emptyTable();

        //respon api
        $response = [
            'status'    => 201,
            'error'     => null,
            'messages'  => [
                'success' => $this->penjualan->orderBy('created_at', 'DESC')->get()->getRow()
            ]
        ];
        return $this->respond($response, 201);
    }
       
    public function update($id = null)
    {
        $temp = $this->tabeltemp->where('id', $id)->first();
        if(!$temp)
        {
            return $this->fail('id tidak ditemukan');
        }
        $buku = new BukuModel();
        $id_buku = $this->request->getJsonVar('id_buku');
        $jumlah = $this->request->getJsonVar('jumlah');
        
        // VALIDASI INPUT JUMLAH
        if(!is_numeric($jumlah))
        {
            return $this->fail('jumlah buku harus angka');
        }

        // HITUNG SUBTOTAL
        $hargabuku = $buku->select('harga')->where('id_buku', $id_buku)->get()->getRow()->harga;
        $subtotal = $jumlah * $hargabuku;
        
        $data = [
            'id'            => $id,
            'id_buku'       => $id_buku,
            'jumlah'        => $jumlah,
            'subtotal'      => $subtotal
        ];
        
        // validasi form simpan ke tabel temp
        if(!$this->tabeltemp->save($data))
        {
            return $this->fail($this->tabeltemp->errors());
        }
        
        //tampilkan semua data temp
        $datatemp = $this->tabeltemp->select('*')->orderBy('updated_at', 'DESC')->get()->getResultArray();
        $response = [
            'status'    => 201,
            'error'     => null,
            'messages'  => [
                'success' => $datatemp
            ]
        ];
        return $this->respond($response, 201);

    }
}
