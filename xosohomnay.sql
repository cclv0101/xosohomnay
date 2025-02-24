-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 24, 2025 lúc 05:03 AM
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
-- Cơ sở dữ liệu: `xosohomnay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_article`
--

CREATE TABLE `tbl_article` (
  `article_id` bigint(21) NOT NULL,
  `article_stt` int(1) DEFAULT 0 COMMENT '0-private/1-public/2-draft/3-trash',
  `article_title` varchar(250) DEFAULT NULL,
  `article_slug` varchar(250) DEFAULT NULL,
  `article_user_id` int(11) DEFAULT NULL COMMENT 'Nguoi dang bai viet',
  `article_tags` text DEFAULT NULL COMMENT 'Cac,the,cua,bai,viet',
  `article_desc` text DEFAULT NULL,
  `article_content` text DEFAULT NULL,
  `article_total_view` int(11) DEFAULT 0,
  `article_created` int(6) DEFAULT 0,
  `article_updated` int(6) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_notify`
--

CREATE TABLE `tbl_notify` (
  `notify_id` bigint(21) NOT NULL,
  `notify_stt` int(1) DEFAULT 0 COMMENT '0-created/1-sending/2-trash',
  `notify_phone` varchar(250) DEFAULT NULL,
  `notify_email` varchar(250) DEFAULT NULL,
  `notify_content` varchar(250) DEFAULT NULL,
  `notify_created` int(6) DEFAULT 0,
  `notify_updated` int(6) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_page`
--

CREATE TABLE `tbl_page` (
  `page_id` bigint(21) NOT NULL,
  `page_stt` int(1) DEFAULT 0 COMMENT '0-private/1-public/2-draft/3-trash',
  `page_title` varchar(250) DEFAULT NULL,
  `page_slug` varchar(250) DEFAULT NULL,
  `page_desc` text DEFAULT NULL,
  `page_content` text DEFAULT NULL,
  `page_total_view` int(11) DEFAULT 0 COMMENT 'Danh cho landing page',
  `page_created` int(6) DEFAULT 0,
  `page_updated` int(6) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` bigint(21) NOT NULL,
  `product_stt` int(1) DEFAULT 0 COMMENT '0-private/1-public/2-draft/3-trash',
  `product_name` varchar(250) DEFAULT NULL,
  `product_slug` varchar(250) DEFAULT NULL,
  `product_user_id` int(11) DEFAULT NULL COMMENT 'Nguoi dang san pham',
  `product_tags` text DEFAULT NULL COMMENT 'Cac,the,cua,san,pham',
  `product_price` int(11) DEFAULT 0,
  `product_sale` int(11) DEFAULT 0 COMMENT 'san pham giam gia',
  `product_amount` int(11) DEFAULT 0 COMMENT 'So luong con lai',
  `product_total_sale` int(11) DEFAULT 0 COMMENT 'So luong da ban',
  `product_total_add_cart` int(11) DEFAULT 0 COMMENT 'Luot bo vao gio',
  `product_total_view` int(11) DEFAULT 0 COMMENT 'Luot xem san pham',
  `product_desc` text DEFAULT NULL,
  `product_content` text DEFAULT NULL,
  `product_created` int(6) DEFAULT 0,
  `product_updated` int(6) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_project`
--

CREATE TABLE `tbl_project` (
  `project_id` bigint(21) NOT NULL,
  `project_stt` int(1) DEFAULT 0 COMMENT '0-private/1-public/2-draft/3-trash',
  `project_title` varchar(250) DEFAULT NULL,
  `project_slug` varchar(250) DEFAULT NULL,
  `project_user_id` int(11) DEFAULT NULL COMMENT 'Nguoi dang du an',
  `project_tags` text DEFAULT NULL COMMENT 'Cac,the,cua,du,an',
  `project_desc` text DEFAULT NULL,
  `project_content` text DEFAULT NULL,
  `project_total_view` int(11) DEFAULT 0,
  `project_created` int(6) DEFAULT 0,
  `project_updated` int(6) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_service`
--

CREATE TABLE `tbl_service` (
  `service_id` bigint(21) NOT NULL,
  `service_stt` int(1) DEFAULT 0 COMMENT '0-private/1-public/2-draft/3-trash',
  `service_title` varchar(250) DEFAULT NULL,
  `service_slug` varchar(250) DEFAULT NULL,
  `service_user_id` int(11) DEFAULT NULL COMMENT 'Nguoi dang dich vu',
  `service_tags` text DEFAULT NULL COMMENT 'Cac,the,cua,dich,vu',
  `service_desc` text DEFAULT NULL,
  `service_content` text DEFAULT NULL,
  `service_total_view` int(11) DEFAULT 0,
  `service_created` int(6) DEFAULT 0,
  `service_updated` int(6) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` bigint(21) NOT NULL,
  `user_stt` int(1) DEFAULT 0 COMMENT '0-private/1-public/2-draft/3-trash',
  `user_type` int(1) DEFAULT 3 COMMENT '0-Technical (T)/1-Admin (A)/2-Content (C)',
  `user_username` varchar(250) DEFAULT NULL,
  `user_password` varchar(250) DEFAULT NULL,
  `user_fullname` varchar(250) DEFAULT NULL,
  `user_created` int(6) DEFAULT 0,
  `user_updated` int(6) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_stt`, `user_type`, `user_username`, `user_password`, `user_fullname`, `user_created`, `user_updated`) VALUES
(1, 1, 0, 'spadmin', '3a4b24d3645b9d69daa8c48a7972ba9e', 'Super Admin', 1663232641, 1666603025);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_article`
--
ALTER TABLE `tbl_article`
  ADD PRIMARY KEY (`article_id`),
  ADD UNIQUE KEY `article_slug` (`article_slug`);

--
-- Chỉ mục cho bảng `tbl_notify`
--
ALTER TABLE `tbl_notify`
  ADD PRIMARY KEY (`notify_id`),
  ADD UNIQUE KEY `notify_phone` (`notify_phone`);

--
-- Chỉ mục cho bảng `tbl_page`
--
ALTER TABLE `tbl_page`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `page_slug` (`page_slug`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_slug` (`product_slug`);

--
-- Chỉ mục cho bảng `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`project_id`),
  ADD UNIQUE KEY `project_slug` (`project_slug`);

--
-- Chỉ mục cho bảng `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`service_id`),
  ADD UNIQUE KEY `service_slug` (`service_slug`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_username` (`user_username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_article`
--
ALTER TABLE `tbl_article`
  MODIFY `article_id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT cho bảng `tbl_notify`
--
ALTER TABLE `tbl_notify`
  MODIFY `notify_id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `tbl_page`
--
ALTER TABLE `tbl_page`
  MODIFY `page_id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_project`
--
ALTER TABLE `tbl_project`
  MODIFY `project_id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `tbl_service`
--
ALTER TABLE `tbl_service`
  MODIFY `service_id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
