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

-- Export de la structure de la table a. order_item_request
DROP TABLE IF EXISTS `order_item_request`;
CREATE TABLE IF NOT EXISTS `order_item_request` (
  `order_item_request_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `message` varchar(191) DEFAULT NULL,
  `is_added_by` varchar(191) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_booked` int(11) NOT NULL,
  `is_canceled` int(11) NOT NULL DEFAULT '0',
  `available_type` tinyint(4) DEFAULT NULL,
  `available_time` varchar(191) DEFAULT NULL,
  `product_name` varchar(191) DEFAULT NULL,
  `product_link` varchar(191) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `booked_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`order_item_request_id`),
  KEY `idx_item_id` (`item_id`),
  KEY `idx_customer_id` (`customer_id`),
  KEY `idx_merchant_id` (`merchant_id`),
  KEY `idx_store_id` (`store_id`),
  KEY `idx_is_added_by` (`is_added_by`),
  KEY `idx_parent_id` (`parent_id`),
  KEY `idx_is_booked` (`is_booked`),
  KEY `idx_available_type` (`available_type`),
  KEY `idx_created_date` (`created_date`),
  KEY `idx_booked_date` (`booked_date`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

-- Export de données de la table a.order_item_request : ~3 rows (environ)
DELETE FROM `order_item_request`;
/*!40000 ALTER TABLE `order_item_request` DISABLE KEYS */;
INSERT INTO `order_item_request` (`order_item_request_id`, `item_id`, `customer_id`, `merchant_id`, `store_id`, `message`, `is_added_by`, `parent_id`, `is_booked`, `is_canceled`, `available_type`, `available_time`, `product_name`, `product_link`, `created_date`, `booked_date`) VALUES
	(114, 119, 91, 77, 11, NULL, 'merchant', NULL, 1, 0, 1, NULL, NULL, NULL, '2018-06-05 10:34:25', '2018-06-05 10:34:25'),
	(115, 118, 91, 77, 11, NULL, 'merchant', NULL, 1, 0, 1, NULL, NULL, NULL, '2018-06-05 10:34:19', '2018-06-05 10:34:19'),
	(116, 117, 91, 77, 11, NULL, 'merchant', NULL, 0, 1, 6, NULL, NULL, NULL, '2018-06-05 10:34:00', '2018-06-05 10:34:00'),
	(117, 120, 91, 77, 11, NULL, 'merchant', NULL, 1, 0, 1, NULL, NULL, NULL, '2018-06-05 10:34:25', '2018-06-05 10:34:25'),
	(118, 121, 91, 77, 11, NULL, 'merchant', NULL, 1, 0, 1, NULL, NULL, NULL, '2018-06-05 16:07:41', '2018-06-05 10:34:25'),
	(119, 122, 91, 77, 11, NULL, 'merchant', NULL, 1, 0, 1, NULL, NULL, NULL, '2018-06-05 16:07:41', '2018-06-05 10:34:25'),
	(120, 123, 91, 77, 11, NULL, 'merchant', NULL, 1, 0, 1, NULL, NULL, NULL, '2018-06-05 16:07:41', '2018-06-05 10:34:25');
/*!40000 ALTER TABLE `order_item_request` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
