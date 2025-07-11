-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2025 at 06:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `no_hp`) VALUES
(7, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', ''),
(7, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', ''),
(7, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `kode_menu` varchar(12) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `status` enum('tersedia','tidak tersedia') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `kode_menu`, `nama`, `harga`, `gambar`, `kategori`, `status`) VALUES
(0, 'MN51', 'Nasi Putih Biasa', 4000, 'nasi-putih-biasa.png', 'Makanan', 'tersedia'),
(1, 'MN01', 'Bebek Cabe Ijo', 40000, 'bebek-goreng-ijo.png', 'Makanan', 'tersedia'),
(2, 'MN02', 'Kerang Asam manis', 50000, 'kerang-asam-manis.png', 'Makanan', 'tersedia'),
(3, 'MN03', 'Gurame Saus Tauco', 25000, 'gurame-saus-tauco.png', 'Makanan', 'tersedia'),
(4, 'MN04', 'Gurame Asam Manis', 30000, 'gurame-asam-manis.png', 'Makanan', 'tersedia'),
(5, 'MN05', 'Dendeng Balado', 35000, 'dendeng-balado.png', 'Makanan', 'tersedia'),
(6, 'MN06', 'Bebek Goreng Kelapa', 35000, 'bebek-goreng-kelapa.png', 'Makanan', 'tersedia'),
(7, 'MN07', 'Balado Kerang Pedas', 45000, 'balado-kerang-pedas.png', 'Makanan', 'tersedia'),
(8, 'MN08', 'Ayam Bakar Madu', 25000, 'ayam-bakar-madu.png', 'Makanan', 'tersedia'),
(9, 'MN09', 'Nasi Goreng Sosis', 15000, 'nasi-goreng-sosis.png', 'Makanan', 'tersedia'),
(10, 'MN10', 'Udang Tepung Gendut', 20000, 'udang-tepung.png', 'Fast Food', 'tersedia'),
(11, 'MN11', 'Macaroni Asam Pedas', 25000, 'macaroni-asam-pedas.png', 'Fast Food', 'tersedia'),
(12, 'MN12', 'Spaghetti Saus Ikan', 25000, 'spaghetti-saus-ikan.png', 'Fast Food', 'tersedia'),
(13, 'MN13', 'Ayam Goreng Tepung', 10000, 'ayam-goreng-tepung.png', 'Fast Food', 'tersedia'),
(14, 'MN14', 'Chicken Wings', 30000, 'chicken-wings.png', 'Fast Food', 'tersedia'),
(15, 'MN15', 'Roti Jalo Kuah Kari', 35000, 'roti-jalo.png', 'Fast Food', 'tersedia'),
(16, 'MN16', 'Burger Egg Cheese', 16000, 'egg-cheese-burger.png', 'Fast Food', 'tersedia'),
(17, 'MN17', 'Roll Sushi Tuna', 30000, 'roll-sushi-tuna.png', 'Fast Food', 'tersedia'),
(18, 'MN18', 'Mie Setan', 20000, 'mie-setan.png', 'Fast Food', 'tersedia'),
(19, 'MN19', 'Molen Kacang Hijau', 5000, 'molen-kacang-hijau.png', 'Snack', 'tersedia'),
(20, 'MN20', 'Kue Cubit', 10000, 'kue-cubit.png', 'Snack', 'tersedia'),
(21, 'MN21', 'Otak2 Udang Keju', 15000, 'otak-udang-keju.png', 'Snack', 'tersedia'),
(22, 'MN22', 'Donat Kentang', 15000, 'donat-kentang.png', 'Snack', 'tersedia'),
(23, 'MN23', 'Siomay Bandung', 30000, 'siomay-bandung.png', 'Snack', 'tersedia'),
(24, 'MN24', 'Rolade Tahu', 20000, 'rolade-tahu.png', 'Snack', 'tersedia'),
(25, 'MN25', 'Onion Ring', 10000, 'onion-ring.png', 'Snack', 'tersedia'),
(26, 'MN26', 'Puding Lumut', 10000, 'puding-lumut.png', 'Dessert', 'tersedia'),
(27, 'MN27', 'Oreo Cheese Cake', 25000, 'oreo-cheese-cake.png', 'Dessert', 'tersedia'),
(28, 'MN28', 'Strawberry Cheese Cake', 25000, 'strawberry-cheese-cake.png', 'Dessert', 'tersedia'),
(29, 'MN29', 'Cake Ubi Ungu', 20000, 'cake-ubi-ungu.png', 'Dessert', 'tersedia'),
(30, 'MN30', 'Black Forest', 25000, 'black-forest.png', 'Dessert', 'tersedia'),
(31, 'MN31', 'Wafer Coklat Puding', 20000, 'wafer-coklat-puding.png', 'Dessert', 'tersedia'),
(32, 'MN32', 'Es Krim Kacang Merah', 28000, 'es-krim-kacang-merah.png', 'Dessert', 'tersedia'),
(33, 'MN33', 'Ketan lapis Srikaya', 20000, 'ketan-lapis-srikaya.png', 'Dessert', 'tersedia'),
(34, 'MN34', 'Pandan Roll Kismis', 20000, 'pandan-roll-kismis.png', 'Dessert', 'tersedia'),
(35, 'MN35', 'Caramel Frappuccino', 8000, 'caramel-fc.png', 'Minuman', 'tersedia'),
(36, 'MN36', 'Susu Caramel Kopo', 8000, 'susu-karamel-kopo.png', 'Minuman', 'tersedia'),
(37, 'MN37', 'Ice Caramel Macchiato', 8000, 'caramel-mc.png', 'Minuman', 'tersedia'),
(38, 'MN38', 'Capuccino Float', 8000, 'capuccino-float.png', 'Minuman', 'tersedia'),
(39, 'MN39', 'Jus Pisang', 5000, 'jus-pisang.png', 'Minuman', 'tersedia'),
(40, 'MN40', 'Jus Nangka', 5000, 'jus-nangka.png', 'Minuman', 'tersedia'),
(41, 'MN41', 'Jus Mangga', 5000, 'jus-mangga.png', 'Minuman', 'tersedia'),
(42, 'MN42', 'Jus Alpukat', 5000, 'jus-alpukat.png', 'Minuman', 'tersedia'),
(43, 'MN43', 'Jus Melon', 5000, 'jus-melon.png', 'Minuman', 'tersedia'),
(44, 'MN44', 'Jus Sirsak', 5000, 'jus-sirsak.png', 'Minuman', 'tersedia'),
(45, 'MN45', 'Jus Wortel', 5000, 'jus-wortel.png', 'Minuman', 'tersedia'),
(46, 'MN46', 'Es Kacang Ijo', 12000, 'es-kacang-ijo.png', 'Minuman', 'tersedia'),
(47, 'MN47', 'Rainbow Juice', 12000, 'rainbow-juice.png', 'Minuman', 'tersedia'),
(48, 'MN48', 'Strawberry Ice Tea', 12000, 'strawberry-iced.png', 'Minuman', 'tersedia'),
(49, 'MN49', 'Smoothie Mangga', 12000, 'smoothie-mangga.png', 'Minuman', 'tersedia'),
(50, 'MN50', 'Es Kopyor', 8000, 'es-kopyor.png', 'Minuman', 'tersedia'),
(52, 'MN52', 'Es Teh Manis', 3000, 'es-teh-manis.png', 'Minuman', 'tersedia'),
(53, 'MN53', 'jus pisang', 10000, '685232c560186.jpg', 'Minuman', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `kode_pesanan` varchar(12) NOT NULL,
  `kode_menu` varchar(12) NOT NULL,
  `qty` int(11) NOT NULL,
  `tipe_penyajian` enum('dine in','take away') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `kode_pesanan`, `kode_menu`, `qty`, `tipe_penyajian`) VALUES
(0, '6850470621d8', '2', 0, 'dine in'),
(0, '6850470621d8', '8', 0, 'dine in'),
(0, '6850477c0fdb', '2', 0, 'dine in'),
(0, '6850477c0fdb', '8', 0, 'dine in'),
(0, '685047905ab0', '2', 0, 'dine in'),
(0, '685047905ab0', '8', 0, 'dine in'),
(0, '6850488503f3', '2', 0, 'dine in'),
(0, '6850488503f3', '8', 0, 'dine in'),
(0, '685048c0edf5', '2', 0, 'dine in'),
(0, '685048c0edf5', '8', 0, 'dine in'),
(0, '685048c3c6f4', '2', 0, 'dine in'),
(0, '685048c3c6f4', '8', 0, 'dine in'),
(0, '68504b8aa4e6', 'MN52', 2, 'dine in'),
(0, '68504b8aa4e6', 'MN50', 8, 'dine in'),
(0, '68504ce57ba7', 'MN48', 6, 'dine in'),
(0, '68504ce57ba7', 'MN47', 2, 'dine in'),
(0, '68504ce57ba7', 'MN44', 2, 'dine in'),
(0, '6850545e701f', 'MN51', 2, 'dine in'),
(0, '6850545e701f', 'MN50', 2, 'dine in'),
(0, '6850568bebda', 'MN31', 2, 'dine in'),
(0, '6850568bebda', 'MN30', 3, 'dine in'),
(0, '6850568bebda', 'MN28', 2, 'dine in'),
(0, '6850568bebda', 'MN27', 3, 'dine in'),
(0, '6850568bebda', 'MN26', 2, 'dine in'),
(0, '685153a42f44', 'MN05', 1, 'dine in'),
(0, '685153a42f44', 'MN03', 2, 'dine in'),
(0, '685153a42f44', 'MN02', 2, 'dine in'),
(0, '685156e05806', 'MN52', 16, 'dine in'),
(0, '685156e05806', 'MN51', 3, 'dine in'),
(0, '685166ba7b0e', 'MN52', 16, 'dine in'),
(0, '685166ba7b0e', 'MN51', 3, 'dine in'),
(0, '685166e4ce16', 'MN52', 16, 'dine in'),
(0, '685166e4ce16', 'MN51', 3, 'dine in'),
(0, '685166f45559', 'MN52', 2, 'dine in'),
(0, '685166f45559', 'MN51', 2, 'dine in'),
(0, '68516b918fdc', 'MN52', 4, 'dine in'),
(0, '6851713500af', 'MN52', 4, 'dine in'),
(0, '685173685374', 'MN52', 4, 'dine in'),
(0, '685174a8a347', 'MN52', 4, 'dine in'),
(0, '6851751f4b2a', 'MN48', 3, 'dine in'),
(0, '68517528c786', 'MN52', 4, 'dine in'),
(0, '68517c3c35c0', 'MN51', 3, 'dine in'),
(0, '6851800aa85e', 'MN39', 1, 'dine in'),
(0, '6851800aa85e', 'MN10', 2, 'dine in'),
(0, '6851800aa85e', 'MN09', 2, 'dine in'),
(0, '6851800aa85e', 'MN08', 2, 'dine in'),
(0, '685181de75e8', 'MN52', 2, ''),
(0, '685181de75e8', 'MN51', 2, ''),
(0, '685183205a13', 'MN28', 1, ''),
(0, '685183205a13', 'MN24', 1, ''),
(0, '685183205a13', 'MN23', 1, ''),
(0, '6851850a1e23', 'MN43', 1, ''),
(0, '685186369fbd', 'MN52', 1, ''),
(0, '68518789b6f7', 'MN06', 1, ''),
(0, '68518789b6f7', 'MN04', 1, ''),
(0, '6852203cb385', 'MN33', 1, ''),
(0, '68523d2b9dfc', 'MN53', 6, ''),
(0, '68526a945885', 'MN52', 1, ''),
(0, '68526a945885', 'MN51', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_pesanan` varchar(12) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_pesanan`, `nama_pelanggan`, `waktu`, `total`) VALUES
(0, '68504b8aa4e6', 'saidmirza', '2030-06-16 23:51:22', 0),
(0, '68504ce57ba7', 'said', '2025-06-16 23:57:09', 0),
(0, '6850545e701f', 'duha', '2025-06-17 00:29:02', 0),
(0, '6850568bebda', 'akem', '2025-06-17 00:38:19', 0),
(0, '685153a42f44', 'akem', '2025-06-17 18:38:12', 0),
(0, '685156e05806', 'hakim', '2025-06-17 18:52:00', 0),
(0, '685166e4ce16', 'hakim', '2025-06-17 20:00:20', 0),
(0, '685166f45559', 'saya', '2025-06-17 20:00:36', 0),
(0, '68516b918fdc', 'adrian', '2025-06-17 20:20:17', 0),
(0, '6851713500af', 'saidddd', '2025-06-17 20:44:21', 0),
(0, '685173685374', 'saidddd', '2025-06-17 20:53:44', 0),
(0, '685174a8a347', 'saidddd', '2025-06-17 20:59:04', 0),
(0, '6851751f4b2a', 'mirzaaa', '2025-06-17 21:01:03', 0),
(0, '68517528c786', 'saidddd', '2025-06-17 21:01:12', 0),
(0, '68517c3c35c0', 'saidddddd', '2025-06-17 21:31:24', 0),
(0, '6851800aa85e', 'sayaa', '2025-06-17 21:47:38', 0),
(0, '685181de75e8', 'akuu', '2025-06-17 21:55:26', 0),
(0, '6851850a1e23', 'duha', '0000-00-00 00:00:00', 2147483647),
(0, '685186369fbd', 'habibie', '2025-06-17 22:13:58', 0),
(0, '68518789b6f7', 'saidmirza', '2025-06-17 22:19:37', 0),
(0, '6852203cb385', 'said', '2025-06-18 09:11:08', 0),
(0, '68523d2b9dfc', 'aaa', '2025-06-18 11:14:35', 0),
(0, '68526a945885', 'siraj', '2025-06-18 14:28:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `no_hp`) VALUES
(0, 'mirza', 'c6c4cabe9fa81bb02e3825151703288b', 'mirza@gmail.com', '085234567845'),
(0, 'said', '40f7bc3df36b0d84e34fbf9c22fa3b9f', 'said@gmail.com', '085234567890'),
(0, 'hakim', '202cb962ac59075b964b07152d234b70', 'hakimalfitra@gmail.com', '085234567890'),
(0, 'siraj', '882da2fa8c2009581681da94ded9df5b', 'siraj@gmail.com', '085468087893');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
