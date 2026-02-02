<?php 

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table            = 'penjualan';
    protected $protectFields = false; 
    protected $useTimestamps = true;

    // Dates
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

?>