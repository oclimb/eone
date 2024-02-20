/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - eone
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`eone` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `eone`;

/*Table structure for table `authority` */

DROP TABLE IF EXISTS `authority`;

CREATE TABLE `authority` (
  `authority_id` int(11) NOT NULL AUTO_INCREMENT,
  `authority_des` text DEFAULT NULL,
  PRIMARY KEY (`authority_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `authority` */

insert  into `authority`(`authority_id`,`authority_des`) values 
(1,'E-ONE');

/*Table structure for table `content` */

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_name` varchar(64) DEFAULT NULL,
  `file_path` varchar(256) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `duration` decimal(10,0) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `order` double DEFAULT NULL,
  `upload_type` int(11) DEFAULT 0,
  PRIMARY KEY (`content_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `content` */

/*Table structure for table `course` */

DROP TABLE IF EXISTS `course`;

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(64) DEFAULT NULL,
  `course_des` longtext DEFAULT NULL,
  `img` varchar(128) DEFAULT NULL,
  `course_fee` decimal(10,0) DEFAULT NULL,
  `course_fee_display` varchar(30) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `video` varchar(128) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `course_order` int(11) DEFAULT 10000,
  PRIMARY KEY (`course_id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `course_category` (`category_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `course` */

/*Table structure for table `course_category` */

DROP TABLE IF EXISTS `course_category`;

CREATE TABLE `course_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `course_category` */

/*Table structure for table `course_content` */

DROP TABLE IF EXISTS `course_content`;

CREATE TABLE `course_content` (
  `course_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  KEY `content_id` (`content_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `course_content_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`),
  CONSTRAINT `course_content_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `course_content` */

/*Table structure for table `evaluation` */

DROP TABLE IF EXISTS `evaluation`;

CREATE TABLE `evaluation` (
  `evaluation_id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluation_des` varchar(20) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`evaluation_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `evaluation` */

/*Table structure for table `lecurer_course` */

DROP TABLE IF EXISTS `lecurer_course`;

CREATE TABLE `lecurer_course` (
  `lecturer_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  KEY `lecturer_id` (`lecturer_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `lecurer_course_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `lecurer_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `lecurer_course` */

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_des` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `level` */

insert  into `level`(`level_id`,`level_des`) values 
(1,'1'),
(2,'2'),
(3,'3'),
(4,'4'),
(5,'5'),
(6,'6'),
(7,'7'),
(8,'8'),
(9,'9'),
(10,'10'),
(11,'11'),
(12,'12'),
(13,'13'),
(14,'14'),
(15,'15'),
(16,'16'),
(17,'17'),
(18,'18'),
(19,'19'),
(20,'20'),
(21,'21'),
(22,'22'),
(23,'23');

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `student_id` (`student_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `payment` */

/*Table structure for table `payment_method` */

DROP TABLE IF EXISTS `payment_method`;

CREATE TABLE `payment_method` (
  `method_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `binance_id` varchar(255) DEFAULT NULL,
  `binance_email` varchar(255) DEFAULT NULL,
  `binance_address` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`method_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `payment_method` */

/*Table structure for table `payment_withdrawal` */

DROP TABLE IF EXISTS `payment_withdrawal`;

CREATE TABLE `payment_withdrawal` (
  `Withdrawal_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  `approval_date` datetime DEFAULT NULL,
  PRIMARY KEY (`Withdrawal_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `payment_withdrawal` */

/*Table structure for table `referral` */

DROP TABLE IF EXISTS `referral`;

CREATE TABLE `referral` (
  `referral_id` int(11) NOT NULL AUTO_INCREMENT,
  `referral_code` varchar(20) DEFAULT NULL,
  `no_of_refferrals` int(11) DEFAULT NULL,
  `ref_commission` decimal(10,0) DEFAULT NULL,
  `comm_paid` decimal(10,0) DEFAULT NULL,
  `comm_balance` decimal(10,0) DEFAULT NULL,
  `network_comm` decimal(10,0) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`referral_id`),
  UNIQUE KEY `refereal_code_unique` (`referral_code`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `referral_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `referral` */

insert  into `referral`(`referral_id`,`referral_code`,`no_of_refferrals`,`ref_commission`,`comm_paid`,`comm_balance`,`network_comm`,`user_id`) values 
(1,'EONE100A1000',0,0,0,0,0,1);

/*Table structure for table `reviews` */

DROP TABLE IF EXISTS `reviews`;

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `review` varchar(20) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `user_detail_ibfk_1` (`course_id`),
  CONSTRAINT `user_detail_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `reviews` */

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) DEFAULT NULL,
  `authority_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  KEY `authority_id` (`authority_id`),
  CONSTRAINT `role_ibfk_1` FOREIGN KEY (`authority_id`) REFERENCES `authority` (`authority_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `role` */

insert  into `role`(`role_id`,`role_name`,`authority_id`) values 
(1,'Admin',1),
(2,'Student',1),
(3,'Lecture',1);

/*Table structure for table `student_bouns` */

DROP TABLE IF EXISTS `student_bouns`;

CREATE TABLE `student_bouns` (
  `bouns_id` int(11) NOT NULL AUTO_INCREMENT,
  `bonus_ammount` double NOT NULL DEFAULT 0,
  `bonus_type` varchar(32) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `bonus_date` datetime DEFAULT NULL,
  `payment_status` int(11) DEFAULT 0,
  `payment_date` datetime DEFAULT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`bouns_id`),
  KEY `ibfk_1` (`user_id`),
  KEY `ibfk_2` (`course_id`),
  CONSTRAINT `ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `student_bouns` */

/*Table structure for table `student_course` */

DROP TABLE IF EXISTS `student_course`;

CREATE TABLE `student_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `enrol_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `payment_type` varchar(64) DEFAULT NULL,
  `approval_date` datetime DEFAULT NULL,
  `completed_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `student_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `student_course` */

/*Table structure for table `token_password` */

DROP TABLE IF EXISTS `token_password`;

CREATE TABLE `token_password` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_fork` (`user_id`),
  CONSTRAINT `user_id_fork` FOREIGN KEY (`user_id`) REFERENCES `user_detail` (`user_detail_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `token_password` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(256) DEFAULT NULL,
  `user_password` varchar(20) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  `isagreed` int(11) DEFAULT 0,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_username` (`user_name`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `user` */

insert  into `user`(`user_id`,`user_name`,`user_password`,`role_id`,`reg_date`,`isagreed`) values 
(1,'admin@admin.com','123456',1,'2023-08-01 20:48:36',0);

/*Table structure for table `user_detail` */

DROP TABLE IF EXISTS `user_detail`;

CREATE TABLE `user_detail` (
  `user_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `telephone_number` varchar(20) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `referral_id` int(11) DEFAULT NULL,
  `network_referral_id` int(11) DEFAULT NULL,
  `network_date` datetime DEFAULT NULL,
  `user_img` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`user_detail_id`),
  KEY `user_id` (`user_id`),
  KEY `level_id` (`level_id`),
  KEY `referral_id` (`referral_id`),
  KEY `user_detail_ibfk_5` (`network_referral_id`),
  CONSTRAINT `user_detail_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_detail_ibfk_3` FOREIGN KEY (`level_id`) REFERENCES `level` (`level_id`),
  CONSTRAINT `user_detail_ibfk_4` FOREIGN KEY (`referral_id`) REFERENCES `referral` (`referral_id`),
  CONSTRAINT `user_detail_ibfk_5` FOREIGN KEY (`network_referral_id`) REFERENCES `referral` (`referral_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `user_detail` */

insert  into `user_detail`(`user_detail_id`,`name`,`user_id`,`address`,`telephone_number`,`mobile_number`,`email`,`level_id`,`referral_id`,`network_referral_id`,`network_date`,`user_img`) values 
(3,'ADMIN',1,'','ada','ada','asdasd',NULL,1,NULL,'2023-12-01 12:21:10','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
