<?= $this->extend('template/admin_toko');; ?>

<?= $this->section('admin_content');; ?>

<?php if (session()->getFlashdata('pesan')): ?>
    <div
        class="alert alert-primary"
        role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>

<?php endif ?>

<?php $i = 1 ?>

<h2 class="mt-3">List Kategori</h2>

<div class="d-flex my-2 justify-content-between align-items-center">

    <h1>Kategori</h1>
    <a href="<?= route_to('admin_toko.kategori_view_add'); ?>" class="btn btn-primary btn-sm py-2">Tambah kategori</a>
</div>

<div
    class="table-responsive">
    <table class="table table-striped table-hover table-sm rounded border border-secondary ">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Aksi</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kategori_row as $kategori): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $kategori['nama_kategori']; ?></td>
                    <td>
                        <div class="d-flex">
                            <form action="<?= route_to('admin_toko.kategori_delete', $kategori['id_kategori']); ?>" method="post">
                                <?= csrf_field(); ?>
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>

                            <a href="<?= route_to('admin_toko.kategori_update_view', $kategori['id_kategori']);?>" class="btn btn-warning">Edit</a>
                        </div>
                    </td>
                    <td><?= $kategori['created_at']; ?></td>
                    <td><?= $kategori['updated_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



<?= $this->endSection();; ?>