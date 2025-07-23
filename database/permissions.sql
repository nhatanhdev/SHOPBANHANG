-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 07, 2024 lúc 10:47 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `order_manage`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint NOT NULL DEFAULT '0',
  `key_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `parent_id`, `key_code`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'Dashboard', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(2, 'list', 'list', 1, 'dashboard_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(3, 'add', 'add', 1, 'dashboard_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(4, 'edit', 'edit', 1, 'dashboard_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(5, 'delete', 'delete', 1, 'dashboard_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(6, 'job_emails', 'Job Email', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(7, 'list', 'list', 6, 'job_emails_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(8, 'add', 'add', 6, 'job_emails_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(9, 'edit', 'edit', 6, 'job_emails_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(10, 'delete', 'delete', 6, 'job_emails_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(11, 'news', 'Tin tức', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(12, 'list', 'list', 11, 'news_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(13, 'add', 'add', 11, 'news_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(14, 'edit', 'edit', 11, 'news_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(15, 'delete', 'delete', 11, 'news_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(16, 'sliders', 'Slider', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(17, 'list', 'list', 16, 'sliders_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(18, 'add', 'add', 16, 'sliders_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(19, 'edit', 'edit', 16, 'sliders_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(20, 'delete', 'delete', 16, 'sliders_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(21, 'users', 'Khách hàng', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(22, 'list', 'list', 21, 'users_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(23, 'add', 'add', 21, 'users_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(24, 'edit', 'edit', 21, 'users_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(25, 'delete', 'delete', 21, 'users_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(26, 'chats', 'Chat', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(27, 'list', 'list', 26, 'chats_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(28, 'add', 'add', 26, 'chats_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(29, 'edit', 'edit', 26, 'chats_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(30, 'delete', 'delete', 26, 'chats_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(31, 'employees', 'Nhân viên', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(32, 'list', 'list', 31, 'employees_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(33, 'add', 'add', 31, 'employees_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(34, 'edit', 'edit', 31, 'employees_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(35, 'delete', 'delete', 31, 'employees_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(36, 'roles', 'Vai trò nhân viên', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(37, 'list', 'list', 36, 'roles_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(38, 'add', 'add', 36, 'roles_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(39, 'edit', 'edit', 36, 'roles_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(40, 'delete', 'delete', 36, 'roles_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(41, 'permissions', 'Cấp quyền', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(42, 'list', 'list', 41, 'permissions_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(43, 'add', 'add', 41, 'permissions_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(44, 'edit', 'edit', 41, 'permissions_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(45, 'delete', 'delete', 41, 'permissions_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(46, 'logos', 'Logo', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(47, 'list', 'list', 46, 'logos_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(48, 'add', 'add', 46, 'logos_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(49, 'edit', 'edit', 46, 'logos_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(50, 'delete', 'delete', 46, 'logos_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(51, 'history_datas', 'Lịch sử dữ liệu', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(52, 'list', 'list', 51, 'history_datas_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(53, 'add', 'add', 51, 'history_datas_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(54, 'edit', 'edit', 51, 'history_datas_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(55, 'delete', 'delete', 51, 'history_datas_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(56, 'settings', 'Cài đặt', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(57, 'list', 'list', 56, 'settings_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(58, 'add', 'add', 56, 'settings_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(59, 'edit', 'edit', 56, 'settings_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(60, 'delete', 'delete', 56, 'settings_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(61, 'job_notifications', 'Thông báo', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(62, 'list', 'list', 61, 'job_notifications_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(63, 'add', 'add', 61, 'job_notifications_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(64, 'edit', 'edit', 61, 'job_notifications_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(65, 'delete', 'delete', 61, 'job_notifications_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(66, 'category_news', 'Danh mục tin tức', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(67, 'list', 'list', 66, 'category_news_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(68, 'add', 'add', 66, 'category_news_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(69, 'edit', 'edit', 66, 'category_news_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(70, 'delete', 'delete', 66, 'category_news_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(71, 'categories', 'Danh mục sản phẩm', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(72, 'list', 'list', 71, 'categories_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(73, 'add', 'add', 71, 'categories_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(74, 'edit', 'edit', 71, 'categories_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(75, 'delete', 'delete', 71, 'categories_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(76, 'system_branches', 'Danh sách cửa hàng', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(77, 'list', 'list', 76, 'system_branches_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(78, 'add', 'add', 76, 'system_branches_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(79, 'edit', 'edit', 76, 'system_branches_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(80, 'delete', 'delete', 76, 'system_branches_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(81, 'orders', 'Quản lý đơn hàng', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(82, 'list', 'list', 81, 'orders_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(83, 'add', 'add', 81, 'orders_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(84, 'edit', 'edit', 81, 'orders_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(85, 'delete', 'delete', 81, 'orders_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(86, 'vouchers', 'Quản lý mã giảm giá', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(87, 'list', 'list', 86, 'vouchers_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(88, 'add', 'add', 86, 'vouchers_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(89, 'edit', 'edit', 86, 'vouchers_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(90, 'delete', 'delete', 86, 'vouchers_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(91, 'medias', 'Quản lý file', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(92, 'list', 'list', 91, 'medias_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(93, 'add', 'add', 91, 'medias_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(94, 'edit', 'edit', 91, 'medias_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(95, 'delete', 'delete', 91, 'medias_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(96, 'payment_methods', 'Quản lý phương thức thanh toán', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(97, 'list', 'list', 96, 'payment_methods_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(98, 'add', 'add', 96, 'payment_methods_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(99, 'edit', 'edit', 96, 'payment_methods_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(100, 'delete', 'delete', 96, 'payment_methods_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(101, 'user_transactions', 'Quản lý giao dịch', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(102, 'list', 'list', 101, 'user_transactions_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(103, 'add', 'add', 101, 'user_transactions_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(104, 'edit', 'edit', 101, 'user_transactions_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(105, 'delete', 'delete', 101, 'user_transactions_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(106, 'user_points', 'Quản lý điểm', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(107, 'list', 'list', 106, 'user_points_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(108, 'add', 'add', 106, 'user_points_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(109, 'edit', 'edit', 106, 'user_points_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(110, 'delete', 'delete', 106, 'user_points_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(111, 'banks', 'Quản lý ngân hàng', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(112, 'list', 'list', 111, 'banks_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(113, 'add', 'add', 111, 'banks_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(114, 'edit', 'edit', 111, 'banks_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(115, 'delete', 'delete', 111, 'banks_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(116, 'banks_cash_ins', 'Quản lý ngân hàng nạp tiền', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(117, 'list', 'list', 116, 'banks_cash_ins_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(118, 'add', 'add', 116, 'banks_cash_ins_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(119, 'edit', 'edit', 116, 'banks_cash_ins_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(120, 'delete', 'delete', 116, 'banks_cash_ins_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(121, 'memberships', 'Quản lý hạng thành viên', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(122, 'list', 'list', 121, 'memberships_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(123, 'add', 'add', 121, 'memberships_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(124, 'edit', 'edit', 121, 'memberships_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(125, 'delete', 'delete', 121, 'memberships_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(126, 'shipping_methods', 'Quản lý phương thức thanh toán', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(127, 'list', 'list', 126, 'shipping_methods_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(128, 'add', 'add', 126, 'shipping_methods_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(129, 'edit', 'edit', 126, 'shipping_methods_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(130, 'delete', 'delete', 126, 'shipping_methods_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(131, 'product_comments', 'Quản lý bình luận sản phẩm', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(132, 'list', 'list', 131, 'product_comments_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(133, 'add', 'add', 131, 'product_comments_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(134, 'edit', 'edit', 131, 'product_comments_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(135, 'delete', 'delete', 131, 'product_comments_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(136, 'flash_sales', 'Quản lý FlashSale', 0, NULL, '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(137, 'list', 'list', 136, 'flash_sales_list', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(138, 'add', 'add', 136, 'flash_sales_add', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(139, 'edit', 'edit', 136, 'flash_sales_edit', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(140, 'delete', 'delete', 136, 'flash_sales_delete', '2024-04-06 07:29:33', '2024-04-06 07:29:33'),
(141, 'order_news', 'Quản lý Đơn Hàng Mới', 0, NULL, '2024-04-06 08:31:53', '2024-04-06 08:31:53'),
(142, 'list', 'list', 141, 'order_news_list', '2024-04-06 08:31:53', '2024-04-06 08:31:53'),
(143, 'add', 'add', 141, 'order_news_add', '2024-04-06 08:31:53', '2024-04-06 08:31:53'),
(144, 'edit', 'edit', 141, 'order_news_edit', '2024-04-06 08:31:53', '2024-04-06 08:31:53'),
(145, 'delete', 'delete', 141, 'order_news_delete', '2024-04-06 08:31:53', '2024-04-06 08:31:53');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
