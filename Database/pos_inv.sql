-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-01-2025 a las 13:25:31
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pos_inv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `modulo` char(1) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `accion` char(1) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `detalle` varchar(20) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `id_usuario`, `modulo`, `accion`, `detalle`, `fecha`) VALUES
(1, 1, '1', '0', '57', '2024-12-08 22:05:45'),
(2, 1, '1', '0', '58', '2024-12-08 22:41:07'),
(3, 1, '1', '0', '59', '2024-12-08 22:57:29'),
(4, 1, '2', '0', '39', '2024-12-08 23:15:48'),
(5, 1, '1', '0', '60', '2024-12-08 23:20:31'),
(6, 1, '3', '1', '1', '2024-12-08 23:49:07'),
(7, 1, '0', '3', '6', '2024-12-09 00:13:08'),
(8, 1, '0', '2', '4', '2024-12-09 00:13:28'),
(9, 1, '3', '3', '1', '2024-12-09 03:32:23'),
(10, 1, '3', '3', '2', '2024-12-09 03:35:09'),
(11, 1, '1', '0', '61', '2024-12-09 05:04:36'),
(12, 1, '2', '0', '40', '2024-12-09 05:09:24'),
(13, 1, '6', '0', '23', '2024-12-09 05:56:14'),
(14, 1, '6', '1', '23', '2024-12-09 05:58:32'),
(15, 1, '6', '3', '23', '2024-12-09 05:58:40'),
(16, 1, '7', '5', '1', '2024-12-09 13:50:10'),
(17, 1, '7', '4', '1', '2024-12-10 12:50:14'),
(18, 1, '7', '4', '1', '2024-12-10 12:50:15'),
(19, 1, '7', '4', '1', '2024-12-10 12:50:15'),
(20, 1, '7', '4', '1', '2024-12-11 12:46:25'),
(21, 1, '7', '4', '1', '2024-12-11 12:46:27'),
(22, 1, '7', '5', '1', '2024-12-11 12:46:34'),
(23, 1, '7', '4', '1', '2024-12-11 12:50:20'),
(24, 1, '7', '4', '1', '2024-12-11 12:50:21'),
(25, 1, '7', '5', '1', '2024-12-11 12:50:24'),
(26, 1, '7', '4', '1', '2024-12-11 12:51:23'),
(27, 1, '7', '4', '1', '2024-12-11 12:51:23'),
(28, 1, '7', '5', '1', '2024-12-11 12:51:27'),
(29, 1, '7', '4', '1', '2024-12-11 12:52:27'),
(30, 1, '7', '4', '1', '2024-12-11 12:52:28'),
(31, 1, '7', '4', '1', '2024-12-11 12:59:40'),
(32, 1, '7', '4', '1', '2024-12-11 12:59:40'),
(33, 1, '7', '4', '1', '2024-12-11 13:01:38'),
(34, 1, '7', '4', '1', '2024-12-11 13:01:39'),
(35, 1, '7', '4', '1', '2024-12-11 13:37:01'),
(36, 1, '7', '4', '1', '2024-12-11 13:37:01'),
(37, 1, '1', '0', '62', '2024-12-11 13:37:27'),
(38, 1, '7', '4', '1', '2024-12-11 15:04:31'),
(39, 1, '7', '4', '1', '2024-12-11 15:04:32'),
(40, 1, '7', '4', '1', '2024-12-11 15:09:58'),
(41, 1, '7', '4', '1', '2024-12-11 15:09:59'),
(42, 1, '6', '1', '1', '2024-12-11 16:35:40'),
(43, 1, '4', '1', '1', '2024-12-11 16:41:17'),
(44, 1, '4', '0', '5', '2024-12-11 16:41:59'),
(45, 1, '7', '4', '1', '2024-12-11 16:42:15'),
(46, 1, '7', '4', '1', '2024-12-11 16:42:15'),
(47, 1, '4', '0', '6', '2024-12-11 16:42:40'),
(48, 1, '6', '1', '1', '2024-12-11 16:45:48'),
(49, 1, '5', '1', '6', '2024-12-11 16:52:25'),
(50, 1, '5', '1', '8', '2024-12-11 16:52:49'),
(51, 1, '5', '1', '9', '2024-12-11 16:53:13'),
(52, 1, '5', '1', '1', '2024-12-11 16:53:29'),
(53, 1, '0', '2', '6', '2024-12-11 16:54:52'),
(54, 1, '0', '2', '2', '2024-12-11 16:54:54'),
(55, 1, '3', '2', '1', '2024-12-11 16:58:47'),
(56, 1, '3', '2', '2', '2024-12-11 16:58:50'),
(57, 1, '3', '1', '1', '2024-12-11 16:59:05'),
(58, 1, '3', '1', '2', '2024-12-11 16:59:13'),
(59, 1, '3', '1', '3', '2024-12-11 16:59:20'),
(60, 1, '6', '1', '12', '2024-12-11 16:59:52'),
(61, 1, '6', '1', '3', '2024-12-11 17:00:17'),
(62, 1, '0', '0', '10', '2024-12-11 17:01:55'),
(63, 1, '0', '0', '11', '2024-12-11 17:02:38'),
(64, 1, '0', '0', '12', '2024-12-11 17:03:04'),
(65, 1, '0', '1', '11', '2024-12-11 17:06:19'),
(66, 1, '0', '0', '13', '2024-12-11 17:06:45'),
(67, 1, '7', '4', '1', '2024-12-11 17:15:20'),
(68, 1, '7', '4', '1', '2024-12-11 17:15:20'),
(69, 1, '7', '5', '1', '2024-12-11 17:15:46'),
(70, 1, '7', '4', '1', '2024-12-11 18:43:58'),
(71, 1, '7', '4', '1', '2024-12-11 18:43:58'),
(72, 1, '7', '5', '1', '2024-12-11 18:46:01'),
(73, 1, '7', '4', '1', '2024-12-11 18:47:05'),
(74, 1, '7', '4', '1', '2024-12-11 18:47:05'),
(75, 1, '7', '4', '1', '2024-12-11 18:49:59'),
(76, 1, '7', '4', '1', '2024-12-11 18:49:59'),
(77, 1, '1', '0', '63', '2024-12-11 18:55:55'),
(78, 1, '7', '4', '1', '2024-12-11 18:58:33'),
(79, 1, '7', '4', '1', '2024-12-11 18:58:33'),
(80, 1, '7', '5', '1', '2024-12-11 19:21:59'),
(81, 1, '7', '4', '1', '2024-12-11 22:29:46'),
(82, 1, '7', '4', '1', '2024-12-11 22:29:46'),
(83, 1, '0', '1', '13', '2024-12-11 22:50:25'),
(84, 1, '0', '1', '13', '2024-12-11 22:51:04'),
(85, 1, '0', '1', '13', '2024-12-11 22:51:42'),
(86, 1, '7', '4', '1', '2024-12-11 23:02:05'),
(87, 1, '7', '4', '1', '2024-12-11 23:02:05'),
(88, 1, '7', '4', '1', '2024-12-11 23:06:05'),
(89, 1, '7', '4', '1', '2024-12-11 23:06:05'),
(90, 1, '7', '4', '1', '2024-12-11 23:19:15'),
(91, 1, '7', '4', '1', '2024-12-11 23:19:15'),
(92, 1, '7', '5', '1', '2024-12-11 23:41:44'),
(93, 1, '7', '4', '1', '2024-12-12 12:47:06'),
(94, 1, '7', '4', '1', '2024-12-12 12:47:06'),
(95, 1, '0', '1', '11', '2024-12-12 12:49:39'),
(96, 1, '0', '1', '10', '2024-12-12 12:49:57'),
(97, 1, '0', '1', '13', '2024-12-12 12:50:15'),
(98, 1, '0', '1', '12', '2024-12-12 12:50:26'),
(99, 1, '0', '1', '10', '2024-12-12 12:50:54'),
(100, 1, '1', '0', '64', '2024-12-12 12:53:50'),
(101, 1, '6', '1', '3', '2024-12-12 12:59:32'),
(102, 1, '6', '0', '24', '2024-12-12 13:01:43'),
(103, 1, '7', '5', '1', '2024-12-12 13:01:49'),
(104, 24, '7', '4', '24', '2024-12-12 13:02:06'),
(105, 24, '7', '4', '24', '2024-12-12 13:02:09'),
(106, 24, '2', '0', '41', '2024-12-12 13:04:11'),
(107, 24, '7', '5', '24', '2024-12-12 13:04:48'),
(108, 1, '7', '4', '1', '2024-12-12 13:04:58'),
(109, 1, '7', '4', '1', '2024-12-12 13:04:59'),
(110, 1, '4', '0', '7', '2024-12-12 13:05:37'),
(111, 1, '0', '1', '10', '2024-12-12 13:05:51'),
(112, 1, '7', '5', '1', '2024-12-12 13:06:31'),
(113, 1, '7', '4', '1', '2024-12-12 13:07:26'),
(114, 1, '7', '4', '1', '2024-12-12 13:07:26'),
(115, 1, '6', '0', '25', '2024-12-12 13:08:52'),
(116, 1, '7', '5', '1', '2024-12-12 13:08:55'),
(117, 25, '7', '4', '25', '2024-12-12 13:09:03'),
(118, 25, '7', '4', '25', '2024-12-12 13:09:03'),
(119, 25, '7', '5', '25', '2024-12-12 13:09:29'),
(120, 1, '7', '4', '1', '2024-12-12 13:16:59'),
(121, 1, '7', '4', '1', '2024-12-12 13:17:00'),
(122, 1, '3', '1', '1', '2024-12-12 13:32:59'),
(123, 1, '3', '1', '3', '2024-12-12 13:33:20'),
(124, 1, '3', '3', '1', '2024-12-12 13:33:32'),
(125, 1, '7', '4', '1', '2024-12-12 13:48:42'),
(126, 1, '7', '4', '1', '2024-12-12 13:48:42'),
(127, 1, '7', '4', '1', '2024-12-12 17:07:48'),
(128, 1, '7', '4', '1', '2024-12-12 17:07:48'),
(129, 1, '7', '4', '1', '2024-12-12 17:10:41'),
(130, 1, '7', '4', '1', '2024-12-12 17:10:41'),
(131, 1, '7', '4', '1', '2024-12-12 17:16:33'),
(132, 1, '7', '4', '1', '2024-12-12 17:16:33'),
(133, 1, '7', '4', '1', '2024-12-12 17:28:22'),
(134, 1, '7', '4', '1', '2024-12-12 17:28:22'),
(135, 1, '7', '4', '1', '2024-12-12 17:36:36'),
(136, 1, '7', '4', '1', '2024-12-12 17:36:36'),
(137, 1, '7', '4', '1', '2024-12-12 17:39:40'),
(138, 1, '7', '4', '1', '2024-12-12 17:39:40'),
(139, 1, '7', '4', '1', '2024-12-12 17:44:14'),
(140, 1, '7', '4', '1', '2024-12-12 17:44:14'),
(141, 1, '7', '4', '1', '2024-12-12 21:50:52'),
(142, 1, '7', '4', '1', '2024-12-12 21:50:52'),
(143, 1, '7', '5', '1', '2024-12-12 21:52:22'),
(144, 1, '7', '4', '1', '2024-12-14 16:38:11'),
(145, 1, '7', '4', '1', '2024-12-14 16:38:12'),
(146, 1, '7', '4', '1', '2024-12-14 16:48:15'),
(147, 1, '7', '4', '1', '2024-12-14 16:48:15'),
(148, 1, '7', '4', '1', '2024-12-14 17:13:26'),
(149, 1, '7', '4', '1', '2024-12-14 17:13:26'),
(150, 1, '6', '0', '26', '2024-12-14 18:17:36'),
(151, 1, '7', '4', '1', '2025-01-04 15:01:14'),
(152, 1, '7', '4', '1', '2025-01-04 15:01:14'),
(153, 1, '7', '4', '1', '2012-11-01 05:38:14'),
(154, 1, '7', '4', '1', '2012-11-01 05:38:15'),
(155, 1, '0', '0', '14', '2024-12-20 20:26:34'),
(156, 1, '0', '3', '14', '2024-12-20 20:30:20'),
(157, 1, '7', '4', '1', '2012-11-01 04:34:43'),
(158, 1, '7', '4', '1', '2012-11-01 04:34:47'),
(159, 1, '0', '1', '13', '2024-12-20 06:14:50'),
(160, 1, '0', '1', '13', '2024-12-20 06:15:36'),
(161, 1, '0', '1', '13', '2024-12-20 06:17:21'),
(162, 1, '0', '1', '13', '2024-12-20 06:17:29'),
(163, 1, '0', '3', '11', '2024-12-20 06:42:52'),
(164, 1, '0', '2', '11', '2024-12-20 07:06:00'),
(165, 1, '1', '0', '65', '2024-12-20 16:12:13'),
(166, 1, '0', '1', '10', '2024-12-20 16:12:46'),
(167, 1, '0', '0', '15', '2024-12-20 16:25:08'),
(168, 1, '0', '1', '15', '2024-12-20 16:25:26'),
(169, 1, '1', '0', '66', '2024-12-20 21:28:21'),
(170, 1, '2', '0', '42', '2024-12-20 23:01:38'),
(171, 1, '7', '4', '1', '2012-11-01 04:47:37'),
(172, 1, '7', '4', '1', '2012-11-01 04:47:39'),
(173, 1, '3', '1', '2', '2024-12-21 00:37:37'),
(174, 1, '3', '1', '2', '2024-12-21 00:40:01'),
(175, 1, '7', '5', '1', '2024-12-21 00:50:14'),
(176, 1, '7', '4', '1', '2024-12-21 00:50:27'),
(177, 1, '7', '4', '1', '2024-12-21 00:50:28'),
(178, 1, '7', '5', '1', '2024-12-21 00:52:55'),
(179, 1, '7', '4', '1', '2024-12-21 00:53:02'),
(180, 1, '7', '4', '1', '2024-12-21 00:53:02'),
(181, 1, '3', '0', '8', '2024-12-21 01:06:44'),
(182, 1, '7', '5', '1', '2025-01-07 14:17:40'),
(183, 1, '7', '4', '1', '2025-01-07 14:18:29'),
(184, 1, '7', '4', '1', '2025-01-07 14:18:29'),
(185, 1, '3', '1', '8', '2025-01-07 14:18:48'),
(186, 1, '3', '1', '8', '2025-01-07 14:19:03'),
(187, 1, '3', '1', '7', '2024-12-20 14:32:58'),
(188, 1, '3', '1', '7', '2024-12-20 14:33:21'),
(189, 1, '3', '1', '7', '2024-12-20 14:34:00'),
(190, 1, '3', '1', '7', '2024-12-20 14:34:35'),
(191, 1, '3', '1', '7', '2024-12-20 14:35:07'),
(192, 1, '3', '3', '7', '2024-12-20 14:37:29'),
(193, 1, '3', '1', '8', '2024-12-20 15:12:36'),
(194, 1, '3', '1', '8', '2024-12-20 15:12:43'),
(195, 1, '6', '1', '26', '2024-12-20 15:30:10'),
(196, 1, '6', '1', '26', '2024-12-20 15:30:16'),
(197, 1, '3', '3', '8', '2024-12-20 16:05:49'),
(198, 1, '3', '2', '8', '2024-12-20 16:18:20'),
(199, 1, '4', '0', '8', '2024-12-21 12:52:34'),
(200, 1, '4', '0', '9', '2024-12-21 12:52:47'),
(201, 1, '4', '0', '10', '2024-12-21 12:53:02'),
(202, 1, '4', '0', '11', '2024-12-21 12:53:14'),
(203, 1, '4', '3', '7', '2024-12-21 13:05:48'),
(204, 1, '4', '3', '10', '2024-12-21 13:05:56'),
(205, 1, '4', '3', '8', '2024-12-21 13:51:28'),
(206, 1, '4', '2', '8', '2024-12-21 14:05:24'),
(207, 1, '5', '3', '3', '2024-12-21 14:03:44'),
(208, 1, '5', '3', '1', '2024-12-21 14:54:14'),
(209, 1, '5', '2', '1', '2024-12-21 15:09:46'),
(210, 1, '6', '1', '26', '2024-12-21 15:32:15'),
(211, 1, '6', '1', '3', '2024-12-21 15:33:16'),
(212, 1, '6', '1', '24', '2024-12-21 15:33:31'),
(213, 1, '6', '1', '26', '2024-12-21 15:38:29'),
(214, 1, '6', '1', '26', '2024-12-21 15:38:43'),
(215, 1, '6', '3', '3', '2024-12-21 15:48:05'),
(216, 1, '6', '3', '12', '2024-12-21 15:48:15'),
(217, 1, '7', '5', '1', '2024-12-22 00:05:08'),
(218, 1, '7', '4', '1', '2024-12-21 04:36:54'),
(219, 1, '7', '4', '1', '2024-12-21 04:36:54'),
(220, 1, '6', '3', '26', '2024-12-21 05:17:03'),
(221, 1, '7', '5', '1', '2024-12-21 21:32:01'),
(222, 1, '7', '4', '1', '2025-01-10 20:08:22'),
(223, 1, '7', '5', '1', '2025-01-10 20:08:29'),
(224, 1, '7', '4', '1', '2025-01-10 20:08:42'),
(225, 1, '7', '5', '1', '2025-01-10 20:08:47'),
(226, 1, '7', '4', '1', '2025-01-10 20:09:44'),
(227, 1, '6', '1', '24', '2025-01-10 20:13:03'),
(228, 1, '6', '1', '24', '2025-01-10 20:13:19'),
(229, 1, '6', '3', '24', '2024-12-21 20:56:44'),
(230, 1, '6', '2', '26', '2024-12-21 21:00:21'),
(231, 1, '6', '3', '26', '2024-12-21 21:01:51'),
(232, 1, '6', '2', '24', '2024-12-21 21:01:59'),
(233, 1, '6', '3', '24', '2024-12-21 21:04:24'),
(234, 1, '6', '2', '26', '2025-01-10 21:09:40'),
(235, 1, '0', '3', '15', '2024-12-20 22:30:41'),
(236, 1, '4', '2', '7', '2024-12-20 22:41:56'),
(237, 1, '0', '1', '13', '2024-12-20 22:44:24'),
(238, 1, '7', '5', '1', '2024-12-20 22:53:47'),
(239, 1, '7', '4', '1', '2024-12-20 04:32:29'),
(240, 1, '0', '3', '11', '2024-12-20 04:45:33'),
(241, 1, '0', '2', '11', '2024-12-20 04:50:55'),
(242, 1, '0', '1', '13', '2024-12-20 13:54:10'),
(243, 1, '0', '1', '13', '2024-12-20 13:54:20'),
(244, 1, '0', '2', '15', '2024-12-20 13:54:29'),
(245, 1, '0', '3', '15', '2024-12-20 13:54:51'),
(246, 1, '0', '1', '13', '2024-12-20 13:55:25'),
(247, 1, '5', '2', '3', '2024-12-20 13:57:45'),
(248, 1, '0', '0', '16', '2024-12-20 14:02:36'),
(249, 1, '1', '0', '67', '2024-12-20 14:19:51'),
(250, 1, '0', '1', '10', '2024-12-20 14:37:24'),
(251, 1, '0', '1', '16', '2024-12-20 14:37:44'),
(252, 1, '2', '0', '43', '2024-12-20 14:45:58'),
(253, 1, '3', '1', '8', '2024-12-20 14:59:49'),
(254, 1, '3', '1', '8', '2024-12-20 15:00:34'),
(255, 1, '3', '1', '8', '2024-12-20 15:01:14'),
(256, 1, '3', '1', '6', '2024-12-20 15:01:26'),
(257, 1, '3', '2', '7', '2024-12-20 15:01:51'),
(258, 1, '3', '1', '7', '2024-12-20 15:02:04'),
(259, 1, '3', '3', '7', '2024-12-20 15:02:41'),
(260, 1, '3', '3', '8', '2024-12-20 15:15:13'),
(261, 1, '3', '2', '8', '2024-12-20 15:18:15'),
(262, 1, '4', '3', '8', '2024-12-20 15:40:32'),
(263, 1, '4', '2', '8', '2024-12-20 15:43:28'),
(264, 1, '5', '0', '10', '2024-12-20 15:48:44'),
(265, 1, '5', '3', '10', '2024-12-20 15:48:51'),
(266, 1, '5', '3', '1', '2024-12-20 15:58:07'),
(267, 1, '5', '2', '1', '2024-12-20 16:00:31'),
(268, 1, '6', '2', '12', '2024-12-20 18:08:19'),
(269, 1, '6', '2', '24', '2024-12-20 18:08:31'),
(270, 1, '6', '3', '26', '2025-01-10 13:44:48'),
(271, 1, '6', '2', '26', '2025-01-10 13:47:20'),
(272, 1, '7', '5', '1', '2024-12-20 15:19:11'),
(273, 1, '7', '4', '1', '2012-11-01 06:39:31'),
(274, 1, '7', '5', '1', '2012-11-01 06:40:46'),
(275, 1, '7', '4', '1', '2012-11-01 10:58:08'),
(276, 1, '7', '5', '1', '2025-01-12 20:26:23'),
(277, 1, '7', '4', '1', '2025-01-12 20:56:07'),
(278, 1, '6', '1', '12', '2025-01-12 20:56:26'),
(279, 1, '4', '1', '9', '2025-01-12 20:58:16'),
(280, 1, '7', '5', '1', '2012-11-01 04:34:35'),
(281, 12, '7', '5', '12', '2025-01-13 05:53:02'),
(282, 12, '7', '4', '12', '2025-01-13 05:53:03'),
(283, 12, '1', '0', '68', '2025-01-13 06:54:01'),
(284, 12, '1', '0', '69', '2025-01-13 06:55:13'),
(285, 12, '1', '0', '70', '2025-01-13 06:56:30'),
(286, 12, '1', '0', '71', '2025-01-13 06:57:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`) VALUES
(1, 'BUJIAS', 1),
(2, 'GOMAS', 1),
(3, 'TORNILLO', 1),
(4, 'PASTILLAS DE FRENO', 1),
(10, 'MISCELANEOS', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int NOT NULL,
  `rif` varchar(20) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `mensaje` varchar(200) COLLATE utf8mb3_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `rif`, `nombre`, `telefono`, `direccion`, `mensaje`) VALUES
(1, 'J-29621741-6', 'Autorepuesto Espinoza C.A', '02943322410', 'Calle Monagas', 'Gracias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id` int NOT NULL,
  `id_repuesto` int NOT NULL,
  `id_usuario` int NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `cantidad` int NOT NULL,
  `sub_total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entradas`
--

CREATE TABLE `detalle_entradas` (
  `id` int NOT NULL,
  `id_entrada` int NOT NULL,
  `id_repuesto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_entradas`
--

INSERT INTO `detalle_entradas` (`id`, `id_entrada`, `id_repuesto`, `cantidad`, `precio`, `sub_total`) VALUES
(89, 67, 16, 40, 55.00, 2200.00),
(90, 67, 10, 20, 60.00, 1200.00),
(91, 68, 10, 5, 60.00, 300.00),
(92, 68, 11, 12, 8.00, 96.00),
(93, 68, 12, 12, 8.00, 96.00),
(94, 68, 13, 44, 0.00, 0.00),
(95, 68, 16, 12, 55.00, 660.00),
(96, 69, 10, 12, 60.00, 720.00),
(97, 69, 11, 12, 8.00, 96.00),
(98, 69, 12, 66, 8.00, 528.00),
(99, 69, 13, 45, 25.00, 1125.00),
(100, 69, 16, 12, 55.00, 660.00),
(101, 70, 10, 12, 60.00, 720.00),
(102, 70, 11, 12, 8.00, 96.00),
(103, 70, 12, 12, 8.00, 96.00),
(104, 70, 13, 1, 25.00, 25.00),
(105, 70, 16, 45, 55.00, 2475.00),
(106, 71, 10, 1, 60.00, 60.00),
(107, 71, 11, 1, 8.00, 8.00),
(108, 71, 12, 12, 8.00, 96.00),
(109, 71, 13, 45, 25.00, 1125.00),
(110, 71, 16, 45, 55.00, 2475.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_salidas`
--

CREATE TABLE `detalle_salidas` (
  `id` int NOT NULL,
  `id_salida` int NOT NULL,
  `id_repuesto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_salidas`
--

INSERT INTO `detalle_salidas` (`id`, `id_salida`, `id_repuesto`, `cantidad`, `precio`, `sub_total`) VALUES
(45, 43, 10, 2, 65.00, 130.00),
(46, 43, 16, 4, 60.00, 240.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `id` int NOT NULL,
  `id_repuesto` int NOT NULL,
  `id_usuario` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int NOT NULL,
  `id_proveedor` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `id_proveedor`, `total`, `fecha`) VALUES
(67, 6, 3400.00, '2024-12-20 14:19:50'),
(68, 6, 1152.00, '2025-01-13 06:54:01'),
(69, 6, 3129.00, '2025-01-13 06:55:13'),
(70, 6, 3412.00, '2025-01-13 06:56:30'),
(71, 6, 3764.00, '2025-01-13 06:57:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `estado`) VALUES
(1, 'GENERICO', 1),
(7, 'YIDO', 1),
(8, 'BOSCH', 1),
(9, 'SKFA', 1),
(10, 'INA', 0),
(11, 'CONTINENTAL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int NOT NULL,
  `rif` varchar(11) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `direccion` text COLLATE utf8mb3_spanish2_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `rif`, `nombre`, `telefono`, `direccion`, `estado`) VALUES
(6, 'J-407885618', 'AUTOREPUESTOS WS', '04246743556', 'CARACAS', 1),
(7, 'J-600025479', 'AUTOREPUESTOS GRAN CAMINO', '04128889434', 'PUERTO LA CRUZ', 0),
(8, 'J-317167351', 'AUTOREPUESTOS DANMAR', '02123610634', 'MARACAIBO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos`
--

CREATE TABLE `repuestos` (
  `id` int NOT NULL,
  `codigo` varchar(20) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL DEFAULT '0',
  `c_minimo` int NOT NULL,
  `id_marca` int NOT NULL,
  `id_categoria` int NOT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `repuestos`
--

INSERT INTO `repuestos` (`id`, `codigo`, `nombre`, `precio_compra`, `precio_venta`, `cantidad`, `c_minimo`, `id_marca`, `id_categoria`, `estado`) VALUES
(10, '1', 'BUJIA PATA CORTA', 60.00, 65.00, 84, 0, 7, 1, 1),
(11, '2', 'GOMA PARA AVEO LTE 2014', 8.00, 30.00, 40, 0, 1, 2, 1),
(12, '3', 'TORNILLO 3 PULGADAS', 8.00, 5.00, 104, 0, 1, 3, 1),
(13, '4', 'PASTILLAS DE FRENO CORSA 2007', 25.00, 12.00, 136, 0, 1, 4, 1),
(15, '5', 'PASTILLAS DE FRENO CHEVROLET', 55.00, 0.00, 40, 0, 1, 4, 0),
(16, '6', 'TORNILLO 4 PULGADAS', 55.00, 60.00, 150, 0, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `id` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id`, `total`, `fecha`) VALUES
(43, 370.00, '2024-12-20 14:45:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `ci` varchar(20) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `clave` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `rol` varchar(20) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `ci`, `usuario`, `nombre`, `apellido`, `clave`, `rol`, `estado`) VALUES
(1, '27287477', 'ADMIN', 'LUIS', 'BRAZON', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'Administrador', 1),
(3, '29345768', 'ALEJA', 'ALEJANDRA', 'GUTIERREZ', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'Vendedor', 0),
(12, '29435754', 'LTEAR', 'LEONARDO', 'MARQUEZ', 'd6713220057e063e8820333734a368f9c6530be19671b5f0dba7c8f38aa10498', 'Administrador', 1),
(24, '30906245', 'BEDANYER', 'NIURKA', 'LOPEZ', '7ed8463838be4d92aa93d7529bd17016ae748aba42757368e0a2832d42bc962a', 'Almacenista', 1),
(25, '28758588', 'ESTEFANY', 'ESTEFANY', 'CEDEÑO', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'Vendedor', 1),
(26, '14441910', 'OSWALHER', 'OSWALDO', 'HERNÁNDEZ', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'Administrador', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_repuesto` (`id_repuesto`) USING BTREE;

--
-- Indices de la tabla `detalle_entradas`
--
ALTER TABLE `detalle_entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_entrada` (`id_entrada`),
  ADD KEY `id_repuesto` (`id_repuesto`);

--
-- Indices de la tabla `detalle_salidas`
--
ALTER TABLE `detalle_salidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_salida` (`id_salida`),
  ADD KEY `id_repuesto` (`id_repuesto`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_repuesto` (`id_repuesto`) USING BTREE,
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rif` (`rif`);

--
-- Indices de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`) USING BTREE,
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de la tabla `detalle_entradas`
--
ALTER TABLE `detalle_entradas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de la tabla `detalle_salidas`
--
ALTER TABLE `detalle_salidas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_entradas`
--
ALTER TABLE `detalle_entradas`
  ADD CONSTRAINT `detalle_entradas_ibfk_1` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_entradas_ibfk_2` FOREIGN KEY (`id_entrada`) REFERENCES `entradas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_salidas`
--
ALTER TABLE `detalle_salidas`
  ADD CONSTRAINT `detalle_salidas_ibfk_1` FOREIGN KEY (`id_salida`) REFERENCES `salidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_salidas_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_temp_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD CONSTRAINT `repuestos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repuestos_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
