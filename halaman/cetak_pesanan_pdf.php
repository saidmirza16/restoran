<?php
require_once __DIR__ . '/../function.php';

$tampil = false;
$grouped = [];
$total_pesanan = 0;

if (isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
    $tampil = true;
    $awal = $_GET['tanggal_awal'];
    $akhir = $_GET['tanggal_akhir'];

    $query = mysqli_query($koneksi, "
        SELECT p.*, m.nama AS nama_menu, t.nama_pelanggan, p.tanggal_pesanan
        FROM pesanan p
        JOIN menu m ON p.kode_menu = m.kode_menu
        JOIN transaksi t ON p.kode_pesanan = t.kode_pesanan
        WHERE p.tanggal_pesanan BETWEEN '$awal' AND '$akhir'
        ORDER BY p.tanggal_pesanan ASC
    ");

    $data = mysqli_fetch_all($query, MYSQLI_ASSOC);

    foreach ($data as $row) {
        $kode = $row['kode_pesanan'];
        if (!isset($grouped[$kode])) {
            $grouped[$kode] = [
                'nama_pelanggan' => $row['nama_pelanggan'],
                'nama_menu' => $row['nama_menu'],
                'kode_pesanan' => $row['kode_pesanan'],
                'kode_menu' => $row['kode_menu'],
                'tanggal_pesanan' => $row['tanggal_pesanan'],
                'qty' => 0
            ];
        }
        $grouped[$kode]['qty'] += (int)$row['qty'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Pesanan</title>
    <style>
        
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #dfefff, #e0f7fa);
        }

        .container {
            max-width: 900px;
            margin: 60px auto;
            padding: 40px 30px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            box-shadow: 0 12px 28px rgba(0,0,0,0.12);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 35px;
            font-weight: 600;
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .filter-form label {
            font-weight: 500;
            color: #34495e;
        }

        .filter-form input[type="date"] {
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        .filter-form input[type="date"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .filter-form button {
            padding: 11px 20px;
            background-color: #007bff;
            color: white;
            font-size: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .filter-form button:hover {
            background-color: #0056b3;
        }

        .no-print {
            text-align: center;
            margin-bottom: 25px;
        }

        .no-print a, .no-print button {
            margin: 0 6px;
            padding: 10px 18px;
            font-size: 14px;
            border-radius: 8px;
            text-decoration: none;
        }

        .no-print a {
            background-color: #dc3545;
            color: white;
        }

        .no-print a:hover {
            background-color: #c82333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 5px rgba(0,0,0,0.08);
        }

        th, td {
            padding: 12px 16px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #e6f4ff;
            color: #2c3e50;
        }

        tr:nth-child(even) {
            background-color: #f9fcff;
        }

        tr:hover {
            background-color: #e2f1ff;
        }

        tr.total-row {
            font-weight: bold;
            background-color: #e0ffe0;
        }

        .alert-info {
            background-color: #eaf4ff;
            padding: 16px;
            margin: 25px auto;
            border-left: 5px solid #2196f3;
            border-radius: 6px;
            color: #333;
            max-width: 600px;
            text-align: center;
            font-style: italic;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                background: white;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Laporan Data Pesanan</h2>

    <div class="no-print">
        <form method="get" class="filter-form">
            <label for="tanggal_awal">Dari Tanggal:</label>
            <input type="date" name="tanggal_awal" required>
            <label for="tanggal_akhir">Sampai Tanggal:</label>
            <input type="date" name="tanggal_akhir" required>
            <button type="submit">🔍 Tampilkan</button>
        </form>

        <?php if ($tampil): ?>
            <button onclick="window.print()">🖨️ Cetak</button>
            <a href="javascript:window.close()">❌ Tutup</a>
        <?php endif; ?>
    </div>

    <?php if ($tampil): ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Menu</th>
                    <th>Kode Pesanan</th>
                    <th>Kode Menu</th>
                    <th>Tanggal Pesanan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($grouped as $row): 
                    $total_pesanan += $row['qty'];
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                    <td><?= htmlspecialchars($row['nama_menu']); ?></td>
                    <td><?= htmlspecialchars($row['kode_pesanan']); ?></td>
                    <td><?= htmlspecialchars($row['kode_menu']); ?></td>
                    <td><?= date('d F Y', strtotime($row['tanggal_pesanan'])); ?></td>
                    <td><?= $row['qty']; ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="6" style="text-align:right;">Total Jumlah Pesanan</td>
                    <td><?= $total_pesanan; ?></td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert-info">
            Silakan pilih rentang tanggal terlebih dahulu untuk menampilkan data pesanan.
        </div>
    <?php endif; ?>
</div>

</body>
</html>
