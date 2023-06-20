-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 20, 2023 lúc 06:22 PM
-- Phiên bản máy phục vụ: 10.4.6-MariaDB
-- Phiên bản PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `truyentranh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binh_luan`
--

CREATE TABLE `binh_luan` (
  `MaBL` int(11) NOT NULL,
  `NoiDung` varchar(500) NOT NULL,
  `id` int(11) NOT NULL,
  `MaTruyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `binh_luan`
--

INSERT INTO `binh_luan` (`MaBL`, `NoiDung`, `id`, `MaTruyen`) VALUES
(1, 'test', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cd_thien_thi`
--

CREATE TABLE `cd_thien_thi` (
  `MaCD` char(4) NOT NULL,
  `TenCD` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `cd_thien_thi`
--

INSERT INTO `cd_thien_thi` (`MaCD`, `TenCD`) VALUES
('cd01', 'private'),
('cd02', 'no public'),
('cd03', 'public');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_xem`
--

CREATE TABLE `da_xem` (
  `id` int(11) NOT NULL,
  `MaTap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luu`
--

CREATE TABLE `luu` (
  `MaTruyen` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `NgayGio` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `luu`
--

INSERT INTO `luu` (`MaTruyen`, `id`, `NgayGio`) VALUES
(2, 1, '2023-06-20 10:16:04'),
(3, 6, '2023-06-20 21:07:37'),
(19, 1, '2023-06-20 21:48:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom_quyen`
--

CREATE TABLE `nhom_quyen` (
  `MaNQ` char(4) NOT NULL,
  `TenNQ` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhom_quyen`
--

INSERT INTO `nhom_quyen` (`MaNQ`, `TenNQ`) VALUES
('admn', 'admin'),
('us01', 'user bat 1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `MaQuyen` char(4) NOT NULL,
  `TenQuyen` varchar(30) NOT NULL,
  `GhiChu` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`MaQuyen`, `TenQuyen`, `GhiChu`) VALUES
('aall', 'them all', NULL),
('ADMI', 'ADMIN', NULL),
('sall', 'Sclect all', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen_nhomquyen`
--

CREATE TABLE `quyen_nhomquyen` (
  `MaNQ` char(4) NOT NULL,
  `MaQuyen` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `quyen_nhomquyen`
--

INSERT INTO `quyen_nhomquyen` (`MaNQ`, `MaQuyen`) VALUES
('us01', 'aall'),
('us01', 'sall'),
('admn', 'ADMI');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `id` int(11) NOT NULL,
  `Ten` varchar(30) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `MatKhau` varchar(40) NOT NULL,
  `AnhDD` varchar(250) DEFAULT NULL,
  `MaNhomQuyen` char(4) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan`
--

INSERT INTO `tai_khoan` (`id`, `Ten`, `Email`, `MatKhau`, `AnhDD`, `MaNhomQuyen`, `about`) VALUES
(1, 'tomjj', 'admin@adimin.com', '12345678', 'Andreana.1687240821.png', 'admn', 'I AM ADMIN'),
(3, 'em', 'em@mail.com', '123456789', NULL, 'us01', 'I AM ADMIN'),
(4, 'emz', 'ezm@mail.com', '123456789', NULL, 'us01', 'I AM ADMIN'),
(5, 'ha', 'hgfd@hjk.vc', '123456789', NULL, 'us01', 'I AM ADMIN'),
(6, 'Fiammetta', 'fiammetta@chicken.egg', '12345678', 'fmeta.png', 'us01', 'I AM CHICKEN'),
(7, 'Duoc', 'Duoc@cave.dd', '12345678', NULL, 'us01', 'I AM ADMIN'),
(8, 'Luot', 'Luot@cave.dd', '12345678', NULL, 'us01', 'I AM ADMIN'),
(9, 'j', 'muc@muc.muc', 'andreana1611', NULL, 'us01', 'I AM ADMIN'),
(12, 'Hello', 'hello@ii.cn', '12345678', 'Andreana.1687235145.png', 'us01', 'hello 3000 ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tap_truyen`
--

CREATE TABLE `tap_truyen` (
  `MaTap` int(11) NOT NULL,
  `TenTap` varchar(30) NOT NULL,
  `TapSo` int(11) NOT NULL,
  `LuocXem` int(11) NOT NULL DEFAULT 0,
  `NgayDang` datetime NOT NULL DEFAULT current_timestamp(),
  `MaCD` char(4) NOT NULL DEFAULT 'cd03',
  `MaTruyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tap_truyen`
--

INSERT INTO `tap_truyen` (`MaTap`, `TenTap`, `TapSo`, `LuocXem`, `NgayDang`, `MaCD`, `MaTruyen`) VALUES
(2, 'ep 2', 2, 0, '2023-06-16 18:07:35', 'cd03', 2),
(9, 'ep 1', 1, 0, '2023-06-20 22:34:32', 'cd03', 18),
(10, 'ep 2', 2, 0, '2023-06-20 22:34:39', 'cd03', 18),
(11, 'ep 3', 3, 0, '2023-06-20 22:34:45', 'cd03', 18),
(12, 'ep 4', 4, 0, '2023-06-20 22:34:51', 'cd03', 18),
(13, 'ep 5', 5, 0, '2023-06-20 22:34:56', 'cd03', 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theo_doi`
--

CREATE TABLE `theo_doi` (
  `NguoiTD` int(11) NOT NULL,
  `NguoiDuocTD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `theo_doi`
--

INSERT INTO `theo_doi` (`NguoiTD`, `NguoiDuocTD`) VALUES
(1, 3),
(1, 6),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(6, 3),
(6, 4),
(6, 5),
(6, 7),
(6, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `the_loai`
--

CREATE TABLE `the_loai` (
  `MaTL` char(4) NOT NULL,
  `TenTL` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `the_loai`
--

INSERT INTO `the_loai` (`MaTL`, `TenTL`) VALUES
('tl01', 'Fantasy'),
('tl02', 'Comic'),
('tl03', 'Drama'),
('tl04', 'Shounen'),
('tl05', 'Cooking'),
('tl06', 'life'),
('tl07', 'Webtoon'),
('tl09', 'Sports'),
('tl10', 'Psychological'),
('tl11', 'TrinhTham'),
('tl12', 'One shot'),
('tl13', 'Mecha'),
('tl14', 'Adventure');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thich`
--

CREATE TABLE `thich` (
  `MaTruyen` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `NgayGio` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `thich`
--

INSERT INTO `thich` (`MaTruyen`, `id`, `NgayGio`) VALUES
(2, 1, '2023-06-19 23:30:05'),
(2, 3, '2023-06-19 23:30:12'),
(3, 7, '2023-06-19 23:30:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thich_bl`
--

CREATE TABLE `thich_bl` (
  `id` int(11) NOT NULL,
  `MaBL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tl_truyen`
--

CREATE TABLE `tl_truyen` (
  `MaTL` char(4) NOT NULL,
  `MaTruyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tl_truyen`
--

INSERT INTO `tl_truyen` (`MaTL`, `MaTruyen`) VALUES
('tl01', 2),
('tl02', 2),
('tl03', 2),
('tl04', 2),
('tl05', 2),
('tl06', 2),
('tl07', 2),
('tl09', 3),
('tl07', 3),
('tl10', 3),
('tl12', 3),
('tl01', 17),
('tl01', 18),
('tl03', 18),
('tl14', 18),
('tl13', 18),
('tl03', 18),
('tl06', 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trang_thai`
--

CREATE TABLE `trang_thai` (
  `MaTT` char(4) NOT NULL,
  `TenTT` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `trang_thai`
--

INSERT INTO `trang_thai` (`MaTT`, `TenTT`) VALUES
('tt01', 'hoàn thành'),
('tt02', 'đang tiến thành');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trang_truyen`
--

CREATE TABLE `trang_truyen` (
  `MaTrang` int(11) NOT NULL,
  `Trang` varchar(250) NOT NULL,
  `SoTrang` smallint(6) NOT NULL,
  `MaTap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `trang_truyen`
--

INSERT INTO `trang_truyen` (`MaTrang`, `Trang`, `SoTrang`, `MaTap`) VALUES
(29, '155.png', 1, 9),
(30, 'Andreana.png', 2, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tra_loi`
--

CREATE TABLE `tra_loi` (
  `MaTraLoi` int(11) NOT NULL,
  `MaBL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `truyen`
--

CREATE TABLE `truyen` (
  `MaTruyen` int(11) NOT NULL,
  `TenTruyen` varchar(30) NOT NULL,
  `AnhBia` varchar(250) NOT NULL,
  `NoiDung` text NOT NULL,
  `id` int(11) NOT NULL,
  `MaTT` char(4) NOT NULL DEFAULT 'tt02',
  `MaCD` char(4) NOT NULL DEFAULT 'cd03',
  `NgayTao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `truyen`
--

INSERT INTO `truyen` (`MaTruyen`, `TenTruyen`, `AnhBia`, `NoiDung`, `id`, `MaTT`, `MaCD`, `NgayTao`) VALUES
(2, '#01', 'KAF.png', 'test', 1, 'tt01', 'cd03', '2023-06-16 18:03:05'),
(3, '#02', 'KyoyamaKazusa.jpg', 'test2', 1, 'tt01', 'cd03', '2023-06-16 18:04:39'),
(17, 'KAF', 'kaf2.1687269832.jpg', 'nothing', 1, 'tt02', 'cd03', '2023-06-20 21:03:52'),
(18, 'RIM', 'RIM-2th.1687269868.png', 'nothing', 1, 'tt02', 'cd03', '2023-06-20 21:04:28'),
(19, 'Shiroko', 'Shiroko.png', 'nothing', 6, 'tt02', 'cd03', '2023-06-20 21:06:28'),
(20, 'unnamed', '#6KAFXC.png', 'a', 1, 'tt02', 'cd03', '2023-06-20 21:09:27');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`MaBL`),
  ADD KEY `bl-tk` (`id`),
  ADD KEY `bl-truyen` (`MaTruyen`);

--
-- Chỉ mục cho bảng `cd_thien_thi`
--
ALTER TABLE `cd_thien_thi`
  ADD PRIMARY KEY (`MaCD`);

--
-- Chỉ mục cho bảng `da_xem`
--
ALTER TABLE `da_xem`
  ADD KEY `dx-tk` (`id`),
  ADD KEY `dx-tr` (`MaTap`);

--
-- Chỉ mục cho bảng `luu`
--
ALTER TABLE `luu`
  ADD KEY `luu-tk` (`id`),
  ADD KEY `luu-truyen` (`MaTruyen`);

--
-- Chỉ mục cho bảng `nhom_quyen`
--
ALTER TABLE `nhom_quyen`
  ADD PRIMARY KEY (`MaNQ`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`MaQuyen`);

--
-- Chỉ mục cho bảng `quyen_nhomquyen`
--
ALTER TABLE `quyen_nhomquyen`
  ADD KEY `Quyen` (`MaQuyen`),
  ADD KEY `NhomQuyen-mqh` (`MaNQ`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Ten` (`Ten`),
  ADD KEY `NhomQuyen-tk` (`MaNhomQuyen`);

--
-- Chỉ mục cho bảng `tap_truyen`
--
ALTER TABLE `tap_truyen`
  ADD PRIMARY KEY (`MaTap`),
  ADD KEY `truyen-tapTruyen` (`MaTruyen`),
  ADD KEY `MaCD-tapTruyen` (`MaCD`);

--
-- Chỉ mục cho bảng `theo_doi`
--
ALTER TABLE `theo_doi`
  ADD PRIMARY KEY (`NguoiTD`,`NguoiDuocTD`),
  ADD KEY `NguoiDuocTD` (`NguoiDuocTD`);

--
-- Chỉ mục cho bảng `the_loai`
--
ALTER TABLE `the_loai`
  ADD PRIMARY KEY (`MaTL`);

--
-- Chỉ mục cho bảng `thich`
--
ALTER TABLE `thich`
  ADD KEY `thich-tk` (`id`),
  ADD KEY `thich-truyen` (`MaTruyen`);

--
-- Chỉ mục cho bảng `thich_bl`
--
ALTER TABLE `thich_bl`
  ADD KEY `thichbl-bl` (`MaBL`),
  ADD KEY `thichbl-tk` (`id`);

--
-- Chỉ mục cho bảng `tl_truyen`
--
ALTER TABLE `tl_truyen`
  ADD KEY `TL` (`MaTL`),
  ADD KEY `mt-tl` (`MaTruyen`);

--
-- Chỉ mục cho bảng `trang_thai`
--
ALTER TABLE `trang_thai`
  ADD PRIMARY KEY (`MaTT`);

--
-- Chỉ mục cho bảng `trang_truyen`
--
ALTER TABLE `trang_truyen`
  ADD PRIMARY KEY (`MaTrang`),
  ADD KEY `Tap-Trang` (`MaTap`);

--
-- Chỉ mục cho bảng `tra_loi`
--
ALTER TABLE `tra_loi`
  ADD PRIMARY KEY (`MaTraLoi`,`MaBL`),
  ADD KEY `tl-bl` (`MaBL`);

--
-- Chỉ mục cho bảng `truyen`
--
ALTER TABLE `truyen`
  ADD PRIMARY KEY (`MaTruyen`),
  ADD KEY `CDTT-Truyen` (`MaCD`),
  ADD KEY `TT-Truyen` (`MaTT`),
  ADD KEY `tac_gia` (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `MaBL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tap_truyen`
--
ALTER TABLE `tap_truyen`
  MODIFY `MaTap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `trang_truyen`
--
ALTER TABLE `trang_truyen`
  MODIFY `MaTrang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `truyen`
--
ALTER TABLE `truyen`
  MODIFY `MaTruyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `bl-tk` FOREIGN KEY (`id`) REFERENCES `tai_khoan` (`id`),
  ADD CONSTRAINT `bl-truyen` FOREIGN KEY (`MaTruyen`) REFERENCES `truyen` (`MaTruyen`);

--
-- Các ràng buộc cho bảng `da_xem`
--
ALTER TABLE `da_xem`
  ADD CONSTRAINT `dx-tk` FOREIGN KEY (`id`) REFERENCES `tai_khoan` (`id`),
  ADD CONSTRAINT `dx-tr` FOREIGN KEY (`MaTap`) REFERENCES `tap_truyen` (`MaTap`);

--
-- Các ràng buộc cho bảng `luu`
--
ALTER TABLE `luu`
  ADD CONSTRAINT `luu-tk` FOREIGN KEY (`id`) REFERENCES `tai_khoan` (`id`),
  ADD CONSTRAINT `luu-truyen` FOREIGN KEY (`MaTruyen`) REFERENCES `truyen` (`MaTruyen`);

--
-- Các ràng buộc cho bảng `quyen_nhomquyen`
--
ALTER TABLE `quyen_nhomquyen`
  ADD CONSTRAINT `NhomQuyen-mqh` FOREIGN KEY (`MaNQ`) REFERENCES `nhom_quyen` (`MaNQ`),
  ADD CONSTRAINT `Quyen` FOREIGN KEY (`MaQuyen`) REFERENCES `quyen` (`MaQuyen`);

--
-- Các ràng buộc cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD CONSTRAINT `NhomQuyen-tk` FOREIGN KEY (`MaNhomQuyen`) REFERENCES `nhom_quyen` (`MaNQ`);

--
-- Các ràng buộc cho bảng `tap_truyen`
--
ALTER TABLE `tap_truyen`
  ADD CONSTRAINT `MaCD-tapTruyen` FOREIGN KEY (`MaCD`) REFERENCES `cd_thien_thi` (`MaCD`),
  ADD CONSTRAINT `truyen-tapTruyen` FOREIGN KEY (`MaTruyen`) REFERENCES `truyen` (`MaTruyen`);

--
-- Các ràng buộc cho bảng `theo_doi`
--
ALTER TABLE `theo_doi`
  ADD CONSTRAINT `NguoiDuocTD` FOREIGN KEY (`NguoiDuocTD`) REFERENCES `tai_khoan` (`id`),
  ADD CONSTRAINT `NguoiTD` FOREIGN KEY (`NguoiTD`) REFERENCES `tai_khoan` (`id`);

--
-- Các ràng buộc cho bảng `thich`
--
ALTER TABLE `thich`
  ADD CONSTRAINT `thich-tk` FOREIGN KEY (`id`) REFERENCES `tai_khoan` (`id`),
  ADD CONSTRAINT `thich-truyen` FOREIGN KEY (`MaTruyen`) REFERENCES `truyen` (`MaTruyen`);

--
-- Các ràng buộc cho bảng `thich_bl`
--
ALTER TABLE `thich_bl`
  ADD CONSTRAINT `thichbl-bl` FOREIGN KEY (`MaBL`) REFERENCES `binh_luan` (`MaBL`),
  ADD CONSTRAINT `thichbl-tk` FOREIGN KEY (`id`) REFERENCES `tai_khoan` (`id`);

--
-- Các ràng buộc cho bảng `tl_truyen`
--
ALTER TABLE `tl_truyen`
  ADD CONSTRAINT `TL` FOREIGN KEY (`MaTL`) REFERENCES `the_loai` (`MaTL`),
  ADD CONSTRAINT `mt-tl` FOREIGN KEY (`MaTruyen`) REFERENCES `truyen` (`MaTruyen`);

--
-- Các ràng buộc cho bảng `trang_truyen`
--
ALTER TABLE `trang_truyen`
  ADD CONSTRAINT `Tap-Trang` FOREIGN KEY (`MaTap`) REFERENCES `tap_truyen` (`MaTap`);

--
-- Các ràng buộc cho bảng `tra_loi`
--
ALTER TABLE `tra_loi`
  ADD CONSTRAINT `tl-bl` FOREIGN KEY (`MaBL`) REFERENCES `binh_luan` (`MaBL`),
  ADD CONSTRAINT `tl-traloibl` FOREIGN KEY (`MaTraLoi`) REFERENCES `binh_luan` (`MaBL`);

--
-- Các ràng buộc cho bảng `truyen`
--
ALTER TABLE `truyen`
  ADD CONSTRAINT `CDTT-Truyen` FOREIGN KEY (`MaCD`) REFERENCES `cd_thien_thi` (`MaCD`),
  ADD CONSTRAINT `TT-Truyen` FOREIGN KEY (`MaTT`) REFERENCES `trang_thai` (`MaTT`),
  ADD CONSTRAINT `tac_gia` FOREIGN KEY (`id`) REFERENCES `tai_khoan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
