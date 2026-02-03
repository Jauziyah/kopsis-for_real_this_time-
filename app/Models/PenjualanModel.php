<?php 

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table            = 'penjualan';
    protected $protectFields = false; 
    protected $useTimestamps = true;

    protected $primaryKey = 'id_penjualan'; 
    // Dates
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

        public function getDetailTransaksi($id_penjualan)
    {
        return $this->db->table('detail_transaksi')
            ->select('detail_transaksi.*, barang.nama_barang, barang.kode_barang, penjualan.status_transaksi')
            ->join('barang', 'barang.kode_barang = detail_transaksi.barang_kode_barang')
            ->join('penjualan', 'penjualan.id_penjualan = detail_transaksi.penjualan_id_penjualan')
            ->where('detail_transaksi.penjualan_id_penjualan', $id_penjualan)
            ->get()
            ->getResultArray();
    }
    
}

?>