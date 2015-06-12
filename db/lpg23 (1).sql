-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Mei 2015 pada 11.37
-- Versi Server: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lpg2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brokens`
--

CREATE TABLE IF NOT EXISTS `brokens` (
`broken_id` int(11) NOT NULL,
  `tr_plan_detail_shipment_id` int(11) NOT NULL,
  `broken_status` tinyint(4) NOT NULL,
  `broken_qty` int(11) NOT NULL,
  `broken_total` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `coas`
--

CREATE TABLE IF NOT EXISTS `coas` (
`coa_id` int(11) NOT NULL,
  `parent_coa_id` int(11) NOT NULL,
  `coa_code` varchar(8) NOT NULL,
  `coa_hierarchy` varchar(20) NOT NULL,
  `coa_name` varchar(100) NOT NULL,
  `coa_group` int(11) NOT NULL,
  `coa_level` int(11) NOT NULL,
  `coa_type` int(11) NOT NULL,
  `coa_active_status` tinyint(1) NOT NULL,
  `coa_normally` int(11) NOT NULL,
  `coa_account_type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `coas`
--

INSERT INTO `coas` (`coa_id`, `parent_coa_id`, `coa_code`, `coa_hierarchy`, `coa_name`, `coa_group`, `coa_level`, `coa_type`, `coa_active_status`, `coa_normally`, `coa_account_type`) VALUES
(1, 1, '1', '1-0000', 'Aktiva', 0, 1, 1, 1, 1, 0),
(2, 1, '1', '1-1000', 'Aktiva Lancar', 0, 2, 1, 1, 1, 0),
(3, 1, '2', '1-2000', 'Aktiva Lain-Lain', 0, 2, 1, 1, 1, 1),
(4, 1, '3', '1-3000', 'Aktiva Tetap', 0, 2, 1, 1, 1, 1),
(10, 10, '2', '2-0000', 'Kewajiban', 0, 1, 1, 1, -1, 1),
(11, 11, '3', '3-0000', 'Modal', 0, 1, 1, 1, 1, 1),
(12, 10, '1', '2-1000', 'Hutang Lancar', 0, 2, 1, 1, -1, 1),
(13, 10, '2', '2-2000', 'Hutang Jangka Panjang', 0, 2, 1, 1, -1, 1),
(14, 11, '1', '3-1000', 'Modal Kepemilikan', 0, 2, 1, 1, 1, 1),
(15, 11, '2', '3-2000', 'Modal Saat ini', 0, 2, 1, 1, 1, 1),
(16, 11, '3', '3-3000', 'Modal di tahan', 0, 2, 1, 1, 1, 1),
(19, 2, '01', '1-1100', 'Kas & Bank', 0, 4, 1, 0, 1, 2),
(20, 2, '02', '1-1200', 'Piutang', 0, 4, 1, 0, 1, 2),
(21, 2, '03', '1-1300', 'Stock Repair', 0, 4, 1, 0, 1, 2),
(22, 3, '01', '1-2100', 'Pembayaran di muka', 0, 4, 0, 0, 1, 3),
(23, 3, '02', '1-2200', 'Pembayaran Deposit', 0, 4, 0, 0, 1, 3),
(24, 3, '03', '1-2300', 'PPn Masukan', 0, 4, 0, 0, 1, 3),
(25, 3, '04', '1-2400', 'PPh 23', 0, 4, 0, 0, 1, 3),
(26, 4, '01', '1-3100', 'Peralatan Kantor', 0, 4, 1, 0, 1, 4),
(27, 4, '02', '1-3200', 'Kendaraan', 0, 4, 1, 0, 1, 4),
(28, 4, '03', '1-3300', 'Komputer & Accesories', 0, 4, 1, 0, 1, 4),
(29, 4, '04', '1-3400', 'Bangunan', 0, 4, 1, 0, 1, 4),
(30, 4, '05', '1-3500', 'Tanah', 0, 4, 0, 0, 1, 4),
(31, 4, '06', '1-3600', 'Mesin', 0, 4, 1, 0, 1, 4),
(32, 4, '07', '1-3700', 'Deposit dan Invetasi', 0, 4, 0, 0, 1, 4),
(33, 4, '08', '1-3800', 'Aset Kedungturi', 0, 4, 0, 0, 1, 4),
(34, 3, '05', '1-2500', 'Pembayaran di muka lainnya', 0, 4, 0, 0, 1, 3),
(35, 19, '01', '1-1110', 'Kas', 0, 5, 0, 0, 1, 2),
(36, 19, '02', '1-1120', 'Bank BCA', 0, 5, 0, 0, 1, 2),
(37, 19, '03', '1-1130', 'Bank Danamon', 0, 5, 0, 0, 1, 2),
(38, 19, '04', '1-1140', 'Bank Panin', 0, 5, 0, 0, 1, 2),
(39, 19, '05', '1-1150', 'Bank Hana', 0, 5, 0, 0, 1, 2),
(40, 20, '01', '1-1210', 'Piutang Dagang', 0, 5, 0, 0, 1, 2),
(41, 20, '02', '1-1220', 'Piutang Karyawan', 0, 5, 0, 0, 1, 2),
(42, 20, '03', '1-1230', 'Piutang OR', 0, 5, 0, 0, 1, 2),
(43, 20, '04', '1-1240', 'Piutang Gudang', 0, 5, 0, 0, 1, 2),
(44, 20, '05', '1-1250', 'Piutang Tak Tertagih', 0, 5, 0, 0, 1, 2),
(45, 20, '06', '1-1260', 'Piutang Pihak Lain', 0, 5, 0, 0, 1, 2),
(46, 21, '01', '1-1310', 'Stock Repair - Cat', 0, 5, 0, 0, 1, 2),
(47, 21, '02', '1-1320', 'Stock Repair - Bahan', 0, 5, 0, 0, 1, 2),
(48, 21, '03', '1-1330', 'Stock Repair - Sparepart', 0, 5, 0, 0, 1, 2),
(49, 21, '04', '1-1340', 'Stock Repair - Tenaga dan Jasa', 0, 5, 0, 0, 1, 2),
(50, 26, '01', '1-3110', 'Furniture & Peralatan Lainnya', 0, 5, 0, 0, 1, 4),
(51, 26, '02', '1-3120', 'Akun, Depre.Peralatan Kantor', 0, 5, 0, 0, 1, 4),
(52, 27, '01', '1-3210', 'Kendaraan', 0, 5, 0, 0, 1, 4),
(53, 27, '02', '1-3220', 'Akum.Depre.Kendaraan', 0, 5, 0, 0, 1, 4),
(54, 28, '01', '1-3310', 'Komputer & Accesories', 0, 5, 0, 0, 1, 4),
(55, 28, '02', '1-3320', 'Akum.Depre.Kendaraan', 0, 5, 0, 0, 1, 4),
(56, 29, '01', '1-3410', 'Bangunan', 0, 5, 0, 0, 1, 4),
(57, 29, '02', '1-3420', 'Akum.Depre.Bangunan', 0, 5, 0, 0, 1, 4),
(58, 31, '01', '1-3610', 'Mesin', 0, 5, 0, 0, 1, 4),
(59, 31, '02', '1-3620', 'Akum.Depre.	Mesin', 0, 5, 0, 0, 1, 4),
(60, 12, '01', '2-1100', 'Hutang Usaha', 0, 4, 0, 0, -1, 12),
(61, 12, '02', '2-1200', 'PPn', 0, 4, 1, 0, -1, 12),
(62, 12, '03', '2-1300', 'Titipan Uang Muka', 0, 4, 0, 0, -1, 12),
(63, 12, '04', '2-1400', 'OR', 0, 4, 0, 0, -1, 12),
(64, 12, '05', '2-1500', 'Hutang Gudang', 0, 4, 0, 0, -1, 12),
(65, 12, '06', '2-1600', 'Hutang Karyawan', 0, 4, 0, 0, -1, 12),
(66, 12, '07', '2-1700', 'Hutang Gaji', 0, 4, 1, 0, -1, 12),
(67, 12, '08', '2-1800', 'Hutang Bunga', 0, 4, 0, 0, -1, 12),
(68, 61, '01', '2-1210', 'PPn Masukan', 0, 5, 0, 0, -1, 12),
(69, 61, '02', '2-1220', 'PPn Keluaran', 0, 5, 0, 0, -1, 12),
(70, 66, '01', '2-1710', 'Hutang Gaji', 0, 5, 0, 0, -1, 12),
(71, 66, '02', '2-1720', 'Hutang PPH 21', 0, 5, 0, 0, -1, 12),
(72, 13, '01', '2-2100', 'Hutang Bank', 0, 4, 0, 0, -1, 13),
(73, 13, '02', '2-2200', 'Hutang Kantor Pusat', 0, 4, 0, 0, -1, 13),
(74, 13, '03', '2-2300', 'Hutang Pihak Lain', 0, 4, 0, 0, -1, 13),
(75, 13, '04', '2-2400', 'Hutang Jangka Panjang Lainnya', 0, 4, 0, 0, -1, 13),
(76, 14, '01', '3-1100', 'Modal Saham', 0, 4, 0, 0, 1, 14),
(77, 14, '02', '3-1200', 'Modal Pribadi', 0, 4, 0, 0, 1, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cost`
--

CREATE TABLE IF NOT EXISTS `cost` (
`cost_id` int(11) NOT NULL,
  `cost_purchase` int(11) NOT NULL,
  `cost_driver` int(11) NOT NULL,
  `cost_co_driver` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cost`
--

INSERT INTO `cost` (`cost_id`, `cost_purchase`, `cost_driver`, `cost_co_driver`) VALUES
(1, 15000, 95000, 75000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
`employee_id` int(11) NOT NULL,
  `employee_nip` varchar(10) DEFAULT NULL,
  `employee_name` varchar(40) DEFAULT NULL,
  `employee_birth` date DEFAULT NULL,
  `employee_gender` int(11) DEFAULT NULL,
  `employee_position_id` int(11) DEFAULT NULL,
  `employee_ktp` varchar(30) DEFAULT NULL,
  `employee_address` varchar(100) DEFAULT NULL,
  `employee_phone` varchar(20) DEFAULT NULL,
  `employee_email` varchar(30) DEFAULT NULL,
  `employee_bank_number` varchar(30) DEFAULT NULL,
  `employee_bank_name` varchar(50) DEFAULT NULL,
  `employee_bank_beneficiary` varchar(50) DEFAULT NULL,
  `employee_active_status` varchar(1) DEFAULT NULL,
  `employee_pic` mediumtext
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_nip`, `employee_name`, `employee_birth`, `employee_gender`, `employee_position_id`, `employee_ktp`, `employee_address`, `employee_phone`, `employee_email`, `employee_bank_number`, `employee_bank_name`, `employee_bank_beneficiary`, `employee_active_status`, `employee_pic`) VALUES
(1, NULL, 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'apan.jpg'),
(19, 'E0000001', 'Agus Siswanto', '1975-08-12', 1, 2, '3506151208750005', 'Dawuhan, 001/002 Dawuhan, Purwoasri , Kediri', '085731069800', 'sangkan@yahoo.com', '456787686', 'BCA', 'sangkan', '1', NULL),
(20, 'E0000002', 'Kholis Ainur Rofi', '1987-10-20', 1, 2, '3509032010870001', 'Ds.Sumberjo Ds.Yosorati Sumber Baru - Jember', '087853474152', 'paijo@gmail.com', '123456788', 'bca', 'paijo', '1', NULL),
(21, 'E0000003', 'Anang Suhudi', '1971-04-27', 1, 2, '3578262704710001', 'Mulyorejo Tengah 7 / 8 Surabaya', '087853896059', 'supali@yahoo.co.id', '09876543', 'mandiri', 'supali', '1', NULL),
(22, NULL, 'Ali Wafa', '1996-09-11', 1, 4, '3509031109960002', 'Dsn. Lanasan, Gelang, Sumber Baru Jember', '083831885716', NULL, NULL, NULL, NULL, '1', NULL),
(23, NULL, 'Edi Susanto', '1996-11-10', 1, 4, '3522271011960001', 'Sumber Galeh,020/007, Bareng Sekar Bojonegoro', '085645288576', NULL, NULL, NULL, NULL, '1', NULL),
(24, NULL, 'Dwi', NULL, 1, 4, '-', '-', '083856324415', NULL, NULL, NULL, NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `employee_groups`
--

CREATE TABLE IF NOT EXISTS `employee_groups` (
`employee_group_id` int(11) NOT NULL,
  `employee_group_name` varchar(100) NOT NULL,
  `employee_group_description` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `employee_groups`
--

INSERT INTO `employee_groups` (`employee_group_id`, `employee_group_name`, `employee_group_description`) VALUES
(2, 'Group 2', 'sementara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `employee_positions`
--

CREATE TABLE IF NOT EXISTS `employee_positions` (
`employee_position_id` int(11) NOT NULL,
  `employee_position_name` varchar(100) NOT NULL,
  `employee_position_description` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `employee_positions`
--

INSERT INTO `employee_positions` (`employee_position_id`, `employee_position_name`, `employee_position_description`) VALUES
(1, 'Sekretaris', ''),
(2, 'Driver', ''),
(6, 'Manager', ''),
(4, 'Co driver', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gl_code`
--

CREATE TABLE IF NOT EXISTS `gl_code` (
  `value` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `gl_code`
--

INSERT INTO `gl_code` (`value`) VALUES
('0000002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`group_id` int(11) NOT NULL,
  `group_name` varchar(50) DEFAULT NULL,
  `group_is_active` varchar(1) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_is_active`) VALUES
(1, 'Administrator', '1'),
(5, 'test', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `journals_sl`
--

CREATE TABLE IF NOT EXISTS `journals_sl` (
`journal_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `coa_id` int(11) NOT NULL,
  `market_id` int(11) NOT NULL,
  `journal_debit` bigint(20) NOT NULL,
  `journal_credit` bigint(20) NOT NULL,
  `journal_index` int(11) NOT NULL,
  `journal_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `journals_sl`
--

INSERT INTO `journals_sl` (`journal_id`, `transaction_id`, `coa_id`, `market_id`, `journal_debit`, `journal_credit`, `journal_index`, `journal_description`) VALUES
(1, 1, 3, 3, 1000, 0, 0, 'a'),
(2, 1, 6, 3, 0, 1000, 1, 'a'),
(3, 2, 4, 3, 3000, 0, 0, 'a'),
(4, 2, 6, 3, 0, 3000, 1, 'a'),
(5, 3, 11, 3, 50000, 0, 0, 'assa'),
(6, 3, 14, 3, 0, 50000, 1, 'assa'),
(7, 4, 4, 1, 9000, 0, 0, 'kali'),
(8, 4, 12, 1, 0, 9000, 1, 'kali');

-- --------------------------------------------------------

--
-- Struktur dari tabel `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
`location_id` int(11) NOT NULL,
  `location_category_id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `location_phone` varchar(100) NOT NULL,
  `location_address` text NOT NULL,
  `location_rt_rw` varchar(100) NOT NULL,
  `location_kelurahan` varchar(100) NOT NULL,
  `location_kecamatan` varchar(100) NOT NULL,
  `location_kota` varchar(100) NOT NULL,
  `location_price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `locations`
--

INSERT INTO `locations` (`location_id`, `location_category_id`, `location_name`, `location_phone`, `location_address`, `location_rt_rw`, `location_kelurahan`, `location_kecamatan`, `location_kota`, `location_price`) VALUES
(1, 1, 'SPBE A', '-', '-', '', '', '', '', 0),
(2, 1, 'SPBE B', '-', '-', '', '', '', '', 0),
(3, 2, 'H. MISDILAH', '085733165252', 'Jl. Kalijudan 15', '01 / 01', 'Pacar Kembang', 'Tambaksari', 'Surabaya', 2000),
(4, 2, 'Hj. SYAHADAH', '031-5935818', 'Jl. Manyar Kartika VIII / 32', '03 / 01 ', 'Menur Pumpungan', 'Sukolilo', 'Surabaya', 0),
(7, 2, 'IBU MEITY ARDIANA', '0878-5237-8686', 'Jl. Kampung Malang Tengah 35A', '05 / 05', 'Tegalsari', 'Tegalsari ', 'Surabaya', 0),
(8, 2, 'MUNAAMAH', '087854104876', 'Jl. Keputih Tegal 48', '01 / 02', 'Keputih', 'Sukolilo', 'Surabaya', 0),
(9, 2, 'GUDANG/OUTLET', '082140443976', 'Jl. Kalijudan 250', '00/00', 'Kalijudan', 'Mulyorejo', 'Surabaya', 0),
(10, 2, 'IBU SRI REDJEKI W.', '031-5936244', 'Jl. Mojo III / 45A', '10 / 05', 'Mojo', 'Gubeng', 'Surabaya', 0),
(11, 2, 'IBU SRI WAHYUNI', '087855529191', 'Jl. Kalisari 40', '03 / 04', 'Kalisari', 'Mulyorejo', 'Surabaya', 0),
(12, 2, 'IBU SUPARMI', '031-5660450  |  081331148500', 'Jl. Banyu Urip Kidul 4/ 4', '04 / 03', 'Banyu Urip', 'Sawahan', 'Surabaya', 0),
(13, 3, 'Gudang/Kantor', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `location_categories`
--

CREATE TABLE IF NOT EXISTS `location_categories` (
`location_category_id` int(11) NOT NULL,
  `location_category_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `location_categories`
--

INSERT INTO `location_categories` (`location_category_id`, `location_category_name`) VALUES
(1, 'SPBE'),
(2, 'Pangkalan'),
(3, 'Kantor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_action_types`
--

CREATE TABLE IF NOT EXISTS `log_action_types` (
  `log_action_type_id` int(11) DEFAULT NULL,
  `log_action_type_name` varchar(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_data`
--

CREATE TABLE IF NOT EXISTS `log_data` (
`log_data_id` int(11) NOT NULL,
  `log_data_time` datetime DEFAULT NULL,
  `log_data_module_id` int(11) DEFAULT NULL,
  `log_data_ip` varchar(254) DEFAULT NULL,
  `log_data_user_id` int(11) DEFAULT NULL,
  `log_data_type` smallint(6) DEFAULT NULL,
  `log_data_data_id` int(11) DEFAULT NULL,
  `log_data_remark` varchar(100) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_data`
--

INSERT INTO `log_data` (`log_data_id`, `log_data_time`, `log_data_module_id`, `log_data_ip`, `log_data_user_id`, `log_data_type`, `log_data_data_id`, `log_data_remark`) VALUES
(1, '2014-11-03 12:11:01', 4, '::1', 1, 0, 3, 'Kategori Produk [spareparts]'),
(2, '2014-11-04 14:11:21', 4, '::1', 1, 2, 3, 'Produk Kategori'),
(3, '2014-11-10 11:11:00', 5, '::1', 1, 0, 1, 'produk [bemper]'),
(4, '2014-11-10 11:11:57', 5, '::1', 1, 1, 1, 'produk[bemper]'),
(5, '2014-11-12 10:11:53', 4, '::1', 1, 0, 1, 'Kategori Produk [cat]'),
(6, '2014-11-12 10:11:44', 5, '::1', 1, 0, 1, 'produk [bemper depan]'),
(7, '2014-11-12 10:11:02', 5, '::1', 1, 1, 1, 'produk[bemper belakang]'),
(8, '2014-11-12 11:11:30', 4, '::1', 1, 2, 1, 'Produk Kategori'),
(9, '2014-11-12 11:11:52', 4, '::1', 1, 1, 1, 'Produk Kategori'),
(10, '2014-11-12 12:11:00', 4, '::1', 1, 0, 2, 'Kategori Produk [jasa]'),
(11, '2014-11-12 12:11:10', 5, '::1', 1, 0, 2, 'produk [all body ringgan]'),
(12, '2014-11-14 13:11:33', 5, '::1', 1, 0, 3, 'produk [bemper]'),
(13, '2014-11-14 13:11:05', 5, '::1', 1, 0, 4, 'produk [1]'),
(14, '2014-11-14 13:11:04', 5, '::1', 1, 0, 1, 'produk [bemper]'),
(15, '2014-11-14 13:11:42', 5, '::1', 1, 0, 2, 'produk [bemper depan]'),
(16, '2014-11-24 02:11:36', 5, '::1', 1, 0, 1, 'produk [High Beam]'),
(17, '2014-11-24 03:11:30', 5, '::1', 1, 0, 2, 'produk [High beam]'),
(18, '2014-11-24 11:11:13', 5, '::1', 1, 0, 3, 'produk [Low Beam]'),
(19, '2014-11-24 12:11:21', 5, '::1', 1, 0, 4, 'produk [Bemper Depan]'),
(20, '2014-12-04 00:12:56', 5, '127.0.0.1', 1, 1, 4, 'produk[Bemper Depan]'),
(21, '2014-12-04 00:12:38', 5, '127.0.0.1', 1, 1, 3, 'produk[Low Beam]'),
(22, '2014-12-17 11:12:16', 4, '127.0.0.1', 1, 1, 1, 'Kategori Produk [sperpart]'),
(23, '2014-12-17 11:12:36', 5, '127.0.0.1', 1, 0, 5, 'produk [AC dalam]'),
(24, '2014-12-18 14:12:12', 23, '127.0.0.1', 1, 0, 20, 'Pegawai [paijo]'),
(25, '2014-12-18 14:12:12', 23, '127.0.0.1', 1, 0, 21, 'Pegawai [supali]'),
(26, '2014-12-26 18:12:28', 5, '127.0.0.1', 1, 0, 6, 'produk [1]'),
(27, '2015-01-05 15:01:38', 25, '127.0.0.1', 1, 0, 3, 'produk[P00001]'),
(28, '2015-01-05 15:01:47', 25, '127.0.0.1', 1, 0, 4, 'produk[P00001]'),
(29, '2015-01-05 15:01:21', 25, '127.0.0.1', 1, 2, 4, 'Produk'),
(30, '2015-01-05 15:01:32', 25, '127.0.0.1', 1, 1, 3, 'produk[P00001]'),
(31, '2015-01-05 15:01:50', 25, '127.0.0.1', 1, 0, 5, 'produk[P00002]'),
(32, '2015-01-05 15:01:59', 25, '127.0.0.1', 1, 2, 5, 'Produk'),
(33, '2015-01-05 15:01:03', 25, '127.0.0.1', 1, 2, 3, 'Produk'),
(34, '2015-01-16 15:01:51', 4, '::1', 1, 0, 3, 'Kategori Produk [Cat]'),
(35, '2015-01-16 16:01:47', 4, '::1', 1, 0, 4, 'Kategori Produk [Bahan]'),
(36, '2015-01-16 16:01:16', 4, '::1', 1, 1, 3, 'Kategori Produk [Cat]'),
(37, '2015-01-16 16:01:25', 4, '::1', 1, 0, 5, 'Kategori Produk [dddd]'),
(38, '2015-01-16 16:01:02', 4, '::1', 1, 1, 1, 'Kategori Produk [sperpart]'),
(39, '2015-01-16 16:01:07', 4, '::1', 1, 1, 2, 'Kategori Produk [jasa]'),
(40, '2015-01-16 16:01:13', 4, '::1', 1, 1, 3, 'Kategori Produk [Cat]'),
(41, '2015-01-16 16:01:30', 5, '::1', 1, 0, 7, 'produk [Bemper belakang]'),
(42, '2015-01-16 16:01:13', 5, '::1', 1, 0, 8, 'produk [Lampu Belakang]'),
(43, '2015-01-17 00:01:40', 5, '::1', 1, 0, 9, 'produk [Spion]'),
(44, '2015-01-22 05:01:16', 5, '::1', 1, 0, 10, 'produk [Pintu Depan]'),
(45, '2015-01-22 05:01:53', 25, '::1', 1, 1, 8, 'produk[]'),
(46, '2015-01-22 05:01:03', 25, '::1', 1, 1, 8, 'produk[]'),
(47, '2015-01-22 05:01:20', 25, '::1', 1, 1, 8, ''),
(48, '2015-01-22 05:01:33', 25, '::1', 1, 1, 9, ''),
(49, '2015-02-03 12:02:07', 5, '::1', 1, 0, 12, 'produk [Atap]'),
(50, '2015-02-03 12:02:25', 5, '::1', 1, 2, 12, 'Produk'),
(51, '2015-02-03 12:02:02', 5, '::1', 1, 1, 12, 'Produk'),
(52, '2015-02-03 12:02:07', 5, '::1', 1, 2, 12, 'Produk'),
(53, '2015-02-03 12:02:14', 5, '::1', 1, 1, 12, 'Produk'),
(54, '2015-02-13 15:02:24', 5, '::1', 1, 0, 13, 'produk [Bumper belakang]'),
(55, '2015-02-13 15:02:44', 5, '::1', 1, 0, 14, 'produk [Bumper Depan]'),
(56, '2015-02-13 15:02:07', 5, '::1', 1, 0, 15, 'produk [Pintu Bagasi]'),
(57, '2015-02-13 15:02:29', 5, '::1', 1, 0, 16, 'produk [Pintu Tengah/Belakang Kiri]'),
(58, '2015-03-03 11:03:19', 19, '::1', 1, 0, 0, 'Group'),
(59, '2015-03-04 13:03:43', 5, '::1', 1, 0, 17, 'produk [Bumper Depan]'),
(60, '2015-03-27 13:03:36', 5, '36.73.246.31', 1, 0, 18, 'produk [Fender Depan]'),
(61, '2015-05-18 06:05:19', 23, '::1', 1, 0, 25, 'Pegawai [A]'),
(62, '2015-05-18 06:05:30', 23, '::1', 1, 1, 25, 'Pegawai[A11]'),
(63, '2015-05-18 06:05:33', 23, '::1', 1, 2, 25, 'Pegawai'),
(64, '2015-05-18 18:05:00', 23, '::1', 1, 0, 26, 'Pegawai [1]'),
(65, '2015-05-18 18:05:05', 23, '::1', 1, 2, 26, 'Pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_sys`
--

CREATE TABLE IF NOT EXISTS `log_sys` (
  `log_sys_time` datetime DEFAULT NULL,
  `log_sys_type` int(11) DEFAULT NULL,
  `log_sys_ip` varchar(254) DEFAULT NULL,
  `log_sys_user_id` int(11) DEFAULT NULL,
  `log_sys_action` varchar(50) DEFAULT NULL,
  `log_sys_uri` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_sys`
--

INSERT INTO `log_sys` (`log_sys_time`, `log_sys_type`, `log_sys_ip`, `log_sys_user_id`, `log_sys_action`, `log_sys_uri`) VALUES
('2014-10-27 14:10:38', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-10-27 15:10:44', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-10-27 15:10:27', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-10-28 12:10:55', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-10-28 12:10:08', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-10-28 12:10:33', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-10-28 12:10:42', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-03 11:11:05', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-03 11:11:26', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-03 11:11:31', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-03 11:11:15', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-03 11:11:20', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-03 12:11:33', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-03 12:11:38', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-03 12:11:44', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-10 10:11:55', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-10 11:11:28', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-10 11:11:39', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-11 23:11:41', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-11 23:11:05', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-11 23:11:36', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-11 23:11:59', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-12 00:11:21', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-12 01:11:02', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-12 02:11:20', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-12 02:11:21', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2014-11-12 02:11:27', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-12 02:11:44', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-12 02:11:45', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2014-11-12 02:11:50', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-12 11:11:47', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-12 11:11:21', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-12 11:11:43', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-12 12:11:22', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-12 12:11:24', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2014-11-12 12:11:29', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-13 12:11:29', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-13 12:11:35', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-13 12:11:59', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-13 12:11:59', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-13 13:11:19', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-13 14:11:46', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-23 00:11:49', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-23 20:11:44', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-23 20:11:42', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-23 20:11:49', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-23 20:11:14', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-23 23:11:16', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-24 10:11:04', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-24 10:11:09', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-24 10:11:35', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-24 10:11:41', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-24 10:11:44', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-24 10:11:49', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-24 10:11:08', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-24 10:11:13', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-24 10:11:13', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-24 10:11:18', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-25 14:11:42', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-28 02:11:41', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-28 03:11:35', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-28 03:11:37', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-28 03:11:47', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-28 09:11:11', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-28 09:11:17', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2014-11-28 11:11:19', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-11-28 12:11:36', 0, '127.0.0.1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-28 12:11:50', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-11-28 12:11:44', 0, '192.168.1.109', 1, 'LOGIN', 'login/submit'),
('2014-11-28 13:11:07', 0, '127.0.0.1', 1, 'LOGOUT', 'login/logout/1'),
('2014-11-28 13:11:44', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-01 16:12:45', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-02 10:12:13', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-02 16:12:53', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-16 12:12:06', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-17 13:12:45', 0, '127.0.0.1', 1, 'LOGOUT', 'login/logout/1'),
('2014-12-17 13:12:00', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-17 13:12:02', 0, '127.0.0.1', 1, 'LOGOUT', 'login/logout/1'),
('2014-12-17 13:12:07', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-17 13:12:49', 0, '127.0.0.1', 1, 'LOGOUT', 'login/logout/1'),
('2014-12-17 13:12:07', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-17 13:12:21', 0, '127.0.0.1', 1, 'LOGOUT', 'login/logout/1'),
('2014-12-17 13:12:30', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-17 13:12:04', 0, '127.0.0.1', 1, 'LOGOUT', 'login/logout/1'),
('2014-12-17 13:12:13', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-17 13:12:57', 0, '127.0.0.1', 1, 'LOGOUT', 'login/logout/1'),
('2014-12-17 13:12:04', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-19 03:12:30', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-19 10:12:37', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-19 16:12:13', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-19 16:12:50', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-21 12:12:02', 0, '127.0.0.1', 1, 'LOGOUT', 'login/logout/1'),
('2014-12-21 12:12:20', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-21 15:12:07', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-21 16:12:38', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-22 10:12:38', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-23 16:12:30', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-23 17:12:57', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-23 17:12:33', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-26 10:12:21', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-26 10:12:44', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-26 10:12:51', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-26 10:12:20', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-26 13:12:55', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-26 14:12:28', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-26 14:12:55', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-26 17:12:42', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-26 17:12:49', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-26 18:12:43', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-26 21:12:38', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-27 11:12:57', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-27 11:12:48', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-27 11:12:39', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-27 12:12:04', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-29 10:12:08', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-29 12:12:41', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2014-12-30 10:12:35', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2015-01-05 15:01:03', 0, '127.0.0.1', 1, 'LOGOUT', 'login/logout/1'),
('2015-01-05 15:01:11', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2015-01-15 12:01:21', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-15 12:01:30', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-21 22:01:11', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-22 05:01:52', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-01-22 05:01:59', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-22 05:01:16', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-01-22 05:01:22', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-22 05:01:18', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-01-22 05:01:27', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-22 16:01:07', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-22 16:01:20', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-23 12:01:53', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-23 12:01:59', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-23 12:01:58', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-26 12:01:02', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-27 11:01:08', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-29 11:01:59', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-01-29 12:01:51', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-01-29 12:01:52', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-01-29 12:01:59', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-02 11:02:37', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-03 12:02:04', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-03 12:02:20', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-02-03 12:02:23', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-03 12:02:35', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-02-03 12:02:41', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-03 13:02:33', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-02-03 13:02:39', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-03 15:02:02', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-04 11:02:02', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-04 13:02:34', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-04 14:02:29', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-04 16:02:51', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-04 16:02:51', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-04 16:02:34', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-06 14:02:50', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-06 17:02:21', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-07 00:02:47', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-09 00:02:06', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-02-09 00:02:12', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-09 00:02:44', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-02-09 00:02:49', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-09 01:02:38', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-09 14:02:28', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-02-09 14:02:35', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-09 14:02:24', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-12 08:02:35', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-13 15:02:23', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-17 13:02:22', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-24 15:02:41', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-24 16:02:31', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-26 07:02:41', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-26 08:02:48', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-02-27 12:02:37', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-03-02 11:03:35', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-03-03 11:03:13', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-03-24 12:03:19', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-03-24 14:03:40', 0, '36.73.237.129', 1, 'LOGIN', 'login/submit'),
('2015-03-25 15:03:40', 0, '36.74.22.240', 1, 'LOGIN', 'login/submit'),
('2015-03-25 15:03:45', 0, '36.74.22.240', 1, 'LOGIN', 'login/submit'),
('2015-03-25 15:03:54', 0, '36.74.22.240', 1, 'LOGIN', 'login/submit'),
('2015-03-27 13:03:05', 0, '36.73.246.31', 1, 'LOGIN', 'login/submit'),
('2015-03-27 13:03:23', 0, '36.73.246.31', 1, 'LOGIN', 'login/submit'),
('2015-03-27 14:03:54', 0, '36.73.246.31', 1, 'LOGIN', 'login/submit'),
('2015-03-27 14:03:12', 0, '36.73.246.31', 1, 'LOGOUT', 'login/logout/1'),
('2015-03-31 17:03:44', 0, '139.228.89.15', 1, 'LOGIN', 'login/submit'),
('2015-04-06 16:04:45', 0, '139.228.89.15', 1, 'LOGIN', 'login/submit'),
('2015-04-08 15:04:56', 0, '36.81.98.112', 1, 'LOGIN', 'login/submit'),
('2015-04-08 15:04:24', 0, '36.81.98.112', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-13 13:04:19', 0, '125.164.131.69', 1, 'LOGIN', 'login/submit'),
('2015-04-13 14:04:17', 0, '125.164.131.69', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-21 15:04:52', 0, '139.195.121.5', 1, 'LOGIN', 'login/submit'),
('2015-04-21 15:04:37', 0, '139.195.121.5', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-21 16:04:21', 0, '36.81.179.25', 1, 'LOGIN', 'login/submit'),
('2015-04-28 08:04:15', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-28 09:04:47', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-28 09:04:53', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-28 10:04:05', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-28 11:04:50', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-28 12:04:37', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-28 13:04:14', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-28 13:04:24', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-28 18:04:26', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 06:04:42', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 09:04:40', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 09:04:31', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 10:04:37', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-29 10:04:42', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 16:04:10', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 18:04:06', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 18:04:01', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 18:04:36', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 18:04:06', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 18:04:36', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 18:04:30', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-04-29 18:04:31', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-04-29 18:04:35', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 18:04:39', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 19:04:09', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 19:04:19', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-29 21:04:50', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-30 05:04:52', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-30 05:04:01', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-30 05:04:05', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-30 05:04:40', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-30 05:04:45', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-30 05:04:58', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-30 05:04:02', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-30 05:04:22', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-30 05:04:27', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-30 05:04:19', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-30 06:04:29', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-30 06:04:25', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-30 09:04:33', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-04-30 09:04:38', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-30 09:04:02', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-30 09:04:07', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-04-30 09:04:49', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-04-30 09:04:53', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-04 05:05:24', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-04 06:05:51', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-04 06:05:31', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-04 06:05:14', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-04 06:05:18', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-04 07:05:49', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-04 10:05:48', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-04 10:05:53', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-04 10:05:38', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-04 10:05:27', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-04 11:05:58', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-04 11:05:59', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-05 07:05:51', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 05:05:41', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 05:05:13', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 06:05:42', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 09:05:52', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 10:05:14', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 10:05:25', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 10:05:09', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 10:05:56', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 10:05:27', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 18:05:12', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 18:05:15', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-06 21:05:33', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-07 05:05:28', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-07 10:05:27', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-07 10:05:39', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-08 10:05:01', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-08 11:05:00', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-08 11:05:04', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-08 11:05:50', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-11 12:05:31', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-12 15:05:17', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-12 15:05:26', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-12 15:05:34', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-12 15:05:40', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-12 15:05:17', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-05-12 15:05:27', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-12 15:05:05', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-12 15:05:22', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-13 12:05:51', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-13 12:05:00', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-13 13:05:15', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-13 13:05:18', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-13 15:05:02', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-13 15:05:09', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-13 12:05:24', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-05-13 12:05:30', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-13 13:05:00', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-13 13:05:24', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-13 13:05:59', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-18 06:05:39', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-18 07:05:01', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-05-18 07:05:02', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-05-18 07:05:07', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-18 07:05:39', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-05-18 07:05:42', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-18 07:05:19', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-05-18 07:05:23', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-18 08:05:22', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-05-18 08:05:28', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-18 10:05:19', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-18 18:05:55', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-19 06:05:55', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-19 08:05:58', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-19 08:05:06', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-19 09:05:41', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-19 09:05:07', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-20 06:05:40', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-20 08:05:03', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-20 08:05:19', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-20 08:05:31', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-20 09:05:05', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-20 12:05:56', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-20 12:05:53', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-20 12:05:43', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-21 06:05:22', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-21 07:05:23', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-21 08:05:30', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-05-21 08:05:34', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-21 12:05:11', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-22 06:05:13', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-22 06:05:06', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-25 06:05:03', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-25 08:05:07', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-25 08:05:08', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-05-25 08:05:11', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-25 09:05:23', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-25 10:05:24', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-25 10:05:50', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-25 10:05:55', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-25 11:05:19', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-25 12:05:53', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-26 05:05:25', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-26 10:05:54', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-26 11:05:03', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-26 11:05:02', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-05-26 11:05:36', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-26 12:05:06', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-26 20:05:54', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-27 05:05:43', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-27 07:05:22', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-27 13:05:35', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-28 06:05:49', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-28 07:05:02', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-28 07:05:03', 0, '::1', 0, 'LOGOUT', 'login/logout/1'),
('2015-05-28 07:05:06', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-28 07:05:15', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-28 07:05:19', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-28 09:05:16', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-28 09:05:35', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-28 09:05:28', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-28 10:05:30', 0, '127.0.0.1', 1, 'LOGIN', 'login/submit'),
('2015-05-28 18:05:06', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-28 20:05:21', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-28 20:05:26', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-28 20:05:10', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-28 20:05:15', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-28 20:05:50', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-28 20:05:55', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-29 05:05:22', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-29 05:05:40', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-29 05:05:44', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-29 05:05:00', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-29 10:05:56', 0, '::1', 1, 'LOGIN', 'login/submit'),
('2015-05-29 10:05:36', 0, '::1', 1, 'LOGOUT', 'login/logout/1'),
('2015-05-29 10:05:40', 0, '::1', 1, 'LOGIN', 'login/submit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `markets`
--

CREATE TABLE IF NOT EXISTS `markets` (
  `market_id` int(11) NOT NULL,
  `market_code` varchar(100) NOT NULL,
  `market_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `markets`
--

INSERT INTO `markets` (`market_id`, `market_code`, `market_name`) VALUES
(1, 'S0000001', 'Sidosermo'),
(3, 'S0000002', 'Kedungturi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
`module_id` int(11) NOT NULL,
  `module_code` varchar(50) DEFAULT NULL,
  `module_name` varchar(40) DEFAULT NULL,
  `module_approval_url` varchar(50) DEFAULT NULL,
  `module_group` varchar(50) DEFAULT NULL,
  `module_view_url` varchar(50) DEFAULT NULL,
  `module_cancel_url` varchar(50) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `modules`
--

INSERT INTO `modules` (`module_id`, `module_code`, `module_name`, `module_approval_url`, `module_group`, `module_view_url`, `module_cancel_url`) VALUES
(11, 'transaction.po_process', 'PO process ', '', 'transaction.po_process', NULL, NULL),
(10, 'transaction.po_retur', 'PO retur ', '', 'transaction.po_retur', NULL, NULL),
(9, 'transaction.po_reservation', 'PO reservation ', '', 'transaction.po_reservation', NULL, NULL),
(8, 'transaction.po_received', 'PO received ', '', 'transaction.po_received', NULL, NULL),
(7, 'master.uom', 'uom', '', 'master.uom', NULL, NULL),
(6, 'master.site', 'Site', '', 'master.site', NULL, NULL),
(5, 'master.product', 'Material list', '', 'master.product', NULL, NULL),
(4, 'master.product_category', 'Material type', '', 'master.product_category', NULL, NULL),
(3, 'master.project_name', 'Project name', '', 'master.project_name', NULL, NULL),
(1, 'master.dashboard', 'dashboard', '', 'master.dashboard', NULL, NULL),
(2, 'master.phase', 'phase', '', 'master.phase', NULL, NULL),
(12, 'report.project_report', 'Project report ', '', 'report.project_report', NULL, NULL),
(13, 'report.po_received_summary_report', 'PO Received Summary Report ', '', 'report.po_received_summary_report', NULL, NULL),
(14, 'report.po_received_report', 'PO Received Report ', '', 'report.po_received_report', NULL, NULL),
(15, 'report.po_reservation_summary_report', 'PO Reservation Summary Report ', '', 'report.po_reservation_summary_report', NULL, NULL),
(16, 'report.po_reservation_report', 'PO Reservation Report ', '', 'report.po_reservation_report', NULL, NULL),
(17, 'report.phase_report', 'PO Phase Report ', '', 'report.phase_report', NULL, NULL),
(18, 'report.material_report', 'Material Report ', '', 'report.material_report', NULL, NULL),
(19, 'tool.user', 'User', '', 'tool.user', NULL, NULL),
(20, 'tool.permit', 'Permission', '', 'tool.permit', NULL, NULL),
(21, 'tool.user_aproved', 'User aproved', '', 'tool.user_aproved', NULL, NULL),
(22, 'report.site_report', 'Site Report', NULL, 'report.site_report', NULL, NULL),
(23, 'master.employee', 'Employee', NULL, 'master.employee', NULL, NULL),
(24, 'master.employee_position', 'Posisi Pegawai', NULL, 'master.employee_position', NULL, NULL),
(25, 'master.stock_product', 'Stok Produk', NULL, 'master.stock_product', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `periods`
--

CREATE TABLE IF NOT EXISTS `periods` (
`period_id` int(11) NOT NULL,
  `period_code` varchar(100) NOT NULL,
  `period_name` varchar(100) NOT NULL,
  `period_month` varchar(2) NOT NULL,
  `period_year` varchar(4) NOT NULL,
  `period_closed` int(11) NOT NULL,
  `period_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `periods`
--

INSERT INTO `periods` (`period_id`, `period_code`, `period_name`, `period_month`, `period_year`, `period_closed`, `period_description`) VALUES
(1, 'PR0000001', '1/2015', '1', '2015', 0, '     '),
(2, 'PR0000002', '2/2015', '2', '2015', 0, ''),
(3, 'PR0000003', '3/2015', '3', '2015', 0, ''),
(4, 'PR0000004', '4/2015', '4', '2015', 1, ''),
(5, 'PR0000005', '5/2015', '5', '2015', 0, ''),
(6, 'PR0000006', '6/2015', '6', '2015', 0, ''),
(7, 'PR0000007', '7/2015', '7', '2015', 0, ''),
(8, 'PR0000008', '8/2015', '8', '2015', 0, ''),
(9, 'PR0000009', '9/2015', '9', '2015', 0, ''),
(10, 'PR0000010', '10/2015', '10', '2015', 0, ''),
(11, 'PR0000011', '11/2015', '11', '2015', 0, ''),
(12, 'PR0000012', '12/2015', '12', '2015', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permits`
--

CREATE TABLE IF NOT EXISTS `permits` (
  `permit_group_id` int(11) DEFAULT NULL,
  `permit_module_id` int(11) DEFAULT NULL,
  `permit_crud_mode` varchar(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `permits`
--

INSERT INTO `permits` (`permit_group_id`, `permit_module_id`, `permit_crud_mode`) VALUES
(2, 7, 'crud'),
(2, 6, 'crud'),
(2, 5, 'crud'),
(2, 4, 'crud'),
(2, 3, 'crud'),
(2, 1, 'crud'),
(2, 2, 'crud'),
(2, 12, 'crud'),
(2, 21, 'crud'),
(4, 16, 'crud'),
(3, 18, 'crud'),
(3, 17, 'crud'),
(3, 16, 'crud'),
(3, 14, 'crud'),
(3, 12, 'crud'),
(3, 2, 'crud'),
(3, 1, 'crud'),
(3, 3, 'crud'),
(3, 4, 'crud'),
(3, 5, 'crud'),
(3, 6, 'crud'),
(3, 7, 'crud'),
(3, 8, 'crud'),
(3, 9, 'crud'),
(3, 10, 'crud'),
(3, 11, 'crud'),
(4, 14, 'crud'),
(4, 13, 'crud'),
(4, 12, 'crud'),
(4, 2, 'crud'),
(4, 1, 'crud'),
(4, 3, 'crud'),
(4, 4, 'crud'),
(4, 5, 'crud'),
(4, 6, 'crud'),
(4, 7, 'crud'),
(4, 8, 'crud'),
(4, 9, 'crud'),
(4, 10, 'crud'),
(4, 11, 'crud');

-- --------------------------------------------------------

--
-- Struktur dari tabel `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
`route_id` int(11) NOT NULL,
  `location_from_id` int(11) NOT NULL,
  `location_to_id` int(11) NOT NULL,
  `location_total_cost` int(11) NOT NULL,
  `location_desc` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `routes`
--

INSERT INTO `routes` (`route_id`, `location_from_id`, `location_to_id`, `location_total_cost`, `location_desc`) VALUES
(1, 1, 3, 0, ''),
(2, 1, 4, 0, ''),
(3, 1, 7, 0, ''),
(4, 1, 8, 0, ''),
(5, 1, 9, 0, ''),
(6, 1, 10, 0, ''),
(7, 1, 11, 0, ''),
(8, 1, 12, 0, ''),
(9, 1, 13, 0, ''),
(10, 2, 3, 0, ''),
(11, 2, 4, 0, ''),
(12, 2, 7, 0, ''),
(13, 2, 8, 0, ''),
(14, 2, 9, 0, ''),
(15, 2, 10, 0, ''),
(16, 2, 11, 0, ''),
(17, 2, 12, 0, ''),
(18, 2, 13, 0, ''),
(19, 3, 4, 0, ''),
(20, 3, 7, 0, ''),
(21, 3, 8, 0, ''),
(22, 3, 9, 0, ''),
(23, 3, 10, 0, ''),
(24, 3, 11, 0, ''),
(25, 3, 12, 0, ''),
(26, 3, 13, 0, ''),
(27, 4, 3, 0, ''),
(28, 4, 7, 0, ''),
(29, 4, 8, 0, ''),
(30, 4, 9, 0, ''),
(31, 4, 10, 0, ''),
(32, 4, 11, 0, ''),
(33, 4, 12, 0, ''),
(34, 4, 13, 0, ''),
(35, 7, 3, 0, ''),
(36, 7, 4, 0, ''),
(37, 7, 8, 0, ''),
(38, 7, 9, 0, ''),
(39, 7, 10, 0, ''),
(40, 7, 11, 0, ''),
(41, 7, 12, 0, ''),
(42, 7, 13, 0, ''),
(43, 8, 3, 0, ''),
(44, 8, 4, 0, ''),
(45, 8, 7, 0, ''),
(46, 8, 9, 0, ''),
(47, 8, 10, 0, ''),
(48, 8, 11, 0, ''),
(49, 8, 12, 0, ''),
(50, 8, 13, 0, ''),
(51, 9, 3, 0, ''),
(52, 9, 4, 0, ''),
(53, 9, 7, 0, ''),
(54, 9, 8, 0, ''),
(55, 9, 10, 0, ''),
(56, 9, 11, 0, ''),
(57, 9, 12, 0, ''),
(58, 9, 13, 0, ''),
(59, 10, 3, 0, ''),
(60, 10, 4, 0, ''),
(61, 10, 7, 0, ''),
(62, 10, 8, 0, ''),
(63, 10, 9, 0, ''),
(64, 10, 11, 0, ''),
(65, 10, 12, 0, ''),
(66, 10, 13, 0, ''),
(67, 11, 3, 0, ''),
(68, 11, 4, 0, ''),
(69, 11, 7, 0, ''),
(70, 11, 8, 0, ''),
(71, 11, 9, 0, ''),
(72, 11, 10, 0, ''),
(73, 11, 12, 0, ''),
(74, 11, 13, 0, ''),
(75, 12, 3, 0, ''),
(76, 12, 4, 0, ''),
(77, 12, 7, 0, ''),
(78, 12, 8, 0, ''),
(79, 12, 9, 0, ''),
(80, 12, 10, 0, ''),
(81, 12, 11, 0, ''),
(82, 12, 13, 0, ''),
(83, 13, 1, 0, ''),
(84, 13, 2, 0, ''),
(85, 13, 3, 0, ''),
(86, 13, 4, 0, ''),
(87, 13, 7, 0, ''),
(88, 13, 8, 0, ''),
(89, 13, 9, 0, ''),
(90, 13, 10, 0, ''),
(91, 13, 11, 0, ''),
(92, 13, 12, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `route_details`
--

CREATE TABLE IF NOT EXISTS `route_details` (
`route_detail_id` int(11) NOT NULL,
  `route_detail_name` varchar(100) NOT NULL,
  `route_detail_cost` int(11) NOT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) DEFAULT NULL,
  `ip_address` varchar(16) DEFAULT NULL,
  `user_agent` varchar(50) DEFAULT NULL,
  `last_activity` int(11) DEFAULT NULL,
  `user_data` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('d42783fb35e3f78b5b5c95638e684b2c', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432891645, 'a:3:{s:5:"redir";a:1:{s:9:"redir_url";s:22:"tr_cost_summary_report";}s:21:"flash:old:dialog_type";s:4:"note";s:21:"flash:old:dialog_data";a:3:{s:5:"title";s:13:"Akses Ditolak";s:7:"message";s:74:"Halaman ini hanya untuk karyawan. Kami akan membawa Anda ke halaman Login.";s:6:"target";s:5:"login";}}'),
('8e4c358a70df5478bdbe85bf2319c28e', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432837395, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432837075;s:7:"menubar";s:4781:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost_type">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kategori Biaya</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/realization_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan pembelian  harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_shipment_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan penjualan  harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_income_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan pendapatan harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost_detail_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan biaya harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost_summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan biaya summary</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('223b9a00d20405c7f05b8fb5f5da10f9', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432870325, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432869404;s:7:"menubar";s:4781:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Harga</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost_type">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kategori Biaya</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/realization_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan pembelian  harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_shipment_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan penjualan  harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_income_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan pendapatan harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost_detail_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan biaya harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost_summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan biaya summary</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('1cd0616e75148bcd63735d755094182e', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432799190, 'a:5:{s:5:"redir";a:1:{s:9:"redir_url";s:18:"tr_shipment_report";}s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432799068;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('b94b5df5bdeebd2f4a1c37b4e5692b31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432803725, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432801050;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('1084ce0827c79b518f90edba6c5663c5', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432634193, 'a:5:{s:5:"redir";a:1:{s:9:"redir_url";s:7:"tr_plan";}s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432634223;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('8f8b421fdf40d4204b029af73973f084', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432880342, 'a:5:{s:5:"redir";a:1:{s:9:"redir_url";s:7:"tr_plan";}s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432870440;s:7:"menubar";s:4781:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Harga</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost_type">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kategori Biaya</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/realization_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan pembelian  harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_shipment_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan penjualan  harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_income_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan pendapatan harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost_detail_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan biaya harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost_summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan biaya summary</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('93b8746b63a3b42cba7752e6a6007db8', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432634506, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432634316;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('74184c64f19de403b66d512c33e7c7e1', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432658892, 'a:5:{s:5:"redir";a:1:{s:9:"redir_url";s:7:"tr_plan";}s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432635486;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('86b71e19f08e7bedcf0ce6e3e2a04400', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432666986, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432664994;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}');
INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('e170fa3a31ba1de596882e79cc9387fb', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432702765, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432698523;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('4860f3bd21d94baf19293ea7f5be457f', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432711440, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432703002;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('18f8ba0bbdefe1f4ab8a4be630adcef0', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432724615, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432724615;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('5fff5a02292533a15454d17c9518898d', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432797344, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432789699;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('535bad50ad69fcc4bd5ea1f3f3d3d783', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432798496, 'a:5:{s:5:"redir";a:1:{s:9:"redir_url";s:18:"tr_shipment_report";}s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432797736;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('2322f100258e8cdbfcaf309696b27d28', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432798980, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432798655;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('650ef280517ede99707e4c54fc79858c', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432628456, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432611745;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('9f3fb886dc62f074373dde132df3a971', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432797830, 'a:3:{s:5:"redir";a:1:{s:9:"redir_url";s:20:"tr_plan/form_plan/75";}s:21:"flash:old:dialog_type";s:4:"note";s:21:"flash:old:dialog_data";a:3:{s:5:"title";s:13:"Akses Ditolak";s:7:"message";s:74:"Halaman ini hanya untuk karyawan. Kami akan membawa Anda ke halaman Login.";s:6:"target";s:5:"login";}}'),
('e87f45ca2048521d6c602ad0472a1927', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432891923, 'a:4:{s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432888480;s:7:"menubar";s:4960:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Harga</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost_type">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kategori Biaya</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/realization_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan pembelian  harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_shipment_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan penjualan  harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_income_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan pendapatan harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_income_detail_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan pendapatan summary</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost_detail_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan biaya harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_cost_summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>laporan biaya summary</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}'),
('3c15aa15c3caf260bc27ed0f1f1b429a', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/201001', 1432634058, 'a:5:{s:5:"redir";a:1:{s:9:"redir_url";s:6:"Ransom";}s:6:"logged";i:1;s:9:"user_info";a:19:{s:7:"user_id";s:1:"1";s:10:"user_login";s:5:"admin";s:9:"user_name";s:13:"Administrator";s:10:"user_email";s:0:"";s:10:"user_phone";s:0:"";s:9:"job_title";s:0:"";s:7:"company";s:0:"";s:13:"user_password";s:32:"cdaeb1282d614772beb1e74c192bebda";s:13:"user_group_id";s:1:"1";s:15:"user_last_login";N;s:15:"user_registered";N;s:14:"user_is_active";s:1:"1";s:11:"employee_id";s:1:"1";s:13:"user_is_login";s:1:"1";s:12:"expired_date";s:10:"0000-00-00";s:12:"employee_pic";s:8:"apan.jpg";s:13:"employee_name";s:13:"Administrator";s:12:"employee_nip";N;s:10:"group_name";s:13:"Administrator";}s:10:"login_time";i:1432628754;s:7:"menubar";s:4090:"<ul class="sidebar-menu"><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-edit"></i>\r\n					<span>Master List</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/truck">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Truk</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/supplier">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>SPBE</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/customer">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pangkalan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/route">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Rute</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/cost">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Biaya</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pegawai</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/employee_position">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Posisi Pegawai</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-shopping-cart"></i>\r\n					<span>transaksi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/Ransom">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Tebusan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_plan">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_ralization">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_realization_shipment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Realisasi Kirim</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/tr_payment">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Pembayaran</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/1">\r\n					<i class="fa fa-print"></i>\r\n					<span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/summary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Harian</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/po_received_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Laporan Plan</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/salary_report">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Gaji</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Akuntansi</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/periode">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Periode</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/coa">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Kode Akun</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/gl">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Jurnal Umum</span></a>\r\n					</li>\n</li>\n</ul><li  class="treeview">\r\n					<a href="http://localhost/lpg/#">\r\n					<i class="fa fa-asterisk"></i>\r\n					<span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>\r\n					<ul class="treeview-menu"><li >\r\n					<a href="http://localhost/lpg/user">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>User</span></a>\r\n					</li>\n<li >\r\n					<a href="http://localhost/lpg/permit">\r\n					<i class="fa fa-chevron-circle-right"></i>\r\n					<span>Permission</span></a>\r\n					</li>\n</li>\n</ul></ul>";}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `side_menus`
--

CREATE TABLE IF NOT EXISTS `side_menus` (
`menu_id` int(11) NOT NULL,
  `menu_parent` int(11) DEFAULT NULL,
  `menu_name` varchar(50) DEFAULT NULL,
  `menu_url` varchar(50) DEFAULT NULL,
  `menu_weight` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `menu_level` int(11) DEFAULT NULL,
  `menu_active` varchar(1) DEFAULT NULL,
  `menu_icon` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=110014 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `side_menus`
--

INSERT INTO `side_menus` (`menu_id`, `menu_parent`, `menu_name`, `menu_url`, `menu_weight`, `module_id`, `menu_level`, `menu_active`, `menu_icon`) VALUES
(18002, 18000, 'Permission', 'permit', 0, 20, 2, '1', ''),
(11000, 1, 'Master List', '#', 0, 0, 1, '1', 'fa-edit'),
(10000, 1, 'Dashboard', 'dashboard', 0, 1, 1, '0', 'fa-bar-chart-o'),
(15000, 1, 'Akuntansi', '#', 0, 0, 1, '1', ''),
(14002, 14000, 'laporan penjualan  harian', 'tr_shipment_report', 0, 14, 2, '1', ''),
(13005, 13000, 'Realisasi Kirim', 'tr_realization_shipment', 0, 0, 2, '1', ''),
(11004, 11000, 'Pangkalan', 'customer', 0, 5, 2, '1', ''),
(13000, 1, 'transaksi', '#', 0, 0, 1, '1', 'fa-shopping-cart'),
(13003, 13000, 'Plan', 'tr_plan', 0, 9, 2, '1', ''),
(13006, 13000, 'Pembayaran', 'tr_payment', 0, 0, 2, '1', ''),
(18000, 1, 'User Management', '#', 0, 0, 1, '1', 'fa-asterisk'),
(18001, 18000, 'User', 'user', 0, 19, 2, '1', ''),
(14003, 14000, 'laporan pendapatan harian', 'tr_income_report', 0, 15, 2, '1', ''),
(14001, 14000, 'laporan pembelian  harian', 'realization_report', 0, 13, 2, '1', ''),
(14000, 1, 'Laporan', '1', 0, 0, 1, '1', 'fa-print'),
(11002, 11000, 'Truk', 'truck', 0, 6, 2, '1', ''),
(13004, 13000, 'Realisasi Plan', 'tr_ralization', 0, 0, 2, '1', ''),
(14004, 14000, 'laporan pendapatan summary', 'tr_income_detail_report', 0, 0, 2, '1', ''),
(11006, 11000, 'Rute', 'route', 0, 0, 2, '1', ''),
(11007, 11000, 'Harga', 'cost', 0, 0, 2, '1', ''),
(11008, 11000, 'Pegawai', 'employee', 0, 0, 2, '1', ''),
(11012, 11000, 'Posisi Pegawai', 'employee_position', 0, 24, 2, '1', ''),
(11003, 11000, 'SPBE', 'supplier', 0, 0, 2, '1', ''),
(15001, 15000, 'Periode', 'periode', 0, 0, 2, '1', ''),
(15002, 15000, 'Kode Akun', 'coa', 0, 0, 2, '1', ''),
(15003, 15000, 'Jurnal Umum', 'gl', 0, 0, 2, '1', ''),
(13001, 13000, 'Tebusan', 'Ransom', 0, 0, 2, '1', ''),
(11013, 11000, 'Kategori Biaya', 'cost_type', 0, 0, 2, '1', ''),
(13007, 13000, 'Biaya', 'tr_cost', 0, 0, 2, '1', ''),
(14005, 14000, 'laporan biaya harian', 'tr_cost_detail_report', 0, 0, 2, '1', ''),
(14006, 14000, 'laporan biaya summary', 'tr_cost_summary_report', 0, 0, 2, '1', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stands`
--

CREATE TABLE IF NOT EXISTS `stands` (
`stand_id` int(11) NOT NULL,
  `stand_code` varchar(50) NOT NULL,
  `stand_name` varchar(200) DEFAULT NULL,
  `stand_leader` int(11) DEFAULT NULL COMMENT 'same as employeeid',
  `stand_description` text,
  `stand_pict` text,
  `stand_address` text,
  `stand_phone` varchar(50) DEFAULT NULL,
  `stand_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stands`
--

INSERT INTO `stands` (`stand_id`, `stand_code`, `stand_name`, `stand_leader`, `stand_description`, `stand_pict`, `stand_address`, `stand_phone`, `stand_status`) VALUES
(1, 'S0000001', 'Sidosermo', 1, 'Lokasi kantor pusat', NULL, 'Jl. Sidosermo 2 no. 72, Surabaya, East Java, Indonesia', '0819231323', 1),
(3, 'S0000002', 'Kedungturi', 1, 'Surabaya2', NULL, 'Surabaya2', '032131232', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions_sl`
--

CREATE TABLE IF NOT EXISTS `transactions_sl` (
`transaction_id` int(32) NOT NULL,
  `transaction_date` date NOT NULL DEFAULT '0000-00-00',
  `period_id` int(32) NOT NULL DEFAULT '0',
  `transaction_insert_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transaction_description` text NOT NULL,
  `transaction_type_id` int(32) NOT NULL DEFAULT '0',
  `transaction_code` char(30) NOT NULL,
  `transaction_data_id` int(32) NOT NULL DEFAULT '0',
  `transaction_active_status` tinyint(1) DEFAULT '0',
  `transaction_is_approved` tinyint(1) DEFAULT '0',
  `transaction_correction_id` int(32) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transactions_sl`
--

INSERT INTO `transactions_sl` (`transaction_id`, `transaction_date`, `period_id`, `transaction_insert_timestamp`, `transaction_description`, `transaction_type_id`, `transaction_code`, `transaction_data_id`, `transaction_active_status`, `transaction_is_approved`, `transaction_correction_id`) VALUES
(1, '2015-05-01', 1, '0000-00-00 00:00:00', 'as', 1, '0000002', 0, 0, 0, 0),
(2, '2015-05-07', 1, '2015-05-07 00:59:50', 'sa', 100, '0000003', 0, 0, 0, 0),
(3, '2015-05-07', 1, '2015-05-07 01:00:42', 'sdsdsdsd', 100, '0000003', 0, 0, 0, 0),
(4, '2015-05-02', 1, '2015-05-07 01:16:42', 'coba', 100, '0000003', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_types`
--

CREATE TABLE IF NOT EXISTS `transaction_types` (
`transaction_type_id` int(11) NOT NULL,
  `transaction_type_name` varchar(200) DEFAULT NULL,
  `transaction_type_description` text,
  `module_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaction_types`
--

INSERT INTO `transaction_types` (`transaction_type_id`, `transaction_type_name`, `transaction_type_description`, `module_id`) VALUES
(1, 'Perbaikan Mobil', NULL, 0),
(10, 'Kas Masuk', NULL, 0),
(11, 'Kas Keluar', NULL, 0),
(12, 'Bank Masuk', NULL, 0),
(13, 'Bank Keluar', NULL, 0),
(100, 'Jurnal Umum', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trucks`
--

CREATE TABLE IF NOT EXISTS `trucks` (
`truck_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `co_driver_id` int(11) NOT NULL,
  `truck_nopol` varchar(100) NOT NULL,
  `truck_stnk` varchar(100) NOT NULL,
  `truck_owner` varchar(100) NOT NULL,
  `truck_color` varchar(100) NOT NULL,
  `truck_manufacture_date` int(11) NOT NULL,
  `truck_merk` varchar(100) NOT NULL,
  `truck_type_id` int(11) NOT NULL,
  `truck_cc` varchar(10) NOT NULL,
  `truck_no_rangka` varchar(100) NOT NULL,
  `truck_no_mesin` varchar(100) NOT NULL,
  `truck_no_bpkb` varchar(100) NOT NULL,
  `truck_jatuh_tempo` date NOT NULL,
  `truck_jatuh_tempo_kiur` date NOT NULL,
  `truck_rekom` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trucks`
--

INSERT INTO `trucks` (`truck_id`, `driver_id`, `co_driver_id`, `truck_nopol`, `truck_stnk`, `truck_owner`, `truck_color`, `truck_manufacture_date`, `truck_merk`, `truck_type_id`, `truck_cc`, `truck_no_rangka`, `truck_no_mesin`, `truck_no_bpkb`, `truck_jatuh_tempo`, `truck_jatuh_tempo_kiur`, `truck_rekom`) VALUES
(1, 19, 22, 'L 9722 AG', '2276199/JT/ 1000 1 22022014', 'F. Roesminingsih', 'Merah', 2014, 'Toyota Dyna 110 ET', 2, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00'),
(3, 21, 24, 'L 8337 LF', '0460929/JT 2012 1000 1 10072012', 'F. Roesminingsih', 'Merah', 2009, 'Mitsubhisi DS FE73 4X2 MT', 2, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `truck_types`
--

CREATE TABLE IF NOT EXISTS `truck_types` (
`truck_type_id` int(11) NOT NULL,
  `truck_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `truck_types`
--

INSERT INTO `truck_types` (`truck_type_id`, `truck_type_name`) VALUES
(1, 'Engkel'),
(2, 'Double'),
(3, 'Lain-lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_costs`
--

CREATE TABLE IF NOT EXISTS `tr_costs` (
`tr_cost_id` int(11) NOT NULL,
  `tr_cost_type_id` int(11) NOT NULL,
  `tr_cost_date` date NOT NULL,
  `tr_cost_price` int(11) NOT NULL,
  `tr_cost_desc` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_costs`
--

INSERT INTO `tr_costs` (`tr_cost_id`, `tr_cost_type_id`, `tr_cost_date`, `tr_cost_price`, `tr_cost_desc`) VALUES
(1, 1, '2015-05-30', 10000, 'desc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_cost_types`
--

CREATE TABLE IF NOT EXISTS `tr_cost_types` (
`tr_cost_type_id` int(11) NOT NULL,
  `tr_cost_type_name` varchar(200) NOT NULL,
  `tr_cost_type_desc` text NOT NULL,
  `tr_cost_types_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_cost_types`
--

INSERT INTO `tr_cost_types` (`tr_cost_type_id`, `tr_cost_type_name`, `tr_cost_type_desc`, `tr_cost_types_status`) VALUES
(1, 'Biaya PLN', '', 1),
(999, 'Biaya pengiriman', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_payments`
--

CREATE TABLE IF NOT EXISTS `tr_payments` (
`tr_payment_id` int(11) NOT NULL,
  `tr_plan_detail_shipment_id` int(11) NOT NULL,
  `tr_payment_date` date NOT NULL,
  `tr_payment_pembayaran` double NOT NULL,
  `tr_payment_description` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_payments`
--

INSERT INTO `tr_payments` (`tr_payment_id`, `tr_plan_detail_shipment_id`, `tr_payment_date`, `tr_payment_pembayaran`, `tr_payment_description`) VALUES
(1, 15, '2015-05-27', 10000, 'desc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_plans`
--

CREATE TABLE IF NOT EXISTS `tr_plans` (
`tr_plan_id` int(11) NOT NULL,
  `tr_plan_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_plan_details`
--

CREATE TABLE IF NOT EXISTS `tr_plan_details` (
`tr_plan_detail_id` int(11) NOT NULL,
  `tr_plan_purchase_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `truck_id` int(11) NOT NULL,
  `tr_plan_truck_driver_type` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `co_driver_id` int(11) NOT NULL,
  `tr_plan_detail_code` varchar(25) NOT NULL,
  `tr_plan_detail_qty` int(11) NOT NULL,
  `tr_plan_detail_qty_shipment` int(11) NOT NULL,
  `tr_plan_detail_qty_sisa` int(11) NOT NULL,
  `tr_plan_detail_purchase` int(11) NOT NULL,
  `tr_plan_detail_total_purchase` int(11) NOT NULL,
  `tr_plan_detail_cost_driver` int(11) NOT NULL,
  `tr_plan_detail_cost_co_driver` int(11) NOT NULL,
  `tr_plan_detail_cost_lain` int(11) NOT NULL,
  `tr_plan_detail_date_realization` date NOT NULL,
  `tr_plan_detail_status_realization` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_plan_detail_shipments`
--

CREATE TABLE IF NOT EXISTS `tr_plan_detail_shipments` (
`tr_plan_detail_shipment_id` int(11) NOT NULL,
  `tr_plan_detail_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `tr_plan_detail_shipment_qty` int(11) NOT NULL,
  `tr_plan_detail_shipment_price` int(11) NOT NULL,
  `tr_plan_detail_shipment_total_price` int(11) NOT NULL,
  `tr_plan_detail_shipment_cost` int(11) NOT NULL,
  `tr_plan_detail_shipment_realization_date` date NOT NULL,
  `tr_plan_detail_shipment_total_paid` int(11) NOT NULL,
  `tr_plan_detail_shipment_status_id` int(11) NOT NULL,
  `tr_plan_detail_shipment_status_realization` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_plan_purchases`
--

CREATE TABLE IF NOT EXISTS `tr_plan_purchases` (
`tr_plan_purchase_id` int(11) NOT NULL,
  `tr_plan_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `tr_plan_purchase_qty` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `user_login` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `user_password` varchar(32) DEFAULT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `user_last_login` datetime DEFAULT NULL,
  `user_registered` datetime DEFAULT NULL,
  `user_is_active` tinyint(1) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `user_is_login` int(11) NOT NULL,
  `expired_date` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_name`, `user_email`, `user_phone`, `job_title`, `company`, `user_password`, `user_group_id`, `user_last_login`, `user_registered`, `user_is_active`, `employee_id`, `user_is_login`, `expired_date`) VALUES
(1, 'admin', 'Administrator', '', '', '', '', 'cdaeb1282d614772beb1e74c192bebda', 1, NULL, NULL, 1, 1, 1, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brokens`
--
ALTER TABLE `brokens`
 ADD PRIMARY KEY (`broken_id`);

--
-- Indexes for table `coas`
--
ALTER TABLE `coas`
 ADD PRIMARY KEY (`coa_id`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
 ADD PRIMARY KEY (`cost_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employee_groups`
--
ALTER TABLE `employee_groups`
 ADD PRIMARY KEY (`employee_group_id`);

--
-- Indexes for table `employee_positions`
--
ALTER TABLE `employee_positions`
 ADD PRIMARY KEY (`employee_position_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `journals_sl`
--
ALTER TABLE `journals_sl`
 ADD PRIMARY KEY (`journal_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
 ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `location_categories`
--
ALTER TABLE `location_categories`
 ADD PRIMARY KEY (`location_category_id`);

--
-- Indexes for table `log_data`
--
ALTER TABLE `log_data`
 ADD PRIMARY KEY (`log_data_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
 ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
 ADD PRIMARY KEY (`period_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
 ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `route_details`
--
ALTER TABLE `route_details`
 ADD PRIMARY KEY (`route_detail_id`);

--
-- Indexes for table `side_menus`
--
ALTER TABLE `side_menus`
 ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `stands`
--
ALTER TABLE `stands`
 ADD PRIMARY KEY (`stand_id`);

--
-- Indexes for table `transactions_sl`
--
ALTER TABLE `transactions_sl`
 ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
 ADD PRIMARY KEY (`transaction_type_id`);

--
-- Indexes for table `trucks`
--
ALTER TABLE `trucks`
 ADD PRIMARY KEY (`truck_id`);

--
-- Indexes for table `truck_types`
--
ALTER TABLE `truck_types`
 ADD PRIMARY KEY (`truck_type_id`);

--
-- Indexes for table `tr_costs`
--
ALTER TABLE `tr_costs`
 ADD PRIMARY KEY (`tr_cost_id`);

--
-- Indexes for table `tr_cost_types`
--
ALTER TABLE `tr_cost_types`
 ADD PRIMARY KEY (`tr_cost_type_id`);

--
-- Indexes for table `tr_payments`
--
ALTER TABLE `tr_payments`
 ADD PRIMARY KEY (`tr_payment_id`);

--
-- Indexes for table `tr_plans`
--
ALTER TABLE `tr_plans`
 ADD PRIMARY KEY (`tr_plan_id`);

--
-- Indexes for table `tr_plan_details`
--
ALTER TABLE `tr_plan_details`
 ADD PRIMARY KEY (`tr_plan_detail_id`);

--
-- Indexes for table `tr_plan_detail_shipments`
--
ALTER TABLE `tr_plan_detail_shipments`
 ADD PRIMARY KEY (`tr_plan_detail_shipment_id`);

--
-- Indexes for table `tr_plan_purchases`
--
ALTER TABLE `tr_plan_purchases`
 ADD PRIMARY KEY (`tr_plan_purchase_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brokens`
--
ALTER TABLE `brokens`
MODIFY `broken_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coas`
--
ALTER TABLE `coas`
MODIFY `coa_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
MODIFY `cost_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `employee_groups`
--
ALTER TABLE `employee_groups`
MODIFY `employee_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee_positions`
--
ALTER TABLE `employee_positions`
MODIFY `employee_position_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `journals_sl`
--
ALTER TABLE `journals_sl`
MODIFY `journal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `location_categories`
--
ALTER TABLE `location_categories`
MODIFY `location_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `log_data`
--
ALTER TABLE `log_data`
MODIFY `log_data_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `route_details`
--
ALTER TABLE `route_details`
MODIFY `route_detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `side_menus`
--
ALTER TABLE `side_menus`
MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=110014;
--
-- AUTO_INCREMENT for table `stands`
--
ALTER TABLE `stands`
MODIFY `stand_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transactions_sl`
--
ALTER TABLE `transactions_sl`
MODIFY `transaction_id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
MODIFY `transaction_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `trucks`
--
ALTER TABLE `trucks`
MODIFY `truck_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `truck_types`
--
ALTER TABLE `truck_types`
MODIFY `truck_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tr_costs`
--
ALTER TABLE `tr_costs`
MODIFY `tr_cost_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tr_cost_types`
--
ALTER TABLE `tr_cost_types`
MODIFY `tr_cost_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT for table `tr_payments`
--
ALTER TABLE `tr_payments`
MODIFY `tr_payment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tr_plans`
--
ALTER TABLE `tr_plans`
MODIFY `tr_plan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tr_plan_details`
--
ALTER TABLE `tr_plan_details`
MODIFY `tr_plan_detail_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `tr_plan_detail_shipments`
--
ALTER TABLE `tr_plan_detail_shipments`
MODIFY `tr_plan_detail_shipment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tr_plan_purchases`
--
ALTER TABLE `tr_plan_purchases`
MODIFY `tr_plan_purchase_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
