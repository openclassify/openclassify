SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


INSERT INTO `default_settings_settings` (`created_at`,`key`, `value`) VALUES
('2019-07-15 06:48:46', 'streams::date_format', 'j F, Y'),
('2019-07-15 06:48:46', 'streams::time_format', 'H:i'),
('2019-07-15 06:48:46', 'streams::name', 'PHP Classifieds software'),
('2019-07-15 06:48:46', 'streams::description', 'OpenClassify is modular and most advanced open source classified platform build with Laravel.Use it in real estate classifieds, auto, e-commerce and other ...'),
('2019-07-15 06:48:46', 'streams::standard_theme', 'visiosoft.theme.base'),
('2019-07-15 06:48:46', 'streams::admin_theme', 'visiosoft.theme.defaultadmin'),
('2019-07-15 06:48:46', 'streams::enabled_locales', 'a:11:{i:0;s:2:\"en\";i:1;s:2:\"fa\";i:2;s:2:\"ar\";i:3;s:2:\"el\";i:4;s:2:\"es\";i:5;s:2:\"fr\";i:6;s:2:\"it\";i:7;s:2:\"nl\";i:8;s:2:\"pt\";i:9;s:2:\"ru\";i:10;s:2:\"tr\";}');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
