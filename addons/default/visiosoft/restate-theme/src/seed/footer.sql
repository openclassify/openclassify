SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


INSERT IGNORE INTO `{application_reference}_navigation_menus` (`id`, `sort_order`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `deleted_at`, `slug`) VALUES
(22, 22, '2020-05-09 18:10:42', 1, '2023-05-31 16:35:04', 1805, NULL, 'about_us'),
(23, 23, '2020-05-09 18:10:42', 1, '2023-05-31 16:35:04', 1805, NULL, 'others'),
(24, 24, '2020-05-09 18:10:42', 1, '2023-05-31 16:35:04', 1805, NULL, 'our_services');



INSERT IGNORE INTO `{application_reference}_navigation_menus_translations` (`id`, `entry_id`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `locale`, `name`, `description`) VALUES
(1, 1, '2020-05-09 14:54:11', NULL, '2021-08-11 20:00:20', 1, 'en', 'Footer', 'This is the main footer menu.'),
(22, 22, '2020-05-09 18:10:42', NULL, '2023-03-28 10:05:38', 1, 'en', 'Company', NULL),
(23, 22, '2020-05-09 18:10:42', NULL, '2023-03-28 10:05:38', 1, 'tr', 'Kurumsal', NULL),
(24, 23, '2020-05-09 18:10:42', NULL, '2023-03-28 10:05:38', 1, 'en', 'Buy and Sell', NULL),
(25, 23, '2020-05-09 18:10:42', NULL, '2023-03-28 10:05:38', 1, 'tr', 'Al ve Sat', NULL),
(26, 24, '2020-05-09 18:10:42', NULL, '2023-03-28 10:05:38', 1, 'en', 'Quick Links', NULL),
(27, 24, '2020-05-09 18:10:42', NULL, '2023-03-28 10:05:38', 1, 'tr', 'Hızlı Ulaşım Linkleri', NULL);


INSERT IGNORE INTO `{application_reference}_url_link_type_urls` (`id`, `sort_order`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `url`) VALUES
(333, 333, '2023-07-13 12:09:02', 1, '2023-07-13 12:09:02', 1, '#'),
(334, 334, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(335, 335, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(336, 336, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(337, 337, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(338, 338, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(339, 339, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(340, 340, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(341, 341, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(342, 342, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(343, 343, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(344, 344, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(345, 345, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, 'register'),
(346, 346, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, 'login'),
(347, 347, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(348, 348, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#'),
(349, 349, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, '#');


INSERT IGNORE INTO `{application_reference}_url_link_type_urls_translations` (`id`, `entry_id`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `locale`, `title`, `description`) VALUES
(333, 333, '2023-07-13 12:09:02', NULL, '2023-07-13 12:09:02', 1, 'en', 'About Us', NULL),
(334, 333, '2023-07-13 12:09:02', NULL, '2023-07-13 12:09:02', 1, 'tr', 'Hakkımızda', NULL),
(335, 334, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Privacy Policy', NULL),
(336, 334, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Kişisel Verilerin Korunması', NULL),
(337, 335, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Franchise Agreement', NULL),
(338, 335, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Bayilik Sözleşmesi', NULL),
(339, 336, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Membership Agreement', NULL),
(340, 336, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Üyelik Sözleşmesi', NULL),
(341, 337, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Legal Terms', NULL),
(342, 337, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Hukuki Şartlar', NULL),
(343, 338, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Terms of Use', NULL),
(344, 338, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Kullanım Şartları', NULL),
(345, 339, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Flat For Sale', NULL),
(346, 339, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Satılık Daire', NULL),
(347, 340, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Flat For Rent', NULL),
(348, 340, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Kiralık Daire', NULL),
(349, 341, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Workplace For Sell', NULL),
(350, 341, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Satılık İşyeri', NULL),
(351, 342, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Workplace For Rent', NULL),
(352, 342, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Kiralık İşyeri', NULL),
(353, 343, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Villa For Sell', NULL),
(354, 343, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Satılık Villa', NULL),
(355, 344, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Villa For Rent', NULL),
(356, 344, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Kiralık Villa', NULL),
(357, 345, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Register', NULL),
(358, 345, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Kayıt Ol', NULL),
(359, 346, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Login', NULL),
(360, 346, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Giriş Yap', NULL),
(361, 347, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Real Estate Offices', NULL),
(362, 347, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Emlak Ofisler', NULL),
(363, 348, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Real Estate Blogs', NULL),
(364, 348, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Emlak Yazıları', NULL),
(365, 349, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'en', 'Real Estate Advertise', NULL),
(366, 349, '2023-07-13 12:09:38', NULL, '2023-07-13 12:09:38', 1, 'tr', 'Emlak İlanları', NULL);


INSERT IGNORE INTO `{application_reference}_navigation_links` (`id`, `sort_order`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `deleted_at`, `menu_id`, `type`, `entry_id`, `entry_type`, `target`, `class`, `parent_id`) VALUES
(333, 333, '2023-07-13 12:09:02', 1, '2023-07-13 12:09:02', 1, NULL, 22, 'anomaly.extension.url_link_type', 333, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(334, 334, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 22, 'anomaly.extension.url_link_type', 334, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(335, 335, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 22, 'anomaly.extension.url_link_type', 335, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(336, 336, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 22, 'anomaly.extension.url_link_type', 336, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(337, 337, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 22, 'anomaly.extension.url_link_type', 337, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(338, 338, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 22, 'anomaly.extension.url_link_type', 338, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(339, 339, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 23, 'anomaly.extension.url_link_type', 339, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(340, 340, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 23, 'anomaly.extension.url_link_type', 340, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(341, 341, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 23, 'anomaly.extension.url_link_type', 341, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(342, 342, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 23, 'anomaly.extension.url_link_type', 342, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(343, 343, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 23, 'anomaly.extension.url_link_type', 343, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(344, 344, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 23, 'anomaly.extension.url_link_type', 344, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(345, 345, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 24, 'anomaly.extension.url_link_type', 345, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(346, 346, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 24, 'anomaly.extension.url_link_type', 346, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(347, 347, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 24, 'anomaly.extension.url_link_type', 347, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(348, 348, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 24, 'anomaly.extension.url_link_type', 348, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL),
(349, 349, '2023-07-13 12:09:38', 1, '2023-07-13 12:09:38', 1, NULL, 24, 'anomaly.extension.url_link_type', 349, 'Anomaly\\UrlLinkTypeExtension\\UrlLinkTypeModel', '_self', NULL, NULL);



COMMIT;

