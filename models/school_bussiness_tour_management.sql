-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 17, 2024 lúc 08:20 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `school_bussiness_tour_management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `accountID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`accountID`, `username`, `password`, `role`) VALUES
(1, 'admin', '123', 'Toàn quyền hệ thống'),
(2, 'normal1', '123', 'Quản lí thông thường'),
(4, 'SV01', '123', 'Tài khoản sinh viên'),
(5, 'GV01', '12345', 'Tài khoản giáo viên'),
(6, 'GV02', 'GV02', 'Tài khoản giáo viên'),
(7, 'SV02', 'SV02', 'Tài khoản sinh viên'),
(9, 'SV03', 'SV03', 'Tài khoản sinh viên'),
(10, 'SV04', 'SV04', 'Tài khoản sinh viên'),
(11, 'SV21', 'SV21', 'Tài khoản sinh viên'),
(12, 'SV05', 'SV05', 'Tài khoản sinh viên'),
(13, 'GV04', 'GV04', 'Tài khoản giáo viên'),
(14, 'GV04', 'GV04', 'Tài khoản giáo viên'),
(15, 'GV05', 'GV05', 'Tài khoản giáo viên'),
(16, 'GV06', 'GV06', 'Tài khoản giáo viên'),
(17, 'GV07', 'GV07', 'Tài khoản giáo viên'),
(18, 'GV08', 'GV08', 'Tài khoản giáo viên'),
(19, 'GV09', 'GV09', 'Tài khoản giáo viên'),
(20, 'GV10', 'GV10', 'Tài khoản giáo viên'),
(21, 'GV11', 'GV11', 'Tài khoản giáo viên'),
(22, 'GV12', 'GV12', 'Tài khoản giáo viên'),
(23, 'GV13', 'GV13', 'Tài khoản giáo viên'),
(24, 'GV14', 'GV14', 'Tài khoản giáo viên'),
(25, 'GV15', 'GV15', 'Tài khoản giáo viên'),
(26, 'SV06', 'SV06', 'Tài khoản sinh viên'),
(27, 'SV07', 'SV07', 'Tài khoản sinh viên'),
(28, 'SV08', 'SV08', 'Tài khoản sinh viên'),
(29, 'SV09', 'SV09', 'Tài khoản sinh viên'),
(30, 'SV10', 'SV10', 'Tài khoản sinh viên'),
(31, 'SV11', 'SV11', 'Tài khoản sinh viên'),
(32, 'SV12', 'SV12', 'Tài khoản sinh viên'),
(33, 'SV13', 'SV13', 'Tài khoản sinh viên'),
(34, 'SV14', 'SV14', 'Tài khoản sinh viên'),
(35, 'SV15', 'SV15', 'Tài khoản sinh viên'),
(36, 'SV16', 'SV16', 'Tài khoản sinh viên'),
(37, 'SV17', 'SV17', 'Tài khoản sinh viên'),
(38, 'SV18', 'SV18', 'Tài khoản sinh viên'),
(39, 'SV19', 'SV19', 'Tài khoản sinh viên'),
(40, 'SV20', 'SV20', 'Tài khoản sinh viên'),
(41, 'SV21', 'SV21', 'Tài khoản sinh viên'),
(42, 'GV16', 'GV16', 'Tài khoản giáo viên'),
(43, 'GV17', 'GV17', 'Tài khoản giáo viên'),
(44, 'GV18', 'GV18', 'Tài khoản giáo viên'),
(45, 'GV19', 'GV19', 'Tài khoản giáo viên'),
(46, 'GV20', 'GV20', 'Tài khoản giáo viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class`
--

CREATE TABLE `class` (
  `classID` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `class`
--

INSERT INTO `class` (`classID`, `code`, `name`) VALUES
(1, 'CNTT01', 'Công nghệ thông tin 01'),
(2, 'CNTT02', 'Công nghệ thông tin 02'),
(3, 'CNTT03', 'Công nghệ thông tin 03'),
(4, 'CNTT04', 'Công nghệ thông tin 04'),
(5, 'CNTT05', 'Công nghệ thông tin 05'),
(6, 'CNTT06', 'Công nghệ thông tin 06'),
(7, 'CNTT07', 'Công nghệ thông tin 07'),
(8, 'KTPM01', 'Kỹ thuật phần mềm 01'),
(9, 'KTPM02', 'Kỹ thuật phần mềm 02'),
(10, 'KTPM03', 'Kỹ thuật phần mềm 03'),
(11, 'KTPM04', 'Kỹ thuật phần mềm 04'),
(12, 'KHMT01', 'Khoa học máy tính 01'),
(13, 'KHMT02', 'Khoa học máy tính 02'),
(14, 'KHMT03', 'Khoa học máy tính 03'),
(15, 'HTTT01', 'Hệ thống thông tin 01'),
(16, 'HTTT02', 'Hệ thống thông tin 02'),
(17, 'CNDPT01', 'Công nghệ đa phương tiện 01'),
(18, 'CNDPT02', 'Công nghệ đa phương tiện 02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `company`
--

CREATE TABLE `company` (
  `companyID` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `company`
--

INSERT INTO `company` (`companyID`, `code`, `name`, `description`, `email`, `phoneNumber`, `address`) VALUES
(1, 'DN01', 'Viettel', '', 'Viettel@gmail.com', '123456789', 'Hà Nội'),
(2, 'DN02', 'FPT', '', 'FPT@gmail.com', '123456789', 'Hà Nội'),
(3, 'DN03', 'VCCorp', '', 'VCCorp@gmail.com', '0321654987', 'Hà Nội'),
(4, 'DN04', 'TMA Solutions', '', 'TMASolutions@gmail.com', '02473061888', 'Hải Dương'),
(5, 'DN05', 'VNG Corporation', '', 'VNGCorporation@gmail.com', '02873000089', 'Hải Phòng'),
(6, 'DN06', 'Nexle Corporation', '', 'NexleCorporation@gmail.com', '02873031979', 'Huế'),
(7, 'DN07', 'KMS Technology', '', 'KMSTechnology@gmail.com', '02873021300', 'Đà Nẵng'),
(8, 'DN08', 'VinTech', '', 'VinTech@gmail.com', '02473062626', 'Hà Đông'),
(9, 'DN09', 'VSEC', '', 'VSEC@gmail.com', '02473005118', 'Hà Nam'),
(10, 'DN10', 'Kyanon Digital', '', 'Kyanon Digital@gmail.com', '02835171080', 'Hồ Chí Minh'),
(11, 'DN11', 'SotaTek', '', 'SotaTek@gmail.com', '02466585248', 'Hà Nội'),
(12, 'DN12', 'Beetsoft', '', 'Beetsoft@gmail.com', '02435545190', 'Hà Nội'),
(13, 'DN13', 'NIFTIT', '', 'NIFTIT@gmail.com', '01208554880', 'Hồ Chí Minh'),
(14, 'DN14', 'CyStack Security', '', 'CyStackSecurity@gmail.com', '02471099656', 'Hà Nội'),
(15, 'DN15', 'NFQ Asia', '', 'NFQAsia@gmail.com', '02866812733', 'Hồ Chí Minh'),
(16, 'DN16', 'VinBigdata', '', 'VinBigdata@gmail.com', '0338557202', 'Hà Nội'),
(17, 'DN17', 'Nissho Vietnam', '', 'NisshoVietnam@gmail.com', '02435563737', 'Hà Nội'),
(18, 'DN18', 'TOG recruitment', '', 'TOGrecruitment@gmail.com', '0268554053', 'Hồ Chí Minh'),
(19, 'DN19', 'Merkle Vietnam', '', 'MerkleVietnam@gmail.com', '02839483630', 'Hồ Chí Minh'),
(20, 'DN20', 'VNext Software', '', 'VNextSoftware@gmail.com', '024 3765 9555', 'Hà Nội');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `birthDate` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `classID` int(11) DEFAULT NULL,
  `accountID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`studentID`, `code`, `fullName`, `avatar`, `birthDate`, `address`, `phoneNumber`, `email`, `classID`, `accountID`) VALUES
(1, 'SV01', 'Tăng Khánh Linh', '', '22/12/2003', 'Hưng Yên', '0987654321', 'khanhlinh@haui.com', 1, 4),
(2, 'SV02', 'Nguyễn Thị Trang', '', '12/10/2003', 'Hưng Yên', '0123456789', 'trang@gmail.com', 3, 7),
(3, 'SV03', 'Lê Thị Ngọc Ánh', '', '11/10/2003', 'Thanh Hóa', '0125847369', 'anh@gmail.com', 4, 11),
(4, 'SV04', 'Nguyễn Thị Trang', '', '12/10/2003', 'Hưng Yên', '0123654789', 'trang@gmail.com', 3, 10),
(5, 'SV05', 'Đinh Tuấn Đạt', '', '1/1/2003', 'Hà Nội', '0147258369', 'dat@gmail.com', 1, 12),
(6, 'SV06', 'Lương Minh Anh', '', '30/10/2003', 'Hà Nội', '036974125', 'anh@gmail.com', 1, 26),
(7, 'SV07', 'Đinh Anh Minh', '', '16/10/2003', 'Hải Phòng', '0147963258', 'minh@gmail.com', 2, 27),
(8, 'SV08', 'Hoàng Lan Hương', '', '16/10/2003', 'Hưng Yên', '0456789123', 'huong@gmail.com', 3, 28),
(9, 'SV09', 'Giang SeoChinh', '', '16/10/2003', 'Hà Nam', '0147258369', 'hoang@gmail.com', 5, 29),
(10, 'SV10', 'Hoàng Văn Sơn', '', '16/10/2003', 'Tây Nguyên', '0258796413', 'son@gmail.com', 6, 30),
(11, 'SV11', 'Dương Văn Vũ', '', '19/2/2003', 'Quảng Ninh', '0789654123', 'vu@gmail.com', 7, 31),
(12, 'SV12', 'Nguyễn Thị Thương', '', '16/4/2003', 'Huế', '0147863259', 'thuong@gmail.com', 8, 32),
(13, 'SV13', 'Nguyễn Thị Hạnh', '', '16/09/2003', 'Thành Phố HCM', '0569874123', 'hanh@gmail.com', 2, 33),
(14, 'SV14', 'Nguyễn Vương Quyến', '', '20/1/2003', 'Lạng Sơn', '0258741369', 'quyen@gmail.com', 3, 34),
(15, 'SV15', 'Đặng Gia Bảo', '', '16/0/2003', 'Thanh Hóa', '0258741369', 'bao@gmail.com', 4, 35),
(16, 'SV16', 'Hạ Quang Anh', '', '12/03/2003', 'Tuyên Quang', '0258741369', 'anh@gmail.com', 5, 36),
(17, 'SV17', 'Lê Anh Hùng', '', '12/04/2003', 'Hải Dương', '0236987451', 'hung@gmail.com', 6, 37),
(18, 'SV18', 'Cao Đặng Trí', '', '25/09/2003', 'Hà Nội', '0258741369', 'tri@gmail.com', 7, 38),
(19, 'SV19', 'Phương Quỳnh Anh', '', '26/01/2003', 'Hà Nam', '0258749632', 'qanh@gmail.com', 8, 39),
(20, 'SV20', 'Cao Hoàng Đức', '', '30/8/2003', 'Hải Phòng', '0147852369', 'hduc@gmail.com', 7, 40);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_tour`
--

CREATE TABLE `student_tour` (
  `studentID` int(11) NOT NULL,
  `tourID` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_tour`
--

INSERT INTO `student_tour` (`studentID`, `tourID`, `rate`) VALUES
(2, 1, 0),
(2, 2, 0),
(2, 3, 0),
(2, 4, 0),
(2, 5, 0),
(2, 6, 85),
(2, 7, 0),
(2, 10, 0),
(2, 14, 0),
(2, 15, 0),
(2, 16, 0),
(2, 17, 0),
(2, 20, 0),
(3, 1, 0),
(3, 2, 0),
(3, 3, 0),
(3, 4, 0),
(3, 6, 65),
(3, 10, 0),
(3, 15, 0),
(3, 16, 0),
(3, 17, 0),
(3, 20, 0),
(4, 1, 0),
(4, 2, 0),
(4, 3, 0),
(4, 4, 0),
(4, 6, 95),
(4, 10, 0),
(4, 15, 0),
(4, 16, 0),
(4, 17, 0),
(4, 20, 0),
(5, 1, 0),
(5, 2, 0),
(5, 3, 0),
(5, 4, 0),
(5, 6, 96),
(5, 10, 0),
(5, 15, 0),
(5, 16, 0),
(5, 17, 0),
(5, 20, 0),
(6, 1, 0),
(6, 2, 0),
(6, 3, 0),
(6, 4, 0),
(6, 8, 0),
(6, 10, 0),
(6, 15, 0),
(6, 16, 0),
(6, 17, 0),
(6, 20, 0),
(7, 1, 0),
(7, 2, 0),
(7, 3, 0),
(7, 4, 0),
(7, 8, 0),
(7, 10, 0),
(7, 15, 0),
(7, 16, 0),
(7, 17, 0),
(7, 20, 0),
(8, 1, 0),
(8, 2, 0),
(8, 3, 0),
(8, 4, 0),
(8, 8, 0),
(8, 10, 0),
(8, 15, 0),
(8, 16, 0),
(8, 17, 0),
(8, 20, 0),
(9, 1, 0),
(9, 2, 0),
(9, 3, 0),
(9, 4, 0),
(9, 8, 0),
(9, 10, 0),
(9, 15, 0),
(9, 16, 0),
(9, 17, 0),
(9, 20, 0),
(10, 1, 0),
(10, 2, 0),
(10, 3, 0),
(10, 4, 0),
(10, 8, 0),
(10, 11, 0),
(10, 15, 0),
(10, 16, 0),
(10, 17, 0),
(10, 20, 0),
(11, 1, 0),
(11, 2, 0),
(11, 3, 0),
(11, 4, 0),
(11, 8, 0),
(11, 9, 0),
(11, 11, 0),
(11, 14, 0),
(11, 15, 0),
(11, 16, 0),
(11, 17, 0),
(11, 19, 0),
(11, 20, 0),
(12, 1, 0),
(12, 2, 0),
(12, 3, 0),
(12, 5, 0),
(12, 8, 0),
(12, 9, 0),
(12, 11, 0),
(12, 14, 0),
(12, 15, 0),
(12, 16, 0),
(12, 17, 0),
(12, 19, 0),
(12, 20, 0),
(13, 1, 0),
(13, 2, 0),
(13, 3, 0),
(13, 5, 0),
(13, 8, 0),
(13, 9, 0),
(13, 11, 0),
(13, 14, 0),
(13, 15, 0),
(13, 16, 0),
(13, 19, 0),
(13, 20, 0),
(14, 1, 0),
(14, 2, 0),
(14, 3, 0),
(14, 5, 0),
(14, 8, 0),
(14, 9, 0),
(14, 11, 0),
(14, 14, 0),
(14, 15, 0),
(14, 16, 0),
(14, 18, 0),
(14, 20, 0),
(15, 1, 0),
(15, 2, 0),
(15, 3, 0),
(15, 5, 0),
(15, 8, 0),
(15, 9, 0),
(15, 11, 0),
(15, 14, 0),
(15, 15, 0),
(15, 16, 0),
(15, 18, 0),
(15, 20, 0),
(16, 1, 0),
(16, 2, 0),
(16, 3, 0),
(16, 5, 0),
(16, 8, 0),
(16, 9, 0),
(16, 11, 0),
(16, 12, 0),
(16, 13, 0),
(16, 15, 0),
(16, 16, 0),
(16, 18, 0),
(16, 20, 0),
(17, 1, 0),
(17, 2, 0),
(17, 3, 0),
(17, 5, 0),
(17, 9, 0),
(17, 12, 0),
(17, 13, 0),
(17, 15, 0),
(17, 16, 0),
(17, 18, 0),
(17, 20, 0),
(18, 1, 0),
(18, 2, 0),
(18, 3, 0),
(18, 5, 0),
(18, 9, 0),
(18, 12, 0),
(18, 13, 0),
(18, 15, 0),
(18, 16, 0),
(18, 18, 0),
(18, 20, 0),
(19, 1, 0),
(19, 2, 0),
(19, 3, 0),
(19, 5, 0),
(19, 9, 0),
(19, 12, 0),
(19, 13, 0),
(19, 15, 0),
(19, 16, 0),
(19, 18, 0),
(19, 20, 0),
(20, 1, 0),
(20, 2, 0),
(20, 3, 0),
(20, 5, 0),
(20, 9, 0),
(20, 12, 0),
(20, 13, 0),
(20, 15, 0),
(20, 16, 0),
(20, 18, 0),
(20, 20, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacher`
--

CREATE TABLE `teacher` (
  `teacherID` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `birthDate` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `accountID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `teacher`
--

INSERT INTO `teacher` (`teacherID`, `code`, `fullName`, `avatar`, `birthDate`, `address`, `phoneNumber`, `email`, `accountID`) VALUES
(1, 'GV01', 'Nguyễn Thị Lan Anh', '', '12/06/1988', 'Hà Nội', '0123456789', 'lananh@gmail.com', 5),
(2, 'GV02', 'Trần Thị Hằng', '', '23/02/1986', 'Hà Nam', '0123456988', 'tranhang@gmail.com', 6),
(3, 'GV03', 'Đỗ Mạnh Quang', '', '16/05/1998', 'Hà Nội', '0123456898', 'manhquang@gmail.com', 14),
(4, 'GV04', 'Trần Việt Thắng', '', '15/08/1982', 'Hà Nội', '0123467897', 'vietthang@gmail.com', 15),
(5, 'GV05', 'Nguyễn Thế Anh', '', '14/03/1980', 'Hà Nội', '0123456456', 'theanh@gmail.com', 13),
(6, 'GV06', 'Hoàng Quang Huy', '', '30/01/1985', 'Hà Nội', '0123123456', 'quanghuy@gmail.com', 16),
(7, 'GV07', 'Nguyễn Thị Nhung', '', '16/08/1984', 'Hà Nội', '0123654789', 'nguyennhung@gmail.com', 17),
(8, 'GV08', 'Trần Văn Hùng', '', '15/05/1980', 'Hà Nội', '0123658794', 'tranhung@gmail.com', 18),
(9, 'GV09', 'Dương Thị Yến', '', '11/03/1988', 'Hà Nội', '0123658946', 'duongyen@gmail.com', 19),
(10, 'GV10', 'Ngô Thế Hưởng', '', '15/05/1982', 'Hà Nội', '01597532684', 'ngohuong@gmail.com', 20),
(11, 'GV11', 'Hà Nam Hải', '', '15/05/1982', 'Hà Nội', '0123698585', 'hahai@gmail.com', 21),
(12, 'GV12', 'Mã Văn Tiến', '', '15/05/1982', 'Hà Nội', '0258963698', 'matien@gmail.com', 22),
(13, 'GV13', 'Bùi Quang Thưởng', '', '15/05/1982', 'Hà Nội', '0321587478', 'buithuong@gmail.com', 23),
(14, 'GV14', 'Bá Văn Hiển', '', '15/05/1982', 'Hà Nội', '0357841265', 'bahien@gmail.com', 24),
(15, 'GV15', 'Đào Bá Lộc', '', '15/05/1982', 'Hà Nội', '0321596857', 'daoloc@gmail.com', 25),
(16, 'GV16', 'Dương Văn Nam', '', '15/05/1982', 'Hà Nội', '0321562486', 'duongnam@gmail.com', 42),
(17, 'GV17', 'Lê La La', '', '15/05/1982', 'Hà Nội', '0369852147', 'lela@gmail.com', 43),
(18, 'GV18', 'Vũ Ngọc Hà', '', '15/05/1982', 'Hà Nội', '0147852369', 'vuha@gmail.com', 44),
(19, 'GV19', 'Lý Nam Nhàn', '', '15/05/1982', 'Hà Nội', '0258741963', 'lynam@gmail.com', 45),
(20, 'GV20', 'Trần Huỳnh Như', '', '15/05/1982', 'Hà Nội', '0123654852', 'trannhu@gmail.com', 46);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tour`
--

CREATE TABLE `tour` (
  `tourID` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `startDate` datetime NOT NULL,
  `presentator` varchar(100) NOT NULL,
  `availables` int(11) NOT NULL,
  `companyID` int(11) DEFAULT NULL,
  `teacherID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tour`
--

INSERT INTO `tour` (`tourID`, `code`, `name`, `description`, `startDate`, `presentator`, `availables`, `companyID`, `teacherID`) VALUES
(1, 'T2024IT001', 'Chương trình trải nghiệm thực tế tại Doanh nghiệp Công ty TNHH Công nghiệp Brother Việt Nam năm 2024', 'SV xem xét kế hoạch học tập và đọc kỹ Thông báo tiếp nhận SV trải nghiệm thực tế\r\n\r\n- Tham dự buổi g', '2024-08-07 13:44:34', 'Tổng giám đốc', 150, 9, 18),
(2, 'T2024IT00110', 'Tham quan KMS Technology', 'Không có', '2024-06-17 20:11:29', 'Quản lý phòng đối ngoại', 80, 13, 17),
(3, 'T2024IT00119', 'KMS Technology đồng hành cùng khoa Công Nghệ Thông tin trường Đại học Công Nghiệp Hà Nội tổ chức tha', 'SV xem xét kế hoạch học tập và đọc kỹ Thông báo tiếp nhận SV trải nghiệm thực tế', '2024-08-07 13:44:34', 'Tổng giám đốc', 150, 9, 18),
(4, 'T2024IT002', 'Chương trình trải nghiệm thực tế tại Doanh nghiệp Công ty TNHH VCCorp năm 2024', 'SV xem xét kế hoạch học tập và đọc kỹ Thông báo tiếp nhận SV trải nghiệm thực tế\r\n\r\n- Tham dự buổi g', '2024-05-17 08:44:34', 'Trưởng phòng nhân sự', 200, 10, 10),
(5, 'T2024IT003', 'Tổ chức trải nghiệm thực tế cho Sinh viên năm 2024 tại Viettel', 'SV đọc kỹ thông báo chương trình trải nghiệm thực tế và mỗi SV chỉ đăng ký tham gia trải nghiệm tại ', '2024-06-02 13:50:10', 'Quản lý phòng đối ngoại', 75, 1, 15),
(6, 'T2024IT004', 'tổ chức trải nghiệm thực tế cho Sinh viên năm 2024 tại Nissho Vietnam', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-06-20 13:50:10', 'Bộ phận tuyển dụng nhân sự công ty nissho', 30, 17, 7),
(7, 'T2024IT0017', 'Tổ chức trải nghiệm thực tế cho Sinh viên năm 2024 tại Viettel', 'SV đọc kỹ thông báo chương trình trải nghiệm thực tế và mỗi SV chỉ đăng ký tham gia trải nghiệm tại ', '2024-06-02 13:50:10', 'Quản lý phòng đối ngoại', 75, 1, 15),
(8, 'T2024IT0018', 'tổ chức trải nghiệm thực tế cho Sinh viên năm 2024 tại Nissho Vietnam', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-06-20 13:50:10', 'Bộ phận tuyển dụng nhân sự công ty nissho', 30, 17, 7),
(9, 'T2024IT005', 'Tổ chức trải nghiệm thực tế cho Sinh viên hè tháng 6', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-06-21 13:55:02', 'Trưởng phòng nhân sự VinBigdata', 25, 16, 7),
(10, 'T2024IT006', 'Tổ chức trải nghiệm thực tế cho Sinh viên hè tháng 7', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-06-30 13:55:02', 'bộ phận đối ngoại VinTech .inc', 50, 8, 5),
(11, 'T2024IT007', 'Tổ chức trải nghiệm FPT Com thực tế cho Sinh viên hè tháng 6 tại công ty Công nghệ phần mềm hà nội', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-06-29 13:59:07', 'NGuyễn Ngọc Hà - Thư ký phòng truyền thông đối ngoại công ty FPT', 40, 2, 17),
(12, 'T2024IT008', 'Tổ chức trải nghiệm thực tế cho Sinh viên Kỳ xuân tháng 12 tại công ty Công nghệ phần mềm hà nội', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-12-01 13:59:07', 'NGuyễn Ngọc Hà - Thư ký phòng truyền thông đối ngoại công ty FPT', 70, 2, 4),
(13, 'T2024IT009', 'VNG Corporation Tổ chức trải nghiệm thực tế cho Sinh viên hè ', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-06-07 08:58:55', 'Thư ký Trần Hưng công ty VNG Corporation ', 50, 5, 6),
(14, 'T2024IT010', 'VNG Corporation kết hơp cùng trường Đại học Công Nghiệp Hà Nội tổ chức tham quan công ty tại Hải Phò', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-12-05 08:58:55', 'Thư ký Trần Hưng - Công ty VNG Corporation', 100, 5, 3),
(15, 'T2024IT011', 'Tổ chức trải nghiệm thực tế Tại Beetsoft cho Sinh viên sắp thực tập doanh nghiệp năm học 2024', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-06-29 08:58:55', 'Bộ phận đối ngoại truyền thông công ty Beetsoft', 35, 12, 3),
(16, 'T2024IT012', 'Tổ chức trải nghiệm thực tế Tại Beetsoft cho Sinh viên sắp thực tập doanh nghiệp năm học 2024 Đợt 2 ', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-09-19 08:58:55', 'Bộ phận đối ngoại truyền thông công ty Beetsoft', 80, 12, 15),
(17, 'T2024IT013', 'Trường tổ chức tham quan doanh nghiệp cho đối tượng sinh viên K16, K17, K18 và sinh viên hệ cao đẳng', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-07-06 08:58:55', 'Nguyễn Văn Nam, bộ phận tuyển dụng công ty KMS Technology', 74, 7, 14),
(18, 'T2024IT014', 'Trường HaUI tổ chức tham quan doanh nghiệp cho đối tượng sinh viên K16, K17, K18 và sinh viên hệ cao', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-09-14 08:58:55', 'Nguyễn Văn Nam, bộ phận tuyển dụng công ty KMS Technology', 30, 7, 6),
(19, 'T2024IT015', 'Tổ chức trải nghiệm thực tế tham quan \r\nSotaTek: Global Blockchain and Software Development', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-08-03 08:58:55', 'Bộ phận đối ngoại truyền thông công ty SotaTek', 60, 11, 11),
(20, 'T2024IT016', 'Tổ chức trải nghiệm thực tế cho Sinh viên Năm nhất 2024, K19 tại VNext Software', 'Mọi chi tiết liên hệ: Phòng Hợp tác đối ngoại – Trường Đại học Công nghiệp Hà Nội: 0989 666 078 (Thầ', '2024-05-26 08:58:55', 'Bộ phận đối ngoại truyền thông công ty VNext Software', 25, 20, 19);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accountID`);

--
-- Chỉ mục cho bảng `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classID`);

--
-- Chỉ mục cho bảng `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyID`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `classID` (`classID`),
  ADD KEY `accountID` (`accountID`);

--
-- Chỉ mục cho bảng `student_tour`
--
ALTER TABLE `student_tour`
  ADD PRIMARY KEY (`studentID`,`tourID`),
  ADD KEY `tourID` (`tourID`);

--
-- Chỉ mục cho bảng `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherID`),
  ADD KEY `accountID` (`accountID`);

--
-- Chỉ mục cho bảng `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`tourID`),
  ADD KEY `teacherID` (`teacherID`),
  ADD KEY `companyID` (`companyID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `class`
--
ALTER TABLE `class`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `company`
--
ALTER TABLE `company`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tour`
--
ALTER TABLE `tour`
  MODIFY `tourID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `class` (`classID`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`);

--
-- Các ràng buộc cho bảng `student_tour`
--
ALTER TABLE `student_tour`
  ADD CONSTRAINT `student_tour_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`),
  ADD CONSTRAINT `student_tour_ibfk_2` FOREIGN KEY (`tourID`) REFERENCES `tour` (`tourID`);

--
-- Các ràng buộc cho bảng `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`);

--
-- Các ràng buộc cho bảng `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `tour_ibfk_1` FOREIGN KEY (`teacherID`) REFERENCES `teacher` (`teacherID`),
  ADD CONSTRAINT `tour_ibfk_2` FOREIGN KEY (`companyID`) REFERENCES `company` (`companyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
