<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PenerbitModel;
use CodeIgniter\API\ResponseTrait;

class Penerbit extends ResourceController
{
    protected $penerbit;
    use ResponseTrait;
    public function __construct()
    {
        $this->penerbit = new PenerbitModel();
    }
    public function index($id = null)
    {
        // $page   = $this->request->getVar('page') ?? 1;
        // $limit  = $this->request->getVar('limit') ?? 6; 
        // $urut  = $this->request->getVar('urut') ?? 'DESC';
        $page   = $this->request->getGet('page') ?? 1;
        $limit  = $this->request->getGet('limit') ?? 2; 
        $urut  = $this->request->getGet('urut') ?? 'DESC';
        if ($id)
        {
            $data = $this->penerbit->where('id', $id)->first();
            return $this->respond($data, 200);
        }
        // $data = $this->penerbit->orderBy('id', 'DESC')->findAll(); 
        $data = $this->penerbit->orderBy('id', $urut)->paginate($limit, 'default', $page);
        $response = [
            'data'      => $data,
            'pager'     => $this->penerbit->pager->getDetails()
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
        $data = $this->penerbit->cari($keyword)->paginate($limit, 'default', $page);
        if(!$data)
        {
            return $this->failNotFound('data tidak ditemukan');
        }
        $response = [
            'data'      => $data,
            'pager'     => $this->penerbit->pager->getDetails()
        ];
        return $this->respond($response, 200);
    }

    public function create()
    {

        $data = [
         'id_penerbit'      => strtoupper($this->request->getJsonVar('id_penerbit')),
         'nama_penerbit'    => $this->request->getJsonVar('nama_penerbit'),
         'no_hp'            => $this->request->getJsonVar('no_hp'),
         'prov'             => $this->request->getJsonVar('prov'),
         'kota'             => $this->request->getJsonVar('kota'),
         'kec'              => $this->request->getJsonVar('kec'),
         'kel'              => $this->request->getJsonVar('kel'),
         'kode_pos'         => $this->request->getJsonVar('kode_pos'),
         'alamat'           => $this->request->getJsonVar('alamat')
        ];
        $this->penerbit->setValidationRules([
            'id_penerbit'       => 'required|is_unique[penerbit.id_penerbit]',
            'nama_penerbit'     => 'required|is_unique[penerbit.nama_penerbit]']);
        $this->penerbit->setValidationMessages([
            'id_penerbit'       => [
                'required'      => 'silahkan masukan id penerbit',
                'is_unique'     => 'id sudah dipakai',
            ],
            'nama_penerbit'     => [
                'required'      => 'silahkan masukan nama penerbit',
                'is_unique'     => 'nama penerbit sudah dipakai'
            ]
        ]);
        if(!$this->penerbit->save($data))
        {
            return $this->fail($this->penerbit->errors());
        }

        $response = [
            'status'    => 201,
            'error'     => null,
            'messages'  => [
                'success' => 'data penerbit berhasil disimpan'
            ]
        ];
        return $this->respond($response, 201);
    }

    public function update($id = null)
    {
        $data = [
            'id'               => $id,
            'id_penerbit'      => $this->request->getJsonVar('id_penerbit'),
            'nama_penerbit'    => $this->request->getJsonVar('nama_penerbit'),
            'no_hp'            => $this->request->getJsonVar('no_hp'),
            'prov'             => $this->request->getJsonVar('prov'),
            'kota'             => $this->request->getJsonVar('kota'),
            'kec'              => $this->request->getJsonVar('kec'),
            'kel'              => $this->request->getJsonVar('kel'),
            'kode_pos'         => $this->request->getJsonVar('kode_pos'),
            'alamat'           => $this->request->getJsonVar('alamat')
           ];
           $pencarian = $this->penerbit->where('id', $id)->first();
           
           if(!$pencarian) return $this->failNotFound('Data tidak ditemukan');

           if($data['id_penerbit'] != $pencarian['id_penerbit'])
           {
            $this->penerbit->setValidationRules([
                'id_penerbit'       => 'required|is_unique[penerbit.id_penerbit]']);
            $this->penerbit->setValidationMessages([
                'id_penerbit'       => [
                    'required'      => 'silahkan masukan id penerbit',
                    'is_unique'     => 'id penerbit sudah dipakai'
                ]
            ]);
        } 
        
        if($data['nama_penerbit'] != $pencarian['nama_penerbit'])
        {
            $this->penerbit->setValidationRules([
                'nama_penerbit'       => 'required|is_unique[penerbit.nama_penerbit]']);
            $this->penerbit->setValidationMessages([
                'nama_penerbit'       => [
                    'required'      => 'silahkan masukan nama penerbit',
                    'is_unique'     => 'nama penerbit sudah dipakai'
                ]
            ]);
        } 
        if(!$this->penerbit->save($data))
        {
            return $this->fail($this->penerbit->errors());
        }
   
           $response = [
               'status'    => 200,
               'error'     => null,
               'messages'  => [
                   'success' => "data dengan id $id berhasil diubah"
               ]
           ];
           return $this->respond($response);
    }
}
