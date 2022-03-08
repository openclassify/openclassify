-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2019 at 12:18 PM
-- Server version: 10.3.11-MariaDB
-- PHP Version: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `celep`
--

--
-- Dumping data for table `{application_reference}_location_cities`
--

INSERT INTO `{application_reference}_location_cities` (`id`, `sort_order`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `slug`, `parent_country_id`, `order`) VALUES
(1, 6, '2019-01-31 10:09:32', NULL, NULL, NULL, 'adana', 212, NULL),
(2, 7, '2019-01-31 10:09:32', NULL, NULL, NULL, 'adiyaman', 212, NULL),
(3, 8, '2019-01-31 10:09:32', NULL, NULL, NULL, 'afyonkarahisar', 212, NULL),
(4, 9, '2019-01-31 10:09:32', NULL, NULL, NULL, 'agri', 212, NULL),
(5, 10, '2019-01-31 10:09:32', NULL, NULL, NULL, 'amasya', 212, NULL),
(6, 3, '2019-01-31 10:09:32', NULL, NULL, NULL, 'ankara', 212, NULL),
(7, 5, '2019-01-31 10:09:32', NULL, NULL, NULL, 'antalya', 212, NULL),
(8, 8, '2019-01-31 10:09:32', NULL, NULL, NULL, 'artvin', 212, NULL),
(9, 9, '2019-01-31 10:09:32', NULL, NULL, NULL, 'aydin', 212, NULL),
(10, 10, '2019-01-31 10:09:32', NULL, NULL, NULL, 'balikesir', 212, NULL),
(11, 11, '2019-01-31 10:09:32', NULL, NULL, NULL, 'bilecik', 212, NULL),
(12, 12, '2019-01-31 10:09:32', NULL, NULL, NULL, 'bingol', 212, NULL),
(13, 13, '2019-01-31 10:09:32', NULL, NULL, NULL, 'bitlis', 212, NULL),
(14, 14, '2019-01-31 10:09:32', NULL, NULL, NULL, 'bolu', 212, NULL),
(15, 15, '2019-01-31 10:09:32', NULL, NULL, NULL, 'burdur', 212, NULL),
(16, 16, '2019-01-31 10:09:32', NULL, NULL, NULL, 'bursa', 212, NULL),
(17, 17, '2019-01-31 10:09:32', NULL, NULL, NULL, 'canakkale', 212, NULL),
(18, 18, '2019-01-31 10:09:32', NULL, NULL, NULL, 'cankiri', 212, NULL),
(19, 19, '2019-01-31 10:09:32', NULL, NULL, NULL, 'corum', 212, NULL),
(20, 20, '2019-01-31 10:09:32', NULL, NULL, NULL, 'denizli', 212, NULL),
(21, 21, '2019-01-31 10:09:32', NULL, NULL, NULL, 'diyarbakir', 212, NULL),
(22, 22, '2019-01-31 10:09:32', NULL, NULL, NULL, 'edirne', 212, NULL),
(23, 23, '2019-01-31 10:09:32', NULL, NULL, NULL, 'elazig', 212, NULL),
(24, 24, '2019-01-31 10:09:32', NULL, NULL, NULL, 'erzincan', 212, NULL),
(25, 25, '2019-01-31 10:09:32', NULL, NULL, NULL, 'erzurum', 212, NULL),
(26, 26, '2019-01-31 10:09:32', NULL, NULL, NULL, 'eskisehir', 212, NULL),
(27, 27, '2019-01-31 10:09:32', NULL, NULL, NULL, 'gaziantep', 212, NULL),
(28, 28, '2019-01-31 10:09:32', NULL, NULL, NULL, 'giresun', 212, NULL),
(29, 29, '2019-01-31 10:09:32', NULL, NULL, NULL, 'gumushane', 212, NULL),
(30, 30, '2019-01-31 10:09:32', NULL, NULL, NULL, 'hakkari', 212, NULL),
(31, 31, '2019-01-31 10:09:32', NULL, NULL, NULL, 'hatay', 212, NULL),
(32, 32, '2019-01-31 10:09:32', NULL, NULL, NULL, 'isparta', 212, NULL),
(33, 33, '2019-01-31 10:09:32', NULL, NULL, NULL, 'mersin', 212, NULL),
(34, 1, '2019-01-31 10:09:32', NULL, NULL, NULL, 'istanbul-avr', 212, NULL),
(35, 4, '2019-01-31 10:09:32', NULL, NULL, NULL, 'izmir', 212, NULL),
(36, 37, '2019-01-31 10:09:32', NULL, NULL, NULL, 'kars', 212, NULL),
(37, 38, '2019-01-31 10:09:32', NULL, NULL, NULL, 'kastamonu', 212, NULL),
(38, 39, '2019-01-31 10:09:32', NULL, NULL, NULL, 'kayseri', 212, NULL),
(39, 40, '2019-01-31 10:09:32', NULL, NULL, NULL, 'kirklareli', 212, NULL),
(40, 41, '2019-01-31 10:09:32', NULL, NULL, NULL, 'kirsehir', 212, NULL),
(41, 42, '2019-01-31 10:09:32', NULL, NULL, NULL, 'kocaeli', 212, NULL),
(42, 43, '2019-01-31 10:09:32', NULL, NULL, NULL, 'konya', 212, NULL),
(43, 44, '2019-01-31 10:09:32', NULL, NULL, NULL, 'kutahya', 212, NULL),
(44, 45, '2019-01-31 10:09:32', NULL, NULL, NULL, 'malatya', 212, NULL),
(45, 46, '2019-01-31 10:09:32', NULL, NULL, NULL, 'manisa', 212, NULL),
(46, 47, '2019-01-31 10:09:32', NULL, NULL, NULL, 'kahramanmaras', 212, NULL),
(47, 48, '2019-01-31 10:09:32', NULL, NULL, NULL, 'mardin', 212, NULL),
(48, 49, '2019-01-31 10:09:32', NULL, NULL, NULL, 'mugla', 212, NULL),
(49, 50, '2019-01-31 10:09:32', NULL, NULL, NULL, 'mus', 212, NULL),
(50, 51, '2019-01-31 10:09:32', NULL, NULL, NULL, 'nevsehir', 212, NULL),
(51, 52, '2019-01-31 10:09:32', NULL, NULL, NULL, 'nigde', 212, NULL),
(52, 53, '2019-01-31 10:09:32', NULL, NULL, NULL, 'ordu', 212, NULL),
(53, 54, '2019-01-31 10:09:32', NULL, NULL, NULL, 'rize', 212, NULL),
(54, 55, '2019-01-31 10:09:32', NULL, NULL, NULL, 'sakarya', 212, NULL),
(55, 56, '2019-01-31 10:09:32', NULL, NULL, NULL, 'samsun', 212, NULL),
(56, 57, '2019-01-31 10:09:32', NULL, NULL, NULL, 'siirt', 212, NULL),
(57, 58, '2019-01-31 10:09:32', NULL, NULL, NULL, 'sinop', 212, NULL),
(58, 59, '2019-01-31 10:09:32', NULL, NULL, NULL, 'sivas', 212, NULL),
(59, 60, '2019-01-31 10:09:32', NULL, NULL, NULL, 'tekirdag', 212, NULL),
(60, 61, '2019-01-31 10:09:32', NULL, NULL, NULL, 'tokat', 212, NULL),
(61, 62, '2019-01-31 10:09:32', NULL, NULL, NULL, 'trabzon', 212, NULL),
(62, 63, '2019-01-31 10:09:32', NULL, NULL, NULL, 'tunceli', 212, NULL),
(63, 64, '2019-01-31 10:09:32', NULL, NULL, NULL, 'sanliurfa', 212, NULL),
(64, 65, '2019-01-31 10:09:32', NULL, NULL, NULL, 'usak', 212, NULL),
(65, 66, '2019-01-31 10:09:32', NULL, NULL, NULL, 'van', 212, NULL),
(66, 67, '2019-01-31 10:09:32', NULL, NULL, NULL, 'yozgat', 212, NULL),
(67, 68, '2019-01-31 10:09:32', NULL, NULL, NULL, 'zonguldak', 212, NULL),
(68, 69, '2019-01-31 10:09:32', NULL, NULL, NULL, 'aksaray', 212, NULL),
(69, 70, '2019-01-31 10:09:32', NULL, NULL, NULL, 'bayburt', 212, NULL),
(70, 71, '2019-01-31 10:09:32', NULL, NULL, NULL, 'karaman', 212, NULL),
(71, 72, '2019-01-31 10:09:32', NULL, NULL, NULL, 'kirikkale', 212, NULL),
(72, 73, '2019-01-31 10:09:32', NULL, NULL, NULL, 'batman', 212, NULL),
(73, 74, '2019-01-31 10:09:32', NULL, NULL, NULL, 'sirnak', 212, NULL),
(74, 75, '2019-01-31 10:09:32', NULL, NULL, NULL, 'bartin', 212, NULL),
(75, 76, '2019-01-31 10:09:32', NULL, NULL, NULL, 'ardahan', 212, NULL),
(76, 77, '2019-01-31 10:09:32', NULL, NULL, NULL, 'igdir', 212, NULL),
(77, 78, '2019-01-31 10:09:32', NULL, NULL, NULL, 'yalova', 212, NULL),
(78, 79, '2019-01-31 10:09:32', NULL, NULL, NULL, 'karabuk', 212, NULL),
(79, 80, '2019-01-31 10:09:32', NULL, NULL, NULL, 'kilis', 212, NULL),
(80, 81, '2019-01-31 10:09:32', NULL, NULL, NULL, 'osmaniye', 212, NULL),
(81, 82, '2019-01-31 10:09:32', NULL, NULL, NULL, 'duzce', 212, NULL),
(99, 2, '2019-01-31 10:09:32', NULL, NULL, NULL, 'istanbul-asya', 212, NULL);

