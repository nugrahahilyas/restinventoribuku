BISNIS REQUIREMENT DOCUMENT

A.	Ringkasan
Dokumen ini bertujuan untuk merinci kebutuhan bisnis sistem pengelolaan stok dan penjualan buku berbasis web. Sistem ini adalah sistem web service sebagai pusat data, logika bisnis, dan validasi data dilakukan menggunakan REST API.

B.	Tujuan Proyek
Tujuan proyek ini adalah mengembangkan sistem pengelolaan stok dan penjualan buku yang efisien dan mudah digunakan. Sistem ini akan memungkinkan pemilik toko buku untuk melacak stok buku, mengelola transaksi penjualan, dan pengelolaan data yang terintegritas.

C.	Pernyataan Kebutuhan
1)	Manajemen Data Penerbit, Data Buku dan Data Penjualan
a.	Sistem harus mampu mencatat jumlah stok buku yang tersedia.
b.	Sistem harus dapat mampu menampilkan semua data berbentuk JSON
c.	Sistem harus bisa mengelola data memenambahkan, mengedit data buku, data penerbit, dan data penjualan stok.
d.	Stok harus diperbarui secara otomatis setelah setiap transaksi penjualan.
e.	Kode buku di produksi oleh sistem

2)	Penjualan Buku
a.	Sistem harus memungkinkan pengguna untuk mencatat penjualan buku.
b.	Setiap transaksi penjualan harus mencatat buku yang dijual, jumlahnya, dan total harga.
c.	Kode penjualan diproduksi oleh sistem

3)	Manajemen Pengguna
a.	Sistem harus memiliki mekanisme otentikasi dan otorisasi untuk pengguna.

D.	Ruang Lingkup Proyek
1)	Sistem Web Service (Pusat Data)
a.	Pengembangan sistem backend berbasis web dengan teknologi REST API.
b.	Sistem harus dapat menerima permintaan dari sistem klien dan memberikan respons yang sesuai.
c.	Pengelolaan database yang mencakup informasi stok buku, transaksi penjualan, dan data pengguna.
d.	Integritas data ketika data diinput,
e.	Kode buku diproduksi oleh sistem
f.	Kode penjualan diproduksi oleh sistem 

2)	Keamanan
a.	Implementasi protokol keamanan, termasuk otentikasi dan otorisasi pengguna.

E.	Alur Sistem














  
F.	Teknikal Desain
1)	ERD (Entity Relational Diagram) 


 
2)	Web Services Deployment
a.	Framework menggunakan Codeigniter 4.4
b.	DBMS Xampp versi 8.0.28

3)	Web Service Authentication and Authorization
a.	Password Hash HS256
b.	Web Token API type Bearer Token

G.	API Spec
Authentication
•	Header : 
o	Bearer Token : “Token anda”
Tampil Data Penerbit Tertentu
	Request :
•	Method : GET
•	Endpoint : /api/penerbit/{id}
•	Header : 
o	Accept : application/json
	Response :
{
        "id": "1",
    "id_penerbit": "NUMED",
    "nama_penerbit": "Nuha Medika",
    "no_hp": "08111222333",
    "prov": "Daerah Istimewa Yogyakarta",
    "kota": "Yogyakarta",
    "kec": "Mergangsan",
    "kel": "Wirogunan",
    "kode_pos": "55151",
    "alamat": "Mergangsan Yogyakarta",
    "created_at": "2023-09-13 01:42:21",
    "updated_at": "2023-09-13 01:42:21"
    }
Tampil Semua Data Penerbit 
	Request :
•	Method : GET
•	Endpoint : /api/penerbit/
•	Header : 
o	Accept : application/json
o	Content-type : application/json
•	Request Param :
o	limit : number,
o	page : number,
o	urut : desc/asc
	Response :
{
“data” : [
{penerbit1},{penerbit2}
],
“pager” : {
"currentUri": {},
        "uri": {},
        "hasMore": false,
        "total": 2,
        "perPage": 6,
        "pageCount": 1,
        "pageSelector": "page",
        "currentPage": 1,
        "next": null,
        "previous": null,
        "segment": 0
}
}
Tampil Kata Pencarian Data Penerbit 
	Request :
