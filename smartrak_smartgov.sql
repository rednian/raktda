/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : smartrak_smartgov

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2020-03-09 15:09:52
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
  `area_ar` varchar(255) DEFAULT NULL,
  `emirates_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emirates_id` (`emirates_id`),
  CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`emirates_id`) REFERENCES `emirates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of areas
-- ----------------------------
INSERT INTO `areas` VALUES ('1', 'Al Dafran', 'الدفران', '1');
INSERT INTO `areas` VALUES ('2', 'Al Falah ', 'الفلاح', '1');
INSERT INTO `areas` VALUES ('3', 'Al Hosn', 'الحصن', '1');
INSERT INTO `areas` VALUES ('4', 'Al Etihad', 'الاتحاد', '1');
INSERT INTO `areas` VALUES ('5', 'Al Bustan', 'البستان', '2');
INSERT INTO `areas` VALUES ('6', 'Al Khakeel', 'الخيل', '2');
INSERT INTO `areas` VALUES ('7', 'Al Mushairaf', 'المشيرف', '2');
INSERT INTO `areas` VALUES ('8', 'Al Nuaamiya', 'النعامية', '2');
INSERT INTO `areas` VALUES ('9', 'Al Agbiyya', 'الاجبية', '8');
INSERT INTO `areas` VALUES ('10', 'Al Bateen', 'البطين', '8');
INSERT INTO `areas` VALUES ('11', 'Al Faqa', 'الفقه', '8');
INSERT INTO `areas` VALUES ('12', 'Al Jahli', 'الجاهلي', '8');
INSERT INTO `areas` VALUES ('13', 'Al Jimi', 'الجيمي', '8');
INSERT INTO `areas` VALUES ('14', 'Bur Dubai', 'بر دبي', '3');
INSERT INTO `areas` VALUES ('15', 'Deira', 'ديرة', '3');
INSERT INTO `areas` VALUES ('16', 'Jumeriah', 'جميرا', '3');
INSERT INTO `areas` VALUES ('17', 'Karama', 'الكرامة', '3');
INSERT INTO `areas` VALUES ('19', 'Al Gofra', 'الجفرة', '4');
INSERT INTO `areas` VALUES ('20', 'Bitnah', 'بيتنا', '4');
INSERT INTO `areas` VALUES ('21', 'Fazeel', 'فاضل', '4');
INSERT INTO `areas` VALUES ('22', 'Khor Fakkan', 'خورفكان', '4');
INSERT INTO `areas` VALUES ('23', 'Murshid', 'مرشد', '4');
INSERT INTO `areas` VALUES ('24', 'Al Fulayyah', 'الفلية', '5');
INSERT INTO `areas` VALUES ('25', 'Al Hamrah', 'الحمرا', '5');
INSERT INTO `areas` VALUES ('26', 'Al Jazirah', 'الجزيرة', '5');
INSERT INTO `areas` VALUES ('27', 'Digdagga', 'دقداقة', '5');
INSERT INTO `areas` VALUES ('28', 'Abu Shagara', 'ابو شجاره', '6');
INSERT INTO `areas` VALUES ('29', 'Al Abar', 'العبار', '6');
INSERT INTO `areas` VALUES ('30', 'Al Dhaid', 'الذيد', '6');
INSERT INTO `areas` VALUES ('31', 'Al Falaj', 'الفلج', '6');
INSERT INTO `areas` VALUES ('32', 'Al Abreq A', 'الأبرق', '7');
INSERT INTO `areas` VALUES ('33', 'Al Hassan', 'الحسن', '7');
INSERT INTO `areas` VALUES ('34', 'Al Khor', 'الخور', '7');
INSERT INTO `areas` VALUES ('35', 'Al Mudar', 'المدار', '7');
INSERT INTO `areas` VALUES ('36', 'Al Darbijaniyah', 'الدربيجانية', '5');
INSERT INTO `areas` VALUES ('37', 'Al Dhait', 'الظيت', '5');
INSERT INTO `areas` VALUES ('38', 'Al Hamra', 'الحمرا', '5');
INSERT INTO `areas` VALUES ('39', 'Al Hamra Village', 'قرية الحمرا', '5');
INSERT INTO `areas` VALUES ('40', 'Al Hudaihbah', 'الحضيبة', '5');
INSERT INTO `areas` VALUES ('41', 'Al Juwais', 'الجويس', '5');
INSERT INTO `areas` VALUES ('42', 'Al Nakheel', 'النخيل', '5');
INSERT INTO `areas` VALUES ('43', 'Al Seer', 'السير', '5');
INSERT INTO `areas` VALUES ('44', 'Al Soor', 'السور', '5');
INSERT INTO `areas` VALUES ('45', 'Al Uraibi', 'العريبي', '5');
INSERT INTO `areas` VALUES ('46', 'Al Zahra', 'الزهراء', '5');
INSERT INTO `areas` VALUES ('47', 'Dafan Al Khor', 'دفان الخور', '5');
INSERT INTO `areas` VALUES ('48', 'Dafan Al Nakheel', 'دفان النخيل', '5');
INSERT INTO `areas` VALUES ('49', 'Jazeera Al Hamra', 'الجزيرة الحمراء', '5');
INSERT INTO `areas` VALUES ('50', 'Julfar', 'جلفار', '5');
INSERT INTO `areas` VALUES ('51', 'Khuzam', 'خزام', '5');
INSERT INTO `areas` VALUES ('52', 'Mamourah ', 'المعمورة', '5');
INSERT INTO `areas` VALUES ('53', 'Seih Al Burairat', 'سيح البريرات', '5');
INSERT INTO `areas` VALUES ('54', 'Seih Al Hudaibah', 'سيح الحديبة', '5');
INSERT INTO `areas` VALUES ('55', 'Seih Al Uraibi', 'سيح العريبي', '5');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
  `sponsor_name_ar` varchar(255) DEFAULT NULL,
  `sponsor_name_en` varchar(255) DEFAULT NULL,
  `visa_expire_date` date DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `lastname_ar` varchar(255) DEFAULT NULL,
  `lastname_en` varchar(255) DEFAULT NULL,
  `firstname_ar` varchar(255) DEFAULT NULL,
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
  `address_ar` varchar(255) DEFAULT '0',
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
  `replace_reason_ar` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of artist_permit_check
-- ----------------------------
INSERT INTO `artist_permit_check` VALUES ('1', '2', '0', null, null, '2020-02-25 14:25:58', '2020-02-25 14:25:58', null);
INSERT INTO `artist_permit_check` VALUES ('4', '1', '0', null, null, '2020-02-25 16:58:37', '2020-02-25 16:58:37', null);
INSERT INTO `artist_permit_check` VALUES ('5', '3', '0', null, null, '2020-02-27 11:45:15', '2020-02-27 11:45:15', null);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `firstname_ar` varchar(255) DEFAULT NULL,
  `lastname_ar` varchar(255) DEFAULT NULL,
  `firstname_en` varchar(255) DEFAULT NULL,
  `lastname_en` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT '',
  `birthdate` date DEFAULT NULL,
  `artist_permit_id` int(11) DEFAULT NULL,
  `sponsor_name_en` varchar(255) DEFAULT NULL,
  `sponsor_name_ar` varchar(255) DEFAULT NULL,
  `visa_type` varchar(255) DEFAULT '',
  `mobile_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fax_number` varchar(255) DEFAULT NULL,
  `po_box` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address_ar` varchar(255) DEFAULT NULL,
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
  `work_location_ar` varchar(255) DEFAULT NULL,
  `old_artist_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_paid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of artist_temp_document
-- ----------------------------

-- ----------------------------
-- Table structure for audits
-- ----------------------------
DROP TABLE IF EXISTS `audits`;
CREATE TABLE `audits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `event` varchar(191) NOT NULL,
  `auditable_type` varchar(191) NOT NULL,
  `auditable_id` bigint(20) unsigned NOT NULL,
  `old_values` text,
  `new_values` text,
  `url` text,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(191) DEFAULT NULL,
  `tags` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8;

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
  `company_description_ar` varchar(255) DEFAULT NULL,
  `company_description_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('1', '1', 'new registration', '2020-02-23 18:09:50', '2020-02-26 10:35:52', null, null, 'EST-2020-0001', '2', 'active', 'Dolor accusamus aliq', 'Incididunt magni quo', 'Jordan Munoz', 'Philip Osborn', 'lokotatezi@mailinator.com', '+1 (514) 885-6572', null, 'Suscipit voluptas ex', null, '2020-08-20 00:00:00', '46', '5', '232', 'Consequat Dolorem v', '2020-02-23 18:06:24', '2020-02-27 10:46:13');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company_artist_draft
-- ----------------------------

-- ----------------------------
-- Table structure for company_comment
-- ----------------------------
DROP TABLE IF EXISTS `company_comment`;
CREATE TABLE `company_comment` (
  `company_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_ar` varchar(255) DEFAULT NULL,
  `comment_en` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_comment_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `company_comment_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company_comment
