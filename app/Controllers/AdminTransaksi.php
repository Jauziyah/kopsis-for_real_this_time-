<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenjualanModel;
use App\Models\DetailTransaksiModel;
use App\Models\BarangModel;

class AdminTransaksi extends BaseController
{
    protected $penjualan_model;
    protected $detail_transaksi_model;
    protected $barang_model;
    public function __construct()
    {
        $this->penjualan_model = new PenjualanModel();
        $this->detail_transaksi_model = new DetailTransaksiModel();
        $this->barang_model = new BarangModel();
    }
    public function index()
    {
        $penjualan = $this->penjualan_model
            ->select('penjualan.*, user_biznet.nama_user') // Select all from sales + the name
            ->join('user_biznet', 'user_biznet.id_user_biznet = penjualan.user_biznet_id_user_biznet') // Join on ID
            ->orderBy('penjualan.created_at', 'DESC')
            ->findAll();

        foreach ($penjualan as &$transaksi) {
            $transaksi['item'] = $this->detail_transaksi_model
                ->select('detail_transaksi.*, barang.nama_barang')
                ->join('barang', 'barang.kode_barang = detail_transaksi.barang_kode_barang')
                ->where('penjualan_id_penjualan', $transaksi['id_penjualan'])
                ->findAll();
        }

        $data = [
            'penjualan_list' => $penjualan
        ];

        return view('admin_toko/transaksi_request', $data);
    }

    public function detailTransaksi($id_penjualan)
    {
        $data = [
            'title' => 'Detail Transaksi',
            'detail_transaksi' => $this->penjualan_model->getDetailTransaksi($id_penjualan),
            'id_penjualan' => $id_penjualan
        ];

        return view('admin_toko/detail_transaksi', $data);
    }

    public function acceptTransaction($id_penjualan)
    {
        $items = $this->detail_transaksi_model->where('penjualan_id_penjualan', $id_penjualan)->findAll();
        foreach($items as $item){
        $kode_barang = $item['barang_kode_barang'];
        $jumlah_beli = $item['jumlah'];

        $barang = $this->barang_model->find($kode_barang);
        $current_stock = $barang['stok_barang'];
        $new_stock = $current_stock - $jumlah_beli;

        if ($new_stock < 0) $new_stock = 0;

        $this->barang_model->update($kode_barang, [
                'stok_barang' => $new_stock
            ]);
        }
        $this->penjualan_model->update($id_penjualan, [
            'status_transaksi' => 'selesai'
        ]);
        return view('admin_toko/transaksi_request');
    }
}
