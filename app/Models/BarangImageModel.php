<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangImageModel extends Model
{
    protected $table            = 'barang_image';
    protected $allowedFields = ['nama_image', 'barang_kode_barang',];
    protected $useTimestamps = true;
    // Dates
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
