<?php 

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel_register extends Model
{
    protected $table            = 'pelanggan';
    protected $protectFields = false; 
    protected $useTimestamps = true;

    // Dates
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

?>