/*
Navicat MySQL Data Transfer

Source Server         : MysQL
Source Server Version : 50136
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50136
File Encoding         : 65001

Date: 2011-01-29 10:42:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `active_mailing`
-- ----------------------------
DROP TABLE IF EXISTS `active_mailing`;
CREATE TABLE `active_mailing` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sub_email` varchar(100) DEFAULT NULL,
  `sub_name` varchar(100) DEFAULT NULL,
  `sub_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of active_mailing
-- ----------------------------

-- ----------------------------
-- Table structure for `active_pages`
-- ----------------------------
DROP TABLE IF EXISTS `active_pages`;
CREATE TABLE `active_pages` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `page_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `page_status` int(1) NOT NULL DEFAULT '0',
  `page_modified` int(11) NOT NULL,
  `page_published` int(11) NOT NULL,
  `page_link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of active_pages
-- ----------------------------

-- ----------------------------
-- Table structure for `active_settings`
-- ----------------------------
DROP TABLE IF EXISTS `active_settings`;
CREATE TABLE `active_settings` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `setting_title` varchar(50) NOT NULL,
  `setting_name` varchar(64) NOT NULL DEFAULT '',
  `setting_type` varchar(50) NOT NULL,
  `setting_value` longtext NOT NULL,
  `setting_info` varchar(255) NOT NULL,
  `setting_published` int(11) NOT NULL,
  `setting_order` int(11) NOT NULL,
  `setting_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of active_settings
-- ----------------------------
INSERT INTO `active_settings` VALUES ('1', 'Nom du site', 'site_name', 'string', 'Active CMS', 'Nom de votre site', '0', '1', '1');
INSERT INTO `active_settings` VALUES ('2', 'Slogan', 'site_slogan', 'string', 'Company Name', 'Décrivez en quelques mots, le contenu de votre ce site.', '0', '2', '1');
INSERT INTO `active_settings` VALUES ('4', 'Keywords', 'site_keywords', 'text', '', 'info bulle', '0', '4', '1');
INSERT INTO `active_settings` VALUES ('5', 'Description', 'site_description', 'text', 'site discreption, site name voila', 'info bulle', '0', '5', '1');
INSERT INTO `active_settings` VALUES ('6', 'Email Administrateur', 'site_email', 'mail', 'achour@dom.com', 'Cette adresse est utilisé par exemple, pour les newsletters.', '0', '3', '1');
INSERT INTO `active_settings` VALUES ('7', 'Publier le site', 'site_status', 'radio', '0', '', '0', '7', '1');
INSERT INTO `active_settings` VALUES ('8', 'Seo URL', 'site_seo', 'radio', '0', '', '0', '8', '1');
INSERT INTO `active_settings` VALUES ('9', 'Template', 'site_template', 'template_path', 'default', 'tmp', '0', '6', '1');

-- ----------------------------
-- Table structure for `active_users`
-- ----------------------------
DROP TABLE IF EXISTS `active_users`;
CREATE TABLE `active_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_avatar` varchar(100) NOT NULL DEFAULT '',
  `user_registered` int(11) NOT NULL DEFAULT '0',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `user_firstname` varchar(250) NOT NULL DEFAULT '',
  `user_lastname` varchar(250) NOT NULL DEFAULT '',
  `user_level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `user_firstname` (`user_firstname`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of active_users
-- ----------------------------
INSERT INTO `active_users` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', '', '', '1', '', '', '0');
