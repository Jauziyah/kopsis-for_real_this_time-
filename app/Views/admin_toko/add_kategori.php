<?= $this->extend('template/admin_toko');;?>

<?= $this->section('admin_content');;?>

<h1>Tambah Kategori</h1>

<form action="<?= route_to('admin_toko.kategori_add');?>" method="post">

<div class="mb-3">
    <label for="" class="form-label">Nama Kategori</label>
    <input
        type="text"
        class="form-control <?= ($validation->hasError('nama_kategori')) ? 'is-invalid' : '';?>"
        name="nama_kategori"
        id=""
        aria-describedby="helpId"
        placeholder=""
    />
    
<div class="invalid-feedback">
    <?= $validation->getError('nama_kategori');?>
</div>
</div>

<button class="btn btn-primary" type="submit">Tambahkan Kategori</button>

</form>

<?= $this->endSection();;?>