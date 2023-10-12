<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\BukuModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\PenerbitModel;

class Buku extends ResourceController
{
    protected $buku;
    protected $penerbit;
    use ResponseTrait;
    public function __construct()
    {
        $this->buku = new BukuModel();
        $this->penerbit = new PenerbitModel();
    }
    public function index($id = null)
    {
        // $page   = $this->request->getJsonVar('page') ?? 1;
        // $limit  = $this->request->getJsonVar('limit') ?? 6; 
        // $urut  = $this->request->getJsonVar('urut') ?? 'DESC'; 
        $page   = $this->request->getGet('page') ?? 1;
        $limit  = $this->request->getGet('limit') ?? 2; 
        $urut  = $this->request->getGet('urut') ?? 'DESC';
        if ($id)
        {
            $data = $this->buku->where('id', $id)->first();
            return $this->respond($data, 200);
        }
        $data = $this->buku->tampildata($limit, $page, $urut);
        $response = [
            'data'      => $data,
            'pager'     => $this->buku->pager->getDetails()
        ];

        return $this->respond($response, 200);
    }

    public function show($id = null)
    {
        $keyword = $this->request->getJsonVar('keyword');
        $page   = $this->request->getJsonVar('page') ?? 1;
        $limit  = $this->request->getJsonVar('limit') ?? 6; 
        if(!$keyword) 
        {
            return $this->failNotFound('masukan keyword');
        }
        $data = $this->buku->cari($keyword)->paginate($limit, 'default', $page);
        if(!$data)
        {
            return $this->failNotFound('data tidak ditemukan');
        }
        $response = [
            'data'      => $data,
            'pager'     => $this->buku->pager->getDetails()
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {

        $id_penerbit = strtoupper($this->request->getJsonVar('id_penerbit'));
        
        $data = [
            'id_penerbit'      => $id_penerbit,
            'judul'            => $this->request->getJsonVar('judul'),
            'penulis'          => $this->request->getJsonVar('penulis'),
            'harga'            => $this->request->getJsonVar('harga'),
            'stok'             => $this->request->getJsonVar('stok'),
            'cover'            => $this->request->getJsonVar('cover')
        ];
        //    cari id buku terakhir berdasarkan id_penerbit
        $lastBook = $this->buku->where('id_penerbit', $id_penerbit)->orderBy('id_buku', 'DESC')->first();   
        
        // inisialisasi nomor
        $i = 1;

        if(!$lastBook)
        {   
            if ($lastBook = $this->penerbit->where('id_penerbit', $id_penerbit)->first())
            {
                $lastBook = '001';
            }
            else 
            {
                return $this->failNotFound('id penerbit belum terdaftar');
            }
        } else
        {
            // jika ada buku sebelumnya ditambah 1
            $i = intval(substr($lastBook['id_buku'], -3)) + 1;
        }

        $format_id_buku = sprintf("%03d", $i);

        // generate id_buku dengan format id_penerbit
        $data['id_buku'] = strtoupper($id_penerbit . $format_id_buku);
            $this->buku->setValidationRules([
               'id_buku'           => 'required|is_unique[buku.id_buku]'
            ]);

           $this->buku->setValidationMessages([
               'id_buku'       => [
                   'required'      => 'silahkan masukan id buku',
                   'is_unique'     => 'id sudah dipakai'
               ]
           ]);
   
           if(!$this->buku->save($data)){
            return $this->fail($this->buku->errors());
           }
   
           $response = [
               'status'    => 201,
               'error'     => null,
               'messages'  => [
                   'success' => 'data buku berhasil disimpan'
               ]
           ];
           return $this->respond($response, 201);
    }

    public function update($id = null)
    {
        $pencarian = $this->buku->where('id', $id)->first();
        $id_buku = $pencarian['id_buku'];
        $data = [
            'id'            => $id,
            'id_penerbit'   => $pencarian['id_penerbit'],
            'id_buku'       => $id_buku,
            'judul'         => $this->request->getJsonVar('judul'),
            'penulis'       => $this->request->getJsonVar('penulis'),
            'harga'         => $this->request->getJsonVar('harga'),
            'stok'          => $this->request->getJsonVar('stok'),
            'cover'         => $this->request->getJsonVar('cover')
        ];

        // validasi data tidak id ada di tabel buku
        if(!$pencarian) return $this->failNotFound('Data buku tidak ditemukan');

        // validasi form untuk tabel buku
        if(!$this->buku->save($data))
        {
            return $this->fail($this->buku->errors());
        }

        $response = [
            'status'    => 200,
            'error'     => null,
            'messages'  => [
                'success'   => "data buku $id_buku berhasil diubah"
                ]
            ];
        return $this->respond($response);
    }
}
