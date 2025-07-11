        <table class="table table-bordered table-hover" style="margin-top: 30px;">

            <tr class="text-bg-success">

                <th>No</th>

                <th>Nama Pelanggan</th>
                
                <th>Kode Pesanan</th>

                <th>Tanggal Transaksi</th>

                <th>Total Harga</th>

                <th>Pembayaran</th>

                <th>Cetak</th>
                <th></th>
                <th></th>
                
                    <a href="halaman/cetak_transaksi_pdf.php" target="_blank" class="btn btn-danger">
                        Cetak Data Transaksi (PDF)
                    </a>
                </th>
            </tr>
            <?php $i = 1;
            
            foreach ($menu as $m) {
                $kode_pesanan = $m["kode_pesanan"];
                $total_pembayaran = ambil_data("SELECT DISTINCT * FROM pesanan
            JOIN transaksi ON (pesanan.kode_pesanan = transaksi.kode_pesanan)
            JOIN menu ON (menu.kode_menu = pesanan.kode_menu)
            WHERE transaksi.kode_pesanan = '$kode_pesanan'");
            ?>

                <form action="cetak/cetak.php" target="_blank" method="GET">

                    <input type="hidden" name="kode_pesanan" value="<?= $m["kode_pesanan"]; ?>">

                    <tr style="background-color: white;">

                        <td><?= $i; ?></td>

                        <td><?= $m["nama_pelanggan"]; ?></td>
                        
                        <td><?= $m["kode_pesanan"]; ?></td>

                        <td>
                            <?php
                            // Pastikan $m["Tanggal_transaksi"] ada dan tidak null
                            if (!empty($m["Tanggal_transaksi"])) {
                                echo date('d F Y', strtotime($m["Tanggal_transaksi"]));
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $total = 0;
                            foreach ($total_pembayaran as $tp) {
                                $total += $tp["qty"] * $tp["harga"];
                            }
                            echo "Rp." . $total;
                            ?>
                        </td>
                        <td><input name="pembayaran" min="0" type="number"></td>
                        <td>

                            <button class="btn btn-primary">Cetak</button>

                            <a class="btn btn-danger" href="hapus.php?kode_pesanan=<?= $m["kode_pesanan"]; ?>" onclick="return confirm('Hapus Data Transaksi?')">Hapus</a>

                        </td>

                    </tr>

                </form>
            <?php $i++;
            } ?>

        </table>