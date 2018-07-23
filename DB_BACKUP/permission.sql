-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.19 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la table alternateeve. order_status
DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `order_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_name` varchar(191) NOT NULL,
  `customer_status` varchar(191) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `is_default` blob,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_status_id`),
  KEY `idx_created_by` (`created_by`),
  KEY `idx_sort_order` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Export de données de la table alternateeve.order_status : ~6 rows (environ)
DELETE FROM `order_status`;
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
INSERT INTO `order_status` (`order_status_id`, `status_name`, `customer_status`, `sort_order`, `is_default`, `created_by`, `created_at`, `updated_at`) VALUES
	(1, 'Ordered', 'Ordered', 1, _binary 0x31, NULL, '2017-05-23 16:03:43', '2017-05-23 16:03:43'),
	(2, 'Replied', 'Replied', 2, _binary 0x30, NULL, '2017-05-23 16:03:43', '2017-05-23 16:03:43'),
	(3, 'Negative', 'Negative', 3, _binary 0x30, NULL, NULL, NULL),
	(4, 'Selected', 'Selected', 4, _binary 0x30, NULL, NULL, NULL),
	(5, 'Finished', 'Finished', 5, _binary 0x30, NULL, NULL, NULL),
	(6, 'Canceled', 'Canceled', 0, _binary 0x30, 1, '2017-09-16 17:20:54', '2017-09-16 17:20:54');
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;

-- Export de la structure de la table clickee. permission
DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(191) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `route` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- Export de données de la table clickee.permission : ~35 rows (environ)
DELETE FROM `permission`;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` (`permission_id`, `module_name`, `parent_id`, `route`) VALUES
	(1, 'Dashboard', NULL, 'dashboard,profile'),
	(3, 'Content', NULL, NULL),
	(4, 'Account', NULL, NULL),
	(5, 'Communications', NULL, NULL),
	(6, 'Statistics', NULL, NULL),
	(7, 'Sales', NULL, NULL),
	(10, 'Category Manager', 40, 'category,save_category,update_category,edit_category,delete_category'),
	(11, 'Brand Manager', 40, 'brand.index,brand.create,brand.edit'),
	(12, 'Attribute', 40, 'attribute,create_attribute,edit_attribute'),
	(13, 'Attribute Set', 40, 'attribute_set,create_attribute_set,edit_attribute_set'),
	(15, 'Page Manager', 3, 'page.index,page.create,page.edit'),
	(16, 'Email/SMS Template', 39, 'email-template.index,email-template.create,email-template.edit'),
	(18, 'Slider Manager', 3, 'banner.index,banner.create,banner.edit,slider'),
	(19, 'Customer', 4, 'customer.index,customer.create,customer.edit'),
	(20, 'Merchant', 4, 'store.index,store.create,store.edit'),
	(21, 'Admin system', 4, 'administrator,add_administrator,edit_administrator'),
	(22, 'Role manager', 4, 'role.index,role.create,role.edit'),
	(25, 'Radio', 5, 'radio.index,radio.create,radio.edit'),
	(26, 'Sales', 6, 'product_billed'),
	(27, 'Finance', 6, NULL),
	(29, 'Ongoing', 45, 'orders,orders_detail'),
	(30, 'Completed', 45, 'orders,orders_detail'),
	(31, 'Special Ask', 45, 'orders'),
	(32, 'Status Manager', 7, 'order-status.index,order-status.create,order-status.edit'),
	(33, 'Blog Management', NULL, NULL),
	(34, 'Blog Category', 33, 'blog-category.index,blog-category.create,blog-category.edit'),
	(35, 'Blog Post', 33, 'blog.index,blog.create,blog.edit'),
	(36, 'FAQ Manager', 3, 'faq.index,faq.create,faq.edit'),
	(39, 'System', NULL, ''),
	(40, 'Catalogue', NULL, NULL),
	(42, 'Products On Home', 3, 'special-product.index,special-product.create,special-product.edit'),
	(43, 'Epartner Image', 39, 'epartner.index,epartner.create,epartner.edit'),
	(44, 'Meta & OG', 39, 'setting_list,update_setting'),
	(45, 'All orders', 7, NULL),
	(46, 'Brand Tag', 40, 'brand_tag,brand_save_tag_french');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
