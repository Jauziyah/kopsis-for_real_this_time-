<?= $this->extend('template/admin_toko');;?>


<?= $this->section('admin_content');;?>

<?php if(session()->getFlashdata('pesan')): ?>
    <div
        class="alert alert-primary"
        role="alert"
    >
       <?= session()->getFlashdata('pesan');?>
    </div>
    
<?php endif; ?>

<form action="<?= route_to('admin_toko.barang_create');?>" method="post" enctype="multipart/form-data">
    <?= csrf_field();?>
    <div class="mb-3">
        <label for="" class="form-label">Nama Barang</label>
        <input
            type="text"
            class="form-control"
            name="nama_barang"
            id=""
            aria-describedby="helpId"
            placeholder=""
        />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Keterangan Barang</label>
        <input
            type="text"
            class="form-control"
            name="keterangan_barang"
            id=""
            aria-describedby="helpId"
            placeholder=""
        />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Harga Barang</label>
        <input
            type="text"
            class="form-control"
            name="harga_barang"
            id=""
            aria-describedby="helpId"
            placeholder=""
        />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Stok barang</label>
        <input
            type="text"
            class="form-control"
            name="stok_barang"
            id=""
            aria-describedby="helpId"
            placeholder=""
        />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Expiration Date</label>
        <input
            type="date"
            class="form-control"
            name="exp_barang"
            id=""
            aria-describedby="helpId"
            placeholder=""
        />
    </div>
    
    <div class="mb-3"> 
        <label for="" class="form-label">Status Ketersediaan</label>
        <select
            class="form-select form-select-lg"
            name="status_ketersediaan"
            id=""
        >
            <option selected>Select one</option>
            <option value="tersedia">Tersedia</option>
            <option value="pre-order">Pre Order</option>
            <option value="habis">habis</option>
        </select>
    </div>
    <div class="mb-3 d-flex flex-column gap-2">
        <?php foreach($kategori_list as $kategori): ?>
        <div class="form-check ">
            <input class="form-check-input" type="checkbox" name="kategori[]" value="<?= $kategori['id_kategori'];?>">
            <label class="form-check-label">
                <?= $kategori['nama_kategori'] ?>
            </label>
        </div>
        <?php endforeach ?>
    </div>
    <div class="mb-3">
    <input type="file" name="barang_images[]" id="" multiple accept="image/png, image/jpeg, image/gif, image/jpg"> 
    </div>

    <button class="btn btn-primary" type="submit">Tambahkan</button>
</form>

<?= $this->endSection();;?>