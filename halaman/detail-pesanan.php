<?php
require_once 'function.php';

$kode_pesanan = $_GET['kode'] ?? null;

// Ambil data pesanan beserta nama menu dan harga
$pesanan = ambil_data("
    SELECT p.*, m.nama, m.harga
    FROM pesanan p
    JOIN menu m ON p.kode_menu = m.kode_menu
    WHERE p.kode_pesanan = '$kode_pesanan'
");
?>

<a href="index.php?pesanan" class="btn btn-secondary mb-3 mt-3">
    &larr; Kembali
</a>

<h2 style="margin-top: 40px;">Detail Pesanan</h2>
<table class="table table-bordered table-hover" style="margin-top: 20px;">
    <tr class="text-bg-success">
        <th>No</th>
        <th>Nama Menu</th>
        <th>Kode Menu</th>
        <th>Jumlah Pesanan</th>
        <th>Harga</th>
        <th>Subtotal</th>
    </tr>
    <?php 
    $i = 1; 
    $total = 0;
    foreach ($pesanan as $m) { 
        $subtotal = $m["qty"] * $m["harga"];
        $total += $subtotal;
    ?>
        <tr style="background-color: white;">
            <td><?= $i; ?></td>
            <td><?= htmlspecialchars($m["nama"]); ?></td>
            <td><?= htmlspecialchars($m["kode_menu"]); ?></td>
            <td><?= htmlspecialchars($m["qty"]); ?></td>
            <td><?= htmlspecialchars(number_format($m["harga"], 0, ',', '.')); ?></td>
            <td><?= htmlspecialchars(number_format($subtotal, 0, ',', '.')); ?></td>
        </tr>
    <?php $i++; } ?>
    <tr>
        <td colspan="5" style="text-align:right;"><strong>Total</strong></td>
        <td><strong><?= htmlspecialchars(number_format($total, 0, ',', '.')); ?></strong></td>
    </tr>
</table>

<div style="margin-top:20px;">
    <strong>Kode Pesanan:</strong> <?= htmlspecialchars($kode_pesanan); ?>
</div>
