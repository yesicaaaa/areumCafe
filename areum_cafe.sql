-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2021 at 04:02 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `areum_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_hak_akses` int(11) NOT NULL,
  `nama_akses` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_hak_akses`, `nama_akses`) VALUES
(1, 'admin'),
(2, 'kasir'),
(3, 'pelayan');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `harga` int(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(128) NOT NULL,
  `jenis` varchar(128) NOT NULL,
  `stok` int(11) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama`, `harga`, `deskripsi`, `foto`, `jenis`, `stok`, `date_created`) VALUES
(3, 'Americano Panas', 23500, 'minuman kopi yang dibuat dengan mencampurkan satu seloki espresso dengan air panas. Air panas yang digunakan dalam minuman ini adalah sebanyak 6 hingga 8 ons.', 'Americano_Panas.jpg', 'Kopi', 40, '2021-06-28'),
(4, 'Bolu Gulung Tiramissu', 17000, 'Kue bolu yang dipanggang menggunakan loyang dangkal, diisi dengan krim kopi kemudian digulung', 'Bolu_Gulung_Tiramissu.jpg', 'Bolu', 106, '2021-06-28'),
(5, 'Latte Panas', 29000, 'Espresso atau kopi yang dicampur dengan susu dan memiliki lapisan busa yang tipis di bagian atasnya', 'Latte_Panas.jpg', 'Kopi', 4, '2021-06-28'),
(8, 'Es Teh Lemon', 13500, 'Minuman yang mengandung kafeina, sebuah infusi yang dibuat dengan cara menyeduh daun, pucuk daun, atau tangkai daun yang dikeringkan dari tanaman Camellia sinensis dan diberi perasan jeruk lemon.', 'Es_Teh_Lemon.jpg', 'teh', 29, '2021-06-25'),
(9, 'Teh Melati Panas', 12000, 'Minuman yang mengandung kafeina, sebuah infusi yang dibuat dengan cara menyeduh daun, pucuk daun, atau tangkai daun yang dikeringkan dari tanaman Camellia sinensis dan dicampur dengan ekstrak bunga melati.', 'Teh_Melati_Panas.jpg', 'teh', 114, '2021-06-28'),
(15, 'Jus Alpukat', 21000, 'Dibuat dengan cara memblender buah alpukat bersama sedikit air dan takaran gula yang sesuai.', 'Jus_Alpukat.jpg', 'jus', 82, '2021-06-28'),
(16, 'Jus Strawberry', 27500, 'dibuat dengan cara memblender buah stroberi bersama sediit air dan takaran gula yang sesuai.', 'Jus_Strawberry.jpg', 'jus', 66, '2021-06-28'),
(17, 'Susu Murni', 16000, 'Susu jenis ini tidak melalui banyak proses pengolahan. Selain belum diolah atau proses pasteurisasi, susu murni juga tidak mengalami penambahan atau pengurangan nutrisi yang terkandung di dalamnya.', 'Susu_Murni.jpg', 'susu', 19, '2021-06-25'),
(18, 'Susu Murni Apel', 18500, 'Susu jenis ini tidak melalui banyak proses pengolahan. Selain belum diolah atau proses pasteurisasi, susu murni juga tidak mengalami penambahan atau pengurangan nutrisi yang terkandung di dalamnya ditambah dengan perasa apel asli.', 'Susu_Murni_Apel.jpg', 'susu', 88, '2021-06-28'),
(19, 'Coca-cola', 8500, 'Coca-Cola adalah minuman ringan berkarbonasi yang dijual di toko, restoran dan mesin penjual di lebih dari 200 negara.', 'Coca-cola.jpg', 'soda', 89, '2021-06-29'),
(20, 'Fanta', 8500, 'Fanta is a brand of fruit-flavored carbonated soft drinks created by Coca-Cola Deutschland under the leadership of German businessman Max Keith.', 'Fanta.jpg', 'soda', 80, '2021-06-29'),
(21, 'Nasi Goreng Seafood', 32500, 'Nasi goreng adalah sebuah makanan berupa nasi yang digoreng dan diaduk dalam minyak goreng, margarin, atau mentega, dan dicampur dengan berbagai seafood.', 'Nasi_Goreng_Seafood.jpg', 'nasi', 71, '2021-06-29'),
(22, 'Nasi Goreng Telur &amp; Teri', 36000, 'Nasi goreng adalah sebuah makanan berupa nasi yang digoreng dan diaduk dalam minyak goreng, margarin, atau mentega, dan dicampur dengan ikan teri.', 'Nasi_Goreng_Telur_Teri.jpg', 'nasi', 49, '2021-06-29'),
(23, 'Mie Goreng Saus Tiram', 69000, 'Mie adalah adonan tipis dan panjang yang telah digulung, dikeringkan, dan dimasak dalam air mendidih.', 'Mie_Goreng_Saus_Tiram.jpg', 'mie', 47, '2021-06-29'),
(24, 'Mie Kuah Jamur', 54000, 'Mie adalah adonan tipis dan panjang yang telah digulung, dikeringkan, dan dimasak dalam air mendidih.', 'Mie_Kuah_Jamur.jpg', 'mie', 85, '2021-06-29'),
(26, 'Blueberry Thumbprint', 149000, 'Kue kering adalah kue dengan kadar air yang minimal, sehingga dapat tahan disimpan lebih lama daripada kue basah.', 'Blueberry_Thumbprint.jpg', 'pastry', 15, '2021-06-29'),
(27, 'Nastar Daun', 162000, 'Kue kering adalah kue dengan kadar air yang minimal, sehingga dapat tahan disimpan lebih lama daripada kue basah.', 'Nastar_Daun.jpg', 'pastry', 27, '2021-06-29'),
(29, 'Tiramissu Mousse', 38000, 'Dessert adalah hidangan yang disuguhkan di paling akhir dalam susunan menu yang berfungsi sebagai makanan penutup atau pencuci mulut', 'Tiramissu_Mousse.jpg', 'dessert', 73, '2021-06-29'),
(30, 'Berries Pudding', 21000, 'Dessert adalah hidangan yang disuguhkan di paling akhir dalam susunan menu yang berfungsi sebagai makanan penutup atau pencuci mulut', 'Berries_Pudding.jpg', 'dessert', 63, '2021-06-29'),
(31, 'Bolu Mentega', 17500, 'Bolu adalah kue berbahan dasar tepung (terigu), gula, dan telur. Kue bolu umumnya dimatangkan dengan cara dipanggang di dalam oven.', 'Bolu_Mentega.jpg', 'bolu', 41, '2021-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(128) DEFAULT NULL,
  `phone` varchar(13) NOT NULL,
  `tanggal` date NOT NULL,
  `no_meja` int(11) NOT NULL,
  `id_waiter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `phone`, `tanggal`, `no_meja`, `id_waiter`) VALUES
(1624521876, 'Devina Resti', '089367448922', '2021-06-24', 3, 3),
(1624609243, 'Kirani', '089378440922', '2021-06-25', 5, 3),
(1624609519, 'Alma', '089742773899', '2021-06-25', 4, 3),
(1624612183, 'Almaira', '089588839021', '2021-06-25', 7, 4),
(1624843842, 'Arrasya Naufal', '088178449022', '2021-06-28', 2, 3),
(1624950961, 'Kirani Putri', '089478882899', '2021-06-29', 3, 3),
(1624951067, 'Firli Firlana', '088186448930', '2021-06-29', 8, 3),
(1624953565, 'Aksa Putra', '089478880932', '2021-06-29', 3, 3),
(1624960439, 'Cantika', '089478883290', '2021-06-29', 5, 3),
(1625195249, 'Alfredo Santos', '087367772187', '2021-07-02', 5, 3),
(1625195316, 'Alghifari', '089367730923', '2021-07-02', 9, 3),
(1625195346, 'Alif Haryanto', '088178448789', '2021-07-02', 1, 3),
(1625195384, 'Andi Alfa', '084677789822', '2021-07-02', 6, 3),
(1625195415, 'Argi Ahmad', '087367774398', '2021-07-02', 2, 3),
(1625195451, 'Bambang', '083278883399', '2021-07-02', 2, 3),
(1625195486, 'David', '085267773899', '2021-07-02', 7, 3),
(1625195516, 'Dudi Setiadi', '087467773288', '2021-07-02', 9, 3),
(1625195547, 'Fabian Ezra', '086347887888', '2021-07-02', 7, 3),
(1625195581, 'Faishal', '088167468993', '2021-07-02', 7, 3),
(1630382109, 'Raya Fitri', '089873777833', '2021-08-31', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `rowid` varchar(255) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pelanggan`, `id_menu`, `qty`, `rowid`, `subtotal`, `status`) VALUES
(31, 1624521876, 3, 1, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 23500, 'Sudah Dibayar'),
(32, 1624521876, 9, 1, '45c48cce2e2d7fbdea1afc51c7c6ad26', 12000, 'Sudah Dibayar'),
(33, 1624609243, 4, 1, 'a87ff679a2f3e71d9181a67b7542122c', 17000, 'Sudah Dibayar'),
(34, 1624609243, 15, 1, '9bf31c7ff062936a96d3c8bd1f8f2ff3', 21000, 'Sudah Dibayar'),
(35, 1624609243, 17, 1, '70efdf2ec9b086079795c442636b55fb', 16000, 'Sudah Dibayar'),
(36, 1624609519, 5, 1, 'e4da3b7fbbce2345d7772b0674a318d5', 29000, 'Sudah Dibayar'),
(37, 1624612183, 9, 1, '45c48cce2e2d7fbdea1afc51c7c6ad26', 12000, 'Dipesan'),
(38, 1624843842, 3, 2, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 47000, 'Sudah Dibayar'),
(39, 1624843842, 9, 5, '45c48cce2e2d7fbdea1afc51c7c6ad26', 60000, 'Sudah Dibayar'),
(40, 1624950961, 5, 2, 'e4da3b7fbbce2345d7772b0674a318d5', 58000, 'Sudah Dibayar'),
(41, 1624950961, 8, 1, 'c9f0f895fb98ab9159f51fd0297e236d', 13500, 'Sudah Dibayar'),
(42, 1624950961, 15, 1, '9bf31c7ff062936a96d3c8bd1f8f2ff3', 21000, 'Sudah Dibayar'),
(43, 1624950961, 16, 1, 'c74d97b01eae257e44aa9d5bade97baf', 27500, 'Sudah Dibayar'),
(44, 1624950961, 4, 5, 'a87ff679a2f3e71d9181a67b7542122c', 85000, 'Sudah Dibayar'),
(45, 1624951067, 3, 1, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 23500, 'Dipesan'),
(46, 1624951067, 16, 1, 'c74d97b01eae257e44aa9d5bade97baf', 27500, 'Dipesan'),
(47, 1624953565, 5, 1, 'e4da3b7fbbce2345d7772b0674a318d5', 29000, 'Sudah Dibayar'),
(48, 1624953565, 4, 1, 'a87ff679a2f3e71d9181a67b7542122c', 17000, 'Sudah Dibayar'),
(49, 1624960439, 27, 1, '02e74f10e0327ad868d138f2b4fdd6f0', 162000, 'Sudah Dibayar'),
(50, 1624960439, 26, 2, '4e732ced3463d06de0ca9a15b6153677', 298000, 'Sudah Dibayar'),
(51, 1624960439, 29, 2, '6ea9ab1baa0efb9e19094440c317e21b', 76000, 'Sudah Dibayar'),
(52, 1624960439, 30, 1, '34173cb38f07f89ddbebc2ac9128303f', 21000, 'Sudah Dibayar'),
(53, 1624960439, 5, 2, 'e4da3b7fbbce2345d7772b0674a318d5', 58000, 'Sudah Dibayar'),
(54, 1624960439, 3, 1, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 23500, 'Sudah Dibayar'),
(55, 1624960439, 9, 2, '45c48cce2e2d7fbdea1afc51c7c6ad26', 24000, 'Sudah Dibayar'),
(56, 1624960439, 8, 2, 'c9f0f895fb98ab9159f51fd0297e236d', 27000, 'Sudah Dibayar'),
(57, 1624960439, 15, 1, '9bf31c7ff062936a96d3c8bd1f8f2ff3', 21000, 'Sudah Dibayar'),
(58, 1624960439, 19, 2, '1f0e3dad99908345f7439f8ffabdffc4', 17000, 'Sudah Dibayar'),
(59, 1624960439, 23, 1, '37693cfc748049e45d87b8c7d8b9aacd', 69000, 'Sudah Dibayar'),
(60, 1624960439, 24, 1, '1ff1de774005f8da13f42943881c655f', 54000, 'Sudah Dibayar'),
(61, 1625195249, 3, 1, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 23500, 'Belum Dibayar'),
(62, 1625195316, 18, 1, '6f4922f45568161a8cdf4ad2299f6d23', 18500, 'Belum Dibayar'),
(63, 1625195346, 31, 1, 'c16a5320fa475530d9583c34fd356ef5', 17500, 'Belum Dibayar'),
(64, 1625195346, 9, 1, '45c48cce2e2d7fbdea1afc51c7c6ad26', 12000, 'Belum Dibayar'),
(65, 1625195384, 20, 1, '98f13708210194c475687be6106a3b84', 8500, 'Belum Dibayar'),
(66, 1625195384, 15, 1, '9bf31c7ff062936a96d3c8bd1f8f2ff3', 21000, 'Belum Dibayar'),
(67, 1625195415, 17, 1, '70efdf2ec9b086079795c442636b55fb', 16000, 'Belum Dibayar'),
(68, 1625195451, 21, 1, '3c59dc048e8850243be8079a5c74d079', 32500, 'Sudah Dibayar'),
(69, 1625195451, 8, 1, 'c9f0f895fb98ab9159f51fd0297e236d', 13500, 'Sudah Dibayar'),
(70, 1625195486, 24, 1, '1ff1de774005f8da13f42943881c655f', 54000, 'Belum Dibayar'),
(71, 1625195516, 5, 1, 'e4da3b7fbbce2345d7772b0674a318d5', 29000, 'Dipesan'),
(72, 1625195547, 3, 1, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 23500, 'Dipesan'),
(73, 1625195581, 5, 1, 'e4da3b7fbbce2345d7772b0674a318d5', 29000, 'Dipesan'),
(74, 1630382109, 5, 1, 'e4da3b7fbbce2345d7772b0674a318d5', 29000, 'Belum Dibayar'),
(75, 1630382109, 21, 1, '3c59dc048e8850243be8079a5c74d079', 32500, 'Belum Dibayar'),
(76, 1630382109, 29, 1, '6ea9ab1baa0efb9e19094440c317e21b', 38000, 'Belum Dibayar'),
(77, 1630382109, 4, 1, 'a87ff679a2f3e71d9181a67b7542122c', 17000, 'Belum Dibayar'),
(78, 1630382109, 15, 1, '9bf31c7ff062936a96d3c8bd1f8f2ff3', 21000, 'Belum Dibayar');

