<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class AdminKategori_crudv extends BaseController
{
    protected $kategori_model;
    protected $validator;
    public function __construct()
    {
        $this->kategori_model = new KategoriModel();
        $this->validator = \Config\Services::validation();
    }

    public function index()
    {
        $kategori_row = $this->kategori_model->findAll();

        $data = [
            'kategori_row' => $kategori_row
        ];

        return view('admin_toko/kategori', $data);
    }

    public function addView()
    {
        $data = ['validation' => $this->validator];

        return view('admin_toko/add_kategori', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_kategori' => [
                'rules' => 'required|is_unique[kategori.nama_kategori]',
                'errors' => [
                    'required' => 'Nama kategori harus diisi',
                    'is_unique' => 'Kategori sudah ada'
                ]
            ]
        ])) {
            $data = ['validation' => $this->validator];
            return view('admin_toko/add_kategori', $data);
        }

        $this->kategori_model->save([
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);

        session()->setFlashdata('pesan', 'kategori berhasil ditambahkan');

        return redirect()->route('admin_toko.kategori_view');
    }

    public function delete($id)
    {
        $this->kategori_model->delete($id);
        session()->setFlashdata('pesan', 'Selamat kategori berhasil didelete');
        return redirect()->route('admin_toko.kategori_view');;
    }

    public function updateView($id)
    {
        $data =  [
            'kategori' => $this->kategori_model->getKategoriDetail($id),
            'validation' => $this->validator
        ];
        return view('admin_toko/update_kategori', $data);
    }

    public function update($id)
    {

        if (!$this->validate([
            'nama_kategori' => [
                'rules' => 'required|is_unique[kategori.nama_kategori,id_kategori,' . $id . ']',
                'errors' => [
                    'required' => 'Nama kategori harus diisi',
                    'is_unique' => 'Kategori sudah ada'
                ]
            ]
        ])) {
            $kategori = $this->kategori_model->find($id);
            $data = [
                
                'validation' => $this->validator,
                 'kategori'    => $kategori,
            ];
            return view('admin_toko/update_kategori', $data);
        }

        $this->kategori_model->save([
            'id_kategori' => $id,
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);

        return redirect()->route('admin_toko.kategori_view');;
    }
}
