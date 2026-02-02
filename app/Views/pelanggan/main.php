<?= $this->extend('template/pelanggan');; ?>

<?= $this->section('pelanggan_content'); ?>

<h1>List Produk</h1>

<div class="row">
    <?php foreach ($barang_full as $barang): ?>
        <div class="col-3 mb-4">
            <div class="card h-100">
                <!-- Placeholder Image -->
                <img class="card-img-top" src="holder.js/100x180/" alt="<?= $barang['nama_barang'] ?>" />

                <div class="card-body d-flex flex-column">
                    <h4 class="card-title"><?= $barang['nama_barang'] ?></h4>
                    <h5 class="text-success">Rp <?= number_format($barang['harga_barang'], 0, ',', '.') ?></h5>
                    <p class="card-text"><?= $barang['keterangan_barang']; ?></p>
                    <p class="text-muted small">Stok: <?= $barang['stok_barang']; ?></p>

                    <div class="mt-auto d-flex justify-content-center">
                        <!-- Modal trigger button -->
                        <!-- Note: data-bs-target uses the unique kode_barang -->
                        <button
                            type="button"
                            class="btn btn-primary btn-lg w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#order_barang_<?= $barang['kode_barang']; ?>">
                            Order Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Body -->
        <!-- Placed INSIDE the loop so distinct forms are created for each product -->
        <div
            class="modal fade"
            id="order_barang_<?= $barang['kode_barang']; ?>"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalTitleId_<?= $barang['kode_barang']; ?>"
            aria-hidden="true">
            <div
                class="modal-dialog modal-dialog-centered modal-sm"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId_<?= $barang['kode_barang']; ?>">
                            Order: <?= $barang['nama_barang']; ?>
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- FORM START -->

                    <form action="<?= route_to('pelanggan.add_keranjang') ?>" method="post">
                        <div class="modal-body">

                            <input type="hidden" name="kode_barang" value="<?= $barang['kode_barang']; ?>">

                            <div class="mb-3">
                                <label for="qty_<?= $barang['kode_barang']; ?>" class="form-label">Jumlah Barang</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="jumlah_barang"
                                    id=""
                                    min="1"
                                    max="<?= $barang['stok_barang']; ?>"
                                    value="1"
                                    oninput="validity.valid||(value='<?= $barang['stok_barang']; ?>'); if(parseInt(value) > <?= $barang['stok_barang']; ?>){value='<?= $barang['stok_barang']; ?>'} if(parseInt(value) < 1){value='1'}"
                                    required>
                                <div class="form-text">Tersedia: <?= $barang['stok_barang']; ?> unit</div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Masukkan Keranjang
                            </button>
                    </form>
                    
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                </div>
                <!-- FORM END -->

            </div>
        </div>
</div>
<?php endforeach; ?>
</div>

<?= $this->endSection(); ?>