<?php
require_once __DIR__ . '/../function.php';

// kode lainnya...


// Ambil data dari tabel pesanan + nama menu & pelanggan
$query = mysqli_query($koneksi, "
    SELECT p.*, m.nama AS nama_menu, t.nama_pelanggan
    FROM pesanan p
    JOIN menu m ON p.kode_menu = m.kode_menu
    JOIN transaksi t ON p.kode_pesanan = t.kode_pesanan
    
");

$menu = mysqli_fetch_all($query, MYSQLI_ASSOC);

// Mulai pengelompokan data
$grouped = [];

foreach ($menu as $m) {
    $kode = trim($m['kode_pesanan']); // Bersihkan spasi

    if (!isset($grouped[$kode])) {
        $grouped[$kode] = [
            'nama_pelanggan' => $m['nama_pelanggan'],
            'nama_menu' => $m['nama_menu'],
            'kode_pesanan' => $m['kode_pesanan'],
            'kode_menu' => $m['kode_menu'],
            'tanggal_pesanan' => $m['tanggal_pesanan'],
            'qty' => 0,
            
        ];
    }

    $grouped[$kode]['qty'] += (int)$m['qty'];
}
?>
<!-- Tombol Cetak PDF -->
<div style="margin-top: 10px; margin-bottom: 10px;">
    <a href="halaman/cetak_pesanan_pdf.php" target="_blank" class="btn btn-danger">
        Cetak Data Pesanan (PDF)
    </a>
</div>
<table class="table table-bordered table-hover" style="margin-top: 50px;">
    <tr class="text-bg-success">
        <th>No</th>
        <th>Nama Pelanggan</th>
        <th>Nama Menu</th>
        <th>Kode Pesanan</th>
        <th>Kode Menu</th>
        <th>Tanggal Pesanan</th>
        <th>Jumlah Pesanan</th>
        
        <th>Detail</th>
    </tr>
    <?php $i = 1; foreach ($grouped as $m): ?>
        <tr style="background-color: white;">
            <td><?= $i++; ?></td>
            <td><?= htmlspecialchars($m["nama_pelanggan"]); ?></td>
            <td><?= htmlspecialchars($m["nama_menu"]); ?></td>
            <td><?= htmlspecialchars($m["kode_pesanan"]); ?></td>
            <td><?= htmlspecialchars($m["kode_menu"]); ?></td>
            <td><?= date('d F Y', strtotime($m["tanggal_pesanan"])); ?></td>
            <td><?= $m["qty"]; ?></td>
            <td>
                
                <a href="index.php?detail-pesanan&kode=<?= urlencode($m['kode_pesanan']); ?>" class="btn btn-info">Detail</a>
            </td>
            <td>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
