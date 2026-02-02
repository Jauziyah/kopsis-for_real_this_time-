<?php 

namespace App\Models;

use CodeIgniter\Model;

class BarangKeranjangModel extends Model
{
    protected $table            = 'barang_keranjang';
    protected $primaryKey       = 'produk_keranjang_id';
    protected $allowedFields    = ['barang_kode_barang', 'keranjang_keranjang_id', 'jumlah_barang'];


    protected $useTimestamps = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getById($keranjang_id)
    {
        $result = $this->where('keranjang_keranjang_id', $keranjang_id)->findAll();

        return $result;
    }

}

?>