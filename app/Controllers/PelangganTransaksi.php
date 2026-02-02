<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangKeranjangModel;
use App\Models\UsersModel;
use App\Models\KeranjangModel;
use App\Models\BarangModel;
use App\models\PaymentMethod;
use App\Models\PenjualanModel;
use App\Models\DetailTransaksiModel;
use CodeIgniter\I18n\Time;

class PelangganTransaksi extends BaseController
{
    protected $barang_keranjang_model;
    protected $user_model;
    protected $keranjang_model;
    protected $barang_model;
    protected $payment_model;
    protected $penjualan_model;
    protected $detail_transaksi_model;


    public function __construct()
    {
        $this->user_model = new UsersModel();
        $this->barang_keranjang_model = new BarangKeranjangModel();
        $this->keranjang_model = new KeranjangModel();
        $this->barang_model = new BarangModel();
        $this->payment_model = new PaymentMethod();
        $this->penjualan_model = new PenjualanModel();
        $this->detail_transaksi_model = new DetailTransaksiModel();
    }

    public function index()
    {
        $biznet_id = $this->user_model->getActiveBiznetId();

        $keranjang_id = $this->keranjang_model->findCart($biznet_id);

        $barang_keranjang = $this->barang_keranjang_model
            ->select('barang_keranjang.*, barang.nama_barang, barang.harga_barang')
            ->join('barang', 'barang.kode_barang = barang_keranjang.barang_kode_barang')
            ->where('barang_keranjang.keranjang_keranjang_id', $keranjang_id)
            ->findAll();

        $payment_method = $this->payment_model->findAll();

        $data = [
            'barang_keranjang' => $barang_keranjang,
            'payment_method' => $payment_method
        ];

        return view('pelanggan/transaksi', $data);
    }

    public function addRequest()
    {
        $biznet_id = $this->user_model->getActiveBiznetId();
        $keranjang_id = $this->keranjang_model->findCart($biznet_id);

        $cart_items = $this->barang_keranjang_model
            ->select('barang_keranjang.*, barang.*')
            ->join('barang', 'barang.kode_barang = barang_keranjang.barang_kode_barang')
            ->where('barang_keranjang.keranjang_keranjang_id', $keranjang_id)
            ->findAll();

        $total_bayar = 0;
        foreach ($cart_items as $item) {
            $total_bayar += ($item['harga_barang'] * $item['jumlah_barang']);
        }
        // insert penjualan
        $this->penjualan_model->save([
            'pembayaran_id_pembayaran' => $this->request->getVar('payment_method'),
            'user_biznet_id_user_biznet' => $this->user_model->getActiveBiznetId(),
            'tanggal_penjualan' => Time::now(),
            'total' => $total_bayar,
            'status_transaksi' => 'belum bayar',
        ]);

        // Save detail_transaksi
        $new_penjualan_id = $this->penjualan_model->getInsertID();
        $data_detail = [];
        foreach ($cart_items as $item) {
            $data_detail[] = [
                'barang_kode_barang'     => $item['kode_barang'], // From table barang
                'jumlah'                 => $item['jumlah_barang'],
                'harga_satuan'           => $item['harga_barang'],
                'subtotal'               => $item['harga_barang'] * $item['jumlah_barang'],
                'penjualan_id_penjualan' => $new_penjualan_id, // Link to parent
            ];
        }

        if (!empty($data_detail)) {
            $this->detail_transaksi_model->insertBatch($data_detail);
        }

        return redirect()->route('pelanggan.transaksi_view')->with('pesan', 'Request Transaksi Berhasil');
    }
}