•	Method : GET
•	Endpoint : /api/penerbit/show
•	Header : 
o	Accept : application/json
o	Content-Type : application/json
•	Request Param :
o	keyword : id_penerbit / nama_penerbit /  alamat / no_hp
o	limit : number,
o	page : number
	Response :
{
“code” : “number”,
“status” : “string”,
“data” : [
{penerbit1},
{penerbit2}, dst
]
}

Tambah Data Penerbit
	Request :
•	Method : POST
•	Endpoint : /api/penerbit/
•	Header : 
o	Accept : application/json
o	Content-type : application/json
•	Body
{
        "id_penerbit": "id_penerbit", (required|unique)
        "nama_penerbit": "nama_penerbit", (required)
        "no_hp": "no_hp", (required|max_length[15])
        "prov": "Provinsi", (null)
        "kota": "Kota/Kabupaten", (null)
        "kec": "Kecamatan", (null)
        "kel": "Kelurahan", (null)
        "kode_pos": "kode_pos", (null)
        "alamat": "Alamat Lengkap", (required)
}
Response
{
    "status": 201,
    "error": null,
    "messages": {
        "success": "data penerbit berhasil disimpan"
    }
}
Ubah Data Penerbit
	Request :
•	Method : PUT
•	Endpoint : /api/penerbit/{id:num}
•	Header : 
o	Accept : application/json
o	Content-type : application/json
•	Body
{
        "id_penerbit": "id_penerbit", (required|is_unique[penerbit.id_penerbit])
        "nama_penerbit": "nama_penerbit", (required)
        "no_hp": "no_hp", (required)
        "prov": "Provinsi", (null)
        "kota": "Kota/Kabupaten", (null)
        "kec": "Kecamatan", (null)
        "kel": "Kelurahan", (null)
        "kode_pos": "kode_pos", (null)
        "alamat": "Alamat Lengkap" (required)
}
Response
{
    "status": 200,
    "error": null,
    "messages": {
        "success": "data dengan id $id berhasil diubah"
    }
}

Tampil Data Buku Tertentu
	Request :
•	Method : GET
•	Endpoint : /api/buku/{id}
•	Header : 
o	Accept : application/json
	Response :
{
     "id": "id",
    "id_penerbit": " id_penerbit",
    "id_buku": " id_buku",
    "judul": " judul",
    "penulis": " penulis",
    "harga": "harga",
    "stok": "stok",
    "cover": "cover",
    "created_at": “datetime”,
    "updated_at": “datetime”
}
Tampil Semua Data Buku
	Request :
•	Method : GET
•	Endpoint : /api/Buku/
•	Header : 
o	Accept : application/json
o	Content-Type : application/json
•	Request Param :
o	limit : number,
o	page : number
o	urut : desc|asc
	Response :
{
“code” : “number”,
“status” : “string”,
“data” : [
{penerbit1},
{penerbit2}, dst
]
}
Tampil Kata Pencarian Data Buku 
	Request :
•	Method : GET
•	Endpoint : /api/buku/show
•	Header : 
o	Accept : application/json
o	Content-Type : application/json
•	Request Param :
o	limit : number,
o	page : number
o	keyword : id_penerbit, id_buku, judul, penulis
	Response :
{
“data” : [
{penerbit1},
{penerbit2}, dst
],
"pager": {
        "currentUri": {},
        "uri": {},
        "hasMore": false,
        "total": 2,
        "perPage": 6,
        "pageCount": 1,
        "pageSelector": "page",
        "currentPage": 1,
        "next": null,
        "previous": null,
        "segment": 0
    }
}
Menambah Buku Baru
	Request :
