<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\BarangImageModel;
use App\Models\BarangHasKategoriModel;

class AdminBarang_crudv extends BaseController
{
    protected $barang_model;
    protected $kategori_model;
    protected $barang_image_model;
    protected $barang_has_kategori_model;
    public function __construct()
    {
        $this->barang_model = new BarangModel();
        $this->kategori_model = new KategoriModel();
        $this->barang_image_model = new BarangImageModel();
        $this->barang_has_kategori_model = new BarangHasKategoriModel();
    }
    public function index()
    {
        $barang_list = $this->barang_model->findAll();

        $data = [
            'barang_list' => $barang_list
        ];

        return view('admin_toko/barang', $data);
    }

    public function createView()
    {
        $kategori_list = $this->kategori_model->findAll();
        $data = [
            'kategori_list' => $kategori_list,
        ];
        return view('admin_toko/add_barang', $data);
    }

    public function createBarang()
    {
        $barang_code = 'BRG-' . strtoupper(substr(uniqid(), -4));

        $this->barang_model->save([
            'kode_barang' => $barang_code,
            'nama_barang' => $this->request->getVar('nama_barang'),
            'keterangan_barang' => $this->request->getVar('keterangan_barang'),
            'harga_barang' => $this->request->getVar('harga_barang'),
            'stok_barang' => (int) $this->request->getVar('stok_barang'),
            'exp_barang' => $this->request->getVar('exp_barang'),
            'status_ketersediaan' => $this->request->getVar('status_ketersediaan'),
        ]);

        $has_valid_image = false;
        $barang_images = $this->request->getFileMultiple('barang_images');

        if (!empty($barang_images)) {
            foreach ($barang_images as $image) {

                if ($image->getError() !== UPLOAD_ERR_OK)  continue;

                $image_name = $image->getRandomName();
                $image->move('uploads', $image_name);
                $this->barang_image_model->save([
                    'barang_kode_barang' => $barang_code,
                    'nama_image' => $image_name,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $has_valid_image = true;
            }
        }


        if (!$has_valid_image) {
            $this->barang_image_model->save([
                'barang_kode_barang' => $barang_code,
                'nama_image' => 'default_produk.jpg',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        $kategori_inputs = $this->request->getPost('kategori');

        if (!empty($kategori_inputs)) {
            foreach ($kategori_inputs as $kategori_id) {
                $this->barang_has_kategori_model->save([
                    'barang_kode_barang' => $barang_code,
                    'kategori_id_kategori'        => $kategori_id
                ]);
            }
        }

        session()->setFlashdata('pesan', 'produk berhasil ditambahkan');

        return redirect()->route('admin_toko.barang_view');
    }

    public function updateBarang() {}
}

        // if (!$this->validate([
        //     'nama_barang' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'Nama kategori harus diisi',
        //             'is_unique' => 'Kategori sudah ada'
        //         ]
        //     ]
        // ])) {
        //     $data = ['validation' => $this->validator];
        //     return view('admin_toko/add_barang', $data);
        // }
