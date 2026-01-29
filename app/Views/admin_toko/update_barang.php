<?= $this->extend('template/admin_toko');;?>

<?= $this->section('admin_content');;?>

<h1>Update Barang</h1>

<?php if(session()->getFlashdata('pesan')): ?>
    <div
        class="alert alert-primary"
        role="alert"
    >
       <?= session()->getFlashdata('pesan');?>
    </div>
    
<?php endif; ?>

<?php $current_status = old('status_ketersediaan') ?? old('status_ketersediaan') ?? $barang['status_ketersediaan']  ?? '' ?>
<?php $current_selections = old('kategori') ?? $selected_kategori ?? []; ?>

<form action="<?= route_to('admin_toko.barang_update', $barang['kode_barang']);?>" method="post" enctype="multipart/form-data">
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
            value="<?= old('nama_barang') ? old('nama_barang'): $barang['nama_barang'];?>"
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
            value="<?= old('keterangan_barang') ? old('keterangan_barang'): $barang['keterangan_barang'];?>"
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
            value="<?= old('harga_barang') ? old('harga_barang'): $barang['harga_barang'];?>"
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
            value="<?= old('stok_barang') ? old('stok_barang'): $barang['stok_barang'];?>"
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
            value="<?= old('exp_barang') ? old('exp_barang'): $barang['exp_barang'];?>"
        />
    </div>
    
    <div class="mb-3"> 
        <label for="" class="form-label">Status Ketersediaan</label>
        <select
            class="form-select form-select-lg"
            name="status_ketersediaan"
            id=""
        >
            <option value="tersedia" <?= $current_status == 'tersedia' ? 'selected' : '';?>>Tersedia</option>
            <option value="pre-order" <?= $current_status == 'pre-order' ? 'selected' : '';?>>Pre Order</option>
            <option value="habis" <?= $current_status == 'habis' ? 'selected' : '';?>>habis</option>
        </select>

    </div>

    <div class="mb-3 d-flex flex-column gap-2">
        <?php foreach($kategori_list as $kategori): ?>
            <?php $ischecked = in_array($kategori['id_kategori'], $current_selections) ? 'checked' : ''; ?>
        <div class="form-check ">
            <input class="form-check-input" type="checkbox" name="kategori[]" value="<?= $kategori['id_kategori'];?>" <?= $ischecked;?>>
            <label class="form-check-label">
                <?= $kategori['nama_kategori'] ?>
            </label>
        </div>
        <?php endforeach ?>

    </div>
        <div class="mb-3">
            <label for="" class="form-label">Choose File...</label>
            <input
                type="file"
                class="form-control"
                name="barang_images[]"
                id=""
                placeholder=""
                aria-describedby="fileHelpId"
                multiple
                accept="image/png, image/jpeg, image/gif, image/jpg"
            />
        </div>
        <div class="mb-3">
            <small>Current Image</small>
            <?php foreach($barang_images as $images): ?>
                <img src="<?= base_url('uploads/' . $images['nama_image']);?>" alt="" style="width: 40px;">
            <?php endforeach ?>
        </div>


    <button class="btn btn-primary" type="submit">Tambahkan</button>
</form>

<?= $this->endSection();;?>