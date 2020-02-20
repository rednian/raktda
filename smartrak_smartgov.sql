/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : smartrak_smartgov

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2020-02-20 15:34:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for approval
-- ----------------------------
DROP TABLE IF EXISTS `approval`;
CREATE TABLE `approval` (
  `approval_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `inspection_id` int(11) DEFAULT NULL,
  `schedule_date_start` timestamp NULL DEFAULT NULL,
  `schedule_date_end` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`approval_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of approval
-- ----------------------------

-- ----------------------------
-- Table structure for approval_report
-- ----------------------------
DROP TABLE IF EXISTS `approval_report`;
CREATE TABLE `approval_report` (
  `approval_report_id` int(11) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `original` varchar(255) DEFAULT NULL,
  `approval_id` bigint(20) DEFAULT NULL,
  `approver_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`approval_report_id`),
  KEY `approval_id` (`approval_id`),
  KEY `approver_id` (`approver_id`),
  CONSTRAINT `approval_report_ibfk_1` FOREIGN KEY (`approval_id`) REFERENCES `approval` (`approval_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `approval_report_ibfk_2` FOREIGN KEY (`approver_id`) REFERENCES `approvers` (`approver_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of approval_report
-- ----------------------------

-- ----------------------------
-- Table structure for approvers
-- ----------------------------
DROP TABLE IF EXISTS `approvers`;
CREATE TABLE `approvers` (
  `approver_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `approval_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`approver_id`),
  KEY `approval_id` (`approval_id`),
  CONSTRAINT `approvers_ibfk_1` FOREIGN KEY (`approval_id`) REFERENCES `approval` (`approval_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of approvers
-- ----------------------------

-- ----------------------------
-- Table structure for approver_procedure
-- ----------------------------
DROP TABLE IF EXISTS `approver_procedure`;
CREATE TABLE `approver_procedure` (
  `approver_procedure_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `procedure_id` int(11) DEFAULT NULL,
  `duration` varchar(11) DEFAULT NULL,
  `order` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `required_check` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`approver_procedure_id`),
  KEY `approver_procedure_ibfk_1` (`procedure_id`),
  CONSTRAINT `approver_procedure_ibfk_1` FOREIGN KEY (`procedure_id`) REFERENCES `procedure` (`procedure_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of approver_procedure
-- ----------------------------
INSERT INTO `approver_procedure` VALUES ('1', '1', '1', '5', '2', '2019-08-18 17:54:43', null, null, '1');
INSERT INTO `approver_procedure` VALUES ('2', '4', '1', '5', '1', '2019-08-18 17:55:19', null, null, '0');

-- ----------------------------
-- Table structure for areas
-- ----------------------------
DROP TABLE IF EXISTS `areas`;
CREATE TABLE `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_en` varchar(255) DEFAULT NULL,
  `area_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `emirates_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emirates_id` (`emirates_id`),
  CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`emirates_id`) REFERENCES `emirates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of areas
-- ----------------------------
INSERT INTO `areas` VALUES ('1', 'Al Dafran', null, '1');
INSERT INTO `areas` VALUES ('2', 'Al Falah ', null, '1');
INSERT INTO `areas` VALUES ('3', 'Al Hosn', null, '1');
INSERT INTO `areas` VALUES ('4', 'Al Etihad', null, '1');
INSERT INTO `areas` VALUES ('5', 'Al Bustan', null, '2');
INSERT INTO `areas` VALUES ('6', 'Al Khakeel', null, '2');
INSERT INTO `areas` VALUES ('7', 'Al Mushairaf', null, '2');
INSERT INTO `areas` VALUES ('8', 'Al Nuaamiya', null, '2');
INSERT INTO `areas` VALUES ('9', 'Al Agbiyya', null, '8');
INSERT INTO `areas` VALUES ('10', 'Al Bateen', 'البطين', '8');
INSERT INTO `areas` VALUES ('11', 'Al Faqa', 'الفقه', '8');
INSERT INTO `areas` VALUES ('12', 'Al Jahli', 'الجاهلي', '8');
INSERT INTO `areas` VALUES ('13', 'Al Jimi', 'الجيمي', '8');
INSERT INTO `areas` VALUES ('14', 'Bur Dubai', 'بر دبي', '3');
INSERT INTO `areas` VALUES ('15', 'Deira', 'ديرة', '3');
INSERT INTO `areas` VALUES ('16', 'Jumeriah', 'جميرا', '3');
INSERT INTO `areas` VALUES ('17', 'Karama', 'الكرامة', '3');
INSERT INTO `areas` VALUES ('19', 'Al Gofra', 'الجفرة', '4');
INSERT INTO `areas` VALUES ('20', 'Bitnah', null, '4');
INSERT INTO `areas` VALUES ('21', 'Fazeel', 'فضيل', '4');
INSERT INTO `areas` VALUES ('22', 'Khor Fakkan', 'خورفكان', '4');
INSERT INTO `areas` VALUES ('23', 'Murshid', 'مرشد', '4');
INSERT INTO `areas` VALUES ('24', 'Al Fulayyah', 'الفلية', '5');
INSERT INTO `areas` VALUES ('25', 'Al Hamrah', 'الحمرا', '5');
INSERT INTO `areas` VALUES ('26', 'Al Jazirah', 'الجزيرة', '5');
INSERT INTO `areas` VALUES ('27', 'Digdagga', 'الدقدقة', '5');
INSERT INTO `areas` VALUES ('28', 'Abu Shagara', 'ابو شجاره', '6');
INSERT INTO `areas` VALUES ('29', 'Al Abar', 'العبار', '6');
INSERT INTO `areas` VALUES ('30', 'Al Dhaid', 'الذيد', '6');
INSERT INTO `areas` VALUES ('31', 'Al Falaj', 'الفلج', '6');
INSERT INTO `areas` VALUES ('32', 'Al Abreq A', 'الأبرق', '7');
INSERT INTO `areas` VALUES ('33', 'Al Hassan', 'الحسن', '7');
INSERT INTO `areas` VALUES ('34', 'Al Khor', 'الخور', '7');
INSERT INTO `areas` VALUES ('35', 'Al Mudar', 'المدار', '7');
INSERT INTO `areas` VALUES ('36', 'Al Darbijaniyah', null, '5');
INSERT INTO `areas` VALUES ('37', 'Al Dhait', null, '5');
INSERT INTO `areas` VALUES ('38', 'Al Hamra', null, '5');
INSERT INTO `areas` VALUES ('39', 'Al Hamra Village', null, '5');
INSERT INTO `areas` VALUES ('40', 'Al Hudaihbah', null, '5');
INSERT INTO `areas` VALUES ('41', 'Al Juwais', null, '5');
INSERT INTO `areas` VALUES ('42', 'Al Nakheel', null, '5');
INSERT INTO `areas` VALUES ('43', 'Al Seer', null, '5');
INSERT INTO `areas` VALUES ('44', 'Al Soor', null, '5');
INSERT INTO `areas` VALUES ('45', 'Al Uraibi', null, '5');
INSERT INTO `areas` VALUES ('46', 'Al Zahra', null, '5');
INSERT INTO `areas` VALUES ('47', 'Dafan Al Khor', null, '5');
INSERT INTO `areas` VALUES ('48', 'Dafan Al Nakheel', null, '5');
INSERT INTO `areas` VALUES ('49', 'Jazeera Al Hamra', null, '5');
INSERT INTO `areas` VALUES ('50', 'Julfar', null, '5');
INSERT INTO `areas` VALUES ('51', 'Khuzam', null, '5');
INSERT INTO `areas` VALUES ('52', 'Mamourah ', null, '5');
INSERT INTO `areas` VALUES ('53', 'Seih Al Burairat', null, '5');
INSERT INTO `areas` VALUES ('54', 'Seih Al Hudaibah', null, '5');
INSERT INTO `areas` VALUES ('55', 'Seih Al Uraibi', null, '5');

-- ----------------------------
-- Table structure for artist
-- ----------------------------
DROP TABLE IF EXISTS `artist`;
CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_status` varchar(255) DEFAULT NULL,
  `person_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of artist
-- ----------------------------

-- ----------------------------
-- Table structure for artist_action
-- ----------------------------
DROP TABLE IF EXISTS `artist_action`;
CREATE TABLE `artist_action` (
  `artist_action_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `remarks_ar` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`artist_action_id`),
  KEY `artist_id` (`artist_id`),
  CONSTRAINT `artist_action_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of artist_action
-- ----------------------------

-- ----------------------------
-- Table structure for artist_permit
-- ----------------------------
DROP TABLE IF EXISTS `artist_permit`;
CREATE TABLE `artist_permit` (
  `artist_permit_id` int(11) NOT NULL AUTO_INCREMENT,
  `sponsor_name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sponsor_name_en` varchar(255) DEFAULT NULL,
  `visa_expire_date` date DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `lastname_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lastname_en` varchar(255) DEFAULT NULL,
  `firstname_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `is_checked` tinyint(4) DEFAULT NULL,
  `firstname_en` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `visa_number` varchar(255) DEFAULT NULL,
  `profession_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT '0',
  `visa_type_id` int(11) DEFAULT '0',
  `mobile_number` varchar(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fax_number` varchar(11) DEFAULT NULL,
  `po_box` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address_ar` varchar(255) CHARACTER SET utf8 DEFAULT '0',
  `emirate_id` int(11) DEFAULT '0',
  `address_en` varchar(255) DEFAULT NULL,
  `area_id` int(11) DEFAULT '0',
  `passport_expire_date` date DEFAULT NULL,
  `passport_number` varchar(11) DEFAULT NULL,
  `uid_expire_date` date DEFAULT NULL,
  `uid_number` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `original` varchar(255) DEFAULT NULL,
  `old_artist_id` int(11) DEFAULT NULL,
  `replace_reason_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `replace_reason_en` varchar(255) DEFAULT NULL,
  `artist_permit_status` varchar(255) DEFAULT 'unchecked',
  `artist_id` int(11) DEFAULT NULL,
  `permit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `religion_id` int(11) DEFAULT '0',
  `identification_number` varchar(255) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_paid` int(11) DEFAULT NULL,
  PRIMARY KEY (`artist_permit_id`),
  KEY `artist_id` (`artist_id`),
  KEY `permit_id` (`permit_id`),
  KEY `area_id` (`area_id`),
  KEY `emirate_id` (`emirate_id`),
  KEY `religion_id` (`religion_id`),
  KEY `visa_type_id` (`visa_type_id`),
  KEY `language_id` (`language_id`),
  KEY `profession_id` (`profession_id`),
  KEY `gender_id` (`gender_id`),
  KEY `country_id` (`country_id`),
  CONSTRAINT `artist_permit_ibfk_2` FOREIGN KEY (`permit_id`) REFERENCES `permit` (`permit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `artist_permit_ibfk_4` FOREIGN KEY (`profession_id`) REFERENCES `profession` (`profession_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `artist_permit_ibfk_5` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`gender_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `artist_permit_ibfk_6` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `artist_permit_ibfk_7` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of artist_permit
-- ----------------------------

-- ----------------------------
-- Table structure for artist_permit_check
-- ----------------------------
DROP TABLE IF EXISTS `artist_permit_check`;
CREATE TABLE `artist_permit_check` (
  `artist_permit_check_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_permit_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`artist_permit_check_id`),
  KEY `artist_permit_id` (`artist_permit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of artist_permit_check
-- ----------------------------

-- ----------------------------
-- Table structure for artist_permit_checklist
-- ----------------------------
DROP TABLE IF EXISTS `artist_permit_checklist`;
CREATE TABLE `artist_permit_checklist` (
  `artist_permit_checklist_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_permit_id` int(11) DEFAULT NULL,
  `fieldname` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `artist_permit_check_id` int(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`artist_permit_checklist_id`),
  KEY `artist_permit_id` (`artist_permit_id`),
  KEY `artist_permit_check_id` (`artist_permit_check_id`),
  CONSTRAINT `artist_permit_checklist_ibfk_1` FOREIGN KEY (`artist_permit_id`) REFERENCES `artist_permit` (`artist_permit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `artist_permit_checklist_ibfk_2` FOREIGN KEY (`artist_permit_check_id`) REFERENCES `artist_permit_check` (`artist_permit_check_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of artist_permit_checklist
-- ----------------------------

-- ----------------------------
-- Table structure for artist_permit_comment
-- ----------------------------
DROP TABLE IF EXISTS `artist_permit_comment`;
CREATE TABLE `artist_permit_comment` (
  `artist_permit_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_permit_check_id` int(11) DEFAULT NULL,
  `permit_comment_id` int(11) DEFAULT NULL,
  `exempt_payment` tinyint(4) DEFAULT NULL,
  `checked_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `artist_permit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`artist_permit_comment_id`),
  KEY `permit_comment_id` (`permit_comment_id`),
  KEY `artist_permit_comment_ibfk_3` (`artist_permit_check_id`),
  KEY `artist_permit_id` (`artist_permit_id`),
  CONSTRAINT `artist_permit_comment_ibfk_1` FOREIGN KEY (`permit_comment_id`) REFERENCES `permit_comment` (`permit_comment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `artist_permit_comment_ibfk_2` FOREIGN KEY (`artist_permit_id`) REFERENCES `artist_permit` (`artist_permit_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of artist_permit_comment
-- ----------------------------

-- ----------------------------
-- Table structure for artist_permit_document
-- ----------------------------
DROP TABLE IF EXISTS `artist_permit_document`;
CREATE TABLE `artist_permit_document` (
  `permit_document_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `requirement_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `artist_permit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`permit_document_id`),
  KEY `artist_permit_id` (`artist_permit_id`),
  KEY `requirement_id` (`requirement_id`),
  CONSTRAINT `artist_permit_document_ibfk_1` FOREIGN KEY (`artist_permit_id`) REFERENCES `artist_permit` (`artist_permit_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of artist_permit_document
-- ----------------------------

-- ----------------------------
-- Table structure for artist_permit_transaction
-- ----------------------------
DROP TABLE IF EXISTS `artist_permit_transaction`;
CREATE TABLE `artist_permit_transaction` (
  `artist_permit_trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `vat` double DEFAULT NULL,
  `permit_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `artist_permit_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`artist_permit_trans_id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `artist_permit_id` (`artist_permit_id`),
  KEY `permit_id` (`permit_id`),
  CONSTRAINT `artist_permit_transaction_ibfk_1` FOREIGN KEY (`permit_id`) REFERENCES `permit` (`permit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `artist_permit_transaction_ibfk_2` FOREIGN KEY (`artist_permit_id`) REFERENCES `artist_permit` (`artist_permit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `artist_permit_transaction_ibfk_3` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of artist_permit_transaction
-- ----------------------------

-- ----------------------------
-- Table structure for artist_temp_data
-- ----------------------------
DROP TABLE IF EXISTS `artist_temp_data`;
CREATE TABLE `artist_temp_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process` varchar(255) DEFAULT NULL,
  `permit_number` varchar(255) DEFAULT NULL,
  `firstname_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lastname_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `firstname_en` varchar(255) DEFAULT NULL,
  `lastname_en` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT '',
  `birthdate` date DEFAULT NULL,
  `artist_permit_id` int(11) DEFAULT NULL,
  `sponsor_name_en` varchar(255) DEFAULT NULL,
  `sponsor_name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `visa_type` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `mobile_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fax_number` varchar(255) DEFAULT NULL,
  `po_box` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address_en` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT '',
  `city` varchar(255) DEFAULT '',
  `passport_number` varchar(255) DEFAULT NULL,
  `passport_expire_date` date DEFAULT NULL,
  `uid_number` varchar(255) DEFAULT NULL,
  `uid_expire_date` date DEFAULT NULL,
  `original` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `permit_id` int(11) DEFAULT NULL,
  `visa_expire_date` date DEFAULT NULL,
  `language` varchar(255) DEFAULT '',
  `religion` varchar(255) DEFAULT '',
  `emirates_id` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  `person_code` varchar(255) DEFAULT NULL,
  `gender` varchar(11) DEFAULT '',
  `visa_number` varchar(255) DEFAULT NULL,
  `is_old_artist` tinyint(4) DEFAULT NULL,
  `profession_id` int(11) DEFAULT NULL,
  `artist_permit_status` varchar(255) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `work_location` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `del_status` int(11) DEFAULT '0',
  `event_id` int(11) DEFAULT NULL,
  `work_location_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `old_artist_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_paid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of artist_temp_data
-- ----------------------------

-- ----------------------------
-- Table structure for artist_temp_document
-- ----------------------------
DROP TABLE IF EXISTS `artist_temp_document`;
CREATE TABLE `artist_temp_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(255) DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `requirement_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `artist_permit_id` int(255) DEFAULT NULL,
  `permit_id` int(255) DEFAULT NULL,
  `temp_data_id` int(255) DEFAULT NULL,
  `doc_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of artist_temp_document
-- ----------------------------

-- ----------------------------
-- Table structure for audits
-- ----------------------------
DROP TABLE IF EXISTS `audits`;
CREATE TABLE `audits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) unsigned NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci,
  `new_values` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=981 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of audits
-- ----------------------------

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `registered_by` int(11) DEFAULT NULL,
  `request_type` varchar(255) DEFAULT NULL,
  `application_date` timestamp NULL DEFAULT NULL,
  `registered_date` timestamp NULL DEFAULT NULL,
  `logo_original` varchar(255) DEFAULT NULL,
  `logo_thumbnail` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `company_type_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `company_description_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `company_description_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `trade_license` varchar(255) DEFAULT NULL,
  `trade_license_issued_date` timestamp NULL DEFAULT NULL,
  `trade_license_expired_date` timestamp NULL DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `emirate_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_id`),
  KEY `emirate_id` (`emirate_id`),
  KEY `country_id` (`country_id`),
  KEY `company_type_id` (`company_type_id`),
  KEY `area_id` (`area_id`),
  CONSTRAINT `company_ibfk_1` FOREIGN KEY (`emirate_id`) REFERENCES `emirates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `company_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `company_ibfk_3` FOREIGN KEY (`company_type_id`) REFERENCES `company_type` (`company_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `company_ibfk_4` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('51', '1', 'new registration\r\n', '2019-12-24 10:15:49', '2019-12-30 14:28:04', null, null, 'EST-2019-0002', '2', 'active', 'teset', 'test', 'نرص إنفويس', 'nrs infoways', 'raktda@email.com', '12345678', null, '23155001', '2019-12-22 00:00:00', '2020-05-13 00:00:00', '36', '5', '232', 'test address', '2019-12-22 14:23:11', '2020-02-16 23:15:30');
INSERT INTO `company` VALUES ('137', '1', 'amendment request', '2020-01-23 15:47:50', '2020-01-23 15:50:56', null, null, 'EST-2020-0003', '2', 'new', 'Aliqua Aliqua Dolo', 'Aliqua Aliqua Dolo', 'Andrew Fuentes', 'Andrew Fuentes', 'my@email.com', '234567', null, 'Nobis tempor deserun', null, '2020-01-24 00:00:00', '24', '5', '232', 'Aliqua Aliqua Dolo', '2020-01-23 15:38:11', '2020-02-16 22:25:17');
INSERT INTO `company` VALUES ('139', null, 'new registration', '2020-01-24 22:40:44', null, null, null, 'EST-2020-0004', '2', 'new', 'Recusandae Itaque q', 'Recusandae Itaque q', 'Kaye Blackburn', 'Kaye Blackburn', 'my@email.com', '2345675', null, 'Lorem ad tempor eius', null, '2020-01-25 00:00:00', '26', '5', '232', 'Recusandae Itaque q', '2020-01-24 22:36:40', '2020-02-16 22:25:17');

-- ----------------------------
-- Table structure for company_artist
-- ----------------------------
DROP TABLE IF EXISTS `company_artist`;
CREATE TABLE `company_artist` (
  `company_artist_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`company_artist_id`),
  KEY `artist_id` (`artist_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `company_artist_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `company_artist_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company_artist
-- ----------------------------

-- ----------------------------
-- Table structure for company_artist_draft
-- ----------------------------
DROP TABLE IF EXISTS `company_artist_draft`;
CREATE TABLE `company_artist_draft` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referNo` varchar(11) DEFAULT '',
  `companyID` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `stepOne` varchar(255) DEFAULT NULL,
  `stepTwo` varchar(255) DEFAULT NULL,
  `stepThree` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company_artist_draft
-- ----------------------------

-- ----------------------------
-- Table structure for company_comment
-- ----------------------------
DROP TABLE IF EXISTS `company_comment`;
CREATE TABLE `company_comment` (
  `company_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `comment_en` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_comment_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `company_comment_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company_comment
-- ----------------------------
INSERT INTO `company_comment` VALUES ('34', null, null, '51', 'approved', '1', '2019-12-23 09:39:43', '2019-12-23 09:39:43');

-- ----------------------------
-- Table structure for company_contact
-- ----------------------------
DROP TABLE IF EXISTS `company_contact`;
CREATE TABLE `company_contact` (
  `company_contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_name_en` varchar(255) DEFAULT NULL,
  `contact_name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `designation_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `emirate_id_expired_date` timestamp NULL DEFAULT NULL,
  `emirate_id_issued_date` timestamp NULL DEFAULT NULL,
  `emirate_identification` varchar(255) DEFAULT NULL,
  `designation_en` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `mobile_number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_contact_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `company_contact_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company_contact
-- ----------------------------
INSERT INTO `company_contact` VALUES ('10', 'chris olivo', 'chris olivo', 'programmer', '2019-12-24 00:00:00', null, '1234567890', 'programmer', 'chris@nrsinfoways.com', '51', '123456789', '2020-02-17 18:19:46', '2020-02-17 18:19:46');
INSERT INTO `company_contact` VALUES ('23', 'Aliqua Aliqua Dolo', 'Aliqua Aliqua Dolo', 'Aliqua Aliqua Dolo', '2020-01-24 00:00:00', null, 'Aliqua Aliqua Dolo', 'Aliqua Aliqua Dolo', null, '137', '0', '2020-02-17 18:19:46', '2020-02-17 18:19:46');
INSERT INTO `company_contact` VALUES ('24', 'chris olivo', 'chris olivo', 'programmer', '2020-01-31 00:00:00', null, '123456', 'programmer', null, '139', '123457867', '2020-02-17 18:19:46', '2020-02-17 18:19:46');

-- ----------------------------
-- Table structure for company_other_upload
-- ----------------------------
DROP TABLE IF EXISTS `company_other_upload`;
CREATE TABLE `company_other_upload` (
  `other_upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) DEFAULT NULL,
  `name_er` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`other_upload_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company_other_upload
-- ----------------------------
INSERT INTO `company_other_upload` VALUES ('1', 'other upload', 'other upload', '2019-12-24 16:25:19', '2019-12-24 16:25:22');

-- ----------------------------
-- Table structure for company_request
-- ----------------------------
DROP TABLE IF EXISTS `company_request`;
CREATE TABLE `company_request` (
  `company_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`company_request_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `company_request_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company_request
-- ----------------------------
INSERT INTO `company_request` VALUES ('1', 'new registration', null, '137', '2020-01-23 15:47:50', '2020-01-23 15:47:50');
INSERT INTO `company_request` VALUES ('2', 'new registration', null, '139', '2020-01-24 22:40:44', '2020-01-24 22:40:44');

-- ----------------------------
-- Table structure for company_requirement
-- ----------------------------
DROP TABLE IF EXISTS `company_requirement`;
CREATE TABLE `company_requirement` (
  `company_requirement_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_number` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_submit` tinyint(4) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `issued_date` timestamp NULL DEFAULT NULL,
  `expired_date` timestamp NULL DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `requirement_id` int(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_requirement_id`),
  KEY `company_id` (`company_id`),
  KEY `requirement_id` (`requirement_id`),
  CONSTRAINT `company_requirement_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company_requirement
-- ----------------------------

-- ----------------------------
-- Table structure for company_type
-- ----------------------------
DROP TABLE IF EXISTS `company_type`;
CREATE TABLE `company_type` (
  `company_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company_type
-- ----------------------------
INSERT INTO `company_type` VALUES ('1', 'government', 'government', '2019-12-12 10:01:53', '2019-12-12 10:01:56');
INSERT INTO `company_type` VALUES ('2', 'corporate', 'corporate', '2019-12-12 10:01:56', '2019-12-12 10:01:58');

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(255) DEFAULT '',
  `name_en` varchar(255) DEFAULT '',
  `name_ar` varchar(255) DEFAULT '',
  `nationality_en` varchar(255) DEFAULT '',
  `nationality_ar` varchar(255) DEFAULT '',
  `continent_code` varchar(255) DEFAULT NULL,
  `continent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', 'AF', 'Afghanistan', 'أفغانستان', 'Afghan', 'أفغانستاني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('2', 'AL', 'Albania', 'ألبانيا', 'Albanian', 'ألباني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('3', 'AX', 'Aland Islands', 'جزر آلاند', 'Aland Islander', 'آلاندي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('4', 'DZ', 'Algeria', 'الجزائر', 'Algerian', 'جزائري', 'AF', 'Africa');
INSERT INTO `country` VALUES ('5', 'AS', 'American Samoa', 'ساموا-الأمريكي', 'American Samoan', 'أمريكي سامواني', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('6', 'AD', 'Andorra', 'أندورا', 'Andorran', 'أندوري', 'EU', 'Europe');
INSERT INTO `country` VALUES ('7', 'AO', 'Angola', 'أنغولا', 'Angolan', 'أنقولي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('8', 'AI', 'Anguilla', 'أنغويلا', 'Anguillan', 'أنغويلي', 'NA', 'North America');
INSERT INTO `country` VALUES ('9', 'AQ', 'Antarctica', 'أنتاركتيكا', 'Antarctican', 'أنتاركتيكي', 'AN', 'Antarctica');
INSERT INTO `country` VALUES ('10', 'AG', 'Antigua and uarbuda', 'أنتيغوا وبربودا', 'Antiguan', 'بربودي', 'NA', 'North America');
INSERT INTO `country` VALUES ('11', 'AR', 'Argentina', 'الأرجنتين', 'Argentinian', 'أرجنتيني', 'SA', 'South America');
INSERT INTO `country` VALUES ('12', 'AM', 'Armenia', 'أرمينيا', 'Armenian', 'أرميني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('13', 'AW', 'Aruba', 'أروبه', 'Aruban', 'أوروبهيني', 'NA', 'North America');
INSERT INTO `country` VALUES ('14', 'AU', 'Australia', 'أستراليا', 'Australian', 'أسترالي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('15', 'AT', 'Austria', 'النمسا', 'Austrian', 'نمساوي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('16', 'AZ', 'Azerbaijan', 'أذربيجان', 'Azerbaijani', 'أذربيجاني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('17', 'BS', 'Bahamas', 'الباهاماس', 'Bahamian', 'باهاميسي', 'NA', 'North America');
INSERT INTO `country` VALUES ('18', 'BH', 'Bahrain', 'البحرين', 'Bahraini', 'بحريني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('19', 'BD', 'Bangladesh', 'بنغلاديش', 'Bangladeshi', 'بنغلاديشي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('20', 'BB', 'Barbados', 'بربادوس', 'Barbadian', 'بربادوسي', 'NA', 'North America');
INSERT INTO `country` VALUES ('21', 'BY', 'Belarus', 'روسيا البيضاء', 'Belarusian', 'روسي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('22', 'BE', 'Belgium', 'بلجيكا', 'Belgian', 'بلجيكي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('23', 'BZ', 'Belize', 'بيليز', 'Belizean', 'بيليزي', 'NA', 'North America');
INSERT INTO `country` VALUES ('24', 'BJ', 'Benin', 'بنين', 'Beninese', 'بنيني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('25', 'BL', 'Saint Barthelemy', 'سان بارتيلمي', 'Saint Barthelmian', 'سان بارتيلمي', 'NA', 'North America');
INSERT INTO `country` VALUES ('26', 'BM', 'Bermuda', 'جزر برمودا', 'Bermudan', 'برمودي', 'NA', 'North America');
INSERT INTO `country` VALUES ('27', 'BT', 'Bhutan', 'بوتان', 'Bhutanese', 'بوتاني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('28', 'BO', 'Bolivia', 'بوليفيا', 'Bolivian', 'بوليفي', 'SA', 'South America');
INSERT INTO `country` VALUES ('29', 'BA', 'Bosnia and Herzegovina', 'البوسنة و الهرسك', 'Bosnian / Herzegovinian', 'بوسني/هرسكي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('30', 'BW', 'Botswana', 'بوتسوانا', 'Botswanan', 'بوتسواني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('31', 'BV', 'Bouvet Island', 'جزيرة بوفيه', 'Bouvetian', 'بوفيهي', 'AN', 'Antarctica');
INSERT INTO `country` VALUES ('32', 'BR', 'Brazil', 'البرازيل', 'Brazilian', 'برازيلي', 'SA', 'South America');
INSERT INTO `country` VALUES ('33', 'IO', 'British Indian Ocean Territory', 'إقليم المحيط الهندي البريطاني', 'British Indian Ocean Territory', 'إقليم المحيط الهندي البريطاني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('34', 'BN', 'Brunei Darussalam', 'بروني', 'Bruneian', 'بروني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('35', 'BG', 'Bulgaria', 'بلغاريا', 'Bulgarian', 'بلغاري', 'EU', 'Europe');
INSERT INTO `country` VALUES ('36', 'BF', 'Burkina Faso', 'بوركينا فاسو', 'Burkinabe', 'بوركيني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('37', 'BI', 'Burundi', 'بوروندي', 'Burundian', 'بورونيدي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('38', 'KH', 'Cambodia', 'كمبوديا', 'Cambodian', 'كمبودي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('39', 'CM', 'Cameroon', 'كاميرون', 'Cameroonian', 'كاميروني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('40', 'CA', 'Canada', 'كندا', 'Canadian', 'كندي', 'NA', 'North America');
INSERT INTO `country` VALUES ('41', 'CV', 'Cape Verde', 'الرأس الأخضر', 'Cape Verdean', 'الرأس الأخضر', 'AF', 'Africa');
INSERT INTO `country` VALUES ('42', 'KY', 'Cayman Islands', 'جزر كايمان', 'Caymanian', 'كايماني', 'NA', 'North America');
INSERT INTO `country` VALUES ('43', 'CF', 'Central African Republic', 'جمهورية أفريقيا الوسطى', 'Central African', 'أفريقي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('44', 'TD', 'Chad', 'تشاد', 'Chadian', 'تشادي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('45', 'CL', 'Chile', 'شيلي', 'Chilean', 'شيلي', 'SA', 'South America');
INSERT INTO `country` VALUES ('46', 'CN', 'China', 'الصين', 'Chinese', 'صيني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('47', 'CX', 'Christmas Island', 'جزيرة عيد الميلاد', 'Christmas Islander', 'جزيرة عيد الميلاد', 'AS', 'Asia');
INSERT INTO `country` VALUES ('48', 'CC', 'Cocos (Keeling) Islands', 'جزر كوكوس', 'Cocos Islander', 'جزر كوكوس', 'AS', 'Asia');
INSERT INTO `country` VALUES ('49', 'CO', 'Colombia', 'كولومبيا', 'Colombian', 'كولومبي', 'SA', 'South America');
INSERT INTO `country` VALUES ('50', 'KM', 'Comoros', 'جزر القمر', 'Comorian', 'جزر القمر', 'AF', 'Africa');
INSERT INTO `country` VALUES ('51', 'CG', 'Congo', 'الكونغو', 'Congolese', 'كونغي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('52', 'CK', 'Cook Islands', 'جزر كوك', 'Cook Islander', 'جزر كوك', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('53', 'CR', 'Costa Rica', 'كوستاريكا', 'Costa Rican', 'كوستاريكي', 'NA', 'North America');
INSERT INTO `country` VALUES ('54', 'HR', 'Croatia', 'كرواتيا', 'Croatian', 'كوراتي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('55', 'CU', 'Cuba', 'كوبا', 'Cuban', 'كوبي', 'NA', 'North America');
INSERT INTO `country` VALUES ('56', 'CY', 'Cyprus', 'قبرص', 'Cypriot', 'قبرصي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('57', 'CW', 'Curaçao', 'كوراساو', 'Curacian', 'كوراساوي', 'NA', 'North America');
INSERT INTO `country` VALUES ('58', 'CZ', 'Czech Republic', 'الجمهورية التشيكية', 'Czech', 'تشيكي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('59', 'DK', 'Denmark', 'الدانمارك', 'Danish', 'دنماركي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('60', 'DJ', 'Djibouti', 'جيبوتي', 'Djiboutian', 'جيبوتي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('61', 'DM', 'Dominica', 'دومينيكا', 'Dominican', 'دومينيكي', 'NA', 'North America');
INSERT INTO `country` VALUES ('62', 'DO', 'Dominican Republic', 'الجمهورية الدومينيكية', 'Dominican', 'دومينيكي', 'NA', 'North America');
INSERT INTO `country` VALUES ('63', 'EC', 'Ecuador', 'إكوادور', 'Ecuadorian', 'إكوادوري', 'SA', 'South America');
INSERT INTO `country` VALUES ('64', 'EG', 'Egypt', 'مصر', 'Egyptian', 'مصري', 'AF', 'Africa');
INSERT INTO `country` VALUES ('65', 'SV', 'El Salvador', 'إلسلفادور', 'Salvadoran', 'سلفادوري', 'NA', 'North America');
INSERT INTO `country` VALUES ('66', 'GQ', 'Equatorial Guinea', 'غينيا الاستوائي', 'Equatorial Guinean', 'غيني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('67', 'ER', 'Eritrea', 'إريتريا', 'Eritrean', 'إريتيري', 'AF', 'Africa');
INSERT INTO `country` VALUES ('68', 'EE', 'Estonia', 'استونيا', 'Estonian', 'استوني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('69', 'ET', 'Ethiopia', 'أثيوبيا', 'Ethiopian', 'أثيوبي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('70', 'FK', 'Falkland Islands (Malvinas)', 'جزر فوكلاند', 'Falkland Islander', 'فوكلاندي', 'SA', 'South America');
INSERT INTO `country` VALUES ('71', 'FO', 'Faroe Islands', 'جزر فارو', 'Faroese', 'جزر فارو', 'EU', 'Europe');
INSERT INTO `country` VALUES ('72', 'FJ', 'Fiji', 'فيجي', 'Fijian', 'فيجي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('73', 'FI', 'Finland', 'فنلندا', 'Finnish', 'فنلندي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('74', 'FR', 'France', 'فرنسا', 'French', 'فرنسي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('75', 'GF', 'French Guiana', 'غويانا الفرنسية', 'French Guianese', 'غويانا الفرنسية', 'SA', 'South America');
INSERT INTO `country` VALUES ('76', 'PF', 'French Polynesia', 'بولينيزيا الفرنسية', 'French Polynesian', 'بولينيزيي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('77', 'TF', 'French Southern and Antarctic Lands', 'أراض فرنسية جنوبية وأنتارتيكية', 'French', 'أراض فرنسية جنوبية وأنتارتيكية', 'AN', 'Antarctica');
INSERT INTO `country` VALUES ('78', 'GA', 'Gabon', 'الغابون', 'Gabonese', 'غابوني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('79', 'GM', 'Gambia', 'غامبيا', 'Gambian', 'غامبي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('80', 'GE', 'Georgia', 'جيورجيا', 'Georgian', 'جيورجي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('81', 'DE', 'Germany', 'ألمانيا', 'German', 'ألماني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('82', 'GH', 'Ghana', 'غانا', 'Ghanaian', 'غاني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('83', 'GI', 'Gibraltar', 'جبل طارق', 'Gibraltar', 'جبل طارق', 'EU', 'Europe');
INSERT INTO `country` VALUES ('84', 'GG', 'Guernsey', 'غيرنزي', 'Guernsian', 'غيرنزي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('85', 'GR', 'Greece', 'اليونان', 'Greek', 'يوناني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('86', 'GL', 'Greenland', 'جرينلاند', 'Greenlandic', 'جرينلاندي', 'NA', 'North America');
INSERT INTO `country` VALUES ('87', 'GD', 'Grenada', 'غرينادا', 'Grenadian', 'غرينادي', 'NA', 'North America');
INSERT INTO `country` VALUES ('88', 'GP', 'Guadeloupe', 'جزر جوادلوب', 'Guadeloupe', 'جزر جوادلوب', 'NA', 'North America');
INSERT INTO `country` VALUES ('89', 'GU', 'Guam', 'جوام', 'Guamanian', 'جوامي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('90', 'GT', 'Guatemala', 'غواتيمال', 'Guatemalan', 'غواتيمالي', 'NA', 'North America');
INSERT INTO `country` VALUES ('91', 'GN', 'Guinea', 'غينيا', 'Guinean', 'غيني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('92', 'GW', 'Guinea-Bissau', 'غينيا-بيساو', 'Guinea-Bissauan', 'غيني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('93', 'GY', 'Guyana', 'غيانا', 'Guyanese', 'غياني', 'SA', 'South America');
INSERT INTO `country` VALUES ('94', 'HT', 'Haiti', 'هايتي', 'Haitian', 'هايتي', 'NA', 'North America');
INSERT INTO `country` VALUES ('95', 'HM', 'Heard and Mc Donald Islands', 'جزيرة هيرد وجزر ماكدونالد', 'Heard and Mc Donald Islanders', 'جزيرة هيرد وجزر ماكدونالد', 'AN', 'Antarctica');
INSERT INTO `country` VALUES ('96', 'HN', 'Honduras', 'هندوراس', 'Honduran', 'هندوراسي', 'NA', 'North America');
INSERT INTO `country` VALUES ('97', 'HK', 'Hong Kong', 'هونغ كونغ', 'Hongkongese', 'هونغ كونغي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('98', 'HU', 'Hungary', 'المجر', 'Hungarian', 'مجري', 'EU', 'Europe');
INSERT INTO `country` VALUES ('99', 'IS', 'Iceland', 'آيسلندا', 'Icelandic', 'آيسلندي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('100', 'IN', 'India', 'الهند', 'Indian', 'هندي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('101', 'IM', 'Isle of Man', 'جزيرة مان', 'Manx', 'ماني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('102', 'ID', 'Indonesia', 'أندونيسيا', 'Indonesian', 'أندونيسيي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('103', 'IR', 'Iran', 'إيران', 'Iranian', 'إيراني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('104', 'IQ', 'Iraq', 'العراق', 'Iraqi', 'عراقي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('105', 'IE', 'Ireland', 'إيرلندا', 'Irish', 'إيرلندي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('106', 'IL', 'Israel', 'إسرائيل', 'Israeli', 'إسرائيلي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('107', 'IT', 'Italy', 'إيطاليا', 'Italian', 'إيطالي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('108', 'CI', 'Ivory Coast', 'ساحل العاج', 'Ivory Coastian', 'ساحل العاج', 'AF', 'Africa');
INSERT INTO `country` VALUES ('109', 'JE', 'Jersey', 'جيرزي', 'Jersian', 'جيرزي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('110', 'JM', 'Jamaica', 'جمايكا', 'Jamaican', 'جمايكي', 'NA', 'North America');
INSERT INTO `country` VALUES ('111', 'JP', 'Japan', 'اليابان', 'Japanese', 'ياباني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('112', 'JO', 'Jordan', 'الأردن', 'Jordanian', 'أردني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('113', 'KZ', 'Kazakhstan', 'كازاخستان', 'Kazakh', 'كازاخستاني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('114', 'KE', 'Kenya', 'كينيا', 'Kenyan', 'كيني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('115', 'KI', 'Kiribati', 'كيريباتي', 'I-Kiribati', 'كيريباتي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('116', 'KP', 'Korea(North Korea)', 'كوريا الشمالية', 'North Korean', 'كوري', 'AS', 'Asia');
INSERT INTO `country` VALUES ('117', 'KR', 'Korea(South Korea)', 'كوريا الجنوبية', 'South Korean', 'كوري', 'AS', 'Asia');
INSERT INTO `country` VALUES ('118', 'XK', 'Kosovo', 'كوسوفو', 'Kosovar', 'كوسيفي', null, null);
INSERT INTO `country` VALUES ('119', 'KW', 'Kuwait', 'الكويت', 'Kuwaiti', 'كويتي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('120', 'KG', 'Kyrgyzstan', 'قيرغيزستان', 'Kyrgyzstani', 'قيرغيزستاني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('121', 'LA', 'Lao PDR', 'لاوس', 'Laotian', 'لاوسي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('122', 'LV', 'Latvia', 'لاتفيا', 'Latvian', 'لاتيفي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('123', 'LB', 'Lebanon', 'لبنان', 'Lebanese', 'لبناني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('124', 'LS', 'Lesotho', 'ليسوتو', 'Basotho', 'ليوسيتي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('125', 'LR', 'Liberia', 'ليبيريا', 'Liberian', 'ليبيري', 'AF', 'Africa');
INSERT INTO `country` VALUES ('126', 'LY', 'Libya', 'ليبيا', 'Libyan', 'ليبي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('127', 'LI', 'Liechtenstein', 'ليختنشتين', 'Liechtenstein', 'ليختنشتيني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('128', 'LT', 'Lithuania', 'لتوانيا', 'Lithuanian', 'لتوانيي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('129', 'LU', 'Luxembourg', 'لوكسمبورغ', 'Luxembourger', 'لوكسمبورغي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('130', 'LK', 'Sri Lanka', 'سريلانكا', 'Sri Lankian', 'سريلانكي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('131', 'MO', 'Macau', 'ماكاو', 'Macanese', 'ماكاوي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('132', 'MK', 'Macedonia', 'مقدونيا', 'Macedonian', 'مقدوني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('133', 'MG', 'Madagascar', 'مدغشقر', 'Malagasy', 'مدغشقري', 'AF', 'Africa');
INSERT INTO `country` VALUES ('134', 'MW', 'Malawi', 'مالاوي', 'Malawian', 'مالاوي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('135', 'MY', 'Malaysia', 'ماليزيا', 'Malaysian', 'ماليزي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('136', 'MV', 'Maldives', 'المالديف', 'Maldivian', 'مالديفي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('137', 'ML', 'Mali', 'مالي', 'Malian', 'مالي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('138', 'MT', 'Malta', 'مالطا', 'Maltese', 'مالطي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('139', 'MH', 'Marshall Islands', 'جزر مارشال', 'Marshallese', 'مارشالي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('140', 'MQ', 'Martinique', 'مارتينيك', 'Martiniquais', 'مارتينيكي', 'NA', 'North America');
INSERT INTO `country` VALUES ('141', 'MR', 'Mauritania', 'موريتانيا', 'Mauritanian', 'موريتانيي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('142', 'MU', 'Mauritius', 'موريشيوس', 'Mauritian', 'موريشيوسي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('143', 'YT', 'Mayotte', 'مايوت', 'Mahoran', 'مايوتي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('144', 'MX', 'Mexico', 'المكسيك', 'Mexican', 'مكسيكي', 'NA', 'North America');
INSERT INTO `country` VALUES ('145', 'FM', 'Micronesia', 'مايكرونيزيا', 'Micronesian', 'مايكرونيزيي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('146', 'MD', 'Moldova', 'مولدافيا', 'Moldovan', 'مولديفي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('147', 'MC', 'Monaco', 'موناكو', 'Monacan', 'مونيكي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('148', 'MN', 'Mongolia', 'منغوليا', 'Mongolian', 'منغولي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('149', 'ME', 'Montenegro', 'الجبل الأسود', 'Montenegrin', 'الجبل الأسود', 'EU', 'Europe');
INSERT INTO `country` VALUES ('150', 'MS', 'Montserrat', 'مونتسيرات', 'Montserratian', 'مونتسيراتي', 'NA', 'North America');
INSERT INTO `country` VALUES ('151', 'MA', 'Morocco', 'المغرب', 'Moroccan', 'مغربي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('152', 'MZ', 'Mozambique', 'موزمبيق', 'Mozambican', 'موزمبيقي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('153', 'MM', 'Myanmar', 'ميانمار', 'Myanmarian', 'ميانماري', 'AS', 'Asia');
INSERT INTO `country` VALUES ('154', 'NA', 'Namibia', 'ناميبيا', 'Namibian', 'ناميبي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('155', 'NR', 'Nauru', 'نورو', 'Nauruan', 'نوري', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('156', 'NP', 'Nepal', 'نيبال', 'Nepalese', 'نيبالي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('157', 'NL', 'Netherlands', 'هولندا', 'Dutch', 'هولندي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('158', 'AN', 'Netherlands Antilles', 'جزر الأنتيل الهولندي', 'Dutch Antilier', 'هولندي', null, null);
INSERT INTO `country` VALUES ('159', 'NC', 'New Caledonia', 'كاليدونيا الجديدة', 'New Caledonian', 'كاليدوني', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('160', 'NZ', 'New Zealand', 'نيوزيلندا', 'New Zealander', 'نيوزيلندي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('161', 'NI', 'Nicaragua', 'نيكاراجوا', 'Nicaraguan', 'نيكاراجوي', 'NA', 'North America');
INSERT INTO `country` VALUES ('162', 'NE', 'Niger', 'النيجر', 'Nigerien', 'نيجيري', 'AF', 'Africa');
INSERT INTO `country` VALUES ('163', 'NG', 'Nigeria', 'نيجيريا', 'Nigerian', 'نيجيري', 'AF', 'Africa');
INSERT INTO `country` VALUES ('164', 'NU', 'Niue', 'ني', 'Niuean', 'ني', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('165', 'NF', 'Norfolk Island', 'جزيرة نورفولك', 'Norfolk Islander', 'نورفوليكي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('166', 'MP', 'Northern Mariana Islands', 'جزر ماريانا الشمالية', 'Northern Marianan', 'ماريني', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('167', 'NO', 'Norway', 'النرويج', 'Norwegian', 'نرويجي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('168', 'OM', 'Oman', 'عمان', 'Omani', 'عماني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('169', 'PK', 'Pakistan', 'باكستان', 'Pakistani', 'باكستاني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('170', 'PW', 'Palau', 'بالاو', 'Palauan', 'بالاوي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('171', 'PS', 'Palestine', 'فلسطين', 'Palestinian', 'فلسطيني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('172', 'PA', 'Panama', 'بنما', 'Panamanian', 'بنمي', 'NA', 'North America');
INSERT INTO `country` VALUES ('173', 'PG', 'Papua New Guinea', 'بابوا غينيا الجديدة', 'Papua New Guinean', 'بابوي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('174', 'PY', 'Paraguay', 'باراغواي', 'Paraguayan', 'بارغاوي', 'SA', 'South America');
INSERT INTO `country` VALUES ('175', 'PE', 'Peru', 'بيرو', 'Peruvian', 'بيري', 'SA', 'South America');
INSERT INTO `country` VALUES ('176', 'PH', 'Philippines', 'الفليبين', 'Filipino', 'فلبيني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('177', 'PN', 'Pitcairn', 'بيتكيرن', 'Pitcairn Islander', 'بيتكيرني', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('178', 'PL', 'Poland', 'بولونيا', 'Polish', 'بوليني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('179', 'PT', 'Portugal', 'البرتغال', 'Portuguese', 'برتغالي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('180', 'PR', 'Puerto Rico', 'بورتو ريكو', 'Puerto Rican', 'بورتي', 'NA', 'North America');
INSERT INTO `country` VALUES ('181', 'QA', 'Qatar', 'قطر', 'Qatari', 'قطري', 'AS', 'Asia');
INSERT INTO `country` VALUES ('182', 'RE', 'Reunion Island', 'ريونيون', 'Reunionese', 'ريونيوني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('183', 'RO', 'Romania', 'رومانيا', 'Romanian', 'روماني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('184', 'RU', 'Russian', 'روسيا', 'Russian', 'روسي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('185', 'RW', 'Rwanda', 'رواندا', 'Rwandan', 'رواندا', 'AF', 'Africa');
INSERT INTO `country` VALUES ('186', 'KN', 'Saint Kitts and Nevis', 'سانت كيتس ونيفس,', 'Kittitian/Nevisian', 'سانت كيتس ونيفس', 'NA', 'North America');
INSERT INTO `country` VALUES ('187', 'MF', 'Saint Martin (French part)', 'ساينت مارتن فرنسي', 'St. Martian(French)', 'ساينت مارتني فرنسي', 'NA', 'North America');
INSERT INTO `country` VALUES ('188', 'SX', 'Sint Maarten (Dutch part)', 'ساينت مارتن هولندي', 'St. Martian(Dutch)', 'ساينت مارتني هولندي', 'NA', 'North America');
INSERT INTO `country` VALUES ('189', 'LC', 'Saint Pierre and Miquelon', 'سان بيير وميكلون', 'St. Pierre and Miquelon', 'سان بيير وميكلوني', 'NA', 'North America');
INSERT INTO `country` VALUES ('190', 'VC', 'Saint Vincent and the Grenadines', 'سانت فنسنت وجزر غرينادين', 'Saint Vincent and the Grenadines', 'سانت فنسنت وجزر غرينادين', 'NA', 'North America');
INSERT INTO `country` VALUES ('191', 'WS', 'Samoa', 'ساموا', 'Samoan', 'ساموي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('192', 'SM', 'San Marino', 'سان مارينو', 'Sammarinese', 'ماريني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('193', 'ST', 'Sao Tome and Principe', 'ساو تومي وبرينسيبي', 'Sao Tomean', 'ساو تومي وبرينسيبي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('194', 'SA', 'Saudi Arabia', 'المملكة العربية السعودية', 'Saudi Arabian', 'سعودي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('195', 'SN', 'Senegal', 'السنغال', 'Senegalese', 'سنغالي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('196', 'RS', 'Serbia', 'صربيا', 'Serbian', 'صربي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('197', 'SC', 'Seychelles', 'سيشيل', 'Seychellois', 'سيشيلي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('198', 'SL', 'Sierra Leone', 'سيراليون', 'Sierra Leonean', 'سيراليوني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('199', 'SG', 'Singapore', 'سنغافورة', 'Singaporean', 'سنغافوري', 'AS', 'Asia');
INSERT INTO `country` VALUES ('200', 'SK', 'Slovakia', 'سلوفاكيا', 'Slovak', 'سولفاكي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('201', 'SI', 'Slovenia', 'سلوفينيا', 'Slovenian', 'سولفيني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('202', 'SB', 'Solomon Islands', 'جزر سليمان', 'Solomon Island', 'جزر سليمان', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('203', 'SO', 'Somalia', 'الصومال', 'Somali', 'صومالي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('204', 'ZA', 'South Africa', 'جنوب أفريقيا', 'South African', 'أفريقي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('205', 'GS', 'South Georgia and the South Sandwich', 'المنطقة القطبية الجنوبية', 'South Georgia and the South Sandwich', 'لمنطقة القطبية الجنوبية', 'AN', 'Antarctica');
INSERT INTO `country` VALUES ('206', 'SS', 'South Sudan', 'السودان الجنوبي', 'South Sudanese', 'سوادني جنوبي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('207', 'ES', 'Spain', 'إسبانيا', 'Spanish', 'إسباني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('208', 'SH', 'Saint Helena', 'سانت هيلانة', 'St. Helenian', 'هيلاني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('209', 'SD', 'Sudan', 'السودان', 'Sudanese', 'سوداني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('210', 'SR', 'Suriname', 'سورينام', 'Surinamese', 'سورينامي', 'SA', 'South America');
INSERT INTO `country` VALUES ('211', 'SJ', 'Svalbard and Jan Mayen', 'سفالبارد ويان ماين', 'Svalbardian/Jan Mayenian', 'سفالبارد ويان ماين', 'EU', 'Europe');
INSERT INTO `country` VALUES ('212', 'SZ', 'Swaziland', 'سوازيلند', 'Swazi', 'سوازيلندي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('213', 'SE', 'Sweden', 'السويد', 'Swedish', 'سويدي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('214', 'CH', 'Switzerland', 'سويسرا', 'Swiss', 'سويسري', 'EU', 'Europe');
INSERT INTO `country` VALUES ('215', 'SY', 'Syria', 'سوريا', 'Syrian', 'سوري', 'AS', 'Asia');
INSERT INTO `country` VALUES ('216', 'TW', 'Taiwan', 'تايوان', 'Taiwanese', 'تايواني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('217', 'TJ', 'Tajikistan', 'طاجيكستان', 'Tajikistani', 'طاجيكستاني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('218', 'TZ', 'Tanzania', 'تنزانيا', 'Tanzanian', 'تنزانيي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('219', 'TH', 'Thailand', 'تايلندا', 'Thai', 'تايلندي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('220', 'TL', 'Timor-Leste', 'تيمور الشرقية', 'Timor-Lestian', 'تيموري', 'AS', 'Asia');
INSERT INTO `country` VALUES ('221', 'TG', 'Togo', 'توغو', 'Togolese', 'توغي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('222', 'TK', 'Tokelau', 'توكيلاو', 'Tokelaian', 'توكيلاوي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('223', 'TO', 'Tonga', 'تونغا', 'Tongan', 'تونغي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('224', 'TT', 'Trinidad and Tobago', 'ترينيداد وتوباغو', 'Trinidadian/Tobagonian', 'ترينيداد وتوباغو', 'NA', 'North America');
INSERT INTO `country` VALUES ('225', 'TN', 'Tunisia', 'تونس', 'Tunisian', 'تونسي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('226', 'TR', 'Turkey', 'تركيا', 'Turkish', 'تركي', 'EU', 'Europe');
INSERT INTO `country` VALUES ('227', 'TM', 'Turkmenistan', 'تركمانستان', 'Turkmen', 'تركمانستاني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('228', 'TC', 'Turks and Caicos Islands', 'جزر توركس وكايكوس', 'Turks and Caicos Islands', 'جزر توركس وكايكوس', 'NA', 'North America');
INSERT INTO `country` VALUES ('229', 'TV', 'Tuvalu', 'توفالو', 'Tuvaluan', 'توفالي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('230', 'UG', 'Uganda', 'أوغندا', 'Ugandan', 'أوغندي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('231', 'UA', 'Ukraine', 'أوكرانيا', 'Ukrainian', 'أوكراني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('232', 'AE', 'United Arab Emirates', 'الإمارات العربية المتحدة', 'Emirati', 'إماراتي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('233', 'GB', 'United Kingdom', 'المملكة المتحدة', 'British', 'بريطاني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('234', 'US', 'United States', 'الولايات المتحدة', 'American', 'أمريكي', 'NA', 'North America');
INSERT INTO `country` VALUES ('235', 'UM', 'US Minor Outlying Islands', 'قائمة الولايات والمناطق الأمريكية', 'US Minor Outlying Islander', 'أمريكي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('236', 'UY', 'Uruguay', 'أورغواي', 'Uruguayan', 'أورغواي', 'SA', 'South America');
INSERT INTO `country` VALUES ('237', 'UZ', 'Uzbekistan', 'أوزباكستان', 'Uzbek', 'أوزباكستاني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('238', 'VU', 'Vanuatu', 'فانواتو', 'Vanuatuan', 'فانواتي', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('239', 'VE', 'Venezuela', 'فنزويلا', 'Venezuelan', 'فنزويلي', 'SA', 'South America');
INSERT INTO `country` VALUES ('240', 'VN', 'Vietnam', 'فيتنام', 'Vietnamese', 'فيتنامي', 'AS', 'Asia');
INSERT INTO `country` VALUES ('241', 'VI', 'Virgin Islands (U.S.)', 'الجزر العذراء الأمريكي', 'American Virgin Islander', 'أمريكي', 'NA', 'North America');
INSERT INTO `country` VALUES ('242', 'VA', 'Vatican City', 'فنزويلا', 'Vatican', 'فاتيكاني', 'EU', 'Europe');
INSERT INTO `country` VALUES ('243', 'WF', 'Wallis and Futuna Islands', 'والس وفوتونا', 'Wallisian/Futunan', 'فوتوني', 'OC', 'Oceania');
INSERT INTO `country` VALUES ('244', 'EH', 'Western Sahara', 'الصحراء الغربية', 'Sahrawian', 'صحراوي', 'AF', 'Africa');
INSERT INTO `country` VALUES ('245', 'YE', 'Yemen', 'اليمن', 'Yemeni', 'يمني', 'AS', 'Asia');
INSERT INTO `country` VALUES ('246', 'ZM', 'Zambia', 'زامبيا', 'Zambian', 'زامبياني', 'AF', 'Africa');
INSERT INTO `country` VALUES ('247', 'ZW', 'Zimbabwe', 'زمبابوي', 'Zimbabwean', 'زمبابوي', 'AF', 'Africa');

-- ----------------------------
-- Table structure for emirates
-- ----------------------------
DROP TABLE IF EXISTS `emirates`;
CREATE TABLE `emirates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of emirates
-- ----------------------------
INSERT INTO `emirates` VALUES ('1', 'Abu Dhabi', 'أبو ظبي');
INSERT INTO `emirates` VALUES ('2', 'Ajman', 'عجمان');
INSERT INTO `emirates` VALUES ('3', 'Dubai', 'دبي');
INSERT INTO `emirates` VALUES ('4', 'Fujairah', 'الفجيرة');
INSERT INTO `emirates` VALUES ('5', 'Ras Al Khaimah', 'رأس الخيمة');
INSERT INTO `emirates` VALUES ('6', 'Sharjah', 'الشارقة');
INSERT INTO `emirates` VALUES ('7', 'Umm Al Quwain', 'أم القيوين');
INSERT INTO `emirates` VALUES ('8', 'Al Ain', 'أل أين');

-- ----------------------------
-- Table structure for employee_custom_schedule
-- ----------------------------
DROP TABLE IF EXISTS `employee_custom_schedule`;
CREATE TABLE `employee_custom_schedule` (
  `custom_id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(255) DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `is_dayoff` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `emp_custom_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`custom_id`),
  KEY `emp_custom_id` (`emp_custom_id`),
  CONSTRAINT `employee_custom_schedule_ibfk_1` FOREIGN KEY (`emp_custom_id`) REFERENCES `employee_custom_work_schedule` (`emp_custom_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_custom_schedule
-- ----------------------------
INSERT INTO `employee_custom_schedule` VALUES ('8', 'Sunday', '08:00:00', '16:00:00', null, '2019-11-30 10:40:45', '2019-11-30 10:40:45', null, '3');
INSERT INTO `employee_custom_schedule` VALUES ('9', 'Monday', '08:00:00', '16:00:00', null, '2019-11-30 10:40:45', '2019-11-30 10:40:45', null, '3');
INSERT INTO `employee_custom_schedule` VALUES ('10', 'Tuesday', '08:00:00', '16:00:00', null, '2019-11-30 10:40:45', '2019-11-30 10:40:45', null, '3');
INSERT INTO `employee_custom_schedule` VALUES ('11', 'Wednesday', '08:00:00', '16:00:00', null, '2019-11-30 10:40:45', '2019-11-30 10:40:45', null, '3');
INSERT INTO `employee_custom_schedule` VALUES ('12', 'Thursday', '08:00:00', '16:00:00', null, '2019-11-30 10:40:45', '2019-11-30 10:40:45', null, '3');
INSERT INTO `employee_custom_schedule` VALUES ('13', 'Friday', null, null, '1', '2019-11-30 10:40:45', '2019-11-30 10:40:45', null, '3');
INSERT INTO `employee_custom_schedule` VALUES ('14', 'Saturday', '08:00:00', '16:00:00', null, '2019-11-30 10:40:45', '2019-11-30 10:40:45', null, '3');
INSERT INTO `employee_custom_schedule` VALUES ('15', 'Sunday', '08:00:00', '16:00:00', null, '2019-11-30 11:09:32', '2019-11-30 11:09:32', null, '13');
INSERT INTO `employee_custom_schedule` VALUES ('16', 'Monday', '08:00:00', '16:00:00', null, '2019-11-30 11:09:32', '2019-11-30 11:09:32', null, '13');
INSERT INTO `employee_custom_schedule` VALUES ('17', 'Tuesday', '08:00:00', '16:00:00', null, '2019-11-30 11:09:32', '2019-11-30 11:09:32', null, '13');
INSERT INTO `employee_custom_schedule` VALUES ('18', 'Wednesday', '08:00:00', '16:00:00', null, '2019-11-30 11:09:32', '2019-11-30 11:09:32', null, '13');
INSERT INTO `employee_custom_schedule` VALUES ('19', 'Thursday', '08:00:00', '16:00:00', null, '2019-11-30 11:09:32', '2019-11-30 11:09:32', null, '13');
INSERT INTO `employee_custom_schedule` VALUES ('20', 'Friday', null, null, '1', '2019-11-30 11:09:32', '2019-11-30 11:09:32', null, '13');
INSERT INTO `employee_custom_schedule` VALUES ('21', 'Saturday', null, null, '1', '2019-11-30 11:09:32', '2019-11-30 11:09:32', null, '13');

-- ----------------------------
-- Table structure for employee_custom_work_schedule
-- ----------------------------
DROP TABLE IF EXISTS `employee_custom_work_schedule`;
CREATE TABLE `employee_custom_work_schedule` (
  `emp_custom_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `emp_custom_name` varchar(255) DEFAULT NULL,
  `emp_custom_name_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`emp_custom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_custom_work_schedule
-- ----------------------------
INSERT INTO `employee_custom_work_schedule` VALUES ('3', '3', 'My Custom Schedule', 'My Custom Schedule', '2019-11-30 11:10:02', '2019-11-30 11:10:02', null);
INSERT INTO `employee_custom_work_schedule` VALUES ('13', '3', 'Custom 1', 'Custom 1', '2019-11-30 11:09:32', '2019-11-30 11:09:32', null);

-- ----------------------------
-- Table structure for employee_leave
-- ----------------------------
DROP TABLE IF EXISTS `employee_leave`;
CREATE TABLE `employee_leave` (
  `employee_leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `leave_type_id` int(11) DEFAULT NULL,
  `leave_start` timestamp NULL DEFAULT NULL,
  `leave_end` timestamp NULL DEFAULT NULL,
  `remarks` text,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`employee_leave_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `employee_leave_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_leave
-- ----------------------------
INSERT INTO `employee_leave` VALUES ('1', '1', '1', '2019-12-04 09:00:00', '2019-12-04 17:00:00', 'Lorem ipsum dolor sit amit.', '2019-12-04 13:53:48', '2019-12-04 13:53:48', null);
INSERT INTO `employee_leave` VALUES ('2', '3', '2', '2019-12-13 09:00:00', '2020-01-13 17:00:00', 'Vacation Leave', '2019-12-04 14:01:17', '2019-12-04 14:01:17', null);
INSERT INTO `employee_leave` VALUES ('3', '3', '8', '2019-12-04 09:00:00', '2019-12-04 17:00:00', 'Absent sya kay sakit iya tiyan kay gidugo.', '2019-12-04 14:18:01', '2019-12-04 14:18:01', null);
INSERT INTO `employee_leave` VALUES ('4', '3', '3', '2019-12-06 09:00:00', '2019-12-09 17:00:00', 'Leave kay kalibangon', '2019-12-04 14:16:31', '2019-12-04 14:16:31', null);

-- ----------------------------
-- Table structure for employee_work_schedule
-- ----------------------------
DROP TABLE IF EXISTS `employee_work_schedule`;
CREATE TABLE `employee_work_schedule` (
  `employee_work_schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `schedule_type_id` int(11) DEFAULT NULL,
  `is_custom` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `emp_custom_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`employee_work_schedule_id`),
  KEY `schedule_type_id` (`schedule_type_id`),
  KEY `user_id` (`user_id`),
  KEY `emp_custom_id` (`emp_custom_id`),
  CONSTRAINT `employee_work_schedule_ibfk_1` FOREIGN KEY (`schedule_type_id`) REFERENCES `schedule_type` (`schedule_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `employee_work_schedule_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `employee_work_schedule_ibfk_3` FOREIGN KEY (`emp_custom_id`) REFERENCES `employee_custom_work_schedule` (`emp_custom_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_work_schedule
-- ----------------------------
INSERT INTO `employee_work_schedule` VALUES ('6', '3', '1', null, '2019-11-30 11:10:38', '2019-11-30 11:10:38', null, null);
INSERT INTO `employee_work_schedule` VALUES ('7', '4', '1', null, '2019-12-10 12:28:22', '2019-12-10 12:28:22', null, null);
INSERT INTO `employee_work_schedule` VALUES ('8', '6', '1', null, '2019-12-10 12:28:34', '2019-12-10 12:28:34', null, null);

-- ----------------------------
-- Table structure for event
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `description_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description_en` varchar(255) DEFAULT NULL,
  `logo_thumbnail` varchar(255) DEFAULT NULL,
  `logo_original` varchar(255) DEFAULT NULL,
  `cancel_date` timestamp NULL DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `note_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `additional_location_info` varchar(255) DEFAULT NULL,
  `note_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `last_check_by` int(11) DEFAULT NULL,
  `lock` timestamp NULL DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `permit_number` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `venue_ar` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `is_display_all` tinyint(255) DEFAULT NULL,
  `is_display_web` tinyint(4) DEFAULT '0',
  `venue_en` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `event_type_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `emirate_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `cancel_reason` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `no_of_trucks` int(11) DEFAULT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL COMMENT 'new ',
  `audience_number` varchar(255) DEFAULT NULL,
  `is_truck` tinyint(4) DEFAULT NULL,
  `is_liquor` tinyint(4) DEFAULT NULL,
  `firm` varchar(255) DEFAULT NULL,
  `full_address` varchar(255) NOT NULL,
  `paid` int(11) DEFAULT NULL,
  `paid_artist_fee` int(255) DEFAULT NULL,
  `owner_name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `event_type_sub_id` int(11) DEFAULT NULL,
  `exempt_by` int(11) DEFAULT NULL,
  `exempt_payment` int(11) DEFAULT NULL,
  `request_type` varchar(255) DEFAULT NULL COMMENT 'new , cancel ',
  PRIMARY KEY (`event_id`),
  KEY `area_id` (`area_id`),
  KEY `country_id` (`country_id`),
  KEY `emirate_id` (`emirate_id`),
  KEY `event_type_id` (`event_type_id`),
  KEY `event_type_sub_id` (`event_type_sub_id`),
  CONSTRAINT `event_ibfk_2` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`event_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event
-- ----------------------------

-- ----------------------------
-- Table structure for event_additional_requirement
-- ----------------------------
DROP TABLE IF EXISTS `event_additional_requirement`;
CREATE TABLE `event_additional_requirement` (
  `additional_requirement_id` int(11) NOT NULL AUTO_INCREMENT,
  `requirement_name_ar` varchar(255) DEFAULT NULL,
  `requirement_description_ar` varchar(255) DEFAULT NULL,
  `requirement_description` varchar(255) DEFAULT NULL,
  `requirement_name` varchar(255) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`additional_requirement_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_additional_requirement
-- ----------------------------

-- ----------------------------
-- Table structure for event_approver
-- ----------------------------
DROP TABLE IF EXISTS `event_approver`;
CREATE TABLE `event_approver` (
  `event_approver_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1 for client otherwise 0 for staff',
  `event_comment_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `checked_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`event_approver_id`),
  KEY `event_id` (`event_id`),
  KEY `event_comment_id` (`event_comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_approver
-- ----------------------------
INSERT INTO `event_approver` VALUES ('6', '1', '1', '1', '6', '11', '2019-11-24 15:03:37', 'approved-unpaid', '2019-11-24 15:03:37', '2019-11-24 15:03:37', null);
INSERT INTO `event_approver` VALUES ('7', '10', null, '1', '8', '1', '2019-11-24 17:26:41', 'approved-unpaid', '2019-11-24 17:26:41', '2019-11-24 17:26:41', null);
INSERT INTO `event_approver` VALUES ('8', '10', null, '1', '9', '2', '2019-11-24 17:34:21', 'approved-unpaid', '2019-11-24 17:34:21', '2019-11-24 17:34:21', null);
INSERT INTO `event_approver` VALUES ('9', '1', '1', '1', '10', '6', '2019-11-26 18:10:43', 'approved-unpaid', '2019-11-26 18:10:43', '2019-11-26 18:10:43', null);
INSERT INTO `event_approver` VALUES ('10', '1', '1', '1', '13', '7', '2019-11-27 12:02:50', 'approved-unpaid', '2019-11-27 12:02:50', '2019-11-27 12:02:50', null);

-- ----------------------------
-- Table structure for event_check
-- ----------------------------
DROP TABLE IF EXISTS `event_check`;
CREATE TABLE `event_check` (
  `event_check_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `issued_date` varchar(255) DEFAULT NULL,
  `expired_date` varchar(255) DEFAULT NULL,
  `time_start` varchar(255) DEFAULT NULL,
  `time_end` varchar(255) DEFAULT NULL,
  `permit_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `venue_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `venue_en` varchar(255) DEFAULT NULL,
  `event_type` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `area_en` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `emirates` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`event_check_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_check
-- ----------------------------

-- ----------------------------
-- Table structure for event_comment
-- ----------------------------
DROP TABLE IF EXISTS `event_comment`;
CREATE TABLE `event_comment` (
  `event_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL COMMENT 'admin or client',
  `government_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `comment_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `exempt_payment` varchar(255) DEFAULT NULL,
  `type` tinyint(4) DEFAULT '0' COMMENT '1 for client comment otherwise 0',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_comment_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_comment
-- ----------------------------

-- ----------------------------
-- Table structure for event_liquor
-- ----------------------------
DROP TABLE IF EXISTS `event_liquor`;
CREATE TABLE `event_liquor` (
  `event_liquor_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `company_name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `company_name_en` varchar(255) DEFAULT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(12) DEFAULT NULL,
  `created_by` int(255) DEFAULT NULL,
  `purchase_receipt` varchar(255) DEFAULT NULL,
  `liquor_service` varchar(255) DEFAULT NULL,
  `liquor_types` text,
  `liquor_permit_no` varchar(255) DEFAULT NULL,
  `provided` int(11) DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_liquor_id`),
  KEY `event_id` (`event_id`),
  KEY `event_liquor_id` (`event_liquor_id`),
  CONSTRAINT `event_liquor_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_liquor
-- ----------------------------

-- ----------------------------
-- Table structure for event_liquor_truck_requirement
-- ----------------------------
DROP TABLE IF EXISTS `event_liquor_truck_requirement`;
CREATE TABLE `event_liquor_truck_requirement` (
  `liquor_truck_requirement_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT 'liquor or truck',
  `liquor_truck_id` int(11) DEFAULT NULL,
  `requirement_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `issue_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  PRIMARY KEY (`liquor_truck_requirement_id`),
  KEY `requirement_id` (`requirement_id`),
  KEY `liquor_truck_id` (`liquor_truck_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `event_liquor_truck_requirement_ibfk_1` FOREIGN KEY (`requirement_id`) REFERENCES `requirement` (`requirement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_liquor_truck_requirement_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_liquor_truck_requirement
-- ----------------------------

-- ----------------------------
-- Table structure for event_other_upload
-- ----------------------------
DROP TABLE IF EXISTS `event_other_upload`;
CREATE TABLE `event_other_upload` (
  `event_other_upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `thumbnail` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL COMMENT 'bytes',
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_other_upload_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `event_other_upload_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_other_upload
-- ----------------------------

-- ----------------------------
-- Table structure for event_requirement
-- ----------------------------
DROP TABLE IF EXISTS `event_requirement`;
CREATE TABLE `event_requirement` (
  `event_requirement_id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `event_type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `requirement_id` int(11) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`event_requirement_id`),
  KEY `event_type_id` (`event_type_id`),
  KEY `event_id` (`event_id`),
  KEY `requirement_id` (`requirement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_requirement
-- ----------------------------

-- ----------------------------
-- Table structure for event_transaction
-- ----------------------------
DROP TABLE IF EXISTS `event_transaction`;
CREATE TABLE `event_transaction` (
  `event_transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `vat` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `total_trucks` int(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`event_transaction_id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `event_transaction_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_transaction_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_transaction
-- ----------------------------

-- ----------------------------
-- Table structure for event_truck
-- ----------------------------
DROP TABLE IF EXISTS `event_truck`;
CREATE TABLE `event_truck` (
  `event_truck_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `company_name_en` varchar(255) DEFAULT NULL,
  `plate_number` varchar(255) DEFAULT NULL,
  `food_type` varchar(255) DEFAULT NULL,
  `registration_issued_date` date DEFAULT NULL,
  `registration_expired_date` date DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_truck_id`),
  KEY `event_id` (`event_id`),
  KEY `food_type_id` (`food_type`),
  CONSTRAINT `event_truck_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_truck
-- ----------------------------

-- ----------------------------
-- Table structure for event_type
-- ----------------------------
DROP TABLE IF EXISTS `event_type`;
CREATE TABLE `event_type` (
  `event_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description_en` varchar(255) DEFAULT NULL,
  `description_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `amount` double(255,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_type
-- ----------------------------
INSERT INTO `event_type` VALUES ('1', 'Entertainment Events ', '#5867dd', 'فعاليات ترفيهية ', null, null, '200', null, '2019-12-16 18:06:35', null, null, null, null);
INSERT INTO `event_type` VALUES ('2', 'Business Events', '#0abb87', 'فعاليات قطاع الأعمال', null, null, '200', null, '2020-01-15 17:25:26', null, null, null, null);
INSERT INTO `event_type` VALUES ('3', 'Educational Events ', '#ffb822', 'الفعاليات الثقافية', null, null, '200', null, '2019-12-16 18:06:46', null, null, null, null);
INSERT INTO `event_type` VALUES ('4', 'Religious Events', '#fd397a', 'الفعاليات الدينية', null, null, '0', null, '2020-01-16 09:39:45', null, null, null, null);
INSERT INTO `event_type` VALUES ('5', 'Charitable Events', '#282a3c', 'الفعاليات الخيرية', null, null, '0', null, '2019-12-24 15:52:34', null, null, null, null);
INSERT INTO `event_type` VALUES ('6', 'Sports Events', '#9c27b0', 'الفعاليات الرياضية', null, null, '200', null, '2020-01-15 17:27:29', null, null, null, null);
INSERT INTO `event_type` VALUES ('9', 'Cultural Events', null, 'الفعاليات  الثقافية', null, null, '0', null, '2020-01-16 09:42:44', null, null, null, null);

-- ----------------------------
-- Table structure for event_type_requirement
-- ----------------------------
DROP TABLE IF EXISTS `event_type_requirement`;
CREATE TABLE `event_type_requirement` (
  `event_type_requirement_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type_id` int(11) DEFAULT NULL,
  `is_mandatory` tinyint(4) DEFAULT NULL,
  `requirement_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_type_requirement_id`),
  KEY `requirement_id` (`requirement_id`) USING BTREE,
  KEY `event_type_id` (`event_type_id`),
  CONSTRAINT `event_type_requirement_ibfk_1` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`event_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_type_requirement_ibfk_2` FOREIGN KEY (`requirement_id`) REFERENCES `requirement` (`requirement_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_type_requirement
-- ----------------------------
INSERT INTO `event_type_requirement` VALUES ('1', '1', '1', '7');
INSERT INTO `event_type_requirement` VALUES ('3', '3', '1', '3');
INSERT INTO `event_type_requirement` VALUES ('7', '1', '1', '8');
INSERT INTO `event_type_requirement` VALUES ('8', '1', '1', '3');
INSERT INTO `event_type_requirement` VALUES ('9', '1', '1', '4');
INSERT INTO `event_type_requirement` VALUES ('10', '2', '1', '3');
INSERT INTO `event_type_requirement` VALUES ('14', '5', null, '22');
INSERT INTO `event_type_requirement` VALUES ('15', '2', '1', '7');
INSERT INTO `event_type_requirement` VALUES ('16', '2', '1', '14');
INSERT INTO `event_type_requirement` VALUES ('17', '6', '1', '7');
INSERT INTO `event_type_requirement` VALUES ('18', '6', '1', '13');
INSERT INTO `event_type_requirement` VALUES ('19', '6', '1', '15');
INSERT INTO `event_type_requirement` VALUES ('21', '4', '1', '14');
INSERT INTO `event_type_requirement` VALUES ('23', '9', '1', '7');
INSERT INTO `event_type_requirement` VALUES ('24', '1', '0', '33');
INSERT INTO `event_type_requirement` VALUES ('25', '2', '0', '33');
INSERT INTO `event_type_requirement` VALUES ('26', '3', '0', '33');
INSERT INTO `event_type_requirement` VALUES ('27', '4', '0', '33');
INSERT INTO `event_type_requirement` VALUES ('28', '5', '0', '33');
INSERT INTO `event_type_requirement` VALUES ('29', '6', '0', '33');
INSERT INTO `event_type_requirement` VALUES ('32', '9', '0', '33');

-- ----------------------------
-- Table structure for event_type_sub
-- ----------------------------
DROP TABLE IF EXISTS `event_type_sub`;
CREATE TABLE `event_type_sub` (
  `event_type_sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_name_en` varchar(255) DEFAULT NULL,
  `sub_name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `event_type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`event_type_sub_id`),
  KEY `event_type_id` (`event_type_id`),
  CONSTRAINT `event_type_sub_ibfk_1` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`event_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_type_sub
-- ----------------------------
INSERT INTO `event_type_sub` VALUES ('1', 'Business meetings', 'إجتماعات أعمال', '2', '2019-12-24 09:46:41', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('2', 'Business conferences', 'مؤتمرات أعمال', '2', '2019-12-29 09:51:29', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('3', 'Business seminars', 'ندوات أعمال', '2', '2019-12-29 09:54:40', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('4', 'Business lectures', 'محاضرات أعمال', '2', '2019-12-29 09:55:45', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('5', 'Business Summit', 'قمة أعمال', '2', '2019-12-29 09:56:31', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('6', 'Exhibitions Commercial Trade / consumer/specialized', 'معارض تجارية / استهلاكية / تخصصية', '2', '2019-12-29 09:57:09', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('7', 'Auctions', 'المزادات', '1', '2019-12-29 10:01:29', '2019-12-29 10:01:43', null);
INSERT INTO `event_type_sub` VALUES ('8', 'Concerts', 'حفلات غنائية', '1', '2019-12-29 10:01:34', '2019-12-29 10:01:47', null);
INSERT INTO `event_type_sub` VALUES ('9', 'DJ Concerts', ' حفلات دى جى', '1', '2019-12-29 10:02:18', '2019-12-29 10:02:24', null);
INSERT INTO `event_type_sub` VALUES ('10', 'Musical performances', 'عروض موسيقية', '1', '2019-12-29 10:03:03', '2019-12-29 10:03:09', null);
INSERT INTO `event_type_sub` VALUES ('11', 'Singing performances', 'عروض غنائية', '1', '2019-12-29 10:03:38', '2019-12-29 10:03:43', null);
INSERT INTO `event_type_sub` VALUES ('12', 'Theatrical performances', 'عروض مسرحية', '1', '2019-12-29 10:04:29', '2019-12-29 10:04:33', null);
INSERT INTO `event_type_sub` VALUES ('13', 'Circus performances', ' عروض سيرك', '1', '2019-12-29 10:05:20', '2019-12-29 10:05:25', null);
INSERT INTO `event_type_sub` VALUES ('14', 'Dancing and artistic performance', ' عروض رقص وفنون أداء', '1', '2019-12-29 10:05:59', '2019-12-29 10:06:04', null);
INSERT INTO `event_type_sub` VALUES ('15', 'Fashion shows', ' عروض أزياء', '1', '2019-12-29 10:06:45', '2019-12-29 10:06:50', null);
INSERT INTO `event_type_sub` VALUES ('16', 'Festival', 'مهرجان', '1', '2019-12-29 10:07:24', '2019-12-29 10:07:30', null);
INSERT INTO `event_type_sub` VALUES ('17', 'Carnival', 'كرنفال', '1', '2019-12-29 10:08:03', '2019-12-29 10:08:08', null);
INSERT INTO `event_type_sub` VALUES ('18', 'Firework shows', ' عروض الألعاب النارية', '1', '2019-12-29 10:08:36', '2019-12-29 10:08:41', null);
INSERT INTO `event_type_sub` VALUES ('19', 'Laser shows', 'عروض الليزر', '1', '2019-12-29 10:09:11', '2019-12-29 10:09:16', null);
INSERT INTO `event_type_sub` VALUES ('20', 'Air shows', 'العروض الجوىة', '1', '2019-12-29 10:09:44', '2019-12-29 10:09:48', null);
INSERT INTO `event_type_sub` VALUES ('21', 'Marine shows', ' عروض بحرية', '1', '2019-12-29 10:10:21', '2019-12-29 10:10:26', null);
INSERT INTO `event_type_sub` VALUES ('22', 'Classic Shows (Cars / Bikes / Boats)', '  العروض الكلاسيكية ( سيارات / دراجات / القوارب)', '1', '2019-12-29 10:11:20', '2019-12-29 10:11:24', null);
INSERT INTO `event_type_sub` VALUES ('23', 'Yacht Shows', ' عرض اليخوت', '1', '2019-12-29 10:12:24', '2019-12-29 10:12:28', null);
INSERT INTO `event_type_sub` VALUES ('24', 'Entertainment shows', 'عروض ترفيهية', '1', '2019-12-29 10:12:56', '2019-12-29 10:12:59', null);
INSERT INTO `event_type_sub` VALUES ('25', 'Cultural / literary seminars', '  ندوات ثقافية / أدبية', '9', '2019-12-29 10:23:23', '2020-01-16 09:42:44', null);
INSERT INTO `event_type_sub` VALUES ('26', 'Cultural / literary lectures', 'محاضرات ثقافية / أدبية', '9', '2019-12-29 10:24:01', '2020-01-16 09:42:44', null);
INSERT INTO `event_type_sub` VALUES ('27', 'Cultural / literary conferences', '  المؤتمرات ثقافية / أدبية', '9', '2019-12-29 10:25:43', '2020-01-16 09:42:44', null);
INSERT INTO `event_type_sub` VALUES ('28', 'Artistic lectures', 'محاضرات فنية', '9', '2019-12-29 10:26:18', '2020-01-16 09:42:44', null);
INSERT INTO `event_type_sub` VALUES ('29', 'Religious lectures', 'محاضرات دينية', '4', '2019-12-29 10:27:03', '2020-01-16 09:39:45', null);
INSERT INTO `event_type_sub` VALUES ('30', 'Religious seminars', 'ندوات دينية', '4', '2019-12-29 10:27:33', '2020-01-16 09:39:45', null);
INSERT INTO `event_type_sub` VALUES ('31', 'Charitable fundraising events', 'فعاليات جمع الأموال الخيرية', '5', '2019-12-29 10:28:19', '2019-12-29 10:28:23', null);
INSERT INTO `event_type_sub` VALUES ('32', 'Charity dinner parties', ' حفلات العشاء الخيرية', '5', '2019-12-29 10:29:09', '2019-12-29 10:29:11', null);
INSERT INTO `event_type_sub` VALUES ('33', 'Combat sports', 'الرياضات القتالية', '6', '2019-12-29 10:30:41', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('34', 'Running races', 'سباقات العدو', '6', '2019-12-29 10:31:15', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('35', 'Bicycles racing', 'سباقات الدراجات', '6', '2019-12-29 10:32:08', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('36', 'Boat races', 'سباقات القوارب', '6', '2019-12-29 10:32:35', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('37', 'Rowing wooden boats or others', 'تجديف القوارب الخشبية أو غيرها', '6', '2019-12-29 10:33:59', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('38', 'Bodybuilding Show', 'عرض كمال الأجسام', '6', '2019-12-29 10:36:00', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('39', 'Arm wrestling', 'مصارعة الذراعين', '6', '2019-12-29 10:37:03', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('40', 'Weights lifting', 'رفع الأوزان', '6', '2019-12-29 10:37:37', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('41', 'Car racing', 'سباق السيارات', '6', '2019-12-29 10:38:10', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('42', 'Walking races', 'سباقات المشى', '6', '2019-12-29 10:38:47', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('43', 'Water bike racing', 'سباق الدراجات المائية', '6', '2019-12-29 10:39:25', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('44', 'Mountain biking', 'رياضة الدراجات الهوائية الجبلية', '6', '2019-12-29 10:40:00', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('45', 'Motorcycle Race', 'سباق دراجات نارية', '6', '2019-12-29 10:40:54', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('46', 'Mountaineering', 'تسلق الجبال', '6', '2019-12-29 10:42:19', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('47', 'Sports shows', 'عروض رياضية', '6', '2019-12-29 10:43:03', '2020-01-15 17:27:29', null);
INSERT INTO `event_type_sub` VALUES ('48', '(Except for those organized by local, federal and international sports federations)', '(باستثناء تلك التي تنظم من قبل الاتحادات الرياضية المحلية والاتحادية والدولية)', '6', '2019-12-29 10:43:50', '2020-01-15 17:27:29', null);

-- ----------------------------
-- Table structure for gender
-- ----------------------------
DROP TABLE IF EXISTS `gender`;
CREATE TABLE `gender` (
  `gender_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gender
-- ----------------------------
INSERT INTO `gender` VALUES ('1', 'male', 'male', null, '2019-09-23 17:10:40');
INSERT INTO `gender` VALUES ('2', 'female', 'female', null, '2019-09-23 17:10:40');

-- ----------------------------
-- Table structure for general_setting
-- ----------------------------
DROP TABLE IF EXISTS `general_setting`;
CREATE TABLE `general_setting` (
  `general_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `inspection_per_day` varchar(255) DEFAULT NULL,
  `event_grace_period_amendment` varchar(255) DEFAULT NULL,
  `artist_permit_grace_period_amendment` varchar(255) DEFAULT NULL,
  `artist_permit_grace_period_renew` varchar(255) DEFAULT NULL,
  `artist_start_after` varchar(255) DEFAULT NULL,
  `food_truck_fee` varchar(255) DEFAULT NULL,
  `event_start_after` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `liquor_fee` varchar(255) DEFAULT NULL,
  `artist_amendment_fee` double(255,0) DEFAULT NULL,
  PRIMARY KEY (`general_setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of general_setting
-- ----------------------------
INSERT INTO `general_setting` VALUES ('1', '2', '10', '2', '10', '7', '150', '7', '2020-01-22 11:15:19', '2020-01-22 11:15:19', null, '5000', '500');

-- ----------------------------
-- Table structure for government
-- ----------------------------
DROP TABLE IF EXISTS `government`;
CREATE TABLE `government` (
  `government_id` int(11) NOT NULL AUTO_INCREMENT,
  `government_name_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `government_name_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`government_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of government
-- ----------------------------
INSERT INTO `government` VALUES ('1', 'Police Department', 'Police Department', '2019-12-22 12:08:09', null, null);
INSERT INTO `government` VALUES ('2', 'Health Department', 'Health Department', '2019-12-22 12:08:12', null, null);

-- ----------------------------
-- Table structure for happiness
-- ----------------------------
DROP TABLE IF EXISTS `happiness`;
CREATE TABLE `happiness` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `application_id` int(11) DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of happiness
-- ----------------------------
INSERT INTO `happiness` VALUES ('1', 'event', '4', null, null, null, '2019-11-26 12:17:35', '2019-11-26 12:17:35');
INSERT INTO `happiness` VALUES ('2', 'event', '3', null, null, null, '2019-11-26 12:19:14', '2019-11-26 12:19:14');
INSERT INTO `happiness` VALUES ('3', 'event', '7', 'test', '100', null, '2019-11-26 12:24:29', '2019-11-26 12:24:29');
INSERT INTO `happiness` VALUES ('4', 'event', '7', 'test', '100', '2', '2019-11-26 12:39:46', '2019-11-26 12:39:46');
INSERT INTO `happiness` VALUES ('5', 'artist', '6', 'test', '1', '2', '2019-11-26 16:17:59', '2019-11-26 16:17:59');
INSERT INTO `happiness` VALUES ('6', 'event', '13', 'fdsf', '100', '2', '2019-12-09 18:30:25', '2019-12-09 18:30:25');
INSERT INTO `happiness` VALUES ('7', 'event', '10', 'fadsf', '50', '2', '2019-12-09 18:55:12', '2019-12-09 18:55:12');
INSERT INTO `happiness` VALUES ('8', 'event', '7', 'fdsaf', '50', '2', '2019-12-09 18:56:22', '2019-12-09 18:56:22');
INSERT INTO `happiness` VALUES ('9', 'event', '39', 'dsfads', '100', '2', '2019-12-15 13:08:52', '2019-12-15 13:08:52');
INSERT INTO `happiness` VALUES ('10', 'event', '40', 'test', '100', '2', '2019-12-15 14:32:32', '2019-12-15 14:32:32');
INSERT INTO `happiness` VALUES ('11', 'event', '12', 'fdasf', '100', '2', '2019-12-16 13:08:14', '2019-12-16 13:08:14');
INSERT INTO `happiness` VALUES ('12', 'artist', '49', 'fdasf', '1', '2', '2019-12-18 10:43:42', '2019-12-18 10:43:42');
INSERT INTO `happiness` VALUES ('13', 'artist', '53', 'fdasf', '3', '2', '2019-12-18 11:49:42', '2019-12-18 11:49:42');
INSERT INTO `happiness` VALUES ('14', 'artist', '54', 'great ui', '1', '2', '2019-12-18 15:53:55', '2019-12-18 15:53:55');
INSERT INTO `happiness` VALUES ('15', 'artist', '55', 'fdasf', '1', '2', '2019-12-18 17:28:17', '2019-12-18 17:28:17');
INSERT INTO `happiness` VALUES ('16', 'event', '15', 'fds', '100', '2', '2019-12-18 17:46:35', '2019-12-18 17:46:35');
INSERT INTO `happiness` VALUES ('17', 'event', '16', 'fdsaf', '100', '2', '2019-12-18 18:02:28', '2019-12-18 18:02:28');
INSERT INTO `happiness` VALUES ('18', 'artist', '52', 'gg', '1', '2', '2019-12-19 12:16:30', '2019-12-19 12:16:30');
INSERT INTO `happiness` VALUES ('19', 'artist', '51', 'fdsa', '1', '2', '2019-12-19 12:21:59', '2019-12-19 12:21:59');
INSERT INTO `happiness` VALUES ('20', 'artist', '63', 'fdsaf', '1', '2', '2019-12-21 14:58:54', '2019-12-21 14:58:54');
INSERT INTO `happiness` VALUES ('21', 'artist', '74', 'fdasf', '1', '9', '2019-12-24 10:44:39', '2019-12-24 10:44:39');
INSERT INTO `happiness` VALUES ('22', 'artist', '73', 'fdsaf', '1', '9', '2019-12-24 10:44:58', '2019-12-24 10:44:58');
INSERT INTO `happiness` VALUES ('23', 'event', '36', 'hjk', '100', '9', '2019-12-24 11:59:34', '2019-12-24 11:59:34');
INSERT INTO `happiness` VALUES ('24', 'event', '27', 'fads', '100', '2', '2019-12-25 10:32:49', '2019-12-25 10:32:49');
INSERT INTO `happiness` VALUES ('25', 'artist', '80', 'fasd', '1', '2', '2019-12-26 16:03:48', '2019-12-26 16:03:48');
INSERT INTO `happiness` VALUES ('29', 'event', '25', 'fdaf', '100', '2', '2019-12-26 17:33:13', '2019-12-26 17:33:13');
INSERT INTO `happiness` VALUES ('30', 'event', '47', 'fdsa', '50', '2', '2019-12-30 12:16:54', '2019-12-30 12:16:54');
INSERT INTO `happiness` VALUES ('31', 'artist', '5', 'fdasf', '1', '2', '2019-12-31 18:02:40', '2019-12-31 18:02:40');
INSERT INTO `happiness` VALUES ('32', 'event', '52', 'testing', '100', '2', '2020-01-15 18:28:19', '2020-01-15 18:28:19');
INSERT INTO `happiness` VALUES ('33', 'artist', '17', 'all good', '100', '2', '2020-01-15 18:29:11', '2020-01-15 18:29:11');
INSERT INTO `happiness` VALUES ('34', 'event', '54', 'nice', '100', '2', '2020-01-15 18:42:32', '2020-01-15 18:42:32');
INSERT INTO `happiness` VALUES ('35', 'event', '57', 'nice', '100', '2', '2020-01-16 12:27:03', '2020-01-16 12:27:03');
INSERT INTO `happiness` VALUES ('36', 'artist', '20', null, '100', '2', '2020-01-16 15:50:15', '2020-01-16 15:50:15');
INSERT INTO `happiness` VALUES ('37', 'artist', '22', null, '100', '2', '2020-01-16 16:03:25', '2020-01-16 16:03:25');
INSERT INTO `happiness` VALUES ('38', 'artist', '19', 'fdsa', '100', '2', '2020-01-21 11:54:47', '2020-01-21 11:54:47');
INSERT INTO `happiness` VALUES ('39', 'artist', '25', 'fdsaf', '100', '2', '2020-01-21 13:33:57', '2020-01-21 13:33:57');
INSERT INTO `happiness` VALUES ('40', 'artist', '26', 'very happy', '100', '2', '2020-01-21 17:01:15', '2020-01-21 17:01:15');
INSERT INTO `happiness` VALUES ('41', 'artist', '26', 'test', '100', '2', '2020-01-21 17:11:32', '2020-01-21 17:11:32');
INSERT INTO `happiness` VALUES ('42', 'artist', '26', 'fdf', '100', '2', '2020-01-21 17:20:21', '2020-01-21 17:20:21');
INSERT INTO `happiness` VALUES ('43', 'artist', '26', 'fdasf', '100', '2', '2020-01-21 17:21:18', '2020-01-21 17:21:18');
INSERT INTO `happiness` VALUES ('44', 'artist', '27', 'yrdy', '100', '2', '2020-01-21 17:27:27', '2020-01-21 17:27:27');
INSERT INTO `happiness` VALUES ('45', 'artist', '28', 'gfsdg', '100', '2', '2020-01-21 17:48:30', '2020-01-21 17:48:30');
INSERT INTO `happiness` VALUES ('46', 'artist', '28', 'fdasf', '100', '2', '2020-01-21 18:27:41', '2020-01-21 18:27:41');
INSERT INTO `happiness` VALUES ('47', 'artist', '29', 'ok', '100', '2', '2020-01-22 09:36:10', '2020-01-22 09:36:10');
INSERT INTO `happiness` VALUES ('48', 'event', '61', 'test', '100', '2', '2020-01-22 11:14:33', '2020-01-22 11:14:33');
INSERT INTO `happiness` VALUES ('49', 'event', '61', 'ijh', '100', '2', '2020-01-22 12:12:34', '2020-01-22 12:12:34');
INSERT INTO `happiness` VALUES ('50', 'event', '61', 'fdsaf', '100', '2', '2020-01-22 12:16:17', '2020-01-22 12:16:17');
INSERT INTO `happiness` VALUES ('51', 'event', '14', 'fadsf', '100', '2', '2020-02-20 10:27:16', '2020-02-20 10:27:16');
INSERT INTO `happiness` VALUES ('52', 'event', '13', 'fdsaf', '100', '2', '2020-02-20 11:16:10', '2020-02-20 11:16:10');

-- ----------------------------
-- Table structure for holiday
-- ----------------------------
DROP TABLE IF EXISTS `holiday`;
CREATE TABLE `holiday` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(255) DEFAULT NULL,
  `holiday_name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `holiday_start` timestamp NULL DEFAULT NULL,
  `holiday_end` timestamp NULL DEFAULT NULL,
  `is_working` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of holiday
-- ----------------------------
INSERT INTO `holiday` VALUES ('3', 'National Day', 'National Day', '2019-12-01 09:00:00', '2019-12-03 17:00:00', null, '2019-12-05 09:50:42', '2019-12-05 09:50:42', null);

-- ----------------------------
-- Table structure for languages
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 DEFAULT '',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO `languages` VALUES ('1', 'English', 'الإنجليزية');
INSERT INTO `languages` VALUES ('2', 'Arabic', 'عربى');
INSERT INTO `languages` VALUES ('3', 'Hindi', 'الهندية');
INSERT INTO `languages` VALUES ('4', 'Tamil', 'تميل ');
INSERT INTO `languages` VALUES ('5', 'Telugu', 'تلج ');
INSERT INTO `languages` VALUES ('6', 'Malayalam', 'مليالم ');

-- ----------------------------
-- Table structure for leave_type
-- ----------------------------
DROP TABLE IF EXISTS `leave_type`;
CREATE TABLE `leave_type` (
  `leave_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_type_name` varchar(255) DEFAULT NULL,
  `leave_type_name_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`leave_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of leave_type
-- ----------------------------
INSERT INTO `leave_type` VALUES ('1', 'Sick Leave', 'أجازة مرضية', '2019-12-04 13:00:14', '2019-12-04 13:00:14', null);
INSERT INTO `leave_type` VALUES ('2', 'Vacation Leave', 'الإجازة', '2019-12-04 13:00:28', '2019-12-04 13:00:28', null);
INSERT INTO `leave_type` VALUES ('3', 'Maternity Leave', 'إجازة الأمومة', '2019-12-04 13:00:39', '2019-12-04 13:00:39', null);
INSERT INTO `leave_type` VALUES ('4', 'Emergency Leave', 'اجازة طارئة', '2019-12-04 13:00:50', '2019-12-04 13:00:50', null);
INSERT INTO `leave_type` VALUES ('5', 'Annual Leave', 'اجازة سنويه', '2019-12-04 13:00:53', '2019-12-04 13:00:53', null);
INSERT INTO `leave_type` VALUES ('6', 'Compensatory Off', 'قبالة التعويضية', '2019-12-04 13:01:09', '2019-12-04 13:01:09', null);
INSERT INTO `leave_type` VALUES ('7', 'Paternity Leave', 'إجازة الأبوة', '2019-12-04 13:18:21', '2019-12-04 13:18:21', null);
INSERT INTO `leave_type` VALUES ('8', 'Absent', 'غائب', '2019-12-04 13:18:21', '2019-12-04 13:18:21', null);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2020_01_18_141415_create_notifications_table', '2');

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('010aa2d1-a28c-4736-8d53-70aaf19ab1bb', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Rejected\",\"content\":\"Your application has been rejected. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 17:48:36', '2020-02-18 17:48:36');
INSERT INTO `notifications` VALUES ('0421106f-c936-4ef3-aac1-1c9a48086f13', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/3?signature=69fd47e1881c99289f6e1fd9ea8f3443f7056d59b7c44c3e1b27a7599019c790\"}', null, '2020-02-19 12:15:45', '2020-02-19 12:15:45');
INSERT INTO `notifications` VALUES ('04dab15a-ff60-43b8-898c-86f001e13af2', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/9\\/application?signature=ab79662cf40c94913e4719a8f84d92418fa6f42decd7643b3b7e9afd4d20171a\"}', null, '2020-02-19 18:56:41', '2020-02-19 18:56:41');
INSERT INTO `notifications` VALUES ('059e7267-6986-42f5-9044-e97fff3329b7', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/10?signature=b980b53d463e8a1f499fd95a39ab57150dab8be01d9eba6cef1cbf1e8769cddd\"}', null, '2020-02-19 12:54:20', '2020-02-19 12:54:20');
INSERT INTO `notifications` VALUES ('07e8e5a2-27c2-4e5a-a925-51c1408b9ba3', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/9\\/application?signature=ab79662cf40c94913e4719a8f84d92418fa6f42decd7643b3b7e9afd4d20171a\"}', null, '2020-02-19 14:21:13', '2020-02-19 14:21:13');
INSERT INTO `notifications` VALUES ('08d0f2ca-fb57-4e1a-bc86-9bd93b1c4441', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:10:52', '2020-02-18 15:10:52');
INSERT INTO `notifications` VALUES ('09bec4f9-2cdf-4a71-8ce5-9b784b715cc6', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0005<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0005<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/11\\/application?signature=3f91a2897a49673d44d0595d9ffe256692aada794effc1e30ba49d0a28c44396\"}', null, '2020-02-19 18:54:10', '2020-02-19 18:54:10');
INSERT INTO `notifications` VALUES ('0d5249b2-c83b-49b6-9ca7-5e55daef4f23', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0006<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0006<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/14\\/application?signature=d18b25e8e984cffd7804d0c13693db2f5aace2b21842b6085583561fd37513bb\"}', null, '2020-02-20 09:37:10', '2020-02-20 09:37:10');
INSERT INTO `notifications` VALUES ('0e27ffa1-9d5a-475b-93e2-42f2fea9c373', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/140\\/details?signature=0929a99de2b90258eaf8e0c2f251dd29dcd94d97acb38876b37386c17dcce7ce\"}', null, '2020-02-18 16:32:25', '2020-02-18 16:32:25');
INSERT INTO `notifications` VALUES ('0e2cf5f1-b49a-4a5c-a406-d96fd7b8601b', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/9\\/application?signature=ab79662cf40c94913e4719a8f84d92418fa6f42decd7643b3b7e9afd4d20171a\"}', null, '2020-02-19 18:29:23', '2020-02-19 18:29:23');
INSERT INTO `notifications` VALUES ('0f02e2f3-4182-40eb-8c1c-e0fad8dd0f9d', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0006<\\/b> Amended\",\"content\":\"The event permit with reference number <b>RNE0006<\\/b> is submitted for amendment.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/14\\/application?signature=d18b25e8e984cffd7804d0c13693db2f5aace2b21842b6085583561fd37513bb\"}', null, '2020-02-20 10:39:01', '2020-02-20 10:39:01');
INSERT INTO `notifications` VALUES ('102f17cc-230d-4d7b-b889-048faa4c1ece', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0004<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0004<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/13\\/application?signature=9f1a7e131bb033eaf8e5d918411f294c0827e621872e21883b57f3a3fb5672d4\"}', null, '2020-02-19 18:42:50', '2020-02-19 18:42:50');
INSERT INTO `notifications` VALUES ('10549957-d064-43a1-82ed-3e272ad1e476', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/140\\/details?signature=0929a99de2b90258eaf8e0c2f251dd29dcd94d97acb38876b37386c17dcce7ce\"}', null, '2020-02-18 17:48:00', '2020-02-18 17:48:00');
INSERT INTO `notifications` VALUES ('13a2bd65-f272-4925-a5eb-94b08387278f', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/9\\/application?signature=ab79662cf40c94913e4719a8f84d92418fa6f42decd7643b3b7e9afd4d20171a\"}', null, '2020-02-19 18:29:23', '2020-02-19 18:29:23');
INSERT INTO `notifications` VALUES ('15551525-0560-4efa-804b-9d1ab79cce22', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/5\\/application?signature=a0a35a35dd651bd6173f26f9458423bdbd835522650096f4f44eef72ddb63013\"}', null, '2020-02-19 12:28:26', '2020-02-19 12:28:26');
INSERT INTO `notifications` VALUES ('16bd5869-726e-4c9b-89e0-798df2bebeef', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:21:17', '2020-02-18 15:21:17');
INSERT INTO `notifications` VALUES ('18db7f11-50d8-4794-942b-8034f4b0b99d', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:17:14', '2020-02-18 15:17:14');
INSERT INTO `notifications` VALUES ('19071db4-4810-4dc4-95ef-239ce7c52131', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0007<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0007<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/15\\/application?signature=528f39fac28e8cb67ef7ca9099961171a7489ca1ecc64e52a2a38d2c78b16be9\"}', null, '2020-02-20 12:50:27', '2020-02-20 12:50:27');
INSERT INTO `notifications` VALUES ('1ae8111b-04bf-42cf-9278-4708d1e26552', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/9\\/application?signature=ab79662cf40c94913e4719a8f84d92418fa6f42decd7643b3b7e9afd4d20171a\"}', null, '2020-02-19 18:56:41', '2020-02-19 18:56:41');
INSERT INTO `notifications` VALUES ('1eb26c27-0bff-4885-acad-4d4da2bfbaee', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0004<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0004<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/13\\/application?signature=9f1a7e131bb033eaf8e5d918411f294c0827e621872e21883b57f3a3fb5672d4\"}', null, '2020-02-19 17:38:48', '2020-02-19 17:38:48');
INSERT INTO `notifications` VALUES ('1f6d2a26-19ac-4033-ac9d-96f8cb13a171', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 16:31:34', '2020-02-18 16:31:34');
INSERT INTO `notifications` VALUES ('1fec0ed8-6cef-4709-817e-0919b95ef6ce', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/10?signature=a4294cdf64bc45063e864204506ff2a59fbf6b1bc69377663eb0a93caf19e5c6\"}', null, '2020-02-20 09:38:06', '2020-02-20 09:38:06');
INSERT INTO `notifications` VALUES ('20bc2b61-9cd9-4e92-aa77-ba63078a7876', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:16:21', '2020-02-18 15:16:21');
INSERT INTO `notifications` VALUES ('21526058-ef3f-4a2a-b2b7-f101ed46ba66', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0004<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/13?signature=6f938d5a5d00be5e665f83f3fa3abc1e0a081c900414b7fb4f4399774e583826\"}', null, '2020-02-20 10:03:45', '2020-02-20 10:03:45');
INSERT INTO `notifications` VALUES ('24b156eb-b4aa-449a-bfad-685d451cdb96', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0009<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/17?signature=22981a8d1834e8d134f0d8412ad8b4f03bd791da41690429de0727ee2e6a646f\"}', null, '2020-02-20 15:18:56', '2020-02-20 15:18:56');
INSERT INTO `notifications` VALUES ('24c01624-b323-4279-b96d-09d87b7aad15', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 14:53:07', '2020-02-18 14:53:07');
INSERT INTO `notifications` VALUES ('263f704a-84c4-4941-b4bf-9a4134027114', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0005<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/11?signature=169cda0e3f7d32fcabae4163d43619c152d435d67b8020ab7112e029f27fd9c9\"}', null, '2020-02-20 11:04:35', '2020-02-20 11:04:35');
INSERT INTO `notifications` VALUES ('2851bfdc-7a9e-4a4f-ad37-06f0992382f3', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 17:45:03', '2020-02-18 17:45:03');
INSERT INTO `notifications` VALUES ('2c0c079e-d523-4b99-89a5-49f077670773', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/3\\/application?signature=3b5c2dfb83c4f6fcc2d936392f11b7252f5f999fa949f61b9f9ae9d53876fd95\"}', null, '2020-02-19 12:05:27', '2020-02-19 12:05:27');
INSERT INTO `notifications` VALUES ('2e69f978-751b-47c0-be59-5e33b179e3bb', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/5?signature=3e6e8d311f4c43a2d44ed3fd62fa23f4d85d897dc9e4f014eb51960025402d96\"}', null, '2020-02-19 12:38:54', '2020-02-19 12:38:54');
INSERT INTO `notifications` VALUES ('2f4ae870-c0a7-4f23-acc4-a5152bdb776c', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Payment for <b>#EP0002 is completed successfully\",\"content\":\"The payment for Event Permit <b>EP0002<\\/b> is completed successfully.  Please find the permit and payment voucher in the attachments.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event?signature=60115866b6edceca9307aa26e082d5d11d4bedb83aa8d1b41406a72f509e6c1d#valid\"}', null, '2020-02-20 11:15:50', '2020-02-20 11:15:50');
INSERT INTO `notifications` VALUES ('310ca597-98c0-4012-9a52-42fc0d7127a2', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0006<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/14?signature=f651e3b2adf8994736691f1c987d1defe404afb69551e2f4eacdd141e59eee59\"}', null, '2020-02-20 09:40:21', '2020-02-20 09:40:21');
INSERT INTO `notifications` VALUES ('319d1de7-cb59-45e0-9230-6b4842ce7bc4', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Artist Permit <b>#RNA0001<\\/b> Applied \",\"content\":\"The artist permit with reference number <b>RNA0001<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/artist_permit\\/1\\/application?signature=03bcdb121045b450eb172cdd4ab2dfc661f9723ce058f4dfe1a099d0e15b20ea\"}', null, '2020-02-18 09:30:35', '2020-02-18 09:30:35');
INSERT INTO `notifications` VALUES ('343d6b7c-894c-4ad1-987f-074889fbed17', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/1\\/application?signature=0b48c2c9818a415d4c796bbe1d328499ede871393e9d3e706d762f5bdc2861f7\"}', null, '2020-02-18 09:32:02', '2020-02-18 09:32:02');
INSERT INTO `notifications` VALUES ('3582bdc7-7fd6-4043-b390-1d66afb113dd', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0003<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/12?signature=fc7ceb94a288fb2b233a262c94c14be25bccd9a14864fda76d7e72a42a6e893b\"}', null, '2020-02-19 18:31:56', '2020-02-19 18:31:56');
INSERT INTO `notifications` VALUES ('36da362b-8dea-4c0a-9d74-840b65a1401e', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/3?signature=69fd47e1881c99289f6e1fd9ea8f3443f7056d59b7c44c3e1b27a7599019c790\"}', null, '2020-02-19 12:14:03', '2020-02-19 12:14:03');
INSERT INTO `notifications` VALUES ('37070410-50b5-4059-9aed-d49cfee72bfb', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/3\\/application?signature=3b5c2dfb83c4f6fcc2d936392f11b7252f5f999fa949f61b9f9ae9d53876fd95\"}', null, '2020-02-19 12:05:27', '2020-02-19 12:05:27');
INSERT INTO `notifications` VALUES ('37858264-266a-4398-840d-3e495ef5bb7d', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/10\\/application?signature=37f7c167874c70ee6d5e4c9aa2646163e969d761af507485b137483c7bc56249\"}', null, '2020-02-19 18:37:03', '2020-02-19 18:37:03');
INSERT INTO `notifications` VALUES ('397e4dd2-3d6a-4f14-b41e-9bc0a020d94a', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:09:30', '2020-02-18 15:09:30');
INSERT INTO `notifications` VALUES ('3a345db6-4a32-478b-8738-5a4f267c4fb2', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/10\\/application?signature=cfa0f14e015d3885ebc3989efcf37d9a4d4dcc1eebecb6a91cfee51c1de1022b\"}', null, '2020-02-19 12:53:21', '2020-02-19 12:53:21');
INSERT INTO `notifications` VALUES ('3bb85d97-f876-4158-a4af-48f6115ba269', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0005<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/11?signature=0e5ded68b396ae08aa87d109fd7b95961ed78d41810bd1c30e49cfe1046d8128\"}', null, '2020-02-19 18:02:12', '2020-02-19 18:02:12');
INSERT INTO `notifications` VALUES ('3c15ae1e-9c29-4b9a-8768-832b9af44489', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/10\\/application?signature=37f7c167874c70ee6d5e4c9aa2646163e969d761af507485b137483c7bc56249\"}', null, '2020-02-19 18:58:57', '2020-02-19 18:58:57');
INSERT INTO `notifications` VALUES ('3e0045fc-27fe-4768-8cd4-10bbc75e7220', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0004<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/13?signature=ccbdd94ce33a5dafa7b37b28e69152aa126a9d5576b78768aba852b70464f09a\"}', null, '2020-02-19 17:40:29', '2020-02-19 17:40:29');
INSERT INTO `notifications` VALUES ('3ec50b4d-4abb-45c5-b786-c2753c47ab41', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0003<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0003<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/12\\/application?signature=ec57d9e44f655b28997afa3eb565ee3893a37d8eae20e776cc81e54199541f0b\"}', null, '2020-02-19 16:03:21', '2020-02-19 16:03:21');
INSERT INTO `notifications` VALUES ('3f273fb7-340b-4028-be21-5303229d32ea', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/3?signature=69fd47e1881c99289f6e1fd9ea8f3443f7056d59b7c44c3e1b27a7599019c790\"}', null, '2020-02-19 12:06:15', '2020-02-19 12:06:15');
INSERT INTO `notifications` VALUES ('3fc1291d-dffb-444d-b7fd-308caccfeb8a', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0005<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0005<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/11\\/application?signature=3f91a2897a49673d44d0595d9ffe256692aada794effc1e30ba49d0a28c44396\"}', null, '2020-02-19 18:54:10', '2020-02-19 18:54:10');
INSERT INTO `notifications` VALUES ('409f1b91-a395-44fb-8191-6a608ee07c9f', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0005<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0005<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/11\\/application?signature=3f91a2897a49673d44d0595d9ffe256692aada794effc1e30ba49d0a28c44396\"}', null, '2020-02-19 17:59:54', '2020-02-19 17:59:54');
INSERT INTO `notifications` VALUES ('40dc03fd-3a8f-4659-96f8-9e8744666e49', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/3\\/application?signature=3b5c2dfb83c4f6fcc2d936392f11b7252f5f999fa949f61b9f9ae9d53876fd95\"}', null, '2020-02-19 12:02:49', '2020-02-19 12:02:49');
INSERT INTO `notifications` VALUES ('4394a8f7-04fe-462b-9fcd-1c88e3b12921', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0009<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0009<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/17\\/application?signature=035089226649db8765f82106469c4291d5f4bbbd624e17b887066090f7eec87a\"}', null, '2020-02-20 15:17:25', '2020-02-20 15:17:25');
INSERT INTO `notifications` VALUES ('44b94c2d-8684-4a61-b7f5-38b7a2274dca', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/3?signature=0719c937713fab885d20e42d6e1a7c2f5d0d77b2c6caa9c8a23318cadad1201f\"}', null, '2020-02-19 12:04:09', '2020-02-19 12:04:09');
INSERT INTO `notifications` VALUES ('44d52a15-3a22-4720-a160-827d280deded', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:08:29', '2020-02-18 15:08:29');
INSERT INTO `notifications` VALUES ('4659d4c1-40bc-4f9b-8d68-08a1e3310409', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/140\\/details?signature=0929a99de2b90258eaf8e0c2f251dd29dcd94d97acb38876b37386c17dcce7ce\"}', null, '2020-02-18 17:47:54', '2020-02-18 17:47:54');
INSERT INTO `notifications` VALUES ('47425c24-ae59-4f64-8e9c-a515d4520026', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/3\\/application?signature=3b5c2dfb83c4f6fcc2d936392f11b7252f5f999fa949f61b9f9ae9d53876fd95\"}', null, '2020-02-19 12:16:23', '2020-02-19 12:16:23');
INSERT INTO `notifications` VALUES ('482c9a68-7cd3-48e7-96d7-9c104f61879a', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0003<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0003<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/12\\/application?signature=ec57d9e44f655b28997afa3eb565ee3893a37d8eae20e776cc81e54199541f0b\"}', null, '2020-02-19 18:48:48', '2020-02-19 18:48:48');
INSERT INTO `notifications` VALUES ('4e273479-4aed-4052-a1e0-dafdc618b632', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Rejected\",\"content\":\"Your application has been rejected. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 17:48:32', '2020-02-18 17:48:32');
INSERT INTO `notifications` VALUES ('4f406502-3901-42e7-9839-75d8978dc923', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/3\\/application?signature=3b5c2dfb83c4f6fcc2d936392f11b7252f5f999fa949f61b9f9ae9d53876fd95\"}', null, '2020-02-19 12:11:47', '2020-02-19 12:11:47');
INSERT INTO `notifications` VALUES ('5074be16-b6d1-45f2-9a73-9e6f8e86857a', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/1?signature=8ce77940533bb1e9a22ed0b883ba0171d0e522ba44728044cdd8a5be694541f5\"}', null, '2020-02-19 11:22:13', '2020-02-19 11:22:13');
INSERT INTO `notifications` VALUES ('51dd984b-7310-4c1e-998e-5378075daa08', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/3\\/application?signature=3b5c2dfb83c4f6fcc2d936392f11b7252f5f999fa949f61b9f9ae9d53876fd95\"}', null, '2020-02-19 12:09:31', '2020-02-19 12:09:31');
INSERT INTO `notifications` VALUES ('51edfbf8-b198-4fa5-9f47-63705a3211f6', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0006<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/14?signature=f651e3b2adf8994736691f1c987d1defe404afb69551e2f4eacdd141e59eee59\"}', null, '2020-02-20 10:08:37', '2020-02-20 10:08:37');
INSERT INTO `notifications` VALUES ('5418463f-4490-4cea-b32f-d10d67713eb7', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 14:52:54', '2020-02-18 14:52:54');
INSERT INTO `notifications` VALUES ('542a6a54-6587-4a2b-92ba-6b7bbefe8323', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0003<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0003<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/12\\/application?signature=ec57d9e44f655b28997afa3eb565ee3893a37d8eae20e776cc81e54199541f0b\"}', null, '2020-02-20 14:50:32', '2020-02-20 14:50:32');
INSERT INTO `notifications` VALUES ('54471246-31c5-4045-bfc6-3aa671ada5bf', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/4\\/application?signature=b4960741662eb630844fe73cebee3e62c0289dc10149328433d7aba72609a5c8\"}', null, '2020-02-19 12:27:49', '2020-02-19 12:27:49');
INSERT INTO `notifications` VALUES ('56828ed4-e9d3-484b-9594-fc9f49449c83', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/9\\/application?signature=ab79662cf40c94913e4719a8f84d92418fa6f42decd7643b3b7e9afd4d20171a\"}', null, '2020-02-19 12:52:21', '2020-02-19 12:52:21');
INSERT INTO `notifications` VALUES ('57ad4bbb-f8a9-4df9-98aa-538abeeb1dd1', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Artist Permit <b># RNA0001<\\/b> - Application Rejected\",\"content\":\"Your application with the reference number <b>RNA0001<\\/b> has been rejected. To view the details, please click the button below.\",\"url\":\"#\"}', null, '2020-02-18 16:58:13', '2020-02-18 16:58:13');
INSERT INTO `notifications` VALUES ('5a1c4329-d66e-4a96-94ed-05373e19de6b', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0003<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/12?signature=fc7ceb94a288fb2b233a262c94c14be25bccd9a14864fda76d7e72a42a6e893b\"}', null, '2020-02-20 10:12:21', '2020-02-20 10:12:21');
INSERT INTO `notifications` VALUES ('5b9ad1e3-6583-483e-a9d5-cf147b0a917b', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/5\\/application?signature=a0a35a35dd651bd6173f26f9458423bdbd835522650096f4f44eef72ddb63013\"}', null, '2020-02-19 12:28:26', '2020-02-19 12:28:26');
INSERT INTO `notifications` VALUES ('5c8800d8-ef8e-485c-b283-77e0dd1d23b8', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/1?signature=c4d59a0c7c282646f912975046277bd54f49be90690c74ec60a2746b9a76f609\"}', null, '2020-02-18 17:05:48', '2020-02-18 17:05:48');
INSERT INTO `notifications` VALUES ('5d1b5620-cb3f-4b44-b9ab-8053cbb1a90f', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/3\\/application?signature=3b5c2dfb83c4f6fcc2d936392f11b7252f5f999fa949f61b9f9ae9d53876fd95\"}', null, '2020-02-19 12:09:32', '2020-02-19 12:09:32');
INSERT INTO `notifications` VALUES ('5d9ac7e2-9766-4328-a1ea-bde8d8abd436', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/10\\/application?signature=37f7c167874c70ee6d5e4c9aa2646163e969d761af507485b137483c7bc56249\"}', null, '2020-02-19 18:55:29', '2020-02-19 18:55:29');
INSERT INTO `notifications` VALUES ('5fa83618-6713-426a-94af-2d1336077550', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0006<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0006<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/14\\/application?signature=d18b25e8e984cffd7804d0c13693db2f5aace2b21842b6085583561fd37513bb\"}', null, '2020-02-20 09:37:10', '2020-02-20 09:37:10');
INSERT INTO `notifications` VALUES ('5fb87b4f-46cc-46f1-b040-15462e3ffaab', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0004<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0004<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/13\\/application?signature=9f1a7e131bb033eaf8e5d918411f294c0827e621872e21883b57f3a3fb5672d4\"}', null, '2020-02-19 17:54:38', '2020-02-19 17:54:38');
INSERT INTO `notifications` VALUES ('5fd697d6-3499-4450-b8e9-d3c7b985c184', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Artist Permit <b># RNA0001<\\/b> - Application Approved\",\"content\":\"Your Artist Permit application with the reference number <b>RNA0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/artist\\/make_payment\\/1?signature=32a4b597242c75adca3f0f8a443d036dfe2b3547b15dc2a9554df3306eb1f317\"}', null, '2020-02-18 16:48:24', '2020-02-18 16:48:24');
INSERT INTO `notifications` VALUES ('5fe28db7-9d8d-4c0d-810a-21b204c09f97', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:18:27', '2020-02-18 15:18:27');
INSERT INTO `notifications` VALUES ('61b79b4e-0480-43c7-81ab-a304769ff731', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/140\\/details?signature=0929a99de2b90258eaf8e0c2f251dd29dcd94d97acb38876b37386c17dcce7ce\"}', null, '2020-02-18 17:47:57', '2020-02-18 17:47:57');
INSERT INTO `notifications` VALUES ('61e7e9a0-048c-4ae2-a40f-3990159bb4d5', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:18:31', '2020-02-18 15:18:31');
INSERT INTO `notifications` VALUES ('620496de-2fea-46a5-ba42-186a0cc32b7f', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/10?signature=b980b53d463e8a1f499fd95a39ab57150dab8be01d9eba6cef1cbf1e8769cddd\"}', null, '2020-02-19 15:07:23', '2020-02-19 15:07:23');
INSERT INTO `notifications` VALUES ('623d6265-546e-48c4-a72c-0d5d75959b94', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:08:22', '2020-02-18 15:08:22');
INSERT INTO `notifications` VALUES ('62c12075-8070-4280-8251-be787ee3ff60', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/1?signature=c4d59a0c7c282646f912975046277bd54f49be90690c74ec60a2746b9a76f609\"}', null, '2020-02-18 17:08:07', '2020-02-18 17:08:07');
INSERT INTO `notifications` VALUES ('63219dd9-e43c-4c4c-a5cf-a7ad67952f4d', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0003<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0003<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/12\\/application?signature=ec57d9e44f655b28997afa3eb565ee3893a37d8eae20e776cc81e54199541f0b\"}', null, '2020-02-19 18:36:16', '2020-02-19 18:36:16');
INSERT INTO `notifications` VALUES ('653ac2e0-4eb8-4e1e-8d80-edae34a22413', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/1?signature=c4d59a0c7c282646f912975046277bd54f49be90690c74ec60a2746b9a76f609\"}', null, '2020-02-18 12:55:25', '2020-02-18 12:55:25');
INSERT INTO `notifications` VALUES ('656b8189-fb99-450f-afa5-cd1330cf42f5', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:58:47', '2020-02-18 15:58:47');
INSERT INTO `notifications` VALUES ('65dd338f-477b-4bdf-8863-98ed8f0f57ac', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/3?signature=69fd47e1881c99289f6e1fd9ea8f3443f7056d59b7c44c3e1b27a7599019c790\"}', null, '2020-02-19 12:23:47', '2020-02-19 12:23:47');
INSERT INTO `notifications` VALUES ('666b073c-db53-46de-9ff0-598c38d99697', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/2\\/application?signature=248a348d7007b9614d469b5838ddce77f06363f1a5188437125eda00e89ec91d\"}', null, '2020-02-19 11:56:45', '2020-02-19 11:56:45');
INSERT INTO `notifications` VALUES ('669e35a7-4d02-4bd6-b1cc-b1a31da01088', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/2\\/application?signature=248a348d7007b9614d469b5838ddce77f06363f1a5188437125eda00e89ec91d\"}', null, '2020-02-19 11:56:45', '2020-02-19 11:56:45');
INSERT INTO `notifications` VALUES ('66e5b7bd-9bd8-4f37-abd7-9686d569b83f', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Artist Permit <b># RNA0001<\\/b> - Application Approved\",\"content\":\"Your Artist Permit application with the reference number <b>RNA0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/artist\\/make_payment\\/1?signature=32a4b597242c75adca3f0f8a443d036dfe2b3547b15dc2a9554df3306eb1f317\"}', null, '2020-02-18 09:48:20', '2020-02-18 09:48:20');
INSERT INTO `notifications` VALUES ('686f8380-d4d9-461e-93df-aa30b2a6c6e5', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Artist Permit <b>#RNA0001<\\/b> Applied \",\"content\":\"The artist permit with reference number <b>RNA0001<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/artist_permit\\/1\\/application?signature=03bcdb121045b450eb172cdd4ab2dfc661f9723ce058f4dfe1a099d0e15b20ea\"}', null, '2020-02-18 09:30:29', '2020-02-18 09:30:29');
INSERT INTO `notifications` VALUES ('6aa7a0ef-0f24-4672-b776-038341e48a74', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/9?signature=53cca3625a8c7473380348f66b18f84488cd61bf96a876180efcde0eb5742d6c\"}', null, '2020-02-19 14:57:57', '2020-02-19 14:57:57');
INSERT INTO `notifications` VALUES ('6dc07d7d-6195-4de3-b771-db12a3f4e200', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0005<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0005<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/11\\/application?signature=3f91a2897a49673d44d0595d9ffe256692aada794effc1e30ba49d0a28c44396\"}', null, '2020-02-19 18:38:52', '2020-02-19 18:38:52');
INSERT INTO `notifications` VALUES ('726d6211-45ec-40fe-90b4-d95e9f64bc6e', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 14:58:19', '2020-02-18 14:58:19');
INSERT INTO `notifications` VALUES ('76979fc6-fcfd-4126-91f5-9bcfcdc1ed4c', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/10?signature=b980b53d463e8a1f499fd95a39ab57150dab8be01d9eba6cef1cbf1e8769cddd\"}', null, '2020-02-19 15:02:42', '2020-02-19 15:02:42');
INSERT INTO `notifications` VALUES ('76b6fd2d-2664-4261-9e72-a9c4c506f328', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/5\\/application?signature=a0a35a35dd651bd6173f26f9458423bdbd835522650096f4f44eef72ddb63013\"}', null, '2020-02-19 12:31:59', '2020-02-19 12:31:59');
INSERT INTO `notifications` VALUES ('78240ee4-77e7-482b-a16b-493d979ca6c9', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/2?signature=a8c9f9299f4b8999df2496dc914c0e746b78f6fc3792465c300c9938013767ed\"}', null, '2020-02-19 12:00:01', '2020-02-19 12:00:01');
INSERT INTO `notifications` VALUES ('7aa4c278-f148-4574-a6dc-82059e88780b', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Artist Permit <b># RNA0001<\\/b> - Application Approved\",\"content\":\"Your Artist Permit application with the reference number <b>RNA0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/artist\\/make_payment\\/1?signature=32a4b597242c75adca3f0f8a443d036dfe2b3547b15dc2a9554df3306eb1f317\"}', null, '2020-02-18 16:50:50', '2020-02-18 16:50:50');
INSERT INTO `notifications` VALUES ('7baea922-ba3c-4173-82a4-9bb1df8e8fa9', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/9?signature=53cca3625a8c7473380348f66b18f84488cd61bf96a876180efcde0eb5742d6c\"}', null, '2020-02-19 18:37:47', '2020-02-19 18:37:47');
INSERT INTO `notifications` VALUES ('7c4ca0bf-857e-4c5f-95d6-134752166eef', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/140\\/details?signature=0929a99de2b90258eaf8e0c2f251dd29dcd94d97acb38876b37386c17dcce7ce\"}', null, '2020-02-18 16:01:47', '2020-02-18 16:01:47');
INSERT INTO `notifications` VALUES ('7c930e4d-de07-44fa-b8b1-a420ec1948e1', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/4\\/application?signature=b4960741662eb630844fe73cebee3e62c0289dc10149328433d7aba72609a5c8\"}', null, '2020-02-19 12:27:49', '2020-02-19 12:27:49');
INSERT INTO `notifications` VALUES ('7e732be6-96a6-4cb8-afbe-1e35e71dddb5', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 14:53:03', '2020-02-18 14:53:03');
INSERT INTO `notifications` VALUES ('806d902b-5f26-408c-ae0a-86c84a0c2216', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:10:55', '2020-02-18 15:10:55');
INSERT INTO `notifications` VALUES ('83e60e03-4e89-40d4-aed9-a28c5962f08c', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0003<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0003<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/12\\/application?signature=ec57d9e44f655b28997afa3eb565ee3893a37d8eae20e776cc81e54199541f0b\"}', null, '2020-02-19 16:03:21', '2020-02-19 16:03:21');
INSERT INTO `notifications` VALUES ('8603a596-9f62-473b-ba28-de62bcfe467e', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0005<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0005<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/11\\/application?signature=3f91a2897a49673d44d0595d9ffe256692aada794effc1e30ba49d0a28c44396\"}', null, '2020-02-19 18:38:52', '2020-02-19 18:38:52');
INSERT INTO `notifications` VALUES ('8605b9eb-0b6e-4bc5-8106-02e4fe943be1', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 14:58:29', '2020-02-18 14:58:29');
INSERT INTO `notifications` VALUES ('87120c8e-d108-4558-8d03-f444b633905b', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:17:10', '2020-02-18 15:17:10');
INSERT INTO `notifications` VALUES ('8782ac88-f81e-49c9-91b1-2ed0e452855c', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0003<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0003<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/12\\/application?signature=ec57d9e44f655b28997afa3eb565ee3893a37d8eae20e776cc81e54199541f0b\"}', null, '2020-02-19 18:36:16', '2020-02-19 18:36:16');
INSERT INTO `notifications` VALUES ('8ab84e3d-93c1-4cce-bb01-897060ceb70b', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/3?signature=69fd47e1881c99289f6e1fd9ea8f3443f7056d59b7c44c3e1b27a7599019c790\"}', null, '2020-02-19 12:12:23', '2020-02-19 12:12:23');
INSERT INTO `notifications` VALUES ('8b41adbb-c529-4ffb-bb63-4334ef48c11e', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0004<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0004<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/13\\/application?signature=9f1a7e131bb033eaf8e5d918411f294c0827e621872e21883b57f3a3fb5672d4\"}', null, '2020-02-19 17:58:06', '2020-02-19 17:58:06');
INSERT INTO `notifications` VALUES ('8ce915de-2d12-45af-b78a-00cea2b66018', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0010<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0010<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/18\\/application?signature=5ced1966b105ac12f939a84bc330f8fd2038116fd4b99e294943030269831a60\"}', null, '2020-02-20 15:20:28', '2020-02-20 15:20:28');
INSERT INTO `notifications` VALUES ('8ec49b53-adab-457f-bdf8-55578b110edd', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0008<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0008<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/16\\/application?signature=71f53a39cd94be344cffdaf6ed74acd760b83d77963a979a5092f629e47af434\"}', null, '2020-02-20 15:05:53', '2020-02-20 15:05:53');
INSERT INTO `notifications` VALUES ('8fb826f0-5ce9-4492-979d-e4b0e8492048', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0007<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0007<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/15\\/application?signature=528f39fac28e8cb67ef7ca9099961171a7489ca1ecc64e52a2a38d2c78b16be9\"}', null, '2020-02-20 11:19:40', '2020-02-20 11:19:40');
INSERT INTO `notifications` VALUES ('8fdf48d9-463a-4968-b6aa-110ac8df3bd1', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0003<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/12?signature=fc7ceb94a288fb2b233a262c94c14be25bccd9a14864fda76d7e72a42a6e893b\"}', null, '2020-02-20 10:03:05', '2020-02-20 10:03:05');
INSERT INTO `notifications` VALUES ('907b2b4d-9c66-40d0-bca9-7c7427f84846', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0008<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0008<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/16\\/application?signature=71f53a39cd94be344cffdaf6ed74acd760b83d77963a979a5092f629e47af434\"}', null, '2020-02-20 15:05:52', '2020-02-20 15:05:52');
INSERT INTO `notifications` VALUES ('92925a88-9514-40a7-a6f8-53dfe848c4c4', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0009<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0009<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/17\\/application?signature=035089226649db8765f82106469c4291d5f4bbbd624e17b887066090f7eec87a\"}', null, '2020-02-20 15:17:25', '2020-02-20 15:17:25');
INSERT INTO `notifications` VALUES ('93b042ee-a4cb-4a9f-ac00-401dfb7e1996', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/9\\/application?signature=ab79662cf40c94913e4719a8f84d92418fa6f42decd7643b3b7e9afd4d20171a\"}', null, '2020-02-19 12:52:21', '2020-02-19 12:52:21');
INSERT INTO `notifications` VALUES ('9569c697-b6f5-4b04-988c-f6df4bf55563', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0004<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0004<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/13\\/application?signature=9f1a7e131bb033eaf8e5d918411f294c0827e621872e21883b57f3a3fb5672d4\"}', null, '2020-02-19 18:44:50', '2020-02-19 18:44:50');
INSERT INTO `notifications` VALUES ('975d8f25-fde2-43a0-94aa-77136228cc74', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0004<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0004<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/13\\/application?signature=9f1a7e131bb033eaf8e5d918411f294c0827e621872e21883b57f3a3fb5672d4\"}', null, '2020-02-19 17:38:49', '2020-02-19 17:38:49');
INSERT INTO `notifications` VALUES ('979e0da3-1190-4f46-84dc-97c1e53726ce', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/140\\/details?signature=0929a99de2b90258eaf8e0c2f251dd29dcd94d97acb38876b37386c17dcce7ce\"}', null, '2020-02-18 16:01:43', '2020-02-18 16:01:43');
INSERT INTO `notifications` VALUES ('9905f9ca-13b8-4626-8fc2-fabb8056dd5d', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Artist Permit <b># RNA0001<\\/b> - Application Approved\",\"content\":\"Your Artist Permit application with the reference number <b>RNA0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/artist\\/make_payment\\/1?signature=32a4b597242c75adca3f0f8a443d036dfe2b3547b15dc2a9554df3306eb1f317\"}', null, '2020-02-18 16:49:25', '2020-02-18 16:49:25');
INSERT INTO `notifications` VALUES ('99f2046e-97e2-425f-83d2-f1d5128681fc', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/9?signature=53cca3625a8c7473380348f66b18f84488cd61bf96a876180efcde0eb5742d6c\"}', null, '2020-02-19 18:57:44', '2020-02-19 18:57:44');
INSERT INTO `notifications` VALUES ('9bbef995-5a86-45ef-ad50-33a65fab4b34', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Rejected\",\"content\":\"Your application has been rejected. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 16:00:16', '2020-02-18 16:00:16');
INSERT INTO `notifications` VALUES ('9c3247dd-d33d-44fb-83a8-7cd49f10f3d3', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/9\\/application?signature=ab79662cf40c94913e4719a8f84d92418fa6f42decd7643b3b7e9afd4d20171a\"}', null, '2020-02-19 15:49:44', '2020-02-19 15:49:44');
INSERT INTO `notifications` VALUES ('9e1a257a-8434-4d14-b2bf-c89a26b22160', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Rejected\",\"content\":\"Your application has been rejected. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 17:48:29', '2020-02-18 17:48:29');
INSERT INTO `notifications` VALUES ('a25f8081-36f2-4dad-a010-2f1e820ddd38', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0007<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0007<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/15\\/application?signature=528f39fac28e8cb67ef7ca9099961171a7489ca1ecc64e52a2a38d2c78b16be9\"}', null, '2020-02-20 11:19:41', '2020-02-20 11:19:41');
INSERT INTO `notifications` VALUES ('a3f692e5-0829-4072-ace8-6c007c902e1c', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0004<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/13?signature=6f938d5a5d00be5e665f83f3fa3abc1e0a081c900414b7fb4f4399774e583826\"}', null, '2020-02-19 18:41:15', '2020-02-19 18:41:15');
INSERT INTO `notifications` VALUES ('a48bcd6f-85dd-4b02-a161-20847a2bbb61', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:21:14', '2020-02-18 15:21:14');
INSERT INTO `notifications` VALUES ('a4db0a23-5c1d-4473-98c7-d1d51c590f66', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/140\\/details?signature=0929a99de2b90258eaf8e0c2f251dd29dcd94d97acb38876b37386c17dcce7ce\"}', null, '2020-02-18 16:01:50', '2020-02-18 16:01:50');
INSERT INTO `notifications` VALUES ('a63a762b-9a84-4d81-b413-0f45d423d588', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/9?signature=53cca3625a8c7473380348f66b18f84488cd61bf96a876180efcde0eb5742d6c\"}', null, '2020-02-20 10:06:35', '2020-02-20 10:06:35');
INSERT INTO `notifications` VALUES ('a6a727ff-dd7d-4bd5-9845-b81fd9845948', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/9\\/application?signature=ab79662cf40c94913e4719a8f84d92418fa6f42decd7643b3b7e9afd4d20171a\"}', null, '2020-02-19 15:49:44', '2020-02-19 15:49:44');
INSERT INTO `notifications` VALUES ('aa00d9c4-dbd0-43a8-b488-c7481f875eae', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0007<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/15?signature=a890404380af285f4a2cfa952167a2c6a7e7fdc17f0dfc0e4f4f94cbdca2f665\"}', '2020-02-20 11:50:19', '2020-02-20 11:48:50', '2020-02-20 11:50:19');
INSERT INTO `notifications` VALUES ('aa3b7a89-c56c-4985-b8b3-acec233d9563', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/1\\/application?signature=0b48c2c9818a415d4c796bbe1d328499ede871393e9d3e706d762f5bdc2861f7\"}', null, '2020-02-18 09:32:06', '2020-02-18 09:32:06');
INSERT INTO `notifications` VALUES ('aa6706a3-9222-431d-a7c3-4331b0d34fe7', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Rejected\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been rejected. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/1?tab=applied&signature=fb1ea07d6c36f00b5614149b9f096f1e61e9ff0384b4e283039f8770603954f1\"}', null, '2020-02-18 17:09:11', '2020-02-18 17:09:11');
INSERT INTO `notifications` VALUES ('ad27c08d-11d3-4fbc-8bee-a053c3385418', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0007<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0007<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/15\\/application?signature=528f39fac28e8cb67ef7ca9099961171a7489ca1ecc64e52a2a38d2c78b16be9\"}', null, '2020-02-20 12:50:27', '2020-02-20 12:50:27');
INSERT INTO `notifications` VALUES ('ad62c66b-f4b1-4a1c-ac08-e22cb0c2c026', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:08:26', '2020-02-18 15:08:26');
INSERT INTO `notifications` VALUES ('adf4be1b-3638-4347-91ef-cf2bafbf3d5f', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/3\\/application?signature=3b5c2dfb83c4f6fcc2d936392f11b7252f5f999fa949f61b9f9ae9d53876fd95\"}', null, '2020-02-19 12:16:24', '2020-02-19 12:16:24');
INSERT INTO `notifications` VALUES ('ae877565-34f1-4059-b378-63197c2784ae', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/9?signature=53cca3625a8c7473380348f66b18f84488cd61bf96a876180efcde0eb5742d6c\"}', null, '2020-02-19 16:20:48', '2020-02-19 16:20:48');
INSERT INTO `notifications` VALUES ('b2eea87c-4679-46ed-af0b-b55307bb4a59', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Rejected\",\"content\":\"Your application has been rejected. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 16:00:19', '2020-02-18 16:00:19');
INSERT INTO `notifications` VALUES ('b317501e-ece5-4fc8-856e-63b610ddf559', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 14:58:26', '2020-02-18 14:58:26');
INSERT INTO `notifications` VALUES ('b4b4276b-742a-443f-844a-80aaf155cbac', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/10?signature=b980b53d463e8a1f499fd95a39ab57150dab8be01d9eba6cef1cbf1e8769cddd\"}', null, '2020-02-19 15:04:23', '2020-02-19 15:04:23');
INSERT INTO `notifications` VALUES ('b608d1de-dcbc-4b3a-814c-055a0933c571', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0010<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0010<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/18\\/application?signature=5ced1966b105ac12f939a84bc330f8fd2038116fd4b99e294943030269831a60\"}', null, '2020-02-20 15:20:28', '2020-02-20 15:20:28');
INSERT INTO `notifications` VALUES ('b64dbb37-09a9-4422-85d2-052135f759a7', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:10:49', '2020-02-18 15:10:49');
INSERT INTO `notifications` VALUES ('b733efef-0953-4856-87a8-fbd0ffd62446', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/10\\/application?signature=37f7c167874c70ee6d5e4c9aa2646163e969d761af507485b137483c7bc56249\"}', null, '2020-02-19 18:55:29', '2020-02-19 18:55:29');
INSERT INTO `notifications` VALUES ('b7639c0a-307d-4bd8-bc72-aa15f12b799f', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:18:34', '2020-02-18 15:18:34');
INSERT INTO `notifications` VALUES ('b7e93cf5-5f57-4157-8561-412c821f0088', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/1?signature=c4d59a0c7c282646f912975046277bd54f49be90690c74ec60a2746b9a76f609\"}', null, '2020-02-18 12:08:07', '2020-02-18 12:08:07');
INSERT INTO `notifications` VALUES ('bb0e2230-e835-411f-90de-e3143d92eb6d', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0005<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0005<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/11\\/application?signature=3f91a2897a49673d44d0595d9ffe256692aada794effc1e30ba49d0a28c44396\"}', null, '2020-02-19 17:59:54', '2020-02-19 17:59:54');
INSERT INTO `notifications` VALUES ('bd9752fb-f201-4039-8753-c39e2bdd0553', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/3\\/application?signature=3b5c2dfb83c4f6fcc2d936392f11b7252f5f999fa949f61b9f9ae9d53876fd95\"}', null, '2020-02-19 12:11:47', '2020-02-19 12:11:47');
INSERT INTO `notifications` VALUES ('bdf8c6a0-9a9a-4fbe-8e0c-7ffa56c923a1', 'App\\Notifications\\AllNotification', 'App\\User', '10', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 16:31:30', '2020-02-18 16:31:30');
INSERT INTO `notifications` VALUES ('c07541a4-bcad-46a7-a142-0ca379cace2f', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0005<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0005<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/192.168.0.197\\/raktda\\/public\\/event\\/11\\/application?signature=100256271112507da3e0355994b587e37b6197664351aa45f5006026fc829d99\"}', '2020-02-19 18:25:32', '2020-02-19 18:25:16', '2020-02-19 18:25:32');
INSERT INTO `notifications` VALUES ('c0cfb330-c726-4fbc-b02f-57129b23c926', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0003<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/12?signature=fc7ceb94a288fb2b233a262c94c14be25bccd9a14864fda76d7e72a42a6e893b\"}', null, '2020-02-19 18:40:39', '2020-02-19 18:40:39');
INSERT INTO `notifications` VALUES ('c2036fe2-bde9-4837-8334-34c31cd0947a', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0001<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0001<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/9\\/application?signature=ab79662cf40c94913e4719a8f84d92418fa6f42decd7643b3b7e9afd4d20171a\"}', null, '2020-02-19 14:21:13', '2020-02-19 14:21:13');
INSERT INTO `notifications` VALUES ('c29eb729-56b0-4674-886d-65a031b1a395', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Artist Permit <b># RNA0001<\\/b> - Application Requires Amendment\",\"content\":\"Your application with the reference number <b>RNA0001<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/artist\\/permit\\/1\\/amend?signature=20c3beafe5067e623f4b924df19be2c2292d24fa0776899b244744436e00c7ff\"}', null, '2020-02-18 16:56:59', '2020-02-18 16:56:59');
INSERT INTO `notifications` VALUES ('c2a7a4bf-3481-48ac-8220-ecf35634b758', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:17:07', '2020-02-18 15:17:07');
INSERT INTO `notifications` VALUES ('c3287b68-453d-4313-99d3-e104ed6e9be9', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/3\\/application?signature=3b5c2dfb83c4f6fcc2d936392f11b7252f5f999fa949f61b9f9ae9d53876fd95\"}', null, '2020-02-19 12:02:49', '2020-02-19 12:02:49');
INSERT INTO `notifications` VALUES ('c367a7aa-2b14-4b94-9b01-6136a72190dd', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/10?signature=b980b53d463e8a1f499fd95a39ab57150dab8be01d9eba6cef1cbf1e8769cddd\"}', null, '2020-02-19 18:40:07', '2020-02-19 18:40:07');
INSERT INTO `notifications` VALUES ('c3a5a5cb-fd28-4533-b6b9-d45a26e83104', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0005<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/11?signature=0e5ded68b396ae08aa87d109fd7b95961ed78d41810bd1c30e49cfe1046d8128\"}', null, '2020-02-19 18:37:00', '2020-02-19 18:37:00');
INSERT INTO `notifications` VALUES ('c43149cd-2391-465c-b9f1-6cce037ba891', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/10\\/application?signature=37f7c167874c70ee6d5e4c9aa2646163e969d761af507485b137483c7bc56249\"}', null, '2020-02-19 18:37:03', '2020-02-19 18:37:03');
INSERT INTO `notifications` VALUES ('c4fd7312-6242-4136-88eb-883622d3a7f9', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/10?signature=b980b53d463e8a1f499fd95a39ab57150dab8be01d9eba6cef1cbf1e8769cddd\"}', null, '2020-02-20 10:08:07', '2020-02-20 10:08:07');
INSERT INTO `notifications` VALUES ('c5aeb4c3-d2e7-45ce-b800-50a2f94da57e', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 16:31:26', '2020-02-18 16:31:26');
INSERT INTO `notifications` VALUES ('c794efb8-b6d3-47d1-b776-050698a6d5a9', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/3?signature=69fd47e1881c99289f6e1fd9ea8f3443f7056d59b7c44c3e1b27a7599019c790\"}', null, '2020-02-19 12:10:11', '2020-02-19 12:10:11');
INSERT INTO `notifications` VALUES ('c8f3ad22-a8e0-4799-b319-73188bbfc787', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/5\\/application?signature=a0a35a35dd651bd6173f26f9458423bdbd835522650096f4f44eef72ddb63013\"}', null, '2020-02-19 12:31:59', '2020-02-19 12:31:59');
INSERT INTO `notifications` VALUES ('cc6fd978-8007-44a0-b9a4-f8e0446c4e89', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:09:27', '2020-02-18 15:09:27');
INSERT INTO `notifications` VALUES ('cd7fd823-011b-496d-951f-9cd0d712cc6b', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0004<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0004<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/13\\/application?signature=9f1a7e131bb033eaf8e5d918411f294c0827e621872e21883b57f3a3fb5672d4\"}', null, '2020-02-19 17:58:06', '2020-02-19 17:58:06');
INSERT INTO `notifications` VALUES ('d08436d2-ab04-49a2-b1a8-e207599f4d3a', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Rejected\",\"content\":\"Your application has been rejected. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 16:00:13', '2020-02-18 16:00:13');
INSERT INTO `notifications` VALUES ('d13627ae-02a8-49ac-99cf-938c5a2c5d92', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:16:25', '2020-02-18 15:16:25');
INSERT INTO `notifications` VALUES ('d16f0f54-5754-4ea5-a0db-505de8b8b728', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Payment for <b>#EP0001 is completed successfully\",\"content\":\"The payment for Event Permit <b>EP0001<\\/b> is completed successfully.  Please find the permit and payment voucher in the attachments.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event?signature=60115866b6edceca9307aa26e082d5d11d4bedb83aa8d1b41406a72f509e6c1d#valid\"}', null, '2020-02-20 10:15:29', '2020-02-20 10:15:29');
INSERT INTO `notifications` VALUES ('d1a4a6c5-9914-425d-996f-7b55a3b77e1c', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0004<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0004<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/13\\/application?signature=9f1a7e131bb033eaf8e5d918411f294c0827e621872e21883b57f3a3fb5672d4\"}', null, '2020-02-19 17:54:38', '2020-02-19 17:54:38');
INSERT INTO `notifications` VALUES ('d3a3482f-ac1e-450c-b350-068191fb5087', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/10?signature=b980b53d463e8a1f499fd95a39ab57150dab8be01d9eba6cef1cbf1e8769cddd\"}', null, '2020-02-19 18:58:23', '2020-02-19 18:58:23');
INSERT INTO `notifications` VALUES ('d46d15fe-e5ee-4b80-bb6b-a963846693cb', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0006<\\/b> Amended\",\"content\":\"The event permit with reference number <b>RNE0006<\\/b> is submitted for amendment.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/14\\/application?signature=d18b25e8e984cffd7804d0c13693db2f5aace2b21842b6085583561fd37513bb\"}', null, '2020-02-20 10:39:01', '2020-02-20 10:39:01');
INSERT INTO `notifications` VALUES ('d4b87bab-9e4b-46f2-9c9f-f785ca9d9d13', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0003<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0003<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/12\\/application?signature=ec57d9e44f655b28997afa3eb565ee3893a37d8eae20e776cc81e54199541f0b\"}', null, '2020-02-20 14:50:33', '2020-02-20 14:50:33');
INSERT INTO `notifications` VALUES ('d4e1dff8-ce16-4a05-8bd0-cc6d0d095c4e', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/3?signature=69fd47e1881c99289f6e1fd9ea8f3443f7056d59b7c44c3e1b27a7599019c790\"}', null, '2020-02-19 12:17:37', '2020-02-19 12:17:37');
INSERT INTO `notifications` VALUES ('d559d690-7ea1-45b3-9f0c-951473567b1a', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 17:45:06', '2020-02-18 17:45:06');
INSERT INTO `notifications` VALUES ('d7058cdd-b130-4fdc-bd26-d256bef17e1b', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/140\\/details?signature=0929a99de2b90258eaf8e0c2f251dd29dcd94d97acb38876b37386c17dcce7ce\"}', null, '2020-02-18 16:32:21', '2020-02-18 16:32:21');
INSERT INTO `notifications` VALUES ('da0b2f25-ccf4-4df6-803e-942951b0984f', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Artist Permit <b># RNA0001<\\/b> - Application Approved\",\"content\":\"Your Artist Permit application with the reference number <b>RNA0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/artist\\/make_payment\\/1?signature=32a4b597242c75adca3f0f8a443d036dfe2b3547b15dc2a9554df3306eb1f317\"}', null, '2020-02-18 16:41:46', '2020-02-18 16:41:46');
INSERT INTO `notifications` VALUES ('da2f57f8-a1ba-4189-8320-45c18f9ede1a', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/5?signature=3e6e8d311f4c43a2d44ed3fd62fa23f4d85d897dc9e4f014eb51960025402d96\"}', null, '2020-02-19 12:31:12', '2020-02-19 12:31:12');
INSERT INTO `notifications` VALUES ('dae776e6-48c3-4e42-9fd8-2934db1809ed', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/1?signature=c4d59a0c7c282646f912975046277bd54f49be90690c74ec60a2746b9a76f609\"}', null, '2020-02-18 10:04:28', '2020-02-18 10:04:28');
INSERT INTO `notifications` VALUES ('daf341de-6d6b-451e-83a5-6759dff5722c', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:09:34', '2020-02-18 15:09:34');
INSERT INTO `notifications` VALUES ('dc39318a-4e5f-495e-ba66-075afd2cccf9', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0003<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0003<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/12\\/application?signature=ec57d9e44f655b28997afa3eb565ee3893a37d8eae20e776cc81e54199541f0b\"}', null, '2020-02-19 18:48:48', '2020-02-19 18:48:48');
INSERT INTO `notifications` VALUES ('dd472759-7a3f-4578-929a-df76f2a5f6fc', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/1?signature=8ce77940533bb1e9a22ed0b883ba0171d0e522ba44728044cdd8a5be694541f5\"}', null, '2020-02-18 13:57:49', '2020-02-18 13:57:49');
INSERT INTO `notifications` VALUES ('de044766-9f1b-41c5-8ecd-23cbb47021ba', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/9?signature=53cca3625a8c7473380348f66b18f84488cd61bf96a876180efcde0eb5742d6c\"}', null, '2020-02-19 14:19:07', '2020-02-19 14:19:07');
INSERT INTO `notifications` VALUES ('de18dbfa-9f10-4cb2-b3d0-aa2c909663a8', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Applied\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is applied.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/10\\/application?signature=cfa0f14e015d3885ebc3989efcf37d9a4d4dcc1eebecb6a91cfee51c1de1022b\"}', null, '2020-02-19 12:53:21', '2020-02-19 12:53:21');
INSERT INTO `notifications` VALUES ('de46b8b9-c574-459d-90d1-b087ea196609', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0004<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/13?signature=6f938d5a5d00be5e665f83f3fa3abc1e0a081c900414b7fb4f4399774e583826\"}', null, '2020-02-19 17:56:01', '2020-02-19 17:56:01');
INSERT INTO `notifications` VALUES ('e047bf62-96ca-43f9-9706-fb6578784ac4', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 17:44:57', '2020-02-18 17:44:57');
INSERT INTO `notifications` VALUES ('e3f4b2b4-fb90-41e9-8a89-fb4880f5a38e', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0005<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/11?signature=0e5ded68b396ae08aa87d109fd7b95961ed78d41810bd1c30e49cfe1046d8128\"}', null, '2020-02-19 18:39:27', '2020-02-19 18:39:27');
INSERT INTO `notifications` VALUES ('e4a02052-38c2-43b8-8b1f-723bac51d08f', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0005<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/11?signature=0e5ded68b396ae08aa87d109fd7b95961ed78d41810bd1c30e49cfe1046d8128\"}', null, '2020-02-20 10:01:40', '2020-02-20 10:01:40');
INSERT INTO `notifications` VALUES ('e64009bd-50d7-43f1-9ba4-8055ef6e5c70', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/1?signature=c4d59a0c7c282646f912975046277bd54f49be90690c74ec60a2746b9a76f609\"}', null, '2020-02-18 12:04:39', '2020-02-18 12:04:39');
INSERT INTO `notifications` VALUES ('e7f253c9-9172-435d-8e2c-322da7e82b40', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0004<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/13?signature=37666570e0e64161b6ad91fa0f4744902f0bd1fc11e8cde837367707e5f0c673\"}', null, '2020-02-20 11:03:54', '2020-02-20 11:03:54');
INSERT INTO `notifications` VALUES ('e9193168-49c7-4500-b2fc-016a9239e5cd', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/1?signature=c4d59a0c7c282646f912975046277bd54f49be90690c74ec60a2746b9a76f609\"}', null, '2020-02-18 12:52:16', '2020-02-18 12:52:16');
INSERT INTO `notifications` VALUES ('ea1adcaa-d10a-4a9e-ac7b-92ff75cf5889', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:58:51', '2020-02-18 15:58:51');
INSERT INTO `notifications` VALUES ('ea3a0136-5102-4624-a39c-c0298ee33521', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0005<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0005<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/192.168.0.197\\/raktda\\/public\\/event\\/11\\/application?signature=100256271112507da3e0355994b587e37b6197664351aa45f5006026fc829d99\"}', null, '2020-02-19 18:25:16', '2020-02-19 18:25:16');
INSERT INTO `notifications` VALUES ('ec5e8af0-021c-4d4e-b9ee-6a778687f347', 'App\\Notifications\\AllNotification', 'App\\Company', '140', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:58:34', '2020-02-18 15:58:34');
INSERT INTO `notifications` VALUES ('ed1a14d1-c26f-4b00-8edb-2eee58c977be', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application with the reference number <b>RNE0002<\\/b> has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/amend\\/10?signature=b980b53d463e8a1f499fd95a39ab57150dab8be01d9eba6cef1cbf1e8769cddd\"}', null, '2020-02-19 18:09:30', '2020-02-19 18:09:30');
INSERT INTO `notifications` VALUES ('f00c5908-4383-4b5a-8d80-c5c5528ed440', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Applications Requires Amendment\",\"content\":\"Your application has been bounced back for amendment. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/140\\/details?signature=0929a99de2b90258eaf8e0c2f251dd29dcd94d97acb38876b37386c17dcce7ce\"}', null, '2020-02-18 16:32:28', '2020-02-18 16:32:28');
INSERT INTO `notifications` VALUES ('f12e8289-f805-44ea-bc83-e8c1e4446d2a', 'App\\Notifications\\AllNotification', 'App\\User', '3', '{\"title\":\"Event Permit <b>#RNE0002<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0002<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/10\\/application?signature=37f7c167874c70ee6d5e4c9aa2646163e969d761af507485b137483c7bc56249\"}', null, '2020-02-19 18:58:57', '2020-02-19 18:58:57');
INSERT INTO `notifications` VALUES ('f2a7ba81-ad0c-4192-a2f7-c15489cce5be', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0004<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0004<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/13\\/application?signature=9f1a7e131bb033eaf8e5d918411f294c0827e621872e21883b57f3a3fb5672d4\"}', null, '2020-02-19 18:42:50', '2020-02-19 18:42:50');
INSERT INTO `notifications` VALUES ('f78b6076-02c3-42a3-819b-cd4bc65b8491', 'App\\Notifications\\AllNotification', 'App\\User', '2', '{\"title\":\"Application has been Approved\",\"content\":\"Your application with the reference number <b>RNE0001<\\/b> has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/event\\/payment\\/1?signature=c4d59a0c7c282646f912975046277bd54f49be90690c74ec60a2746b9a76f609\"}', null, '2020-02-18 12:49:32', '2020-02-18 12:49:32');
INSERT INTO `notifications` VALUES ('fbde537d-16f4-43fd-830f-a8459f5b21b0', 'App\\Notifications\\AllNotification', 'App\\User', '11', '{\"title\":\"Application has been Approved\",\"content\":\"Your application has been approved. To view the details, please click the button below.\",\"url\":\"http:\\/\\/raktda.test\\/company\\/profile\\/140?signature=0c0ec6185593b95472f8e4ced27ff571cc5f3b79bbfb810156fdd16094ae133e\"}', null, '2020-02-18 15:21:20', '2020-02-18 15:21:20');
INSERT INTO `notifications` VALUES ('fd3e8df4-3280-4855-a1aa-8f285d51b8b5', 'App\\Notifications\\AllNotification', 'App\\User', '1', '{\"title\":\"Event Permit <b>#RNE0004<\\/b> Edited\",\"content\":\"The event permit with reference number <b>RNE0004<\\/b> is submitted after modification.  Please click the link below.\",\"url\":\"http:\\/\\/raktda.test\\/event\\/13\\/application?signature=9f1a7e131bb033eaf8e5d918411f294c0827e621872e21883b57f3a3fb5672d4\"}', null, '2020-02-19 18:44:50', '2020-02-19 18:44:50');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('don@nrsinfoways.com', '$2y$10$QDBAmeFwKiGZr00mELxwsuCzSccjWLH0ilOQOsbqJwFWY9CP9VzR.', '2020-01-02 11:23:34');
INSERT INTO `password_resets` VALUES ('test.user43565@gmail.com', '$2y$10$92F2XVg7qV/dYaGjXp1QHuif1gfB5gpt7nKzVLTYAB048z3/5iEKK', '2020-01-16 14:36:54');

-- ----------------------------
-- Table structure for permit
-- ----------------------------
DROP TABLE IF EXISTS `permit`;
CREATE TABLE `permit` (
  `permit_id` int(11) NOT NULL AUTO_INCREMENT,
  `permit_reference_id` int(11) DEFAULT NULL,
  `lock_user_id` int(11) DEFAULT NULL,
  `rivision_number` varchar(11) DEFAULT '0',
  `lock` datetime DEFAULT NULL,
  `permit_number` varchar(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reference_number` varchar(11) DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `work_location_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `work_location` varchar(255) DEFAULT NULL,
  `happiness` int(11) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `permit_status` varchar(255) DEFAULT NULL,
  `request_type` varchar(255) DEFAULT '',
  `company_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `exempt_by` int(255) DEFAULT NULL,
  `exempt_payment` tinyint(4) DEFAULT NULL,
  `cancel_date` timestamp NULL DEFAULT NULL,
  `cancel_by` int(11) DEFAULT NULL,
  `cancel_reason` varchar(255) DEFAULT NULL,
  `is_edit` int(12) DEFAULT '0',
  `event_id` int(11) DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  PRIMARY KEY (`permit_id`),
  KEY `permit_reference_id` (`permit_reference_id`),
  CONSTRAINT `permit_ibfk_1` FOREIGN KEY (`permit_reference_id`) REFERENCES `permit_reference` (`permit_reference_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permit
-- ----------------------------

-- ----------------------------
-- Table structure for permit_approver
-- ----------------------------
DROP TABLE IF EXISTS `permit_approver`;
CREATE TABLE `permit_approver` (
  `permit_approver_id` int(11) NOT NULL AUTO_INCREMENT,
  `permit_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `permit_comment_id` int(11) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) DEFAULT NULL,
  `time_end` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `procedure_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`permit_approver_id`),
  KEY `procedure_id` (`procedure_id`),
  KEY `permit_id` (`permit_id`),
  KEY `permit_comment_id` (`permit_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permit_approver
-- ----------------------------

-- ----------------------------
-- Table structure for permit_comment
-- ----------------------------
DROP TABLE IF EXISTS `permit_comment`;
CREATE TABLE `permit_comment` (
  `permit_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `exempt_payment` tinyint(4) DEFAULT NULL,
  `government_id` int(11) DEFAULT NULL,
  `checked_date` timestamp NULL DEFAULT NULL,
  `type` tinyint(4) DEFAULT '0' COMMENT '1 for company otherwise 0',
  `action` varchar(255) DEFAULT NULL,
  `comment_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` longtext,
  `permit_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permit_comment_id`),
  KEY `permit_id` (`permit_id`),
  CONSTRAINT `permit_comment_ibfk_1` FOREIGN KEY (`permit_id`) REFERENCES `permit` (`permit_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permit_comment
-- ----------------------------

-- ----------------------------
-- Table structure for permit_duration
-- ----------------------------
DROP TABLE IF EXISTS `permit_duration`;
CREATE TABLE `permit_duration` (
  `permit_duration_id` int(11) NOT NULL AUTO_INCREMENT,
  `duration_number` varchar(255) DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_by` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permit_duration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permit_duration
-- ----------------------------

-- ----------------------------
-- Table structure for permit_reference
-- ----------------------------
DROP TABLE IF EXISTS `permit_reference`;
CREATE TABLE `permit_reference` (
  `permit_reference_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`permit_reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permit_reference
-- ----------------------------

-- ----------------------------
-- Table structure for procedure
-- ----------------------------
DROP TABLE IF EXISTS `procedure`;
CREATE TABLE `procedure` (
  `procedure_id` int(11) NOT NULL AUTO_INCREMENT,
  `procedure_name` varchar(255) DEFAULT NULL,
  `desciption` varchar(255) DEFAULT NULL,
  `procedure_type` varchar(255) DEFAULT NULL,
  `procedure_status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`procedure_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of procedure
-- ----------------------------
INSERT INTO `procedure` VALUES ('1', 'Artist Procedure', null, 'artist', '1', '2019-08-18 17:48:40', null, null);
INSERT INTO `procedure` VALUES ('2', 'Artist Procedure2', null, 'artist', '0', '2019-08-18 17:50:15', null, null);

-- ----------------------------
-- Table structure for profession
-- ----------------------------
DROP TABLE IF EXISTS `profession`;
CREATE TABLE `profession` (
  `profession_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) DEFAULT NULL,
  `is_multiple` tinyint(4) DEFAULT '1',
  `deleted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`profession_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of profession
-- ----------------------------
INSERT INTO `profession` VALUES ('1', 'Singer', '0', null, null, null, '500', 'تصريح مطرب', '2019-12-30 17:59:05', '2019-12-30 17:59:05', null);
INSERT INTO `profession` VALUES ('2', 'Musician ', '1', null, null, null, '400', 'تصريح عازف  ', '2019-12-30 18:01:14', '2019-12-30 18:01:14', null);
INSERT INTO `profession` VALUES ('3', 'Dancer ', '0', null, null, null, '300', 'تصريح راقص  ', '2019-12-30 17:59:05', '2019-12-30 17:59:05', null);
INSERT INTO `profession` VALUES ('4', 'DJ ', '1', null, null, null, '700', ' تصريح دي جى   ', '2019-12-30 18:01:21', '2019-12-30 18:01:21', null);
INSERT INTO `profession` VALUES ('5', 'Announcer', '0', null, null, null, '100', 'تصريح مذيع', '2019-12-30 17:59:05', '2019-12-30 17:59:05', null);

-- ----------------------------
-- Table structure for questionnaire
-- ----------------------------
DROP TABLE IF EXISTS `questionnaire`;
CREATE TABLE `questionnaire` (
  `questionnaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `questionnaire_name_en` varchar(255) DEFAULT NULL,
  `questionnaire_name_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`questionnaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of questionnaire
-- ----------------------------
INSERT INTO `questionnaire` VALUES ('1', 'Event Inspection Questionnaire', 'Event Inspection Questionnaire', null, null, null);

-- ----------------------------
-- Table structure for questionnaire_categories
-- ----------------------------
DROP TABLE IF EXISTS `questionnaire_categories`;
CREATE TABLE `questionnaire_categories` (
  `questionnaire_id` int(11) NOT NULL,
  `question_category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `questionnaire_categories_ibfk_1` (`questionnaire_id`),
  KEY `questionnaire_categories_ibfk_2` (`question_category_id`),
  CONSTRAINT `questionnaire_categories_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`questionnaire_id`) ON DELETE CASCADE,
  CONSTRAINT `questionnaire_categories_ibfk_2` FOREIGN KEY (`question_category_id`) REFERENCES `question_categories` (`question_category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of questionnaire_categories
-- ----------------------------
INSERT INTO `questionnaire_categories` VALUES ('1', '1', null, null, null);

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_name_en` varchar(255) DEFAULT NULL,
  `question_name_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `question_type` varchar(255) DEFAULT NULL,
  `is_required_image` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('1', 'Are they clean and readable?', 'هل هي نظيفة وقابلة للقراءة؟', 'select', '1', '2019-12-16 14:39:46', '2019-12-16 14:39:46', null);
INSERT INTO `questions` VALUES ('2', 'Is the material changed frequently?', 'هل تم تغيير المواد بشكل متكرر؟', 'select', '1', '2019-12-16 14:48:50', '2019-12-16 14:48:50', null);
INSERT INTO `questions` VALUES ('3', 'Do items interfere with people walking by?', 'هل تتداخل العناصر مع الأشخاص الذين يمشون بها؟', 'select', '1', null, null, null);

-- ----------------------------
-- Table structure for question_categories
-- ----------------------------
DROP TABLE IF EXISTS `question_categories`;
CREATE TABLE `question_categories` (
  `question_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_category_name_en` varchar(255) DEFAULT NULL,
  `question_category_name_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`question_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of question_categories
-- ----------------------------
INSERT INTO `question_categories` VALUES ('1', 'Bulletin Boards and Signs', 'لوحات الإعلانات واللافتات', '2019-12-16 14:48:15', '2019-12-16 14:48:15', null);

-- ----------------------------
-- Table structure for question_choices
-- ----------------------------
DROP TABLE IF EXISTS `question_choices`;
CREATE TABLE `question_choices` (
  `question_choice_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_choice_name_en` varchar(255) DEFAULT NULL,
  `question_choice_name_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`question_choice_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `question_choices_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of question_choices
-- ----------------------------
INSERT INTO `question_choices` VALUES ('1', 'Satisfactory', 'مرض', '1', '2019-12-16 14:40:43', '2019-12-16 14:40:43', null);
INSERT INTO `question_choices` VALUES ('2', 'Requires Action', 'يتطلب العمل', '1', '2019-12-16 14:40:54', '2019-12-16 14:40:54', null);
INSERT INTO `question_choices` VALUES ('3', 'Satisfactory', 'مرض', '2', '2019-12-16 14:45:55', '2019-12-16 14:45:55', null);
INSERT INTO `question_choices` VALUES ('4', 'Requires Action', 'يتطلب العمل', '2', '2019-12-16 14:45:58', '2019-12-16 14:45:58', null);
INSERT INTO `question_choices` VALUES ('5', 'Satisfactory', 'مرض', '3', '2019-12-16 15:26:57', '2019-12-16 15:26:57', null);
INSERT INTO `question_choices` VALUES ('6', 'Requires Action', 'يتطلب العمل', '3', '2019-12-16 15:26:58', '2019-12-16 15:26:58', null);

-- ----------------------------
-- Table structure for question_lists
-- ----------------------------
DROP TABLE IF EXISTS `question_lists`;
CREATE TABLE `question_lists` (
  `question_category_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `question_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `question_lists_ibfk_1` (`question_category_id`),
  KEY `question_lists_ibfk_2` (`question_id`),
  CONSTRAINT `question_lists_ibfk_1` FOREIGN KEY (`question_category_id`) REFERENCES `question_categories` (`question_category_id`) ON DELETE CASCADE,
  CONSTRAINT `question_lists_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of question_lists
-- ----------------------------
INSERT INTO `question_lists` VALUES ('1', '1', '1', '2019-12-15 17:41:49', '2019-12-15 17:41:49', null);
INSERT INTO `question_lists` VALUES ('1', '2', '2', '2019-12-16 14:49:22', '2019-12-16 14:49:22', null);
INSERT INTO `question_lists` VALUES ('1', '3', '3', '2019-12-16 14:49:23', '2019-12-16 14:49:23', null);

-- ----------------------------
-- Table structure for religions
-- ----------------------------
DROP TABLE IF EXISTS `religions`;
CREATE TABLE `religions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of religions
-- ----------------------------
INSERT INTO `religions` VALUES ('1', 'Muslim', 'مسلم');
INSERT INTO `religions` VALUES ('2', 'Christian', 'مسيحي');
INSERT INTO `religions` VALUES ('3', 'Hindu', 'الهندوسي');

-- ----------------------------
-- Table structure for requirement
-- ----------------------------
DROP TABLE IF EXISTS `requirement`;
CREATE TABLE `requirement` (
  `requirement_id` int(11) NOT NULL AUTO_INCREMENT,
  `requirement_name_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `requirement_name` varchar(255) DEFAULT NULL,
  `requirement_description_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `requirement_description` varchar(255) DEFAULT '',
  `validity` varchar(255) DEFAULT NULL,
  `is_mandatory` tinyint(4) DEFAULT '0',
  `term` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT 'government or private',
  `requirement_type` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `dates_required` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`requirement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of requirement
-- ----------------------------
INSERT INTO `requirement` VALUES ('1', ' فتجعلها تبدو ', 'passport', null, 'passport should be valid', null, null, 'short', 'corporate', 'artist', '1', '2020-01-18 09:38:50', '2020-01-18 09:38:50', null, null, null, '1', '1');
INSERT INTO `requirement` VALUES ('3', 'Event brief and sponsorship package', 'Event brief and sponsorship package', null, 'Event brief and sponsorship package', null, null, null, 'government', 'event', '1', '2019-11-27 15:52:43', '2019-11-27 15:52:43', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('4', 'medical report', 'medical report', null, 'should be valid 6 months from the date of issuance. This is not required for event related artists.', '6', null, 'long', null, 'artist', '1', '2020-01-19 14:42:44', '2020-01-19 14:42:44', null, null, '1', null, '1');
INSERT INTO `requirement` VALUES ('6', 'Visa', 'Visa', null, 'Visa Should be Valid ', null, null, 'short', null, 'artist', '1', '2020-01-21 11:15:39', '2020-01-21 11:15:39', null, null, null, null, '1');
INSERT INTO `requirement` VALUES ('7', 'NOC letter from the venue', 'NOC letter from the venue', null, 'NOC letter from the venue', null, null, null, 'corporate', 'event', '1', '2019-12-23 09:54:07', '2019-12-23 09:54:07', null, null, '1', null, null);
INSERT INTO `requirement` VALUES ('8', 'Responsible Manager ID copy', 'Responsible Manager ID copy', null, 'Event owner’s passport copy', null, null, null, 'corporate', 'event', '1', '2019-12-23 09:54:10', '2019-12-23 09:54:10', null, null, null, null, '1');
INSERT INTO `requirement` VALUES ('10', 'labor card', 'labor card', null, 'optional', '6', null, 'long', null, 'artist', '1', '2019-11-13 17:30:42', '2019-11-13 17:30:42', null, '1', null, null, '1');
INSERT INTO `requirement` VALUES ('13', 'add organiser\'s id copy', 'add organiser\'s id copy', null, null, null, null, null, 'corporate', 'event', '1', '2020-02-19 10:59:17', '2020-02-19 10:59:17', '2020-02-19 10:59:17', '1', null, null, '0');
INSERT INTO `requirement` VALUES ('14', 'official letter', 'official letter', null, null, null, null, null, 'government', 'event', '1', '2019-11-27 16:00:16', '2019-11-27 16:00:16', null, '1', null, null, '0');
INSERT INTO `requirement` VALUES ('15', 'Risk management Plan', 'Risk management Plan', null, null, null, null, null, 'corporate', 'event', '1', '2019-12-23 09:54:12', '2019-12-23 09:54:12', null, '1', null, null, '0');
INSERT INTO `requirement` VALUES ('20', 'Insurance policy', 'Insurance policy', null, null, null, null, null, 'corporate', 'event', '1', '2019-12-23 09:54:13', '2019-12-23 09:54:13', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('21', 'Ambulance', 'Ambulance', null, null, null, null, null, 'corporate', 'event', '1', '2019-12-23 09:54:14', '2019-12-23 09:54:14', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('22', 'Noc Letter', 'Noc Letter', null, '', null, null, null, 'government', 'event', '1', '2019-11-27 16:06:29', '2019-11-27 16:06:34', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('23', 'RAK Health Department', 'RAK Health Department', null, '', null, null, null, null, 'truck', '1', '2020-01-18 16:59:36', '2020-01-18 16:59:36', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('24', 'Purchase Receipt Voucher', 'Purchase Receipt Voucher', null, '', null, null, null, null, 'liquor', '1', '2019-12-16 10:42:18', '2019-12-16 10:42:18', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('25', 'Company trade license', 'Company trade license', null, '', '12', null, null, 'corporate', 'company', '1', '2020-01-20 16:59:08', '2020-01-20 16:59:08', null, null, null, null, '1');
INSERT INTO `requirement` VALUES ('26', 'Contact person emirates ID', 'Contact person emirates ID', null, '', null, null, null, null, 'company', '1', '2019-12-30 13:41:36', '2019-12-30 13:41:36', null, null, null, null, '1');
INSERT INTO `requirement` VALUES ('27', 'NOC from manager', 'NOC from manager', null, '', null, null, null, null, 'company', '0', '2020-01-16 10:16:25', '2020-01-16 10:16:25', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('28', 'Vehicle Registration', 'Vehicle Registration', null, '', null, null, null, null, 'truck', '1', '2019-12-22 18:23:53', '2019-12-22 18:23:53', null, null, null, null, '1');
INSERT INTO `requirement` VALUES ('32', 'NOC from sponsor', 'NOC from sponsor', null, null, null, '0', 'long', null, 'artist', '1', '2020-01-18 16:58:31', '2020-01-18 16:58:31', null, '1', null, null, '0');
INSERT INTO `requirement` VALUES ('33', 'Other Documents', 'Other Documents', null, '', null, '0', null, 'corporate', 'event', '1', '2020-02-19 11:34:37', '2020-02-19 11:34:37', '2020-02-19 11:34:37', null, null, null, '0');
INSERT INTO `requirement` VALUES ('34', 'Other Documents', 'Other Documents', null, '', null, '0', 'long', null, 'artist', '1', '2020-01-22 11:01:18', '2020-01-22 11:01:18', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('35', 'Other Documents', 'Other Documents', null, '', null, '0', null, 'government', 'event', '1', '2020-01-22 11:01:21', '2020-01-22 11:01:21', null, null, null, null, '0');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(255) NOT NULL AUTO_INCREMENT,
  `Type` tinyint(1) DEFAULT NULL,
  `NameAr` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `NameEn` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `AppID` varchar(40) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL,
  `CreatedBy` int(255) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ModifiedBy` int(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', '0', 'موظف خدمة عملاء', 'admin', null, '1', '1', '1', '2019-12-26 09:42:18', null);
INSERT INTO `roles` VALUES ('2', '1', null, 'company', null, '1', '1', '1', '2019-12-22 12:11:32', null);
INSERT INTO `roles` VALUES ('3', '0', null, 'admin assistant', null, '1', '1', '1', '2019-12-22 12:11:32', null);
INSERT INTO `roles` VALUES ('4', '0', 'مفتش', 'inspector', null, '1', '1', '1', '2019-12-26 09:42:50', null);
INSERT INTO `roles` VALUES ('5', '0', 'مدير', 'manager', null, '1', '1', '1', '2019-12-26 09:42:33', null);
INSERT INTO `roles` VALUES ('6', '0', 'حكومة', 'government', null, '1', '1', '1', '2019-12-26 09:43:18', null);

-- ----------------------------
-- Table structure for roleuser
-- ----------------------------
DROP TABLE IF EXISTS `roleuser`;
CREATE TABLE `roleuser` (
  `IsActive` tinyint(1) NOT NULL,
  `CreatedBy` int(255) DEFAULT NULL,
  `CreatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ModifiedBy` int(255) DEFAULT NULL,
  `ModifiedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `role_id` int(255) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  KEY `Roles_RoleUser` (`role_id`),
  KEY `User_RoleUser` (`user_id`),
  CONSTRAINT `roleuser_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `roleuser_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of roleuser
-- ----------------------------
INSERT INTO `roleuser` VALUES ('1', null, '2019-11-14 04:29:55', null, '2019-11-14 04:29:55', '1', '1');
INSERT INTO `roleuser` VALUES ('1', null, '2019-11-14 03:50:34', null, '2019-11-14 03:50:34', '2', '2');
INSERT INTO `roleuser` VALUES ('1', null, '2019-11-14 03:51:31', null, '2019-11-14 03:51:31', '1', '3');
INSERT INTO `roleuser` VALUES ('1', null, '2019-11-30 13:06:29', null, '2019-11-30 13:06:29', '4', '4');
INSERT INTO `roleuser` VALUES ('1', null, '2019-12-26 10:49:35', null, '2019-12-26 10:49:35', '5', '5');
INSERT INTO `roleuser` VALUES ('1', null, '2019-11-30 13:08:28', null, '2019-11-30 13:08:28', '4', '6');

-- ----------------------------
-- Table structure for schedule_type
-- ----------------------------
DROP TABLE IF EXISTS `schedule_type`;
CREATE TABLE `schedule_type` (
  `schedule_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_type_name` varchar(255) DEFAULT NULL,
  `schedule_type_name_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`schedule_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of schedule_type
-- ----------------------------
INSERT INTO `schedule_type` VALUES ('1', 'Standard Schedule', 'جدول قياسي', '1', '2019-11-26 14:04:59', '2019-11-26 14:04:59', null);
INSERT INTO `schedule_type` VALUES ('2', 'Ramadan Schedule', 'جدول رمضان', null, '2019-11-26 13:01:10', '2019-11-26 13:01:10', null);
INSERT INTO `schedule_type` VALUES ('7', 'Test Schedule', 'جدول الاختبار', null, '2019-11-26 14:04:59', '2019-11-26 14:04:59', null);

-- ----------------------------
-- Table structure for schedule_type_daytime
-- ----------------------------
DROP TABLE IF EXISTS `schedule_type_daytime`;
CREATE TABLE `schedule_type_daytime` (
  `schedule_type_daytime_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_type_id` int(11) DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `is_dayoff` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`schedule_type_daytime_id`),
  KEY `schedule_type_id` (`schedule_type_id`),
  CONSTRAINT `schedule_type_daytime_ibfk_1` FOREIGN KEY (`schedule_type_id`) REFERENCES `schedule_type` (`schedule_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of schedule_type_daytime
-- ----------------------------
INSERT INTO `schedule_type_daytime` VALUES ('1', '1', '09:00:00', '17:00:00', 'Sunday', null, '2019-11-26 14:09:34', '2019-11-26 14:09:34', null);
INSERT INTO `schedule_type_daytime` VALUES ('2', '1', '09:00:00', '17:00:00', 'Monday', null, '2019-11-26 14:09:34', '2019-11-26 14:09:34', null);
INSERT INTO `schedule_type_daytime` VALUES ('3', '1', '09:00:00', '17:00:00', 'Tuesday', null, '2019-11-26 14:09:34', '2019-11-26 14:09:34', null);
INSERT INTO `schedule_type_daytime` VALUES ('4', '1', '09:00:00', '17:00:00', 'Wednesday', null, '2019-11-26 14:09:34', '2019-11-26 14:09:34', null);
INSERT INTO `schedule_type_daytime` VALUES ('5', '1', '09:00:00', '17:00:00', 'Thursday', null, '2019-11-26 14:09:34', '2019-11-26 14:09:34', null);
INSERT INTO `schedule_type_daytime` VALUES ('6', '1', null, null, 'Friday', '1', '2019-11-26 14:09:34', '2019-11-26 14:09:34', null);
INSERT INTO `schedule_type_daytime` VALUES ('7', '1', null, null, 'Saturday', '1', '2019-11-26 14:09:34', '2019-11-26 14:09:34', null);
INSERT INTO `schedule_type_daytime` VALUES ('8', '2', '09:00:00', '15:00:00', 'Sunday', null, null, null, null);
INSERT INTO `schedule_type_daytime` VALUES ('9', '2', '09:00:00', '15:00:00', 'Monday', null, null, null, null);
INSERT INTO `schedule_type_daytime` VALUES ('10', '2', '09:00:00', '15:00:00', 'Tuesday', null, null, null, null);
INSERT INTO `schedule_type_daytime` VALUES ('11', '2', '09:00:00', '15:00:00', 'Wednesday', null, null, null, null);
INSERT INTO `schedule_type_daytime` VALUES ('12', '2', '09:00:00', '15:00:00', 'Thursday', null, null, null, null);
INSERT INTO `schedule_type_daytime` VALUES ('13', '2', null, null, 'Friday', '1', null, null, null);
INSERT INTO `schedule_type_daytime` VALUES ('14', '2', null, null, 'Saturday', '1', null, null, null);
INSERT INTO `schedule_type_daytime` VALUES ('43', '7', '09:00:00', '19:00:00', 'Sunday', null, '2019-11-26 12:01:48', '2019-11-26 12:01:48', null);
INSERT INTO `schedule_type_daytime` VALUES ('44', '7', '09:00:00', '19:00:00', 'Monday', null, '2019-11-26 12:01:48', '2019-11-26 12:01:48', null);
INSERT INTO `schedule_type_daytime` VALUES ('45', '7', '09:00:00', '19:00:00', 'Tuesday', null, '2019-11-26 12:01:48', '2019-11-26 12:01:48', null);
INSERT INTO `schedule_type_daytime` VALUES ('46', '7', '09:00:00', '19:00:00', 'Wednesday', null, '2019-11-26 12:01:48', '2019-11-26 12:01:48', null);
INSERT INTO `schedule_type_daytime` VALUES ('47', '7', '09:00:00', '19:00:00', 'Thursday', null, '2019-11-26 12:01:48', '2019-11-26 12:01:48', null);
INSERT INTO `schedule_type_daytime` VALUES ('48', '7', null, null, 'Friday', '1', '2019-11-26 12:01:48', '2019-11-26 12:01:48', null);
INSERT INTO `schedule_type_daytime` VALUES ('49', '7', '09:00:00', '19:00:00', 'Saturday', null, '2019-11-26 12:01:48', '2019-11-26 12:01:48', null);

-- ----------------------------
-- Table structure for transaction
-- ----------------------------
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(255) DEFAULT NULL,
  `transaction_type` varchar(255) DEFAULT NULL COMMENT 'event, artist, classifcation, fines, all',
  `transaction_date` date DEFAULT NULL,
  `company_id` int(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `payment_transaction_id` varchar(45) DEFAULT NULL,
  `payment_receipt_no` varchar(45) DEFAULT NULL,
  `payment_order_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transaction
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `government_id` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '1-private, 2-individual, 3-government, 4-employee',
  `NameAr` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `NameEn` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL,
  `CreatedBy` int(255) DEFAULT NULL,
  `phoneCode` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `LanguageId` int(11) DEFAULT '1',
  `ModifiedBy` int(255) DEFAULT NULL,
  `ModifiedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EmpClientId` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', null, '4', 'Admin', 'Admin', 'pSYJWYlkph2nPpkDFqY4b5qQ5hQz5AeqUdANhzDkvDVMKOvDVW3p4rNDYcUU', 'admin', 'chri11s@nrsinfoways.com', null, null, '$2y$10$Ly67WHMQtgO8KXFNvoCd2ewHq9dqgkHHvEqZtDehwuzTkK2438vVi', '2019-12-23 17:34:38', '1', '1', null, '2020-02-20 13:05:11', '1', null, '2020-02-19 14:41:56', null);
INSERT INTO `user` VALUES ('2', null, '1', 'company', 'company', null, 'company', 'chris2232@nrsinfoways.com', '561234567', null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', '2019-12-13 13:25:55', '1', '1', '971', '2020-02-20 15:29:10', '1', null, '2020-02-16 14:29:11', '51');
INSERT INTO `user` VALUES ('3', null, '4', 'Rawan Al Turk', 'Rawan Al Turk', null, 'rawan', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', null, '1', '1', null, '2020-01-26 14:01:49', '2', null, '2020-01-26 14:01:49', null);
INSERT INTO `user` VALUES ('4', null, '4', 'Natalie Serkova ', 'Natalie Serkova ', null, 'natalie', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', null, '1', '1', null, '2020-01-26 14:02:05', '1', null, '2020-01-26 14:02:05', '142');
INSERT INTO `user` VALUES ('5', null, '4', 'Mohamed Loojab', 'Mohamed Loojab', null, 'mohamed', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', null, '1', '1', null, '2019-11-14 03:39:30', '1', null, '2019-11-14 03:39:30', null);
INSERT INTO `user` VALUES ('6', null, '4', 'Mohammed Nawab', 'Mohammed Nawab', null, 'nawab', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', null, '1', '1', null, '2019-12-05 18:04:01', '1', null, '2019-12-05 18:04:01', null);
INSERT INTO `user` VALUES ('8', null, '1', 'Myrna Orhtmann', 'Myrna Orhtmann', null, 'myrna', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', null, '1', '1', null, '2020-01-26 14:02:01', '1', null, '2020-01-26 14:02:01', '137');
INSERT INTO `user` VALUES ('9', null, '1', 'Gerhard Reinhard', 'Gerhard Reinhard', null, 'gerhard', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', '2019-12-24 10:03:09', '1', '1', null, '2020-01-26 14:02:14', '2', null, '2020-01-26 14:02:14', '139');
INSERT INTO `user` VALUES ('14', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2020-02-20 15:20:30', '1', null, '2020-02-20 15:20:30', null);

-- ----------------------------
-- Table structure for visa_type
-- ----------------------------
DROP TABLE IF EXISTS `visa_type`;
CREATE TABLE `visa_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visa_type_en` varchar(255) DEFAULT NULL,
  `visa_type_ar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of visa_type
-- ----------------------------
INSERT INTO `visa_type` VALUES ('2', 'Tourist Visas', 'Tourist Visas');
INSERT INTO `visa_type` VALUES ('3', 'Residence Visa', 'Residence Visa');
INSERT INTO `visa_type` VALUES ('4', 'Visit Visa', 'Visit Visa');
INSERT INTO `visa_type` VALUES ('5', 'Family Visa', 'Family Visa');
INSERT INTO `visa_type` VALUES ('6', 'Employment Visa', 'Employment Visa');