--
-- Dumping data for table `{application_reference}_location_cities_translations`
--

INSERT INTO `{application_reference}_location_cities_translations` (`id`, `entry_id`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `locale`, `name`) VALUES
(1, 1, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Adana'),
(2, 2, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Adıyaman'),
(3, 3, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Afyonkarahisar'),
(4, 4, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Ağrı'),
(5, 5, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Amasya'),
(6, 6, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Ankara'),
(7, 7, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Antalya'),
(8, 8, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Artvin'),
(9, 9, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Aydın'),
(10, 10, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Balıkesir'),
(11, 11, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Bilecik'),
(12, 12, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Bingöl'),
(13, 13, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Bitlis'),
(14, 14, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Bolu'),
(15, 15, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Burdur'),
(16, 16, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Bursa'),
(17, 17, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Çanakkale'),
(18, 18, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Çankırı'),
(19, 19, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Çorum'),
(20, 20, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Denizli'),
(21, 21, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Diyarbakır'),
(22, 22, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Edirne'),
(23, 23, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Elazığ'),
(24, 24, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Erzincan'),
(25, 25, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Erzurum'),
(26, 26, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Eskişehir'),
(27, 27, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Gaziantep'),
(28, 28, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Giresun'),
(29, 29, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Gümüşhane'),
(30, 30, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Hakkari'),
(31, 31, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Hatay'),
(32, 32, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Isparta'),
(33, 33, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Mersin'),
(34, 34, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'İstanbul (Avr)'),
(35, 35, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'İzmir'),
(36, 36, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Kars'),
(37, 37, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Kastamonu'),
(38, 38, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Kayseri'),
(39, 39, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Kırklareli'),
(40, 40, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Kırşehir'),
(41, 41, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Kocaeli'),
(42, 42, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Konya'),
(43, 43, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Kütahya'),
(44, 44, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Malatya'),
(45, 45, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Manisa'),
(46, 46, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Kahramanmaraş'),
(47, 47, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Mardin'),
(48, 48, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Muğla'),
(49, 49, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Muş'),
(50, 50, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Nevşehir'),
(51, 51, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Niğde'),
(52, 52, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Ordu'),
(53, 53, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Rize'),
(54, 54, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Sakarya'),
(55, 55, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Samsun'),
(56, 56, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Siirt'),
(57, 57, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Sinop'),
(58, 58, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Sivas'),
(59, 59, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Tekirdağ'),
(60, 60, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Tokat'),
(61, 61, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Trabzon'),
(62, 62, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Tunceli'),
(63, 63, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Şanlıurfa'),
(64, 64, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Uşak'),
(65, 65, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Van'),
(66, 66, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Yozgat'),
(67, 67, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Zonguldak'),
(68, 68, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Aksaray'),
(69, 69, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Bayburt'),
(70, 70, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Karaman'),
(71, 71, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Kırıkkale'),
(72, 72, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Batman'),
(73, 73, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Şırnak'),
(74, 74, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Bartın'),
(75, 75, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Ardahan'),
(76, 76, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Iğdır'),
(77, 77, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Yalova'),
(78, 78, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Karabük'),
(79, 79, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Kilis'),
(80, 80, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Osmaniye'),
(81, 81, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'Düzce'),
(99, 99, '2019-01-31 10:11:53', NULL, NULL, NULL, 'en', 'İstanbul (Asya)');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
