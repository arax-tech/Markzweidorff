-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: mysql116.unoeuro.com
-- Generation Time: Apr 12, 2023 at 07:38 AM
-- Server version: 8.0.32-24
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventmedical_dk_db_intranet`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `icon`, `description`, `created_at`, `updated_at`) VALUES
(4, 2, 'React Native', 'book-open', 'react native description', '2022-09-28 06:13:49', '2022-10-05 07:39:12'),
(21, 4, 'IOS Apps', 'at-sign', 'IOS Apps', '2022-10-05 07:47:45', '2022-10-05 07:48:25'),
(23, 4, 'Demo', 'folder', 'just an demo', '2022-10-07 08:54:11', '2022-10-07 08:54:11'),
(25, 25, 'Generelt', 'folder', 'Velkomst og generelt inf', '2022-10-08 00:52:16', '2022-10-17 03:09:45'),
(26, NULL, '01. Politikker & strategier', 'folder', NULL, '2022-10-08 00:52:37', '2022-10-08 00:52:37'),
(27, NULL, '02. Retningslinjer', 'folder', NULL, '2022-10-08 00:52:48', '2022-10-08 00:52:48'),
(28, NULL, '03. Instrukser', 'folder', NULL, '2022-10-08 00:53:00', '2022-10-08 00:53:00'),
(29, 27, '02.01. Administrative', 'folder', NULL, '2022-10-08 00:53:26', '2022-10-08 00:53:26'),
(30, 27, '02.02. Forløbsbeskrivelse', 'folder', NULL, '2022-10-08 00:53:44', '2022-10-08 00:53:44'),
(31, 27, '02.03. Kliniske', 'folder', NULL, '2022-10-08 00:54:01', '2022-10-08 00:54:01'),
(32, 28, '03.01. Driftsinstrukser', 'folder', NULL, '2022-10-08 00:54:19', '2022-10-08 00:54:19'),
(33, 28, '03.02. Medicininstrukser', 'folder', NULL, '2022-10-08 00:54:33', '2022-10-08 00:54:33'),
(34, 28, '03.03. Behandlingsinstrukser', 'folder', NULL, '2022-10-08 00:54:46', '2022-10-08 00:54:46'),
(35, 28, '03.04. Materiel- og udstyrsinstrukser', 'folder', NULL, '2022-10-08 00:55:01', '2022-10-08 00:55:01'),
(36, 32, 'Djurs Sommerland', 'folder', NULL, '2022-10-08 01:00:24', '2022-10-08 01:00:24'),
(37, 32, 'Legoland', 'folder', NULL, '2022-10-08 10:04:26', '2022-10-08 10:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `minisite_id` int NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `user_id`, `minisite_id`, `message`, `created_at`, `updated_at`) VALUES
(8, 12, 3, 'lsdflakjfldksa jlkasdjflkasjdfljasdlfjlsadfjlkasdjflksadjflkasjdflkj', '2023-01-09 17:27:51', '2023-01-09 17:27:51'),
(9, 12, 3, 'asdfasfasdfasfasdf', '2023-01-09 17:28:01', '2023-01-09 17:28:01'),
(10, 12, 2, 'asdasdasdasd', '2023-01-09 17:31:51', '2023-01-09 17:31:51'),
(11, 12, 2, 'fdasljflasjfl jasældfjkælaskdjfælaskdjfælkjaljkdfaælkjdfælkjaælsdkjf', '2023-01-09 17:36:41', '2023-01-09 17:36:41'),
(12, 16, 2, 'how are you', '2023-01-09 18:27:21', '2023-01-09 18:27:21'),
(13, 12, 2, 'ffasasefhiosa ijsfæjsæefjasæeijf 39+293r\"#€/(€€%', '2023-01-12 13:13:28', '2023-01-12 13:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_information` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ice_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `who_update_status` int DEFAULT NULL,
  `work_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `co_line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_navn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday_cdr_control` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `phone`, `address`, `note`, `bank_information`, `ice_contact`, `employment_date`, `group_id`, `location_id`, `status`, `who_update_status`, `work_title`, `co_line`, `street_navn`, `street_no`, `street_level`, `po_code`, `city_name`, `country`, `start_date`, `end_date`, `type`, `birthday_cdr_control`, `profile_note`, `permissions`, `image`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Djurs Sommerland A/S', 'info@djurssommerland.dk', '$2y$10$oiyY4I0ORzfC3bmznP0aK.b69zRNBRE.wZlYlEM5Jy9GabD6rD7lW', '(+45) 86 39 84 00', NULL, NULL, '10101441', NULL, NULL, '11,13', '12', 'Active', NULL, 'Forlystelsespark', NULL, 'Battrupholtvej', '3', NULL, '8581', 'Nimtofte', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672686457.png', NULL, NULL, '2023-01-02 18:56:07', '2023-03-04 20:17:33'),
(2, 'Enbw Offshore Service Denmark ApS', 'KLM-operations@enbw.com', '$2y$10$6CtuKzM0OERO6Qr36dy8fuKgyc0ivRuE.gtuJ.XfnH4fDQAG7N1qy', '(+45) 73 70 70 01', NULL, NULL, '37113980', NULL, NULL, '3,10,11,12,13,14,15', '7', 'Active', NULL, 'Erhverv', NULL, 'Klintholm havneplads', '81', NULL, '4791', 'Borre', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672696333.png', NULL, NULL, '2023-01-02 21:42:04', '2023-02-24 12:57:25'),
(3, 'Tyrol Air Ambulance GmbH', 'taa@taa.at', '$2y$10$6DXbw9s5dypPn8OKAzXdgeI498Q6qFAf8TPesbn1OIQnFnBeRCGbm', '(+43) 512 22 422 100', NULL, NULL, NULL, NULL, NULL, '3,11,12,13,14,15', NULL, 'Active', NULL, 'Sygetransport & Ambulance', NULL, 'Fürstenweg', '180', NULL, '6020', 'Innsbruck', 'Austria', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672697564.png', NULL, NULL, '2023-01-02 22:10:33', '2023-01-02 22:12:44'),
(4, 'Air Medical Service', 'ops@airmedicalservice.eu', '$2y$10$mDh7gYuOo3VhWLUvYlCQZe6OWCW6oXF/viobGly5jckQvBxuzIkem', '(+39) 011 996 2563', NULL, NULL, NULL, NULL, NULL, '11,12,13,15', NULL, 'Active', NULL, 'Sygetransport & Ambulance', 'General Aviation, Turin Airport', 'Strada San Maurizio', '12', NULL, '10072', 'Caselle Torinese', 'Italy', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672697940.png', NULL, NULL, '2023-01-02 22:17:51', '2023-01-02 22:19:00'),
(5, 'Aeromedical and Marine Training & Rescue International', 'info@air-marine-int.com', '$2y$10$hCrWQTlmEJwieOCquqayTOYcqy4aRt6ISbRucDcct3rLNHpKFyC8C', '(+34) 637 720 023', NULL, NULL, NULL, NULL, NULL, '3,10,11,12,13,14', NULL, 'Active', NULL, 'Ambulance & Intensiv transport', NULL, 'Avinguda Diagonal', '660', NULL, '08034', 'Barcelona', 'Spanien', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672853425.png', NULL, NULL, '2023-01-02 22:32:59', '2023-01-04 17:30:25'),
(6, 'Advanced Medical Support (AMS Assistanse A/S)', 'post@amedsup.no', '$2y$10$D8dlvY.TPGXo/tSnrXvO2eEpxXB/W2OprXK8.1.lbKEyAaSM2Xaj6', '(+47) 40 00 16 16', NULL, 'here', NULL, NULL, NULL, '10,11,12,13,15', '6', 'Active', NULL, 'Ambulancefly', NULL, 'Gaustadalléen', '21', NULL, '0349', 'Oslo', 'Norge', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672854261.png', NULL, NULL, '2023-01-04 17:42:27', '2023-03-02 19:25:08'),
(7, 'CEC Event ApS', 'tino@cecevent.dk', '$2y$10$nmE1W07Lb3K4HqZaBgzvVOyje.y7aytTN/mLgKaNnEvTKpP77ncGW', '(+45) 22 22 30 65', NULL, 'Copenhagen Event Company', '40711805', NULL, NULL, '3,10,11,12,13,14', '6', 'Active', NULL, 'Arrangementer & Events', NULL, 'Østvej', '13C', NULL, '3230', 'Græsted', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672855273.png', NULL, NULL, '2023-01-04 17:54:40', '2023-02-24 12:56:57'),
(8, 'DTD Concerts ApS', 'info@dtdconcerts.dk', '$2y$10$Sv1nwdEU6pEnWhxgywayqOTLxlfQJpTFqO6GxLjEmspStVgfpDL5y', '(+45) 70 20 26 22', NULL, NULL, '36403675', NULL, '5790002490286', '3,10,11,12,13,14', '6,8,9', 'Active', NULL, 'Koncerter & Festivaler', NULL, 'Studsgade', '35B', 'st. Baghuset', '8000', 'Århus C', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672856553.png', NULL, NULL, '2023-01-04 18:15:17', '2023-02-24 12:38:25'),
(9, 'EventCrew Security ApS', 'kontakt@eventcrew.dk', '$2y$10$Q3qYb89V8BlmTSPeyAEY7ejir/CzrHJT7eqF1KFY/lPkQg2A17VLO', '(+45) 42 42 25 15', NULL, NULL, '41314567', NULL, NULL, '3,10,11,12,13,14', '6,7,8', 'Active', NULL, 'Arrangementer & Events', NULL, 'Svanevej', '17', NULL, '3650', 'Ølstykke', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672857355.png', NULL, NULL, '2023-01-04 18:34:57', '2023-02-24 12:57:46'),
(10, 'EVENTUALLY ApS', 'hello@eventually.dk', '$2y$10$h9RYP06HoPJpSmzGWLcwyOuzmyUJN4URzHbvU.bTbJjuWb5m7Blpa', '(+45) 27 59 55 95', NULL, NULL, '33148976', NULL, NULL, '3,10,11,12,13,14', '6', 'Active', NULL, 'Arrangementer & Events', NULL, 'Magstræde', '10A', '2', '1204', 'København K', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672859222.png', NULL, NULL, '2023-01-04 19:05:15', '2023-02-24 12:58:02'),
(11, 'Grappling Industries Europe', 'grapplingindustrieseurope@gmail.com', '$2y$10$2AxwY7HDLs/dxceP9seZ7e.mahonmxDzw.JXBKv75qn0lD9fwiPZ2', '.', NULL, NULL, '.', NULL, NULL, '3,10,11,12,13,14', '6', 'Active', NULL, 'Kampsport', 'Hafnia-Hallen,', 'Julius Andersens Vej', '6', NULL, '2450', 'København', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672860385.png', NULL, NULL, '2023-01-04 19:23:08', '2023-02-24 12:58:17'),
(12, 'HB Køge A/S', 'sj@hbkoge.dk', '$2y$10$6GvBaTlxdU55x2ZXNKQcwO/yo1gBQZkMvVmSljbCVFQXkeZdQmRYC', '(+45) 56 27 60 21', NULL, NULL, '32277748', NULL, NULL, '10,11,12', '7', 'Active', NULL, 'Fodbold', NULL, 'Ved Stadion', '4', '1. sal', '4600', 'Køge', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672860896.png', NULL, NULL, '2023-01-04 19:31:59', '2023-02-24 12:58:28'),
(13, 'Lillebaelt Halvmarathon', 'info@lillebaelthalvmarathon.dk', '$2y$10$M1uXy.x0yW3YyMTpQEXTlu9Ldb86Y187HZFqj4Heb96bfipsKGqLy', '.', NULL, NULL, '31239400', NULL, NULL, '3,10,11,12,13', '8', 'Active', NULL, 'Sportsløb', NULL, 'Smallevej', '3', NULL, '5592', 'Ejby', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672861838.png', NULL, NULL, '2023-01-04 19:49:28', '2023-02-24 12:59:22'),
(14, 'MD Medicus Assistance Service GmbH', 'assistance@md-medicus.net', '$2y$10$RpB7HPVZyhBe1BY0jAp4QO98KFhNFEilJOeYVvhHAyIt2gDWTCFlm', '(+49) 621 549 01 71', NULL, 'Kontakt via AMS Assistanse A/S', NULL, NULL, NULL, '3,10,11,12,13,14', NULL, 'Active', NULL, 'Ambulancefly', NULL, 'Industriestrasse', '2a', NULL, '67063', 'Ludwigshafen', 'Germany', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672862348.png', NULL, NULL, '2023-01-04 19:55:25', '2023-01-04 20:05:43'),
(15, 'Nord-Als Svømmeklub', 'formand@nord-als.dk', '$2y$10$62gpUHQ0LfFdvLANiyeAnOM0S7GuN3Gx0FYkiZcnHuNmifp22aYUC', '(+45) 30 27 02 72', NULL, NULL, '84846910', NULL, NULL, '17', '8', 'Active', NULL, 'Sport', NULL, 'Ellekobbel', '10', NULL, '6430', 'Nordborg', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672863035.png', NULL, NULL, '2023-01-04 20:09:02', '2023-02-24 13:00:02'),
(16, 'SDK Cruise A/S', 'cruise.dk@sdkgroup.com', '$2y$10$xjJNHqDQr/XNbPsC1bxOeOX2gFzub8bOA/Iz7F/ULdh6hKbutWlyC', '(+45) 33 44 17 10', NULL, NULL, '36483113', NULL, NULL, '3,10,11,12,13,14,15', '6', 'Active', NULL, 'Smitteberedskab', NULL, 'Dampfærgevej', '32', NULL, '2100', 'København Ø', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672865887.png', NULL, NULL, '2023-01-04 20:56:08', '2023-02-24 13:01:03'),
(17, 'Sportsaktiviteter ApS', 'ce@sportsaktiviteter.dk', '$2y$10$qWNdhC0ZmHXbbHbwbwpPJeVX8EBnino8PheNnDE42a6KMgxL0ecM.', '(+45) 28 30 43 05', NULL, NULL, '32826520', NULL, NULL, '3,10,11,12,13,14', '6', 'Active', NULL, 'Sport', NULL, 'Skovbovængets Sidealle', '21', NULL, '4000', 'Roskilde', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672866256.png', NULL, NULL, '2023-01-04 21:02:12', '2023-02-24 13:01:20'),
(18, 'Medical Air Service Vendana GmbH', 'info@vendana.de', '$2y$10$zBRRvn3qxmeEdb8zWG5XVuuJ5w4w5aAtbx3RhT47lm6xDWYw0gZ4G', '(+49) 202 75 88 69 0', NULL, 'https://www.medical-air-service.com', NULL, NULL, NULL, '3,11,12,13,14,15', NULL, 'Active', NULL, 'Ambulancefly', NULL, 'Engelsstraße', '6', NULL, '42283', 'Wuppertal', 'Deutschland', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672866776.png', NULL, NULL, '2023-01-04 21:11:46', '2023-01-04 21:25:36'),
(19, 'Københavns Professionshøjskole S/I', 'info@kp.dk', '$2y$10$SylktxZzue1VHQf.Mr283.CU0a4oOvILneT9pQiUoqDue6G1L2Syu', '(+45) 70 89 09 90', NULL, NULL, '30891732', NULL, '5798009882905', '17', '6', 'Active', NULL, 'Uddannelse', 'Sygeplejerskeuddannelsen,', 'Carlsbergvej', '14', NULL, '3400', 'Hillerød', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672868127.png', NULL, NULL, '2023-01-04 21:33:01', '2023-02-24 12:58:54'),
(20, 'Det Kongelige Teater og Kapel', 'admin@kglteater.dk', '$2y$10$NRau.Q.e6Jb/qMiQRVwDhuNSmc9Dp.bRsgTegUSe3fbVpIoQjsqJm', '(+45) 33 69 69 33', NULL, NULL, '10842255', NULL, '5798000791282', '3,10,11,12,13,14', '6', 'Active', NULL, 'Smitteberedskab', NULL, 'August Bournonvilles Passage', '2', NULL, '1055', 'København K', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672868605.png', NULL, NULL, '2023-01-04 21:41:21', '2023-02-24 12:56:43'),
(21, 'Profil Match ApS', 'profilmatch@profilmatch.dk', '$2y$10$zfYfMHzPRR.aIc7ZEysz7.um.tiuJAO5KTUhXxvQlcRfvdWCT5WAC', '(+45) 33 32 33 14', NULL, NULL, '10084067', NULL, NULL, '1,3,10,11,12,13,14,15', '6,7', 'Active', NULL, 'Smitteberedskab', NULL, 'Stationsparken', '25', '1', '2600', 'Glostrup', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672869410.png', NULL, NULL, '2023-01-04 21:54:26', '2023-02-24 13:00:23'),
(22, 'Falck Global Assistance A/S', 'fga@dk.falck.com', '$2y$10$iH.CBC9rvHu4pgHEQuC0Su7GUznXR778wSzaR/cJRycxmgES4ZEGi', '(+45) 70 25 04 05', NULL, NULL, '16271241', NULL, NULL, '3,11,12,13,14,15', NULL, 'Active', NULL, 'Sygetransport', NULL, 'Sydhavnsgade', '18', NULL, '2450', 'København SV', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672870518.png', NULL, NULL, '2023-01-04 22:13:50', '2023-01-04 22:15:18'),
(23, 'Flexflight ApS', 'sales@flexflight.dk', '$2y$10$oss7lXmPq.RhjnPJ.uOLye6KBlC.FVCR4gRIg2VSvhuTgyfN2eJyu', '(+45) 45 80 70 60', NULL, NULL, '27376770', NULL, NULL, '3,11,12,13,14', NULL, 'Active', NULL, 'Ambulancefly', NULL, 'Lufthavnsvej', '50', NULL, '4000', 'Roskilde', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672875498.png', NULL, NULL, '2023-01-04 23:36:25', '2023-01-04 23:38:18'),
(24, 'Gouda Rejseforsikring', 'gouda@gouda.dk', '$2y$10$grbUQ9YE9kL3jHKy/N83YeqkXgMT6b8o4WkexbGVmIuVEw7mbQVP2', '(+45) 88 20 88 20', NULL, NULL, '33259247', NULL, NULL, '3,10,11,12,13,14', NULL, 'Active', NULL, 'Sygetransport & Ambulancefly', NULL, 'A.C. Meyers Vænge', '9', NULL, '2450', 'København SV', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672876623.png', NULL, NULL, '2023-01-04 23:55:57', '2023-01-04 23:57:03'),
(25, 'Region Hovedstadens Akutberedskab', 'akutberedskabet@regionh.dk', '$2y$10$C6kLVHUrZbBsjOWvii8iLO6JX33XY70EVWUEYOkul8QVOgZZibBju', '(+45) 38 69 80 00', NULL, NULL, '29190623', NULL, NULL, '11,12,13', '6', 'Active', NULL, 'Ambulance & Sygetransport', NULL, 'Telegrafvej', '5', NULL, '2750', 'Ballerup', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672877508.png', NULL, NULL, '2023-01-05 00:09:33', '2023-02-24 13:00:42'),
(26, 'SOS International A/S', 'sos@sos.eu', '$2y$10$ygUXUHska5I9nsqJpi.Muu5fsnWJLH3W0H5YqXa.giNXRDqP4UpgO', '(+45) 70 10 50 55', NULL, NULL, '17013718', NULL, NULL, '11,12,13', NULL, 'Active', NULL, 'Ambulance & Sygetransport', NULL, 'Nitivej', '6', NULL, '2000', 'Frederiksberg', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672878004.png', NULL, NULL, '2023-01-05 00:18:57', '2023-01-05 00:20:04'),
(27, 'Rødby Go-Kart Klub', 'rgkk@rgkk.dk', '$2y$10$gGq3Ngu0t7tXEhXtjpiVG.uGr.q9Nv8qNVw8v6Q4O2uiBx9W39k8i', '(+45) 20 82 24 63', NULL, NULL, '30866770', NULL, NULL, '11,12,13', '7', 'Active', NULL, 'Ambulance', NULL, 'Færgevej', '26', NULL, '4970', 'Rødbyhavn', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1672879383.png', NULL, NULL, '2023-01-05 00:36:27', '2023-02-24 12:35:35'),
(28, 'MSM Slagelse MX Slotsbjergbybanen', 'formand@msm-cross.dk', '$2y$10$jsm/23/dnHoO2EsWFu6f3eD.HEYiu1I8UM7B5sCUjpYNZKdH9cWoi', '(+45) 29 89 94 57', NULL, NULL, '34151490', NULL, NULL, '10,11,12,13', '7', 'Active', NULL, 'Motorsport', NULL, 'Jættehøjvej', '8B', NULL, '4200', 'Slagelse', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1673287514.png', NULL, NULL, '2023-01-09 18:03:56', '2023-02-24 12:59:43'),
(29, 'DK RESCUE Beredskab ApS', 'casper@dk-rescue.dk', '$2y$10$uGZG7eRdOuA107AKUjkKN.kFHyjT2T3N62IZMofakSuarG9DluJ8u', '93999772', NULL, NULL, '43823868', NULL, NULL, NULL, '8,9', 'Active', NULL, 'Samaritter', NULL, 'Straussvej', '16', NULL, '7500', 'Holstebro', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1679521585.png', NULL, NULL, '2023-03-01 19:10:28', '2023-03-22 21:46:25'),
(30, 'Rock Under Broen', 'info@rub.dk', '$2y$10$jqRRBE6vPybDqAQFZjIUbeqkCbFhJFzVq2sZniDTsvnVAC03.3if6', '.', NULL, NULL, NULL, NULL, NULL, NULL, '8', 'Active', NULL, 'Festival', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '2023-03-01 20:05:05', '2023-03-01 20:05:05'),
(31, 'Odense Atletik (OGF)', 'pernille@ogf.dk', '$2y$10$sI//NL6t3P9Ye11LYf04Vuh9MjCDoGe052pIQeyaXYCJrVsb7YTem', '(+45) 50 47 03 60', NULL, NULL, NULL, NULL, NULL, NULL, '8', 'Active', NULL, 'Sportsarrangement', NULL, 'Stadionvej', '25', NULL, '5200', 'Odense V', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1678191427.png', NULL, NULL, '2023-03-07 12:13:24', '2023-03-07 12:17:07'),
(32, 'DMC Denmark A/S', 'invoicedk@dmc-nordic.com', '$2y$10$nfJkEr3agKJK1oSkW79Edu3XbbqsFrRmh1LOpE1ZQTiHeK79ZcCDa', '(+45) 33 12 12 00', NULL, NULL, '17143379', NULL, NULL, NULL, '6', 'Active', NULL, 'Ambulance', NULL, 'Middelfartgade', '15', '1', '2100', 'København Ø', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1678971549.png', NULL, NULL, '2023-03-16 12:55:55', '2023-03-16 12:59:09'),
(33, 'SF STUDIOS PRODUCTION ApS', 'info@sfstudios.dk', '$2y$10$SbSD5HOVGMIviA9N3fz.G.WnxTpyAPTzRyB95P/1017AQykJMUGZ2', '(+45) 70 26 76 26', NULL, NULL, '26390168', NULL, NULL, NULL, '6', 'Active', NULL, 'TV- og filmproduktion', NULL, 'Wildersgade', '8', NULL, '1408', 'København K', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1679055555.png', NULL, NULL, '2023-03-17 12:18:12', '2023-03-17 12:19:15'),
(34, 'MEH Group Denmark (Danish Karting League)', 'mads@danishkartingleague.dk', '$2y$10$UeTjWQzez7JVDyOEQepRp.7xz.dkVV3Cw82dCYo4twxvUOn91Edhq', '(+45) 20 31 08 00', NULL, NULL, '40864873', NULL, NULL, NULL, '7', 'Active', NULL, 'Motorsport', NULL, 'Engdraget', '4', NULL, '5792', 'Årslev', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1679597504.png', NULL, NULL, '2023-03-23 18:50:49', '2023-03-23 18:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `customer_assignments`
--

CREATE TABLE `customer_assignments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `contact_person_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `co_line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_navn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `information` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_assignments`
--

INSERT INTO `customer_assignments` (`id`, `user_id`, `contact_person_id`, `name`, `co_line`, `street_navn`, `street_no`, `street_level`, `po_code`, `city_name`, `country`, `information`, `status`, `created_at`, `updated_at`) VALUES
(7, 21, NULL, 'Telegrafvej i ballerup', NULL, 'Telegrafvej', '5', NULL, '2750', 'Ballerup', 'Denmark', NULL, 'Active', '2022-12-29 15:30:59', '2022-12-29 15:30:59'),
(8, 4, NULL, 'Demo assignment for testing', NULL, 'Hjørnegårdsvej', '1', NULL, '4623', 'Lille Skensved', 'Denmark', 'This is general information about this upcomming assignment, lets hope it works well', 'Active', '2023-02-13 13:38:32', '2023-02-13 13:38:32'),
(9, 1, 8, 'Akutbil + Skadestue', NULL, 'Battrupholtvej', '3', NULL, '8581', 'Nimtofte', 'Denmark', NULL, 'Active', '2023-02-18 13:47:14', '2023-04-10 09:46:08'),
(10, 8, NULL, 'NorthSide Festival', NULL, 'Eskelundvej', '13', NULL, '8260', 'Århus', 'Denmark', 'Stor fest her :)', 'Active', '2023-02-21 13:23:21', '2023-02-21 13:23:21'),
(11, 8, NULL, 'TinderBox festival', NULL, 'Falen', '155', NULL, '5250', 'Odense', 'Denmark', NULL, 'Active', '2023-02-21 13:24:43', '2023-02-21 13:24:43'),
(12, 29, NULL, 'Århus Marathon', NULL, 'Sønder Alle', '2', NULL, '8000', 'Århus', 'Denmark', NULL, 'Active', '2023-03-01 19:39:37', '2023-03-01 19:39:37'),
(13, 27, NULL, 'Champions of the future 2023', NULL, 'Færgevej', '26', NULL, '4970', 'Rødby', 'Denmark', NULL, 'Active', '2023-03-01 19:56:11', '2023-03-01 19:56:11'),
(14, 27, NULL, 'EM i karting 2023', NULL, 'Færgevej', '26', NULL, '4970', 'Rødby', 'Denmark', NULL, 'Active', '2023-03-01 19:56:58', '2023-03-01 19:56:58'),
(15, 12, 23, 'Køge Stadion', NULL, 'Ved Stadion', '4', '1. sal', '4600', 'Køge', 'Denmark', NULL, 'Active', '2023-03-13 18:49:53', '2023-04-03 09:02:06'),
(16, 12, 23, 'Brøndby Stadion', NULL, 'Brøndby Stadion', '30', NULL, '2605', 'Brøndby', 'Denmark', 'Bane 2', 'Active', '2023-03-13 18:50:58', '2023-04-03 09:02:26'),
(17, 33, NULL, 'Projekt - Cykose', 'Frederiksberg Hospital', 'Nordre Fasanvej', '57', NULL, '2000', 'Frederiksberg', 'Danmark', NULL, 'Active', '2023-03-17 12:23:00', '2023-03-17 12:23:00'),
(18, 34, NULL, 'Rødby Karting Ring', NULL, 'Færgevej', '26', NULL, '4970', 'Rødby', 'Danmark', 'Indlejet', 'Active', '2023-03-23 18:53:27', '2023-03-23 18:55:33'),
(19, 17, NULL, 'Glostrup Torv', NULL, 'Glostrup Torv', '1', NULL, '2600', 'Glostrup', 'Denmark', 'Christian Ebbe\r\n(+45) 28 30 43 05', 'Active', '2023-03-29 13:14:28', '2023-03-31 07:22:20'),
(20, 1, 8, 'Førstehjælpskursus', NULL, 'Battrupholtvej', '3', NULL, '8581', 'Nimtofte', 'Danmark', NULL, 'Active', '2023-04-01 13:44:02', '2023-04-10 09:12:55'),
(21, 8, NULL, 'Førstehjælpskursus', NULL, 'Falen', '200', NULL, '5250', 'Odense', 'Danmark', 'FGU Fyn (Produktions skolen Odense)', 'Active', '2023-04-01 13:58:50', '2023-04-01 13:58:50');

-- --------------------------------------------------------

--
-- Table structure for table `customer_associateds`
--

CREATE TABLE `customer_associateds` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_associateds`
--

