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

-- Export de la structure de la table a. order_item
DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `product_name` varchar(191) NOT NULL,
  `product_sku` varchar(191) DEFAULT NULL,
  `product_url` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `discount` decimal(12,2) NOT NULL,
  `final_price` decimal(12,2) NOT NULL,
  `attribute_sku` varchar(191) DEFAULT NULL,
  `attribute_price` decimal(12,2) NOT NULL,
  `tax` decimal(12,2) NOT NULL,
  `radius` int(11) DEFAULT NULL,
  `zip_code` varchar(191) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `order_status_id` int(11) DEFAULT NULL,
  `order_item_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_item_id`),
  KEY `idx_order_id` (`order_id`),
  KEY `idx_product_id` (`product_id`),
  KEY `idx_brand_id` (`brand_id`),
  KEY `idx_zip_code` (`zip_code`),
  KEY `idx_radius` (`radius`),
  KEY `idx_order_status_id` (`order_status_id`),
  CONSTRAINT `order_item_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

-- Export de données de la table a.order_item : ~3 rows (environ)
DELETE FROM `order_item`;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `product_name`, `product_sku`, `product_url`, `quantity`, `price`, `discount`, `final_price`, `attribute_sku`, `attribute_price`, `tax`, `radius`, `zip_code`, `brand_id`, `order_status_id`, `order_item_date`) VALUES
	(117, 125, 4383, 'Capichon chinois', 'mon code bar', '{"sys_url_rewrite_id":5251,"request_url":"capichon-chinois","target_url":"capichon-chinois","type":"2","target_id":4383}', 1, 120.00, 0.00, 120.00, '', 0.00, 0.00, 50, '65000', 3991, 6, '2018-06-05 10:34:00'),
	(118, 125, 4384, 'Pantalon coupé', 'bar code', '{"sys_url_rewrite_id":5252,"request_url":"pantalon-coup\\u00e9","target_url":"pantalon-coup\\u00e9","type":"2","target_id":4384}', 1, 30.00, 0.00, 30.00, '', 0.00, 0.00, 50, '65000', 3991, 5, '2018-06-05 10:34:19'),
	(119, 125, 4387, 'Pyjama rose', '44465656', '{"sys_url_rewrite_id":5255,"request_url":"pyjama-rose","target_url":"pyjama-rose","type":"2","target_id":4387}', 1, 45.00, 0.00, 45.00, '', 0.00, 0.00, 50, '65000', 3991, 5, '2018-06-05 10:34:25'),
	(120, 125, 4387, 'Pyjama rose', '44465656', '{"sys_url_rewrite_id":5255,"request_url":"pyjama-rose","target_url":"pyjama-rose","type":"2","target_id":4387}', 1, 45.00, 0.00, 45.00, '', 0.00, 0.00, 50, '65000', 3991, 5, '2018-05-05 10:34:25'),
	(121, 125, 4387, 'Pyjama rose', '44465656', '{"sys_url_rewrite_id":5255,"request_url":"pyjama-rose","target_url":"pyjama-rose","type":"2","target_id":4387}', 1, 45.00, 0.00, 45.00, '', 0.00, 0.00, 50, '65000', 3991, 5, '2018-05-05 10:34:25'),
	(122, 125, 4387, 'Pyjama rose', '44465656', '{"sys_url_rewrite_id":5255,"request_url":"pyjama-rose","target_url":"pyjama-rose","type":"2","target_id":4387}', 1, 45.00, 0.00, 45.00, '', 0.00, 0.00, 50, '65000', 3991, 5, '2018-04-05 10:34:25'),
	(123, 125, 4387, 'Pyjama rose', '44465656', '{"sys_url_rewrite_id":5255,"request_url":"pyjama-rose","target_url":"pyjama-rose","type":"2","target_id":4387}', 1, 45.00, 0.00, 45.00, '', 0.00, 0.00, 50, '65000', 3991, 5, '2018-04-05 10:34:25');
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
