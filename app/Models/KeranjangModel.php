<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class KeranjangModel extends Model
{
    protected $table            = 'keranjang';
    protected $primaryKey       = 'keranjang_id';
    protected $allowedFields    = ['user_biznet_id_user_biznet'];
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $useAutoIncrement = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $user_model;

    public function findCart($active)
    {
        $cart = $this->where('user_biznet_id_user_biznet', $active)
            ->first();

        return $cart ? $cart['keranjang_id'] : null;
    }
}
