<?= $this->extend('template/pelanggan');; ?>

<?= $this->section('pelanggan_content'); ?>

<h1>List Keranjang</h1>

<?php if (session()->getFlashdata('pesan')): ?>
    <div
        class="alert alert-primary"
        role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>

<?php endif; ?>

<?php

$i = 1;
$total_keseluruhan = 0;
?>
<div
    class="table-responsive">
    <table
        class="table table-striped table-hover table-sm border border-secondary">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah Barang</th>
                <th scope="col">Harga Barang</th>
                <th scope="col">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barang_keranjang as $barang): ?>
                <?php
                $subtotal_item = $barang['harga_barang'] * $barang['jumlah_barang'];
                $total_keseluruhan += $subtotal_item;
                ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $barang['nama_barang']; ?></td>
                    <td><?= $barang['jumlah_barang']; ?></td>
                    <td><?= $barang['harga_barang']; ?></td>
                    <td>Rp <?= number_format($subtotal_item, 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="4" class="fw-bold text-center"><strong>Total Bayar</strong></td>
                <td class="fw-bold"><strong>Rp <?= number_format($total_keseluruhan, 0, ',', '.'); ?></strong></td>
            </tr>
        </tfoot>
    </table>
</div>


<!-- Modal trigger button -->
<button
    type="button"
    class="btn btn-primary btn-lg"
    data-bs-toggle="modal"
    data-bs-target="#request_transaksi">
    Request Transaksi
</button>

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div
    class="modal fade"
    id="request_transaksi"
    tabindex="-1"

    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div
        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Pilih Payment Method
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="<?= route_to('pelanggan.add_request'); ?>" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Payment Method</label>
                        <select
                            class="form-select form-select-lg"
                            name="payment_method"
                            id="">
                            <?php foreach ($payment_method as $method): ?>
                                <option value="<?= $method['id_pembayaran']; ?>"><?= $method['nama_method']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>


<?= $this->endSection();; ?>