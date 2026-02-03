<?= $this->extend('template/admin_toko');;?>

<?= $this->section('admin_content');;?>

<h1>List Request</h1>
<?php 

$i = 1;

?>

<div
    class="table-responsive"
>

    <table
        class="table table-striped table-hover table-sm border border-secondary"
    >
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Transaksi Request Oleh</th>
                <th scope="col">Tanggal Request</th>
                <th scope="col">Status Transaksi</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($penjualan_list as $penjualan): ?>
                <tr>
                    <td><?= $i++;?></td>
                    <td><?= $penjualan['nama_user'];?></td>
                    <td><?= $penjualan['created_at'];?></td>
                    <td><?= $penjualan['status_transaksi'];?></td>
                    <td>
                           <a href="<?= route_to('admin_toko.detail_transaksi_view', $penjualan['id_penjualan']); ?>" class="btn btn-warning btn-sm">Detail</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>


<?= $this->endSection();;?>