--
-- Triggers `pesanan`
--
DELIMITER $$
CREATE TRIGGER `updateStok` AFTER INSERT ON `pesanan` FOR EACH ROW BEGIN
UPDATE menu SET stok = stok-new.qty
WHERE id_menu = new.id_menu;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `total_pesanan`
--

CREATE TABLE `total_pesanan` (
  `id_total_pesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `total_items` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `total_pesanan`
--

INSERT INTO `total_pesanan` (`id_total_pesanan`, `id_pelanggan`, `total_items`, `total`, `tax`, `subtotal`) VALUES
(6, 1624521876, 2, 35500, 3550, 39050),
(7, 1624609243, 3, 54000, 5400, 59400),
(8, 1624609519, 1, 29000, 2900, 31900),
(9, 1624612183, 1, 12000, 1200, 13200),
(10, 1624843842, 7, 107000, 10700, 117700),
(11, 1624950961, 10, 205000, 20500, 225500),
(12, 1624951067, 2, 51000, 5100, 56100),
(13, 1624953565, 2, 46000, 4600, 50600),
(14, 1624960439, 18, 850500, 85050, 935550),
(15, 1625195249, 1, 23500, 2350, 25850),
(16, 1625195316, 1, 18500, 1850, 20350),
(17, 1625195346, 2, 29500, 2950, 32450),
(18, 1625195384, 2, 29500, 2950, 32450),
(19, 1625195415, 1, 16000, 1600, 17600),
(20, 1625195451, 2, 46000, 4600, 50600),
(21, 1625195486, 1, 54000, 5400, 59400),
(22, 1625195516, 1, 29000, 2900, 31900),
(23, 1625195547, 1, 23500, 2350, 25850),
(24, 1625195581, 1, 29000, 2900, 31900),
(25, 1630382109, 5, 137500, 13750, 151250);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(128) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `total_harga` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pegawai`, `id_pelanggan`, `tanggal_transaksi`, `total_harga`, `total_bayar`, `kembalian`) VALUES
('TR1624604826', 2, 1624521876, '2021-06-25 14:07:06', 39050, 100000, 60950),
('TR1624609653', 2, 1624609519, '2021-06-25 15:27:33', 31900, 50000, 18100),
('TR1624848394', 8, 1624609243, '2021-06-28 09:46:34', 59400, 100000, 40600),
('TR1624848413', 8, 1624843842, '2021-06-28 09:46:53', 117700, 200000, 82300),
('TR1624958126', 2, 1624950961, '2021-06-29 16:15:26', 225500, 300000, 74500),
('TR1624958198', 2, 1624953565, '2021-06-29 16:16:38', 50600, 60000, 9400),
('TR1625111479', 2, 1624960439, '2021-07-01 10:51:19', 935550, 950000, 14450),
('TR1630381959', 2, 1625195451, '2021-08-31 10:52:39', 50600, 55000, 4400);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` int(11) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `hak_akses`, `date_created`) VALUES
(1, 'Yesica Anggraeni', 'yesica@gmail.com', '$2y$10$PTlG0JDrQAqIaxAfTe6lceSDnkpl/EdfCL09JdMtWVCU3oS9/v/9S', 1, '2021-06-18'),
(2, 'Pebi Riyani', 'pebi@gmail.com', '$2y$10$UiE4AyszD5JzRApTFjL/5uaHqKARFdVGv8RzGf3stwZ9p/4cmjvta', 2, '2021-06-18'),
(3, 'Ajeng Maelani', 'ajeng@gmail.com', '$2y$10$Vqw9Ls17OhZS/Gyju7e3iuWFSCWI4ah2jzmqjTgKZT6OKXCz2K31.', 3, '2021-06-18'),
(4, 'Nadia Damayanti', 'nadia@gmail.com', '$2y$10$gZNH7lezUm3NVnJ6f7mAw.Fj/efg7/QRoX2aFR7JZ2VDbxjItZeKa', 3, '2021-06-21'),
(7, 'Alma Damayanti', 'almaa@gmail.com', '$2y$10$o/5XHm9jGrbGGUZmXyxFbevqUdch726PecLO1SEQaeafrpsdvAghK', 3, '2021-06-21'),
(8, 'Raya Fitriani', 'raya@gmail.com', '$2y$10$Nf5gR7mbotNE/F5Z3a97/OVMH14Zy2YsPcjub/FjJTPHotjhoUoPu', 2, '2021-06-21'),
(9, 'Willyan Wilrandi', 'willyan@gmail.com', '$2y$10$ZW0YwCiKL0jwNhZxyC8rV.Unm.XwcEW.0.yPlNK/Ep2i6dTlmOWeq', 2, '2021-09-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_hak_akses`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `id_waiter` (`id_waiter`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `total_pesanan`
--
ALTER TABLE `total_pesanan`
  ADD PRIMARY KEY (`id_total_pesanan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `hak_akses` (`hak_akses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `total_pesanan`
--
ALTER TABLE `total_pesanan`
  MODIFY `id_total_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_waiter`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`hak_akses`) REFERENCES `hak_akses` (`id_hak_akses`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
