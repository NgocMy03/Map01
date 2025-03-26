-- CREATE DATABASE  IF NOT EXISTS `ct298` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
-- USE `ct298`;
-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: ct298
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `hoten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SDT` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lichsugiaodich` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `toadoGPS` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chitiet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_sdt_unique` (`SDT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `discounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chuongtrinhKM` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thoigianapdung` date NOT NULL,
  `mucgiamgia` enum('phantram','quatang') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'phantram',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES (1,'giảm giá','2025-02-27','phantram',NULL,NULL);
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history_of_purchases`
--

DROP TABLE IF EXISTS `history_of_purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `history_of_purchases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `soluong` int NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `history_of_purchases_customer_id_foreign` (`customer_id`),
  KEY `history_of_purchases_product_id_foreign` (`product_id`),
  CONSTRAINT `history_of_purchases_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `history_of_purchases_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history_of_purchases`
--

LOCK TABLES `history_of_purchases` WRITE;
/*!40000 ALTER TABLE `history_of_purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `history_of_purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ngaynhap` date NOT NULL,
  `thanhtien` decimal(10,2) NOT NULL,
  `ghichu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventories`
--

LOCK TABLES `inventories` WRITE;
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_details`
--

DROP TABLE IF EXISTS `inventory_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventory_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `soluongcungcap` int NOT NULL,
  `dongia` decimal(8,2) NOT NULL,
  `inventory_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventory_details_inventory_id_foreign` (`inventory_id`),
  KEY `inventory_details_product_id_foreign` (`product_id`),
  CONSTRAINT `inventory_details_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`),
  CONSTRAINT `inventory_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_details`
--

LOCK TABLES `inventory_details` WRITE;
/*!40000 ALTER TABLE `inventory_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `list_products`
--

DROP TABLE IF EXISTS `list_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `list_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `soluong` int NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `store_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gia` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `list_products_product_id_foreign` (`product_id`),
  KEY `list_products_store_id_foreign` (`store_id`),
  CONSTRAINT `list_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `list_products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `list_products`
--

LOCK TABLES `list_products` WRITE;
/*!40000 ALTER TABLE `list_products` DISABLE KEYS */;
INSERT INTO `list_products` VALUES (1,30,1,1,NULL,NULL,200.00),(2,30,2,2,NULL,NULL,250.00),(3,45,6,3,NULL,NULL,300.00),(4,12,12,13,'2025-03-07 04:15:12','2025-03-07 04:15:12',13000.00),(5,12,13,16,'2025-03-07 04:16:12','2025-03-07 04:16:12',12314.00),(6,1,14,3,'2025-03-07 04:33:03','2025-03-11 19:46:19',2000.00),(7,65,15,22,'2025-03-11 19:56:41','2025-03-11 19:56:41',30928.00);
/*!40000 ALTER TABLE `list_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_02_09_100718_create_customers_table',1),(6,'2025_02_09_100748_create_inventories_table',1),(7,'2025_02_09_100816_create_discounts_table',1),(8,'2025_02_09_101146_create_stores_table',1),(9,'2025_02_09_101235_create_products_table',1),(10,'2025_02_09_101334_create_history_of_purchases_table',1),(11,'2025_02_09_103327_create_inventory_details_table',1),(12,'2025_02_09_103541_create_staff_table',1),(13,'2025_02_09_103630_create_rates_table',1),(14,'2025_02_09_104030_create_list_products_table',1),(15,'2025_02_19_020222_create_schedules_table',2),(16,'2025_02_19_020231_create_schedule_details_table',2),(17,'2025_02_27_114014_modify_hinhanh_column_nullable_in_products_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinhanh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_discount_id_foreign` (`discount_id`),
  CONSTRAINT `products_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'pepsi','nước','bpt.png',1,NULL,NULL,'2025-02-27 05:43:09'),(2,'coca','nước','coca.jpg',1,NULL,'2025-02-27 05:37:42','2025-02-27 05:46:37'),(6,'koi mucho','snack','koi.png',1,NULL,'2025-03-07 02:34:44','2025-03-11 20:03:23'),(12,'fanta','nước ép','sprite.jpg',1,NULL,'2025-03-07 04:15:12','2025-03-07 04:15:12'),(13,'7up','nước','pepsi.jpg',1,NULL,'2025-03-07 04:16:12','2025-03-07 04:16:12'),(14,'cheetos','snack','cheetos.jpg',1,NULL,'2025-03-07 04:33:03','2025-03-11 19:49:22'),(15,'ostar','snack','ostar.png',1,NULL,'2025-03-11 19:56:41','2025-03-18 20:01:50');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `noidung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '5',
  `store_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rates_store_id_foreign` (`store_id`),
  KEY `rates_customer_id_foreign` (`customer_id`),
  CONSTRAINT `rates_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `rates_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rates`
--

LOCK TABLES `rates` WRITE;
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_details`
--

DROP TABLE IF EXISTS `schedule_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` bigint unsigned NOT NULL,
  `ngay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trangthai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedule_details_schedule_id_foreign` (`schedule_id`),
  KEY `schedule_details_staff_id_foreign` (`staff_id`),
  CONSTRAINT `schedule_details_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`),
  CONSTRAINT `schedule_details_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_details`
--

LOCK TABLES `schedule_details` WRITE;
/*!40000 ALTER TABLE `schedule_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ten` enum('Ca 1','Ca 2','Ca 3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ca 1',
  `thoigianbatdau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thoigianketthuc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gioitinh` tinyint NOT NULL,
  `namsinh` date NOT NULL,
  `chucvu` enum('Nhân viên bán hàng','Thu ngân','Quản lý cửa hàng') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nhân viên bán hàng',
  `thoigianlamviec` double(8,2) NOT NULL,
  `store_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_store_id_foreign` (`store_id`),
  CONSTRAINT `staff_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'Nguyen Van A',0,'2003-03-19','Nhân viên bán hàng',8.00,17,'2025-03-18 19:45:20','2025-03-18 20:43:57',NULL,'nva@gmail.com','$2y$10$TIGGLvwwYmoYCwz85U1Y.O9p5KL4ai6SPmgYQQc23z8zDSNKb8gjC',1);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SDT` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `toadoGPS` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinh` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (1,'Circle K 30/4','376 Đường 30 Tháng 4, Xuân Khánh, Ninh Kiều, Cần Thơ','19003110','10.02185450665188, 105.77039659612404','K.png',NULL,NULL),(2,'Circle K Hai Bà Trưng','128 Đường Hai Bà Trưng, Tân An, Ninh Kiều, Cần Thơ, Việt Nam','0292379801','10.031975760855456, 105.7879240083775','K.png',NULL,NULL),(3,'Circle K Lý Tự Trọng','3-5 Đ. Lý Tự Trọng, An Phú, Ninh Kiều, Cần Thơ, Việt Nam','0292394320','10.0342199061547, 105.77963204751619','K.png',NULL,NULL),(4,'Circle K Trần Văn Khéo','129 Trần Văn Khéo, Cái Khế, Ninh Kiều, Cần Thơ, Việt Nam','0292378012','10.046120857463459, 105.78633895974474','K.png',NULL,NULL),(5,'GS25 Nguyễn Tri Phương Cần Thơ','152 Đ. Nguyễn Tri Phương, Phường An Khánh, Ninh Kiều, Cần Thơ','19003110','10.042202150066233, 105.75501135139287','GS25.jpg',NULL,NULL),(6,'GS25 CMT8 Cần Thơ',' 65B Đ. Cách Mạng Tháng 8, Thới Bình, Ninh Kiều, Cần Thơ','0292-789-0','10.050822639266713, 105.77561071636309','GS25.jpg',NULL,NULL),(9,'WinMart+ Nguyễn Văn Cừ','291 Đ. Nguyễn Văn Cừ, Phường An Khánh, Ninh Kiều, Cần Thơ, Việt Nam','0292-012-3','10.032696631293348, 105.75308739130661','Win.png',NULL,NULL),(10,'Circle K Ngô Văn Sở','59 Đ. Ngô Văn Sở, Tân An, Ninh Kiều, Cần Thơ','19003110','10.034002187644276, 105.78516926643442','K.png',NULL,NULL),(11,'Circle K Nguyễn Văn Cừ','59 Đ. Nguyễn Văn Cừ, An Hoà, Ninh Kiều, Cần Thơ','19003110','10.050669303594805, 105.77262786660637','K.png',NULL,NULL),(12,'WinMart Xuân Khánh','209 Đ. 30 Tháng 4, Xuân Khánh, Ninh Kiều, Cần Thơ','0247106686','10.025047760592294, 105.77480169539734','Win.png',NULL,NULL),(13,'Circle K 166 Đường 3 tháng 2','166 Đ. 3 Tháng 2, Xuân Khánh, Ninh Kiều, Cần Thơ','19003110','10.024884725726793, 105.76794456140394','K.png',NULL,NULL),(14,'Circle K - Đại Học Cần Thơ','118 Đ. 3 Tháng 2, Xuân Khánh, Ninh Kiều, Cần Thơ','19003110','10.028963775903181, 105.77143418636857','K.png',NULL,NULL),(15,'GS25 Đường số 4 (Trần Hoàng Na)','Trần Hoàng Na, Đường số 4, Khu Dân Cư Cai Son, Đ. Trần Nam Phú, Bang, Ninh Kiều, Cần Thơ','0292-678-9','10.024557334587678, 105.75025720157436','GS25.jpg',NULL,NULL),(16,'Circle K bệnh viện Hoàn Mỹ Cần Thơ','20 Võ Nguyên Giáp, Phú Thứ, Cái Răng, Cần Thơ','19003110','10.006638717767126, 105.79949935764057','K.png',NULL,NULL),(17,'Circle K - Trần Chiên- ĐH Tây Đô','80C Trần Chiên, Lê Bình, Cái Răng, Cần Thơ','19003110','10.001210291994235, 105.75867436863398','K.png',NULL,NULL),(18,'GS25 Phố Ẩm Thực Hồ Búng Xáng','51C, Đ. Búng Xáng/khu vực/6 Đ. 3 Tháng 2, Xuân Khánh, Ninh Kiều, Cần Thơ','0292-334-5','10.025538813116555, 105.76633855145809','GS25.jpg',NULL,NULL),(19,'GS25 Lý Tự Trọng','44 Đ. Lý Tự Trọng, An Lạc, Ninh Kiều, Cần Thơ','0292-445-6','10.03344680426419, 105.78124084974097','GS25.jpg',NULL,NULL),(20,'GS25 Mậu Thân Cần Thơ','79A và 97, Đ. Mậu Thân, Ninh Kiều, Cần Thơ','0292-556-7','10.043274752638577, 105.76519277661001','GS25.jpg',NULL,NULL),(21,'Circle K 134A Đường 3 tháng 2','134a Đ. Lê Văn Thuấn, Hưng Lợi, Ninh Kiều, Cần Thơ, Việt Nam','19003110','10.018504230477674, 105.76195297676234','K.png',NULL,NULL),(22,'Circle K Trần Hưng Đạo','153 Đ. Trần Hưng Đạo, An Phú, Ninh Kiều, Cần Thơ, Việt Nam','19003110','10.035147819246875, 105.77556283560236','K.png',NULL,NULL),(23,'Circle K Mậu Thân','108A-108B Đ. Mậu Thân, An Phú, Ninh Kiều, Cần Thơ, Việt Nam','19003110','10.02990960560248, 105.77616695196275','K.png',NULL,NULL),(24,'Circle K Đại Lộ Hòa Bình','2QJJ+39W, Đ. 30/4, An Phú, Ninh Kiều, Cần Thơ, Việt Nam','19000010','10.030278911362569, 105.78097040626602','K.png',NULL,NULL),(25,'GS25 Nguyễn Văn Cừ','307 Đ. Nguyễn Văn Cừ, An Hòa, Ninh Kiều, Cần Thơ 90000, Việt Nam','00000000','10.046236491429502, 105.7681081711425','GS25.jpg',NULL,NULL),(26,'GS25 30 Tháng 4','552-554 Đ. 30 Tháng 4, Hưng Lợi, Ninh Kiều, Cần Thơ, Việt Nam','0931115396','10.016879426461367, 105.76493813556044','GS25.jpg',NULL,NULL),(27,'GS25 Trần Văn Trà','40 Đ. Trần Văn Trà, Phường, Cái Răng, Cần Thơ, Việt Nam','00000001','10.016893226459125, 105.78565915335147','GS25.jpg',NULL,NULL),(28,'GS25 ĐH Nam Cần Thơ','168 Nguyễn Văn Cừ Nối Dài, An Bình, Ninh Kiều, Cần Thơ, Việt Nam','00000002','10.007705555374004, 105.72168366439628','GS25.jpg',NULL,NULL),(29,'GS25 Trần Quang Diệu','160 Trần Quang Diệu, An Thới, Bình Thủy, Cần Thơ, Việt Nam','00000003','10.058553124577278, 105.76223769323214','GS25.jpg',NULL,NULL),(30,'GS25 74-76 Trần Văn Khéo','74-76 Trần Văn Khéo, Cái Khế, Ninh Kiều, Cần Thơ, Việt Nam','00000004','10.045316957458304, 105.78549458218731','GS25.jpg',NULL,NULL),(31,'GS25 - 65 Trần Chiên, ĐH Tây Đô','65 Trần Chiên, Lê Bình, Cái Răng, Cần Thơ 90000, Việt Nam','00000005','9.998497263561092, 105.76023989997833','GS25.jpg',NULL,NULL),(32,'GS25 Bệnh Viện Nhi Đồng','16 Nguyễn Văn Cừ Nối Dài, An Bình, Bình Thủy, Cần Thơ, Việt Nam','00000006','10.017118547925826, 105.73776753557127','GS25.jpg',NULL,NULL),(33,'WinMart Ninh Kiều','42 Đ. 30 Tháng 4, An Lạc, Ninh Kiều, Cần Thơ, Việt Nam','02926250646','10.030768253307844, 105.78078119997835','Win.png',NULL,NULL),(34,'WinMart+ 3 Tháng 2','216 Đ. 3 Tháng 2, Hưng Lợi, Ninh Kiều, Cần Thơ, Việt Nam','0932983044','10.022252595350613, 105.76512049997834','W.png',NULL,NULL),(35,'WinMart+ Trần Nam Phú','390 Đ. Trần Nam Phú, Phường An Khánh, Ninh Kiều, Cần Thơ, Việt Nam','00000008','10.035505735315997, 105.75775152021704','W.png',NULL,NULL),(36,'WinMart+ Nguyễn Văn Linh','404/12 KV3 Đ. Nguyễn Văn Linh, Hưng Lợi, Ninh Kiều, Cần Thơ, Việt Nam','0901791906','10.025743195009323, 105.75895976439627','W.png',NULL,NULL),(37,'WinMart Vincom Hùng Vương','2 Hùng Vương, Thới Bình, Ninh Kiều, Cần Thơ, Việt Nam','0914649699','10.045523851983406, 105.77949642881421','W.png',NULL,NULL),(38,'WinMart+ Đinh Tiên Hoàng','1B Đ. Đinh Tiên Hoàng, An Hội, Ninh Kiều, Cần Thơ, Việt Nam','18006968','10.043475463230894, 105.77933788218733','W.png',NULL,NULL),(39,'WinMart+ Nguyễn Văn Cừ Nối Dài','116-118, Nguyễn Văn Cừ Nối Dài, An Bình, Ninh Kiều, Cần Thơ, Việt Nam','0775333353','10.02195978435192, 105.74292936439628','W.png',NULL,NULL),(40,'WinMart+ KDC Hưng Phú 1','29-31 Đ. A3, KDC Hưng Phú 1, Cái Răng, Cần Thơ, Việt Nam','00000009','10.016302771948823, 105.78409025335147','W.png',NULL,NULL),(41,'WinMart+ Trần Hoàng Na','20 Đường Trần Hoàng Na, Hưng Thành, Cái Răng, Cần Thơ, Việt Nam','02471066866','10.002899121551591, 105.77244109997835','W.png',NULL,NULL),(42,'WinMart+ Trần Chiên','26 Trần Chiên, Lê Bình, Cái Răng, Cần Thơ, Việt Nam','00000010','9.995901429874154, 105.74919621776938','W.png',NULL,NULL),(43,'WinMart+ Hồ Búng Xáng','51D1 Đ.3/2, Xuân Khánh, Ninh Kiều, Cần Thơ, Việt Nam','02471066866','10.026349901180046, 105.76551972881421','W.png',NULL,NULL),(44,'WinMart+ Nguyễn Đệ','399 Đ. Nguyễn Đệ, An Hòa, Ninh Kiều, Cần Thơ, Việt Nam','02471066866','10.047997216038672, 105.76160803556046','W.png',NULL,NULL),(45,'WinMart+ Phạm Ngũ Lão','162/1 Đ. Phạm Ngũ Lão, An Nghiệp, Ninh Kiều, Cần Thơ, Việt Nam','02471066866','10.043608016576304, 105.77334648893354','W.png',NULL,NULL),(46,'WinMart+ Võ Văn Kiệt','38 Võ Văn Kiệt, An Hòa, Ninh Kiều, Cần Thơ, Việt Nam','02471066866','10.04520625747277, 105.7633369067246','W.png',NULL,NULL),(47,'WinMart+ Mạc Thiên Tích','81B/2 Đ. Mạc Thiên Tích, Xuân Khánh, Ninh Kiều, Cần Thơ, Việt Nam','02471066866','10.027991183418054, 105.77373199997834','W.png',NULL,NULL),(48,'WinMart+ 365/14 Nguyễn Văn Cừ','365/14 Đ. Nguyễn Văn Cừ, Phường An Khánh, Ninh Kiều, Cần Thơ, Việt Nam','02471066866','10.031337876872673, 105.75292918218732','W.png',NULL,NULL),(49,'WinMart+ 158 đường 30/4','158 Đ. 30/4, An Lạc, Ninh Kiều, Cần Thơ, Việt Nam','02471066866','10.028164053541373, 105.77827913985901','W.png',NULL,NULL),(50,'WinMart+ 163H-163H/7 Nguyễn Văn Cừ','163H-163H/7, Nguyễn Văn Cừ Nối Dài, Phường An Khánh, Ninh Kiều, Cần Thơ, Việt Nam','02471066866','10.038710540611678, 105.76018527114252','W.png',NULL,NULL),(51,'WinMart+ 303 Nguyễn Văn Linh','303 Đ. Nguyễn Văn Linh, Phường An Khánh, Ninh Kiều, Cần Thơ, Việt Nam','02471066866','10.034584152926243, 105.7475176663178','W.png',NULL,NULL),(52,'WinMart+ 119-121 Đề Thám','119-121 Đ. Đề Thám, Tân An, Ninh Kiều, Cần Thơ, Việt Nam','02471066866','10.03543255874906, 105.78113572881419','W.png',NULL,NULL),(53,'WinMart+ Đồng Văn Cống','131-133 Đ. Đồng Văn Cống, An Thới, Bình Thủy, Cần Thơ, Việt Nam','02471066866','10.053330038462763, 105.75665087359016','W.png',NULL,NULL),(54,'WinMart+ TT Phong Điền','31-33 Ấp Thị Tứ, Thị trấn Phong Điền, Phong Điền, Cần Thơ, Việt Nam','02471066866','9.997386422223808, 105.6729457177694','W.png',NULL,NULL),(55,'WinMart+ 83-85 Nguyễn Hiền','83-85 Đ. Nguyễn Hiền, Hưng Lợi, Ninh Kiều, Cần Thơ, Việt Nam','02471066866','10.023491666653625, 105.75665054660526','W.png',NULL,NULL);
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin123@gmail.com','2025-03-18 11:45:15','$2y$10$TIGGLvwwYmoYCwz85U1Y.O9p5KL4ai6SPmgYQQc23z8zDSNKb8gjC','UnIBxuvbecqhZ1MgTdjUS0N6COzu02bKoodxzNX1puWGm33fIeNDpd6m1yKp','2025-03-18 11:45:16','2025-03-18 11:45:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-19 10:46:22
