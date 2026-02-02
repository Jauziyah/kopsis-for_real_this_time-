<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangKeranjangModel;

class PelangganTransaksi extends BaseController
{
    protected $barang_keranjang_model;

    public function __construct()
    {
      $this->barang_keranjang_model = new BarangKeranjangModel();
    }

    public function index()
    {
        return view('pelanggan/transaksi');
    }
}


?>