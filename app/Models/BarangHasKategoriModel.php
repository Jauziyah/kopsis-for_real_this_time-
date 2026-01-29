<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangHasKategoriModel extends Model
{
    protected $table            = 'barang_has_kategori';
    protected $allowedFields = ['kategori_id_kategori', 'barang_kode_barang',];
    protected $useTimestamps = true;
    // Dates
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function getBarangKategori($kode_barang)
    {
        $result = $this->select('kategori_id_kategori')->where('barang_kode_barang', $kode_barang)->findAll();
        return array_column($result, 'kategori_id_kategori');
    }

}
