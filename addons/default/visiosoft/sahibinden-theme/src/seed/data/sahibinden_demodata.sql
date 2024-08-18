SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

INSERT INTO `default_settings_settings` (`created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `key`, `value`) VALUES
('2020-09-25 11:10:13',	1,	'2020-09-25 11:10:13',	1,	'visiosoft.module.advs::latest-limit',	'24'),
('2020-09-25 11:10:14',	1,	'2020-09-25 11:10:14',	1,	'visiosoft.module.advs::popular_ads_limit',	'15'),
('2020-11-12 06:58:45', 1,  '2020-11-16 14:25:22',  1,  'streams::mail_driver', 'log'),
('2020-09-25 11:12:33', 1, '2021-02-26 07:15:24', 1, 'visiosoft.theme.sahibinden::home_bottom', '<p><img alt=\"Banner2\" src=\"/files/images/banner2.png\"></p>'),
('2020-09-25 11:12:33', 1, '2021-02-26 07:15:24', 1, 'visiosoft.theme.sahibinden::home_top_latestAds', '<p><img alt=\"Banner1\" src=\"/files/images/banner1.png\"></p>'),
('2020-09-25 11:12:33', 1, '2021-02-26 07:15:24', 1, 'visiosoft.theme.sahibinden::home_bottom_latestAds', '<p><img alt=\"Banner3\" src=\"/files/images/banner3.png\"></p>'),
('2020-09-25 11:12:33', 1, '2021-02-26 07:15:23', 1, 'visiosoft.theme.sahibinden::home_bottom_left_categories', '<p><img alt=\"Group 41701\" src=\"/files/images/Group_41701.png\"></p>'),
('2020-10-01 10:12:38', 1, '2021-02-26 07:15:21', 1, 'visiosoft.theme.sahibinden::banner_web', '1295')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `sort_order` = VALUES(`sort_order`), `created_at` = VALUES(`created_at`), `created_by_id` = VALUES(`created_by_id`), `updated_at` = VALUES(`updated_at`), `updated_by_id` = VALUES(`updated_by_id`), `key` = VALUES(`key`), `value` = VALUES(`value`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
