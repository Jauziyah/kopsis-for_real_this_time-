<?php 

namespace App\Models;

use CodeIgniter\Model;

class PaymentMethod extends Model
{
    protected $table            = 'pembayaran';
    protected $protectFields = true;
    protected $useTimestamps = true;

    // Dates
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

?>