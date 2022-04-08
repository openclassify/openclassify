SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

INSERT INTO `{application_reference}_settings_settings` (`created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `key`, `value`) VALUES
('2019-07-15 06:48:46', 1, '2019-07-15 06:53:05', 1, 'streams::date_format', 'j F, Y'),
('2019-07-15 06:48:46', 1, '2019-07-15 06:53:05', 1, 'streams::time_format', 'H:i'),
('2019-07-15 06:48:46', 1, '2019-07-15 06:53:05', 1, 'streams::standard_theme', 'visiosoft.theme.base'),
('2019-07-15 06:48:46', 1, '2019-07-15 06:53:05', 1, 'streams::admin_theme', 'visiosoft.theme.defaultadmin'),
('2019-07-15 06:48:46', 1, '2019-07-15 06:53:05', 1, 'streams::enabled_locales', 'a:11:{i:0;s:2:\"en\";i:1;s:2:\"fa\";i:2;s:2:\"ar\";i:3;s:2:\"el\";i:4;s:2:\"es\";i:5;s:2:\"fr\";i:6;s:2:\"it\";i:7;s:2:\"nl\";i:8;s:2:\"pt\";i:9;s:2:\"ru\";i:10;s:2:\"tr\";}'),
('2020-09-25 11:10:13',	1,	'2020-09-25 11:10:13',	1,	'visiosoft.module.advs::latest-limit',	'24'),
('2020-09-25 11:10:14',	1,	'2020-09-25 11:10:14',	1,	'visiosoft.module.advs::popular_ads_limit',	'15'),
('2020-10-01 10:12:38',	1,	'2020-10-01 10:12:38',	1,	'visiosoft.theme.sahibinden::banner_web',	'462'),
('2020-09-25 11:12:33',	1,	'2020-10-01 15:22:19',	1,	'visiosoft.theme.sahibinden::home_bottom',	'<p><img alt=\"Home bottom\" src=\"/files/images/home_bottom.jpg\"></p>'),
('2020-09-25 11:12:33',	1,	'2020-10-01 15:11:10',	1,	'visiosoft.theme.sahibinden::home_bottom_left_categories',	'<p><img src=\"/files/images/home-bottom-left-categories.jpg\"></p>'),
('2020-09-25 11:12:33',	1,	'2020-10-01 15:11:10',	1,	'visiosoft.theme.sahibinden::home_top_latestAds',	'<p><img src=\"/files/images/home-top-latestads.jpg\"></p>'),
('2020-09-25 11:12:33',	1,	'2020-10-01 15:11:10',	1,	'visiosoft.theme.sahibinden::home_bottom_latestAds',	'<p><img alt=\"Home bottom latestads\" src=\"/files/images/home-bottom-latestads.jpg\"></p>'),
('2020-11-12 06:58:45', 1,  '2020-11-16 14:25:22',  1,  'streams::mail_driver', 'log')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `sort_order` = VALUES(`sort_order`), `created_at` = VALUES(`created_at`), `created_by_id` = VALUES(`created_by_id`), `updated_at` = VALUES(`updated_at`), `updated_by_id` = VALUES(`updated_by_id`), `key` = VALUES(`key`), `value` = VALUES(`value`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;