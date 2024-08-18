SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';


INSERT IGNORE INTO `{application_reference}_files_files` (`id`, `sort_order`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `deleted_at`, `name`, `disk_id`, `folder_id`, `extension`, `size`, `mime_type`, `entry_id`, `entry_type`, `keywords`, `height`, `width`, `alt_text`, `title`, `caption`, `description`, `str_id`) VALUES
(100003442, 516, '2023-05-26 08:50:21', 1, '2023-05-26 08:50:21', 1, NULL, 'marketx_banner1.png', 1, 1, 'png', 239350, 'image/png', NULL, 'Anomaly\\Streams\\Platform\\Model\\Files\\FilesImagesEntryModel', NULL, '380', '980', NULL, NULL, NULL, NULL, 'Ux3uKqdzcD5CfLNguDFDXhzA'),
(100003443, 517, '2023-05-26 08:50:31', 1, '2023-05-26 08:50:31', 1, NULL, 'marketx_banner2.png', 1, 1, 'png', 420755, 'image/png', NULL, 'Anomaly\\Streams\\Platform\\Model\\Files\\FilesImagesEntryModel', NULL, '380', '980', NULL, NULL, NULL, NULL, 'DrQ0atNA4qcKyymR5IwhAzre'),
(100003444, 518, '2023-05-26 08:50:40', 1, '2023-05-26 08:50:40', 1, NULL, 'marketx_banner3.png', 1, 1, 'png', 335900, 'image/png', NULL, 'Anomaly\\Streams\\Platform\\Model\\Files\\FilesImagesEntryModel', NULL, '380', '980', NULL, NULL, NULL, NULL, 'm5NX43Jtp8d1YApcb50sQH7z');

INSERT IGNORE INTO `{application_reference}_repeater_homepage_slider` (`id`, `sort_order`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`) VALUES
(1, 1, '2023-05-26 06:56:30', 1, '2023-05-26 06:56:30', 1),
(2, 2, '2023-05-26 06:56:30', 1, '2023-05-26 06:56:30', 1),
(3, 3, '2023-05-26 06:56:30', 1, '2023-05-26 06:56:30', 1);


INSERT IGNORE INTO `{application_reference}_repeater_homepage_slider_translations` (`id`, `entry_id`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `locale`, `slider_image_id`) VALUES
(1, 1, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'ar', NULL),
(2, 1, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'en', 100003442),
(3, 1, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'fr', NULL),
(4, 1, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'el', NULL),
(5, 1, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'it', NULL),
(6, 1, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'fa', NULL),
(7, 1, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'pt', NULL),
(8, 1, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'ru', NULL),
(9, 1, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'es', NULL),
(10, 1, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'tr', 100003442),
(11, 1, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'de', NULL),
(12, 2, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'ar', NULL),
(13, 2, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'en', 100003443),
(14, 2, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'fr', NULL),
(15, 2, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'el', NULL),
(16, 2, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'it', NULL),
(17, 2, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'fa', NULL),
(18, 2, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'pt', NULL),
(19, 2, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'ru', NULL),
(20, 2, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'es', NULL),
(21, 2, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'tr', 100003443),
(22, 2, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'de', NULL),
(23, 3, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'ar', NULL),
(24, 3, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'en', 100003444),
(25, 3, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'fr', NULL),
(26, 3, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'el', NULL),
(27, 3, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'it', NULL),
(28, 3, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'fa', NULL),
(29, 3, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'pt', NULL),
(30, 3, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'ru', NULL),
(31, 3, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'es', NULL),
(32, 3, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'tr', 100003444),
(33, 3, '2023-05-26 06:56:30', NULL, '2023-05-26 06:56:30', 1, 'de', NULL);


INSERT IGNORE INTO `{application_reference}_pages_default_pages_homepage_banner_slider` (`id`, `entry_id`, `related_id`, `sort_order`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 1),
(3, 1, 3, 2);

COMMIT;


