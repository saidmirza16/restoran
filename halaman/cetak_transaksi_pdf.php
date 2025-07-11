<?php
require_once __DIR__ . '/../function.php';

$tampil = false;
$grouped = [];
$total_transaksi = 0;

if (isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
    $tampil = true;
    $awal = $_GET['tanggal_awal'];
    $akhir = $_GET['tanggal_akhir'];

    $data = ambil_data("
        SELECT t.nama_pelanggan, t.kode_pesanan, t.Tanggal_transaksi, m.harga, p.qty
        FROM transaksi t
        JOIN pesanan p ON t.kode_pesanan = p.kode_pesanan
        JOIN menu m ON p.kode_menu = m.kode_menu
        WHERE t.Tanggal_transaksi BETWEEN '$awal' AND '$akhir'
        ORDER BY t.Tanggal_transaksi ASC
    ");

    foreach ($data as $row) {
        $kode = $row['kode_pesanan'];
        if (!isset($grouped[$kode])) {
            $grouped[$kode] = [
                'nama_pelanggan' => $row['nama_pelanggan'],
                'kode_pesanan' => $row['kode_pesanan'],
                'tanggal_transaksi' => $row['Tanggal_transaksi'],
                'total' => 0
            ];
        }
        $grouped[$kode]['total'] += $row['qty'] * $row['harga'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7fc;
            color: #333;
            margin: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 40px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #222;
        }

        .filter-form {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .filter-form input {
            padding: 10px 14px;
            font-size: 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .filter-form button {
            background: #2a9d8f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .filter-form button:hover {
            background: #21867a;
        }

        .no-print {
            text-align: center;
            margin-bottom: 25px;
        }

        .no-print a {
            margin-left: 15px;
            background: #e63946;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .no-print a:hover {
            background: #c12f3c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #2a9d8f;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 10px 14px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .total-row td {
            font-weight: bold;
            background: #e0f7f5;
        }

        .alert-info {
            background: #d1ecf1;
            padding: 15px;
            border-left: 5px solid #0c5460;
            border-radius: 6px;
            text-align: center;
            color: #0c5460;
            font-style: italic;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                background: white;
            }

            .container {
                box-shadow: none;
                margin: 0;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📄 Laporan Data Transaksi</h2>

    <div class="no-print">
        <form method="get" class="filter-form">
            <input type="date" name="tanggal_awal" required>
            <input type="date" name="tanggal_akhir" required>
            <button type="submit">🔍 Tampilkan</button>
        </form>

        <?php if ($tampil): ?>
            <button onclick="window.print()">🖨️ Cetak Halaman</button>
            <a href="javascript:window.close()">❌ Tutup</a>
        <?php endif; ?>
    </div>

    <?php if ($tampil): ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Kode Pesanan</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($grouped as $row): 
                    $total_transaksi += $row['total'];
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                    <td><?= htmlspecialchars($row['kode_pesanan']); ?></td>
                    <td><?= date('d F Y', strtotime($row['tanggal_transaksi'])); ?></td>
                    <td>Rp.<?= number_format($row['total'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="4" style="text-align: right;">Total Transaksi</td>
                    <td>Rp.<?= number_format($total_transaksi, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert-info">
            Silakan pilih tanggal terlebih dahulu untuk menampilkan laporan transaksi.
        </div>
    <?php endif; ?>
</div>

</body>
</html>
