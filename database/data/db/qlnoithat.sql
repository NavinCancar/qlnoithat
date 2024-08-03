-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 15, 2023 lúc 03:05 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlnoithat`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_dat_hang`
--

CREATE TABLE `chi_tiet_don_dat_hang` (
  `NT_MA` int(11) NOT NULL,
  `DDH_MA` int(11) NOT NULL,
  `CTDDH_SOLUONG` int(11) NOT NULL,
  `CTDDH_DONGIA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_don_dat_hang`
--

INSERT INTO `chi_tiet_don_dat_hang` (`NT_MA`, `DDH_MA`, `CTDDH_SOLUONG`, `CTDDH_DONGIA`) VALUES
(1, 1, 1, 32301800),
(1, 20, 1, 32301800),
(1, 23, 1, 32301800),
(1, 24, 1, 32301800),
(2, 10, 1, 22490000),
(2, 26, 1, 22490000),
(3, 2, 1, 25430000),
(3, 3, 1, 25430000),
(3, 7, 1, 25430000),
(3, 15, 1, 25430000),
(3, 26, 1, 25430000),
(4, 11, 1, 18500000),
(4, 23, 1, 18500000),
(5, 5, 1, 6780000),
(5, 14, 1, 6780000),
(5, 15, 1, 6780000),
(5, 16, 1, 6780000),
(5, 34, 1, 6780000),
(6, 8, 1, 17580000),
(6, 22, 1, 17580000),
(6, 35, 1, 17580000),
(7, 4, 6, 3480000),
(7, 9, 6, 3480000),
(7, 13, 1, 3480000),
(7, 18, 1, 3480000),
(7, 19, 1, 3480000),
(7, 22, 6, 3480000),
(7, 25, 1, 3480000),
(7, 30, 1, 3480000),
(8, 17, 1, 3440000),
(8, 27, 4, 3440000),
(8, 28, 1, 3440000),
(8, 29, 1, 3440000),
(8, 31, 1, 3440000),
(8, 33, 2, 3440000),
(9, 6, 1, 50490000),
(9, 21, 1, 52040000),
(10, 31, 1, 4000000),
(11, 11, 1, 18900000),
(11, 16, 1, 18900000),
(11, 21, 1, 18900000),
(11, 32, 1, 18900000),
(12, 11, 1, 28380000),
(14, 22, 1, 37600000),
(15, 12, 1, 21120000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_gio_hang`
--

CREATE TABLE `chi_tiet_gio_hang` (
  `NT_MA` int(11) NOT NULL,
  `GH_MA` int(11) NOT NULL,
  `CTGH_SOLUONG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_gio_hang`
--

INSERT INTO `chi_tiet_gio_hang` (`NT_MA`, `GH_MA`, `CTGH_SOLUONG`) VALUES
(8, 2, 4),
(13, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_lo_nhap`
--

CREATE TABLE `chi_tiet_lo_nhap` (
  `NT_MA` int(11) NOT NULL,
  `LN_MA` int(11) NOT NULL,
  `CTLN_SOLUONG` int(11) NOT NULL,
  `CTLN_GIA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_lo_nhap`
--

INSERT INTO `chi_tiet_lo_nhap` (`NT_MA`, `LN_MA`, `CTLN_SOLUONG`, `CTLN_GIA`) VALUES
(1, 1, 300, 9000000000),
(1, 16, 500, 1500000000),
(2, 2, 250, 5990500000),
(3, 3, 400, 9855040000),
(3, 12, 76, 20000000),
(4, 4, 500, 8563040000),
(4, 12, 500, 1500000000),
(5, 5, 700, 4390500000),
(6, 6, 850, 14000000000),
(7, 7, 900, 3000320000),
(8, 8, 900, 2899320000),
(9, 9, 100, 4890500000),
(10, 10, 975, 3297000000),
(11, 10, 100, 1500000000),
(12, 8, 100, 2238000000),
(13, 8, 120, 1954000000),
(14, 9, 50, 1500000000),
(15, 10, 150, 2999000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_lo_xuat`
--

CREATE TABLE `chi_tiet_lo_xuat` (
  `NT_MA` int(11) NOT NULL,
  `LX_MA` int(11) NOT NULL,
  `CTLX_SOLUONG` int(11) NOT NULL,
  `CTLX_GIA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_lo_xuat`
--

INSERT INTO `chi_tiet_lo_xuat` (`NT_MA`, `LX_MA`, `CTLX_SOLUONG`, `CTLX_GIA`) VALUES
(1, 1, 100, 3030180000),
(2, 2, 50, 1100000000),
(3, 3, 200, 5000000000),
(4, 4, 200, 3500000000),
(4, 5, 500, 1500000000),
(7, 15, 500, 1500000000),
(9, 14, 55, 3000000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuc_vu`
--

CREATE TABLE `chuc_vu` (
  `CV_MA` int(11) NOT NULL,
  `CV_TEN` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chuc_vu`
--

INSERT INTO `chuc_vu` (`CV_MA`, `CV_TEN`) VALUES
(3, 'Bán hàng'),
(1, 'Chủ cửa hàng'),
(2, 'Kiểm kho');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_gia`
--

CREATE TABLE `danh_gia` (
  `DG_MA` int(11) NOT NULL,
  `KH_MA` int(11) NOT NULL,
  `NT_MA` int(11) NOT NULL,
  `DG_NOIDUNG` text NOT NULL,
  `DG_DIEM` int(11) NOT NULL,
  `DG_THOIGIAN` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_gia`
--

INSERT INTO `danh_gia` (`DG_MA`, `KH_MA`, `NT_MA`, `DG_NOIDUNG`, `DG_DIEM`, `DG_THOIGIAN`) VALUES
(2, 4, 3, 'Đáng tiền', 5, '2023-07-22 11:10:02'),
(3, 1, 7, 'Màu không như minh hoạ', 4, '2023-07-22 11:10:02'),
(4, 3, 3, 'Chất lượng tốt', 5, '2023-07-22 11:10:02'),
(5, 4, 6, 'Cũng ổn', 4, '2023-07-22 11:10:02'),
(6, 6, 10, 'Mau dơ', 3, '2023-07-22 11:10:02'),
(9, 3, 7, 'Đẹp', 5, '2023-07-31 20:25:37'),
(10, 5, 9, 'Hơi đắt nhưng chất lượng quá tốt', 5, '2023-07-31 20:39:09'),
(12, 1, 1, 'Xịn', 5, '2023-08-31 21:31:20'),
(15, 1, 3, 'Đẹp mà không bền màu lắm :(', 4, '2023-11-07 21:56:18'),
(16, 1, 5, 'Chất lượng tốt nha', 5, '2023-11-07 21:56:56'),
(17, 1, 11, 'Đẹp mê <3', 5, '2023-11-07 21:58:18'),
(18, 2, 12, 'Màu trắng đẹp xỉu!', 5, '2023-11-07 21:59:40'),
(19, 2, 11, 'Ai đang phân vân thì cứ mua đi, xứng đáng!', 5, '2023-11-07 22:00:15'),
(20, 2, 4, 'Nhìn hiện đại, đặt trong nhà nhìn sang!', 5, '2023-11-07 22:00:53'),
(22, 4, 5, 'Dễ xước mặt bàn', 4, '2023-11-07 22:04:50'),
(23, 7, 2, '10 điểm chất lượng luôn', 5, '2023-11-07 22:08:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dia_chi_giao_hang`
--

CREATE TABLE `dia_chi_giao_hang` (
  `DCGH_MA` int(11) NOT NULL,
  `TTP_MA` int(11) NOT NULL,
  `KH_MA` int(11) NOT NULL,
  `DCGH_HOTENNGUOINHAN` char(30) NOT NULL,
  `DCGH_VITRICUTHE` char(255) NOT NULL,
  `DCGH_GHICHU` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `dia_chi_giao_hang`
--

INSERT INTO `dia_chi_giao_hang` (`DCGH_MA`, `TTP_MA`, `KH_MA`, `DCGH_HOTENNGUOINHAN`, `DCGH_VITRICUTHE`, `DCGH_GHICHU`) VALUES
(1, 1, 1, 'Phan Văn Khải', '177 Trần Quang Diệu, An Thới, Ninh Kiều', 'Nhà có chó dữ'),
(2, 1, 1, 'Trần Ý', '210 to 15 Đỗ Trọng Văn, Bình Thuỷ, Bình Thủy', 'Giao ngoài giờ hành chính'),
(3, 1, 2, 'Nguyễn Văn Kiên', '179 Nguyễn Văn Cừ, Phường An Khánh, Ninh Kiều', 'Không'),
(4, 2, 3, 'Phạm Thi Hoa', '34 Thanh Bình, Chợ Gạo', 'Không'),
(5, 2, 4, 'Trịnh Ngọc Kỳ', 'Chùa Thạnh An, Long An, Cần Giuộc', 'Không'),
(6, 3, 5, 'Hoa Thị Trâm', '392 Phạm Cự Lượng, Mỹ Quý, Long Xuyên', 'Giao ngoài giờ hành chính'),
(7, 3, 5, 'Nguyễn Văn Kiên', 'Xẻo Sâu, Thoại Sơn', 'Gần cây xăng Mỹ Linh'),
(8, 4, 6, 'Nguyễn Ngọc Ánh', '54 Ngọc Thành, Giồng Riềng', 'Không'),
(9, 4, 7, 'Trần Ngọc Phước', '74 Vĩnh Tường, Vị Thuỷ', 'Giao ngoài giờ hành chính'),
(10, 4, 7, 'Lê Thảo Nhi', '34 Vĩnh Thuận Tây, Vị Thuỷ', 'Không'),
(21, 1, 12, 'Hiếu Nguyễn', '123 Nguyễn Văn Cừ, An Bình, Ninh Kiều', 'Không'),
(22, 1, 12, 'Như', 'KTX B, ĐH Cần Thơ, Ninh Kiều', 'Chỉ giao buổi trưa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_dat_hang`
--

CREATE TABLE `don_dat_hang` (
  `DDH_MA` int(11) NOT NULL,
  `HTTT_MA` int(11) NOT NULL,
  `DCGH_MA` int(11) NOT NULL,
  `TT_MA` int(11) NOT NULL,
  `DDH_NGAYDAT` datetime NOT NULL,
  `DDH_TONGTIEN` float NOT NULL,
  `DDH_PHISHIPTHUCTE` float NOT NULL,
  `DDH_THUEVAT` float NOT NULL,
  `DDH_DUONGDANHINHANHCHUYENKHOAN` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `don_dat_hang`
--

INSERT INTO `don_dat_hang` (`DDH_MA`, `HTTT_MA`, `DCGH_MA`, `TT_MA`, `DDH_NGAYDAT`, `DDH_TONGTIEN`, `DDH_PHISHIPTHUCTE`, `DDH_THUEVAT`, `DDH_DUONGDANHINHANHCHUYENKHOAN`) VALUES
(1, 1, 1, 4, '2023-07-06 00:00:00', 32331800, 30000, 8, NULL),
(2, 2, 2, 4, '2023-07-25 00:00:00', 25450000, 20000, 8, 'minhchung.jpg'),
(3, 2, 3, 4, '2023-07-18 00:00:00', 25445000, 15000, 8, 'minhchung.jpg'),
(4, 3, 4, 4, '2023-07-04 00:00:00', 20890000, 10000, 8, 'minhchung.jpg'),
(5, 3, 5, 4, '2023-07-11 00:00:00', 6805000, 25000, 8, 'minhchung.jpg'),
(6, 4, 6, 4, '2023-07-06 00:00:00', 50505000, 15000, 8, 'minhchung.jpg'),
(7, 1, 7, 4, '2023-07-08 00:00:00', 25450000, 20000, 8, NULL),
(8, 4, 8, 5, '2023-07-04 00:00:00', 17590000, 10000, 8, 'minhchung.jpg'),
(9, 1, 9, 4, '2023-07-08 00:00:00', 20910000, 30000, 8, NULL),
(10, 1, 10, 4, '2023-07-03 00:00:00', 22505000, 25000, 8, NULL),
(11, 1, 3, 4, '2023-08-02 13:25:59', 71042400, 0, 8, NULL),
(12, 1, 5, 4, '2023-08-02 13:26:27', 22839600, 30000, 8, NULL),
(13, 2, 1, 5, '2023-08-04 10:38:27', 3758400, 0, 8, '1_2023-08-04_10-38-27.jpg'),
(14, 1, 1, 4, '2023-08-31 21:34:19', 7322400, 0, 8, NULL),
(15, 1, 2, 4, '2023-10-19 16:37:30', 34786800, 0, 8, NULL),
(16, 1, 1, 4, '2023-10-22 16:58:14', 27734400, 0, 8, NULL),
(17, 1, 2, 4, '2023-10-22 21:02:12', 3715200, 0, 8, NULL),
(18, 4, 2, 4, '2023-10-22 21:55:20', 3758400, 0, 8, '1_2023-10-22_21-55-20.jpg'),
(19, 1, 1, 5, '2023-11-02 17:02:35', 3758400, 0, 8, NULL),
(20, 1, 9, 4, '2023-11-06 17:07:58', 34905900, 20000, 8, NULL),
(21, 1, 9, 4, '2023-11-06 17:37:33', 76635200, 20000, 8, NULL),
(22, 2, 9, 4, '2023-11-06 18:37:16', 82164800, 20000, 8, '7_2023-11-06_18-37-16.jpg'),
(23, 1, 6, 4, '2023-11-06 19:00:24', 54890900, 25000, 8, NULL),
(24, 1, 3, 4, '2023-11-06 20:30:42', 34885900, 0, 8, NULL),
(25, 4, 2, 4, '2023-11-06 22:27:28', 3758400, 0, 8, '1_2023-11-06_22-27-28.jpg'),
(26, 4, 4, 4, '2023-11-07 22:03:26', 51783600, 30000, 8, '3_2023-11-07_22-03-26.jpg'),
(27, 1, 5, 5, '2023-11-07 22:05:11', 14890800, 30000, 8, NULL),
(28, 1, 8, 3, '2023-11-07 22:06:47', 3735200, 20000, 8, NULL),
(29, 1, 9, 3, '2023-11-07 22:08:53', 3735200, 20000, 8, NULL),
(30, 1, 22, 3, '2023-11-09 10:50:24', 3758400, 0, 8, NULL),
(31, 1, 1, 2, '2023-11-14 18:54:28', 8035200, 0, 8, NULL),
(32, 1, 9, 2, '2023-11-14 18:57:03', 20432000, 20000, 8, NULL),
(33, 1, 5, 2, '2023-11-14 18:57:49', 7460400, 30000, 8, NULL),
(34, 1, 4, 1, '2023-11-15 20:52:49', 7352400, 30000, 8, NULL),
(35, 3, 6, 1, '2023-11-15 20:58:32', 19011400, 25000, 8, '5_2023-11-15_20-58-32.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hang`
--

CREATE TABLE `gio_hang` (
  `GH_MA` int(11) NOT NULL,
  `KH_MA` int(11) NOT NULL,
  `GH_NGAYCAPNHATLANCUOI` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `gio_hang`
--

INSERT INTO `gio_hang` (`GH_MA`, `KH_MA`, `GH_NGAYCAPNHATLANCUOI`) VALUES
(1, 1, '2023-11-14 18:54:19'),
(2, 2, '2023-11-07 22:01:12'),
(3, 3, '2023-11-15 20:52:39'),
(4, 4, '2023-11-14 18:57:44'),
(5, 5, '2023-11-15 20:55:37'),
(6, 6, '2023-11-07 22:06:41'),
(7, 7, '2023-11-14 18:56:56'),
(12, 12, '2023-11-09 10:49:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh_anh_noi_that`
--

CREATE TABLE `hinh_anh_noi_that` (
  `HANT_MA` int(11) NOT NULL,
  `NT_MA` int(11) NOT NULL,
  `HANT_TEN` char(60) NOT NULL,
  `HANT_DUONGDAN` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh_anh_noi_that`
--

INSERT INTO `hinh_anh_noi_that` (`HANT_MA`, `NT_MA`, `HANT_TEN`, `HANT_DUONGDAN`) VALUES
(1, 1, '1-1', '1-1.jpg'),
(2, 1, '1-2', '1-2.jpg'),
(3, 1, '1-3', '1-3.jpg'),
(4, 1, '1-4', '1-4.jpg'),
(5, 2, '2-1', '2-1.jpg'),
(6, 2, '2-2', '2-2.jpg'),
(7, 3, '3-1', '3-1.jpg'),
(8, 3, '3-2', '3-2.jpg'),
(12, 4, '4-1', '4-1.jpg'),
(13, 4, '4-2', '4-2.jpg'),
(14, 4, '4-3', '4-3.jpg'),
(15, 5, '5-1', '5-1.jpg'),
(16, 5, '5-2', '5-2.jpg'),
(17, 5, '5-3', '5-3.jpg'),
(18, 6, '6-1', '6-1.jpg'),
(19, 6, '6-2', '6-2.jpg'),
(20, 7, '7-1', '7-1.jpg'),
(21, 7, '7-2', '7-2.jpg'),
(22, 8, '8-1', '8-1.jpg'),
(23, 8, '8-2', '8-2.jpg'),
(25, 9, '9-1', '9-1.jpg'),
(26, 10, '10-1', '10-1.jpg'),
(27, 11, '11-1', '11-1.jpg'),
(28, 11, '11-2', '11-2.jpg'),
(29, 12, '12-1', '12-1.jpg'),
(30, 12, '12-2', '12-2.jpg'),
(31, 13, '13-1', '13-1.jpg'),
(32, 13, '13-2', '13-2.jpg'),
(33, 14, '14-1', '14-1.jpg'),
(34, 15, '15-1', '15-1.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh_thuc_thanh_toan`
--

CREATE TABLE `hinh_thuc_thanh_toan` (
  `HTTT_MA` int(11) NOT NULL,
  `HTTT_TEN` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh_thuc_thanh_toan`
--

INSERT INTO `hinh_thuc_thanh_toan` (`HTTT_MA`, `HTTT_TEN`) VALUES
(2, 'Thanh toán qua MOMO'),
(4, 'Thanh toán qua Ngân hàng'),
(3, 'Thanh toán qua PayPal'),
(5, 'Thanh toán qua VISA'),
(1, 'Thanh toán trực tiếp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `KH_MA` int(11) NOT NULL,
  `KH_HOTEN` char(30) NOT NULL,
  `KH_SODIENTHOAI` char(11) NOT NULL,
  `KH_MATKHAU` char(20) NOT NULL,
  `KH_NGAYSINH` date NOT NULL,
  `KH_GIOITINH` char(5) NOT NULL,
  `KH_EMAIL` char(50) NOT NULL,
  `KH_DUONGDANANHDAIDIEN` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`KH_MA`, `KH_HOTEN`, `KH_SODIENTHOAI`, `KH_MATKHAU`, `KH_NGAYSINH`, `KH_GIOITINH`, `KH_EMAIL`, `KH_DUONGDANANHDAIDIEN`) VALUES
(1, 'Phan Văn Khải', '0111222333', '1234', '2000-06-05', 'Nam', 'vankhai@gmail.com', '1.png'),
(2, 'Nguyễn Văn Kiên', '0111222444', '1234', '2000-02-21', 'Nam', 'vankien@gmail.com', '2.jpg'),
(3, 'Phạm Thi Hoa', '0111222555', '1234', '2002-08-18', 'Nữ', 'thihoa@gmail.com', '3.jpg'),
(4, 'Trịnh Ngọc Kỳ', '0111222666', '1234', '2003-12-05', 'Nữ', 'ngocky@gmail.com', '4.jpg'),
(5, 'Hoa Thị Trâm', '0111222777', '1234', '2001-06-14', 'Nữ', 'thitram@gmail.com', '5.jpg'),
(6, 'Nguyễn Ngọc Ánh', '0111222888', '1234', '2000-08-20', 'Nữ', 'ngocanh@gmail.com', '6.jpg'),
(7, 'Trần Ngọc Phước', '0111222999', '1234', '2002-05-19', 'Nam', 'ngocphuoc@gmail.com', '7.jpg'),
(12, 'Nguyễn Phương Hiếu', '0123456789', '123', '2002-07-06', 'Nữ', 'hieub2003737@gmail.com', '12.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_noi_that`
--

CREATE TABLE `loai_noi_that` (
  `LNT_MA` int(11) NOT NULL,
  `LNT_TEN` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_noi_that`
--

INSERT INTO `loai_noi_that` (`LNT_MA`, `LNT_TEN`) VALUES
(3, 'Bàn ăn'),
(2, 'Bàn nước'),
(4, 'Ghế ăn'),
(1, 'Sofa'),
(6, 'Tủ ly'),
(5, 'Tủ tivi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lo_nhap`
--

CREATE TABLE `lo_nhap` (
  `LN_MA` int(11) NOT NULL,
  `NV_MA` int(11) NOT NULL,
  `LN_NGAYNHAP` datetime NOT NULL,
  `LN_NOIDUNG` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lo_nhap`
--

INSERT INTO `lo_nhap` (`LN_MA`, `NV_MA`, `LN_NGAYNHAP`, `LN_NOIDUNG`) VALUES
(1, 2, '2023-06-11 12:12:17', 'Nhập thành công'),
(2, 2, '2023-06-21 12:21:44', 'Nhập thành công'),
(3, 1, '2023-06-23 12:31:16', 'Nhập thành công'),
(4, 2, '2023-06-26 12:23:40', 'Nhập thành công'),
(5, 2, '2023-06-30 12:12:20', 'Nhập thành công'),
(6, 2, '2023-07-01 12:32:23', 'Nhập thành công'),
(7, 1, '2023-07-04 12:11:42', 'Nhập thành công'),
(8, 1, '2023-07-04 12:43:42', 'Nhập thành công'),
(9, 2, '2023-07-04 12:51:32', 'Nhập thành công'),
(10, 2, '2023-07-09 12:13:31', 'Nhập thành công'),
(12, 1, '2023-08-05 21:10:00', 'Nhập'),
(16, 2, '2023-10-22 10:04:00', 'Nhập mới');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lo_xuat`
--

CREATE TABLE `lo_xuat` (
  `LX_MA` int(11) NOT NULL,
  `NV_MA` int(11) NOT NULL,
  `LX_NGAYXUAT` datetime NOT NULL,
  `LX_NOIDUNG` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lo_xuat`
--

INSERT INTO `lo_xuat` (`LX_MA`, `NV_MA`, `LX_NGAYXUAT`, `LX_NOIDUNG`) VALUES
(1, 1, '2023-07-11 09:24:35', 'Thanh lý'),
(2, 2, '2023-07-15 09:23:31', 'Xuất kho'),
(3, 2, '2023-07-16 08:11:03', 'Xuất kho'),
(4, 1, '2023-07-16 08:42:30', 'Thanh lý'),
(5, 3, '2023-08-09 14:12:03', 'Bán theo lô'),
(14, 2, '2023-11-06 17:27:00', 'Bán lại'),
(15, 2, '2023-11-09 21:23:00', 'Bán lại');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `NV_MA` int(11) NOT NULL,
  `CV_MA` int(11) NOT NULL,
  `NV_HOTEN` char(30) NOT NULL,
  `NV_SODIENTHOAI` char(11) NOT NULL,
  `NV_DIACHI` char(255) NOT NULL,
  `NV_MATKHAU` char(20) NOT NULL,
  `NV_NGAYSINH` date NOT NULL,
  `NV_GIOITINH` char(5) NOT NULL,
  `NV_EMAIL` char(50) NOT NULL,
  `NV_DUONGDANANHDAIDIEN` char(255) NOT NULL,
  `NV_TRANGTHAI` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhan_vien`
--

INSERT INTO `nhan_vien` (`NV_MA`, `CV_MA`, `NV_HOTEN`, `NV_SODIENTHOAI`, `NV_DIACHI`, `NV_MATKHAU`, `NV_NGAYSINH`, `NV_GIOITINH`, `NV_EMAIL`, `NV_DUONGDANANHDAIDIEN`, `NV_TRANGTHAI`) VALUES
(1, 1, 'Lâm Đại Ngọc', '0999888777', 'Cần Thơ', '1234', '1999-06-15', 'Nữ', 'lamdaingoc@gmail.com', '1.jpg', 1),
(2, 2, 'Phan Thanh Duy', '0999888666', 'Hậu Giang', '1234', '1998-03-12', 'Nam', 'phanthanhduy@gmail.com', '2.jpg', 1),
(3, 3, 'Nguyễn Thị Hồng', '0999888555', 'Tiền Giang', '1234', '1996-04-26', 'Nữ', 'nguyenthihong@gmail.com', '3.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `noi_that`
--

CREATE TABLE `noi_that` (
  `NT_MA` int(11) NOT NULL,
  `XCT_MA` int(11) NOT NULL,
  `LNT_MA` int(11) NOT NULL,
  `NT_TEN` char(255) NOT NULL,
  `NT_CHIEUDAI` float NOT NULL,
  `NT_CHIEURONG` float NOT NULL,
  `NT_CHIEUCAO` float NOT NULL,
  `NT_MOTACHATLIEU` text DEFAULT NULL,
  `NT_GIA` float NOT NULL,
  `NT_NGAYCAPNHAT` datetime NOT NULL,
  `NT_NGAYTAO` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `noi_that`
--

INSERT INTO `noi_that` (`NT_MA`, `XCT_MA`, `LNT_MA`, `NT_TEN`, `NT_CHIEUDAI`, `NT_CHIEURONG`, `NT_CHIEUCAO`, `NT_MOTACHATLIEU`, `NT_GIA`, `NT_NGAYCAPNHAT`, `NT_NGAYTAO`) VALUES
(1, 1, 1, 'Sofa Coastal 2 chỗ vải Sevilla', 2300, 800, 760, 'Khung gỗ Ash - nệm bọc vải', 32301800, '2023-07-22 10:31:35', '2023-07-22 10:31:35'),
(2, 2, 1, 'Sofa Dax Everest 3 chỗ vải màu vàng', 2100, 900, 740, 'Khung gỗ bọc vải', 22490000, '2023-07-22 10:43:17', '2023-07-22 10:43:17'),
(3, 1, 2, 'Bàn nước Elegance màu nâu', 1200, 600, 400, 'Gỗ Ash (tần bì) đặc tự nhiên nhập khẩu từ Mỹ', 25430000, '2023-07-22 10:45:15', '2023-07-22 10:45:15'),
(4, 4, 2, 'Bàn nước Cabo mặt oval PMA530013 F1', 1200, 550, 380, 'Mặt kính cường lực/ đá marble, chân sắt sơn màu đen', 18500000, '2023-07-22 10:47:15', '2023-07-22 10:47:15'),
(5, 5, 3, 'Bàn ăn Cult 6 chỗ', 1400, 800, 750, 'Chân bàn Aluminium sơn tĩnh điện, mặt bàn gỗ HPL', 6780000, '2023-07-22 10:50:10', '2023-07-22 10:50:10'),
(6, 3, 3, 'Bàn ăn Shadow 6 chỗ', 1600, 850, 750, 'Chân kim loại màu đồng + MDF Veneer sồi', 17580000, '2023-07-22 10:52:14', '2023-07-22 10:52:14'),
(7, 5, 4, 'Ghế Skagen vải Sevilla', 480, 500, 830, 'Chân kim loại - Gỗ walnut bọc vải cao cấp', 3480000, '2023-07-22 10:54:56', '2023-07-22 10:54:56'),
(8, 2, 4, 'Ghế ăn Roma', 560, 440, 820, 'Gỗ tần bì tự nhiên bọc vải cao cấp', 3440000, '2023-07-22 10:56:58', '2023-07-22 10:56:58'),
(9, 3, 5, 'Tủ tivi Elegance màu nâu', 1745, 420, 430, 'Gỗ Ash (tần bì) đặc tự nhiên nhập khẩu từ Mỹ', 52040000, '2023-07-31 20:01:53', '2023-07-22 10:58:45'),
(10, 2, 4, 'Ghế ăn Cabo vải MB2041/23', 515, 520, 800, 'Chân kim loại sơn bọc vải', 4000000, '2023-07-22 11:05:35', '2023-07-22 11:05:35'),
(11, 3, 5, 'Tủ Cabinet Coastal', 1840, 420, 560, 'Gỗ Ash - MDF veneer Ash', 18900000, '2023-07-31 20:04:57', '2023-07-31 20:04:57'),
(12, 1, 1, 'Sofa 3 chỗ Osaka mẫu 1 vải 65', 2060, 750, 820, 'Chân Inox màu gold, tay gỗ, bọc vải, nệm ngồi tháo rời', 28380000, '2023-07-31 20:07:45', '2023-07-31 20:07:45'),
(13, 2, 2, 'Bàn nước Osaka', 1200, 650, 460, 'Gỗ Oak - MDF veneer Oak - Inox 304 màu gold', 19540000, '2023-07-31 20:11:13', '2023-07-31 20:11:13'),
(14, 1, 6, 'Tủ ly Canyon', 1800, 500, 880, 'Gỗ sồi, MDF veneer sồi, Inox 304 pvd màu gold', 37600000, '2023-07-31 20:14:05', '2023-07-31 20:14:05'),
(15, 5, 6, 'Tủ ly Blue gỗ Sồi', 900, 480, 2000, 'Gỗ sồi - MDF veneer sồi', 21120000, '2023-10-22 17:07:52', '2023-07-31 20:15:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinh_thanh_pho`
--

CREATE TABLE `tinh_thanh_pho` (
  `TTP_MA` int(11) NOT NULL,
  `TTP_TEN` char(100) NOT NULL,
  `TTP_CHIPHIGIAOHANG` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tinh_thanh_pho`
--

INSERT INTO `tinh_thanh_pho` (`TTP_MA`, `TTP_TEN`, `TTP_CHIPHIGIAOHANG`) VALUES
(1, 'Cần Thơ', 0),
(2, 'Tiền Giang', 30000),
(3, 'An Giang', 25000),
(4, 'Hậu Giang', 20000),
(5, 'Bạc Liêu', 30000),
(6, 'Cà Mau', 50000),
(7, 'Hồ Chí Minh', 30000),
(8, 'Hà Nội', 100000),
(9, 'Đà Nẵng', 50000),
(10, 'Thừa Thiên Huế', 70000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trang_thai`
--

CREATE TABLE `trang_thai` (
  `TT_MA` int(11) NOT NULL,
  `TT_TEN` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `trang_thai`
--

INSERT INTO `trang_thai` (`TT_MA`, `TT_TEN`) VALUES
(1, 'Đã đặt hàng nhưng chưa xử lý'),
(4, 'Đã nhận hàng'),
(3, 'Đang giao'),
(2, 'Đơn hàng đã được xử lý'),
(5, 'Hủy đơn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xuong_che_tac`
--

CREATE TABLE `xuong_che_tac` (
  `XCT_MA` int(11) NOT NULL,
  `XCT_TEN` char(255) NOT NULL,
  `XCT_SODIENTHOAI` char(11) NOT NULL,
  `XCT_DIACHI` char(255) NOT NULL,
  `XCT_EMAIL` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `xuong_che_tac`
--

INSERT INTO `xuong_che_tac` (`XCT_MA`, `XCT_TEN`, `XCT_SODIENTHOAI`, `XCT_DIACHI`, `XCT_EMAIL`) VALUES
(1, 'Kim Tinh', '1900111222', '75 Quang Trung, Hai Bà Trưng, Hà Nội', 'kimtinh@gmail.com'),
(2, 'Minh Hải', '1900111333', '642 Nguyễn Thị Minh Khai, Phường Đa Kao, Quận 1, TP.HCM', 'minhhai@gmail.com'),
(3, 'Thanh Vân', '1900111444', '161B Lý Chính Thắng, Quận 3, TP.HCM', 'thanhvan@gmail.com'),
(4, 'Thế Toàn', '1900111555', '68 Nguyễn Trường Tộ, Phường Trúc Bạch, Quận Ba Đình, Hà Nội', 'thetoan@gmail.com'),
(5, 'Phong Vân', '1900111666', '78/26 Hoàng Cầu, Phường ô Chợ Dừa, Quận Đống Đa, Hà Nội', 'phongvan@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chi_tiet_don_dat_hang`
--
ALTER TABLE `chi_tiet_don_dat_hang`
  ADD PRIMARY KEY (`NT_MA`,`DDH_MA`),
  ADD KEY `FK_DDH_CTDDH` (`DDH_MA`);

--
-- Chỉ mục cho bảng `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD PRIMARY KEY (`NT_MA`,`GH_MA`),
  ADD KEY `FK_GH_CTGH` (`GH_MA`);

--
-- Chỉ mục cho bảng `chi_tiet_lo_nhap`
--
ALTER TABLE `chi_tiet_lo_nhap`
  ADD PRIMARY KEY (`NT_MA`,`LN_MA`),
  ADD KEY `FK_LN_CTLN` (`LN_MA`);

--
-- Chỉ mục cho bảng `chi_tiet_lo_xuat`
--
ALTER TABLE `chi_tiet_lo_xuat`
  ADD PRIMARY KEY (`NT_MA`,`LX_MA`),
  ADD KEY `FK_LX_CTLX` (`LX_MA`);

--
-- Chỉ mục cho bảng `chuc_vu`
--
ALTER TABLE `chuc_vu`
  ADD PRIMARY KEY (`CV_MA`),
  ADD UNIQUE KEY `CV_TEN` (`CV_TEN`);

--
-- Chỉ mục cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`DG_MA`),
  ADD KEY `FK_DANH_GIA_NOI_THAT` (`NT_MA`),
  ADD KEY `FK_GUI_DANH_GIA` (`KH_MA`);

--
-- Chỉ mục cho bảng `dia_chi_giao_hang`
--
ALTER TABLE `dia_chi_giao_hang`
  ADD PRIMARY KEY (`DCGH_MA`),
  ADD KEY `FK_CO_DIA_CHI_GIAO_HANG` (`KH_MA`),
  ADD KEY `FK_GIAO_DEN` (`TTP_MA`);

--
-- Chỉ mục cho bảng `don_dat_hang`
--
ALTER TABLE `don_dat_hang`
  ADD PRIMARY KEY (`DDH_MA`),
  ADD KEY `FK_CUA` (`DCGH_MA`),
  ADD KEY `FK_CUA_DON` (`TT_MA`),
  ADD KEY `FK_CUA_DON_HANG` (`HTTT_MA`);

--
-- Chỉ mục cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`GH_MA`),
  ADD KEY `FK_CO_GIO_HANG` (`KH_MA`);

--
-- Chỉ mục cho bảng `hinh_anh_noi_that`
--
ALTER TABLE `hinh_anh_noi_that`
  ADD PRIMARY KEY (`HANT_MA`),
  ADD KEY `FK_CHUP` (`NT_MA`);

--
-- Chỉ mục cho bảng `hinh_thuc_thanh_toan`
--
ALTER TABLE `hinh_thuc_thanh_toan`
  ADD PRIMARY KEY (`HTTT_MA`),
  ADD UNIQUE KEY `HTTT_TEN` (`HTTT_TEN`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`KH_MA`),
  ADD UNIQUE KEY `KH_SODIENTHOAI` (`KH_SODIENTHOAI`,`KH_EMAIL`);

--
-- Chỉ mục cho bảng `loai_noi_that`
--
ALTER TABLE `loai_noi_that`
  ADD PRIMARY KEY (`LNT_MA`),
  ADD UNIQUE KEY `LNT_TEN` (`LNT_TEN`);

--
-- Chỉ mục cho bảng `lo_nhap`
--
ALTER TABLE `lo_nhap`
  ADD PRIMARY KEY (`LN_MA`),
  ADD KEY `FK_QUAN_LY_LO_NHAP` (`NV_MA`);

--
-- Chỉ mục cho bảng `lo_xuat`
--
ALTER TABLE `lo_xuat`
  ADD PRIMARY KEY (`LX_MA`),
  ADD KEY `FK_QUAN_LY_LO_XUAT_BOI` (`NV_MA`);

--
-- Chỉ mục cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`NV_MA`),
  ADD UNIQUE KEY `NV_SODIENTHOAI` (`NV_SODIENTHOAI`,`NV_EMAIL`),
  ADD KEY `FK_DAM_NHIEM_BOI` (`CV_MA`);

--
-- Chỉ mục cho bảng `noi_that`
--
ALTER TABLE `noi_that`
  ADD PRIMARY KEY (`NT_MA`),
  ADD KEY `FK_TAO_BOI` (`XCT_MA`),
  ADD KEY `FK_THUOC_LOAI` (`LNT_MA`);

--
-- Chỉ mục cho bảng `tinh_thanh_pho`
--
ALTER TABLE `tinh_thanh_pho`
  ADD PRIMARY KEY (`TTP_MA`),
  ADD UNIQUE KEY `TTP_TEN` (`TTP_TEN`);

--
-- Chỉ mục cho bảng `trang_thai`
--
ALTER TABLE `trang_thai`
  ADD PRIMARY KEY (`TT_MA`),
  ADD UNIQUE KEY `TT_TEN` (`TT_TEN`);

--
-- Chỉ mục cho bảng `xuong_che_tac`
--
ALTER TABLE `xuong_che_tac`
  ADD PRIMARY KEY (`XCT_MA`),
  ADD UNIQUE KEY `XCT_SODIENTHOAI` (`XCT_SODIENTHOAI`,`XCT_EMAIL`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chuc_vu`
--
ALTER TABLE `chuc_vu`
  MODIFY `CV_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  MODIFY `DG_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `dia_chi_giao_hang`
--
ALTER TABLE `dia_chi_giao_hang`
  MODIFY `DCGH_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `don_dat_hang`
--
ALTER TABLE `don_dat_hang`
  MODIFY `DDH_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `GH_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `hinh_anh_noi_that`
--
ALTER TABLE `hinh_anh_noi_that`
  MODIFY `HANT_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `hinh_thuc_thanh_toan`
--
ALTER TABLE `hinh_thuc_thanh_toan`
  MODIFY `HTTT_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `KH_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `loai_noi_that`
--
ALTER TABLE `loai_noi_that`
  MODIFY `LNT_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `lo_nhap`
--
ALTER TABLE `lo_nhap`
  MODIFY `LN_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `lo_xuat`
--
ALTER TABLE `lo_xuat`
  MODIFY `LX_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  MODIFY `NV_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `noi_that`
--
ALTER TABLE `noi_that`
  MODIFY `NT_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `tinh_thanh_pho`
--
ALTER TABLE `tinh_thanh_pho`
  MODIFY `TTP_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `trang_thai`
--
ALTER TABLE `trang_thai`
  MODIFY `TT_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `xuong_che_tac`
--
ALTER TABLE `xuong_che_tac`
  MODIFY `XCT_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chi_tiet_don_dat_hang`
--
ALTER TABLE `chi_tiet_don_dat_hang`
  ADD CONSTRAINT `FK_DDH_CTDDH` FOREIGN KEY (`DDH_MA`) REFERENCES `don_dat_hang` (`DDH_MA`),
  ADD CONSTRAINT `FK_NT_CTDDH` FOREIGN KEY (`NT_MA`) REFERENCES `noi_that` (`NT_MA`);

--
-- Các ràng buộc cho bảng `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD CONSTRAINT `FK_GH_CTGH` FOREIGN KEY (`GH_MA`) REFERENCES `gio_hang` (`GH_MA`),
  ADD CONSTRAINT `FK_NT_CTGH` FOREIGN KEY (`NT_MA`) REFERENCES `noi_that` (`NT_MA`);

--
-- Các ràng buộc cho bảng `chi_tiet_lo_nhap`
--
ALTER TABLE `chi_tiet_lo_nhap`
  ADD CONSTRAINT `FK_LN_CTLN` FOREIGN KEY (`LN_MA`) REFERENCES `lo_nhap` (`LN_MA`),
  ADD CONSTRAINT `FK_NT_CTLN` FOREIGN KEY (`NT_MA`) REFERENCES `noi_that` (`NT_MA`);

--
-- Các ràng buộc cho bảng `chi_tiet_lo_xuat`
--
ALTER TABLE `chi_tiet_lo_xuat`
  ADD CONSTRAINT `FK_LX_CTLX` FOREIGN KEY (`LX_MA`) REFERENCES `lo_xuat` (`LX_MA`),
  ADD CONSTRAINT `FK_NT_CTLX` FOREIGN KEY (`NT_MA`) REFERENCES `noi_that` (`NT_MA`);

--
-- Các ràng buộc cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD CONSTRAINT `FK_DANH_GIA_NOI_THAT` FOREIGN KEY (`NT_MA`) REFERENCES `noi_that` (`NT_MA`),
  ADD CONSTRAINT `FK_GUI_DANH_GIA` FOREIGN KEY (`KH_MA`) REFERENCES `khach_hang` (`KH_MA`);

--
-- Các ràng buộc cho bảng `dia_chi_giao_hang`
--
ALTER TABLE `dia_chi_giao_hang`
  ADD CONSTRAINT `FK_CO_DIA_CHI_GIAO_HANG` FOREIGN KEY (`KH_MA`) REFERENCES `khach_hang` (`KH_MA`),
  ADD CONSTRAINT `FK_GIAO_DEN` FOREIGN KEY (`TTP_MA`) REFERENCES `tinh_thanh_pho` (`TTP_MA`);

--
-- Các ràng buộc cho bảng `don_dat_hang`
--
ALTER TABLE `don_dat_hang`
  ADD CONSTRAINT `FK_CUA` FOREIGN KEY (`DCGH_MA`) REFERENCES `dia_chi_giao_hang` (`DCGH_MA`),
  ADD CONSTRAINT `FK_CUA_DON` FOREIGN KEY (`TT_MA`) REFERENCES `trang_thai` (`TT_MA`),
  ADD CONSTRAINT `FK_CUA_DON_HANG` FOREIGN KEY (`HTTT_MA`) REFERENCES `hinh_thuc_thanh_toan` (`HTTT_MA`);

--
-- Các ràng buộc cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `FK_CO_GIO_HANG` FOREIGN KEY (`KH_MA`) REFERENCES `khach_hang` (`KH_MA`);

--
-- Các ràng buộc cho bảng `hinh_anh_noi_that`
--
ALTER TABLE `hinh_anh_noi_that`
  ADD CONSTRAINT `FK_CHUP` FOREIGN KEY (`NT_MA`) REFERENCES `noi_that` (`NT_MA`);

--
-- Các ràng buộc cho bảng `lo_nhap`
--
ALTER TABLE `lo_nhap`
  ADD CONSTRAINT `FK_QUAN_LY_LO_NHAP` FOREIGN KEY (`NV_MA`) REFERENCES `nhan_vien` (`NV_MA`);

--
-- Các ràng buộc cho bảng `lo_xuat`
--
ALTER TABLE `lo_xuat`
  ADD CONSTRAINT `FK_QUAN_LY_LO_XUAT_BOI` FOREIGN KEY (`NV_MA`) REFERENCES `nhan_vien` (`NV_MA`);

--
-- Các ràng buộc cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD CONSTRAINT `FK_DAM_NHIEM_BOI` FOREIGN KEY (`CV_MA`) REFERENCES `chuc_vu` (`CV_MA`);

--
-- Các ràng buộc cho bảng `noi_that`
--
ALTER TABLE `noi_that`
  ADD CONSTRAINT `FK_DUOC_TAO_BOI` FOREIGN KEY (`XCT_MA`) REFERENCES `xuong_che_tac` (`XCT_MA`),
  ADD CONSTRAINT `FK_THUOC_LOAI` FOREIGN KEY (`LNT_MA`) REFERENCES `loai_noi_that` (`LNT_MA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
