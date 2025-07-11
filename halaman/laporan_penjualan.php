<?php
require_once './function.php'; // Ganti sesuai struktur proyek kamu

$date = date('Y-m-d');
$date1 = $date2 = $date;

if (isset($_POST['submit'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>

    <!-- Bootstrap 5 & Feather Icons & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            color: #333;
        }

        .report-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .title-bar {
            border-left: 5px solid #0d6efd;
            padding-left: 15px;
            margin-bottom: 25px;
        }

        .form-section input,
        .form-section button {
            border-radius: 12px !important;
        }

        .table th {
            background-color: #f7f9fc;
        }

        .table tfoot {
            background: #eef1f5;
        }

        .btn-modern {
            padding: 10px 18px;
            font-weight: 600;
            border-radius: 12px;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

<div class="report-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="title-bar">
            <h4 class="fw-bold text-primary">📊 Laporan Penjualan</h4>
            <small class="text-muted">Periode <?= $date1 ?> s.d <?= $date2 ?></small>
        </div>
        <div class="no-print d-flex gap-2">
            <form action="halaman/exp_penjualan.php" method="POST">
                <input type="hidden" name="date1" value="<?= $date1 ?>">
                <input type="hidden" name="date2" value="<?= $date2 ?>">
                <button class="btn btn-success btn-modern" type="submit">
                    <i data-feather="download"></i> Excel
                </button>
            </form>
            <button onclick="window.print()" class="btn btn-outline-dark btn-modern">
                <i data-feather="printer"></i> Cetak
            </button>
        </div>
    </div>

    <!-- Form Filter -->
    <form method="POST" class="form-section row g-3 no-print mb-4">
        <div class="col-md-5">
            <label class="form-label">Dari Tanggal</label>
            <input type="date" name="date1" class="form-control" value="<?= $date1 ?>" required>
        </div>
        <div class="col-md-5">
            <label class="form-label">Sampai Tanggal</label>
            <input type="date" name="date2" class="form-control" value="<?= $date2 ?>" required>
        </div>
        <div class="col-md-2 d-grid">
            <label>&nbsp;</label>
            <button type="submit" name="submit" class="btn btn-primary btn-modern">Tampilkan</button>
        </div>
    </form>

    <!-- Tabel Penjualan -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Menu</th>
                    <th>Kode Pesanan</th>
                    <th>Kode Menu</th>
                    <th>Tanggal</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['submit'])) {
                    $data_laporan = ambil_data("SELECT transaksi.nama_pelanggan, pesanan.kode_pesanan, transaksi.waktu, pesanan.qty,
                                                menu.nama AS nama_menu, menu.kode_menu, menu.harga
                                                FROM pesanan
                                                JOIN transaksi ON pesanan.kode_pesanan = transaksi.kode_pesanan
                                                JOIN menu ON pesanan.kode_menu = menu.kode_menu
                                                WHERE transaksi.waktu BETWEEN '$date1' AND '$date2'
                                                ORDER BY transaksi.waktu ASC");

                    $no = 1;
                    $grand_total = 0;
                    $total_qty = 0;

                    foreach ($data_laporan as $row) {
                        $subtotal = $row['qty'] * $row['harga'];
                        $grand_total += $subtotal;
                        $total_qty += $row['qty'];
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $row['nama_pelanggan'] ?></td>
                            <td><?= $row['nama_menu'] ?></td>
                            <td><?= $row['kode_pesanan'] ?></td>
                            <td><?= $row['kode_menu'] ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($row['waktu'])) ?></td>
                            <td class="text-center"><?= $row['qty'] ?></td>
                            <td class="text-end">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td class="text-end">Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
            </tbody>
            <tfoot>
                <tr class="fw-bold text-end">
                    <td colspan="6" class="text-end">Total Jumlah Terjual</td>
                    <td class="text-center"><?= $total_qty ?? 0 ?></td>
                    <td>Total</td>
                    <td>Rp <?= number_format($grand_total ?? 0, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
            <?php } ?>
        </table>
    </div>
</div>

<!-- Feather icons init -->
<script>feather.replace();</script>
</body>
</html>
