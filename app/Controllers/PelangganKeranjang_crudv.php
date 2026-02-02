<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FullBarangViewModel;
use App\Models\BarangKeranjangModel;
use App\Models\KeranjangModel;
use App\Models\UsersModel;

class PelangganKeranjang_crudv extends BaseController
{    
    protected $full_barang_view_model;
    protected $barang_keranjang_model;
    protected $keranjang_model;
    protected $user_model;
    public function __construct()
    {
        $this->full_barang_view_model = new FullBarangViewModel();
        $this->barang_keranjang_model = new BarangKeranjangModel();
        $this->keranjang_model = new KeranjangModel();
        $this->user_model = new UsersModel();
    }
    public function index()
    {
        $barang_full = $this->full_barang_view_model->findAll();
        $data = [
            'barang_full' => $barang_full
        ];
        return view('pelanggan/main', $data);
    }

public function addKeranjang()
{
    $biznet_id = $this->user_model->getActiveBiznetId();


    $keranjang_id = $this->keranjang_model->findCart($biznet_id);

    if (!$keranjang_id) {
        $this->keranjang_model->save([
            'user_biznet_id_user_biznet' => $biznet_id,
           
        ]);
        $keranjang_id = $this->keranjang_model->getInsertID();
    }

    $kode_barang = $this->request->getVar('kode_barang');
    $jumlah_barang = $this->request->getVar('jumlah_barang');

    $existingItem = $this->barang_keranjang_model
        ->where('keranjang_keranjang_id', $keranjang_id)
        ->where('barang_kode_barang', $kode_barang)
        ->first();

    if ($existingItem) {

        $newQty = $existingItem['jumlah_barang'] + $jumlah_barang;
        
        $this->barang_keranjang_model->save([
            'produk_keranjang_id' => $existingItem['produk_keranjang_id'], // Including ID forces an UPDATE
            'jumlah_barang' => $newQty
        ]);
    } else {
        // INSERT new row
        $this->barang_keranjang_model->save([
            'barang_kode_barang'     => $kode_barang,
            'keranjang_keranjang_id' => $keranjang_id,
            'jumlah_barang'          => $jumlah_barang
        ]);
    }

    return redirect()->back()->with('pesan', 'Item added to cart');
}

}


?>