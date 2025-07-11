<?php 
require_once '../function.php';

// Header untuk Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Penjualan_" . date('Ymd_His') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Ambil data tanggal dari form
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

// Query data transaksi
$result = ambil_data("SELECT transaksi.nama_pelanggan, pesanan.kode_pesanan, transaksi.waktu, pesanan.qty,
                      menu.nama AS nama_menu, menu.kode_menu, menu.harga
                      FROM pesanan
                      JOIN transaksi ON pesanan.kode_pesanan = transaksi.kode_pesanan
                      JOIN menu ON pesanan.kode_menu = menu.kode_menu
                      WHERE transaksi.waktu BETWEEN '$date1' AND '$date2'
                      ORDER BY transaksi.waktu ASC");

// Hitung total jumlah dan total penjualan
$total_qty = 0;
$grand_total = 0;
$no = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 8px; }
        th { background-color: #c9d9e2; }
    </style>
</head>
<body>

<h3 style="text-align:center;">Laporan Penjualan</h3>
<p style="text-align:center;">Periode: <?= date('d-m-Y', strtotime($date1)); ?> s/d <?= date('d-m-Y', strtotime($date2)); ?></p>

<table>
    <tr>
        <th>No</th>
        <th>Nama Pelanggan</th>
        <th>Nama Menu</th>
        <th>Kode Pesanan</th>
        <th>Kode Menu</th>
        <th>Tanggal</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Subtotal</th>
    </tr>

    <?php foreach ($result as $row): 
        $subtotal = $row["qty"] * $row["harga"];
        $total_qty += $row["qty"];
        $grand_total += $subtotal;
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_pelanggan']; ?></td>
            <td><?= $row['nama_menu']; ?></td>
            <td><?= $row['kode_pesanan']; ?></td>
            <td><?= $row['kode_menu']; ?></td>
            <td><?= date('d-m-Y', strtotime($row['waktu'])); ?></td>
            <td><?= $row['qty']; ?></td>
            <td>Rp.<?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td>Rp.<?= number_format($subtotal, 0, ',', '.'); ?></td>
        </tr>
    <?php endforeach; ?>

    <tr style="font-weight:bold; background-color:#f0f0f0;">
        <td colspan="6" style="text-align:right;">Total Jumlah Terjual</td>
        <td><?= $total_qty; ?></td>
        <td style="text-align:right;">Total Penjualan</td>
        <td>Rp.<?= number_format($grand_total, 0, ',', '.'); ?></td>
    </tr>
</table>

</body>
</html>
