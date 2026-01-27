<?= $this->extend('template/admin_toko');;?>

<?= $this->section('admin_content');;?>

<?php if (session()->getFlashdata('pesan')): ?>
    <div
        class="alert alert-primary"
        role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php endif ?>

<div class="d-flex justify-content-between align-items-center mt-2">
    <h1>List Produk</h1>
    <a href="<?= route_to('admin_toko.barang_create_view');?>" class="btn btn-primary btn-sm py-2">Tambahkan barang</a>
</div>

<?php $i = 1 ?>
<div
    class="table-responsive"
>
    <table
        class="table table-striped table-hover table-sm border border-secondary"
    >
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Barang</th>
                <th scope="col">Harga Barang</th>
                <th scope="col">Stok Barang</th>
                <th scope="col">Status Ketersediaan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($barang_list as $barang): ?>
                <tr>
                <td><?= $i++;?></td>
                <td><?= $barang['nama_barang'];?></td>
                <td><?= $barang['harga_barang'];?></td>
                <td><?= $barang['stok_barang'];?></td>
                <td><?= $barang['status_ketersediaan'];?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?= $this->endSection();;?>