-- ----------------------------
INSERT INTO `company_comment` VALUES ('1', null, null, '1', 'approved', '1', '2020-02-23 18:10:38', '2020-02-23 18:10:38');
INSERT INTO `company_comment` VALUES ('2', null, null, '1', 'approved', '1', '2020-02-26 10:35:52', '2020-02-26 10:35:52');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company_contact
-- ----------------------------
INSERT INTO `company_contact` VALUES ('1', 'Caleb Herman', 'Caesar Mcdaniel', 'Voluptas culpa eveni', '2014-02-12 00:00:00', '0000-00-00 00:00:00', 'Eu temporibus volupt', 'Incidunt hic vel et', null, '1', '316', '2020-02-23 18:11:33', '2020-02-23 18:11:33');

-- ----------------------------
-- Table structure for company_other_upload
-- ----------------------------
DROP TABLE IF EXISTS `company_other_upload`;
CREATE TABLE `company_other_upload` (
  `other_upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) DEFAULT NULL,
  `name_er` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`other_upload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company_other_upload
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company_request
-- ----------------------------
INSERT INTO `company_request` VALUES ('1', 'new registration', null, '1', '2020-02-23 18:09:50', '2020-02-23 18:09:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company_requirement
-- ----------------------------
INSERT INTO `company_requirement` VALUES ('1', '1', 'application/pdf', 'requirement', '1', '1', null, null, 'company/1/company_trade_license_1_1582466979.pdf', '25', '2020-02-23 18:11:33', '2020-02-23 18:11:33');
INSERT INTO `company_requirement` VALUES ('2', '1', 'application/pdf', 'requirement', '1', '1', null, null, 'company/1/contact_person_emirates_id_1_1582466987.pdf', '26', '2020-02-23 18:11:33', '2020-02-23 18:11:33');

-- ----------------------------
-- Table structure for company_type
-- ----------------------------
DROP TABLE IF EXISTS `company_type`;
CREATE TABLE `company_type` (
  `company_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
  `name_ar` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

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
  `emp_custom_name_ar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`emp_custom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

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
  `remarks` mediumtext,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`employee_leave_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `employee_leave_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employee_leave
-- ----------------------------
INSERT INTO `employee_leave` VALUES ('1', '1', '1', '2019-12-04 09:00:00', '2019-12-04 17:00:00', 'Lorem ipsum dolor sit amit.', '2019-12-04 13:53:48', '2019-12-04 13:53:48', null);
INSERT INTO `employee_leave` VALUES ('2', '3', '2', '2019-12-13 09:00:00', '2020-01-13 17:00:00', 'Vacation Leave', '2019-12-04 14:01:17', '2019-12-04 14:01:17', null);
INSERT INTO `employee_leave` VALUES ('3', '3', '8', '2019-12-04 09:00:00', '2019-12-04 17:00:00', 'Absent sya kay sakit iya tiyan kay gidugo.', '2019-12-04 14:18:01', '2019-12-04 14:18:01', null);
INSERT INTO `employee_leave` VALUES ('4', '3', '3', '2019-12-06 09:00:00', '2019-12-09 17:00:00', 'Leave kay kalibangon', '2019-12-04 14:16:31', '2019-12-04 14:16:31', null);
INSERT INTO `employee_leave` VALUES ('5', '3', '6', '1974-12-04 00:00:00', '2008-04-05 00:00:00', 'Veritatis et aut qua', '2020-02-26 12:07:20', '2020-02-26 12:07:20', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employee_work_schedule
-- ----------------------------
INSERT INTO `employee_work_schedule` VALUES ('6', '3', '1', null, '2019-11-30 11:10:38', '2019-11-30 11:10:38', null, null);
INSERT INTO `employee_work_schedule` VALUES ('7', '4', '1', null, '2019-12-10 12:28:22', '2019-12-10 12:28:22', null, null);
INSERT INTO `employee_work_schedule` VALUES ('8', '6', '1', null, '2019-12-10 12:28:34', '2019-12-10 12:28:34', null, null);
INSERT INTO `employee_work_schedule` VALUES ('9', '17', '1', null, '2020-02-26 11:59:51', '2020-02-26 11:59:51', null, null);

-- ----------------------------
-- Table structure for event
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `description_ar` varchar(255) DEFAULT NULL,
  `description_en` varchar(255) DEFAULT NULL,
  `logo_thumbnail` varchar(255) DEFAULT NULL,
  `logo_original` varchar(255) DEFAULT NULL,
  `cancel_date` timestamp NULL DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `note_ar` varchar(255) DEFAULT NULL,
  `additional_location_info` varchar(255) DEFAULT NULL,
  `note_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `last_check_by` int(11) DEFAULT NULL,
  `lock` timestamp NULL DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `permit_number` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `venue_ar` varchar(255) DEFAULT '',
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
  `cancel_reason` varchar(255) DEFAULT NULL,
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
  `owner_name_ar` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_approver
-- ----------------------------

-- ----------------------------
-- Table structure for event_check
-- ----------------------------
DROP TABLE IF EXISTS `event_check`;
CREATE TABLE `event_check` (
  `event_check_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `issued_date` varchar(255) DEFAULT NULL,
  `expired_date` varchar(255) DEFAULT NULL,
  `time_start` varchar(255) DEFAULT NULL,
  `time_end` varchar(255) DEFAULT NULL,
  `permit_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `venue_ar` varchar(255) DEFAULT NULL,
  `venue_en` varchar(255) DEFAULT NULL,
  `event_type` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `area_en` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `emirates` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`event_check_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_check
-- ----------------------------
INSERT INTO `event_check` VALUES ('4', '4', '1', null, 'Hannah Franco', 'Asher Buchanan', '05-March-2020', null, '12:00 am', '1', null, 'Architecto quod comm', 'Dolor earum aliquid officia praesentium aliquid aliqua Qui labore consectetur neque laboriosam harum minima sed ullam nostrum voluptate enim fugit', 'Id id harum quia irure vel obcaecati commodo culpa rem velit', 'Business Summit', null, 'Al Zahra', '2020-02-26 11:32:04', '2020-02-26 11:32:04', null);
INSERT INTO `event_check` VALUES ('5', '5', '1', null, 'Ruth Curtis', 'Ulric Wilkins', '03-March-2020', '04-March-2020', '09:59 am', '09:59 am', null, 'Totam omnis commodi', 'Repellendus Labore rerum voluptatem Esse voluptas ut temporibus velit qui', 'Aut ducimus occaecat laudantium laudantium ullamco cum et sed blanditiis quidem minus nostrud est ullam sunt Nam velit vero', 'Walking races', null, 'Al Hamra', '2020-02-27 10:01:01', '2020-02-27 10:01:01', null);

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
  `comment_ar` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `exempt_payment` varchar(255) DEFAULT NULL,
  `type` tinyint(4) DEFAULT '0' COMMENT '1 for client comment otherwise 0',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_comment_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_comment
-- ----------------------------
INSERT INTO `event_comment` VALUES ('1', '1', 'admin', null, 'send back for amendments', null, 'tese', '1', '4', null, '1', '2020-02-26 09:39:13', '2020-02-26 09:39:13');
INSERT INTO `event_comment` VALUES ('2', '1', null, null, 'cancelled', 'سلا', 'asdfgd', '1', '4', null, '0', '2020-02-26 09:55:54', '2020-02-26 09:55:54');
INSERT INTO `event_comment` VALUES ('3', '1', null, null, 'cancelled', 'سيففققف', 'sfgd', '1', '4', null, '0', '2020-02-26 10:28:35', '2020-02-26 10:28:35');
INSERT INTO `event_comment` VALUES ('4', '1', 'admin', null, 'send back for amendments', null, 'okay need to write a comment', '1', '4', null, '1', '2020-02-26 10:42:07', '2020-02-26 10:42:07');
INSERT INTO `event_comment` VALUES ('5', '1', 'admin', null, 'send back for amendments', null, 'erty', '1', '4', null, '1', '2020-02-26 10:43:51', '2020-02-26 10:43:51');
INSERT INTO `event_comment` VALUES ('6', '1', 'admin', null, 'need approval', null, 'asdfghj', '1', '4', null, '1', '2020-02-26 11:32:04', '2020-02-26 11:32:04');
INSERT INTO `event_comment` VALUES ('7', '4', 'admin', null, 'pending', null, null, null, '4', null, '0', '2020-02-26 11:32:04', '2020-02-26 11:32:04');
INSERT INTO `event_comment` VALUES ('8', '5', 'admin', null, 'pending', null, null, null, '4', null, '0', '2020-02-26 11:32:08', '2020-02-26 11:32:08');
INSERT INTO `event_comment` VALUES ('9', '1', 'admin', null, 'approved-unpaid', null, null, '1', '5', null, '1', '2020-02-27 10:01:02', '2020-02-27 10:01:02');

-- ----------------------------
-- Table structure for event_liquor
-- ----------------------------
DROP TABLE IF EXISTS `event_liquor`;
CREATE TABLE `event_liquor` (
  `event_liquor_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `company_name_ar` varchar(255) DEFAULT NULL,
  `company_name_en` varchar(255) DEFAULT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(12) DEFAULT NULL,
  `created_by` int(255) DEFAULT NULL,
  `purchase_receipt` varchar(255) DEFAULT NULL,
  `liquor_service` varchar(255) DEFAULT NULL,
  `liquor_types` mediumtext,
  `liquor_permit_no` varchar(255) DEFAULT NULL,
  `provided` int(11) DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_liquor_id`),
  KEY `event_id` (`event_id`),
  KEY `event_liquor_id` (`event_liquor_id`),
  CONSTRAINT `event_liquor_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of event_requirement
-- ----------------------------
INSERT INTO `event_requirement` VALUES ('1', '16/event/1/3/entertainment_events__1_23_02_2020_18_15_46.pdf', '1', '0000-00-00', '0000-00-00', '1', '2020-02-23 18:15:46', '2020-02-23 18:15:46', '3', 'event');
INSERT INTO `event_requirement` VALUES ('2', '16/event/3/35/sports_events_1_26_02_2020_09_36_40.jpg', '3', '0000-00-00', '0000-00-00', '6', '2020-02-26 09:36:40', '2020-02-26 09:36:40', '35', 'event');
INSERT INTO `event_requirement` VALUES ('3', '16/event/4/7/business_events_1_26_02_2020_09_38_20.jpg', '4', '0000-00-00', '0000-00-00', '2', '2020-02-26 09:38:20', '2020-02-26 09:38:20', '7', 'event');
INSERT INTO `event_requirement` VALUES ('4', '16/event/4/7/business_events_2_26_02_2020_09_38_20.png', '4', '0000-00-00', '0000-00-00', '2', '2020-02-26 09:38:20', '2020-02-26 09:38:20', '7', 'event');
INSERT INTO `event_requirement` VALUES ('5', '16/event/5/7/sports_events_2_27_02_2020_09_59_59.pdf', '5', '0000-00-00', '0000-00-00', '6', '2020-02-27 09:59:59', '2020-02-27 09:59:59', '7', 'event');
INSERT INTO `event_requirement` VALUES ('6', '16/event/5/15/sports_events_1_27_02_2020_09_59_59.pdf', '5', '0000-00-00', '0000-00-00', '6', '2020-02-27 09:59:59', '2020-02-27 09:59:59', '15', 'event');
INSERT INTO `event_requirement` VALUES ('7', '16/event/8/7/sports_events_1_29_02_2020_09_51_26.jpg', '8', '0000-00-00', '0000-00-00', '6', '2020-02-29 09:51:26', '2020-02-29 09:51:26', '7', 'event');
INSERT INTO `event_requirement` VALUES ('8', '16/event/8/15/sports_events_1_29_02_2020_09_51_26.jpg', '8', '0000-00-00', '0000-00-00', '6', '2020-02-29 09:51:26', '2020-02-29 09:51:26', '15', 'event');
INSERT INTO `event_requirement` VALUES ('9', '16/event/14/7/sports_events_1_29_02_2020_09_58_30.jpg', '14', '0000-00-00', '0000-00-00', '6', '2020-02-29 09:58:30', '2020-02-29 09:58:30', '7', 'event');
INSERT INTO `event_requirement` VALUES ('10', '16/event/14/15/sports_events_1_29_02_2020_09_58_30.jpg', '14', '0000-00-00', '0000-00-00', '6', '2020-02-29 09:58:30', '2020-02-29 09:58:30', '15', 'event');
INSERT INTO `event_requirement` VALUES ('11', '16/event/15/7/business_events_1_29_02_2020_10_01_03.jpg', '15', '0000-00-00', '0000-00-00', '2', '2020-02-29 10:01:03', '2020-02-29 10:01:03', '7', 'event');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_transaction
-- ----------------------------

-- ----------------------------
-- Table structure for event_truck
-- ----------------------------
DROP TABLE IF EXISTS `event_truck`;
CREATE TABLE `event_truck` (
  `event_truck_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name_ar` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
  `name_ar` varchar(255) DEFAULT NULL,
  `description_en` varchar(255) DEFAULT NULL,
  `description_ar` varchar(255) DEFAULT NULL,
  `amount` double(255,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

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
INSERT INTO `event_type_requirement` VALUES ('33', '1', '0', '35');
INSERT INTO `event_type_requirement` VALUES ('34', '2', '0', '35');
INSERT INTO `event_type_requirement` VALUES ('35', '3', '0', '35');
INSERT INTO `event_type_requirement` VALUES ('36', '4', '0', '35');
INSERT INTO `event_type_requirement` VALUES ('37', '5', '0', '35');
INSERT INTO `event_type_requirement` VALUES ('38', '6', '0', '35');
INSERT INTO `event_type_requirement` VALUES ('39', '9', '0', '35');
INSERT INTO `event_type_requirement` VALUES ('40', null, null, null);

-- ----------------------------
-- Table structure for event_type_sub
-- ----------------------------
DROP TABLE IF EXISTS `event_type_sub`;
CREATE TABLE `event_type_sub` (
  `event_type_sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_name_en` varchar(255) DEFAULT NULL,
  `sub_name_ar` varchar(255) DEFAULT NULL,
  `event_type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`event_type_sub_id`),
  KEY `event_type_id` (`event_type_id`),
  CONSTRAINT `event_type_sub_ibfk_1` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`event_type_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_type_sub
-- ----------------------------
INSERT INTO `event_type_sub` VALUES ('1', 'Business meetings', 'إجتماعات أعمال', '2', '2019-12-24 09:46:41', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('2', 'Business conferences', 'مؤتمرات أعمال', '2', '2019-12-29 09:51:29', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('3', 'Business seminars', 'ندوات أعمال', '2', '2019-12-29 09:54:40', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('4', 'Business lectures', 'محاضرات أعمال', '2', '2019-12-29 09:55:45', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('5', 'Business Summit', 'قمة أعمال', '2', '2019-12-29 09:56:31', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('6', 'Exhibitions Commercial Trade / consumer/specialized', 'معارض تجارية / استهلاكية / تخصصية', '2', '2019-12-29 09:57:09', '2020-01-15 17:25:26', null);
INSERT INTO `event_type_sub` VALUES ('7', 'Auctions', 'المزادات', '2', '2019-12-29 10:01:29', '2019-12-29 10:01:43', null);
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
  `name_ar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
  `government_name_en` varchar(255) DEFAULT NULL,
  `government_name_ar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`government_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
  `remarks` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

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
INSERT INTO `happiness` VALUES ('53', 'event', '24', 'test', '100', '16', '2020-02-23 10:07:59', '2020-02-23 10:07:59');
INSERT INTO `happiness` VALUES ('54', 'artist', '6', 'test', '100', '16', '2020-02-23 10:31:30', '2020-02-23 10:31:30');
INSERT INTO `happiness` VALUES ('55', 'event', '5', 'fdas', '100', '16', '2020-02-27 10:04:11', '2020-02-27 10:04:11');
INSERT INTO `happiness` VALUES ('56', 'artist', '1', 'good', '100', '16', '2020-02-27 11:02:51', '2020-02-27 11:02:51');

-- ----------------------------
-- Table structure for holiday
-- ----------------------------
DROP TABLE IF EXISTS `holiday`;
CREATE TABLE `holiday` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(255) DEFAULT NULL,
  `holiday_name_ar` varchar(255) DEFAULT NULL,
  `holiday_start` timestamp NULL DEFAULT NULL,
  `holiday_end` timestamp NULL DEFAULT NULL,
  `is_working` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
  `name_ar` varchar(255) DEFAULT '',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
  `leave_type_name_ar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`leave_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notifications
-- ----------------------------

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
  `work_location_ar` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `comment_ar` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
  `name_ar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`profession_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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
  `questionnaire_name_ar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`questionnaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `question_name_ar` varchar(255) DEFAULT NULL,
  `question_type` varchar(255) DEFAULT NULL,
  `is_required_image` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
  `question_choice_name_ar` varchar(255) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`question_choice_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `question_choices_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `name_ar` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
  `requirement_name_ar` varchar(255) DEFAULT NULL,
  `requirement_name` varchar(255) DEFAULT NULL,
  `requirement_description_ar` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of requirement
-- ----------------------------
INSERT INTO `requirement` VALUES ('1', ' فتجعلها تبدو ', 'passport', null, 'passport should be valid', null, null, 'short', 'corporate', 'artist', '1', '2020-01-18 09:38:50', '2020-01-18 09:38:50', null, null, null, '1', '1');
INSERT INTO `requirement` VALUES ('3', 'Event brief and sponsorship package', 'Event brief and sponsorship package', null, 'Event brief and sponsorship package', null, null, null, 'government', 'event', '1', '2019-11-27 15:52:43', '2019-11-27 15:52:43', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('4', 'تقرير طبي', 'medical report', null, 'should be valid 6 months from the date of issuance. This is not required for event related artists.', '6', null, 'long', null, 'artist', '1', '2020-03-04 17:22:58', '2020-03-04 17:22:58', null, null, '1', null, '1');
INSERT INTO `requirement` VALUES ('6', 'التأشيرة', 'Visa', null, 'Visa Should be Valid ', null, null, 'short', null, 'artist', '1', '2020-03-04 17:23:04', '2020-03-04 17:23:04', null, null, null, null, '1');
INSERT INTO `requirement` VALUES ('7', 'رسالة لامانع من المزود', 'NOC letter from the venue', null, 'NOC letter from the venue', null, null, null, 'corporate', 'event', '1', '2020-03-04 17:23:12', '2020-03-04 17:23:12', null, null, '1', null, null);
INSERT INTO `requirement` VALUES ('8', 'صورة من الهوية الإماراتية للمدير المسؤول', 'Responsible Manager ID copy', null, 'Event owner’s passport copy', null, null, null, 'corporate', 'event', '1', '2020-03-04 17:23:19', '2020-03-04 17:23:19', null, null, null, null, '1');
INSERT INTO `requirement` VALUES ('10', 'بطاقة العمل', 'labor card', null, 'optional', '6', null, 'long', null, 'artist', '1', '2020-03-04 17:23:26', '2020-03-04 17:23:26', null, '1', null, null, '1');
INSERT INTO `requirement` VALUES ('13', 'إضافة صورة الهوية الإماراتية للشخص المنظم', 'add organiser\'s id copy', null, null, null, null, null, 'corporate', 'event', '1', '2020-03-04 17:23:37', '2020-03-04 17:23:37', '2020-02-19 10:59:17', '1', null, null, '0');
INSERT INTO `requirement` VALUES ('14', 'official letter', 'official letter', null, null, null, null, null, 'government', 'event', '1', '2019-11-27 16:00:16', '2019-11-27 16:00:16', null, '1', null, null, '0');
INSERT INTO `requirement` VALUES ('15', 'خطة إدارة المخاطر', 'Risk management Plan', null, null, null, null, null, 'corporate', 'event', '1', '2020-03-04 17:23:45', '2020-03-04 17:23:45', null, '1', null, null, '0');
INSERT INTO `requirement` VALUES ('20', 'بوليصة تأمين', 'Insurance policy', null, null, null, null, null, 'corporate', 'event', '1', '2020-03-04 17:23:51', '2020-03-04 17:23:51', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('21', 'سيارة إسعاف', 'Ambulance', null, null, null, null, null, 'corporate', 'event', '1', '2020-03-04 17:23:59', '2020-03-04 17:23:59', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('22', 'رسالة لامانع', 'Noc Letter', null, '', null, null, null, 'government', 'event', '1', '2020-03-04 17:24:06', '2020-03-04 17:24:06', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('23', 'RAK Health Department', 'RAK Health Department', null, '', null, null, null, null, 'truck', '1', '2020-01-18 16:59:36', '2020-01-18 16:59:36', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('24', 'Purchase Receipt Voucher', 'Purchase Receipt Voucher', null, '', null, null, null, null, 'liquor', '1', '2019-12-16 10:42:18', '2019-12-16 10:42:18', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('25', 'الرخصة التجارية للمنشأة', 'Business trade license', null, '', '12', null, null, 'corporate', 'company', '1', '2020-03-04 17:26:10', '2020-03-04 17:26:10', null, null, null, null, '1');
INSERT INTO `requirement` VALUES ('26', 'الهوية الإماراتية لجهة الاتصال', 'Contact person emirates ID', null, '', null, null, null, null, 'company', '1', '2020-03-04 17:24:57', '2020-03-04 17:24:57', null, null, null, null, '1');
INSERT INTO `requirement` VALUES ('27', 'شهادة لا مانع من المدير', 'NOC from manager', null, '', null, null, null, null, 'company', '0', '2020-03-04 17:25:10', '2020-03-04 17:25:10', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('28', 'تسجيل المركبة', 'Vehicle Registration', null, '', null, null, null, null, 'truck', '1', '2020-03-04 17:25:17', '2020-03-04 17:25:17', null, null, null, null, '1');
INSERT INTO `requirement` VALUES ('32', 'شهادة لا مانع من الكفيل', 'NOC from sponsor', null, null, null, '0', 'long', null, 'artist', '1', '2020-03-04 17:25:24', '2020-03-04 17:25:24', null, '1', null, null, '0');
INSERT INTO `requirement` VALUES ('33', 'مستندات أخرى', 'Other Documents', null, '', null, '0', null, 'corporate', 'event', '1', '2020-03-04 17:25:31', '2020-03-04 17:25:31', '2020-02-19 11:34:37', null, null, null, '0');
INSERT INTO `requirement` VALUES ('34', 'مستندات أخرى', 'Other Documents', null, '', null, '0', 'long', null, 'artist', '1', '2020-03-04 17:25:33', '2020-03-04 17:25:33', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('35', 'مستندات أخرى', 'Other Documents', null, '', null, '0', null, 'government', 'event', '1', '2020-03-04 17:25:35', '2020-03-04 17:25:35', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('36', 'اتفاقية مزود مشروبات كحولية', 'Liquor Supplier Agreement', null, '', null, '0', null, 'provided', 'liquor', '1', '2020-03-04 17:25:42', '2020-03-04 17:25:42', null, null, null, null, '0');
INSERT INTO `requirement` VALUES ('37', 'رخصة مشروبات كحولية', 'Liquor License', null, '', null, '0', null, 'provided', 'liquor', '1', '2020-03-04 17:25:48', '2020-03-04 17:25:48', null, null, null, null, '0');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(255) NOT NULL AUTO_INCREMENT,
  `Type` tinyint(1) DEFAULT NULL,
  `NameAr` varchar(255) DEFAULT NULL,
  `NameEn` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `AppID` varchar(40) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL,
  `CreatedBy` int(255) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ModifiedBy` int(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roleuser
-- ----------------------------
INSERT INTO `roleuser` VALUES ('1', null, '2019-11-14 04:29:55', null, '2019-11-14 04:29:55', '1', '1');
INSERT INTO `roleuser` VALUES ('1', null, '2019-11-14 03:51:31', null, '2019-11-14 03:51:31', '1', '3');
INSERT INTO `roleuser` VALUES ('1', null, '2019-11-30 13:06:29', null, '2019-11-30 13:06:29', '4', '4');
INSERT INTO `roleuser` VALUES ('1', null, '2019-12-26 10:49:35', null, '2019-12-26 10:49:35', '5', '5');
INSERT INTO `roleuser` VALUES ('1', null, '2019-11-30 13:08:28', null, '2019-11-30 13:08:28', '4', '6');
INSERT INTO `roleuser` VALUES ('0', null, '2020-02-23 09:24:01', null, '2020-02-23 09:24:01', '2', '15');
INSERT INTO `roleuser` VALUES ('0', null, '2020-02-23 18:06:25', null, '2020-02-23 18:06:25', '2', '16');
INSERT INTO `roleuser` VALUES ('1', null, '2020-02-26 11:59:51', null, '2020-02-26 11:59:51', '5', '17');

-- ----------------------------
-- Table structure for schedule_type
-- ----------------------------
DROP TABLE IF EXISTS `schedule_type`;
CREATE TABLE `schedule_type` (
  `schedule_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_type_name` varchar(255) DEFAULT NULL,
  `schedule_type_name_ar` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`schedule_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
  `NameAr` varchar(255) DEFAULT NULL,
  `NameEn` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', null, '4', 'Admin', 'Admin', 'xqvLsncyS1h3qDQvBeFnYo1PrGSjwQb6ifGZaO3IMowQjEf4AI5kJUj47vW3', 'admin', 'chri11s@nrsinfoways.com', null, null, '$2y$10$Ly67WHMQtgO8KXFNvoCd2ewHq9dqgkHHvEqZtDehwuzTkK2438vVi', '2019-12-23 17:34:38', '1', '1', null, '2020-03-07 09:27:00', '1', null, '2020-03-07 09:27:00', null);
INSERT INTO `user` VALUES ('3', null, '4', 'Rawan Al Turk', 'Rawan Al Turk', null, 'rawan', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', null, '1', '1', null, '2020-01-26 14:01:49', '2', null, '2020-01-26 14:01:49', null);
INSERT INTO `user` VALUES ('4', null, '4', 'Natalie Serkova ', 'Natalie Serkova ', null, 'natalie', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', null, '1', '1', null, '2020-01-26 14:02:05', '1', null, '2020-01-26 14:02:05', '142');
INSERT INTO `user` VALUES ('5', null, '4', 'Mohamed Loojab', 'Mohamed Loojab', null, 'mohamed', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', null, '1', '1', null, '2019-11-14 03:39:30', '1', null, '2019-11-14 03:39:30', null);
INSERT INTO `user` VALUES ('6', null, '4', 'Mohammed Nawab', 'Mohammed Nawab', null, 'nawab', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', null, '1', '1', null, '2019-12-05 18:04:01', '1', null, '2019-12-05 18:04:01', null);
INSERT INTO `user` VALUES ('8', null, '1', 'Myrna Orhtmann', 'Myrna Orhtmann', null, 'myrna', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', null, '1', '1', null, '2020-01-26 14:02:01', '1', null, '2020-01-26 14:02:01', '137');
INSERT INTO `user` VALUES ('9', null, '1', 'Gerhard Reinhard', 'Gerhard Reinhard', null, 'gerhard', null, null, null, '$2y$10$0P44XnK78.gZ5p/ukGGfLuqkKiI4/.bEThhioXl5JoqXOOFsoElua', '2019-12-24 10:03:09', '1', '1', null, '2020-01-26 14:02:14', '2', null, '2020-01-26 14:02:14', '139');
INSERT INTO `user` VALUES ('15', null, '1', null, 'Norman Sheppard', null, 'chris', 'dufepipe@mailinator.com', null, null, '$2y$10$Ly67WHMQtgO8KXFNvoCd2ewHq9dqgkHHvEqZtDehwuzTkK2438vVi', '2020-02-23 09:24:36', '0', null, '971', '2020-02-23 11:40:06', '1', null, '2020-02-23 09:24:14', '140');
INSERT INTO `user` VALUES ('16', null, '1', null, 'Oscar Peck', 'O4tZMGAczV2kwgbFuqbeQawTEWhtxXULdTz19i4gjeCRCjtrECW3aYFe1ylX', 'company', 'chris@nrsinfoways.com', '1234566345', null, '$2y$10$ZpblCCShX/C.yNH7PeRmFOZfpIPNky/Ie8jsOK0OHtQvl5i3JBLxy', '2020-02-23 18:09:09', '0', null, '971', '2020-03-03 13:55:32', '1', null, '2020-03-03 13:55:32', '1');
INSERT INTO `user` VALUES ('17', null, '4', 'Abdul Lang', 'Sean Merrill', null, 'koniva', 'fahacagid@mailinator.com', '27', 'Quia minim et non eu', '$2y$10$WyGeAWSCmL0WvQGQlzvHP.rk1sGqzBH4fiwyZqJ0gmWD34QrB5JEi', null, '1', '1', null, '2020-02-26 11:59:51', '1', null, '2020-02-26 11:59:51', null);

-- ----------------------------
-- Table structure for visa_type
-- ----------------------------
DROP TABLE IF EXISTS `visa_type`;
CREATE TABLE `visa_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visa_type_en` varchar(255) DEFAULT NULL,
  `visa_type_ar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of visa_type
-- ----------------------------
INSERT INTO `visa_type` VALUES ('2', 'Tourist Visa', 'تأشيرة سياحة');
INSERT INTO `visa_type` VALUES ('3', 'Residence Visa', 'تأشيرة إقامة');
INSERT INTO `visa_type` VALUES ('4', 'Visit Visa', 'تأشيرة زيارة');
INSERT INTO `visa_type` VALUES ('5', 'Family Visa', 'تأشيرة لأفراد العائلة');
INSERT INTO `visa_type` VALUES ('6', 'Employment Visa', 'تصريح وإقامة عمل');