•	Method : POST
•	Endpoint : /api/buku/
•	Header : 
o	Accept : application/json
o	Content-type : application/json
•	Body
{
        "id_penerbit": "id_penerbit", (required|is_not_unique[penerbit.id_penerbit])
        "judul": "judul", (required)
        "penulis": "penulis", (required)
        "harga": "harga", (null)
        "stok": "stok", (null)
        "cover": "cover" (null)
}
Response
{
    "status": 201,
    "error": null,
    "messages": {
        "success": " data buku berhasil disimpan"
    }
}
Ubah Data Buku
	Request :
•	Method : PUT
•	Endpoint : /api/buku/{id:num}
•	Header : 
o	Accept : application/json
o	Content-type : application/json
•	Body
{
        "judul": "judul", (required)
        "penulis": "penulis", (required)
        "harga": "harga", (required)
        "stok": "stok", (required)
        "cover": "cover" (null)
}
Response
{
    "status": 200,
    "error": null,
    "messages": {
        "success": "data buku $id_buku berhasil diubah"
    }
}

Tampil Data Penjualan
	Request :
•	Method : GET
•	Endpoint : /api/penjualan/
•	Header : 
o	Accept : application/json
o	Content-type : application/json
•	Body
{
        "page": "page", 
        "limit": "limit", 
        "urut": "urut"
}
Response
{
    "data": [
{penjualan1}, (penjualan2)
],
“pager” : 
{
        "currentUri": {},
        "uri": {},
        "hasMore": false,
        "total": 3,
        "perPage": 2,
        "pageCount": 2,
        "pageSelector": "page",
        "currentPage": 1,
        "next": "http://localhost:8080/index.php/api/penjualan/?page=2",
        "previous": null,
        "segment": 0
    }
}
Tambah Data tempPenjualan
	Request :
•	Method : POST
•	Endpoint : /api/temp/
•	Header : 
o	Accept : application/json
o	Content-type : application/json
•	Body
{
        "id_buku": "id_buku", (required|is_not_unique[buku.id_buku]) 
        "jumlah": "jumlah" (required|is_numeric)
}
Response
{
    "status": 201,
    "error": null,
    "messages": {
        "success": [
            {datatemp1},{datatemp2}
]
}
}
Ubah Data tempPenjualan
	Request :
•	Method : PUT
•	Endpoint : /api/temp/(:num)
•	Header : 
o	Accept : application/json
o	Content-type : application/json
•	Body
{
        "id_buku": "id_buku", (required|is_not_unique[buku.id_buku]) 
        "jumlah": "jumlah" (required|is_numeric)
}
Response
{
    "status": 201,
    "error": null,
    "messages": {
        "success": [
            {datatemp1},{datatemp2}
]
}
}
Simpan Data tempPenjualan ke tabel penjualan dan detailpenjualan
	Request :
•	Method : GET
•	Endpoint : /api/simpanpenjualan
•	Header : 
o	Accept : application/json
Response
{
    "status": 201,
    "error": null,
    "messages": {
        "success": { (last_data_penjualan)
            "id": "5",
            "id_penjualan": "CUST00004",
            "total": "250000.00",
            "created_at": "2023-09-13 10:13:24",
            "updated_at": "2023-09-13 10:13:24"
        }
    }
}

Lihat data detailpenjualan
	Request :
•	Method : GET
•	Endpoint : /api/detailpenjualan
•	Header : 
o	Accept : application/json
o	Content-type : application/json
•	Body
{
        "page": "page", 
        "limit": "limit", 
        "urut": "urut"
}
{
    "data": [
{detailpenjualan1}, (detailpenjualan2)
],
“pager” : 
{
        "currentUri": {},
        "uri": {},
        "hasMore": false,
        "total": 3,
        "perPage": 2,
        "pageCount": 2,
        "pageSelector": "page",
        "currentPage": 1,
        "next": "http://localhost:8080/index.php/api/penjualan/?page=2",
        "previous": null,
        "segment": 0
    }
}

