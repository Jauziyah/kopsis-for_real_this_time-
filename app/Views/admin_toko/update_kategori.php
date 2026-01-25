<?= $this->extend('template/admin_toko');;?>

<?= $this->section('admin_content');;?>

<form action="<?= route_to('admin_toko.kategori_update', $kategori['id_kategori']);?>" method="post">

<div class="mb-3">
    <label for="" class="form-label">Nama Kategori</label>
    <input
        type="text"
        class="form-control <?= ($validation->hasError('nama_kategori')) ? 'is-invalid' : '';?>"
        name="nama_kategori"
        id=""
        aria-describedby="helpId"
        placeholder=""
        value="<?= (old('nama_kategori')) ? old('nama_kategori'): $kategori['nama_kategori'];?>"
    />
<div class="invalid-feedback">
    <?= $validation->getError('nama_kategori');?>
</div>
</div>


<button class="btn btn-primary" type="submit">Tambahkan Kategori</button>

</form>


<?= $this->endSection();;?>
