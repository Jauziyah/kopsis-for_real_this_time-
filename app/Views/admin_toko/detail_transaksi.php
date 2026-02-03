<?= $this->extend('template/admin_toko'); ?>

<?= $this->section('admin_content'); ?>

<!-- Header with Back Button -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Detail Transaksi #<?= $id_penjualan; ?></h1>
    <a href="<?= route_to('admin_toko.transaksi_view') ?>" class="btn btn-secondary btn-sm">
        &laquo; Kembali ke List
    </a>
</div>

<?php 
// Initialize variables for the loop
$i = 1;
$grand_total = 0;
?>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered border-secondary">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center" width="5%">No</th>
                        <th scope="col">Info Barang</th>
                        <th scope="col" class="text-end">Harga Satuan</th>
                        <th scope="col" class="text-center">Jumlah</th>
                        <th scope="col" class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach($detail_transaksi as $item): ?>
                            <?php 
                                // Accumulate the total price
                                $grand_total += $item['subtotal']; 
                            ?>
                            <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                
                                <td>
                                    <!-- Display Name from 'barang' table join -->
                                    <span class="fw-bold">
                                        <?= $item['nama_barang']; ?>
                                    </span>
                                    <br>
                                    <small class="text-muted">Kode: <?= $item['barang_kode_barang']; ?></small>
                                </td>
                                
                                <td class="text-end">
                                    Rp <?= number_format($item['harga_satuan'], 0, ',', '.'); ?>
                                </td>
                                
                                <td class="text-center">
                                    <?= $item['jumlah']; ?> Pcs
                                </td>
                                
                                <td class="text-end fw-bold">
                                    Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                </tbody>
                
                <!-- Footer to show the Grand Total -->
                <tfoot>
                    <tr class="table-secondary">
                        <td colspan="4" class="text-end fw-bold text-uppercase">Total Keseluruhan</td>
                        <td class="text-end fw-bold fs-5 text-success">
                            Rp <?= number_format($grand_total, 0, ',', '.'); ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- ACTION BUTTON -->
<div class="d-flex justify-content-end">
    <!-- Sending the id_penjualan via route -->
    <a href="<?= route_to('admin_toko.accept_transaction', $id_penjualan); ?>" 
       class="btn btn-lg btn-primary"
       onclick="return confirm('Apakah anda yakin ingin menyelesaikan transaksi ini?')">
       <i class="bi bi-check-circle"></i> Selesaikan Transaksi
    </a>
</div>


<?= $this->endSection(); ?>