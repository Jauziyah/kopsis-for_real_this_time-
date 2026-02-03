<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table            = 'detail_transaksi';
    protected $protectFields = false;
    protected $useTimestamps = true;

    // Dates
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


}