INSERT INTO `customer_associateds` (`id`, `user_id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(2, 21, 'sfdsfds', 'sdfsdfsdfsdfdf', '2022-12-22 15:27:05', '2022-12-22 15:27:05'),
(4, 34, 'Ambulance til Motorsport', 'Kr. 1.100,-', '2023-03-23 18:57:52', '2023-03-23 18:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `customer_banks`
--

CREATE TABLE `customer_banks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `payrol_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rit_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `swift_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_banks`
--

INSERT INTO `customer_banks` (`id`, `user_id`, `payrol_number`, `bank_name`, `rit_number`, `account_number`, `swift_number`, `created_at`, `updated_at`) VALUES
(1, 18, '505', 'ABL Bank', '5566546', '565645', '65465', '2022-12-22 09:07:43', '2022-12-22 09:07:43'),
(2, 21, '505', 'ABL Bank', '5566546', '565645', '65465', '2022-12-27 14:58:36', '2022-12-27 14:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `customer_contacts`
--

CREATE TABLE `customer_contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_contacts`
--

INSERT INTO `customer_contacts` (`id`, `user_id`, `name`, `phone`, `email`, `picture`, `position`, `created_at`, `updated_at`) VALUES
(8, 1, 'Michael B. Nielsen', '(+45) 23 39 84 00', 'mbm@djurssommerland.dk', 'contact-1672686260.jpg', 'Adm. Direktør', '2023-01-02 19:04:20', '2023-01-02 19:04:20'),
(9, 1, 'Henrik B. Nielsen', '(+45) 20 48 68 16', 'hbn@djurssommerland.dk', 'contact-1672686411.jpg', 'Adm. Direktør', '2023-01-02 19:06:51', '2023-01-02 19:06:51'),
(10, 1, 'Kris Nørgaard Laursen', '(+45) 23 22 59 64', 'knl@djurssommerland.dk', '', 'Områdeleder - Forlystelser', '2023-01-02 21:25:54', '2023-01-02 21:25:54'),
(11, 2, 'Bjarne Guldbaek Jörgensen', '(+45) 22 60 48 06', 'bj.joergensen@enbw.com', '', '.', '2023-01-02 21:47:20', '2023-01-02 21:47:20'),
(12, 2, 'Thomas Carsten Sørensen', '(+45) 25 72 18 79', 't.soerensen@enbw.com', '', 'Connected Wind Services Danmark A/S', '2023-01-02 22:03:20', '2023-01-02 22:03:20'),
(13, 2, 'Markus Straub', '(+49) 157 78 77 70 04', 'markus.straub@enbw.com', '', 'EOS HSE Manager Hohe See/Albatros', '2023-01-02 22:05:10', '2023-01-02 22:05:10'),
(14, 4, 'Manila Vitale', '(+39) 34 01 91 31 62', 'm.vitale@airmedicalservice.eu', '', 'Operationsmanager', '2023-01-02 22:20:45', '2023-01-02 22:20:45'),
(15, 5, 'Monica Fortea Garcia', '(+34) 620 090 991', 'mfortea@air-marine-int.com', 'contact-1672852770.png', 'CEO & Medical Director', '2023-01-04 17:19:30', '2023-01-04 17:19:30'),
(16, 6, 'Gaute Gerotti Skjørestad', '.', '.', '', 'MCC Duty Nurse', '2023-01-04 17:45:24', '2023-02-26 14:12:51'),
(17, 7, 'Bo Ilskjær', '(+45) 25 90 12 12', 'bo@cecevent.dk', 'contact-1672855252.jpg', 'Partner', '2023-01-04 18:00:52', '2023-01-04 18:00:52'),
(18, 8, 'Per Beck-Nielsen', '(+45) 43 14 14 70', 'per@downthedrain.dk', 'contact-1672856633.jpg', 'Security Manager', '2023-01-04 18:23:53', '2023-01-04 18:23:53'),
(19, 8, 'Allan Ottesen', '.', 'allan@downthedrain.dk', 'contact-1672856893.jpg', 'Production Director', '2023-01-04 18:28:13', '2023-01-04 18:28:13'),
(20, 9, 'Thomas Hedme', '(+45) ‪42 42 50 03', 'th@eventcrew.dk', 'contact-1672857661.jpg', 'Direktør', '2023-01-04 18:41:01', '2023-01-04 18:41:01'),
(21, 10, 'Line Søgaard', '(+45) 41 73 10 53', 'line@eventually.dk', 'contact-1672859475.png', 'Project Coordinator', '2023-01-04 19:11:15', '2023-01-04 19:11:15'),
(22, 12, 'Alfred Winther Groth', '(+45) 22 26 86 72', 'awg@hbkoge.dk', 'contact-1672861002.jpg', 'Head of Women\'s Football', '2023-01-04 19:36:42', '2023-01-04 19:36:42'),
(23, 12, 'Søren P. Jørgensen', '(+45) 20 82 90 51', 'sj@hbkoge.dk', 'contact-1672861190.png', 'Sikkerhedschef', '2023-01-04 19:39:50', '2023-01-04 19:39:50'),
(24, 13, 'Mads Stryhn', '(+45) 40 13 13 43', 'madsstryhn@gmail.com', 'contact-1672862012.jpg', 'Løbsleder', '2023-01-04 19:53:32', '2023-01-04 19:53:32'),
(25, 14, 'Alexander Kempf', '(+49) 06 21 54 90 12 03', 'accounting@md-medicus.net', '', 'Leiter Finanzdisposition In- und Ausland', '2023-01-04 20:00:16', '2023-01-04 20:00:32'),
(26, 15, 'Thomas Evald', '(+45) 21 64 67 66', 'thomas.evald@outlook.dk', 'contact-1672863135.jpg', '.', '2023-01-04 20:12:15', '2023-01-04 20:12:15'),
(27, 17, 'Christian Ebbe', '(+45) 28 30 43 05', 'ce@sportsaktiviteter.dk', 'contact-1672866440.jpg', 'Direktør', '2023-01-04 21:07:20', '2023-01-04 21:07:20'),
(28, 18, 'Narciso Ribeiro', '(+49) 202 75 88 69 0', 'n.ribeiro@ops.vendana.de', 'contact-1672866908.jpg', 'Aviation Consultant', '2023-01-04 21:15:08', '2023-01-04 21:15:08'),
(29, 19, 'Sasha Reinhardt', '(+45) 41 89 72 66', 'sare@kp.dk', 'contact-1672868207.jpg', 'Lektor', '2023-01-04 21:36:47', '2023-01-04 21:36:47'),
(30, 19, 'Monire Ahmadi', '(+45) 41 89 74 71', 'moah@kp.dk', '', 'Økonomikonsulen', '2023-01-04 21:38:01', '2023-01-04 21:38:01'),
(31, 20, 'Annette Berner', '(+45) 25 51 76 90', 'anbe@kglteater.dk', '', 'Chef turné og gæstespil', '2023-01-04 21:51:10', '2023-01-04 21:51:10'),
(32, 24, 'Gouda Alarm', '(+45) 33 15 60 60', 'alarm@gouda.dk', 'contact-1672876771.png', 'Hjælp døgnet rundt og verden rundt', '2023-01-04 23:59:31', '2023-01-04 23:59:31'),
(33, 24, 'Yasir Ahmed', '.', '.', '', '.', '2023-01-05 00:00:55', '2023-01-05 00:00:55'),
(34, 27, 'Erik Lystrup', '(+45) 40 58 65 95', 'erik@boliglf.dk', '', 'Formand', '2023-01-05 00:38:42', '2023-01-05 00:38:42'),
(36, 28, 'Jesper Rasmussen', '(+45) 29 89 94 57', 'formand@msm-cross.dk', 'contact-1673287694.jpg', 'Formand', '2023-01-09 18:08:14', '2023-01-09 18:08:14'),
(37, 29, 'Casper Olesen', '93999772', 'casper@dk-rescue.dk', '', 'Adm.direktør', '2023-03-01 19:24:55', '2023-03-01 19:24:55'),
(38, 31, 'Pernille Borup Jensen', '(+45) 50 47 03 60', 'pernille@ogf.dk', '', 'Ansvarlig for markedsføring og events', '2023-03-07 12:18:39', '2023-03-07 12:18:39'),
(39, 32, 'Petio Petkov', '(+45) 23 99 88 86', 'Petio@dmc-nordic.com', 'contact-1678971634.jpg', 'Senior MICE Manager & Idea Development Wild Child', '2023-03-16 13:00:34', '2023-03-16 13:00:34'),
(40, 33, 'Lene Ejlersen', '(+45) 21 92 23 05', 'leneejlersen@gmail.com', 'contact-1679055616.jpg', 'Chefrekvisitør', '2023-03-17 12:20:16', '2023-03-17 12:20:16'),
(41, 34, 'Mads Eielsø Hansen', '(+45) 20 31 08 00', 'mads@danishkartingleague.dk', '', 'Founder & CEO', '2023-03-23 18:52:21', '2023-03-23 18:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `customer_documents`
--

CREATE TABLE `customer_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visibility` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_documents`
--

INSERT INTO `customer_documents` (`id`, `admin_id`, `user_id`, `title`, `document`, `visibility`, `status`, `read_at`, `created_at`, `updated_at`) VALUES
(2, 12, 21, 'Virker dette ?', 'FE9CNWZT-J1D2-OXTS-6531-P85QEOSWKIHD.pdf', 'Hidden', 'UnRead', NULL, '2022-12-22 11:14:19', '2022-12-22 11:14:19'),
(3, 12, 6, 'adawawd', 'V6WKIYPB-WVBK-S2FN-T3ZQ-MJYZTXFNKPS8.pdf', 'Hidden', 'UnRead', NULL, '2023-02-17 18:40:54', '2023-02-17 18:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `customer_notes`
--

CREATE TABLE `customer_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_notes`
--

INSERT INTO `customer_notes` (`id`, `admin_id`, `user_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 18, 'y', 'y', '2022-12-22 09:38:08', '2022-12-22 09:38:08'),
(2, 12, 21, 'Talt med ejeren', '<p>Har talt med skaldmklasd</p>\r\n\r\n<p>ljahdls a&aelig;sdj&aelig;saljd &aelig;laskd&aelig;lka &aelig;alkdss &aelig;sf&aelig;lj adg&aelig;ka a&aelig;ksdjg&aelig;skf&aelig;kpejjgie piwejpijwkdjf &aelig;kj</p>', '2022-12-22 11:16:08', '2022-12-22 11:16:08'),
(3, 12, 28, 'dsfsd', '<p>sdfdsf</p>', '2023-01-09 18:18:19', '2023-01-09 18:18:19'),
(5, 20, 13, 'kontakt', '<p>Mikkel har taget kontakt til Mads ifht om vi skulle forts&aelig;tte samarbejdet. mads vil vende tilbage da han har outsourcet lidt af opgaverne. info mail er givet samt tlf til ham, s&aring; han kan ringe tilbage.</p>', '2023-02-15 08:47:47', '2023-02-15 08:47:47'),
(6, 12, 27, 'Tilbud på EM', '<p>Der er d.d. fremsendt tilbud p&aring; Champions of the future og EM til Erik.</p>\r\n\r\n<p>Der er givet tilbud p&aring; sundhedsfaglige til 450,- i stedet for samaritter.</p>', '2023-02-15 08:49:31', '2023-02-15 08:49:31'),
(7, 12, 6, 'asdasd', '<p>adwadawd</p>', '2023-02-17 18:39:38', '2023-02-17 18:39:38'),
(8, 12, 27, 'Opfølgning EM', '<p>Jeg har d.d. sendt en email til Erik om opf&oslash;lgning for EM i juni mdr., samt for at h&oslash;re om han havde sp&oslash;rgsm&aring;l.</p>', '2023-02-24 12:37:21', '2023-02-24 12:37:21'),
(9, 12, 9, 'Tilbud på Rock Under Broen 2023', '<p>Jeg har d.d. sendt tilbud p&aring; RUB 2023 (9.+10. juni 2023), tilbudsprisen blev 120.000,- ekskl. moms. Tilbudsfristen er sat til 3. april 2023 og det er sendt via email til Thomas Hedme.</p>', '2023-02-24 12:40:24', '2023-02-24 12:40:24'),
(10, 12, 34, 'Tilbud -> Event 15. april 2023', '<p>Timepris: 1100,-<br />\r\nTransport: 1,5 time tur/retur</p>\r\n\r\n<blockquote>\r\n<p>Eventet er fra 08.00 - 18.00 - kan i sende mig en pris p&aring; dette...</p>\r\n</blockquote>', '2023-03-23 18:57:06', '2023-03-23 18:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint UNSIGNED NOT NULL,
  `group_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `editor` longtext COLLATE utf8mb4_unicode_ci,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `must_read` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counts` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `group_id`, `category`, `icon`, `title`, `subtitle`, `pdf`, `editor`, `keyword`, `must_read`, `period`, `counts`, `created_at`, `updated_at`) VALUES
(21, '16', '29', 'file-text', 'PRI dokumentstyrings- og håndteringsmodel', 'DOKUMENT ID-NR.: PRI.02.01.001', 'E7KWJH52-86PG-WJ23-RX2P-J8L3WXS5AYGV.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'pri', 'Disabled', '1-Y', 9, '2022-10-08 06:06:19', '2023-04-10 11:24:11'),
(22, '11,13,14', '36', 'file-text', 'Djurs Sommerland - 1. Driftstandard', 'DOKUMENT ID-NR.: PRI.03.01.001', 'GJRNEVPL-3LNM-92BH-17G9-5317HGNOK8IP.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'DS', 'Disabled', '1-Y', 11, '2022-10-08 06:09:49', '2023-04-10 10:52:50'),
(23, '11,13,14', '36', 'file-text', 'Djurs Sommerland - 2. Juvelen', 'DOKUMENT ID-NR.: PRI.03.01.002', 'OTYDL67F-5S0L-M0RJ-0CQG-AKHIGBYET1Z4.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'DS', 'Disabled', '1-Y', 9, '2022-10-08 06:11:22', '2023-04-10 10:53:19'),
(24, '11,13,14', '36', 'file-text', 'Djurs Sommerland - 3. Vejledning til skaderegistrering', 'DOKUMENT ID-NR.: PRI.03.01.003', 'QKS1IAE8-01VG-B1W6-QZ41-K2HLDNYOWP1I.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Ambulancejournal, PPJ,Journal, Rapport', 'Disabled', '1-Y', 1, '2022-10-08 14:55:18', '2022-10-11 16:00:51'),
(25, '11,13,14', '36', 'file-text', 'Djurs Sommerland - Intern Beredskabsplan', 'Ulykke- og krisehåndteringsprocedurer', 'KF27ZXCL-INEJ-E5DB-2K60-7WEXRNMVF60Y.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'DS,Kriseledelse', 'Disabled', '1-Y', 1, '2022-10-08 14:57:05', '2022-10-11 16:00:57'),
(26, '11,13,14', '36', 'file-text', 'Djurs Sommerland - Intern Krisehåndbog 2020 (v2)', 'Krisehåndbog', 'IFB2O105-1Z6R-HMWR-F607-C624F35NDT81.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'DS,Krise', 'Disabled', '1-Y', 2, '2022-10-08 14:59:38', '2022-12-27 11:17:09'),
(27, '11,13,14', '36', 'file-text', 'Djurs Sommerland - Intern Personalehåndbog 2021', 'Personalepolitik', 'BXD9I14C-PN9V-DYM3-QIDH-WS64OG250IV1.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'DS', 'Disabled', '1-Y', 1, '2022-10-08 15:01:29', '2022-10-16 18:46:23'),
(28, '11,13,14', '36', 'file-text', 'Djurs Sommerland - Intern Servicetavle 2021', 'Telefonliste', 'MVWQKC6L-AT0X-2W69-GK4P-H0LM24SE6BCN.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'DS,Kontaktpersoner', 'Disabled', '1-Y', 1, '2022-10-08 15:02:13', '2022-10-18 11:21:06'),
(29, '3,10,11,13,14', '33', 'file-text', 'Acetylsalicylsyre', 'PRI.03.02.002', 'X9P7V8FD-2HT4-37IO-KQCH-PGKVAHEI63LZ.pdf', '<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\">\r\n<h3>G&aelig;ldende for</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><big><strong>KOMPETENCENIVEAU</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>Ambulancebehandler</td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>Paramediciner</td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>Sygeplejerske</td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>L&aelig;ge</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#d5eddd; border:1px solid #cddbce; padding:5px 10px\">\r\n<h3>Anvendelse</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><big><strong>INDIKATION</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">Ved mistanke om AKS/AMI.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>DOSIS</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>300 mg</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSM&Aring;DE</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>Per Oralt (PO)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSFORM</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>Tabletter &aacute; 150 mg</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#f7d7da; border:1px solid #e9ccd1; padding:5px 10px\">\r\n<h3>Vigtigt</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><big><strong>KONTRAINDIKATION</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kendt allergi/cave for acetylsalicylsyre / NASID pr&aelig;parater samt aktiv bl&oslash;dning.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>BIVIRKNINGER</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>&Oslash;get bl&oslash;dningstendens, mavesmerter, sure opst&oslash;d, allergisk reaktion (herunder; diarr&eacute;, uticaria, angio&oslash;dem, hypotension og/eller respirationsbesv&aelig;r.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>INTERAKTIONER</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Andre former for antikoagulantia (clopidogrel, prasugrel etc.) forst&aelig;rker effekten af acetylsalicylsyre.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#fff3cd; border:1px solid #f8e8c7; padding:5px 10px\">\r\n<h3>S&aelig;rligt</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><big><strong>S&AElig;RLIGE FORHOLD</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Husk at sp&oslash;rge patienten om allergi / cave f&oslash;r administration af medicin.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#d4ebf3; border:1px solid #c6e0e1; padding:5px 10px\">\r\n<h3>Medikament</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><big><strong>FARMAKOLOGI</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>H&aelig;mmer blodpladernes tendens til at kl&aelig;be til karv&aelig;ggen og til at klumpe sig sammen. Herved neds&aelig;ttes risikoen for dannelse af blodpropper.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>FARMAKOKINETIK</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Optages via mave-tarm kanalen og nedbrydes i leveren og udskilles i urinen.&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>HOLDBARHED</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Se pakning</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', 'ASA,Hjertemagnyl,Akut myokardieinfarkt (AMI),Akut koronart syndrom (AKS),Ustabil angina pectoris (UAP),Ustabil hjertekrampe', 'Enabled', '1-Y', 186, '2022-10-08 15:11:16', '2023-04-12 07:23:52'),
(30, '3,10,11,13,14', '33', 'file-text', 'Adrenalin', 'PRI.03.02.001', '2LDMVYCQ-3YTC-0F1R-7GZN-ONI4ZYGCF15K.pdf', '<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\">\r\n<h3>G&aelig;ldende for</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><big><strong>KOMPETENCENIVEAU</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>Ambulancebehandler</td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>Paramediciner</td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>Sygeplejerske</td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>L&aelig;ge</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#d5eddd; border:1px solid #cddbce; padding:5px 10px\">\r\n<h3>Anvendelse&nbsp;<small>(Anafylaksi)</small></h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><big><strong>INDIKATION</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">Kraftig allergisk reaktion, hvor enten A, B eller C er truet.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>DOSIS - IM</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>⊙&nbsp;Voksen</strong></td>\r\n			<td>&nbsp;0,5 mg</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>⊙&nbsp;B&oslash;rn (6-12 &aring;r)</strong></td>\r\n			<td>&nbsp;0,3 mg</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>⊙&nbsp;B&oslash;rn (u/6 &aring;r)</strong></td>\r\n			<td>&nbsp;0,15 mg</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><em>&nbsp;<br />\r\n			Behandling m&aring; gentages efter 5 min. &eacute;n gang, s&aring;fremt der forsat er livstruende symptomer.</em></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>DOSIS - INH&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<small><span class=\"marker\">(PM + AN&AElig;.SPL)</span></small></strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>Voksen</strong><br />\r\n			<strong>⊙&nbsp;</strong>2 mg Adrenalin + 2 ml NaC</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>&nbsp;<br />\r\n			B&oslash;rn (over 1 &aring;r)</strong><br />\r\n			<strong>⊙&nbsp;</strong>1 mg Adrenalin + 2 ml NaCl</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>&nbsp;<br />\r\n			B&oslash;rn (under 1 &aring;r)</strong><br />\r\n			<strong>⊙&nbsp;</strong>0,5 mg Adrenalin + 2,5 ml NaCl</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSM&Aring;DE</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Intramuskul&aelig;rt (IM)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Inhalation (INH)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSFORM</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Ampul &aacute; 1 mg/ml</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#d5eddd; border:1px solid #cddbce; padding:5px 10px\">\r\n<h3>Anvendelse&nbsp;<small>(Pseudocroup)</small></h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><big><strong>INDIKATION</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">Sv&aelig;re tilf&aelig;lde af pseudocroup (falsk strubehoste, laryngitis acuta) &oslash;vre luftvejsinfektion hos b&oslash;rn.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>DOSIS - INH&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<small><span class=\"marker\">(PM + AN&AElig;.SPL)</span></small></strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>B&oslash;rn (over 1 &aring;r)</strong><br />\r\n			<strong>⊙&nbsp;</strong>1 mg Adrenalin + 2 ml NaCl</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>&nbsp;<br />\r\n			B&oslash;rn (under 1 &aring;r)</strong><br />\r\n			<strong>⊙&nbsp;</strong>0,5 mg Adrenalin + 2,5 ml NaCl</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><em>&nbsp;<br />\r\n			Behandling m&aring; gentages &eacute;n gang.</em></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSM&Aring;DE</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Inhalation (INH)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSFORM</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Ampul &aacute; 1 mg/ml</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#d5eddd; border:1px solid #cddbce; padding:5px 10px\">\r\n<h3>Anvendelse&nbsp;<small>(&Oslash;dem i hals)</small></h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><big><strong>INDIKATION</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">&Oslash;dem i halsen, hvor luftvejen er truet.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>DOSIS - INH&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<small><span class=\"marker\">(PM + AN&AElig;.SPL)</span></small></strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>Voksen</strong><br />\r\n			<strong>⊙&nbsp;</strong>2 mg Adrenalin + 2 ml NaC</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>&nbsp;<br />\r\n			B&oslash;rn (over 1 &aring;r)</strong><br />\r\n			<strong>⊙&nbsp;</strong>1 mg Adrenalin + 2 ml NaCl</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>&nbsp;<br />\r\n			B&oslash;rn (under 1 &aring;r)</strong><br />\r\n			<strong>⊙&nbsp;</strong>0,5 mg Adrenalin + 2,5 ml NaCl</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSM&Aring;DE</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Intramuskul&aelig;rt (IM)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Inhalation (INH)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSFORM</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Ampul &aacute; 1 mg/ml</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#d5eddd; border:1px solid #cddbce; padding:5px 10px\">\r\n<h3>Anvendelse&nbsp;<small>(Hjertestop)</small></h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><big><strong>INDIKATION</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">VF, Pulsl&oslash;s VT, PEA, Asystoli.<br />\r\n			Efter ALS-guidelines fra DRG/ERC.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>DOSIS&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<small><span class=\"marker\">(PM + AN&AElig;.SPL)</span></small></strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>Voksen</strong><br />\r\n			<strong>⊙&nbsp;</strong>1 mg bolus&nbsp; &nbsp;(hvert 3.-5. min.)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>&nbsp;<br />\r\n			B&oslash;rn (0-18 &aring;r)</strong><br />\r\n			<strong>⊙&nbsp;</strong>0,01 mg/kg bolus&nbsp; &nbsp;(hvert 3.-5. min.)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSM&Aring;DE</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Intraven&oslash;st (IV)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Intraoss&oslash;s (IO)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSFORM</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Ampul &aacute; 1 mg/ml</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#f7d7da; border:1px solid #e9ccd1; padding:5px 10px\">\r\n<h3>Vigtigt</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><big><strong>KONTRAINDIKATION</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ingen ved korrekt indikation.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>BIVIRKNINGER</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Takyarytmier, mykardiel isk&aelig;mi, ventrikkelflimmer, blodtryksstigning, hovedpine, konfusion, kvalme, opkast, tremor, svimmelhed, nyresvigt, urinretention, hyperglyk&aelig;mi.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>INTERAKTIONER</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Beta-blokkere reducerer effekten af adrenalin.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#fff3cd; border:1px solid #f8e8c7; padding:5px 10px\">\r\n<h3>S&aelig;rligt</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><big><strong>S&AElig;RLIGE FORHOLD</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Anvendelse ved hjertestop f&oslash;lger DRG/ERC&#39;s genoplivningsanvisninger.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#d4ebf3; border:1px solid #c6e0e1; padding:5px 10px\">\r\n<h3>Medikament</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><big><strong>FARMAKOLOGI</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sympatomimetisk l&aelig;gemiddel med alfa- og beta-receptorstimulerende virkning (karkontraherende og hjertestimulerende effekt). &Oslash;ger hjertets frekvens, kontraktionskraft, elektriske overledningsevne, perifer vasokonstriktion, samt bronkiedilation.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>FARMAKOKINETIK</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Virker &oslash;jeblikkeligt, kort varighed (halveringstid: 2-3 minutter).</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>HOLDBARHED</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Se holdbarhedsdato p&aring; ampul</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', 'Hjertestop,Ventrikkelflimmer (VF),Ventrikulær takykardi (VT),Pulsløs elektrisk aktivitet (PEA),Epiglottitis,Pseudocroup,Anafylaksi,Allergiskreaktion,Bronkospasme', 'Enabled', '1-Y', 54, '2022-10-08 18:29:00', '2023-04-10 15:12:16'),
(31, '1,3,10,11,12,13,14', '33', 'file-text', 'Adrenalin Autoinjektor', 'DOKUMENT ID-NR.: PRI.03.02.006', 'E1P0FHYA-E45W-HSBE-NG4O-C8SM2T04OBFQ.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Anafylaksi,Allergisk reaktion,EpiPen,Jext', 'Enabled', '1-Y', 22, '2022-10-08 18:38:30', '2023-04-10 15:36:41'),
(32, '3,10,11,13', '33', 'file-text', 'Alminox', 'PRI.03.02.016', 'VOZ0JCIH-JXTM-LPJR-320V-JGZQOSRNML75.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Gastro-øsofageal reflukssygdom,Sure opstød', 'Disabled', '1-Y', 7, '2022-10-08 18:41:17', '2023-04-10 12:23:23'),
(33, '10,13,14', '33', 'file-text', 'Amiodaron', 'DOKUMENT ID-NR.: PRI.03.02.003', '16JP0F3O-CS3P-CMDA-5RF0-CXA4I36759HS.pdf', '<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\">\r\n<h3>G&aelig;ldende for</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><big><strong>KOMPETENCENIVEAU</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>Paramediciner</td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>An&aelig;stesisygeplejerske</td>\r\n		</tr>\r\n		<tr>\r\n			<td>⊙</td>\r\n			<td>L&aelig;ge</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#d5eddd; border:1px solid #cddbce; padding:5px 10px\">\r\n<h3>Anvendelse&nbsp;<small>(Hjertestop)</small></h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><big><strong>INDIKATION</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">Hjertestop med ventrikul&aelig;re arytmier:<br />\r\n			⊙ Ventrikkel-flimmer (VF)<br />\r\n			⊙ Ventrikkel-takykardi (VT)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>DOSIS</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>Voksen og unge (fra pubertet)</strong><br />\r\n			<strong>⊙&nbsp;</strong>300 mg &nbsp; &nbsp;(i 3. cyklus / efter 3. st&oslash;d)<br />\r\n			<strong>⊙&nbsp;</strong>150 mg&nbsp; &nbsp; &nbsp;(i 5. cyklus / efter 5. st&oslash;d)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>&nbsp;<br />\r\n			B&oslash;rn (ind til pubertet)</strong><br />\r\n			<strong>⊙&nbsp;</strong>5 mg/kg&nbsp; &nbsp;(i 3. cyklus / efter 3. st&oslash;d)<br />\r\n			<strong>⊙&nbsp;</strong>5 mg/kg&nbsp; &nbsp;(i 5. cyklus / efter 5. st&oslash;d)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSM&Aring;DE</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Intraven&oslash;st (IV)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Intraoss&oslash;s (IO)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSFORM</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Ampul &aacute; 50 mg/ml amiodaron.<br />\r\n			⊙ Ampulst&oslash;rrelse: 3 ml = 150 mg.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#d5eddd; border:1px solid #cddbce; padding:5px 10px\">\r\n<h3>Anvendelse&nbsp;<small>(VT &amp; SVT)</small></h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\"><big><strong>INDIKATION</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">H&aelig;modynamisk p&aring;virkede ventrikul&aelig;re arytmier, ej hjertestop:<br />\r\n			⊙ Ventrikkel-takykardi (VT)<br />\r\n			⊙ Supraventrikkel-takykardi (SVT)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>DOSIS</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<p><strong>Voksne</strong><br />\r\n			<strong>⊙&nbsp;</strong>maks. 150 mg langsomt over 10 min.<br />\r\n			<strong>⊙&nbsp;</strong>maks. 50 mg ad gangen som bolus.</p>\r\n\r\n			<p>Indgiften stopper hvis rytmen konverteres eller ved klinisk bedring.</p>\r\n\r\n			<p>Indgift sker under overv&aring;gning med st&oslash;dpads og hyppige BT-m&aring;linger.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSM&Aring;DE</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Intraven&oslash;st (IV)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<hr /><big><strong>INDGIFTSFORM</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">⊙ Ampul &aacute; 50 mg/ml amiodaron.<br />\r\n			⊙ Ampulst&oslash;rrelse: 3 ml = 150 mg.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#f7d7da; border:1px solid #e9ccd1; padding:5px 10px\">\r\n<h3>Vigtigt</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><big><strong>KONTRAINDIKATION</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Hjertestop:</strong> Ingen ved genoplivning.</p>\r\n\r\n			<p><strong>Takyarytmier:</strong> Puls under &lt;120</p>\r\n\r\n			<p>Sinusbradykardi, sinoatrialt blok (SA-blok), kendt syg sinus syndrom, 2. grads eller 3. grads AV-blok med mindre patienten har pacemaker (risiko for sinusarrest).&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>BIVIRKNINGER</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Interaktion p&aring; indgivelsesstedet, blodtryksfald og moderat bradykardi.&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>INTERAKTIONER</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ingen v&aelig;sentlige interaktioner ved korrekt indikation.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#fff3cd; border:1px solid #f8e8c7; padding:5px 10px\">\r\n<h3>S&aelig;rligt</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><big><strong>S&AElig;RLIGE FORHOLD</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Anvendelse ved hjertestop og takykardi f&oslash;lger DRG&#39;s genoplivningsanvisninger.</p>\r\n\r\n			<p>M&aring; <strong>IKKE</strong> fortyndes med isotonisk NaCl !</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#d4ebf3; border:1px solid #c6e0e1; padding:5px 10px\">\r\n<h3>Medikament</h3>\r\n\r\n<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><big><strong>FARMAKOLOGI</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Antiarytmikum klasse III</p>\r\n\r\n			<p>Amiodaron har antiarytmisk effekt overfor b&aring;de supraventrikul&aelig;re og ventrikul&aelig;re arytmier.<br />\r\n			Aktionspotentialet og refrakt&aelig;rtiden for s&aring;vel atrier som ventrikler (QT) forl&aelig;nges.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>FARMAKOKINETIK</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Nedbrydes i leveren og udskilles genem galde. Virker efter 1-2 minutter. Varighed er ukendt (halveringstid: 3-80 timer).</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<hr /><big><strong>HOLDBARHED</strong></big></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Se holdbarhedsdato p&aring; ampul</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', 'Hjertestop,Ventrikelflimmer (VF),Ventrikulær takykardi (VT),Supraventrikulær takykardi (SVT),Cordarone,Amiodaronhydrochlorid,Cordan', 'Enabled', '1-Y', 23, '2022-10-08 18:48:01', '2023-04-10 15:11:16'),
(34, '10,13', '33', 'file-text', 'Atropin', 'DOKUMENT ID-NR.: PRI.03.02.004', 'K2W6EIV0-1R2J-NJLR-8TNF-MX59B8LVK0TE.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Bradykardi,Kardiogent shock,Synkope, Myokardieiskæmi,Hjertesvigt', 'Enabled', '1-Y', 13, '2022-10-08 18:51:18', '2023-04-10 10:48:09');
INSERT INTO `documents` (`id`, `group_id`, `category`, `icon`, `title`, `subtitle`, `pdf`, `editor`, `keyword`, `must_read`, `period`, `counts`, `created_at`, `updated_at`) VALUES
(35, '3,10,11,13,14', '33', 'file-text', 'Cetrizin', 'PRI.03.02.014', '56KEVJ1O-1A7O-6SY8-LKEC-QNCM7LW3BS25.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Alnok, Vialerg,Benaday,Cetimax,Allergi,Allergiskreaktion', 'Disabled', '1-Y', 8, '2022-10-08 18:54:33', '2022-10-28 18:52:16'),
(36, '10,13,14', '33', 'file-text', 'Clemastin', 'PRI.03.02.017', '0SIC4T7V-9RMF-ROPN-6J97-J7BGTYR0QD5X.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Allergisk reaktion,Urticaria,Angioødemer,Anafylaksi,Tavegil,Tavegyl', 'Enabled', '1-Y', 5, '2022-10-08 18:57:22', '2023-04-09 11:13:26'),
(37, '3,10,11,13,14', '33', 'file-text', 'Combivent', 'PRI.03.02.007', 'QZKR02MC-MV8J-B5EK-K3AE-PTF9Y6Q2JN1V.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Astma,KOL,Bronkospasme,Ronchi,Ipratropiumbromid,Salbutamol,Ventoline', 'Enabled', '1-Y', 6, '2022-10-08 19:00:40', '2023-04-10 15:38:10'),
(38, '3,10,11,13,14', '33', 'file-text', 'Fentanyl', 'PRI.03.02.005', '9YH5IROV-2MV9-FPGZ-GB2D-PN7ADVWE5IOR.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Analgetika,Haldid,Smertedækning,Morfin,Opioid', 'Enabled', '1-Y', 18, '2022-10-08 19:09:30', '2023-04-10 15:38:25'),
(39, '10,13,14', '33', 'file-text', 'Furosemid', 'PRI.03.02.020', '0FBTPGLX-WGXI-WZAX-0F6M-TZHJLKYSNB5G.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Lungeødem,Lungestase,Furix', 'Enabled', '1-Y', 4, '2022-10-08 19:13:25', '2023-04-10 15:38:34'),
(40, '10,13,14', '33', 'file-text', 'Flumazenil', 'PRI.03.02.019', 'NDQL4S5P-3A6N-AKZB-4CZE-EHZNAVPCDS2F.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Forgiftning,Overdosering,Antidote,Benzodiazepin', 'Enabled', '1-Y', 5, '2022-10-09 06:41:52', '2023-04-10 15:38:41'),
(41, '1,3,10,11,13,14', '33', 'file-text', 'Glukagon', 'PRI.03.02.009', 'B71K6X3S-M6H5-N5JZ-OHA4-6QGYX10C38DP.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Glucagon,GlucaGen,Hypokit,Hypoglykæmi,Blodsukker (BS)', 'Enabled', '1-Y', 6, '2022-10-09 06:45:13', '2023-04-10 15:38:51'),
(42, '3,10,11,13,14', '33', 'file-text', 'Glukose', 'PRI.03.02.021', 'FI60GZE3-BWAH-9IJB-639C-B360CJ48V2Y9.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Glucos,Hypoglykæmi,Blodsukker (BS)', 'Enabled', '1-Y', 5, '2022-10-09 06:48:41', '2023-04-10 15:39:13'),
(43, '1,3,10,11,13,14', '33', 'file-text', 'Glycerylnitrat', 'PRI.03.02.008', 'ZNMDYAF2-D71M-8V41-QA35-1TQHSDGOIC32.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Nitro-spray,Nitrolingual,Akut koronart syndrom (AKS),Ustabil angina pectoris (UAP),STEMI,Non-Stemi', 'Enabled', '2-Y', 7, '2022-10-09 06:54:39', '2023-04-10 15:37:36'),
(44, '1,3,10,11,12,13,14,15', '33', 'file-text', 'HypoFit', 'PRI.03.02.022', 'LS5THZ06-J96W-Z48H-JFPA-IZ0F6MPSB4AN.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Hypoglykæmi,Glukose,Glucose,Blodsukker (BS)', 'Disabled', '3-Y', 3, '2022-10-09 06:59:40', '2022-10-28 18:48:41'),
(45, '3,10,11,13,14', '33', 'file-text', 'Ibuprofen', 'PRI.03.02.014', 'RK7A9MJ8-N5J7-93CH-EP32-19QSGPJYDX50.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Ibumax,Ipren,Ibumetin,Smerte,Analgetika', 'Enabled', '3-Y', 3, '2022-10-09 07:09:56', '2022-12-27 11:17:18'),
(46, '1,3,10,11,12,13,14,15', '33', 'file-text', 'Oxygen', 'PRI.03.02.010', 'WZQSFECG-0TGF-A72K-8XIQ-H5D17F6EM9B2.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Medicinsk ilt,Conoxia,Gas,Hypoxi,KOL', 'Enabled', '3-Y', 6, '2022-10-09 07:13:56', '2023-04-10 10:48:28'),
(48, '10,13,14', '33', 'file-text', 'Methylprednisolon', 'PRI.03.02.01', '5X0Y79EG-85RM-4D81-VL0J-QOL2G48XMHIK.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Solu-Medrol,Allergisk reaktion,Anafylaksi,Urticaria,Angioødemer', 'Enabled', '1-Y', 7, '2022-10-09 07:18:02', '2023-04-10 15:37:49'),
(49, '3,10,11,13,14', '33', 'file-text', 'Midazolam', 'PRI.03.02.013', '0VFTWNCJ-HBQI-0JN2-ODY1-VMPJYRCOB3L6.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Krampe,Generaliseret tonisk-klonisk anfald (GTK),Epilipsi,Stesolid,Diazepam', 'Enabled', '1-Y', 7, '2022-10-09 07:22:21', '2023-04-11 05:41:04'),
(52, '1,3,10,11,12,13,14', '34', 'file-text', 'Patientinformation - Forstuvet ankel', '.', 'CBG5XMJD-ZA79-TZH0-BYD2-GVPSH3M1CX2A.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Vrikket om,Vejledning', 'Disabled', '1-Y', 2, '2022-10-18 16:44:19', '2023-04-09 11:11:18'),
(53, '1,3,10,11,12,13,14,15', '34', 'file-text', 'Patientinformation - Når du har slået hovedet', '.', '91RYOMEZ-N5QR-65LT-P7I5-M74QNF9HGYCZ.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Hjernerystelse,Commotio cerebri,Vejledning', 'Disabled', '1-Y', 2, '2022-10-18 16:47:12', '2023-04-09 11:11:27'),
(54, '1,3,10,11,12,13,14,15', '34', 'file-text', 'Patientinformation - Når et sår er blevet behandlet', '.', 'KE9PGZ1N-GSR0-TG87-9RFL-SH83IKAY64LN.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Sårpleje,Stivkrampe,Tetanus', 'Disabled', '1-Y', 2, '2022-10-18 16:49:14', '2023-04-09 11:11:33'),
(55, '1,3,10,11,12,13,14,15', '34', 'file-text', 'Patientinformation - Smerte og behandling', '.', '872L6HR0-8Z0V-FSHJ-RVJP-46KB3VPLTY9M.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Vejledning', 'Disabled', '1-Y', 2, '2022-10-18 16:51:10', '2023-04-09 11:11:39'),
(56, '3,10,11,13,14', '36', 'file-text', 'Region Midt, akut-postkort, tysk', '.', '8C4FWE2I-8VLP-Q785-BLMS-OD108QZYLE94.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Visitation', 'Disabled', '1-Y', 1, '2022-10-18 18:45:16', '2022-12-27 11:17:30');
INSERT INTO `documents` (`id`, `group_id`, `category`, `icon`, `title`, `subtitle`, `pdf`, `editor`, `keyword`, `must_read`, `period`, `counts`, `created_at`, `updated_at`) VALUES
(57, '3,10,11,13,14', '36', 'file-text', 'Region Midt, akut-postkort, Engelsk', '.', 'K47BX1AG-IFHS-4G26-SA10-CN6T0EI5927Z.pdf', '<h1>PWA Ready</h1>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<blockquote>\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n</blockquote>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</div>', 'Visitation, DS', 'Disabled', '1-Y', 1, '2022-10-18 18:46:12', '2022-12-27 11:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `document_status`
--

CREATE TABLE `document_status` (
  `id` bigint UNSIGNED NOT NULL,
  `document_id` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_status`
--

INSERT INTO `document_status` (`id`, `document_id`, `user_id`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(12, 37, 12, NULL, 'Read', '2022-10-08 19:02:43', '2022-10-08 19:02:43'),
(13, 30, 12, NULL, 'Read Understood', '2022-10-08 19:18:15', '2022-10-28 18:43:52'),
(14, 42, 12, NULL, 'Read', '2022-10-09 06:49:00', '2022-10-09 06:49:00'),
(16, 22, 12, NULL, 'Read', '2022-10-09 07:27:42', '2022-10-09 07:27:42'),
(17, 22, 1, NULL, 'Read', '2022-10-09 07:31:23', '2022-10-09 07:31:23'),
(19, 23, 12, NULL, 'Read', '2022-10-09 07:46:45', '2022-10-09 07:46:45'),
(20, 23, 1, NULL, 'Read', '2022-10-09 07:50:06', '2022-10-09 07:50:06'),
(21, 21, 12, NULL, 'Read', '2022-10-09 08:08:13', '2022-10-09 08:08:13'),
(22, 24, 1, NULL, 'Read', '2022-10-11 16:00:51', '2022-10-11 16:00:51'),
(23, 25, 1, NULL, 'Read', '2022-10-11 16:00:57', '2022-10-11 16:00:57'),
(24, 32, 1, NULL, 'Read', '2022-10-11 16:01:01', '2022-10-11 16:01:01'),
(26, 27, 16, NULL, 'Read', '2022-10-16 18:46:23', '2022-10-16 18:46:23'),
(30, 33, 1, NULL, 'Read Not Understood', '2022-10-17 18:26:05', '2022-10-17 18:26:05'),
(32, 40, 1, NULL, 'Read', '2022-10-18 11:11:38', '2022-10-18 11:11:38'),
(33, 34, 1, NULL, 'Read Understood', '2022-10-18 11:16:14', '2022-10-21 18:24:15'),
(35, 28, 1, NULL, 'Read Not Understood', '2022-10-18 11:21:06', '2022-10-18 11:21:06'),
(36, 36, 1, NULL, 'Read', '2022-10-18 11:24:42', '2022-10-18 11:24:42'),
(37, 39, 1, NULL, 'Read', '2022-10-18 11:30:11', '2022-10-18 11:30:11'),
(38, 49, 1, NULL, 'Read', '2022-10-18 16:11:55', '2022-10-18 16:11:55'),
(49, 30, 1, NULL, 'Read', '2022-10-25 11:18:27', '2022-10-25 11:18:27'),
(50, 38, 1, NULL, 'Read Understood', '2022-10-25 11:19:42', '2022-10-25 11:19:45'),
(51, 42, 1, NULL, 'Read Understood', '2022-10-25 11:19:52', '2022-10-25 11:19:54'),
(52, 48, 1, NULL, 'Read Understood', '2022-10-25 11:20:06', '2022-10-25 11:20:32'),
(53, 52, 1, NULL, 'Read', '2022-10-26 23:14:46', '2022-10-26 23:14:46'),
(54, 54, 1, NULL, 'Read', '2022-10-26 23:14:53', '2022-10-26 23:14:53'),
(55, 53, 1, NULL, 'Read', '2022-10-26 23:17:03', '2022-10-26 23:17:03'),
(56, 37, 1, NULL, 'Read Understood', '2022-10-27 09:07:18', '2022-10-27 09:07:26'),
(57, 31, 1, NULL, 'Read', '2022-10-27 09:08:09', '2022-10-27 09:08:09'),
(58, 29, 1, NULL, 'Read Not Understood', '2022-10-27 10:04:51', '2022-10-28 00:02:56'),
(59, 21, 1, NULL, 'Read', '2022-10-27 19:50:54', '2022-10-27 19:50:54'),
(61, 46, 1, NULL, 'Read', '2022-10-28 00:25:55', '2022-10-28 00:25:55'),
(62, 29, 12, NULL, 'Read Understood', '2022-10-28 18:43:13', '2022-10-28 18:43:21'),
(63, 32, 12, NULL, 'Read', '2022-10-28 18:44:06', '2022-10-28 18:44:06'),
(65, 44, 12, NULL, 'Read', '2022-10-28 18:48:41', '2022-10-28 18:48:41'),
(66, 35, 12, NULL, 'Read', '2022-10-28 18:52:16', '2022-10-28 18:52:16'),
(69, 31, 12, NULL, 'Read', '2022-11-27 16:50:40', '2022-11-27 16:50:40'),
(70, 49, 12, NULL, 'Read Understood', '2022-11-30 16:08:27', '2022-11-30 16:09:43'),
(71, 33, 12, NULL, 'Read Understood', '2022-12-09 06:38:01', '2023-04-09 11:13:40'),
(72, 29, 19, NULL, 'Read Understood', '2022-12-14 11:06:19', '2022-12-14 11:06:40'),
(73, 38, 19, NULL, 'Read', '2022-12-14 11:07:36', '2022-12-14 11:07:36'),
(74, 34, 19, NULL, 'Read', '2022-12-14 11:07:49', '2022-12-14 11:07:49'),
(75, 34, 12, NULL, 'Read Understood', '2022-12-14 20:48:25', '2022-12-14 20:48:46'),
(76, 41, 12, NULL, 'Read Understood', '2022-12-14 20:48:58', '2022-12-14 20:49:43'),
(77, 46, 12, NULL, 'Read Understood', '2022-12-14 20:50:06', '2022-12-14 20:50:43'),
(79, 30, 20, NULL, 'Read Understood', '2022-12-16 11:27:37', '2022-12-16 11:27:47'),
(80, 38, 20, 'test', 'Read Not Understood', '2022-12-16 11:32:07', '2022-12-16 11:32:19'),
(81, 48, 12, NULL, 'Read Understood', '2022-12-22 17:27:08', '2023-01-07 07:30:25'),
(82, 26, 20, NULL, 'Read', '2022-12-27 11:17:09', '2022-12-27 11:17:09'),
(83, 43, 20, NULL, 'Read', '2022-12-27 11:17:15', '2022-12-27 11:17:15'),
(84, 45, 20, NULL, 'Read', '2022-12-27 11:17:18', '2022-12-27 11:17:18'),
(85, 55, 20, NULL, 'Read', '2022-12-27 11:17:22', '2022-12-27 11:17:22'),
(86, 56, 20, NULL, 'Read', '2022-12-27 11:17:30', '2022-12-27 11:17:30'),
(87, 57, 20, NULL, 'Read', '2022-12-27 11:18:02', '2022-12-27 11:18:02'),
(88, 36, 12, NULL, 'Read Understood', '2023-01-07 08:16:50', '2023-01-07 08:17:27'),
(89, 43, 12, NULL, 'Read Understood', '2023-02-17 15:50:49', '2023-02-17 15:50:55'),
(90, 38, 12, 'Jeg kan ikke læse....', 'Read Not Understood', '2023-02-28 13:08:02', '2023-02-28 13:08:38'),
(91, 29, 20, NULL, 'Read Understood', '2023-02-28 20:09:56', '2023-02-28 20:10:27'),
(92, 23, 20, NULL, 'Read', '2023-02-28 20:11:02', '2023-02-28 20:11:02'),
(93, 40, 12, NULL, 'Read', '2023-04-06 10:13:28', '2023-04-06 10:13:28'),
(94, 52, 12, NULL, 'Read', '2023-04-09 11:11:18', '2023-04-09 11:11:18'),
(95, 53, 12, NULL, 'Read', '2023-04-09 11:11:27', '2023-04-09 11:11:27'),
(96, 54, 12, NULL, 'Read', '2023-04-09 11:11:33', '2023-04-09 11:11:33'),
(97, 55, 12, NULL, 'Read', '2023-04-09 11:11:39', '2023-04-09 11:11:39'),
(98, 29, 16, NULL, 'Read', '2023-04-10 08:44:34', '2023-04-10 08:44:34'),
(99, 29, 71, NULL, 'Read Understood', '2023-04-10 08:50:12', '2023-04-10 09:19:48'),
(100, 29, 63, NULL, 'Read Understood', '2023-04-10 10:41:36', '2023-04-10 10:42:42'),
(101, 30, 63, NULL, 'Read Understood', '2023-04-10 10:44:22', '2023-04-10 10:44:29'),
(102, 31, 63, NULL, 'Read', '2023-04-10 10:47:42', '2023-04-10 10:47:42'),
(103, 32, 63, NULL, 'Read', '2023-04-10 10:47:58', '2023-04-10 10:47:58'),
(104, 34, 63, NULL, 'Read', '2023-04-10 10:48:09', '2023-04-10 10:48:09'),
(105, 46, 63, NULL, 'Read', '2023-04-10 10:48:28', '2023-04-10 10:48:28'),
(106, 38, 63, NULL, 'Read Understood', '2023-04-10 10:48:44', '2023-04-10 10:49:01'),
(107, 21, 63, NULL, 'Read', '2023-04-10 10:52:02', '2023-04-10 10:52:02'),
(108, 22, 63, NULL, 'Read', '2023-04-10 10:52:50', '2023-04-10 10:52:50'),
(109, 23, 63, NULL, 'Read', '2023-04-10 10:53:19', '2023-04-10 10:53:19'),
(110, 49, 19, NULL, 'Read', '2023-04-10 12:22:13', '2023-04-10 12:22:13'),
(111, 43, 19, NULL, 'Read', '2023-04-10 12:22:17', '2023-04-10 12:22:17'),
(112, 30, 19, NULL, 'Read', '2023-04-10 12:22:23', '2023-04-10 12:22:23'),
(113, 31, 19, NULL, 'Read', '2023-04-10 12:23:18', '2023-04-10 12:23:18'),
(114, 32, 19, NULL, 'Read', '2023-04-10 12:23:23', '2023-04-10 12:23:23'),
(115, 39, 12, NULL, 'Read', '2023-04-10 15:38:30', '2023-04-10 15:38:30'),
(116, 49, 71, NULL, 'Read', '2023-04-11 05:41:04', '2023-04-11 05:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorite_documents`
--

CREATE TABLE `favorite_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `document_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorite_documents`
--

INSERT INTO `favorite_documents` (`id`, `user_id`, `document_id`, `created_at`, `updated_at`) VALUES
(3, 1, 7, '2023-04-09 03:03:27', '2023-04-09 03:03:27'),
(4, 12, 29, '2023-04-09 06:51:36', '2023-04-09 06:51:36'),
(5, 12, 30, '2023-04-09 06:52:17', '2023-04-09 06:52:17'),
(6, 12, 33, '2023-04-09 11:09:38', '2023-04-09 11:09:38'),
(7, 12, 36, '2023-04-09 11:13:25', '2023-04-09 11:13:25'),
(8, 20, 29, '2023-04-10 08:31:47', '2023-04-10 08:31:47'),
(9, 16, 29, '2023-04-10 08:44:38', '2023-04-10 08:44:38'),
(10, 71, 29, '2023-04-10 09:20:48', '2023-04-10 09:20:48'),
(11, 63, 29, '2023-04-10 10:43:01', '2023-04-10 10:43:01'),
(12, 63, 30, '2023-04-10 10:44:38', '2023-04-10 10:44:38'),
(13, 19, 29, '2023-04-10 11:16:12', '2023-04-10 11:16:12'),
(14, 12, 43, '2023-04-10 15:37:35', '2023-04-10 15:37:35'),
(15, 12, 48, '2023-04-10 15:37:49', '2023-04-10 15:37:49'),
(16, 12, 37, '2023-04-10 15:38:10', '2023-04-10 15:38:10'),
(17, 12, 38, '2023-04-10 15:38:24', '2023-04-10 15:38:24'),
(18, 12, 39, '2023-04-10 15:38:34', '2023-04-10 15:38:34'),
(19, 12, 40, '2023-04-10 15:38:41', '2023-04-10 15:38:41'),
(20, 12, 41, '2023-04-10 15:38:50', '2023-04-10 15:38:50'),
(21, 12, 42, '2023-04-10 15:39:13', '2023-04-10 15:39:13'),
(22, 12, 49, '2023-04-10 15:41:21', '2023-04-10 15:41:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2022_09_28_155312_create_categories_table', 2),
(10, '2022_09_28_163935_create_documents_table', 4),
(11, '2022_09_29_131635_create_settings_table', 5),
(12, '2022_09_29_134651_create_groups_table', 6),
(27, '2022_10_01_094045_create_document_statuses_table', 7),
(29, '2022_10_03_180321_create_user_notes_table', 7),
(30, '2022_09_28_162606_create_equipment_table', 8),
(31, '2022_10_03_113754_create_user_documents_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `minisites`
--

CREATE TABLE `minisites` (
  `id` bigint UNSIGNED NOT NULL,
  `location_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `minisites`
--

INSERT INTO `minisites` (`id`, `location_id`, `name`, `description`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(2, '6', 'Arham khan', 'This is an demo description of Arham Khans personal minisite. We hope you like it, please let us know if anything is not working as you expected.', 'logo-1672945454.jpg', 'Active', '2023-01-05 15:30:31', '2023-01-09 17:52:14'),
(3, '11', 'Nord-Als Svømmeklub', '.', 'logo-1672947937.png', 'Active', '2023-01-05 19:45:37', '2023-01-05 19:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `send_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groups` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `views` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `author`, `title`, `date`, `content`, `document`, `status`, `send_email`, `groups`, `views`, `created_at`, `updated_at`) VALUES
(16, 'Mark J. Zweidorff', 'Nyhedsbrev #1', '2022-12-01', '<h2>Tak for i &aring;r</h2>\r\n\r\n<p>Vi n&aelig;rmer os udgangen af 2022 og hold da fast &eacute;t sp&aelig;ndende &aring;r! Vi har udvidet vores lille virksomhed med tre ambulancer og en helt masse materiel. Vi kommer ikke uden om, at vores voksev&aelig;rk kun sker fordi at I alle sammen har gjort et fantastisk profesionelt stykke arbejde, s&aring; et stort tak fra Mikkel og jeg!</p>\r\n\r\n<hr />\r\n<h2>&nbsp;</h2>\r\n\r\n<h2>Nyhedsbrev</h2>\r\n\r\n<p>En af de tilbagemeldinger vi har fået fra jer, er &oslash;nsket om at blive opdateret omkring hvad der r&oslash;r sig hos Event Medical Services.</p>\r\n\r\n<p>Vi har selvf&oslash;lgelig lyttet og hermed kommer det f&oslash;rste af mange nyhedsbreve. Det er vores måls&aelig;tning at der som minimum udkommer ét pr. kvartal. Ved opdateringer af instrukser for medicin, samt behandling, nye kompetencer eller udstyr, vil vi udsende ekstra nyhedsbreve.</p>\r\n\r\n<p>Går du med et godt emne eller har du generel feedback så kontakt mig endelig.</p>\r\n\r\n<hr />\r\n<p>&nbsp;</p>\r\n\r\n<h2>Nye opgaver</h2>\r\n\r\n<p>Vi er sindssygt stolte over at kunne offentligg&oslash;re, at Event Medical Services i en periode på tre år, er blevet valgt som leverand&oslash;r af det pr&aelig;hospitale beredskab på hhv. NorthSide og TinderBox festival. Dette er sket på baggrund af den fantastiske indsats der blev leveret til tre sk&oslash;nne koncerter med Lukas Graham. Arrang&oslash;rerne bag festivalerne har valgt at droppe frivillige samaritter/foreninger og går som en af de f&oslash;rste med et 100% l&oslash;nnet sundhedsfagligt beredskab. Der skal lyde et STORT skulderklap til alle som hjalp til!</p>\r\n\r\n<p>I samarbejde er beredskabet dimensioneret til 20 personaler hvor hovedparten m&oslash;der omkring middag og &rdquo;resten&rdquo; kl. 18. Timel&oslash;nnen er 250,- + feriepenge.<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>London ambulance service modellen</strong></p>\r\n\r\n<p>Mobilitet og fleksibilitet er utroligt vigtigt og derfor har vi set på hvordan man l&oslash;ser opgaverne i udlandet. Vi har valgt at gå med cykel-responder, da man hurtigt kan komme frem med alt relevant udstyr frem for at skulle sl&aelig;be rundt på en k&aelig;mpe taske til fods.</p>\r\n\r\n<p>For uden vores cykelenheder vil vi have en golfbil ala den vi har i Djurs Sommerland, samt én alm. ambulance til intern transport/fremskudt behandling.</p>\r\n\r\n<p>Selve behandlingsteltet vil blive bemandet af fem sygeplejersker og den koordinerende vil v&aelig;re Casper Okkels (an&aelig;stesi-spl. og svensk ambu.spl.) vil sammen med Mikkel og jeg, v&aelig;re at finde på begge festivaler.</p>\r\n\r\n<hr />\r\n<p>&nbsp;</p>\r\n\r\n<h2>Djurs Sommerland</h2>\r\n\r\n<p>Vores anden s&aelig;son i den Jyske forlystelsespark Djurs Sommerland, er nu vel overstået oven på en travl og velbes&oslash;gt Halloween.<br />\r\nFor os har det v&aelig;ret en fantastisk s&aelig;son, hvor vi i samarbejde med jer, har implementeret en ny skadestue og taget imod en masse gode forslag, hvor af rigtigt mange blev implementeret</p>\r\n\r\n<p>Tilbagemeldingerne fra både Michael og Henrik er rigtigt gode og begge ser frem til endnu nogle mange gode s&aelig;soner fremover. Hos EMS arbejder vi på at udvide kompetenceniveauet og der er kommet en masse god og relevant feedback fra personalet.</p>\r\n\r\n<hr />\r\n<p>&nbsp;</p>\r\n\r\n<h2>Intranet</h2>\r\n\r\n<p>Vi er godt på vej med vores nye intranet system. Systemet kommer til at rumme HR- informationer, samt styring af instrukser for medicin, behandling og materiel. Det vil som i ligne systemer, v&aelig;re muligt, at kunne markere hver instruks som &quot;l&aelig;st og forstået&quot; eller &quot;l&aelig;st, ej forstået&quot;.</p>\r\n\r\n<hr />\r\n<p>&nbsp;</p>\r\n\r\n<h2>PPJ</h2>\r\n\r\n<p>Vi er pt. i gang med at teste et Tysk PPJ-system og har sidel&oslash;bende dialog med Amphi PPJ, som mange af jer kender fra ambulancerne. Samtidig har vi en f&oslash;ler ude hos et par nordiske leverand&oslash;rer, så hvilken retning vi går i må tiden vise.</p>\r\n\r\n<hr />\r\n<p>&nbsp;</p>\r\n\r\n<h2>Medicinske kompetencer</h2>\r\n\r\n<p>Sammen med vores korpsl&aelig;ge Thomas Knudsen arbejder vi på implementering af bl.a. TXA, S- ketamin og hudlim.</p>\r\n\r\n<p>Pt. er vi ved at gennemgå instukser og erfaringer fra andre Regioner og vi forventer at v&aelig;re klar inden sommeren.</p>\r\n\r\n<hr />\r\n<h2 style=\"font-style:italic\">&nbsp;</h2>\r\n\r\n<h2 style=\"font-style:italic\">Stor tak for indsatsen i det forgangende &aring;r!</h2>\r\n\r\n<h2 style=\"font-style:italic\">De bedste hilsner Mark &amp; Mikkel</h2>', 'document-1681039563.pdf', 'Specific Groups', NULL, '3,10,11,12,13,14', '12,20,71,63,19,', '2023-04-09 11:26:03', '2023-04-10 11:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `not_working_schedules`
--

CREATE TABLE `not_working_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` int NOT NULL,
  `staff_id` int NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allDay` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `not_working_schedules`
--

INSERT INTO `not_working_schedules` (`id`, `customer_id`, `staff_id`, `date`, `start_time`, `end_time`, `allDay`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 22, '2023-02-13', '08:00', '17:00', 'Null', 'rgresgsfdgsdgsdgfsdgsdfg', 'Work', '2023-02-13 17:43:57', '2023-02-13 17:45:38'),
(2, 0, 22, '2023-03-02', '08:00', '17:00', 'Null', NULL, 'Work', '2023-02-28 13:12:37', '2023-02-28 13:12:37'),
(3, 0, 1, '2023-03-04', '08:00', '17:00', 'All Day', NULL, 'Vactions', '2023-03-02 19:20:43', '2023-03-02 19:20:43'),
(4, 0, 22, '2023-03-04', '08:00', '17:00', 'All Day', NULL, 'NotWork', '2023-03-02 19:21:02', '2023-03-02 19:21:02'),
(5, 0, 97, '2023-03-04', '08:00', '17:00', 'All Day', NULL, 'Work', '2023-03-02 19:21:21', '2023-03-02 19:21:21'),
(6, 0, 12, '2023-05-03', '08:00', '16:00', 'Null', 'Kursus Q-HLR', 'NotWork', '2023-03-22 22:11:37', '2023-04-01 14:05:34'),
(8, 0, 19, '2023-04-30', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:16:55', '2023-03-28 16:17:48'),
(9, 0, 68, '2023-04-30', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:17:30', '2023-03-28 16:17:30'),
(10, 0, 66, '2023-04-30', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:18:20', '2023-03-28 16:18:20'),
(11, 0, 56, '2023-04-29', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:18:55', '2023-03-28 16:18:55'),
(12, 0, 56, '2023-04-30', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:19:13', '2023-03-28 16:19:13'),
(13, 0, 71, '2023-04-30', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:19:35', '2023-03-28 16:19:35'),
(14, 0, 12, '2023-04-29', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:19:53', '2023-03-28 16:19:53'),
(15, 0, 19, '2023-05-13', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:21:06', '2023-03-28 16:21:06'),
(16, 0, 19, '2023-05-14', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:21:21', '2023-03-28 16:21:21'),
(17, 0, 19, '2023-05-20', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:21:44', '2023-03-28 16:21:44'),
(18, 0, 19, '2023-05-21', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:22:01', '2023-03-28 16:22:01'),
(19, 0, 63, '2023-05-20', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:22:59', '2023-03-28 16:22:59'),
(20, 0, 63, '2023-05-21', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:23:18', '2023-03-28 16:23:18'),
(21, 0, 66, '2023-05-13', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:24:16', '2023-03-28 16:24:16'),
(22, 0, 56, '2023-05-13', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:25:05', '2023-03-28 16:25:05'),
(23, 0, 56, '2023-05-14', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:25:25', '2023-03-28 16:25:25'),
(24, 0, 71, '2023-05-18', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:26:18', '2023-03-28 16:26:18'),
(25, 0, 71, '2023-05-19', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:26:36', '2023-03-28 16:26:36'),
(26, 0, 71, '2023-05-20', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:27:02', '2023-03-28 16:27:02'),
(27, 0, 71, '2023-05-27', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:27:32', '2023-03-28 16:27:32'),
(28, 0, 71, '2023-05-29', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:28:02', '2023-03-28 16:28:02'),
(29, 0, 61, '2023-06-03', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:29:21', '2023-03-28 16:29:21'),
(30, 0, 19, '2023-06-10', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:30:00', '2023-03-28 16:30:00'),
(31, 0, 19, '2023-06-11', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:30:24', '2023-03-28 16:30:24'),
(32, 0, 19, '2023-06-17', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:31:00', '2023-03-28 16:31:00'),
(33, 0, 19, '2023-06-18', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:31:23', '2023-03-28 16:31:23'),
(35, 0, 63, '2023-06-04', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:32:52', '2023-03-28 16:32:52'),
(36, 0, 63, '2023-06-18', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:33:27', '2023-03-28 16:33:27'),
(37, 0, 63, '2023-06-19', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:33:54', '2023-03-28 16:33:54'),
(39, 0, 68, '2023-06-20', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:35:00', '2023-03-28 16:35:00'),
(40, 0, 68, '2023-06-26', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:35:26', '2023-03-28 16:35:26'),
(41, 0, 68, '2023-06-18', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:35:50', '2023-03-28 16:35:50'),
(42, 0, 66, '2023-06-03', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:36:43', '2023-03-28 16:36:43'),
(43, 0, 66, '2023-06-04', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:37:16', '2023-03-28 16:37:16'),
(44, 0, 66, '2023-06-24', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:38:11', '2023-03-28 16:38:11'),
(45, 0, 66, '2023-06-25', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:38:32', '2023-03-28 16:38:32'),
(47, 0, 66, '2023-06-28', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:39:02', '2023-03-28 16:39:02'),
(48, 0, 66, '2023-06-29', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:39:30', '2023-03-28 16:39:30'),
(49, 0, 71, '2023-06-04', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:41:14', '2023-03-28 16:41:14'),
(50, 0, 71, '2023-06-10', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:42:15', '2023-03-28 16:42:15'),
(51, 0, 71, '2023-06-11', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:42:41', '2023-03-28 16:42:41'),
(52, 0, 71, '2023-06-17', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:43:09', '2023-03-28 16:43:18'),
(53, 0, 71, '2023-06-18', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:43:36', '2023-03-28 16:43:36'),
(54, 0, 71, '2023-06-19', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:44:05', '2023-03-28 16:44:05'),
(55, 0, 71, '2023-06-24', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:44:49', '2023-03-28 16:44:49'),
(56, 0, 71, '2023-06-26', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:45:42', '2023-03-28 16:45:42'),
(57, 0, 71, '2023-06-27', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:45:58', '2023-03-28 16:45:58'),
(58, 0, 71, '2023-06-28', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:46:21', '2023-03-28 16:46:21'),
(59, 0, 71, '2023-06-29', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 16:46:39', '2023-03-28 16:46:39'),
(60, 0, 19, '2023-07-01', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:03:42', '2023-03-28 20:03:42'),
(61, 0, 19, '2023-07-02', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:04:03', '2023-03-28 20:04:03'),
(62, 0, 19, '2023-07-03', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:04:28', '2023-03-28 20:04:28'),
(63, 0, 19, '2023-07-28', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:05:29', '2023-03-28 20:05:29'),
(64, 0, 19, '2023-07-29', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:05:33', '2023-03-28 20:05:46'),
(65, 0, 19, '2023-07-30', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:06:19', '2023-03-28 20:06:19'),
(66, 0, 19, '2023-07-31', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:07:22', '2023-03-28 20:07:22'),
(67, 0, 68, '2023-07-03', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:14:51', '2023-03-28 20:14:51'),
(68, 0, 68, '2023-07-04', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:15:40', '2023-03-28 20:15:40'),
(69, 0, 68, '2023-07-05', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:19:49', '2023-03-28 20:19:49'),
(70, 0, 68, '2023-07-11', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:24:54', '2023-03-28 20:24:54'),
(71, 0, 68, '2023-07-19', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:27:35', '2023-03-28 20:27:35'),
(72, 0, 66, '2023-07-03', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:29:49', '2023-03-28 20:29:49'),
(73, 0, 66, '2023-07-04', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:30:13', '2023-03-28 20:30:13'),
(74, 0, 66, '2023-07-22', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:31:07', '2023-03-28 20:31:07'),
(75, 0, 66, '2023-07-23', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:31:29', '2023-03-28 20:31:29'),
(76, 0, 71, '2023-07-05', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:34:24', '2023-03-28 20:34:24'),
(77, 0, 71, '2023-07-06', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:34:41', '2023-03-28 20:34:41'),
(78, 0, 71, '2023-07-07', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:35:05', '2023-03-28 20:35:05'),
(79, 0, 71, '2023-07-08', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:35:25', '2023-03-28 20:35:25'),
(80, 0, 71, '2023-07-09', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:35:42', '2023-03-28 20:35:42'),
(81, 0, 71, '2023-07-17', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:36:29', '2023-03-28 20:36:29'),
(82, 0, 71, '2023-07-22', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:36:59', '2023-03-28 20:36:59'),
(83, 0, 71, '2023-07-23', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:37:15', '2023-03-28 20:37:15'),
(84, 0, 71, '2023-07-28', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:37:54', '2023-03-28 20:37:54'),
(85, 0, 61, '2023-08-26', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:41:22', '2023-03-28 20:41:22'),
(86, 0, 63, '2023-08-27', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:42:35', '2023-03-28 20:44:13'),
(87, 0, 66, '2023-08-07', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:45:13', '2023-03-28 20:45:13'),
(88, 0, 66, '2023-08-08', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:45:34', '2023-03-28 20:45:34'),
(89, 0, 56, '2023-08-27', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:46:14', '2023-03-28 20:46:14'),
(90, 0, 71, '2023-08-04', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:47:23', '2023-03-28 20:47:23'),
(91, 0, 71, '2023-08-05', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:47:44', '2023-03-28 20:47:44'),
(92, 0, 71, '2023-08-06', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:48:00', '2023-03-28 20:48:00'),
(93, 0, 71, '2023-08-07', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:48:49', '2023-03-28 20:48:49'),
(94, 0, 71, '2023-08-08', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:49:08', '2023-03-28 20:49:08'),
(95, 0, 71, '2023-08-26', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:49:46', '2023-03-28 20:49:46'),
(96, 0, 71, '2023-08-27', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:50:06', '2023-03-28 20:50:06'),
(97, 0, 19, '2023-09-02', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:51:48', '2023-03-28 20:51:48'),
(98, 0, 71, '2023-09-03', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:52:11', '2023-03-28 20:52:11'),
(99, 0, 19, '2023-09-09', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:52:37', '2023-03-28 20:52:37'),
(100, 0, 19, '2023-09-10', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:53:13', '2023-03-28 21:00:11'),
(101, 0, 71, '2023-09-16', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:54:34', '2023-03-28 20:54:34'),
(102, 0, 68, '2023-09-17', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:55:03', '2023-03-28 20:55:03'),
(103, 0, 63, '2023-09-16', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:55:30', '2023-03-28 20:58:05'),
(104, 0, 56, '2023-09-24', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:56:36', '2023-03-28 20:56:36'),
(105, 0, 71, '2023-09-23', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:57:31', '2023-03-28 20:57:31'),
(106, 0, 66, '2023-09-16', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:58:36', '2023-03-28 20:58:36'),
(107, 0, 71, '2023-09-17', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 20:59:03', '2023-03-28 20:59:03'),
(108, 0, 71, '2023-09-02', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:01:53', '2023-03-28 21:01:53'),
(109, 0, 19, '2023-09-03', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:02:19', '2023-03-28 21:02:19'),
(110, 0, 61, '2023-10-21', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:06:52', '2023-03-28 21:06:52'),
(111, 0, 63, '2023-10-16', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:08:24', '2023-03-28 21:08:24'),
(113, 0, 68, '2023-10-16', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:09:09', '2023-03-28 21:09:09'),
(114, 0, 68, '2023-10-22', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:09:39', '2023-03-28 21:09:39'),
(115, 0, 66, '2023-10-16', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:10:10', '2023-03-28 21:10:10'),
(116, 0, 66, '2023-10-17', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:10:35', '2023-03-28 21:10:35'),
(117, 0, 56, '2023-10-18', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:11:15', '2023-03-28 21:11:15'),
(118, 0, 56, '2023-10-19', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:11:50', '2023-03-28 21:11:50'),
(119, 0, 56, '2023-10-14', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:13:13', '2023-03-28 21:13:13'),
(120, 0, 56, '2023-10-15', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:13:36', '2023-03-28 21:13:36'),
(121, 0, 56, '2023-10-20', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:14:17', '2023-03-28 21:14:17'),
(122, 0, 56, '2023-10-22', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:14:37', '2023-03-28 21:14:37'),
(123, 0, 71, '2023-10-22', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:15:19', '2023-03-28 21:15:19'),
(124, 0, 71, '2023-10-16', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:15:42', '2023-03-28 21:15:42'),
(125, 0, 71, '2023-10-17', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:16:15', '2023-03-28 21:16:15'),
(126, 0, 71, '2023-10-14', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:16:48', '2023-03-28 21:16:48'),
(127, 0, 71, '2023-10-15', '08:00', '17:00', 'All Day', 'DS', 'Work', '2023-03-28 21:17:01', '2023-03-28 21:17:01'),
(128, 0, 20, '2023-04-24', NULL, NULL, 'All Day', NULL, 'NotWork', '2023-03-29 07:51:44', '2023-04-06 15:32:34'),
(129, 0, 12, '2023-04-25', '08:00', '17:00', 'Null', 'Malaga', 'Vactions', '2023-03-29 07:52:07', '2023-03-29 07:52:07'),
(130, 0, 20, '2023-04-01', '08:00', '17:00', 'All Day', 'Martines fødselsdag', 'NotWork', '2023-04-01 12:47:12', '2023-04-01 12:47:12'),
(131, 0, 12, '2023-04-01', '08:00', '17:00', 'All Day', 'Dagsvagt i Hvidovre', 'NotWork', '2023-04-01 12:47:43', '2023-04-01 12:47:43'),
(132, 0, 12, '2023-03-31', '08:00', '17:00', 'All Day', 'Dagsvagt i Ballerup', 'NotWork', '2023-04-01 12:48:07', '2023-04-03 04:59:15'),
(133, 0, 12, '2023-05-02', '08:00', '16:00', 'Null', 'Kursus', 'NotWork', '2023-04-01 14:05:27', '2023-04-01 14:05:27'),
(134, 0, 19, '2023-06-22', '08:00', '17:00', 'All Day', NULL, 'NotWork', '2023-04-01 16:38:08', '2023-04-01 16:38:08'),
(135, 0, 19, '2023-06-23', '08:00', '17:00', 'All Day', NULL, 'NotWork', '2023-04-01 16:38:24', '2023-04-01 16:38:24'),
(136, 0, 19, '2023-06-24', '08:00', '17:00', 'All Day', NULL, 'NotWork', '2023-04-01 16:38:50', '2023-04-01 16:38:50'),
(137, 0, 19, '2023-06-25', '08:00', '17:00', 'All Day', NULL, 'NotWork', '2023-04-01 16:39:03', '2023-04-01 16:39:03'),
(138, 0, 12, '2023-04-21', '08:00', '17:00', 'All Day', NULL, 'NotWork', '2023-04-09 11:56:06', '2023-04-09 11:56:06'),
(139, 0, 12, '2023-04-22', '08:00', '17:00', 'All Day', NULL, 'NotWork', '2023-04-09 11:56:18', '2023-04-09 11:56:18'),
(140, 0, 12, '2023-04-10', '08:00', '17:00', 'All Day', 'Dagsvagt', 'NotWork', '2023-04-09 16:45:18', '2023-04-09 16:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('arhamkhaninnocent@gmail.com', '$2y$10$uyQHHcaGxrWmmG7/tsnU8eW77JJAgaKFtXbqtxt65JWcWozUq3Spm', '2022-10-27 10:00:39'),
('mjz@outlook.dk', '$2y$10$QjbuS3yFNVWIz9G58Z.4X.WwMi07wVAg377Vq615UfhJKNQf.PnnG', '2023-04-09 11:31:10'),
('kenneth@damholdt.dk', '$2y$10$XxU.7bwqh968/JhOsnmJiu2F.PbS04RnWJl.UG3oQqzQuK3W/sBpW', '2023-04-10 10:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_assignments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_loactions` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_groups` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hourly_wags` int NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_hours` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_hourly_wags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visibility` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `customer_id`, `customer_assignments`, `customer_loactions`, `staff_id`, `staff_groups`, `vehicle_id`, `type`, `hourly_wags`, `date`, `start_time`, `end_time`, `total_hours`, `total_hourly_wags`, `status`, `visibility`, `notes`, `created_at`, `updated_at`) VALUES
(52, '29', '12', '6,7', '12', '11,13', '32', 'Customer', 1, '2023-06-11', '09:00', '13:30', '4.50', '4.5', 'Accepted', 'Published', 'Ambulance #3035 (Århus Marathon)', '2023-03-01 19:13:07', '2023-04-01 14:36:47'),
(53, '29', '12', '7', '20', '11,13', '32', 'Customer', 1, '2023-06-11', '09:00', '13:30', '4.50', '4.5', 'Accepted', 'Published', 'Århus Marathon + køretid fra Kbh', '2023-03-01 19:13:14', '2023-04-01 14:37:09'),
(54, '27', '13', '7', 'undefined', '11,13', '32', 'Customer', 1, '2023-05-31', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', '2 ambulancer, 1 læge, og 6 samaritter', '2023-03-01 19:57:37', '2023-04-01 14:30:58'),
(56, '27', '13', '7', 'undefined', NULL, NULL, 'Customer', 1, '2023-06-02', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', '2 ambulancer, 1 læge, og 6 samaritter', '2023-03-01 19:57:59', '2023-04-02 14:08:46'),
(57, '27', '13', '7', 'undefined', NULL, NULL, 'Customer', 1, '2023-06-03', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', '2 ambulancer, 1 læge, og 6 samaritter', '2023-03-01 19:57:59', '2023-04-02 14:08:51'),
(58, '8', '10', '6,8,9', '22', '1', NULL, 'Customer', 1, '2023-06-01', '13:00', '02:00', '11.00', '11', 'Accepted', 'Published', 'BSK operatør', '2023-03-01 19:58:45', '2023-04-02 14:05:01'),
(61, '30', NULL, '8', 'undefined', NULL, NULL, 'Customer', 1, '2023-06-09', '13:30', '01:30', '12.00', '12', 'Pending', 'NotPublished', NULL, '2023-03-01 20:06:32', '2023-04-02 13:39:07'),
(62, '30', NULL, '8', 'undefined', '3,11,13', NULL, 'Customer', 1, '2023-06-10', '09:30', '01:30', '8.00', '8', 'Pending', 'NotPublished', NULL, '2023-03-01 20:06:45', '2023-04-02 13:39:48'),
(63, '27', '14', '7', 'undefined', NULL, NULL, 'Customer', 1, '2023-06-15', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', '3 ambulancer, 2 læger og 6 samaritter', '2023-03-01 20:09:07', '2023-04-01 16:14:00'),
(64, '27', '14', '7', 'undefined', NULL, NULL, 'Customer', 1, '2023-06-16', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', '3 ambulancer, 2 læger og 6 samaritter', '2023-03-01 20:09:24', '2023-04-01 16:14:06'),
(65, '27', '14', '7', 'undefined', NULL, NULL, 'Customer', 1, '2023-06-17', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', '3 ambulancer, 2 læger og 6 samaritter', '2023-03-01 20:09:24', '2023-04-01 16:14:11'),
(66, '27', '14', '7', 'undefined', NULL, NULL, 'Customer', 1, '2023-06-18', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', '3 ambulancer, 2 læger og 6 samaritter', '2023-03-01 20:09:40', '2023-04-01 16:14:16'),
(67, '8', '11', NULL, '0', NULL, NULL, 'Customer', 1, '2023-06-22', '11:00', '02:30', '8.50', '8.5', 'Pending', 'Published', NULL, '2023-03-01 20:13:11', '2023-03-01 20:13:11'),
(68, '8', '11', NULL, '0', NULL, NULL, 'Customer', 1, '2023-06-23', '11:00', '02:30', '8.50', '8.5', 'Pending', 'Published', NULL, '2023-03-01 20:13:18', '2023-03-01 20:13:18'),
(69, '8', '11', NULL, '0', NULL, NULL, 'Customer', 1, '2023-06-24', '11:00', '02:30', '8.50', '8.5', 'Pending', 'Published', NULL, '2023-03-01 20:13:18', '2023-03-01 20:13:18'),
(87, '1', '9', '12', '12', '11,13', '30', 'Customer', 1, '2023-04-29', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-03-03 14:07:43', '2023-04-01 14:01:52'),
(91, '29', NULL, '8,9', '0', NULL, NULL, 'Customer', 1, '2023-02-28', '08:00', '13:30', '5.50', '5.5', 'Pending', 'Published', NULL, '2023-03-04 20:20:31', '2023-03-06 09:46:13'),
(92, '2', NULL, '6', '0', '11,13', NULL, 'Customer', 1, '2023-02-28', '08:00', '13:30', '5.50', '5.5', 'Pending', 'Published', 'dsfdf', '2023-03-04 20:27:48', '2023-03-05 22:20:59'),
(93, '29', NULL, '8,9', '59', '11', NULL, 'Customer', 1, '2023-03-02', '08:00', '13:30', '5.50', '5.5', 'Declined', 'Published', NULL, '2023-03-06 10:00:33', '2023-03-29 11:57:03'),
(94, '29', NULL, '8,9', '0', '11,12,13', NULL, 'Customer', 1, '2023-03-03', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', NULL, '2023-03-06 10:00:33', '2023-03-17 18:50:58'),
(95, '29', NULL, '8,9', '76', '3', NULL, 'Customer', 1, '2023-03-04', '08:00', '13:30', '5.50', '5.5', 'Accepted', 'Published', NULL, '2023-03-06 10:00:33', '2023-03-13 08:14:02'),
(104, '8', '10', '6,8,9', '20', '13', NULL, 'Customer', 1, '2023-06-01', '13:00', '02:00', '11.00', '11', 'Accepted', 'Published', 'Supervisor #1', '2023-03-07 17:54:31', '2023-04-02 13:52:58'),
(123, '20', NULL, '6', '0', '3,14', NULL, 'Customer', 1, '2023-02-27', '08:00', '13:30', '5.50', '5.5', 'Pending', 'Published', NULL, '2023-03-12 10:25:16', '2023-03-12 10:25:16'),
(128, '17', '19', '6', '12', '11,13', '32', 'Customer', 1, '2023-04-02', '10:00', '13:00', '3.00', '3', 'Accepted', 'Published', 'Glostrup torv + medic (kr. 2500)', '2023-03-13 13:30:40', '2023-04-01 12:45:04'),
(130, '17', NULL, '6', '0', '3,11,13', NULL, 'Customer', 1, '2023-09-03', '09:30', '16:00', '6.50', '6.5', 'Pending', 'Published', 'Tour de Vest (Glostrup Hallen)', '2023-03-13 13:33:28', '2023-03-13 13:33:28'),
(131, '17', NULL, '6', '0', '3,11,13', NULL, 'Customer', 1, '2023-09-03', '09:30', '16:00', '6.50', '6.5', 'Pending', 'Published', 'Tour de Vest (Glostrup Hallen)', '2023-03-13 13:33:58', '2023-03-13 13:33:58'),
(132, '32', NULL, '6', '12', '11,12,13', '32', 'Customer', 1, '2023-07-06', '09:00', '16:00', '7.00', '7', 'Accepted', 'Published', 'Hotel Villa Copenhagen', '2023-03-16 13:03:47', '2023-04-02 20:23:57'),
(133, '32', NULL, '6', '20', '11,12,13', '32', 'Customer', 1, '2023-07-06', '09:00', '16:00', '7.00', '7', 'Pending', 'Published', 'Hotel Villa Copenhagen', '2023-03-16 13:04:01', '2023-04-01 16:29:34'),
(143, '20', NULL, '6', '0', '3,14', NULL, 'Customer', 1, '2023-03-01', '08:00', '13:30', '5.50', '5.5', 'Pending', 'Published', NULL, '2023-03-17 18:53:12', '2023-03-17 18:53:12'),
(145, '20', NULL, '6', '0', '3,14', NULL, 'Customer', 1, '2023-03-01', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', NULL, '2023-03-17 18:53:12', '2023-03-17 22:06:58'),
(146, '20', NULL, '6', '0', '3,14', NULL, 'Customer', 1, '2023-03-03', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', NULL, '2023-03-17 18:53:12', '2023-03-17 22:07:03'),
(151, '5', NULL, '7,8,9', 'undefined', '1', NULL, 'Customer', 1, '2023-03-14', '08:00', '13:30', '5.50', '5.5', 'Pending', 'Published', NULL, '2023-03-19 11:45:19', '2023-04-01 07:14:53'),
(154, '12', NULL, '7', '12', '11,12,13', '32', 'Customer', 1, '2023-04-05', '12:00', '22:00', '10.00', '10', 'Accepted', 'Published', 'Ambulance 3035 + Opstilling af behandlingsrum', '2023-03-22 21:05:19', '2023-04-09 11:39:54'),
(155, '12', '15', '7', '20', '13', '32', 'Customer', 1, '2023-04-05', '12:00', '22:00', '10.00', '10', 'Accepted', 'Published', 'Ambulance 3035 + Opstilling af behandlingsrum', '2023-03-22 21:06:18', '2023-04-09 11:40:12'),
(156, '12', '15', '7', '40', '10', '32', 'Customer', 1, '2023-04-05', '13:00', '18:00', '5.00', '5', 'Accepted', 'Published', 'Læge', '2023-03-22 21:06:18', '2023-04-02 13:23:40'),
(158, '12', '15', '7', '12', '11,12,13', '32', 'Customer', 1, '2023-04-08', '12:00', '22:00', '10.00', '10', 'Accepted', 'Published', 'Ambulance 3035 + Opstilling af behandlingsrum', '2023-03-22 21:12:39', '2023-04-09 11:40:22'),
(159, '12', '15', '7', '20', '13', '32', 'Customer', 1, '2023-04-08', '12:00', '22:00', '10.00', '10', 'Accepted', 'Published', 'Ambulance 3035 + Opstilling af behandlingsrum', '2023-03-22 21:13:03', '2023-04-09 11:40:31'),
(160, '12', '15', '7', '121', '10', '32', 'Customer', 1, '2023-04-08', '17:30', '22:00', '4.50', '4.5', 'Accepted', 'Published', 'Læge - Rasmus Vinkel', '2023-03-22 21:13:21', '2023-04-09 16:37:13'),
(161, '12', '15', '7', '20', '13', '32', 'Customer', 1, '2023-04-11', '12:00', '17:30', '5.50', '5.5', 'Accepted', 'Published', 'Opstilling af behandlingsrum', '2023-03-22 21:14:20', '2023-04-02 13:29:16'),
(163, '12', '15', '7', '118', '11,12,13', '32', 'Customer', 1, '2023-04-11', '13:00', '17:30', '4.50', '4.5', 'Accepted', 'Published', NULL, '2023-03-22 21:16:07', '2023-04-09 17:22:08'),
(164, '12', '16', '7', '12', '11,12,13', '31', 'Customer', 1, '2023-04-11', '12:00', '17:30', '5.50', '5.5', 'Accepted', 'Published', NULL, '2023-03-22 21:17:15', '2023-04-09 11:42:57'),
(165, '12', '16', '7', 'undefined', '11,12,13', '31', 'Customer', 1, '2023-04-11', '13:00', '17:30', '4.50', '4.5', 'Pending', 'Published', 'Peder Ersgaard', '2023-03-22 21:17:48', '2023-04-09 11:43:54'),
(166, '12', '16', '7', 'undefined', '10', '31', 'Customer', 1, '2023-04-11', '13:00', '17:30', '4.50', '4.5', 'Pending', 'Published', 'Rikke Ersgaard Læge', '2023-03-22 21:18:05', '2023-04-09 11:43:39'),
(167, '1', '20', '6,7,8,9,10', '22', '17', NULL, 'Customer', 1, '2023-04-15', '08:00', '16:00', '8.00', '8', 'Accepted', 'Published', 'DS', '2023-03-22 21:21:43', '2023-04-01 13:45:08'),
(168, '1', '20', '12', '12', '17', NULL, 'Customer', 1, '2023-04-15', '08:00', '16:00', '8.00', '8', 'Accepted', 'Published', 'DS', '2023-03-22 21:21:56', '2023-04-01 13:46:38'),
(169, '1', '20', '12', '12', '17', NULL, 'Customer', 1, '2023-04-16', '08:00', '16:00', '8.00', '8', 'Accepted', 'Published', 'DS', '2023-03-22 21:22:20', '2023-04-01 13:47:53'),
(170, '1', '20', '7', '22', '17', NULL, 'Customer', 1, '2023-04-16', '08:00', '16:00', '8.00', '8', 'Accepted', 'Published', 'DS', '2023-03-22 21:22:41', '2023-04-01 13:48:17'),
(172, '1', '20', '12', '19', '17', NULL, 'Customer', 1, '2023-04-15', '08:00', '16:00', '8.00', '8', 'Accepted', 'Published', 'DS', '2023-03-22 21:23:01', '2023-04-09 13:54:40'),
(173, '8', '21', '6,8,9', '22', '17', NULL, 'Customer', 1, '2023-04-29', '08:00', '20:00', '12.00', '12', 'Accepted', 'Published', 'DTD kursus weekend - Odense', '2023-03-22 21:24:30', '2023-04-01 14:00:16'),
(174, '8', '21', '6,8,9', '20', '17', NULL, 'Customer', 1, '2023-04-30', '08:00', '20:00', '12.00', '12', 'Pending', 'Published', 'DTD kursus weekend - Odense (ej bekræftet)', '2023-03-22 21:24:53', '2023-04-01 14:00:49'),
(175, '8', '21', '6,8,9', '20', '17', NULL, 'Customer', 1, '2023-04-29', '08:00', '20:00', '12.00', '12', 'Pending', 'Published', 'DTD kursus weekend - Odense (ej bekræftet)', '2023-03-22 21:25:00', '2023-04-01 14:00:31'),
(176, '8', '21', '6,8,9', '22', '17', NULL, 'Customer', 1, '2023-04-30', '08:00', '20:00', '12.00', '12', 'Accepted', 'Published', 'DTD kursus weekend - Odense', '2023-03-22 21:26:15', '2023-04-01 14:05:49'),
(177, '29', '12', '8,9', '19', '13', NULL, 'Customer', 1, '2023-06-11', '09:00', '13:30', '4.50', '4.5', 'Accepted', 'Published', 'Lægeassistent + Golfbil', '2023-03-22 21:39:02', '2023-04-02 13:41:07'),
(178, '13', NULL, '8', '0', '11,12,13', NULL, 'Customer', 1, '2023-05-06', '11:00', '17:30', '6.50', '6.5', 'Pending', 'NotPublished', 'Ambulance 3035', '2023-03-22 21:54:13', '2023-03-22 21:58:22'),
(179, '13', NULL, '8', '0', '11,12,13', NULL, 'Customer', 1, '2023-05-06', '11:00', '17:30', '6.50', '6.5', 'Pending', 'NotPublished', 'Ambulance 3035', '2023-03-22 21:54:36', '2023-03-22 21:58:35'),
(180, '13', NULL, '8', '0', '11,12,13', NULL, 'Customer', 1, '2023-05-06', '11:00', '17:30', '6.50', '6.5', 'Pending', 'NotPublished', 'Ambulance 3036', '2023-03-22 21:54:36', '2023-03-22 21:58:44'),
(181, '13', NULL, '8', '0', '11,12,13', NULL, 'Customer', 1, '2023-05-06', '11:00', '17:30', '6.50', '6.5', 'Pending', 'NotPublished', 'Ambulance 3036', '2023-03-22 21:54:55', '2023-03-22 21:58:57'),
(182, '6', NULL, '6,8', '1', '2,3', NULL, 'Staff', 1, '2023-01-30', '08:00', '13:30', '5.50', '5.5', 'Pending', 'Published', 'Test note', '2023-03-23 07:08:20', '2023-03-23 07:08:20'),
(183, '6', NULL, '6', '1', '2,3', NULL, 'Staff', 1, '2023-01-31', '08:00', '13:30', '5.50', '5.5', 'Accepted', 'NotPublished', 'Test note', '2023-03-23 07:08:34', '2023-03-23 07:09:31'),
(185, '6', NULL, '6,8', '1', '2,3', NULL, 'Staff', 1, '2023-02-01', '08:00', '13:30', '5.50', '5.5', 'Pending', 'Published', 'Test note', '2023-03-23 07:08:51', '2023-03-23 07:08:51'),
(186, '6', NULL, '6', '1', '2,3', NULL, 'Staff', 1, '2023-02-02', '08:00', '13:30', '5.50', '5.5', 'Declined', 'NotPublished', 'Test note', '2023-03-23 07:08:51', '2023-03-23 07:09:41'),
(187, '6', NULL, '6,8', '1', '2,3', NULL, 'Staff', 1, '2023-02-03', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', 'Test note', '2023-03-23 07:08:51', '2023-03-23 07:09:08'),
(188, '34', '18', '7', '53', '11,12,13', '32', 'Customer', 1, '2023-04-15', '08:00', '18:00', '10.00', '10', 'Accepted', 'Published', 'Rødby Karting Ring + transport tid', '2023-03-23 18:59:59', '2023-04-09 17:22:15'),
(191, '1', '9', '12', '68', '11,13', '30', 'Customer', 1, '2023-04-30', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-03-31 07:12:27', '2023-04-01 14:02:24'),
(192, '34', '18', '7', 'undefined', '11,12,13', '32', 'Customer', 1, '2023-04-15', '08:00', '18:00', '10.00', '10', 'Pending', 'Published', 'Rødby Karting Ring + transport tid', '2023-04-01 13:41:10', '2023-04-01 13:42:24'),
(193, '1', '20', '12', '19', '17', NULL, 'Customer', 1, '2023-04-16', '08:00', '16:00', '8.00', '8', 'Accepted', 'Published', 'DS', '2023-04-01 13:47:25', '2023-04-09 13:54:51'),
(194, '8', '21', '6,8,9', '22', '17', NULL, 'Customer', 1, '2023-04-28', '08:00', '20:00', '12.00', '12', 'Accepted', 'Published', 'DTD kursus weekend - Odense', '2023-04-01 14:09:59', '2023-04-01 14:10:31'),
(195, '8', '21', '6,8,9', '12', '17', NULL, 'Customer', 1, '2023-04-28', '08:00', '20:00', '12.00', '12', 'Pending', 'Published', 'DTD kursus weekend - Odense (ej bekræftet)', '2023-04-01 14:10:48', '2023-04-02 13:32:12'),
(196, '1', '9', '12', '0', '11,13', '30', 'Customer', 1, '2023-05-05', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-01 14:17:09', '2023-04-01 14:17:09'),
(197, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-05-06', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-01 14:17:23', '2023-04-01 14:17:36'),
(198, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-05-07', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-01 14:17:27', '2023-04-01 14:17:49'),
(199, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-05-13', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 14:19:49', '2023-04-10 11:49:23'),
(200, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-05-14', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 14:20:08', '2023-04-10 11:49:33'),
(201, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-05-18', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 14:21:55', '2023-04-01 14:23:37'),
(202, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-05-19', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 14:22:00', '2023-04-01 14:24:08'),
(203, '1', '9', '12', '63', '11,13', '30', 'Customer', 1, '2023-05-20', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 14:22:02', '2023-04-01 14:22:46'),
(204, '1', '9', '12', '63', '11,13', '30', 'Customer', 1, '2023-05-21', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 14:22:05', '2023-04-01 14:23:03'),
(206, '1', '9', '12', '0', '11,13', '30', 'Customer', 1, '2023-05-27', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-01 14:25:05', '2023-04-01 14:26:13'),
(207, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-05-28', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-01 14:26:17', '2023-04-01 14:26:26'),
(208, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-05-29', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 14:26:43', '2023-04-01 16:12:19'),
(209, '1', '9', '12', '66', '11,13', '30', 'Customer', 1, '2023-06-03', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 14:27:26', '2023-04-02 13:36:55'),
(210, '1', '9', '12', '63', '11,13', '30', 'Customer', 1, '2023-06-04', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 14:27:29', '2023-04-01 14:28:12'),
(211, '27', '13', '7', 'undefined', '11,13', '32', 'Customer', 1, '2023-05-31', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', '2 ambulancer, 1 læge, og 6 samaritter', '2023-04-01 14:30:37', '2023-04-01 14:31:06'),
(212, '27', '13', '7', 'undefined', '11,13', '31', 'Customer', 1, '2023-05-31', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', '2 ambulancer, 1 læge, og 6 samaritter', '2023-04-01 14:31:35', '2023-04-01 14:31:47'),
(213, '27', '13', '7', 'undefined', '11,13', '31', 'Customer', 1, '2023-05-31', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', '2 ambulancer, 1 læge, og 6 samaritter', '2023-04-01 14:31:35', '2023-04-01 14:31:54'),
(214, '27', '13', '7', 'undefined', '10', '31', 'Customer', 1, '2023-05-31', '08:00', '13:30', '5.50', '5.5', 'Pending', 'NotPublished', '2 ambulancer, 1 læge, og 6 samaritter', '2023-04-01 14:32:04', '2023-04-01 14:32:29'),
(215, '1', '9', '12', '0', '11,13', '30', 'Customer', 1, '2023-06-05', '08:00', '13:30', '5.50', '5.5', 'Pending', 'Published', NULL, '2023-04-01 14:39:48', '2023-04-01 14:39:48'),
(216, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-06-10', '08:00', '13:30', '5.50', '5.5', 'Accepted', 'Published', NULL, '2023-04-01 14:40:05', '2023-04-01 14:44:38'),
(217, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-06-11', '08:00', '13:30', '5.50', '5.5', 'Accepted', 'Published', NULL, '2023-04-01 14:40:10', '2023-04-01 14:44:45'),
(218, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-06-17', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 16:15:00', '2023-04-01 16:18:06'),
(219, '1', '9', '12', '63', '11,13', '30', 'Customer', 1, '2023-06-18', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 16:15:05', '2023-04-01 16:15:24'),
(220, '1', '9', '12', '63', '11,13', '30', 'Customer', 1, '2023-06-19', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 16:15:53', '2023-04-01 16:17:10'),
(221, '1', '9', '12', '68', '11,13', '30', 'Customer', 1, '2023-06-20', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 16:16:16', '2023-04-01 16:18:48'),
(222, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-06-21', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-01 16:16:42', '2023-04-01 16:18:57'),
(223, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-06-22', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-01 16:16:45', '2023-04-01 16:19:03'),
(224, '1', '9', '12', '66', '11,13', '30', 'Customer', 1, '2023-06-24', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 16:16:50', '2023-04-01 16:20:52'),
(225, '1', '9', '12', '66', '11,13', '30', 'Customer', 1, '2023-06-25', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 16:16:52', '2023-04-01 16:22:14'),
(226, '1', '9', '12', '68', '11,13', '30', 'Customer', 1, '2023-06-26', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 16:23:19', '2023-04-01 16:24:16'),
(227, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-06-27', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 16:23:59', '2023-04-01 16:24:30'),
(228, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-06-28', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 16:24:33', '2023-04-01 16:25:03'),
(229, '1', '9', '12', '66', '11,13', '30', 'Customer', 1, '2023-06-29', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-01 16:25:06', '2023-04-01 16:25:18'),
(230, '1', '9', '12', '0', '11,13', '30', 'Customer', 1, '2023-06-30', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-01 16:25:42', '2023-04-01 16:25:57'),
(231, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-07-01', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:26:03', '2023-04-02 12:48:50'),
(232, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-07-02', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:26:12', '2023-04-02 12:49:06'),
(233, '1', '9', '12', '68', '11,13', '30', 'Customer', 1, '2023-07-03', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:27:24', '2023-04-01 16:28:11'),
(236, '1', '9', '12', '68', '11,13', '30', 'Customer', 1, '2023-07-04', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:28:16', '2023-04-01 16:28:56'),
(237, '1', '9', '12', '68', '11,13', '30', 'Customer', 1, '2023-07-05', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:28:18', '2023-04-01 16:28:59'),
(238, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-07-06', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:29:44', '2023-04-01 16:30:07'),
(239, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-07-07', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:30:12', '2023-04-01 16:30:36'),
(240, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-07-08', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:30:28', '2023-04-01 16:30:49'),
(241, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-07-09', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:30:30', '2023-04-01 16:31:00'),
(242, '1', '9', '12', '0', '11,13', '30', 'Customer', 1, '2023-07-10', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:32:16', '2023-04-01 16:32:56'),
(243, '1', '9', '12', '68', '11,13', '30', 'Customer', 1, '2023-07-11', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:32:23', '2023-04-01 16:33:06'),
(244, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-07-12', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:33:11', '2023-04-01 16:33:21'),
(245, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-07-13', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:33:24', '2023-04-01 16:33:31'),
(246, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-07-14', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:33:34', '2023-04-01 16:33:40'),
(247, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-07-15', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:33:43', '2023-04-01 16:33:51'),
(248, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-07-16', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:33:54', '2023-04-01 16:34:01'),
(249, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-07-17', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:34:50', '2023-04-02 12:51:24'),
(250, '1', '9', '12', '68', '11,13', '30', 'Customer', 1, '2023-07-19', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:35:07', '2023-04-02 12:51:36'),
(251, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-07-18', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:35:10', '2023-04-01 16:35:42'),
(252, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-07-20', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:35:22', '2023-04-01 16:35:54'),
(253, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-07-21', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:35:24', '2023-04-01 16:36:02'),
(254, '1', '9', '12', '66', '11,13', '30', 'Customer', 1, '2023-07-22', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:35:27', '2023-04-02 12:53:27'),
(255, '1', '9', '12', '66', '11,13', '30', 'Customer', 1, '2023-07-23', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:35:30', '2023-04-02 12:53:38'),
(256, '1', '9', '12', '0', '11,13', '30', 'Customer', 1, '2023-07-24', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:36:56', '2023-04-01 16:36:56'),
(257, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-07-25', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:37:01', '2023-04-02 12:55:54'),
(258, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-07-26', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:37:07', '2023-04-02 12:56:01'),
(259, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-07-27', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-01 16:37:10', '2023-04-02 12:55:47'),
(260, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-07-28', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-01 16:37:12', '2023-04-02 12:54:07'),
(264, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-07-29', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-02 12:54:20', '2023-04-02 12:57:57'),
(265, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-07-30', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-02 12:55:23', '2023-04-02 12:55:39'),
(266, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-07-31', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-02 12:59:31', '2023-04-02 13:00:54'),
(267, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-08-01', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-02 12:59:44', '2023-04-02 13:01:37'),
(273, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-08-02', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-02 13:01:41', '2023-04-02 13:01:59'),
(274, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-08-03', '09:45', '20:30', '10.75', '10.75', 'Pending', 'Published', NULL, '2023-04-02 13:01:44', '2023-04-02 13:02:06'),
(275, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-08-04', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-02 13:01:46', '2023-04-02 13:02:55'),
(276, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-08-05', '09:45', '20:30', '10.75', '10.75', 'Accepted', 'Published', NULL, '2023-04-02 13:01:48', '2023-04-02 13:03:04'),
(277, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-08-06', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:01:51', '2023-04-02 13:03:33'),
(278, '1', '9', '12', '66', '11,13', '30', 'Customer', 1, '2023-08-07', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:05:07', '2023-04-02 13:05:30'),
(279, '1', '9', '12', '66', '11,13', '30', 'Customer', 1, '2023-08-08', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:05:17', '2023-04-02 13:05:39'),
(280, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-08-09', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-02 13:05:17', '2023-04-02 13:05:45'),
(281, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-08-10', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-02 13:05:17', '2023-04-02 13:05:49'),
(282, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-08-11', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-02 13:05:17', '2023-04-02 13:05:53'),
(283, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-08-12', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:05:17', '2023-04-10 11:57:00'),
(284, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-08-13', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:05:17', '2023-04-10 11:57:15'),
(286, '1', '9', '12', '0', '11,13', '30', 'Customer', 1, '2023-08-19', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-02 13:08:34', '2023-04-02 13:08:34'),
(287, '1', '9', '12', 'undefined', '11,13', '30', 'Customer', 1, '2023-08-20', '09:45', '18:30', '8.75', '8.75', 'Pending', 'Published', NULL, '2023-04-02 13:08:38', '2023-04-02 13:08:45'),
(288, '1', '9', '12', '61', '11,13', '30', 'Customer', 1, '2023-08-26', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:09:29', '2023-04-02 13:09:58'),
(289, '1', '9', '12', '63', '11,13', '30', 'Customer', 1, '2023-08-27', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:09:33', '2023-04-02 13:09:48'),
(290, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-09-02', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:11:21', '2023-04-02 13:11:45'),
(291, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-09-03', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:11:49', '2023-04-02 13:11:59'),
(292, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-09-09', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:13:24', '2023-04-10 11:44:32'),
(293, '1', '9', '12', '19', '11,13', '30', 'Customer', 1, '2023-09-10', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:13:27', '2023-04-10 11:44:53'),
(294, '1', '9', '12', '63', '11,13', '30', 'Customer', 1, '2023-09-16', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:14:44', '2023-04-02 13:14:44'),
(295, '1', '9', '12', '68', '11,13', '30', 'Customer', 1, '2023-09-17', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:14:49', '2023-04-02 13:15:04'),
(296, '1', '9', '12', '71', '11,13', '30', 'Customer', 1, '2023-09-23', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:15:54', '2023-04-02 13:15:58'),
(297, '1', '9', '12', '56', '11,13', '30', 'Customer', 1, '2023-09-24', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:16:03', '2023-04-02 13:16:15'),
(298, '1', '9', '12', '56', '11,13', '30', 'Customer', 1, '2023-10-14', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:17:27', '2023-04-02 13:17:27'),
(299, '1', '9', '12', '56', '11,13', '30', 'Customer', 1, '2023-10-15', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:17:32', '2023-04-02 13:17:45'),
(300, '1', '9', '12', '63', '11,13', '30', 'Customer', 1, '2023-10-16', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:20:04', '2023-04-02 13:20:04'),
(301, '1', '9', '12', '66', '11,13', '30', 'Customer', 1, '2023-10-17', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:20:08', '2023-04-02 13:20:32'),
(302, '1', '9', '12', '56', '11,13', '30', 'Customer', 1, '2023-10-18', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:20:37', '2023-04-02 13:20:54'),
(303, '1', '9', '12', '56', '11,13', '30', 'Customer', 1, '2023-10-19', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:20:59', '2023-04-02 13:21:08'),
(304, '1', '9', '12', '56', '11,13', '30', 'Customer', 1, '2023-10-20', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:21:10', '2023-04-02 13:21:21'),
(305, '1', '9', '12', '61', '11,13', '30', 'Customer', 1, '2023-10-21', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:21:26', '2023-04-02 13:21:36'),
(306, '1', '9', '12', '68', '11,13', '30', 'Customer', 1, '2023-10-22', '09:45', '18:30', '8.75', '8.75', 'Accepted', 'Published', NULL, '2023-04-02 13:21:42', '2023-04-02 13:21:54'),
(307, '30', NULL, '8', '0', NULL, NULL, 'Customer', 1, '2023-06-09', '13:30', '01:30', '12.00', '12', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:25', '2023-04-02 13:39:25'),
(308, '30', NULL, '8', '0', NULL, NULL, 'Customer', 1, '2023-06-09', '13:30', '01:30', '12.00', '12', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:25', '2023-04-02 13:39:25'),
(309, '30', NULL, '8', '0', NULL, NULL, 'Customer', 1, '2023-06-09', '13:30', '01:30', '12.00', '12', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:25', '2023-04-02 13:39:25'),
(310, '30', NULL, '8', '0', NULL, NULL, 'Customer', 1, '2023-06-09', '13:30', '01:30', '12.00', '12', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:25', '2023-04-02 13:39:25'),
(311, '30', NULL, '8', '0', NULL, NULL, 'Customer', 1, '2023-06-09', '13:30', '01:30', '12.00', '12', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:25', '2023-04-02 13:39:25'),
(312, '30', NULL, '8', '0', NULL, NULL, 'Customer', 1, '2023-06-09', '13:30', '01:30', '12.00', '12', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:25', '2023-04-02 13:39:25'),
(313, '30', NULL, '8', '0', NULL, NULL, 'Customer', 1, '2023-06-09', '13:30', '01:30', '12.00', '12', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:25', '2023-04-02 13:39:25'),
(314, '30', NULL, '8', '0', NULL, NULL, 'Customer', 1, '2023-06-09', '13:30', '01:30', '12.00', '12', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:25', '2023-04-02 13:39:25'),
(315, '30', NULL, '8', '0', NULL, NULL, 'Customer', 1, '2023-06-09', '13:30', '01:30', '12.00', '12', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:25', '2023-04-02 13:39:25'),
(316, '30', NULL, '8', '0', '3,11,13', NULL, 'Customer', 1, '2023-06-10', '09:30', '01:30', '8.00', '8', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:59', '2023-04-02 13:39:59'),
(317, '30', NULL, '8', '0', '3,11,13', NULL, 'Customer', 1, '2023-06-10', '09:30', '01:30', '8.00', '8', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:59', '2023-04-02 13:39:59'),
(318, '30', NULL, '8', '0', '3,11,13', NULL, 'Customer', 1, '2023-06-10', '09:30', '01:30', '8.00', '8', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:59', '2023-04-02 13:39:59'),
(319, '30', NULL, '8', '0', '3,11,13', NULL, 'Customer', 1, '2023-06-10', '09:30', '01:30', '8.00', '8', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:59', '2023-04-02 13:39:59'),
(320, '30', NULL, '8', '0', '3,11,13', NULL, 'Customer', 1, '2023-06-10', '09:30', '01:30', '8.00', '8', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:59', '2023-04-02 13:39:59'),
(321, '30', NULL, '8', '0', '3,11,13', NULL, 'Customer', 1, '2023-06-10', '09:30', '01:30', '8.00', '8', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:59', '2023-04-02 13:39:59'),
(322, '30', NULL, '8', '0', '3,11,13', NULL, 'Customer', 1, '2023-06-10', '09:30', '01:30', '8.00', '8', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:59', '2023-04-02 13:39:59'),
(323, '30', NULL, '8', '0', '3,11,13', NULL, 'Customer', 1, '2023-06-10', '09:30', '01:30', '8.00', '8', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:59', '2023-04-02 13:39:59'),
(324, '30', NULL, '8', '0', '3,11,13', NULL, 'Customer', 1, '2023-06-10', '09:30', '01:30', '8.00', '8', 'Pending', 'NotPublished', NULL, '2023-04-02 13:39:59', '2023-04-02 13:39:59'),
(325, '8', '10', '6,8,9', '12', '11', NULL, 'Customer', 1, '2023-06-01', '13:00', '02:00', '11.00', '11', 'Accepted', 'Published', 'Supervisor #2', '2023-04-02 13:50:14', '2023-04-02 13:53:12'),
(326, '8', '10', '6,7', '25', '14', NULL, 'Customer', 1, '2023-06-01', '13:00', '02:00', '11.00', '11', 'Accepted', 'Published', 'Behandlingspladsleder', '2023-04-02 13:51:13', '2023-04-02 13:52:36'),
(327, '8', '10', '6,8,9', '64', '3,14', NULL, 'Customer', 1, '2023-06-01', '13:00', '02:00', '11.00', '11', 'Pending', 'Published', 'Behandlingsplads', '2023-04-02 13:53:24', '2023-04-02 23:11:12'),
(328, '8', '10', '6,8,9', '117', '3,14', NULL, 'Customer', 1, '2023-06-01', '13:00', '01:00', '12.00', '12', 'Accepted', 'Published', 'Behandlingsplads - Betina Krantz', '2023-04-02 13:57:23', '2023-04-04 14:30:40'),
(329, '8', '10', '6,8,9', '19', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '13:00', '01:00', '12.00', '12', 'Accepted', 'Published', 'Behandlingsplads - Ulla', '2023-04-02 13:57:59', '2023-04-10 11:46:57'),
(331, '8', '10', '6,8,9', '66', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '13:00', '01:00', '12.00', '12', 'Declined', 'Published', NULL, '2023-04-02 14:01:50', '2023-04-10 18:35:52'),
(332, '8', '10', '6,8,9', '0', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '13:00', '01:00', '12.00', '12', 'Pending', 'Published', NULL, '2023-04-02 14:01:50', '2023-04-02 14:01:50'),
(333, '8', '10', '6,8,9', '0', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '13:00', '01:00', '12.00', '12', 'Pending', 'Published', NULL, '2023-04-02 14:01:50', '2023-04-02 14:01:50'),
(334, '8', '10', '6,8,9', '0', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '13:00', '01:00', '12.00', '12', 'Pending', 'Published', NULL, '2023-04-02 14:01:50', '2023-04-02 14:01:50'),
(335, '8', '10', '6,8,9', '0', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '13:00', '01:00', '12.00', '12', 'Pending', 'Published', NULL, '2023-04-02 14:01:50', '2023-04-02 14:01:50'),
(336, '8', '10', '6,8,9', '119', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '18:00', '02:00', '16.00', '16', 'Accepted', 'Published', 'Soveplads', '2023-04-02 14:02:10', '2023-04-04 14:22:22'),
(337, '8', '10', '6,8,9', '0', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '18:00', '02:00', '16.00', '16', 'Pending', 'Published', NULL, '2023-04-02 14:02:42', '2023-04-02 14:02:42'),
(338, '8', '10', '6,8,9', '0', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '18:00', '02:00', '16.00', '16', 'Pending', 'Published', NULL, '2023-04-02 14:02:42', '2023-04-02 14:02:42'),
(339, '8', '10', '6,8,9', '0', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '18:00', '02:00', '16.00', '16', 'Pending', 'Published', NULL, '2023-04-02 14:02:42', '2023-04-02 14:02:42'),
(340, '8', '10', '6,8,9', '0', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '18:00', '02:00', '16.00', '16', 'Pending', 'Published', NULL, '2023-04-02 14:02:42', '2023-04-02 14:02:42'),
(341, '8', '10', '6,8,9', '0', '11,12,13', NULL, 'Customer', 1, '2023-06-01', '18:00', '02:00', '16.00', '16', 'Pending', 'Published', NULL, '2023-04-02 14:02:42', '2023-04-02 14:02:42'),
(346, '8', '10', '6,8,9', '22', '1', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:30', '9.50', '9.5', 'Accepted', 'Published', 'BSK operatør', '2023-04-04 14:01:29', '2023-04-04 14:07:58'),
(347, '8', '10', '6,8,9', '20', '13', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:30', '9.50', '9.5', 'Accepted', 'Published', 'Supervisor #1', '2023-04-04 14:02:14', '2023-04-04 14:08:11'),
(348, '8', '10', '6,8,9', '12', '11', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:30', '9.50', '9.5', 'Accepted', 'Published', 'Supervisor #2', '2023-04-04 14:02:31', '2023-04-04 14:08:26'),
(349, '8', '10', '6,8,9', '25', '14', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:30', '9.50', '9.5', 'Accepted', 'Published', 'Behandlingspladsleder', '2023-04-04 14:03:01', '2023-04-04 14:08:39'),
(350, '8', '10', '6,8,9', '64', '3,14', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:00', '10.00', '10', 'Pending', 'Published', 'Behandlingsplads', '2023-04-04 14:03:24', '2023-04-04 14:04:03'),
(351, '8', '10', '6,8,9', '117', '3,14', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:00', '10.00', '10', 'Accepted', 'Published', 'Behandlingsplads', '2023-04-04 14:03:30', '2023-04-04 14:27:53'),
(352, '8', '10', '6,8,9', '19', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:00', '10.00', '10', 'Accepted', 'Published', 'Behandlingsplads - Ulla', '2023-04-04 14:05:29', '2023-04-10 11:47:47'),
(353, '8', '10', '6,8,9', '119', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:00', '10.00', '10', 'Accepted', 'Published', 'Soveplads', '2023-04-04 14:05:50', '2023-04-04 14:28:37'),
(354, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:00', '10.00', '10', 'Pending', 'Published', NULL, '2023-04-04 14:05:52', '2023-04-04 14:28:50'),
(355, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:00', '10.00', '10', 'Pending', 'Published', NULL, '2023-04-04 14:05:55', '2023-04-04 14:29:00'),
(356, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:00', '10.00', '10', 'Pending', 'Published', NULL, '2023-04-04 14:05:57', '2023-04-04 14:29:34'),
(357, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '12:00', '02:00', '10.00', '10', 'Pending', 'Published', NULL, '2023-04-04 14:06:01', '2023-04-04 14:29:07'),
(358, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:06:23', '2023-04-04 14:23:04'),
(359, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:07:27', '2023-04-04 14:07:27'),
(360, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:07:30', '2023-04-04 14:07:30'),
(361, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:07:34', '2023-04-04 14:07:34'),
(362, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:07:38', '2023-04-04 14:07:38'),
(363, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-02', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:07:41', '2023-04-04 14:07:41'),
(364, '8', '10', '6,8,9', '22', '1', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:30', '9.50', '9.5', 'Accepted', 'Published', 'BSK operatør', '2023-04-04 14:09:32', '2023-04-04 14:09:36'),
(365, '8', '10', '6,8,9', '20', '13', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:30', '9.50', '9.5', 'Accepted', 'Published', 'Supervisor #1', '2023-04-04 14:09:41', '2023-04-04 14:24:02'),
(366, '8', '10', '6,8,9', '12', '11', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:30', '9.50', '9.5', 'Accepted', 'Published', 'Supervisor #2', '2023-04-04 14:09:47', '2023-04-04 14:24:07'),
(367, '8', '10', '6,8,9', '25', '14', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:30', '9.50', '9.5', 'Accepted', 'Published', 'Behandlingspladsleder', '2023-04-04 14:09:53', '2023-04-04 14:24:13'),
(368, '8', '10', '6,8,9', '64', '3,14', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:00', '10.00', '10', 'Pending', 'Published', 'Behandlingsplads', '2023-04-04 14:10:00', '2023-04-04 14:10:00'),
(369, '8', '10', '6,8,9', '117', '3,14', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:00', '10.00', '10', 'Accepted', 'Published', 'Behandlingsplads', '2023-04-04 14:10:06', '2023-04-04 14:30:25'),
(370, '8', '10', '6,8,9', '19', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:00', '10.00', '10', 'Accepted', 'Published', 'Behandlingsplads - Ulla', '2023-04-04 14:10:14', '2023-04-10 11:52:59'),
(371, '8', '10', '6,8,9', '119', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:00', '10.00', '10', 'Accepted', 'Published', 'Soveplads', '2023-04-04 14:10:17', '2023-04-04 14:31:35'),
(372, '8', '10', '6,8,9', '71', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:00', '10.00', '10', 'Accepted', 'Published', 'Rammstein', '2023-04-04 14:10:20', '2023-04-04 14:32:23'),
(373, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:00', '10.00', '10', 'Pending', 'Published', NULL, '2023-04-04 14:10:23', '2023-04-04 14:31:11'),
(374, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:00', '10.00', '10', 'Pending', 'Published', NULL, '2023-04-04 14:11:33', '2023-04-04 14:31:18'),
(375, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '12:00', '02:00', '10.00', '10', 'Pending', 'Published', NULL, '2023-04-04 14:12:04', '2023-04-04 14:32:38'),
(376, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:12:09', '2023-04-04 14:12:09'),
(377, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:12:12', '2023-04-04 14:12:12'),
(378, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:12:16', '2023-04-04 14:12:16'),
(379, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:12:19', '2023-04-04 14:12:19'),
(380, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:12:22', '2023-04-04 14:12:22'),
(381, '8', '10', '6,8,9', 'undefined', '11,12,13', NULL, 'Customer', 1, '2023-06-03', '18:00', '02:30', '15.50', '15.5', 'Pending', 'Published', NULL, '2023-04-04 14:12:26', '2023-04-04 14:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_applications`
--

CREATE TABLE `schedule_applications` (
  `id` bigint UNSIGNED NOT NULL,
  `schedule_id` int NOT NULL,
  `user_id` int NOT NULL,
  `accepted` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_notes`
--

CREATE TABLE `schedule_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `schedule_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `visibility` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `welcome_heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `welcome_sub_heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_reciving_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `welcome_heading`, `welcome_sub_heading`, `status_reciving_email`, `copyright`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Event Medical Services ApS', 'Velkommen til Event Medical Services ApS Intranet system. Vi håber at du kan finde det du søger og du må endelig kontakte os hvis noget mangler eller hvis du har spørgsmål.', 'mjz@eventmedical.dk', 'Event Medical Services ApS › Intranet', 'logo-1666079759.png', NULL, '2022-10-29 00:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `minisite_id` int NOT NULL,
  `task` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `done` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `user_id`, `minisite_id`, `task`, `priority`, `done`, `created_at`, `updated_at`) VALUES
(11, '12', 3, 'asdasdasdgasdfdfs', 'Yellow', 'No', '2023-01-09 17:27:29', '2023-01-09 17:27:29'),
(12, '12', 2, 'asdfasdfadsfa', 'Green', 'Yes', '2023-01-09 17:27:40', '2023-01-09 17:33:35'),
(13, '12', 3, 'sadfsdffghfhdhsdhffdhsdfh', 'Green', 'No', '2023-01-09 17:28:11', '2023-01-09 17:28:11'),
(14, '16', 2, 'Making ToDo App', 'Blue', 'No', '2023-01-09 17:31:51', '2023-01-12 13:27:28'),
(15, '12', 2, 'vbdffbdfhdfhghd', 'Green', 'Yes', '2023-01-09 17:34:00', '2023-01-09 18:10:53'),
(16, '12', 2, 'drhdrhdrhdrh', 'Green', 'No', '2023-01-09 17:34:05', '2023-01-09 17:34:05'),
(17, '12', 2, 'rgdzfsfgs', 'Red', 'No', '2023-01-09 17:36:12', '2023-01-09 17:36:12'),
(18, '12', 2, 'sdfsdfdsf', 'Yellow', 'No', '2023-01-09 17:36:17', '2023-01-09 17:36:17'),
(21, '12', 2, 'dsdssffdsf', 'Blue', 'No', '2023-01-12 13:27:01', '2023-01-12 13:27:44'),
(24, '28', 12, 'adsfasdfas', 'Blue', 'No', '2023-01-19 15:27:52', '2023-01-19 15:27:52'),
(25, '28', 12, 'asefasgasgag', 'Yellow', 'No', '2023-01-19 15:28:03', '2023-01-19 15:28:03'),
(26, '28', 12, 'asdafdsasdfasafd asdfasf asf asd asf', 'Green', 'Yes', '2023-01-19 15:28:11', '2023-01-19 15:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_information` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ice_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `group_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `who_update_status` int DEFAULT NULL,
  `work_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `co_line` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_navn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` longtext COLLATE utf8mb4_unicode_ci,
  `app_access` text COLLATE utf8mb4_unicode_ci,
  `schedule_settings` text COLLATE utf8mb4_unicode_ci,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Show',
  `birthday_cdr_control` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_note` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `note`, `bank_information`, `ice_contact`, `employment_date`, `role`, `group_id`, `location_id`, `status`, `who_update_status`, `work_title`, `co_line`, `street_navn`, `street_no`, `street_level`, `po_code`, `city_name`, `country`, `permissions`, `app_access`, `schedule_settings`, `start_date`, `end_date`, `type`, `sidebar`, `birthday_cdr_control`, `profile_note`, `image`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin A. Adminsson', 'admin@info.com', '$2y$10$qOsS85/Ad0/oNvlmwRUvQefAqkkqYUc0YrTZwZ84XwClRUXEATBLG', '+1 (182) 834-2104 2222', NULL, NULL, '345345435435', NULL, '2022-08-30', 'User', '2', '6', 'Active', NULL, 'Paramedic', NULL, 'Vesterbrogade', '2D', NULL, '1606', 'København', 'Denmark', 'All,ViewAuthProfile,UpdateAuthProfile,UserUpdatePassword,AuthStamDataView,AuthStamDataCreate,AuthStamDataUpdate,AuthStamDataDelete,AuthEquipmentView,AuthEquipmentCreate,AuthEquipmentUpdate,AuthDocumentDelete,AuthDocumentView,AuthDocumentCreate,AuthDocumentUpdate,AuthDocumentDelete,AuthNoteView,AuthNoteCreate,AuthNoteUpdate,AuthNoteDelete,AuthSettingView,AuthSettingUpdateStatus,AuthSettingUpdatePermission,AuthSettingDeleteAccount,NewsView,NewsCreate,NewsUpdate,NewsDelete,UserView,UserCreate,UserUpdate,UserDelete,UserGroupView,UserGroupCreate,UserGroupUpdate,UserGroupDelete,ViewUserProfile,UpdateUserProfile,UserStamDataView,UserStamDataCreate,UserStamDataUpdate,UserStamDataDelete,UserEquipmentView,UserEquipmentCreate,UserEquipmentUpdate,UserEquipmentDelete,UserDocumentView,UserDocumentCreate,UserDocumentUpdate,UserDocumentDelete,UserNoteView,UserNoteCreate,UserNoteUpdate,UserNoteDelete,UserSettingView,UserSettingUpdateStatus,UserSettingDeleteAccount,UserSettingResetPassword,UserSettingUpdatePermission,UserDocumentGridView,UserDocumentListView,UserDocumentListCreate,UserDocumentListUpdate,UserDocumentListDelete,UserManageCategoryView,UserManageCategoryCreate,UserManageCategoryUpdate,UserManageCategoryDelete,AdminSettingView,AdminSettingUpdate,MiniSiteView,MiniSiteCreate,MiniSiteUpdate,MiniSiteDelete', 'Admin,PWA,Both', 'CustomerWithSchedule,ShowMoney,ShowTime', NULL, NULL, NULL, 'Show', NULL, NULL, 'profile-1666818776.png', NULL, NULL, '2022-09-27 12:49:59', '2023-04-06 15:27:42'),
(12, 'Mark J. Zweidorff', 'mjz@eventmedical.dk', '$2y$10$jgaSXTKZOjOsmoJRug2jFuK7ZL9Z0upYPIIzlBtya2PhqK5TvuxKO', '(+45) 41 61 80 80', NULL, NULL, NULL, NULL, '1985-05-09', 'User', '3,11,17', '6,7,11,12', 'Active', NULL, 'CFO & Partner', NULL, 'Vamdrupvej', '1 B', '2 th', '2610', 'Rødovre', 'Danmark', 'All,ViewAuthProfile,UpdateAuthProfile,UserUpdatePassword,AuthStamDataView,AuthStamDataCreate,AuthStamDataUpdate,AuthStamDataDelete,AuthEquipmentView,AuthEquipmentCreate,AuthEquipmentUpdate,AuthDocumentDelete,AuthDocumentView,AuthDocumentCreate,AuthDocumentUpdate,AuthDocumentDelete,AuthNoteView,AuthNoteCreate,AuthNoteUpdate,AuthNoteDelete,AuthSettingView,AuthSettingUpdateStatus,AuthSettingUpdatePermission,AuthSettingDeleteAccount,UserView,UserCreate,UserUpdate,UserDelete,UserGroupView,UserGroupCreate,UserGroupUpdate,UserGroupDelete,ViewUserProfile,UpdateUserProfile,UserStamDataView,UserStamDataCreate,UserStamDataUpdate,UserStamDataDelete,UserEquipmentView,UserEquipmentCreate,UserEquipmentUpdate,UserEquipmentDelete,UserDocumentView,UserDocumentCreate,UserDocumentUpdate,UserDocumentDelete,UserNoteView,UserNoteCreate,UserNoteUpdate,UserNoteDelete,UserSettingView,UserSettingUpdateStatus,UserSettingDeleteAccount,UserSettingResetPassword,UserSettingUpdatePermission,UserDocumentGridView,UserDocumentListView,UserDocumentListCreate,UserDocumentListUpdate,UserDocumentListDelete,UserManageCategoryView,UserManageCategoryCreate,UserManageCategoryUpdate,UserManageCategoryDelete,AdminSettingView,AdminSettingUpdate,MiniSiteView,MiniSiteCreate,MiniSiteUpdate,MiniSiteDelete', 'Admin,PWA,Both', 'AcceptedSchedule,PendingSchedule,DeclinedSchedule,NotPublishedSchedule,PublishedSchedule,CustomerWithSchedule,ShowTime', '2021-01-01', NULL, 'Deltidsansat', 'Show', '090585-1527', NULL, 'profile-1666386798.png', NULL, 'iJkqwOIfubRNeeqIxpOiuNY83UnhKwgI8jqOQxDkfyIxPevfqFTbqYMCkCdq', '2022-10-08 05:46:51', '2023-04-09 16:47:10'),
(16, 'Arham khan', 'arham@info.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '+1 (182) 834-2104', NULL, 'Test note', '00000000000', NULL, '2022-10-18', 'User', '2', '6', 'Active', 12, 'Test', 'No', 'Vamdrupvej', '120', '2 th', '2610', 'Rødovre', 'Danmark', 'All,ViewAuthProfile,UpdateAuthProfile,UserUpdatePassword,AuthStamDataView,AuthStamDataCreate,AuthStamDataUpdate,AuthStamDataDelete,AuthEquipmentView,AuthEquipmentCreate,AuthEquipmentUpdate,AuthDocumentDelete,AuthDocumentView,AuthDocumentCreate,AuthDocumentUpdate,AuthDocumentDelete,AuthNoteView,AuthNoteCreate,AuthNoteUpdate,AuthNoteDelete,AuthSettingView,AuthSettingUpdateStatus,AuthSettingUpdatePermission,AuthSettingDeleteAccount,UserView,UserCreate,UserUpdate,UserDelete,UserGroupView,UserGroupCreate,UserGroupUpdate,UserGroupDelete,ViewUserProfile,UpdateUserProfile,UserStamDataView,UserStamDataCreate,UserStamDataUpdate,UserStamDataDelete,UserEquipmentView,UserEquipmentCreate,UserEquipmentUpdate,UserEquipmentDelete,UserDocumentView,UserDocumentCreate,UserDocumentUpdate,UserDocumentDelete,UserNoteView,UserNoteCreate,UserNoteUpdate,UserNoteDelete,UserSettingView,UserSettingUpdateStatus,UserSettingDeleteAccount,UserSettingResetPassword,UserSettingUpdatePermission,UserDocumentGridView,UserDocumentListView,UserDocumentListCreate,UserDocumentListUpdate,UserDocumentListDelete,UserManageCategoryView,UserManageCategoryCreate,UserManageCategoryUpdate,UserManageCategoryDelete,AdminSettingView,AdminSettingUpdate,MiniSiteView,MiniSiteCreate,MiniSiteUpdate,MiniSiteDelete', 'PWA', NULL, '2022-08-01', '2022-10-31', NULL, 'Show', NULL, NULL, 'profile-1673285946.png', NULL, NULL, '2022-10-16 18:40:29', '2023-04-02 01:52:09'),
(19, 'Kenneth Studsgaard Damholdt', 'kenneth@damholdt.dk', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 22 42 27 88', NULL, NULL, NULL, NULL, '1984-01-29', 'User', '13', '8,9,12', 'Active', NULL, 'Paramediciner', NULL, 'Nørhedevej', '3', NULL, '7500', 'Holstebro', 'Danmark', 'ViewAuthProfile,UserUpdatePassword,UserDocumentGridView', NULL, NULL, '2021-04-16', NULL, 'Deltidsansættelse', 'Show', '290184-1155', NULL, 'profile-1672328164.png', NULL, '1zEp3NmN1ZyNJbWyOE9clZYc9CZxIXA0YFo3MgcSuX9Teo9M8mVBxGSr9qPZ', '2022-12-14 11:03:41', '2023-01-02 18:26:24'),
(20, 'Mikkel A. Larsen', 'mal@eventmedical.dk', '$2y$10$lKDq7OYqQn/R45edR0tXBew4lNKFy6orW.4pe/ctZYetHPc1N2sW2', '(+45) 20 31 52 71', NULL, 'Præhospitalet, Region Sjælland', NULL, NULL, '1985-06-12', 'User', '13,16,17', '6,7,12', 'Active', NULL, 'CEO & Partner', NULL, 'Gartnervej', '8', NULL, '4600', 'Køge', 'Danmark', 'All,ViewAuthProfile,UpdateAuthProfile,UserUpdatePassword,AuthStamDataView,AuthStamDataCreate,AuthStamDataUpdate,AuthStamDataDelete,AuthEquipmentView,AuthEquipmentCreate,AuthEquipmentUpdate,AuthDocumentDelete,AuthDocumentView,AuthDocumentCreate,AuthDocumentUpdate,AuthDocumentDelete,AuthNoteView,AuthNoteCreate,AuthNoteUpdate,AuthNoteDelete,AuthSettingView,AuthSettingUpdateStatus,AuthSettingUpdatePermission,AuthSettingDeleteAccount,UserView,UserCreate,UserUpdate,UserDelete,UserGroupView,UserGroupCreate,UserGroupUpdate,UserGroupDelete,ViewUserProfile,UpdateUserProfile,UserStamDataView,UserStamDataCreate,UserStamDataUpdate,UserStamDataDelete,UserEquipmentView,UserEquipmentCreate,UserEquipmentUpdate,UserEquipmentDelete,UserDocumentView,UserDocumentCreate,UserDocumentUpdate,UserDocumentDelete,UserNoteView,UserNoteCreate,UserNoteUpdate,UserNoteDelete,UserSettingView,UserSettingUpdateStatus,UserSettingDeleteAccount,UserSettingResetPassword,UserSettingUpdatePermission,UserDocumentGridView,UserDocumentListView,UserDocumentListCreate,UserDocumentListUpdate,UserDocumentListDelete,UserManageCategoryView,UserManageCategoryCreate,UserManageCategoryUpdate,UserManageCategoryDelete,AdminSettingView,AdminSettingUpdate,MiniSiteView,MiniSiteCreate,MiniSiteUpdate,MiniSiteDelete', 'Admin,PWA,Both', NULL, '2021-03-12', NULL, 'Deltidsansat', 'Show', '120685-1917', NULL, 'profile-1671189425.png', NULL, '4oq6e3QZC8m7ieleHdqQs7wEbuAFXWc67hmGaCIlRIsxKExD2oir7ejHbCIm', '2022-12-16 11:12:00', '2023-03-23 15:26:36'),
(21, 'Test af kunder', 'jeje@yrdy.dk', '$2y$10$3VSxQR8A2HR9MxMFIcFxxOM4PzMP7IdJ7SinrhUvlgnt/ckq7xIR.', '11111111', NULL, 'ladlskjflakjsfdlja aæsldkfjaæslkdjfa sædlkfjaæsldkjfælakjdf', '2222222', NULL, '2022-12-12', 'Customer', '2', '', 'Active', NULL, 'titel', NULL, 'Vamdrupvej', '40', NULL, '2610', 'Rødovre', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'Show', NULL, NULL, 'profile-1671729361.png', NULL, NULL, '2022-12-22 10:57:54', '2022-12-22 17:16:01'),
(22, 'Aaron Prakash*', 'Aaron.t.prakash@gmail.com', '$2y$10$kakmw/RcmlA2zHDLpag.veX.b72M5A7zxLEZMk2XcIk1lrv10pE2K', '(+45)  20 87 14 48', NULL, NULL, NULL, NULL, '0001-01-01', 'User', '1,15,17', '6,7', 'Active', NULL, 'ST-redder', NULL, 'Højdevej', '6', NULL, '2680', 'Solrød strand', 'Denmark', NULL, NULL, NULL, '2022-01-01', NULL, 'Underleverandør', 'Show', NULL, NULL, 'profile-1672160792.png', NULL, NULL, '2022-12-26 15:57:24', '2022-12-31 13:25:56'),
(23, 'Casper Behrendt*', 'kontakt@hlrhjaelp.dk', '$2y$10$YyJA07BIx9wrI3yWB6Ppe.rCgcbax0kCPZrqdXwk2Aa688nZ3bEua', '(+45) 81 71 31 21', NULL, NULL, NULL, NULL, '1985-05-15', 'User', '11,17', '6,7', 'Active', NULL, 'Ambulancebehandler', NULL, 'Brønderslev Alle', '70 B', NULL, '2770', 'Kastrup', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'Show', NULL, '<p>HLR-Hj&aelig;lp v/Casper Behrendt&nbsp;<br />\r\nBr&oslash;nderslev Alle 70 B<br />\r\n2770 Kastrup</p>\r\n\r\n<p>CVR-nr. DK34385300<br />\r\nTlf. 81713121</p>\r\n\r\n<p>Web: www.voksendisco.dk<br />\r\nmail: kontakt@hlrhjaelp.dk</p>\r\n\r\n<p>Autorisationsid: 0DLN5</p>', 'profile-1672087820.png', NULL, NULL, '2022-12-26 20:47:06', '2023-02-17 18:36:53'),
(24, 'Mikkel Løschenkohl Hansen', 'mikkel.lh@gmail.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 51 64 30 58', NULL, NULL, NULL, NULL, '1983-08-07', 'User', '11', '6,7', 'Active', NULL, 'Ambulancebehandler', NULL, 'Skovgårdsvej', '29 a', NULL, '3200', 'Helsinge', 'Danmark', NULL, NULL, NULL, '2022-08-24', NULL, 'Underleverandør', 'Show', '070883-2103', '<p>autorid: 0FBHC</p>\r\n\r\n<p>faktura. 250kr x moms</p>', 'profile-1672088876.png', NULL, NULL, '2022-12-26 20:56:34', '2022-12-30 06:53:31'),
(25, 'Casper Turf Okkels', 'caok@noh.regionh.dk', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 22 42 44 36', NULL, NULL, NULL, NULL, '1974-08-12', 'User', '14', '6,7', 'Active', NULL, 'Kursus koordinator', NULL, 'Tolvkarlevej', '59', NULL, '3400', 'Hillerød', 'Danmark', NULL, NULL, NULL, '2022-01-01', NULL, 'Deltidsansat', 'Show', '120874-2961', NULL, 'profile-1672089298.png', NULL, NULL, '2022-12-26 21:11:39', '2022-12-30 06:46:26'),
(26, 'Cecilie Friis Ahrendt', 'cecilie-ahrendt@hotmail.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 21 76 68 01', NULL, NULL, NULL, NULL, '1993-12-19', 'User', '3', '6', 'Active', NULL, 'Sygeplejerske', NULL, 'Højenhald', '2', '3.tv', '2700', 'Brønshøj', 'Danmark', NULL, NULL, NULL, '2021-07-07', NULL, 'Deltidsansættelse', 'Show', '191293-1192', NULL, 'profile-1672090045.png', NULL, NULL, '2022-12-26 21:20:09', '2022-12-30 06:46:41'),
(27, 'Charlotte Horst Willerslev Hansen', 'willerslev01@gmail.com', '$2y$10$q7LGyZmaJMJrm9Aqx0arL.fj9U071eoQh3lruUxs8fTBglVg/Ofpy', '(+45) 20 65 12 99', NULL, NULL, NULL, NULL, '1983-03-13', 'User', '3', '6', 'Active', NULL, 'Sygeplejerske', NULL, 'Persiensvej', '2', '2th', '2300', 'København S', 'Danmark', NULL, NULL, NULL, '2022-08-26', NULL, 'Deltidsansættelse', 'Show', '160383-1744', NULL, 'profile-1672139632.png', NULL, NULL, '2022-12-26 21:29:41', '2022-12-30 17:07:28'),
(28, 'Dean Stensdal', 'stensdal100@hotmail.com', '$2y$10$yZZHyet3AJCLiQ3Z/rikceXAAAyhBf7lu/0y6cpHwqL0cSm0.RV6G', '(+45) 26 83 13 57', NULL, NULL, NULL, NULL, '1973-01-07', 'User', '13', '6', 'Active', NULL, 'Paramediciner', NULL, 'Krydderivej', '8', '2', '2610', 'Rødovre', 'Danmark', NULL, NULL, NULL, '2021-05-23', NULL, 'Deltidsansættelse', 'Show', '070173-2839', NULL, 'profile-1672139692.png', NULL, NULL, '2022-12-26 21:35:03', '2022-12-30 06:47:34'),
(29, 'Erik Baldrup Ahn', 'baldur@baldurs.dk', '$2y$10$T4NiydETpVdtBvxqPdKSpenO2UxN..3Y5.bWKYJ0hoTJUrgRh4QTS', '(+45) 22 44 05 49', NULL, NULL, NULL, NULL, '1973-05-14', 'User', '11', '6,7', 'Active', NULL, 'Ambulancebehandler', NULL, 'Uglevænget', '12', NULL, '4623', 'Lille Skensved', 'Danmark', NULL, NULL, NULL, '2022-01-10', NULL, 'Deltidsansættelse', 'Show', '140573-2579', NULL, 'profile-1672090962.png', NULL, NULL, '2022-12-26 21:39:14', '2022-12-30 06:47:49'),
(30, 'Fatih Sweetheart Kasap', 'fskasap@gmail.com', '$2y$10$oeg8PZbnkfFHGvEo4ML6QOFf9fw3fhGgB9Ab4hmXQXmb/gKYHBle2', '(+45) 21 68 01 94', NULL, NULL, NULL, NULL, '1975-05-23', 'User', '3,15', '6,7', 'Active', NULL, 'Sygeplejerske', NULL, 'Stationsvej', '59', NULL, '4241', 'Vemmelev', 'Danmark', NULL, NULL, NULL, '2022-05-07', NULL, 'Deltidsansættelse', 'Show', '230575-3605', NULL, 'profile-1672091231.png', NULL, NULL, '2022-12-26 21:44:40', '2022-12-30 06:48:04'),
(31, 'Frederik Pihl Egebjerg', 'Frede1423@gmail.com', '$2y$10$pn1f5.cXNeoUJsL5RrDTEO2yIS8wFfVWkE6ca7G6LdkJzIn6a0BTS', '(+45) 40 87 40 04', NULL, 'Akutberedskabet, Region Hovedstaden', NULL, NULL, '1989-05-19', 'User', '1,15,19', '6,7', 'Active', NULL, 'ST-redder', NULL, 'Hvidovrevej', '292', 'st.tv.', '2650', 'Hvidovre', 'Danmark', NULL, NULL, NULL, '2022-08-15', NULL, 'Deltidsansættelse', 'Show', '190589-1401', NULL, 'profile-1672091581.png', NULL, NULL, '2022-12-26 21:49:13', '2022-12-31 13:24:10'),
(32, 'Henriette Knoth', 'henrietteknoth@yahoo.dk', '$2y$10$99yqV8F3FR3gHfq7QiuN/uzUF8aGby0NrfnbG5bF2RDj5N2bk3xqG', '(+45) 22 27 20 58', NULL, NULL, NULL, NULL, '1981-10-17', 'User', '14', '6,7', 'Active', NULL, 'Sygeplejerske', NULL, 'Bymuren', '56', 'st.th', '2650', 'Hvidovre', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '171081-1632', NULL, 'profile-1672138134.png', NULL, NULL, '2022-12-27 10:44:21', '2022-12-30 06:48:41'),
(33, 'Jakob Seelhorst Rydahl Rasmussen', 'ryggerydahl@gmail.com', '$2y$10$2JBRyp061TKQAUZQ/k1l2.DIyMxXoMRtBpIF8oQ6.VbuxjS7y6U3i', '(+45) 41 67 81 98', NULL, NULL, NULL, NULL, '1978-09-29', 'User', '14', '6,7', 'Active', NULL, 'Anæstesisygeplejerske', NULL, 'Fiskene', '35', NULL, '3650', 'Ølstykke', 'Danmark', NULL, NULL, NULL, '2021-08-18', NULL, 'Deltidsansættelse', 'Show', '290978-1771', NULL, 'profile-1672140040.png', NULL, NULL, '2022-12-27 11:17:38', '2022-12-30 06:49:13'),
(34, 'Jeppe Dohn', 'kronos.dohn@gmail.com', '$2y$10$1.aDgMf1OkbPoUPXOheYv.sPi9m7lRLWjcv1wo.rCX.ulaKeSh51C', '(+45) 25 66 99 02', NULL, NULL, NULL, NULL, '1985-05-29', 'User', '11', '6,7', 'Active', NULL, 'Ambulancebehandler', NULL, 'Gyvelvej', '27', '1 tv', '4000', 'Roskilde', 'Danmark', NULL, NULL, NULL, '2021-08-01', NULL, 'Deltidsansættelse', 'Show', '290585-2267', NULL, 'profile-1672142802.png', NULL, NULL, '2022-12-27 11:27:33', '2022-12-30 06:49:29'),
(35, 'Lasse Salomonsson', 'lassesalomonsen@gmail.com', '$2y$10$hme.f.WIqzCI67f3whszWON5cqF6OTALrgz5V4/f9NqGrokFOv20y', '(+45) 42 83 42 84', NULL, 'Falck Assistance CPH', NULL, NULL, '1983-11-09', 'User', '15', '6,7', 'Active', NULL, 'ST-redder', NULL, 'Gurrevej', '38', 'st.th', '2650', 'Hvidovre', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '091183-2313', '<p>Uniformsst&oslash;rrelse:<br />\r\nOvert&oslash;j Large, bukser 56/98</p>', 'profile-1672143671.png', NULL, NULL, '2022-12-27 12:16:10', '2022-12-30 06:50:18'),
(36, 'Louise Madsen', 'louii_1991@hotmail.com', '$2y$10$68Y56Uq.rHqH9SaYt7r.w.GBfoa2ASIA.OJjwVbCyne5.2hlJzrgC', '(+45) 22 82 25 12', NULL, NULL, NULL, NULL, '1991-10-07', 'User', '15', '6,7', 'Active', NULL, 'ST-redder', NULL, 'Højbjergvej', '55', '2 th', '2730', 'Herlev', 'Danmark', NULL, NULL, NULL, '2022-06-22', NULL, 'Deltidsansættelse', 'Show', '071091-2726', NULL, 'profile-1672144148.png', NULL, NULL, '2022-12-27 12:24:29', '2022-12-30 06:51:21'),
(37, 'Marlene Skade', 'manskade@hotmail.com', '$2y$10$79n1PE4AmcTeNskuaDvFUey2U3Pn8qhPhnRbwcZfQ/mahdbp/5DG6', '(+45) 31 15 26 50', NULL, NULL, NULL, NULL, '1982-11-03', 'User', '11', '6,7', 'Active', NULL, 'Ambulancebehandler', NULL, 'Egevolden', '178', NULL, '2650', 'Hvidovre', 'Danmark', NULL, NULL, NULL, '2022-06-22', NULL, 'Deltidsansættelse', 'Show', '031182-1598', NULL, 'profile-1672144614.png', NULL, NULL, '2022-12-27 12:34:11', '2022-12-30 06:51:44'),
(38, 'Martin Madsen', 'martinmdsn@gmail.com', '$2y$10$z/nFFvxt1GlDjQUGd60d3.lJn5WirKLY7e7skZOUaaqoFKLNkC3JO', '(+45) 26 92 82 58', NULL, NULL, NULL, NULL, '1982-07-29', 'User', '13', '6,7', 'Active', NULL, 'Paramediciner', NULL, 'Rugmarken', '1', NULL, '3540', 'Lynge', 'Danmark', NULL, NULL, NULL, '2021-12-02', NULL, 'Deltidsansættelse', 'Show', '290782-1229', NULL, 'profile-1672145222.png', NULL, NULL, '2022-12-27 12:44:42', '2022-12-30 06:51:01'),
(39, 'Martin Rasmussen', 'mr@vindelhus.dk', '$2y$10$K5CcNkQBYDbHveJNSOLzsufu0HWDcCEORL/P/SI6TVWJj7DN8jl8W', '(+45) 28 82 05 50', NULL, NULL, NULL, NULL, '1974-03-23', 'User', '14', '6,7,12', 'Active', NULL, 'Anæstesisygeplejerske', NULL, 'Hold-an vej', '73', NULL, '2750', 'Ballerup', 'Danmark', NULL, NULL, NULL, '2022-08-05', NULL, 'Deltidsansættelse', 'Show', '230374-2959', '<p>T&Oslash;J: M/L</p>\r\n\r\n<p><br />\r\nKOMPETENCER:&nbsp;<br />\r\n+ An&aelig;stesisygeplejerske<br />\r\n+ Behandlersygeplejerske (skadestue, Herlev)<br />\r\n+ Ambulancesygeplejerske (Malm&oslash;)</p>', 'profile-1672145619.png', NULL, NULL, '2022-12-27 12:50:44', '2023-01-02 18:34:43'),
(40, 'Matias Vested', 'mangler@email.dk', '$2y$10$20rFQu96E2eSqH.ja1n8COWRi0R.au2o.VaS3PVe17PAV.1jW22.W', '(+45) 24 46 49 55', NULL, NULL, NULL, NULL, '1981-05-11', 'User', '10', '6,7', 'Active', NULL, 'Anæstesilæge', NULL, 'Hummeltoftevej', '164', NULL, '2830', 'Virum', 'Danmark', NULL, NULL, NULL, '2021-09-01', NULL, 'Deltidsansættelse', 'Show', '110581-2961', NULL, '', NULL, NULL, '2022-12-27 13:02:41', '2022-12-30 06:52:28'),
(41, 'Mikkel Kruhøffer Hendriksen', 'mikkel.k.hendriksen@hotmail.com', '$2y$10$iBuc0CyTcdai9idR9CkzFu6Qjx/C0s0sPTX0JV59tHEz44HTl.xCG', '(+45) 40 13 59 81', NULL, NULL, NULL, NULL, '1990-06-25', 'User', '11', '6,7', 'Active', NULL, 'Ambulancebehandler', NULL, 'Slettebjergvej', '3', NULL, '2750', 'Ballerup', 'Danmark', NULL, NULL, NULL, '2021-04-27', NULL, 'Deltidsansættelse', 'Show', '250690-2021', NULL, 'profile-1672146809.png', NULL, NULL, '2022-12-27 13:11:14', '2022-12-30 06:52:48'),
(42, 'Morten Wedel Christensen', 'Redkost@hotmail.com', '$2y$10$R6e3T8R9CsvVciYFozShEeSduY01Ida4oh5feBuybLgK73i2s72OW', '(+45) 40 25 98 80', NULL, NULL, NULL, NULL, '1972-07-01', 'User', '11,17', '6,7', 'Active', NULL, 'Ambulancebehandler', NULL, 'Jens Andersens Vænge', '46', NULL, '2630', 'Taastrup', 'Danmark', NULL, NULL, NULL, '2022-08-04', NULL, 'Deltidsansættelse', 'Show', '010772-2505', '<p>KUNDER &amp; OPGAVER:<br />\r\n******************<br />\r\nAmbulance transport og k&oslash;rsler.<br />\r\nkontroller erfaring/uddannet.<br />\r\nhar haft mange medic vagter p&aring; koncerter og gymnasiefester osv.<br />\r\nFhj instrukt&oslash;r(g&aelig;ldende)</p>', 'profile-1672147384.png', NULL, NULL, '2022-12-27 13:21:56', '2022-12-30 06:53:58'),
(43, 'Murat Aydin', 'skkorpset@gmail.com', '$2y$10$S4k.e1wJUWDIIPMhuDT4.uKetfMOmQdbuE728f84sSxsZKlyU6o5y', '(+45) 52 11 21 14', NULL, NULL, NULL, NULL, '1982-12-07', 'User', '12', '6,7', 'Active', NULL, 'Ambulanceassistent', NULL, 'Knudsvej', '4', '1 tv', '4000', 'Roskilde', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'Show', NULL, NULL, 'profile-1672147738.png', NULL, NULL, '2022-12-27 13:27:42', '2022-12-30 06:54:22'),
(44, 'Ole Randerup', 'Ole.r@live.dk', '$2y$10$zjS6nqw7C5BNQdABMGCipOorowptJb9jyJ9xVbrlnVD8KHVdFBXDm', '(+45) 20 20 80 44', NULL, NULL, NULL, NULL, '1971-08-07', 'User', '1', '6,7', 'Active', NULL, 'Nødbehandler', NULL, 'Parkvej', '2', '1 tv', '4760', 'Vordingborg', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'Show', NULL, '<p>Aftalt timepris p&aring;. faktura 200,-</p>', 'profile-1672148159.png', NULL, NULL, '2022-12-27 13:34:15', '2022-12-30 06:54:41'),
(45, 'Pernille Hacke-Jershøj', 'pernille_hj@live.dk', '$2y$10$lZNpqrKBy10d1tHLD73J..0TmcdJvPIolwsh1c0DcLVuGd0Y77BGq', '(+45) 41 26 41 71', NULL, NULL, NULL, NULL, '1998-07-15', 'User', '3', '6,7', 'Active', NULL, 'Sygeplejerske', NULL, 'Nørre Boulevard', '136', 'st.', '4600', 'Køge', 'Danmark', NULL, NULL, NULL, '2021-06-14', NULL, 'Deltidsansættelse', 'Show', '150798-1808', NULL, 'profile-1672148463.png', NULL, NULL, '2022-12-27 13:38:07', '2022-12-30 06:55:01'),
(46, 'Rikke Renée Kolding Ersgaard *', 'rikke.ersgaard@yahoo.dk', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 31 75 01 87', NULL, NULL, NULL, NULL, '1980-10-09', 'User', '10', '6,7', 'Active', NULL, 'Anæstesilæge', NULL, 'Næblerødvej', '8', NULL, '4250', 'Fuglebjerg', 'Danmark', NULL, NULL, NULL, '2021-11-06', NULL, 'Samarbejdspartner', 'Show', '091080-1120', '<p><small><tt>SAMARBEJDSPARTNER</tt></small></p>\r\n\r\n<p>Ersgaard Medical Services<br />\r\nCVR-nr. 43349899</p>\r\n\r\n<p>Peder Ersgaard 300 kr p&aring; fakura.<br />\r\nRikke Ersgaard 1000 kr p&aring; fakura.</p>', 'profile-1672149001.png', NULL, NULL, '2022-12-27 13:45:57', '2023-04-12 07:01:36'),
(47, 'Simon Tinggaard Helmerik', 'Shelmerik@gmail.com', '$2y$10$4Ip/XHgzNetDwL6xw9I2/ObYkLCaP1U5FS4CwNnfScnRbBuKUUkLK', '(+45) 31 23 51 31', NULL, NULL, NULL, NULL, '1979-04-19', 'User', '13,17', '6,7', 'Active', NULL, 'Paramediciner', NULL, 'Knudsgade', '42', NULL, '4100', 'Ringsted', 'Danmark', NULL, NULL, NULL, '2022-08-04', NULL, 'Deltidsansættelse', 'Show', '190479-2159', NULL, 'profile-1672240626.png', NULL, NULL, '2022-12-27 13:54:31', '2022-12-30 06:55:52'),
(48, 'Stinne Joy Herløv Klæbel', 'stinneklaebel@gmail.com', '$2y$10$z23aKBhjR6Ie.WUpYhm20./TMhd3w4Wo8JotF6jCxSIzIjs3ygRyS', '21 64 32 70', NULL, NULL, NULL, NULL, '1988-06-17', 'User', '14', '6,7', 'Active', NULL, 'Anæstesisygeplejerske', NULL, 'Yrsavej', '5', 'st.th', '2000', 'Frederiksberg', 'Danmark', NULL, NULL, NULL, '2022-05-01', NULL, 'Deltidsansættelse', 'Show', '170688-2444', NULL, 'profile-1672153304.png', NULL, NULL, '2022-12-27 14:56:27', '2022-12-28 14:12:07'),
(49, 'Søren Steemann Rudolph', 'rudolph@dadlnet.dk', '$2y$10$HdInQsyUsnmSdSm/MVJ94uytSPQJQOjYTUN2I9vgvqxB3CCA9j3vu', '26 83 40 28', NULL, NULL, NULL, NULL, '1974-04-25', 'User', '10', '6,7', 'Active', NULL, 'Anæstesilæge', NULL, 'Azaleavej', '38', NULL, '2000', 'Frederiksberg', 'Danmark', NULL, NULL, NULL, '2021-10-15', NULL, 'Deltidsansættelse', 'Show', '250474-2361', NULL, 'profile-1672158832.png', NULL, NULL, '2022-12-27 15:57:23', '2022-12-28 14:11:36'),
(50, 'Thomas Bøllingtoft Knudsen', 'thomas@live8.dk', '$2y$10$Xw5O3/WEfpthg4MU/rTQ.uLJ6QGqe7lLMK2aFqlHutT9nuawGZWCe', '26 14 96 99', NULL, NULL, NULL, NULL, '1979-06-27', 'User', '10', '6,7', 'Active', NULL, 'Korpslæge', NULL, 'Storstræde', '49', NULL, '2620', 'Albertslund', 'Danmark', NULL, NULL, NULL, '2021-01-01', NULL, 'Konsulent', 'Show', NULL, NULL, 'profile-1672240483.png', NULL, NULL, '2022-12-27 16:12:08', '2022-12-28 15:14:43'),
(51, 'Trine Henriette Jensen', 'Trinehenriettejensen@gmail.com', '$2y$10$rSbw5/zBMS1Oz4YYjHA7euXolBxxjhXEsX4H8u/62LIqiZB7ZNO7i', '30 62 97 48', NULL, 'Falck Næstved', NULL, NULL, '1975-04-02', 'User', '15', '6,7', 'Active', NULL, 'ST-redder', NULL, 'Morbærvej', '1B', NULL, '4295', 'Stenlille', 'Danmark', NULL, NULL, NULL, '2022-06-19', NULL, 'Deltidsansættelse', 'Show', '020475-1102', NULL, 'profile-1672159003.png', NULL, NULL, '2022-12-27 16:32:38', '2022-12-28 14:12:49'),
(52, 'Uffe Holm Ballegaard', 'uffehb@gmail.com', '$2y$10$N9nXXtz0Xaof7SfZOrwUruVcpmxbC6DgceYu0sAlLMbfpKPOWm2S6', '27 81 20 47', NULL, NULL, NULL, NULL, '1992-09-15', 'User', '11', '6,7', 'Active', NULL, 'Ambulancebehandler', NULL, 'Elmegade', '20', '3 tv', '2200', 'København N', 'Danmark', NULL, NULL, NULL, '2022-05-27', NULL, 'Deltidsansættelse', 'Show', '150992-2299', NULL, 'profile-1672160061.png', NULL, NULL, '2022-12-27 16:52:33', '2022-12-28 14:14:51'),
(53, 'Ulrich Skovgaard Opstrup', 'ulrich@opstrup.org', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '29 27 15 05', NULL, NULL, NULL, NULL, '1981-01-29', 'User', '11', '6,7', 'Active', NULL, 'Ambulancebehandler', NULL, 'Rosengården', '42', NULL, '4990', 'Sakskøbing', 'Danmark', NULL, NULL, NULL, '2022-08-24', NULL, 'Deltidsansættelse', 'Show', '291081-2001', NULL, 'profile-1672160423.png', NULL, NULL, '2022-12-27 16:57:35', '2022-12-28 14:15:12'),
(56, 'Bo Simonsen', 'simonsen.bo@hotmail.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 40 41 84 64', NULL, NULL, NULL, NULL, '1978-11-28', 'User', '13', '9,12', 'Active', NULL, 'Paramediciner', NULL, 'Tjærbyvej', '122', NULL, '8930', 'Randers NØ', 'Danmark', NULL, NULL, NULL, '2021-04-21', NULL, 'Deltidsansættelse', 'Show', '281178-1757', NULL, 'profile-1672237325.png', NULL, NULL, '2022-12-28 14:20:26', '2023-01-02 18:18:39'),
(57, 'Claus Vigh Jørgensen', 'Gubifar@hotmail.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 22 90 52 55', NULL, NULL, NULL, NULL, '1975-05-24', 'User', '13', '9,12', 'Active', NULL, 'Paramediciner', NULL, 'Tendrup Møllevej', '32', NULL, '8543', 'Hornslet', 'Danmark', NULL, NULL, NULL, '2021-04-22', NULL, 'Deltidsansættelse', 'Show', '240575-2177', NULL, 'profile-1672240909.png', NULL, NULL, '2022-12-28 15:20:33', '2023-01-02 18:18:15'),
(58, 'Henrik Györkös', 'henrikgyorkos@hotmail.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 29 47 47 29', NULL, NULL, NULL, NULL, '1975-08-15', 'User', '13', '9,12', 'Active', NULL, 'Paramediciner', NULL, 'Troldtjørnevej', '10', NULL, '8870', 'Langå', 'Danmark', NULL, NULL, NULL, '2021-04-22', NULL, 'Deltidsansættelse', 'Show', '150875-1555', NULL, 'profile-1672241203.png', NULL, NULL, '2022-12-28 15:25:06', '2023-01-02 18:19:54'),
(59, 'Jonas Kragh Jespersen', 'jonaskjespersen@gmail.com', '$2y$10$TkiBxhcDuy.9eICrjzZ8ee2gLwadEa5qm8z8AfKl6V54j3WE2blR2', '(+45) 23 49 75 82', NULL, NULL, NULL, NULL, '1992-01-19', 'User', '11', '8', 'Active', NULL, 'Ambulancebehandler', NULL, 'Klaveret', '8', NULL, '5500', 'Middelfart', 'Danmark', NULL, NULL, NULL, '2022-07-31', NULL, 'Deltidsansættelse', 'Show', '190192-1489', NULL, 'profile-1672241556.png', NULL, NULL, '2022-12-28 15:30:48', '2022-12-30 06:49:45'),
(60, 'Lis Estrup Villumsen', 'Lis_wil74@hotmail.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 23 64 13 37', NULL, NULL, NULL, NULL, '1974-04-27', 'User', '13', '9,12', 'Active', NULL, 'Paramediciner', NULL, 'Tendrup Møllevej', '30', NULL, '8543', 'Hornslet', 'Danmark', NULL, NULL, NULL, '2021-04-23', NULL, 'Deltidsansættelse', 'Show', '270474-2706', NULL, 'profile-1672328534.png', NULL, NULL, '2022-12-29 15:41:10', '2023-01-02 18:33:08'),
(61, 'Martin Bøger', 'martin4805@gmail.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 28 11 96 83', NULL, NULL, NULL, NULL, '1975-03-18', 'User', '13', '9,12', 'Active', NULL, 'Paramediciner', NULL, 'Tronkærgårdsvej', '344', NULL, '8541', 'Skødstrup', 'Danmark', NULL, NULL, NULL, '2021-02-14', NULL, 'Deltidsansættelse', 'Show', '180375-2415', NULL, 'profile-1672382489.png', NULL, NULL, '2022-12-30 06:39:39', '2023-01-02 18:34:12'),
(62, 'Mie Brodersen', 'brodersenmie@gmail.com', '$2y$10$r7LM88m8JPCROkUDMPiXfub8uxLGQVCNyw7SAj/SuSDy33FdZa0U2', '(+45) 28 49 71 68', NULL, NULL, NULL, NULL, '1987-12-14', 'User', '11', '8,9', 'Active', NULL, 'Ambulancebehandler', NULL, 'Middelfartvej', '6', NULL, '6000', 'Kolding', 'Danmark', NULL, NULL, NULL, '2022-05-07', NULL, 'Deltidsansættelse', 'Show', '141287-1460', '<p>Buksestrl: 85/76</p>', 'profile-1672390682.png', NULL, NULL, '2022-12-30 08:56:28', '2022-12-30 09:01:44'),
(63, 'Morten Wiese Jacobsen', 'mortenlynben@hotmail.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 29 91 07 01', NULL, NULL, NULL, NULL, '1974-05-26', 'User', '13', '9,12', 'Active', NULL, 'Paramediciner', NULL, 'Kildevældet', '15', NULL, '8930', 'Randers NØ', 'Danmark', NULL, NULL, NULL, '2021-04-16', NULL, 'Deltidsansættelse', 'Show', '260574-1277', NULL, 'profile-1672391241.png', NULL, NULL, '2022-12-30 09:04:54', '2023-01-02 18:36:53'),
(64, 'Natasja Katrine Abildgaard Mathiesen', 'natasja.olofsson@gmail.com', '$2y$10$qiREDJT.DSgOveYK.S6ocehZ2/GGzC3at4kRxykv/EZpx2gzpnLGi', '(+45) 60 19 91 40', NULL, NULL, NULL, NULL, '1988-08-05', 'User', '3', '9', 'Active', NULL, 'Sygeplejerske', NULL, 'ingridsvej', '26a', NULL, '7400', 'Herning', 'Danmark', NULL, NULL, NULL, '2022-08-24', NULL, 'Deltidsansættelse', 'Show', '050888-3196', NULL, 'profile-1672479768.png', NULL, NULL, '2022-12-31 09:39:11', '2022-12-31 09:46:15'),
(65, 'Per Heines Laursen', 'p.laursen@webspeed.dk', '$2y$10$oZTEe4O3q7UWPKcl.II0KeLume16cQMbmJFjdb/gLTUN7tqUtDEJS', '(+45) 20 95 54 23', NULL, NULL, NULL, NULL, '1972-04-21', 'User', '11', '9,12', 'Active', NULL, 'Ambulancebehandler', NULL, 'Poppelvej', '20', NULL, '8930', 'Randers NØ', 'Danmark', NULL, NULL, NULL, '2021-04-23', NULL, 'Deltidsansættelse', 'Show', '210472-3481', NULL, 'profile-1672481292.png', NULL, NULL, '2022-12-31 10:01:00', '2023-01-02 18:38:14'),
(66, 'Rasmus Raabjerg Krogh', 'raskrogh@gmail.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 29 45 42 41', NULL, NULL, NULL, NULL, '1979-03-24', 'User', '13', '8,9,12', 'Active', NULL, 'Paramediciner', NULL, 'Vistihøjen', '40', NULL, '8200', 'Aarhus N', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '240379-2597', '<p><strong>Arbejdsgiver:</strong> Ambulance Syd</p>', 'profile-1672481919.png', NULL, NULL, '2022-12-31 10:12:58', '2023-04-01 16:11:17'),
(67, 'Stefan Junker Asmussen', 'stefanasmussen@yahoo.dk', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 20 21 80 94', NULL, NULL, NULL, NULL, '2021-04-22', 'User', '13', '9,10,12', 'Active', NULL, 'Paramediciner', NULL, 'Vangen', '283', '3. tv', '9400', 'Nørresundby', 'Danmark', NULL, NULL, NULL, '2021-04-22', NULL, 'Deltidsansættelse', 'Show', '100282-1857', NULL, 'profile-1672482315.png', NULL, NULL, '2022-12-31 10:21:44', '2023-01-02 18:39:39'),
(68, 'Thomas Holm', 'thomhl@rm.dk', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 22 40 60 56', NULL, NULL, NULL, NULL, '1962-09-22', 'User', '13,17', '9,12', 'Active', NULL, 'Paramediciner', NULL, 'Modesvej', '24', NULL, '8981', 'Spentrup', 'Danmark', NULL, NULL, NULL, '2021-04-22', NULL, 'Deltidsansættelse', 'Show', '220962-2389', NULL, 'profile-1672482658.png', NULL, NULL, '2022-12-31 10:29:35', '2023-03-26 13:05:22'),
(69, 'Tom Svane Livoni', 'tomsvane@hotmail.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 25 38 99 80', NULL, NULL, NULL, NULL, '1976-06-23', 'User', '11', '9,12', 'Active', NULL, 'Ambulancebehandler', NULL, 'Wollesvej', '2', NULL, '8960', 'Randers SØ', 'Danmark', NULL, NULL, NULL, '2021-04-16', NULL, 'Deltidsansættelse', 'Show', '230676-2233', NULL, 'profile-1672483064.png', NULL, NULL, '2022-12-31 10:36:04', '2023-01-02 18:46:47'),
(70, 'Andreas Tousgård Jensen*', 'tousgaardandreas@gmail.com', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 20 45 24 51', NULL, NULL, NULL, NULL, '1983-05-27', 'User', '11', '8,9,10', 'Active', NULL, 'Ambulancebehandler', NULL, 'Tviskjær', '17', NULL, '7700', 'Thisted', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '270583-1907', '<p><strong>Arbejdsgiver:</strong> Ambulance Syd</p>\r\n\r\n<p>T&Oslash;J: XL</p>\r\n\r\n<p>FIRMA:<br />\r\nTousg&aring;rd Byg&nbsp;<br />\r\nCVR-nr. 42319023</p>\r\n\r\n<p>Timepris: 300,- ekskl. moms</p>', 'profile-1672484245.png', NULL, NULL, '2022-12-31 10:52:53', '2022-12-31 11:00:32'),
(71, 'Dennis Kron Pedersen', 'dennis@dennispedersen.dk', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 20 78 38 00', NULL, NULL, NULL, NULL, '1982-09-11', 'User', '13', '9,10,12', 'Active', NULL, 'Paramediciner', NULL, 'Færøgade', '45', '4. th.', '9000', 'Aalborg', 'Danmark', NULL, NULL, NULL, '2021-04-25', NULL, 'Deltidsansættelse', 'Show', '110982-1191', NULL, 'profile-1672484805.png', NULL, NULL, '2022-12-31 11:02:16', '2023-01-02 18:19:02'),
(72, 'Henriette Buhl Pedersen', 'henriette9550@hotmail.com', '$2y$10$Kd6kEgIVZokVReCxnf.XZOKEVBvaYo7EKaZWZh4gtv47kz6Q1tlHq', '(+45) 28 26 67 45', NULL, NULL, NULL, NULL, '1996-05-04', 'User', '11', '10', 'Active', NULL, 'Ambulancebehandler', NULL, 'Kettrupvej', '105', NULL, '9480', 'Løkken', 'Danmark', NULL, NULL, NULL, '2021-08-18', NULL, 'Deltidsansættelse', 'Show', '040596-0362', NULL, 'profile-1672485118.png', NULL, NULL, '2022-12-31 11:09:12', '2022-12-31 11:13:35'),
(73, 'Klavs Fruergaard', 'Fruergaard.k@gmail.com', '$2y$10$SBawtVXWK3sqa.MH9/Nqaeqtwg9/rGFDNdtjq1HmTSpoUoPMuVRJG', '(+45) 61 54 41 41', NULL, NULL, NULL, NULL, '1978-07-19', 'User', '11', '10', 'Active', NULL, 'Ambulancebehandler', NULL, 'Kirsten Holcks Vej', '17', NULL, '9460', 'Brovst', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '190778-1743', '<p>T&oslash;jstr. Bukser C 52 - L 90 ( mascot st&oslash;rrelser )<br />\r\nXl T-shirt /sweater.</p>', 'profile-1672486345.png', NULL, NULL, '2022-12-31 11:30:46', '2022-12-31 11:34:50'),
(74, 'Søren Niss Bjerregaard', 'snbjerregaard@hotmail.com', '$2y$10$gpyXh9bdllFP/43xFPEOVeLu2ClrxAWpa19XVH67qLbXtB5j8Hehq', '(+45) 23 71 09 29', NULL, NULL, NULL, NULL, '1992-08-18', 'User', '11', '10', 'Active', NULL, 'Ambulancebehandler', NULL, 'Svanholmsmindevej', '15', NULL, '9575', 'Kongerslev', 'Danmark', NULL, NULL, NULL, '2021-09-08', NULL, 'Deltidsansættelse', 'Show', '180892-2467', NULL, 'profile-1672487202.png', NULL, NULL, '2022-12-31 11:41:48', '2022-12-31 11:52:43'),
(75, 'Christina Krath Andersen', 'Chkan2108@gmail.com', '$2y$10$Nj5c2Qc1/lf4M3Ah/nhyuuIPgkA7yCTCmm6ZUTol8V.XjUR69yOCe', '(+45) 42 42 58 58', NULL, 'Ambulance Syd', NULL, NULL, '1981-08-21', 'User', '11', '8', 'Active', NULL, 'Ambulancebehandler', NULL, 'Ubberudgårdvej', '10', NULL, '5491', 'Blommenslyst', 'Danmark', NULL, NULL, NULL, '2022-08-24', NULL, 'Deltidsansættelse', 'Show', '210881-2268', '<p>Str. tyk&hellip; ej 42 nok (L/xl)</p>', 'profile-1672488342.png', NULL, NULL, '2022-12-31 11:54:56', '2022-12-31 12:09:07'),
(76, 'Ditte Thorn', 'Dittethorn@gmail.com', '$2y$10$rn0/4DlL.n/pU3r4R3nWIeWsnEtvJFc9b1c4QeF2LMnUT3TKgWYDa', '(+45) 51 74 04 43', NULL, NULL, NULL, NULL, '1985-11-02', 'User', '3', '8', 'Active', NULL, 'Sygeplejerske', NULL, 'Vardegårdvej', '27', NULL, '6800', 'Varde', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '021185-1252', '<p>T&oslash;j: M/L</p>', '', NULL, NULL, '2022-12-31 12:10:14', '2022-12-31 12:13:29'),
(77, 'Heidi Sif Willemoes Rasmussen', 'Heidi.will@live.dk', '$2y$10$xyu9AuhAGyH0g9Amtrmp/.JQMT3usCsm6Yigor9C7oSB9wtZqMZLC', '(+45) 27 29 67 69', NULL, 'Ambulance Syd', NULL, NULL, '1983-08-03', 'User', '11', '8', 'Active', NULL, 'Ambulancebehandler', NULL, 'Strandvejen', '26', '2. Sal', '5800', 'Nyborg', 'Danmark', NULL, NULL, NULL, '2022-08-16', NULL, 'Deltidsansættelse', 'Show', '030883-2252', '<p>T&oslash;j st&oslash;rrelse: L</p>', 'profile-1672489411.png', NULL, NULL, '2022-12-31 12:18:30', '2022-12-31 12:25:10'),
(78, 'Heidi Vangsgaard Sørensen', 'heidivangsgaard87@gmail.com', '$2y$10$tp6FvmapEZ1lX05fxPj12efuMF9K1JoZdrGfZSj5KveGX3S1Y6/A2', '(+45) 40 89 19 11', NULL, NULL, NULL, NULL, '1987-01-03', 'User', '3', '8', 'Active', NULL, 'Sygeplejerske', NULL, 'Kalovn', '18', NULL, '5600', 'Fåborg', 'Danmark', NULL, NULL, NULL, '2022-08-19', NULL, 'Deltidsansættelse', 'Show', '030187-1988', '<p>T&oslash;j-str. L</p>', '', NULL, NULL, '2022-12-31 12:26:10', '2022-12-31 12:29:02'),
(79, 'Jakob Tidemann', 'jakobtidemann@gmail.com', '$2y$10$/zHXHG95QsULYWKFpjBN0.pWYxDQSoCVwe.bHM7.2f330Xfylz69i', '(+45) 30 22 86 83', NULL, 'Ambulance Syd', NULL, NULL, '1981-11-26', 'User', '13', '8', 'Active', NULL, 'Paramediciner', NULL, 'Vardegårdvej', '29', NULL, '6800', 'Varde', 'Danmark', NULL, NULL, NULL, '2022-08-04', NULL, 'Deltidsansættelse', 'Show', '261181-2119', NULL, 'profile-1672490251.png', NULL, NULL, '2022-12-31 12:32:23', '2022-12-31 12:37:31'),
(80, 'Jannicke Faigh Danielsen', 'jannipigen18@hotmail.com', '$2y$10$bu5rxHwl85spQQ7o3orpw.Te0KR4HRnWnV6QvyBjdHVc24Zc2NNju', '(+45) 20 77 15 19', NULL, 'Ambulance Syd', NULL, NULL, '1987-03-03', 'User', '11', '8', 'Active', NULL, 'Ambulancebehandler', NULL, 'Søllingevej', '35', NULL, '5750', 'Ringe', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '030387-1446', '<p>T&Oslash;J: xl-xxl</p>', 'profile-1672490456.png', NULL, NULL, '2022-12-31 12:39:49', '2022-12-31 12:43:39'),
(81, 'Lea Beate Zoega', 'Lea_cadeau@hotmail.com', '$2y$10$E7NwjWiZlRKjbOAweOQ4burnt.IrqwL8krEZz0irk1w0dFQeo47RG', '(+45) 41 16 80 93', NULL, 'Ambulance Syd', NULL, NULL, '1994-11-29', 'User', '3,12', '8', 'Active', NULL, 'Sygeplejerske', NULL, 'Vestre kjersingvej', '73', NULL, '6715', 'Esbjerg N', 'Danmark', NULL, NULL, NULL, '2022-08-27', NULL, 'Deltidsansættelse', 'Show', '291194-2626', NULL, 'profile-1672490931.png', NULL, NULL, '2022-12-31 12:45:33', '2022-12-31 12:50:29'),
(82, 'Lennart Malling Nielsen', 'malling1995@gmail.com', '$2y$10$mYz8FYv0M.VI/2UeLkfOR.9tsO391SsAPTjhOPt1iMyFm/6/XNLHC', '(+45) 31 33 85 74', NULL, 'Præhospitalet, Region Midtjylland', NULL, NULL, '1995-02-01', 'User', '11', '8,9', 'Active', NULL, 'Ambulancebehandler', NULL, 'Oehlenschlægersgade', '28', '1 th.', '6400', 'Sønderborg', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '010295-0119', NULL, 'profile-1672491396.png', NULL, NULL, '2022-12-31 12:52:44', '2022-12-31 12:57:22'),
(83, 'Lotte Hedeager', 'lottehansen1975@gmail.com', '$2y$10$qNXhvuQusvejKMmUM7vhzOJdMN/pVXO2MGIEhOSlUKdD5lLS0.Ujm', '(+45) 22 76 58 78', NULL, 'Ambulance Syd', NULL, NULL, '1975-02-15', 'User', '13', '8', 'Active', NULL, 'Paramediciner', NULL, 'Klaus Berntsens Vej', '270', NULL, '5260', 'Odense S', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '150275-2320', NULL, 'profile-1672491683.png', NULL, NULL, '2022-12-31 13:00:35', '2022-12-31 13:03:10'),
(84, 'Louise Kjær Jensen', 'Lk-jensen@live.dk', '$2y$10$TiY/pOIOtFEnrSRYX2bXwe54NBgAdaoB2jNMc0E9slZKCAq9WaLTy', '(+45) 26 84 98 95', NULL, NULL, NULL, NULL, '1992-09-25', 'User', '3', '8', 'Active', NULL, 'Sygeplejerske', NULL, 'Bredstedgade', '2', '1 tv.', '5000', 'Odense C', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '250992-2090', NULL, 'profile-1672492034.png', NULL, NULL, '2022-12-31 13:06:07', '2022-12-31 13:08:03'),
(85, 'Maria Nygaard Hansen', 'egemosen4@gmail.com', '$2y$10$XQAhcUBMYsDJWHPC4jcPCuVZXesbdgnJ.jRoKBphgyLJcXt83NxvK', '(+45) 50 57 84 52', NULL, 'Ambulance Syd', NULL, NULL, '1985-06-09', 'User', '13', '8', 'Active', NULL, 'Paramediciner', NULL, 'Egemosen', '4', NULL, '6200', 'Aabenraa', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '090685-1458', NULL, 'profile-1672492247.png', NULL, NULL, '2022-12-31 13:09:45', '2022-12-31 13:11:39'),
(86, 'Morten Bruhn Jepsen', 'mo_bruhn@hotmail.com', '$2y$10$B1lYsBXrVdCy9bw4RkRKj.psnpqnMb32Q2hIB/cAdeIu0pgQOhbma', '(+45) 27 82 50 18', NULL, 'Ambulance Syd', NULL, NULL, '1991-12-06', 'User', '11', '8', 'Active', NULL, 'Ambulancebehandler', NULL, 'Sejersholt', '3', NULL, '6200', 'Aabenraa', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '061291-1185', NULL, '', NULL, NULL, '2022-12-31 13:13:57', '2022-12-31 13:16:26'),
(87, 'Sascha Baltersen', 'sascha_baltersen@hotmail.co', '$2y$10$BZtPozDNUJ.8MfjOFi008eOLnvnbmQ6wvkb2WQna8RRi149m5FKia', '(+45) 42 71 20 26', NULL, 'Ambulance Syd', NULL, NULL, '1990-11-30', 'User', '11', '8', 'Active', NULL, 'Ambulancebehandler', NULL, 'Enggårdsvej', '36', NULL, '5792', 'Årslev', 'Danmark', NULL, NULL, NULL, '2022-08-01', NULL, 'Deltidsansættelse', 'Show', '301190-1300', NULL, 'profile-1672492773.png', NULL, NULL, '2022-12-31 13:18:10', '2022-12-31 13:20:24'),
(88, 'Thomas Evald', 'thomas.evald@outlook.dk', '$2y$10$Tu10rh6xZmJou8364dpVRO2SNqJMLQ5zVld5F88cso4hH5xym9Yxq', '(+45) 21 64 67 66', NULL, 'Nord-Als Svømmeklub', NULL, NULL, '1987-12-19', 'User', '2,20', '11', 'Active', NULL, 'First responer', NULL, 'Ellekobbel', '10', NULL, '6430', 'Nordborg', 'Danmark', NULL, NULL, NULL, '2021-01-01', NULL, 'Frivillig kontrakt', 'Show', '191287-1033', '<p>Kystlivredder / Dykker instrukt&oslash;r&nbsp;</p>', 'profile-1672675144.png', NULL, NULL, '2023-01-02 15:54:07', '2023-01-07 08:30:46'),
(89, 'Ken Roager Paulsen', 'ken@rpaulsen.dk', '$2y$10$FCrLJpE76IbUbYgWS.4rXe2thyUxrSSxXn5iLQEw0IRvh8xue.04m', '(+45) 40 16 50 26', NULL, NULL, NULL, NULL, '1979-01-25', 'User', '2,20', '11', 'Active', NULL, 'First responder', NULL, 'Mjanghøj', '7', NULL, '6470', 'Sydals', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'Show', NULL, NULL, 'profile-1673257643.png', NULL, NULL, '2023-01-07 08:02:51', '2023-01-09 09:47:23'),
(90, 'Julie Frølund Christensen', 'juliefc2015@icloud.com', '$2y$10$g7gDpfh6sVK1lJsc4vvDPeRAAntrbyl7Mff0r2bVYQBksd6weAasm', '(+45) 42 22 95 14', NULL, NULL, NULL, NULL, '2003-03-20', 'User', '2,20', '11', 'Active', NULL, 'First responder', NULL, 'Rugløkke', '6', NULL, '6430', 'Nordborg', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'Show', NULL, NULL, '', NULL, NULL, '2023-01-07 08:05:30', '2023-01-07 08:27:10'),
(91, 'Jakob Hesselager Rothe', 'jakobhrothe@hotmail.com', '$2y$10$gIEA3wXRaVOI9f8P9dy7mOiUzaa7MgUuC75BlCSFB4e1MlqPlw8GO', '(+45) 20 37 89 51', NULL, NULL, NULL, NULL, '2005-08-09', 'User', '2,20', '11', 'Active', NULL, 'First responder', NULL, 'Brandshøjevej', '1', NULL, '6430', 'Nordborg', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'Show', NULL, NULL, '', NULL, NULL, '2023-01-07 08:07:53', '2023-01-07 08:26:33'),
(92, 'Sofie Mechlenborg Nørulf', 'sofie.m.noerulf@hotmail.com', '$2y$10$kA4Ox/z9D2c8JvFmEpfSmO/tSuI5V6Kr7y5BnJpPoZCpYq3yK.ysK', '(+45) 30 32 76 86', NULL, NULL, NULL, NULL, '1994-08-01', 'User', '2,20', '11', 'Active', NULL, 'First responder', NULL, 'Stolbro gade', '4', NULL, '6430', 'Nordborg', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'Show', NULL, NULL, '', NULL, NULL, '2023-01-07 08:10:37', '2023-01-07 08:28:16'),
(93, 'Josefine Poulsen', 'josefinepoulsen2003@gmail.com', '$2y$10$0YijBvA25UfsQvCJyBz2zOxI0hxbeVo7O3w5eO.dDxDRWEzJOO7/C', '(+45) 28 43 48 33', NULL, NULL, NULL, NULL, '2003-08-16', 'User', '2,20', '11', 'Active', NULL, 'First responder', NULL, 'Damgade', '12 B', NULL, '6430', 'Nordborg', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'Show', NULL, NULL, '', NULL, NULL, '2023-01-07 08:13:34', '2023-01-07 08:26:52'),
(94, 'Signe Clemmesen', 'signeclemmesen@gmail.com', '$2y$10$y0dDrBE60.B2/nTPdttwPehi1mTJDrysOR7PvLm8LMS1tE0twtdpG', '(+45) 53 57 05 06', NULL, NULL, NULL, NULL, '2003-02-09', 'User', '2,20', '11', 'Active', NULL, 'First responder', NULL, 'Skolevej', '36', NULL, '6430', 'Nordborg', 'Danmark', NULL, NULL, NULL, NULL, NULL, NULL, 'Show', NULL, NULL, '', NULL, NULL, '2023-01-07 08:15:16', '2023-01-07 08:27:53'),
(95, 'Karin Weide Jensen', 'karin@weidejensen.dk', '$2y$10$C3J6SQFZTJveD3LtNBFXhuU89kFO.KxXTNOCEDjLpbV/4Uiyy1l1i', '(+45) 60 77 64 40', NULL, NULL, NULL, NULL, '1962-01-03', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '030162-1604', NULL, '', NULL, NULL, '2023-01-09 10:21:41', '2023-01-09 10:22:48'),
(96, 'Flemming Post', 'fler.post@mail.tele.dk', '$2y$10$RxSD4QNEGvOZS9Py/cYI8Oz5zM5EzJX7pr1EDprrs.eFMhgDscnaq', '(+45) 51 55 64 20', NULL, NULL, NULL, NULL, '1945-07-29', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '290745-1847', NULL, '', NULL, NULL, '2023-01-09 10:24:03', '2023-01-09 10:24:55'),
(97, 'Anders Clemmesen', 'anderclemmesen@gmail.com', '$2y$10$otmZVL21nE4TRm2qYQTpaezMwCEsAax6lrOfOXgvmJBuoSXzNCKBi', '(+45) 22 79 05 06', NULL, NULL, NULL, NULL, '2005-06-19', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '190605-5607', NULL, '', NULL, NULL, '2023-01-09 10:26:46', '2023-01-09 10:27:36'),
(98, 'Anne Dorte Behrendtz', 'annedortebehrendtz@gmail.com', '$2y$10$fH4oCtiBdl11MQJRI53OvelixyQ.Su1PB54DWepSB5JVo6UvfUuWq', '(+45) 24 66 06 82', NULL, NULL, NULL, NULL, '1962-10-29', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '291062-2172', NULL, '', NULL, NULL, '2023-01-09 10:29:12', '2023-01-09 10:30:02'),
(99, 'Malthe Christian Dahl Matthiesen', 'mmatthiesen2005@gmail.com', '$2y$10$YIqoKuhmfq4JQ5Hqlxh0RubxDRcB5v38ACBOTGuh8MvnDiBtGFiqK', '(+45) 60 47 97 00', NULL, NULL, NULL, NULL, '2005-09-01', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '010905-5719', NULL, '', NULL, NULL, '2023-01-09 10:31:23', '2023-01-09 10:32:17'),
(100, 'Oliver Bødker Frandsen', 'oliboedker@gmail.com', '$2y$10$PxMoljWXdQzxj95yIkhCKeTx8MIeJfEzuU6SFl8xp7OUaIKrG2OwO', '(+45) 30 29 14 04', NULL, NULL, NULL, NULL, '2006-12-08', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '081206-5637', NULL, '', NULL, NULL, '2023-01-09 10:33:35', '2023-01-09 10:34:11'),
(101, 'Hanne Hesselager Rothe', 'hannehrothe@gmail.com', '$2y$10$ZHM8518aGbep8p/Zb1bzL.uOCV1/E9FqRwV5e0dKuNClLKg7NrSha', '(+45) 50 77 10 48', NULL, NULL, NULL, NULL, '1971-11-15', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '151171-1742', NULL, '', NULL, NULL, '2023-01-09 10:35:23', '2023-01-09 10:36:07'),
(102, 'Iris Sørensen', 'flir.post@mail.tele.dk', '$2y$10$LU7IoWNHaKeTPAgW2GM0D.wy.EWBks.4Skrn0K.gTZd7mioOrl3My', '(+45) 23 95 64 19', NULL, NULL, NULL, NULL, '1944-09-22', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '220944-0116', NULL, '', NULL, NULL, '2023-01-09 10:37:14', '2023-01-09 10:37:45'),
(103, 'Egon Skipper Petersen', 'skipperpetsen@outlook.com', '$2y$10$c0kFgkyeue4U.AOgX9y.5./gGvHbswTrE7NqpIPBmAdnijuDWkeiO', '(+45) 31 12 57 82', NULL, NULL, NULL, NULL, '1971-05-29', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '290571-2821', NULL, '', NULL, NULL, '2023-01-09 10:38:52', '2023-01-09 10:39:24'),
(104, 'Helle Møller Klepke', 'klepkeh@gmail.com', '$2y$10$OwvsKK/gfwxgbhjq6aol0O1yooHzM/Z6SOb0SXZc5vP3j7aG5zZ6C', '(+45) 25 48 16 10', NULL, NULL, NULL, NULL, '1999-10-16', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '161099-0580', NULL, '', NULL, NULL, '2023-01-09 10:40:29', '2023-01-09 10:41:02'),
(105, 'Leif Sørensen', 'leiffynshav@gmail.com', '$2y$10$AyPSSS5LhZ3y74BZeePIfO/a.hxfWepbUfjFeMectKZ0fzkIMPWFK', '(+45) 20 49 04 09', NULL, NULL, NULL, NULL, '1965-06-01', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '010665-1221', NULL, '', NULL, NULL, '2023-01-09 10:42:05', '2023-01-09 10:42:34'),
(106, 'Silas Elkrog Krogh', 'silaselkrog@gmail.com', '$2y$10$hcBxn/GU0WrloD/F/HQqFuGvQ9ndnnUEX5AQZVA5lxVFH2liksdfy', '(+45) 30 96 42 05', NULL, NULL, NULL, NULL, '2007-04-12', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '120407-5057', NULL, '', NULL, NULL, '2023-01-09 10:43:44', '2023-01-09 10:44:10'),
(107, 'Mads Christian Ladegaard', 'mads756w@gmail.com', '$2y$10$.B.04xsafSrBUH0qNprvr.j1oT89RnBpvjEGsZPY9o2zuAjKHPkRW', '(+45) 91 54 18 59', NULL, NULL, NULL, NULL, '2007-01-04', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '040107-5127', NULL, '', NULL, NULL, '2023-01-09 10:45:16', '2023-01-09 10:45:51'),
(108, 'Lorens Torre Jessen', 'renatheoglorens@gmail.com', '$2y$10$73ytQti7JpF4BQWsh1lNvOyiadmnKk2bzwCkGjvP1.NPExmPFPt4q', '(+45) 40 13 75 66', NULL, NULL, NULL, NULL, '1977-02-08', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '080277-2483', NULL, '', NULL, NULL, '2023-01-09 10:49:49', '2023-01-09 10:50:23'),
(109, 'Antte Mie Hall', 'amhall@danfoss.com', '$2y$10$rAY1Kio2nVo//g8iPjPkjOR8oD9lPGJEx35Vv.t1tR2/Xe8naYDH2', '(+45) 21 40 80 34', NULL, NULL, NULL, NULL, '1969-04-17', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '170469-1390', NULL, '', NULL, NULL, '2023-01-09 10:51:35', '2023-01-09 10:52:03');
INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `note`, `bank_information`, `ice_contact`, `employment_date`, `role`, `group_id`, `location_id`, `status`, `who_update_status`, `work_title`, `co_line`, `street_navn`, `street_no`, `street_level`, `po_code`, `city_name`, `country`, `permissions`, `app_access`, `schedule_settings`, `start_date`, `end_date`, `type`, `sidebar`, `birthday_cdr_control`, `profile_note`, `image`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(110, 'Matthew Stephen David Hall', 'msdhall@outlook.com', '$2y$10$4ynVaYJvQtxeTKjpSm.Dte0Hg8oPjTsQ/wG4dlK9C5d/nc5VPZal6', '(+45) 93 90 00 59', NULL, NULL, NULL, NULL, '2008-09-17', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '170908-6657', NULL, '', NULL, NULL, '2023-01-09 10:53:02', '2023-01-09 10:53:47'),
(111, 'Theis Missfeld', 'theismissfeld@gmail.com', '$2y$10$OLDsNE.KA4kGNGNJzG1gW.uyrel3K4rs64pkO8WIsLZLguNAbIDB.', '(+45) 25 74 03 00', NULL, NULL, NULL, NULL, '2007-05-17', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '170507-5871', NULL, '', NULL, NULL, '2023-01-09 10:54:44', '2023-01-09 10:55:15'),
(112, 'Lærke Thorøe', 'laerkethoroee@hotmail.com', '$2y$10$NmPttQWs4sz4jQymdQ.8E.bceUyCqswi/UtMDCHtYxrLfq5yYAY6y', '(+45) 51 95 51 21', NULL, NULL, NULL, NULL, '2006-05-23', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '230506-6942', NULL, '', NULL, NULL, '2023-01-09 10:56:16', '2023-01-09 10:57:02'),
(113, 'Cecilie Margrethe Christiansen', 'cecilie.mc@icloud.com', '$2y$10$.5e.tF8JL/MlgBntqGaN/e/KGUclI9n/IIpLuiUHg9Fe/DuJiAG/.', '(+45) 31 51 44 85', NULL, NULL, NULL, NULL, '2007-09-21', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '210907-7340', NULL, '', NULL, NULL, '2023-01-09 10:58:03', '2023-01-09 10:58:47'),
(114, 'Signe Sperling', 'signesperling@icloud.com', '$2y$10$.PH0Tdvum5/4wjsiB1orNeFp7HBMvRTZx3QoskhvURHpuia86tmci', '(+45) 93 88 16 17', NULL, NULL, NULL, NULL, '2007-10-02', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '021007-6166', NULL, '', NULL, NULL, '2023-01-09 10:59:56', '2023-01-09 11:01:00'),
(115, 'Esben Fønsskov Sahl', 'efs2002@outlook.dk', '$2y$10$a/7Gy1j4NiSmaDAOWnk.Ee12zCZFg/RKfAP7V3RFMP/Tdoa9BexSa', '(+45) 53 20 19 01', NULL, NULL, NULL, NULL, '2002-09-16', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '160902-7327', NULL, '', NULL, NULL, '2023-01-09 11:01:59', '2023-01-09 11:03:17'),
(116, 'Rajendran Poul Nielsen', 'rajendrannielsen@hotmail.com', '$2y$10$7MCKUHVvecIrsbbrEZQoC.M6eGrpGWifk7X2UHb82O7GAGgm99l36', '(+45) 30 26 22 74', NULL, NULL, NULL, NULL, '1974-05-24', 'User', '20', '11', 'Active', NULL, 'Livredder', NULL, '.', '.', NULL, '.', '.', 'Danmark', NULL, NULL, NULL, '2023-01-08', NULL, 'Frivilligkontrakt', 'Show', '240578-3137', NULL, '', NULL, NULL, '2023-01-09 11:04:19', '2023-01-09 11:04:51'),
(117, 'Betina Krantz', 'betinakrantz@hotmail.com', '$2y$10$VjybUtYLbZXKpEcm7uEg9uehhPzL3qOfC2sU9FLRZMpB1rYNDPHk.', '(+45) 28 94 34 66', NULL, 'Hvidovre hospital', NULL, NULL, '1986-02-18', 'User', '3', '6', 'Active', NULL, 'Sygeplejerske', NULL, 'alfelts vej', '104', '8tv', '2300', 'København S', 'Danmark', NULL, NULL, NULL, '2023-04-03', NULL, NULL, 'Show', '180286-1458', '<p>T&oslash;j st&oslash;rrelse:</p>\r\n\r\n<p>T-shirt - Small</p>\r\n\r\n<p>Bukser -&nbsp;</p>', 'profile-1680476283.png', NULL, NULL, '2023-04-02 20:46:27', '2023-04-02 23:03:19'),
(118, 'Mads Wedderkopp', 'wedder4610@gmail.com', '$2y$10$cmu5kjTPOhhcAtGPgOAue.LTYGy9k/Ut2DOjDFVsWuLffc27M0xsm', '24610042', NULL, 'Områderedder Falck Sjælland', NULL, NULL, '1984-07-20', 'User', '13', '7', 'Active', NULL, 'Paramediciner', NULL, 'holbergsvej', '131', NULL, '4700', 'Næstved', 'Danmark', NULL, NULL, NULL, '2023-01-03', NULL, NULL, 'Show', '200784-1925', NULL, 'profile-1680548336.png', NULL, NULL, '2023-04-03 18:52:53', '2023-04-03 18:58:56'),
(119, 'Allan Nielsen', 'arrany3@gmail.com', '$2y$10$XBT6QMC4NDs30cSbEc88Zu7BMk3/Dor2y1okSHpLJQMRd1p8EuYii', '(+45) 50 14 96 14', NULL, 'Region H. Akutberedskabet', NULL, NULL, '1973-06-14', 'User', '11', '6,7', 'Active', NULL, 'Ambulancebehandler', NULL, 'Bennets Väg', '8b', '1401', '21367', 'Malmö', 'Sverige', NULL, NULL, NULL, '2023-04-04', NULL, 'Timeredder', 'Show', '140673-2971', '<p>T&oslash;j str. XXL</p>', 'profile-1680618943.png', NULL, NULL, '2023-04-04 14:18:22', '2023-04-09 11:00:29'),
(120, 'Anders Andersen', 'mjz@outlook.dk', '$2y$10$5zmbW/tYScFzVE/8BsP.CuvmnDoHrM8z8PR1jUBAbjFD4NjhdWRMC', '(+45) 22 33 44 55', NULL, NULL, NULL, NULL, '2023-04-09', 'User', '13', '6,7', 'Active', NULL, 'Test bruger', NULL, 'Vamdrupvej', '1B', '2 th', '2610', 'Rødovre', 'Danmark', NULL, 'PWA', NULL, NULL, NULL, NULL, 'Show', NULL, NULL, 'profile-1681038333.png', NULL, NULL, '2023-04-09 11:04:34', '2023-04-09 11:06:29'),
(121, 'Rasmus Winkel', 'rasmuswinkel@hotmail.com', '$2y$10$5uB0d835XCphmoi.w.qHIuPrHtjlfnZDYy89EU/LDRN/le3neCB0O', '(+45) 25 14  51 84', NULL, 'RH + SAR', '(+45) 35 45 14 17', NULL, '1973-06-08', 'User', '10', '6,7', 'Active', NULL, 'Anæstesilæge', NULL, 'Klintevej', '14', NULL, '4000', 'Roskilde', 'Danmark', NULL, NULL, NULL, '2023-04-01', NULL, 'Timeansat', 'Show', '080673-1641', NULL, '', NULL, NULL, '2023-04-09 13:59:26', '2023-04-09 14:02:09'),
(122, 'Peder Holmes Ersgaard *', 'peder.ersgaard@yahoo.dk', '$2y$10$juD8XcgSKV.hMa6Wo3tWYe9UIjKjmtduVM.EZcu3YdrErZXt3F7pq', '(+45) 31 54 30 09', NULL, NULL, NULL, NULL, '1979-10-08', 'User', '13', '6,7,8', 'Active', NULL, 'Paramediciner', NULL, 'Næblerødvej', '8', NULL, '4250', 'Fuglebjerg', 'Danmark', NULL, 'PWA', NULL, '2023-04-01', NULL, 'Samarbejdspartner', 'Show', NULL, '<p><small><tt>SAMARBEJDSPARTNER</tt></small></p>\r\n\r\n<p>Ersgaard Medical Services<br />\r\nCVR-nr. 43349899</p>\r\n\r\n<p>Peder Ersgaard 300 kr p&aring; fakura.<br />\r\nRikke Ersgaard 1000 kr p&aring; fakura</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><small><tt>T&Oslash;J ST&Oslash;RRELSE</tt></small></p>\r\n\r\n<p>Bluse/t-shirt: Large<br />\r\nJakke:&nbsp;</p>', 'profile-1681283593.png', NULL, NULL, '2023-04-12 07:03:42', '2023-04-12 07:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_associateds`
--

CREATE TABLE `user_associateds` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_associateds`
--

INSERT INTO `user_associateds` (`id`, `user_id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(3, 16, 'Arham khan', 'asd dsfs dfs', '2022-10-31 12:27:16', '2022-10-31 12:27:23'),
(4, 13, 'Deltaplan.dk 22', 'Username is mobile no 44', '2022-11-02 12:47:08', '2022-11-23 17:39:54'),
(5, 13, 'Danløn', 'Username is xyyyy', '2022-11-02 12:58:23', '2022-11-20 10:26:30'),
(8, 13, 'Optima vagtplan', 'Brugernavn er CPR-nr', '2022-11-23 17:39:36', '2022-11-23 17:39:36'),
(9, 20, 'Deltaplan', '20315271', '2022-12-16 11:23:33', '2022-12-16 11:23:33'),
(10, 13, 'Test', 'test', '2022-12-17 21:01:59', '2022-12-17 21:01:59'),
(11, 23, 'Autorisations ID:', '0DLN5 (Ambulancebehandler)', '2022-12-26 20:51:50', '2022-12-26 20:51:50'),
(12, 24, 'Autorisations ID:', '0FBHC (Ambulancebehandler)', '2022-12-26 21:05:18', '2022-12-26 21:05:18'),
(13, 24, 'Facebook', 'https://www.facebook.com/profile.php?id=567254738', '2022-12-26 21:12:04', '2022-12-26 21:12:04'),
(18, 29, 'Autorisations ID:', '0F6QK  (Ambulancebehandler)', '2022-12-26 21:41:51', '2022-12-26 21:41:51'),
(19, 30, 'Autorisations ID:', '0F4MW  (Sygeplejerske)', '2022-12-26 21:46:31', '2022-12-26 21:46:31'),
(20, 32, 'Autorisations ID:', '08YJJ  (Sygeplejerske)', '2022-12-27 10:53:42', '2022-12-27 10:53:42'),
(21, 32, 'Specialisering:', 'Anæstesi  (28-02-2018)', '2022-12-27 10:54:07', '2022-12-27 10:54:07'),
(22, 33, 'Autorisations ID:', '03R4X  (Sygeplejerske)', '2022-12-27 11:24:11', '2022-12-27 11:24:11'),
(23, 33, 'Specialisering:', 'Anæstesi  (29-02-2012)', '2022-12-27 11:24:28', '2022-12-27 11:24:28'),
(24, 34, 'Autorisations ID:', '0FDS5  (Ambulancebehandler)', '2022-12-27 12:12:00', '2022-12-27 12:12:00'),
(25, 37, 'Autorisations ID:', '0DGSK  (Ambulancebehandler)', '2022-12-27 12:38:19', '2022-12-27 12:38:19'),
(26, 37, 'Autorisations ID:', '07MX7  (Social- og sundhedsassistent)', '2022-12-27 12:38:55', '2022-12-27 12:38:55'),
(28, 40, 'Autorisations ID:', '06SLF  (Læge)', '2022-12-27 13:08:58', '2022-12-27 13:08:58'),
(29, 40, 'Speciale:', 'Anæstesiologi  (01-08-2020)', '2022-12-27 13:09:30', '2022-12-27 13:09:30'),
(30, 41, 'Autorisations ID:', '0DL9B  (Ambulancebehandler)', '2022-12-27 13:15:33', '2022-12-27 13:15:33'),
(31, 45, 'Autorisations ID:', '0F8ZT  (Sygeplejerske)', '2022-12-27 13:42:28', '2022-12-27 13:42:28'),
(32, 46, 'Autorisations ID:', '098JV  (Læge)', '2022-12-27 13:51:55', '2022-12-27 13:51:55'),
(33, 46, 'Speciale:', 'Anæstesiologi  (07-10-2019)', '2022-12-27 13:52:19', '2022-12-27 13:52:19'),
(34, 47, 'Autorisations ID:', '0DFH6  (Ambulancebehandler)', '2022-12-27 14:01:21', '2022-12-27 14:01:21'),
(35, 47, 'Specialisering:', 'Paramediciner  (30-01-2020)', '2022-12-27 14:01:44', '2022-12-27 14:01:44'),
(36, 48, 'Autorisations ID:', '09Q57  (Sygeplejerske)', '2022-12-27 15:05:20', '2022-12-27 15:05:20'),
(37, 48, 'Specialisering:', 'Anæstesi  (28-02-2019)', '2022-12-27 15:05:40', '2022-12-27 15:05:40'),
(38, 49, 'Autorisations ID:', '00VMY  (Læge)', '2022-12-27 16:07:25', '2022-12-27 16:07:25'),
(39, 49, 'Speciale:', 'Anæstesiologi  (01-05-2012)', '2022-12-27 16:07:47', '2022-12-27 16:07:47'),
(40, 50, 'Autorisations ID:', '06SN3  (Læge)', '2022-12-27 16:15:13', '2022-12-27 16:15:13'),
(41, 50, 'Speciale:', 'Anæstesiologi  (01-11-2019)', '2022-12-27 16:15:38', '2022-12-27 16:15:38'),
(42, 52, 'Autorisations ID:', '0F7Q8  (Ambulancebehandler)', '2022-12-27 16:55:26', '2022-12-27 16:55:26'),
(47, 58, 'Autorisations ID:', '0D98Z  (Ambulancebehandler)', '2022-12-28 15:28:26', '2022-12-28 15:28:26'),
(48, 58, 'Specialisering:', 'Paramediciner  (28-11-2019)', '2022-12-28 15:28:45', '2022-12-28 15:28:45'),
(49, 59, 'Autorisations ID:', '0FCM4  (Ambulancebehandler)', '2022-12-28 15:34:20', '2022-12-28 15:34:20'),
(52, 60, 'Autorisations ID:', '0DTLY  (Ambulancebehandler)', '2022-12-29 15:43:54', '2022-12-29 15:43:54'),
(53, 60, 'Specialisering:', 'Paramediciner  (06-05-2021)', '2022-12-29 15:44:19', '2022-12-29 15:44:19'),
(56, 62, 'Autorisations ID:', '0FBH4  (Ambulancebehandler)', '2022-12-30 09:00:45', '2022-12-30 09:00:45'),
(59, 61, 'Bil (2023)', 'DR 39 229', '2023-03-28 21:22:11', '2023-03-28 21:22:11'),
(60, 19, 'Bil 1 (2023)', 'DP 44 280', '2023-03-28 21:38:16', '2023-03-28 21:38:16'),
(61, 19, 'Bil 2 (2023)', 'AY 78 420', '2023-03-28 21:38:36', '2023-03-28 21:38:36'),
(62, 63, 'Bil (2023)', 'DJ 22 590', '2023-03-28 21:39:12', '2023-03-28 21:39:12'),
(63, 68, 'Bil (2023)', 'CX 64 385', '2023-03-28 21:39:43', '2023-03-28 21:39:43'),
(64, 66, 'Bil (2023)', 'CE 66 931', '2023-03-28 21:40:14', '2023-03-28 21:40:14'),
(65, 56, 'Bil (2023)', 'CW 63 198', '2023-03-28 21:40:55', '2023-03-28 21:40:55'),
(66, 71, 'Bil (2023)', 'CJ 35 186', '2023-03-28 21:41:33', '2023-03-28 21:41:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_authorizations`
--

CREATE TABLE `user_authorizations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `auth_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thesis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_validate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_validate_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_authorizations`
--

INSERT INTO `user_authorizations` (`id`, `user_id`, `auth_id`, `subject_group`, `thesis`, `last_validate`, `last_validate_by`, `created_at`, `updated_at`) VALUES
(4, 1, '12345', 'Test', 'mere test', '30 Dec 2022, 05:49 PM', 12, '2022-12-30 16:49:19', '2022-12-30 16:49:43'),
(5, 56, '0DFY2', 'Ambulancebehandler', 'Paramediciner', '30 Dec 2022, 06:02 PM', 12, '2022-12-30 17:01:50', '2022-12-30 17:02:41'),
(6, 23, '0DLN5', 'Ambulancebehandler', '.', '30 Dec 2022, 06:03 PM', 12, '2022-12-30 17:03:43', '2022-12-30 17:03:51'),
(7, 25, '03L80', 'Sygeplejerske', 'Anæstesi', '30 Dec 2022, 06:04 PM', 12, '2022-12-30 17:04:22', '2022-12-30 17:04:28'),
(8, 26, '0CTS6', 'Sygeplejerske', '.', '30 Dec 2022, 06:05 PM', 12, '2022-12-30 17:05:01', '2022-12-30 17:05:16'),
(9, 27, '06RKL', 'Sygeplejerske', '.', '30 Dec 2022, 06:07 PM', 12, '2022-12-30 17:06:59', '2022-12-30 17:07:05'),
(10, 57, '0DV0N', 'Ambulancebehandler', 'Paramediciner', '30 Dec 2022, 06:11 PM', 12, '2022-12-30 17:10:57', '2022-12-30 17:11:36'),
(11, 28, '0F721', 'Ambulancebehandler', 'Paramediciner', '30 Dec 2022, 18:14', 12, '2022-12-30 17:13:50', '2022-12-30 17:14:00'),
(13, 64, '09Q1R', 'Sygeplejerske', NULL, '31 Dec 2022, 10:43', 12, '2022-12-31 09:43:18', '2022-12-31 09:43:22'),
(14, 66, '0D9HW', 'Ambulancebehandler', 'Paramediciner', '31 Dec 2022, 11:15', 12, '2022-12-31 10:14:29', '2022-12-31 10:15:14'),
(15, 67, '0DTYN', 'Ambulancebehandler', 'Paramediciner', '31 Dec 2022, 11:26', 12, '2022-12-31 10:25:51', '2022-12-31 10:26:00'),
(16, 68, '0DN7C', 'Ambulancebehandler', 'Paramediciner', '31 Dec 2022, 11:32', 12, '2022-12-31 10:31:51', '2022-12-31 10:32:09'),
(17, 69, '0D86M', 'Ambulancebehandler', NULL, '31 Dec 2022, 11:40', 12, '2022-12-31 10:40:19', '2022-12-31 10:40:25'),
(18, 70, '0D931', 'Ambulancebehandler', NULL, '31 Dec 2022, 12:00', 12, '2022-12-31 11:00:08', '2022-12-31 11:00:13'),
(19, 71, '0DR0K', 'Ambulancebehandler', 'Paramediciner', '31 Dec 2022, 12:05', 12, '2022-12-31 11:05:02', '2022-12-31 11:05:08'),
(20, 72, '0FDT3', 'Ambulancebehandler', NULL, '31 Dec 2022, 12:23', 12, '2022-12-31 11:22:29', '2022-12-31 11:23:19'),
(21, 73, '0F0J9', 'Ambulancebehandler', NULL, '31 Dec 2022, 12:34', 12, '2022-12-31 11:33:55', '2022-12-31 11:34:22'),
(22, 75, '0DMZK', 'Ambulancebehandler', NULL, '31 Dec 2022, 13:07', 12, '2022-12-31 12:07:17', '2022-12-31 12:07:23'),
(23, 76, '08XYY', 'Sygeplejerske', NULL, '31 Dec 2022, 13:13', 12, '2022-12-31 12:13:51', '2022-12-31 12:13:56'),
(24, 77, '0F241', 'Ambulancebehandler', NULL, '31 Dec 2022, 13:19', 12, '2022-12-31 12:19:33', '2022-12-31 12:19:40'),
(25, 78, '093DR', 'Sygeplejerske', NULL, '31 Dec 2022, 13:30', 12, '2022-12-31 12:30:40', '2022-12-31 12:30:45'),
(27, 79, '0D93S', 'Ambulancebehandler', 'Paramediciner', '31 Dec 2022, 13:34', 12, '2022-12-31 12:34:01', '2022-12-31 12:34:06'),
(28, 81, '0CMT0', 'Sygeplejerske', NULL, '31 Dec 2022, 13:50', 12, '2022-12-31 12:50:11', '2022-12-31 12:50:15'),
(29, 82, '0FBH0', 'Ambulancebehandler', NULL, '31 Dec 2022, 13:58', 12, '2022-12-31 12:58:06', '2022-12-31 12:58:10'),
(30, 83, '0d868', 'Ambulancebehandler', 'Paramediciner', '31 Dec 2022, 14:03', 12, '2022-12-31 13:03:37', '2022-12-31 13:03:43'),
(31, 84, '0C7YN', 'Sygeplejerske', NULL, '31 Dec 2022, 14:08', 12, '2022-12-31 13:08:27', '2022-12-31 13:08:33'),
(32, 85, '0F1DW', 'Ambulancebehandler', 'Paramediciner', '31 Dec 2022, 14:12', 12, '2022-12-31 13:12:06', '2022-12-31 13:12:12'),
(33, 86, '0DT1G', 'Ambulancebehandler', NULL, '31 Dec 2022, 14:17', 12, '2022-12-31 13:16:54', '2022-12-31 13:17:00'),
(34, 87, '0D924', 'Ambulancebehandler', NULL, '31 Dec 2022, 14:20', 12, '2022-12-31 13:20:51', '2022-12-31 13:20:56'),
(35, 12, '0D0FZ', 'Sygeplejerske', NULL, '17 Feb 2023, 16:49', 12, '2022-12-31 13:33:11', '2023-02-17 15:49:51'),
(36, 12, '0FCPC', 'Ambulancebehandler', NULL, '28 Feb 2023, 14:07', 12, '2022-12-31 14:09:41', '2023-02-28 13:07:10'),
(38, 39, '03RDJ', 'Sygeplejerske', 'Anæstesi', NULL, 12, '2023-01-02 18:35:00', '2023-01-02 18:35:33'),
(39, 63, '0FDZH', 'Ambulancebehandler', 'Paramediciner', '02 Jan 2023, 19:37', 12, '2023-01-02 18:37:12', '2023-01-02 18:37:19'),
(40, 20, '0D93F', 'Ambulancebehandler', 'Paramediciner', '07 Jan 2023, 09:29', 12, '2023-01-07 07:17:28', '2023-01-07 08:29:11'),
(41, 61, '0F1WW', 'Ambulancebehandler', 'Paramediciner', NULL, 12, '2023-03-28 21:21:06', '2023-03-28 21:21:31'),
(42, 19, '0D85Z', 'Ambulancebehandler', 'Paramediciner', '28 Mar 2023, 23:37', 12, '2023-03-28 21:37:34', '2023-03-28 21:37:41'),
(43, 117, '0cmrz', 'Sygeplejerske', NULL, '02 Apr 2023, 22:50', 20, '2023-04-02 20:48:52', '2023-04-02 20:50:33'),
(44, 118, '0dv4f', 'Ambulancebehandler', NULL, '03 Apr 2023, 20:54', 20, '2023-04-03 18:54:35', '2023-04-03 18:54:43'),
(45, 119, '0F0F6', 'Ambulancebehandler', NULL, '04 Apr 2023, 16:20', 12, '2023-04-04 14:19:58', '2023-04-04 14:20:05'),
(46, 121, '00SSP', 'Læge', 'Anæstesiologi', '09 Apr 2023, 16:01', 12, '2023-04-09 14:00:56', '2023-04-09 14:01:03'),
(47, 46, '098JV', 'Læge', 'Anæstesiologi', '10 Apr 2023, 10:53', 12, '2023-04-10 08:53:22', '2023-04-10 08:53:45'),
(48, 122, '0DTN0', 'Ambulancebehandler', 'Paramediciner', '12 Apr 2023, 09:06', 12, '2023-04-12 07:05:41', '2023-04-12 07:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_banks`
--

CREATE TABLE `user_banks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `payrol_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rit_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_banks`
--

INSERT INTO `user_banks` (`id`, `user_id`, `payrol_number`, `bank_name`, `rit_number`, `account_number`, `swift_number`, `created_at`, `updated_at`) VALUES
(3, 16, NULL, 'ABL Bank', '5566546', '565645', '65465', '2022-10-31 12:26:59', '2022-12-27 15:14:03'),
(4, 13, 'Danløn nr 11', 'Danske bank 22', '3333', '4444444444', 'DABADKKK 555', '2022-11-02 12:54:01', '2022-11-21 20:00:31'),
(5, 20, '0D93F', 'Spar Nord', '9308', '2080122139', NULL, '2022-12-16 11:18:21', '2022-12-31 14:40:19'),
(6, 48, '09Q57', NULL, '5320', '0000319127', NULL, '2022-12-27 15:16:13', '2022-12-27 15:17:42'),
(7, 25, '03L80', NULL, '6300', '1538669', NULL, '2022-12-27 15:18:37', '2022-12-27 15:18:46'),
(8, 26, '0CTS6', NULL, '2650', '5367221870', NULL, '2022-12-27 15:20:17', '2022-12-27 15:20:17'),
(9, 27, '06RKL', NULL, '2360', '8895117154', NULL, '2022-12-27 15:20:54', '2022-12-27 15:21:01'),
(10, 28, '0F721', NULL, '0759', '3226769756', NULL, '2022-12-27 15:38:46', '2022-12-27 15:38:46'),
(11, 29, '0F6QK', NULL, '2276', '0246462232', NULL, '2022-12-27 15:39:34', '2022-12-27 15:39:34'),
(12, 30, '0F4MW', NULL, '5479', '7765425', NULL, '2022-12-27 15:40:04', '2022-12-27 15:40:04'),
(13, 31, NULL, NULL, '7822', '0001238245', NULL, '2022-12-27 15:40:39', '2022-12-27 15:40:39'),
(14, 32, NULL, NULL, '6150', '0000193745', NULL, '2022-12-27 15:43:44', '2022-12-27 15:43:44'),
(15, 33, '03R4X', NULL, '3433', '2891810205', NULL, '2022-12-27 15:47:12', '2022-12-27 15:47:12'),
(16, 34, '0FDS5', NULL, '2280', '0291105548', NULL, '2022-12-27 15:47:50', '2022-12-27 15:47:50'),
(17, 35, NULL, NULL, '5342', '0513369', NULL, '2022-12-27 15:48:27', '2022-12-27 15:48:27'),
(18, 36, NULL, NULL, '2279', '6884238860', NULL, '2022-12-27 15:48:55', '2022-12-27 15:48:55'),
(19, 37, '0DGSK', NULL, '7570', '0001808703', NULL, '2022-12-27 15:49:33', '2022-12-27 15:49:33'),
(20, 38, NULL, NULL, '6489', '0002014321', NULL, '2022-12-27 15:49:58', '2022-12-27 15:49:58'),
(21, 39, '03RDJ', NULL, '5472', '0001326848', NULL, '2022-12-27 15:50:27', '2022-12-27 15:50:27'),
(22, 40, '06SLF', NULL, '4490', '4920437664', NULL, '2022-12-27 15:51:02', '2022-12-27 15:51:02'),
(23, 41, '0DL9B', NULL, '9077', '1380379739', NULL, '2022-12-27 15:51:48', '2022-12-27 15:51:48'),
(24, 42, NULL, NULL, '7980', '0001171178', NULL, '2022-12-27 15:52:25', '2022-12-27 15:52:25'),
(25, 43, NULL, 'Danske Bank', '1551', '4020209062', NULL, '2022-12-27 15:52:58', '2022-12-27 15:52:58'),
(26, 44, NULL, 'Danske bank', '1551', '4020909781', NULL, '2022-12-27 15:53:34', '2022-12-27 15:53:34'),
(27, 45, '0F8ZT', NULL, '4424', '4415205643', NULL, '2022-12-27 15:54:18', '2022-12-27 15:54:18'),
(28, 46, '098JV', '** SAMARBEJDSPARTNER **', '3199', '3199511335', NULL, '2022-12-27 15:54:57', '2023-04-12 06:59:33'),
(29, 47, '0DFH6', NULL, '7681', '3442266', NULL, '2022-12-27 15:55:29', '2022-12-27 15:55:29'),
(30, 49, '00VMY', NULL, '5338', '0450085', NULL, '2022-12-27 16:06:40', '2022-12-27 16:06:40'),
(31, 50, '06SN3', NULL, NULL, NULL, NULL, '2022-12-27 16:14:34', '2022-12-27 16:14:34'),
(32, 51, NULL, NULL, '9883', '1018829', NULL, '2022-12-27 16:38:51', '2022-12-27 16:38:51'),
(33, 52, '0F7Q8', NULL, '4190', '2065634743', NULL, '2022-12-27 16:56:08', '2022-12-27 16:56:08'),
(34, 53, NULL, NULL, '6520', '0004656333', NULL, '2022-12-27 17:02:41', '2022-12-27 17:02:41'),
(35, 56, 'ODFY2', NULL, '9332', '0008497222', NULL, '2022-12-28 14:23:19', '2022-12-28 14:24:42'),
(36, 57, '0DV0N', NULL, '7260', '0001398752', NULL, '2022-12-28 15:23:20', '2022-12-28 15:23:20'),
(37, 58, '0D98Z', NULL, '3643', '4815494091', NULL, '2022-12-28 15:27:51', '2022-12-28 15:27:51'),
(38, 59, '0FCM4', NULL, '5479', '5322321', NULL, '2022-12-28 15:33:59', '2022-12-28 15:33:59'),
(39, 19, '0D85Z', NULL, '5348', '0000382320', NULL, '2022-12-29 15:37:36', '2022-12-29 15:37:36'),
(40, 60, '0DTLY', NULL, '9004', '1120182559', NULL, '2022-12-29 15:43:25', '2022-12-29 15:43:25'),
(41, 61, '0F1WW', NULL, '7260', '0001137952', NULL, '2022-12-30 06:43:19', '2022-12-30 06:43:19'),
(42, 62, '0FBH4', NULL, '7040', '0004137963', NULL, '2022-12-30 09:00:18', '2022-12-30 09:00:18'),
(43, 63, '0FDZH', NULL, '7835', '0001684606', NULL, '2022-12-30 09:08:48', '2022-12-30 09:08:48'),
(44, 64, NULL, NULL, '7780', '1946235', NULL, '2022-12-31 09:57:43', '2022-12-31 09:57:43'),
(45, 65, NULL, NULL, '4681', '4710348758', NULL, '2022-12-31 10:11:16', '2022-12-31 10:11:16'),
(46, 66, '0D9HW', NULL, '7633', '2132828', NULL, '2022-12-31 10:16:36', '2022-12-31 10:16:36'),
(47, 67, '0DTYN', NULL, '7453', '0001028251', NULL, '2022-12-31 10:27:12', '2022-12-31 10:27:12'),
(48, 68, '0DN7C', NULL, '6187', '3155676395', NULL, '2022-12-31 10:33:30', '2022-12-31 10:33:30'),
(49, 69, '0D86M', NULL, '9331', '0012440812', NULL, '2022-12-31 10:40:08', '2022-12-31 10:40:08'),
(50, 70, '0D931', NULL, '9111', '0591100238', NULL, '2022-12-31 10:59:51', '2022-12-31 10:59:51'),
(51, 71, '0DR0K', NULL, '7402', '1025767', NULL, '2022-12-31 11:04:43', '2022-12-31 11:04:43'),
(52, 72, '0FDT3', NULL, '0400', '4025457086', NULL, '2022-12-31 11:22:59', '2022-12-31 11:22:59'),
(53, 73, '0F0J9', NULL, '9070', '4031202626', NULL, '2022-12-31 11:34:17', '2022-12-31 11:34:17'),
(54, 74, NULL, NULL, '9102', '4571786163', NULL, '2022-12-31 11:53:13', '2022-12-31 11:53:13'),
(55, 75, '0DMZK', 'Danske bank', '1551', '4701682637', NULL, '2022-12-31 12:07:05', '2022-12-31 12:07:05'),
(56, 76, '08XYY', NULL, '6737', '1058396', NULL, '2022-12-31 12:13:43', '2022-12-31 12:13:43'),
(57, 77, '0F241', 'Danske bank', '1551', '3993719323', NULL, '2022-12-31 12:22:08', '2022-12-31 12:22:08'),
(58, 78, '093DR', NULL, '0828', '0003760464', NULL, '2022-12-31 12:30:59', '2022-12-31 12:30:59'),
(59, 79, '0D93S', NULL, '5750', '6284796851', NULL, '2022-12-31 12:34:50', '2022-12-31 12:34:50'),
(60, 80, NULL, NULL, '5479', '0003239184', NULL, '2022-12-31 12:42:52', '2022-12-31 12:42:52'),
(61, 81, '0CMT0', NULL, '0400', '4020971555', NULL, '2022-12-31 12:50:03', '2022-12-31 12:50:03'),
(62, 82, '0FBH0', NULL, '7931', '0001194199', NULL, '2022-12-31 12:57:58', '2022-12-31 12:57:58'),
(63, 83, '0d868', NULL, '0828', '0003881199', NULL, '2022-12-31 13:03:27', '2022-12-31 13:03:27'),
(64, 84, '0C7YN', NULL, '5391', '494388', NULL, '2022-12-31 13:08:20', '2022-12-31 13:08:20'),
(65, 85, '0F1DW', NULL, '7990', '1707541', NULL, '2022-12-31 13:11:55', '2022-12-31 13:11:55'),
(66, 86, '0DT1G', NULL, '5969', '1057901', NULL, '2022-12-31 13:16:46', '2022-12-31 13:16:46'),
(67, 87, '0D924', NULL, '6845', '0002005314', NULL, '2022-12-31 13:20:40', '2022-12-31 13:20:40'),
(68, 12, '0D0FZ', 'Danske Bank', '1551', '4515181296', NULL, '2022-12-31 13:32:52', '2022-12-31 13:32:52'),
(69, 117, NULL, 'Sydbank', '7118', '0001366528', NULL, '2023-04-02 20:48:19', '2023-04-02 20:48:19'),
(70, 118, NULL, NULL, '6140', '4350342', NULL, '2023-04-03 18:54:16', '2023-04-03 18:54:16'),
(71, 119, NULL, 'Sydbank', '7681', '6366801', NULL, '2023-04-04 14:20:53', '2023-04-04 14:20:53'),
(72, 121, NULL, NULL, '6771', '6098718', NULL, '2023-04-09 14:02:30', '2023-04-09 14:02:30'),
(73, 122, NULL, '** SAMARBEJDSPARTNER **', NULL, NULL, NULL, '2023-04-12 07:05:27', '2023-04-12 07:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_contacts`
--

CREATE TABLE `user_contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_contacts`
--

INSERT INTO `user_contacts` (`id`, `user_id`, `name`, `phone`, `relation`, `created_at`, `updated_at`) VALUES
(8, 13, 'Peter Petersen', '00 00 00 00', 'Uncle', '2022-11-23 17:09:44', '2022-11-23 17:09:44'),
(9, 20, 'Martine Larsen', '(+45) 21 81 75 67', 'Kone', '2022-12-16 11:17:24', '2022-12-31 14:43:06'),
(10, 24, 'Katrine Larsen', '40 30 97 29', 'Kone', '2022-12-26 21:05:50', '2022-12-26 21:05:50'),
(11, 25, 'Kristina Okkels', '29 45 12 32', 'Kone', '2022-12-26 21:17:14', '2022-12-26 21:17:14'),
(12, 26, 'Mette Friis Ahrendt', '23 46 34 48', 'Mor', '2022-12-26 21:22:55', '2022-12-26 21:22:55'),
(13, 27, 'Niels Jørgen Hansen', '56 65 62 33', 'Far', '2022-12-26 21:31:39', '2022-12-26 21:31:39'),
(14, 27, 'Niels Jørgen Hansen', '40 83 92 75', 'Far (mobil)', '2022-12-26 21:32:01', '2022-12-26 21:32:01'),
(15, 28, 'Benny Stensdal', '20 78 60 67', 'Far', '2022-12-26 21:37:11', '2022-12-26 21:37:11'),
(16, 29, 'Bettina Grønkjær', '25 54 17 14', 'Kæreste', '2022-12-26 21:40:43', '2022-12-26 21:40:43'),
(17, 30, 'Tami Christensen', '30 74 01 58', '.', '2022-12-26 21:46:07', '2022-12-26 21:46:07'),
(18, 31, 'Maria M. Jensen', '?', 'Kone', '2022-12-26 21:53:51', '2022-12-26 21:53:51'),
(19, 32, 'Anniesette Knoth', '26 20 39 31', '.', '2022-12-27 10:51:20', '2022-12-27 10:51:20'),
(20, 33, 'Christel Rydahl Rasmussen', '26 85 61 16', 'Kone', '2022-12-27 11:21:22', '2022-12-27 11:21:22'),
(21, 34, 'Sofie Andersen', '30 25 67 90', 'Kone', '2022-12-27 12:07:14', '2022-12-27 12:07:14'),
(22, 35, 'Olivia Agerbo', '61 79 27 39', 'Kæreste', '2022-12-27 12:19:17', '2022-12-27 12:19:17'),
(23, 36, 'Pia Madsen', '60 65 32 53', 'Mor', '2022-12-27 12:29:53', '2022-12-27 12:29:53'),
(24, 37, 'Monica Skade', '60 60 26 50', 'Søster', '2022-12-27 12:37:32', '2022-12-27 12:37:32'),
(25, 38, 'Sanni Lykkegaard Madsen', '61 70 01 97', 'Kone', '2022-12-27 12:47:58', '2022-12-27 12:47:58'),
(26, 39, 'Asta Hjort', '28 78 05 02', 'Kone', '2022-12-27 12:54:15', '2022-12-27 12:54:15'),
(27, 40, 'Sabine Trouman Vested', '21 40 47 17', 'Kone', '2022-12-27 13:07:47', '2022-12-27 13:07:47'),
(28, 41, 'Nicoline Kruhøffer', '31 55 69 62', 'Kone', '2022-12-27 13:14:01', '2022-12-27 13:14:01'),
(29, 42, 'Stine Grættrup', '42 46 48 41', 'Kæreste', '2022-12-27 13:23:36', '2022-12-27 13:23:36'),
(30, 43, 'Selma Ülker', '26 12 98 58', '.', '2022-12-27 13:29:38', '2022-12-27 13:29:38'),
(31, 45, 'Susanne Hacke-Jershøj', '25 55 48 42', 'Mor', '2022-12-27 13:41:40', '2022-12-27 13:41:40'),
(32, 46, 'Peder Ersgaard', '31 54 30 09', 'Mand', '2022-12-27 13:50:37', '2022-12-27 13:50:45'),
(33, 47, 'Vinnie Helmerik', '93 56 66 77', 'Kone', '2022-12-27 14:00:02', '2022-12-27 14:00:02'),
(34, 48, 'Heidi Klæbel', '61 67 17 36', '.', '2022-12-27 15:02:21', '2022-12-27 15:02:21'),
(37, 49, 'Camilla Steemann Rudolph', '28 47 08 97', 'Kone', '2022-12-27 16:06:19', '2022-12-27 16:06:19'),
(38, 51, 'Ulrich Jensen', '40 88 83 88', 'Mand', '2022-12-27 16:38:01', '2022-12-27 16:38:01'),
(39, 52, 'Ulrikke', '22747432', 'Kæreste', '2022-12-27 16:54:44', '2022-12-27 16:54:44'),
(40, 53, 'Mia Rasmussen', '20 97 50 29', 'Kæreste', '2022-12-27 17:00:54', '2022-12-27 17:00:54'),
(41, 53, 'Mogens Opstrup', '29 82 17 94', 'Far', '2022-12-27 17:01:11', '2022-12-27 17:01:11'),
(42, 56, 'Pernille Rygaard', '20 76 25 22', 'Kone', '2022-12-28 14:22:29', '2022-12-28 14:22:29'),
(43, 57, 'Trine', '25 55 48 42', 'Kæreste', '2022-12-28 15:22:40', '2022-12-28 15:22:40'),
(44, 58, 'Line Györkös', '25 60 93 76', 'Kone', '2022-12-28 15:27:07', '2022-12-28 15:27:07'),
(45, 59, 'Pernille K. Jespersen', '22 42 81 58', 'Kone', '2022-12-28 15:33:04', '2022-12-28 15:33:04'),
(46, 19, 'Maria Ewers Hagedorn', '23 86 04 16', 'Kone', '2022-12-29 15:37:14', '2022-12-29 15:37:14'),
(47, 60, 'Carsten', '29 31 31 17', NULL, '2022-12-29 15:42:32', '2022-12-29 15:42:32'),
(48, 61, 'Janne Bøger', '(+45) 28 70 26 74', 'Kone', '2022-12-30 06:42:54', '2022-12-30 06:42:54'),
(49, 62, 'Nicolai Brodersen', '(+45) 53 54 10 06', 'Mand', '2022-12-30 08:58:36', '2022-12-30 08:58:36'),
(50, 63, 'Marie W. Jacobsen', '(+45) 61 46 05 82', 'Kone', '2022-12-30 09:07:54', '2022-12-30 09:07:54'),
(51, 64, 'Hans Mathiesen', '(+45) 24 88 08 06', 'Mand', '2022-12-31 09:47:10', '2022-12-31 09:47:10'),
(52, 65, 'Fie Vestergaard', '(+45) 28 71 43 46', NULL, '2022-12-31 10:08:46', '2022-12-31 10:08:46'),
(53, 66, 'Michael Ahler', '(+45) 31 41 96 91', NULL, '2022-12-31 10:19:15', '2022-12-31 10:19:15'),
(54, 67, 'Karrin Asmussen', '(+45) 23 31 96 08', 'Kone', '2022-12-31 10:27:45', '2022-12-31 10:27:45'),
(55, 68, 'Sarah Holm Jakobsen', '(+45) 20 64 16 05', 'Datter', '2022-12-31 10:31:30', '2022-12-31 10:31:30'),
(56, 70, 'Kurt Jensen', '(+45) 20 23 24 51', NULL, '2022-12-31 10:58:28', '2022-12-31 10:58:28'),
(57, 71, 'Helen Kjeldsen', '(+45) 29 46 14 91', 'Mor', '2022-12-31 11:05:32', '2022-12-31 11:05:32'),
(58, 72, 'Bente Buhl', '(+45) 30 32 67 45', 'Mor', '2022-12-31 11:12:27', '2022-12-31 11:12:27'),
(59, 73, 'Gitte Fruergaard', '(+45) 25 79 09 90', NULL, '2022-12-31 11:32:56', '2022-12-31 11:32:56'),
(60, 74, 'Olivia Rohde Bjerregaard', '(+45) 28 45 01 83', NULL, '2022-12-31 11:52:16', '2022-12-31 11:52:16'),
(61, 75, 'Hans Andersen', '(+45) 40 17 22 81', NULL, '2022-12-31 12:06:06', '2022-12-31 12:06:06'),
(62, 76, 'Rasmus Thorn', '(+45) 22 57 83 58', NULL, '2022-12-31 12:12:56', '2022-12-31 12:12:56'),
(63, 77, 'Kaj Verner', '(+45) 22 24 56 69', 'Far', '2022-12-31 12:21:42', '2022-12-31 12:21:42'),
(64, 78, 'Ole Laulund', '(+45) 21 27 50 05', NULL, '2022-12-31 12:28:27', '2022-12-31 12:28:27'),
(65, 80, 'Jan', '(+45) 22 42 60 11', 'Mand', '2022-12-31 12:41:20', '2022-12-31 12:41:20'),
(66, 82, 'Jens Malling Nielsen', '(+45) 61 19 14 78', 'Far', '2022-12-31 12:57:00', '2022-12-31 12:57:00'),
(67, 83, 'Flemming Bo Hedeager', '(+45) 20 94 54 79', 'Mand', '2022-12-31 13:02:47', '2022-12-31 13:02:47'),
(68, 84, 'Thomas Raavig', '(+45) 30 91 18 00', NULL, '2022-12-31 13:07:37', '2022-12-31 13:07:37'),
(69, 85, 'Søren Nygaard Hansen', '(+45) 25 31 84 81', 'Mand', '2022-12-31 13:11:17', '2022-12-31 13:11:17'),
(70, 86, 'Tina', '(+45) 25 56 05 59', 'Kone', '2022-12-31 13:16:07', '2022-12-31 13:16:07'),
(71, 87, 'Hjalte Baltersen', '(+45) 22 28 19 57', NULL, '2022-12-31 13:20:04', '2022-12-31 13:20:04'),
(72, 12, 'Christoffer Juul Zweidorff', '(+45) 91 45 35 35', 'Bror', '2022-12-31 13:31:14', '2022-12-31 13:31:14'),
(73, 12, 'Daniel Juul Zweidorff', '(+45) 22 97 07 00', 'Bror', '2022-12-31 13:31:50', '2022-12-31 13:31:50'),
(74, 20, 'Mathias A. Larsen', '(+45) 22 40 40 81', 'Bror', '2022-12-31 14:42:56', '2022-12-31 14:42:56'),
(75, 20, 'Marcus A. Larsen', '(+45) 21 22 24 11', 'Bror', '2022-12-31 14:43:33', '2022-12-31 14:43:33'),
(76, 12, 'Martine Jacobsen', '(+45) 61 86 38 64', NULL, '2022-12-31 14:45:10', '2022-12-31 14:45:10'),
(77, 89, 'Line Høst', '(+45) 22 67 42 72', 'Kone', '2023-01-07 08:04:04', '2023-01-07 08:04:04'),
(78, 90, 'Henrik Christensen', '(+45) 42 77 03 24', 'Far', '2023-01-07 08:06:46', '2023-01-07 08:06:46'),
(79, 91, 'Hanne Rothe', '(+45) 50 77 10 48', 'Mor', '2023-01-07 08:09:09', '2023-01-07 08:09:09'),
(80, 92, 'Ulf Nørulf', '(+45) 20 49 51 98', 'Far', '2023-01-07 08:12:16', '2023-01-07 08:12:16'),
(81, 93, 'Helene Poulsen', '(+45) 41 44 20 93', 'Mor', '2023-01-07 08:14:27', '2023-01-07 08:14:27'),
(82, 94, 'Allan Clemmesen', '(+45 )30 65 15 78', 'Far', '2023-01-07 08:16:16', '2023-01-07 08:16:16'),
(83, 117, 'Randi', '60226461', 'Søster', '2023-04-02 20:47:06', '2023-04-02 20:47:06'),
(84, 119, 'Diane Babor', '(+45) 26 44 23 59', 'Hustro', '2023-04-04 14:21:30', '2023-04-04 14:21:30'),
(85, 121, 'Anette Mortensen', '(+45) 42 21 68 79', 'Hustro', '2023-04-09 14:01:49', '2023-04-09 14:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`id`, `user_id`, `title`, `date`, `expiry`, `document`, `created_at`, `updated_at`) VALUES
(4, 13, 'Course in first aid - level 2', '2022-11-03', '2023-11-03', '', '2022-11-02 12:45:06', '2022-11-20 10:25:06'),
(8, 13, 'Quick test 111', '2022-11-27', '2022-12-11', 'document-1669049787.pdf', '2022-11-21 20:54:11', '2022-11-21 20:56:27'),
(9, 26, 'Autorisation - Sygeplejerske', '2018-06-19', NULL, 'document-1672089913.pdf', '2022-12-26 21:25:13', '2022-12-26 21:25:48'),
(10, 12, 'Førstehjælpsinstruktør', '2022-10-06', '2027-10-06', 'document-1672496906.pdf', '2022-12-31 14:28:26', '2022-12-31 14:28:26'),
(11, 12, 'Autorisationsbevis - Spl (DK)', '2019-01-17', NULL, 'document-1672497341.pdf', '2022-12-31 14:35:41', '2022-12-31 14:35:41'),
(12, 12, 'Autorisationsbevis - Spl (SE)', '2019-06-13', NULL, 'document-1672497377.pdf', '2022-12-31 14:36:17', '2022-12-31 14:36:17'),
(13, 12, 'Voluptas dicta totam', '2017-08-25', '2018-12-05', 'document-1672932902.jpg', '2023-01-05 15:35:02', '2023-01-05 15:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visibility` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_documents`
--

INSERT INTO `user_documents` (`id`, `admin_id`, `user_id`, `title`, `document`, `visibility`, `status`, `read_at`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 'fdsadsasfdsasfasdf', 'CX3VYFJ6-6B83-FAZX-9WA6-HWZT2XFJ3ME0.pdf', 'Hidden', 'UnRead', NULL, '2022-10-07 15:25:59', '2022-10-23 15:28:28'),
(7, 1, 12, 'Dette er en test', 'LOYGP2MK-OW3H-X2RA-801L-XZ8WS6OKDB5E.pdf', 'Hidden', 'UnRead', NULL, '2022-10-22 21:11:59', '2022-10-22 21:11:59'),
(11, 12, 19, 'Timerapport - Deltaplan', 'SL3EHIX4-OZKT-LT95-OX4K-YE2ON3CH5MIV.pdf', 'Hidden', 'UnRead', NULL, '2022-12-29 15:46:35', '2022-12-29 15:46:35'),
(12, 12, 22, 'Timerapport - Deltaplan', 'C8LYZTDA-13LP-JLG2-CF37-367JIFPVN5HZ.pdf', 'Hidden', 'UnRead', NULL, '2022-12-29 15:50:32', '2022-12-29 15:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_equipment`
--

CREATE TABLE `user_equipment` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_equipment`
--

INSERT INTO `user_equipment` (`id`, `admin_id`, `user_id`, `name`, `note`, `status`, `created_at`, `updated_at`) VALUES
(7, 1, 1, 'Testing', 'ksksks', 'Returned', '2022-10-07 15:25:25', '2022-12-31 15:32:50'),
(13, 1, 12, 'Hurtig test', ':)', 'Returned', '2022-10-26 18:45:34', '2023-02-09 11:25:55'),
(14, 12, 22, 'Hurtig test', 'kasjdlaskjdlaksjdl', 'Provided', '2022-12-27 17:08:00', '2022-12-27 17:08:00'),
(15, 12, 20, 'jakke', 'stk. xl', 'Provided', '2023-01-07 07:18:48', '2023-01-07 07:18:48'),
(16, 12, 12, 'jakke', 'str XL', 'Provided', '2023-02-09 11:25:51', '2023-02-09 11:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `background`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Nødbehandler', '#daefed', '#028351', '2022-09-29 08:49:51', '2022-12-27 23:50:58'),
(2, 'First responder', '#dae7fb', '#0061f2', '2022-09-29 08:50:00', '2023-01-07 08:25:22'),
(3, 'Sygeplejerske', '#f1e0e3', '#e81500', '2022-09-29 08:50:09', '2022-10-08 05:36:31'),
(10, 'Læge', '#c00001', '#ffffff', '2022-10-01 06:42:56', '2022-10-08 05:38:41'),
(11, 'Ambulancebehandler', '#0070c0', '#ffffff', '2022-10-08 05:37:09', '2022-10-08 05:38:22'),
(12, 'Ambulanceassistent', '#319362', '#ffffff', '2022-10-08 05:37:33', '2022-10-08 05:38:11'),
(13, 'Paramediciner', '#000000', '#ffffff', '2022-10-08 05:39:30', '2022-10-08 05:39:30'),
(14, 'Anæstesisygeplejerske', '#fbe3e5', '#943634', '2022-10-08 05:40:48', '2022-10-08 05:40:48'),
(15, 'ST-redder', '#ebf854', '#000000', '2022-10-08 05:42:48', '2022-10-08 05:50:10'),
(16, 'Administration', '#d9d9d9', '#404040', '2022-10-08 05:43:59', '2022-10-08 05:44:16'),
(17, 'Førstehjælpsinstruktør', '#bababa', '#000000', '2022-12-27 11:10:46', '2022-12-27 11:10:46'),
(19, 'Dispatcher', '#d07a01', '#ffffff', '2022-12-31 13:22:36', '2022-12-31 13:22:36'),
(20, 'Livredder', '#ebe102', '#ee2524', '2023-01-02 15:30:32', '2023-01-02 15:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_licenses`
--

CREATE TABLE `user_licenses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `front_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_licenses`
--

INSERT INTO `user_licenses` (`id`, `user_id`, `type`, `expiry`, `number`, `category`, `front_image`, `back_image`, `created_at`, `updated_at`) VALUES
(4, 13, 'Kørekort', '2024-12-01', '886 555 00000000', 'B, C', 'license-front-1667379007.jpg', 'license-back-1667379007.jpg', '2022-11-02 12:50:07', '2022-11-21 19:51:55'),
(5, 13, 'Chaufførkort', '2026-11-18', '28282 82828 2882828', 'Liggende st.', 'license-front-1667379171.jpg', 'license-back-1667379171.jpg', '2022-11-02 12:52:51', '2022-11-21 19:52:25'),
(7, 20, 'Kørekort', '2023-04-24', '35060017', 'AM, B, C1, C, BE, C1E, CE, LK, TM', 'license-front-1671189780.jpg', 'license-back-1671189780.jpg', '2022-12-16 11:23:00', '2022-12-16 11:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

CREATE TABLE `user_locations` (
  `id` bigint UNSIGNED NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_locations`
--

INSERT INTO `user_locations` (`id`, `location`, `created_at`, `updated_at`) VALUES
(6, 'Region Hovedstaden', '2022-12-28 13:48:41', '2022-12-28 13:48:41'),
(7, 'Region Sjælland', '2022-12-28 13:48:48', '2022-12-28 13:48:48'),
(8, 'Region Syddanmark', '2022-12-28 13:49:46', '2022-12-28 13:49:46'),
(9, 'Region Midtjylland', '2022-12-28 13:49:54', '2022-12-28 13:49:54'),
(10, 'Region Nordjylland', '2022-12-28 13:50:02', '2022-12-28 13:50:02'),
(11, 'Nord-Als Svømmeklub', '2023-01-02 17:29:20', '2023-01-02 17:31:19'),
(12, 'Djurs Sommerland', '2023-01-02 17:29:33', '2023-01-02 17:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_notes`
--

CREATE TABLE `user_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_notes`
--

INSERT INTO `user_notes` (`id`, `admin_id`, `user_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(7, 1, 1, 'Test', '<p>kanlakdfnlkf</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>adsklfjalskfjl&aelig;ajksdf</p>', '2022-10-27 17:22:11', '2022-10-27 17:22:11'),
(9, 1, 1, 'asDS', '<p>daSDasdASDadsasefdgshfsdh</p>', '2022-10-27 18:16:09', '2022-10-27 18:16:09'),
(10, 1, 12, 'asd', '<p>asd</p>', '2022-10-27 19:26:57', '2022-10-27 19:26:57'),
(11, 12, 20, 'puha ha', '<p>kajfljafnajnsfljna</p>', '2023-01-07 07:18:29', '2023-01-07 07:18:29'),
(12, 12, 12, 'asjldasj', '<p>afdfdasfgafsgasgagaga</p>', '2023-02-09 11:25:33', '2023-02-09 11:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_information` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ice_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `who_update_status` int DEFAULT NULL,
  `work_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `co_line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_navn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday_cdr_control` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `email`, `password`, `phone`, `address`, `note`, `bank_information`, `ice_contact`, `employment_date`, `group_id`, `location_id`, `status`, `who_update_status`, `work_title`, `co_line`, `street_navn`, `street_no`, `street_level`, `po_code`, `city_name`, `country`, `start_date`, `end_date`, `type`, `birthday_cdr_control`, `profile_note`, `permissions`, `image`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(28, '(#3033) Ambulance', '3032@eventmedical.dk', '$2y$10$BtYp6tiKTt9OzZ4yrmpHruh.hCLV4qcJvKA.2c23eUuTrgRkONloW', NULL, NULL, NULL, 'CM 85 085', NULL, '2014-01-31', NULL, '7', 'Active', NULL, '750-3033', 'WDF63960513861670', 'Mercedes-benz Vito', '116 Cdi Aut 4x4', 'Personbil', NULL, 'Ambulancekørsel', 'Diesel', '1976-04-29', '1999-06-16', 'Illo nisi quis lauda', NULL, NULL, NULL, 'profile-1677275313.png', NULL, NULL, '2023-01-11 08:00:30', '2023-02-24 22:06:15'),
(29, '(#3031) Ambulance', '3031@eventmedical.dk', '$2y$10$WpJh1HLwAvQgaamP6ryJyeyG4xnoqvVyvSkbvtF9Kr5azYWlhq8dC', '.', NULL, NULL, 'CJ 81 971', NULL, '2007-11-19', NULL, '7', 'Active', NULL, '750-3031', 'WDB9066331S216925', 'Mercedes-benz Sprinter', '315 Cdi Aut', 'Personbil', NULL, 'Ambulancekørsel', 'Diesel', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1677274862.png', NULL, NULL, '2023-01-11 08:01:16', '2023-02-24 21:41:02'),
(30, '(#3034) Akutbil', 'ds@eventmedical.dk', '$2y$10$MRGFBqlJKOvoMt/9jmNzk.Vr6d3c.D1y1ctjegb/utcwY9YBs.1fi', NULL, NULL, NULL, 'CW 73 297', NULL, '2020-11-18', NULL, '12', 'Active', NULL, '750-3034', 'UJGU1LS32KV000960', 'Garia U21', 'L3', 'Varebil', '2019', 'Godstransport erhverv', 'El', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-1677275983.png', NULL, NULL, '2023-02-24 20:55:10', '2023-02-24 22:06:01'),
(31, '(#3035) Ambulance', '3035@eventmedical.dk', '$2y$10$YP/nFjsG0x1HQwOcV1jl7Ovacuafrk5b4W7FuEmUPMDmBdk7GCBGC', NULL, NULL, NULL, 'DL 81 223', NULL, '2015-07-24', NULL, '7', 'Active', NULL, '750-3035', 'WDB9066331P126492', 'Mercedes-benz Sprinter', '316 Cdi', 'Personbil', '2015', 'Ambulancekørsel', 'Diesel', '2022-04-11', '2024-04-18', 'Godkendt', NULL, NULL, NULL, 'profile-1680245644.png', NULL, NULL, '2023-03-31 06:52:52', '2023-03-31 06:57:02'),
(32, '(#3036) Ambulance', '3036@eventmedical.dk', '$2y$10$tpXrP41JvCfy.BvyXAQdv.mk5AdYOzDFhTnKvFXyKTRwPzk4mehx2', NULL, NULL, NULL, 'DL 81 224', NULL, '2015-06-12', NULL, '7', 'Active', NULL, '750-3036', 'WDB9066331P123102', 'Mercedes-benz Sprinter', '316 Cdi', 'Personbil', '2015', 'Ambulancekørsel', 'Diesel', '2022-04-08', '2023-04-11', 'Godkendt', NULL, NULL, NULL, 'profile-1680246045.png', NULL, NULL, '2023-03-31 07:00:11', '2023-03-31 07:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_assignments`
--

CREATE TABLE `vehicle_assignments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `co_line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_navn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `information` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_associateds`
--

CREATE TABLE `vehicle_associateds` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_banks`
--

CREATE TABLE `vehicle_banks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `payrol_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rit_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `swift_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_banks`
--

INSERT INTO `vehicle_banks` (`id`, `user_id`, `payrol_number`, `bank_name`, `rit_number`, `account_number`, `swift_number`, `created_at`, `updated_at`) VALUES
(1, 28, '108', 'Ferris Jefferson', '199', '789', '250', '2023-01-11 08:28:57', '2023-01-11 08:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_contacts`
--

CREATE TABLE `vehicle_contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_documents`
--

CREATE TABLE `vehicle_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visibility` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_mileages`
--

CREATE TABLE `vehicle_mileages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `who_has_updated` int NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mileage_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_mileages`
--

INSERT INTO `vehicle_mileages` (`id`, `user_id`, `who_has_updated`, `date`, `mileage_number`, `created_at`, `updated_at`) VALUES
(1, 29, 1, '2023-01-04', '100', '2023-01-18 15:05:43', '2023-01-18 15:05:43'),
(2, 29, 1, '2023-01-21', '50', '2023-01-18 15:12:18', '2023-01-18 15:12:18'),
(3, 29, 1, '2023-01-17', '10', '2023-01-18 16:12:53', '2023-01-18 16:12:53'),
(4, 28, 12, '2023-01-16', '425000', '2023-01-19 15:26:42', '2023-01-19 15:26:42'),
(5, 28, 12, '2023-01-13', '435435', '2023-01-19 15:26:56', '2023-01-19 15:26:56'),
(6, 28, 12, '2023-01-31', '345435345', '2023-01-19 15:27:12', '2023-01-19 15:27:12'),
(7, 28, 12, '2022-12-27', '345435345', '2023-01-19 15:27:20', '2023-01-19 15:27:20'),
(8, 32, 12, '2015-06-12', '0', '2023-03-31 07:03:57', '2023-03-31 07:03:57'),
(9, 32, 12, '2016-05-10', '29.000', '2023-03-31 07:04:19', '2023-03-31 07:04:19'),
(10, 32, 12, '2017-05-24', '95.000', '2023-03-31 07:04:36', '2023-03-31 07:04:36'),
(11, 32, 12, '2018-06-19', '188.000', '2023-03-31 07:04:55', '2023-03-31 07:04:55'),
(12, 32, 12, '2019-04-25', '313.000', '2023-03-31 07:05:14', '2023-03-31 07:05:14'),
(13, 32, 12, '2020-05-26', '412.000', '2023-03-31 07:05:25', '2023-03-31 07:05:25'),
(14, 32, 12, '2021-03-12', '437.000', '2023-03-31 07:05:48', '2023-03-31 07:05:48'),
(15, 32, 12, '2022-04-08', '485.000', '2023-03-31 07:06:03', '2023-03-31 07:06:03');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_notes`
--

CREATE TABLE `vehicle_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `customer_assignments`
--
ALTER TABLE `customer_assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_associateds`
--
ALTER TABLE `customer_associateds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_banks`
--
ALTER TABLE `customer_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_contacts`
--
ALTER TABLE `customer_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_documents`
--
ALTER TABLE `customer_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_notes`
--
ALTER TABLE `customer_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_status`
--
ALTER TABLE `document_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_status_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite_documents`
--
ALTER TABLE `favorite_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minisites`
--
ALTER TABLE `minisites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `not_working_schedules`
--
ALTER TABLE `not_working_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_applications`
--
ALTER TABLE `schedule_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_notes`
--
ALTER TABLE `schedule_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_associateds`
--
ALTER TABLE `user_associateds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_authorizations`
--
ALTER TABLE `user_authorizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_banks`
--
ALTER TABLE `user_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_documents_admin_id_foreign` (`admin_id`),
  ADD KEY `user_documents_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_equipment`
--
ALTER TABLE `user_equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_equipment_admin_id_foreign` (`admin_id`),
  ADD KEY `user_equipment_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_licenses`
--
ALTER TABLE `user_licenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notes`
--
ALTER TABLE `user_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_notes_admin_id_foreign` (`admin_id`),
  ADD KEY `user_notes_user_id_foreign` (`user_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicle_assignments`
--
ALTER TABLE `vehicle_assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_associateds`
--
ALTER TABLE `vehicle_associateds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_banks`
--
ALTER TABLE `vehicle_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_contacts`
--
ALTER TABLE `vehicle_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_mileages`
--
ALTER TABLE `vehicle_mileages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_notes`
--
ALTER TABLE `vehicle_notes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `customer_assignments`
--
ALTER TABLE `customer_assignments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customer_associateds`
--
ALTER TABLE `customer_associateds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_banks`
--
ALTER TABLE `customer_banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_contacts`
--
ALTER TABLE `customer_contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `customer_documents`
--
ALTER TABLE `customer_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_notes`
--
ALTER TABLE `customer_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `document_status`
--
ALTER TABLE `document_status`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite_documents`
--
ALTER TABLE `favorite_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `minisites`
--
ALTER TABLE `minisites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `not_working_schedules`
--
ALTER TABLE `not_working_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=384;

--
-- AUTO_INCREMENT for table `schedule_applications`
--
ALTER TABLE `schedule_applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule_notes`
--
ALTER TABLE `schedule_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `user_associateds`
--
ALTER TABLE `user_associateds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `user_authorizations`
--
ALTER TABLE `user_authorizations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_banks`
--
ALTER TABLE `user_banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `user_contacts`
--
ALTER TABLE `user_contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `user_courses`
--
ALTER TABLE `user_courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_equipment`
--
ALTER TABLE `user_equipment`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_licenses`
--
ALTER TABLE `user_licenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_notes`
--
ALTER TABLE `user_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `vehicle_assignments`
--
ALTER TABLE `vehicle_assignments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vehicle_associateds`
--
ALTER TABLE `vehicle_associateds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_banks`
--
ALTER TABLE `vehicle_banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_contacts`
--
ALTER TABLE `vehicle_contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_mileages`
--
ALTER TABLE `vehicle_mileages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vehicle_notes`
--
ALTER TABLE `vehicle_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `document_status`
--
ALTER TABLE `document_status`
  ADD CONSTRAINT `document_status_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD CONSTRAINT `user_documents_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `user_equipment`
--
ALTER TABLE `user_equipment`
  ADD CONSTRAINT `user_equipment_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_equipment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `user_notes`
--
ALTER TABLE `user_notes`
  ADD CONSTRAINT `user_notes_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
