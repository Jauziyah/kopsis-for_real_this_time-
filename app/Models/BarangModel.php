<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey = 'kode_barang';
    protected $allowedFields = ['kode_barang', 'nama_barang', 'harga_barang', 'stok_barang', 'keterangan_barang', 'exp_barang', 'status_ketersediaan'];
    protected $useTimestamps = true;
    protected $useAutoIncrement = false; 
    // Dates
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
