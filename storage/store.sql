SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

INSERT IGNORE INTO `{application_reference}_store_store` (`id`, `sort_order`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `user_id`, `slug`, `summary`, `detailed_description`, `land_phone`, `address`, `category`, `country_id`, `city`, `email`, `web_site`, `gold_supplier`, `facebook`, `instagram`, `twitter`, `file_id`, `store_banner_id`, `iban_number`, `status`, `tax_number`, `tax_administration`, `district_id`, `gsm_phone`, `lat`, `lng`, `verified`, `has_domain`) VALUES
(1, 1, '2020-10-26 06:50:53', 1, '2021-03-08 08:34:56', 4, 1, 'arslantas_teknoloji_as', NULL, NULL, '0500 000 00 00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.', NULL, 212, NULL, NULL, NULL, 0, NULL, NULL, NULL, 99999569, NULL, NULL, 'approved', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, 2, '2020-10-26 06:56:19', 1, '2021-03-08 08:27:13', 4, 1, 'sony', NULL, NULL, '00000000000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.', NULL, 106, NULL, NULL, NULL, 0, NULL, NULL, NULL, 99999570, NULL, NULL, 'approved', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(3, 3, '2020-10-26 06:59:53', 1, '2021-03-08 08:28:03', 4, 1, 'pizza_hut', NULL, NULL, '0000000000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.', NULL, 221, NULL, NULL, NULL, 0, NULL, NULL, NULL, 99999571, NULL, NULL, 'approved', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(4, 4, '2020-10-26 07:04:40', 1, '2021-03-08 08:29:33', 4, 1, 'nestle', NULL, NULL, '+41781234567', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.', NULL, 201, NULL, NULL, NULL, 0, NULL, NULL, NULL, 99999572, NULL, NULL, 'approved', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(5, 5, '2020-10-26 07:53:30', 1, '2021-03-08 08:42:49', 4, 1, 'plog_electronics', NULL, NULL, '+491521513215', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, \r\n auctor a sapien.Nam eu neque vulputate diam rhoncus faucibus.Curabitur quis varius libero.Lorem.Lorem ipsum dolor sit amet, \r\n consectetur adipiscing elit.Quisque sapien velit, aliquet eget commodo nec, \r\n auctor a sapien.Nam eu neque vulputate diam rhoncus faucibus.Curabitur quis varius libero.Lorem.', NULL, 79, NULL, NULL, NULL, 0, NULL, NULL, NULL, 99999573, NULL, NULL, 'approved', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

INSERT IGNORE INTO `{application_reference}_store_store_translations` (`id`, `entry_id`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `locale`, `name`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(3, 1, '2021-03-08 08:25:21', NULL, '2021-03-08 08:34:56', 4, 'en', 'Arslantaş Teknoloji AŞ', NULL, NULL, 'a:0:{}'),
(15, 2, '2021-03-08 08:27:13', NULL, '2021-03-08 08:27:13', 4, 'en', 'İnovasyon Yazılım', NULL, NULL, 'a:0:{}'),
(27, 3, '2021-03-08 08:28:03', NULL, '2021-03-08 08:28:03', 4, 'en', 'Inteley', NULL, NULL, 'a:0:{}'),
(39, 4, '2021-03-08 08:29:33', NULL, '2021-03-08 08:29:33', 4, 'en', 'Avitec', NULL, NULL, 'a:0:{}'),
(51, 5, '2021-03-08 08:42:49', NULL, '2021-03-08 08:42:49', 4, 'en', 'Plog Electronics', NULL, NULL, 'a:0:{}');

INSERT IGNORE INTO `{application_reference}_files_files` (`id`, `sort_order`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `deleted_at`, `name`, `disk_id`, `folder_id`, `extension`, `size`, `mime_type`, `entry_id`, `entry_type`, `keywords`, `height`, `width`, `alt_text`, `title`, `caption`, `description`, `str_id`) VALUES
(99999574, 893, '2021-03-08 08:46:59', 4, '2021-03-08 08:58:58', 4, NULL, 'store_slider_1.jpg', 1, 1, 'jpg', 154177, 'image/jpeg', NULL, 'Anomaly\\Streams\\Platform\\Model\\Files\\FilesImagesEntryModel', NULL, '352', '833', NULL, NULL, NULL, NULL, '2sNN7ruq3CmuEwN6jsjdRfMN'),
(99999573, 892, '2021-03-08 08:42:24', 4, '2021-03-08 08:42:24', 4, NULL, '1615192943195_son_magazalar5.jpg', 1, 1, 'jpg', 33687, 'image/jpeg', NULL, 'Anomaly\\Streams\\Platform\\Model\\Files\\FilesImagesEntryModel', NULL, '400', '700', NULL, NULL, NULL, NULL, 'ZZs2WU3BwLkfROIQ9SR5Dock'),
(99999572, 891, '2021-03-08 08:28:49', 4, '2021-03-08 08:28:49', 4, NULL, '1615192128455_son_magazalar4.png', 1, 1, 'png', 63990, 'image/png', NULL, 'Anomaly\\Streams\\Platform\\Model\\Files\\FilesImagesEntryModel', NULL, '400', '700', NULL, NULL, NULL, NULL, 'tsx6NiLD253n6MUlQkFuIf1K'),
(99999571, 890, '2021-03-08 08:27:43', 4, '2021-03-08 08:27:43', 4, NULL, '1615192062391_son_magazalar3.png', 1, 1, 'png', 74708, 'image/png', NULL, 'Anomaly\\Streams\\Platform\\Model\\Files\\FilesImagesEntryModel', NULL, '400', '700', NULL, NULL, NULL, NULL, 'apReHNDy6FXlUf1dIEtHx01a'),
(99999570, 889, '2021-03-08 08:26:48', 4, '2021-03-08 08:26:48', 4, NULL, '1615192007216_son_magazalar2.png', 1, 1, 'png', 100240, 'image/png', NULL, 'Anomaly\\Streams\\Platform\\Model\\Files\\FilesImagesEntryModel', NULL, '400', '700', NULL, NULL, NULL, NULL, 'SMCR3Et9X2XYtYIDt0MwnWTM'),
(99999569, 888, '2021-03-08 08:24:36', 4, '2021-03-08 08:24:36', 4, NULL, '1615191874905_son_magazalar1.png', 1, 1, 'png', 77558, 'image/png', NULL, 'Anomaly\\Streams\\Platform\\Model\\Files\\FilesImagesEntryModel', NULL, '400', '700', NULL, NULL, NULL, NULL, 'Gl7BVV9QGtDDyeYRYbKMM3nm');



INSERT IGNORE INTO `{application_reference}_store_thumb_slider` (`id`, `sort_order`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `slider_id`, `url`) VALUES
(3, 1, '2021-03-08 08:59:03', 4, '2021-03-08 08:59:03', 4, 9999574, NULL);
COMMIT;
