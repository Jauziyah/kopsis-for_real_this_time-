<?php

namespace App\Models;

use CodeIgniter\Model;

class FullBarangViewModel extends Model
{
    protected $table            = 'full_barang_view';
    protected $allowedFields = ['nama_barang', 'harga_barang', 'stok_barang', 'keterangan_barang', 'exp_barang', 'status_ketersediaan'];
}
