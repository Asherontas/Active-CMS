-- --------------------------------------------------------------------------------
-- 
-- @version: cms.sql Jun 11, 2011 17:59 gewa
-- @package CMS Pro
-- @author wojoscripts.com.
-- @copyright 2010
-- 
-- --------------------------------------------------------------------------------
-- Host: localhost
-- Database: cms
-- Time: Jun 11, 2011-17:59
-- MySQL version: 5.1.36-community-log
-- PHP version: 5.3.0
-- --------------------------------------------------------------------------------

#
# Database: `cms`
#


-- --------------------------------------------------
# -- Table structure for table `active_mailing`
-- --------------------------------------------------
DROP TABLE IF EXISTS `active_mailing`;
CREATE TABLE `active_mailing` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sub_email` varchar(100) DEFAULT NULL,
  `sub_name` varchar(100) DEFAULT NULL,
  `sub_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `active_mailing`
-- --------------------------------------------------



-- --------------------------------------------------
# -- Table structure for table `active_pages`
-- --------------------------------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------
# Dumping data for table `active_pages`
-- --------------------------------------------------

INSERT INTO `active_pages` (`ID`, `page_content`, `page_title`, `page_status`, `page_modified`, `page_published`, `page_link`) VALUES ('1', '<p>ihdddssssssssssssssssssssssss</p>', 'PrÃ©sentation 1', '1', '1304700724', '1304697538', 'page testÃ©');
INSERT INTO `active_pages` (`ID`, `page_content`, `page_title`, `page_status`, `page_modified`, `page_published`, `page_link`) VALUES ('2', '<p>&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;&agrave;</p>\r\n<p><img src="../uploaded/activedev_logo - Copie.png" alt="" width="149" height="144" /></p>', 'Ã©Ã©Ã©Ã©', '1', '1304700778', '1304700778', 'Ã©Ã©Ã©Ã©');
INSERT INTO `active_pages` (`ID`, `page_content`, `page_title`, `page_status`, `page_modified`, `page_published`, `page_link`) VALUES ('3', '<p><img src="\\" alt="\\&quot;\\&quot;" width="\\&quot;149\\&quot;" height="\\&quot;144\\&quot;" /></p>', 'Ã©Ã©Ã©Ã©', '1', '1304701316', '1304701316', 'page testÃ©');
INSERT INTO `active_pages` (`ID`, `page_content`, `page_title`, `page_status`, `page_modified`, `page_published`, `page_link`) VALUES ('4', '<p><img src="\\" alt="\\&quot;\\\\&quot;\\\\&quot;\\&quot;" width="\\&quot;\\\\&quot;149\\\\&quot;\\&quot;" height="\\&quot;\\\\&quot;144\\\\&quot;\\&quot;" /></p>', 'Ã©Ã©Ã©Ã©', '0', '1304701320', '1304701320', 'page testÃ©');
INSERT INTO `active_pages` (`ID`, `page_content`, `page_title`, `page_status`, `page_modified`, `page_published`, `page_link`) VALUES ('5', '<p><img src="\\" alt="\\&quot;\\\\&quot;\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\&quot;" width="\\&quot;\\\\&quot;\\\\\\\\&quot;149\\\\\\\\&quot;\\\\&quot;\\&quot;" height="\\&quot;\\\\&quot;\\\\\\\\&quot;144\\\\\\\\&quot;\\\\&quot;\\&quot;" /></p>', 'Ã©Ã©Ã©Ã©', '1', '1304701512', '1304701512', 'page testÃ©');


-- --------------------------------------------------
# -- Table structure for table `active_settings`
-- --------------------------------------------------
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

-- --------------------------------------------------
# Dumping data for table `active_settings`
-- --------------------------------------------------

INSERT INTO `active_settings` (`ID`, `setting_title`, `setting_name`, `setting_type`, `setting_value`, `setting_info`, `setting_published`, `setting_order`, `setting_status`) VALUES ('1', 'Nom du site', 'site_name', 'string', 'activedev', 'Nom de votre site', '0', '1', '1');
INSERT INTO `active_settings` (`ID`, `setting_title`, `setting_name`, `setting_type`, `setting_value`, `setting_info`, `setting_published`, `setting_order`, `setting_status`) VALUES ('2', 'Slogan', 'site_slogan', 'string', 'Company Name', 'DÃ©crivez en quelques mots, le contenu de votre ce site.', '0', '2', '1');
INSERT INTO `active_settings` (`ID`, `setting_title`, `setting_name`, `setting_type`, `setting_value`, `setting_info`, `setting_published`, `setting_order`, `setting_status`) VALUES ('4', 'Keywords', 'site_keywords', 'text', '', 'info bulle', '0', '4', '1');
INSERT INTO `active_settings` (`ID`, `setting_title`, `setting_name`, `setting_type`, `setting_value`, `setting_info`, `setting_published`, `setting_order`, `setting_status`) VALUES ('5', 'Description', 'site_description', 'text', 'site discreption, site name voila', 'info bulle', '0', '5', '1');
INSERT INTO `active_settings` (`ID`, `setting_title`, `setting_name`, `setting_type`, `setting_value`, `setting_info`, `setting_published`, `setting_order`, `setting_status`) VALUES ('6', 'Email Administrateur', 'site_email', 'mail', 'contact@activedev.net', 'Cette adresse est utilisÃ©e par exemple, pour l\'envoi des mail.', '0', '3', '1');
INSERT INTO `active_settings` (`ID`, `setting_title`, `setting_name`, `setting_type`, `setting_value`, `setting_info`, `setting_published`, `setting_order`, `setting_status`) VALUES ('7', 'Publier le site', 'site_status', 'radio', '1', '', '0', '7', '1');
INSERT INTO `active_settings` (`ID`, `setting_title`, `setting_name`, `setting_type`, `setting_value`, `setting_info`, `setting_published`, `setting_order`, `setting_status`) VALUES ('8', 'Seo URL', 'site_seo', 'radio', '1', '', '0', '8', '1');
INSERT INTO `active_settings` (`ID`, `setting_title`, `setting_name`, `setting_type`, `setting_value`, `setting_info`, `setting_published`, `setting_order`, `setting_status`) VALUES ('9', 'Template', 'site_template', 'template_path', 'default', 'tmp', '0', '6', '1');


-- --------------------------------------------------
# -- Table structure for table `active_users`
-- --------------------------------------------------
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

-- --------------------------------------------------
# Dumping data for table `active_users`
-- --------------------------------------------------

INSERT INTO `active_users` (`ID`, `user_login`, `user_pass`, `user_email`, `user_avatar`, `user_registered`, `user_status`, `user_firstname`, `user_lastname`, `user_level`) VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'contact@activedev.net', '', '1304697447', '1', '', '', '0');


-- --------------------------------------------------
# -- Table structure for table `gallery`
-- --------------------------------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `folder` varchar(30) DEFAULT NULL,
  `rows` int(4) NOT NULL DEFAULT '0',
  `thumb_w` int(4) NOT NULL DEFAULT '0',
  `thumb_h` int(4) NOT NULL DEFAULT '0',
  `image_w` int(4) NOT NULL DEFAULT '0',
  `image_h` int(4) NOT NULL DEFAULT '0',
  `watermark` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `gallery`
-- --------------------------------------------------

INSERT INTO `gallery` (`id`, `title`, `folder`, `rows`, `thumb_w`, `thumb_h`, `image_w`, `image_h`, `watermark`, `created`) VALUES ('1', 'Demo Gallery', 'demo', '5', '150', '150', '600', '600', '1', '2010-12-10 12:10:10');


-- --------------------------------------------------
# -- Table structure for table `gallery_images`
-- --------------------------------------------------
DROP TABLE IF EXISTS `gallery_images`;
CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(6) NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT NULL,
  `desc` varchar(250) DEFAULT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `gallery_images`
-- --------------------------------------------------

INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('1', '1', 'Demo Flower 1', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_318C0B-0F1A63-7096C7-45B182-87004D-FDF0AE.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('2', '1', 'Demo Flower 2', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_D45A84-11B3CB-E2E617-8CE590-EB95CB-4C40CF.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('3', '1', 'Demo Flower 3', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_07264C-30F255-F8E444-C90DC8-093AE6-C83DF4.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('4', '1', 'Demo Flower 4', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_2822AC-941D16-C5ECEB-4C2787-015575-77FEE8.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('5', '1', 'Demo Flower 5', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_260FA3-1C8BE1-890AFD-8F20ED-47EB05-EBDFF7.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('6', '1', 'Demo Flower 6', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_755459-EC4B6C-58E134-2907AA-36BFEC-2604A5.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('7', '1', 'Demo Flower 7', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_7810C6-0B129B-B97C0D-902867-748A5F-854706.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('8', '1', 'Demo Flower 8', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_901142-405DB2-4B327C-6418D7-B92E53-CC1FA7.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('9', '1', 'Demo Flower 9', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_F87715-1EAFB8-D4E516-77E233-215B0A-507EBB.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('10', '1', 'Demo Flower 10', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_0D08C0-3FFF26-A5D741-BA76C6-F3C61F-D67093.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('11', '1', 'Demo Flower 11', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_807CA0-B0AB7C-FF9BB6-E4E678-B9A38A-7A81FB.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('12', '1', 'Demo Flower 12', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_7CF0A7-55F94C-0B0AE0-A4BF0C-476BF7-82CCE0.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('13', '1', 'Demo Flower 13', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_E1A872-9BDEED-5CA577-3CA6F1-E2545B-DBCF15.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('14', '1', 'Demo Flower 14', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_2D4A9D-9D3E9E-047D5A-49CC85-4B02A6-1F3BB6.jpg');
INSERT INTO `gallery_images` (`id`, `gallery_id`, `title`, `desc`, `thumb`) VALUES ('15', '1', 'Demo Flower 15', 'Fusce hendrerit vulputate rutrum. Phasellus in quam a mi fringilla ultrices.', 'IMG_886FAF-5199A3-9758FB-406A40-59CDF0-C5C3C9.jpg');


-- --------------------------------------------------
# -- Table structure for table `grafik_cms_pages`
-- --------------------------------------------------
DROP TABLE IF EXISTS `grafik_cms_pages`;
CREATE TABLE `grafik_cms_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(455) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `menu_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `show_in_menu` int(10) NOT NULL DEFAULT '1',
  `keywords` varchar(455) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(455) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `grafik_cms_pages`
-- --------------------------------------------------

INSERT INTO `grafik_cms_pages` (`id`, `content`, `title`, `menu_title`, `show_in_menu`, `keywords`, `description`, `date`, `modified`, `active`) VALUES ('23', '<p>&amp;&eacute;(&amp;&eacute;--&eacute;-&amp;&eacute;-</p>\r\n<p>&nbsp;</p>\r\n<p>&eacute;&amp;-&amp;&eacute;-&eacute;&eacute;-&eacute;&amp;-&eacute;&amp;-&amp;</p>\r\n<div style="position: absolute; left: 0px; top: 20px; width: 259px; height: 159px;">New layer...</div>', 'éééé', 'page testé', '1', 'éééé', 'page testé', '2011-04-02 19:15:46', '2011-04-02 19:15:46', '0');
INSERT INTO `grafik_cms_pages` (`id`, `content`, `title`, `menu_title`, `show_in_menu`, `keywords`, `description`, `date`, `modified`, `active`) VALUES ('24', '&lt;p&gt;&lt;strong&gt;&quot;&#039;&amp;amp;&amp;eacute;-&amp;eacute;-&amp;eacute;&amp;eacute;-&amp;eacute;&amp;egrave;&amp;egrave;&#039;&amp;amp;--&amp;eacute;-&amp;eacute;&lt;/strong&gt;&lt;/p&gt;', 'éééé', 'page testé', '1', 'éééé', 'page testé', '2011-04-02 19:19:04', '2011-04-02 19:19:04', '0');
INSERT INTO `grafik_cms_pages` (`id`, `content`, `title`, `menu_title`, `show_in_menu`, `keywords`, `description`, `date`, `modified`, `active`) VALUES ('25', '&lt;p&gt;&amp;eacute;&quot;(&amp;amp;&amp;eacute;-&amp;eacute;&amp;amp;&amp;eacute;i-&amp;eacute;&amp;amp;&amp;ccedil;-_&amp;amp;&amp;ccedil;-&amp;amp;&amp;ccedil;&amp;agrave;-&amp;eacute;&quot;&amp;ccedil;-&amp;amp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;eacute;&amp;amp;-&amp;eacute;-&amp;eacute;-&amp;eacute;-&amp;amp;&amp;eacute;-&amp;eacute;&lt;/p&gt;', 'éééé', 'page testé', '1', 'éééé', 'page testé', '2011-04-02 19:20:45', '2011-04-02 19:20:45', '0');
INSERT INTO `grafik_cms_pages` (`id`, `content`, `title`, `menu_title`, `show_in_menu`, `keywords`, `description`, `date`, `modified`, `active`) VALUES ('26', '&lt;p&gt;a&lt;/p&gt;', 'éééé', 'page testé', '1', 'page testé', 'page testé', '2011-04-02 19:21:58', '2011-04-02 19:21:58', '0');
INSERT INTO `grafik_cms_pages` (`id`, `content`, `title`, `menu_title`, `show_in_menu`, `keywords`, `description`, `date`, `modified`, `active`) VALUES ('27', '&lt;p&gt;&amp;sup2;&quot;&amp;amp;&amp;eacute;_&amp;egrave;&amp;egrave;_&amp;ccedil;--&amp;ccedil;_-&amp;eacute;u&amp;eacute;&amp;amp;iuh&amp;eacute;&quot;hgnzg&lt;/p&gt;\r\n&lt;p&gt;$zg&lt;/p&gt;\r\n&lt;p&gt;ezg&lt;/p&gt;\r\n&lt;p&gt;ez&lt;/p&gt;\r\n&lt;p&gt;tg&amp;amp;-(&amp;ccedil;&lt;/p&gt;', 'éééé', 'page testé', '1', 'éééé', 'page testé', '2011-04-02 19:24:16', '2011-04-02 19:24:16', '0');


-- --------------------------------------------------
# -- Table structure for table `grafik_cms_settings`
-- --------------------------------------------------
DROP TABLE IF EXISTS `grafik_cms_settings`;
CREATE TABLE `grafik_cms_settings` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `seo_url` int(3) NOT NULL DEFAULT '1',
  `template` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `site_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------
# Dumping data for table `grafik_cms_settings`
-- --------------------------------------------------

INSERT INTO `grafik_cms_settings` (`name`, `keywords`, `description`, `seo_url`, `template`, `site_url`) VALUES ('Omar', '', '', '0', 'templates/default', 'http://localhost/grafikcms-1.1.1-pre-final/install/');


-- --------------------------------------------------
# -- Table structure for table `grafik_cms_users`
-- --------------------------------------------------
DROP TABLE IF EXISTS `grafik_cms_users`;
CREATE TABLE `grafik_cms_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `addIP` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------
# Dumping data for table `grafik_cms_users`
-- --------------------------------------------------

INSERT INTO `grafik_cms_users` (`id`, `username`, `password`, `name`, `addIP`, `date`) VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '127.0.0.1', '2011-03-29 23:26:13');


-- --------------------------------------------------
# -- Table structure for table `layout`
-- --------------------------------------------------
DROP TABLE IF EXISTS `layout`;
CREATE TABLE `layout` (
  `module_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL,
  `place` varchar(20) NOT NULL,
  `position` int(11) NOT NULL,
  KEY `idx_layout_id` (`page_id`),
  KEY `idx_plugin_id` (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `layout`
-- --------------------------------------------------

INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('2', '6', 'left', '5');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('9', '1', 'bottom', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('10', '1', 'bottom', '10');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('2', '2', 'right', '10');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('1', '2', 'right', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('2', '3', 'left', '13');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('14', '3', 'left', '12');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('8', '6', 'right', '8');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('9', '6', 'left', '7');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('11', '6', 'bottom', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('10', '6', 'bottom', '10');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('3', '7', 'left', '7');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('5', '7', 'bottom', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('9', '7', 'left', '5');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('8', '7', 'right', '8');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('4', '7', 'left', '6');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('10', '7', 'bottom', '10');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('1', '7', 'top', '3');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('11', '7', 'top', '4');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('6', '1', 'top', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('4', '6', 'left', '6');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('11', '1', 'bottom', '8');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('1', '8', 'right', '8');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('4', '8', 'right', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('2', '8', 'right', '10');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('13', '2', 'right', '11');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('7', '6', 'top', '6');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('12', '3', 'left', '14');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('2', '6', 'left', '5');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('9', '1', 'bottom', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('10', '1', 'bottom', '10');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('2', '2', 'right', '10');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('1', '2', 'right', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('2', '3', 'left', '13');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('14', '3', 'left', '12');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('8', '6', 'right', '8');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('9', '6', 'left', '7');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('11', '6', 'bottom', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('10', '6', 'bottom', '10');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('3', '7', 'left', '7');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('5', '7', 'bottom', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('9', '7', 'left', '5');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('8', '7', 'right', '8');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('4', '7', 'left', '6');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('10', '7', 'bottom', '10');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('1', '7', 'top', '3');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('11', '7', 'top', '4');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('6', '1', 'top', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('4', '6', 'left', '6');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('11', '1', 'bottom', '8');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('1', '8', 'right', '8');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('4', '8', 'right', '9');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('2', '8', 'right', '10');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('13', '2', 'right', '11');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('7', '6', 'top', '6');
INSERT INTO `layout` (`module_id`, `page_id`, `place`, `position`) VALUES ('12', '3', 'left', '14');


-- --------------------------------------------------
# -- Table structure for table `menus`
-- --------------------------------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `content_type` varchar(20) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `home_page` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `content_id` (`active`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `menus`
-- --------------------------------------------------

INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `name`, `slug`, `content_type`, `link`, `position`, `home_page`, `active`) VALUES ('1', '0', '3', 'Contact Us', 'Contact-Us', 'page', '', '9', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `name`, `slug`, `content_type`, `link`, `position`, `home_page`, `active`) VALUES ('2', '0', '1', 'Home', 'Home', 'page', '', '1', '1', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `name`, `slug`, `content_type`, `link`, `position`, `home_page`, `active`) VALUES ('3', '0', '7', 'All Modules', 'All-Modules', 'page', '', '2', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `name`, `slug`, `content_type`, `link`, `position`, `home_page`, `active`) VALUES ('4', '0', '6', 'Three Columns', 'Three-Columns', 'page', '', '3', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `name`, `slug`, `content_type`, `link`, `position`, `home_page`, `active`) VALUES ('5', '0', '5', 'Full Width Page', 'Full-Width-Page', 'page', '', '5', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `name`, `slug`, `content_type`, `link`, `position`, `home_page`, `active`) VALUES ('6', '0', '0', 'External Link', 'External-Link', 'web', 'http://www.google.com', '7', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `name`, `slug`, `content_type`, `link`, `position`, `home_page`, `active`) VALUES ('7', '0', '8', 'Sample Submenus', 'Sample-Submenus', 'page', '', '4', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `name`, `slug`, `content_type`, `link`, `position`, `home_page`, `active`) VALUES ('8', '7', '6', 'New Submenu 1', 'New-Submenu-1', 'page', '', '1', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `name`, `slug`, `content_type`, `link`, `position`, `home_page`, `active`) VALUES ('9', '7', '7', 'New Submenu 2', 'New-Submenu-2', 'page', '', '2', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `name`, `slug`, `content_type`, `link`, `position`, `home_page`, `active`) VALUES ('10', '9', '3', 'New Submenu 3', 'New-Submenu-3', 'page', '', '1', '0', '1');
INSERT INTO `menus` (`id`, `parent_id`, `page_id`, `name`, `slug`, `content_type`, `link`, `position`, `home_page`, `active`) VALUES ('11', '0', '2', 'About Us', 'About-Us', 'page', '', '8', '0', '1');


-- --------------------------------------------------
# -- Table structure for table `mod_events`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_events`;
CREATE TABLE `mod_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `venue` varchar(150) NOT NULL,
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `time_start` time NOT NULL DEFAULT '00:00:00',
  `time_end` time NOT NULL DEFAULT '00:00:00',
  `body` text NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact_email` varchar(80) NOT NULL,
  `contact_phone` varchar(16) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_events`
-- --------------------------------------------------

INSERT INTO `mod_events` (`id`, `title`, `venue`, `date_start`, `date_end`, `time_start`, `time_end`, `body`, `contact_person`, `contact_email`, `contact_phone`, `active`) VALUES ('1', 'Free Coffee for Each Monday', 'Office Rental Showroom', '2010-12-08', '2010-12-31', '11:18:00', '21:00:00', 'Vestibulum dictum elit eu risus porta egestas. Sed quis enim neque, sed  fringilla erat. Nunc feugiat tortor eu sem consequat aliquam. Cras non  nibh at lorem auctor interdum. Donec ut lacinia massa.', 'John Doe', 'john@gmail.com', '555-555-5555', '1');
INSERT INTO `mod_events` (`id`, `title`, `venue`, `date_start`, `date_end`, `time_start`, `time_end`, `body`, `contact_person`, `contact_email`, `contact_phone`, `active`) VALUES ('2', 'Lucky Draw', 'Office Rental Showroom', '2010-12-21', '2010-12-31', '13:30:00', '11:00:00', '&lt;p&gt;&lt;img width=&quot;150&quot; height=&quot;98&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/thumbs/thumb_demo_1.jpg&quot; alt=&quot;thumb_demo_1.jpg&quot; style=&quot;padding: 5px; margin-right: 15px; float: left; border: 1px solid rgb(226, 226, 226); background: none repeat scroll 0% 0% rgb(238, 238, 238);&quot; /&gt;Pellentesque habitant morbi tristique senectus et netus et malesuada  fames ac turpis egestas. Nulla posuere nibh auctor urna tincidunt  fringilla. &lt;br /&gt;\r\nDonec imperdiet, orci quis aliquet laoreet, magna purus semper ligula,  sit amet aliquam sapien enim in orci. Pellentesque at iaculis nibh.&lt;/p&gt;', 'John Doe', 'john@gmail.com', '555-555-5555', '1');
INSERT INTO `mod_events` (`id`, `title`, `venue`, `date_start`, `date_end`, `time_start`, `time_end`, `body`, `contact_person`, `contact_email`, `contact_phone`, `active`) VALUES ('3', 'E-Commerce Seminar', 'Office Rental Showroom', '2011-01-19', '2011-01-19', '09:30:00', '13:30:00', 'Proin nec nisl est, id ornare lacus. Etiam mauris neque, scelerisque ut  ultrices vel, blandit et nisi. Nam commodo fermentum lectus vulputate  auctor. Maecenas hendrerit sapien sit amet erat mollis venenatis nec sit', 'John Doe', 'john@gmail.com', '555-555-5555', '1');
INSERT INTO `mod_events` (`id`, `title`, `venue`, `date_start`, `date_end`, `time_start`, `time_end`, `body`, `contact_person`, `contact_email`, `contact_phone`, `active`) VALUES ('4', 'E-Commerce Seminar II', 'Office Rental Showroom', '2011-01-19', '2011-01-19', '17:00:00', '19:00:00', 'Aliquam auctor molestie ipsum ultricies tincidunt. Suspendisse potenti.  Nulla volutpat urna et mi consectetur placerat iaculis lacus lacinia.  Integer a nisi id diam tempus commodo eget a tellus. In consequat augue  nec tortor bibendum vel semper metus sodales. Donec ut dui nisi, id  posuere augue.', 'John Doe', 'john@gmail.com', '555-555-5555', '1');


-- --------------------------------------------------
# -- Table structure for table `mod_newsslider`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_newsslider`;
CREATE TABLE `mod_newsslider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL,
  `body` text,
  `show_title` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `show_created` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_newsslider`
-- --------------------------------------------------

INSERT INTO `mod_newsslider` (`id`, `title`, `body`, `show_title`, `created`, `show_created`, `position`, `active`) VALUES ('1', 'Etiam non lacus', 'Morbi sodales accumsan arcu sed venenatis. Vivamus leo diam, dignissim  eu convallis in, posuere quis magna. Curabitur mollis, lectus sit amet  bibendum faucibus, nisi ligula ultricies purus', '1', '2010-10-28 04:14:11', '1', '1', '1');
INSERT INTO `mod_newsslider` (`id`, `title`, `body`, `show_title`, `created`, `show_created`, `position`, `active`) VALUES ('2', 'Cras ullamcorper', 'Etiam non lacus ac velit lobortis rutrum sed id turpis. Ut dictum, eros  eu blandit pellentesque, nisi nisl dapibus mauris, sed feugiat enim urna  sit amet nibh. Suspendisse sed tortor nisi. Nulla facilisi. In sed  risus in est cursus ornare.', '1', '2010-10-28 04:14:33', '1', '2', '1');
INSERT INTO `mod_newsslider` (`id`, `title`, `body`, `show_title`, `created`, `show_created`, `position`, `active`) VALUES ('3', 'Vivamus vitae', 'Lusce pulvinar velit sit amet ligula ornare tempus vulputate ipsum  semper. Praesent non lorem odio. Fusce sed dui massa, eu viverra erat.  Proin posuere nulla in lectus malesuada volutpat. Cras tristique blandit  tellus, eu consequat ante', '1', '2010-10-28 04:21:34', '1', '3', '1');
INSERT INTO `mod_newsslider` (`id`, `title`, `body`, `show_title`, `created`, `show_created`, `position`, `active`) VALUES ('4', 'Another News', 'Vivamus vitae augue sed lacus placerat sollicitudin quis vel arcu. Vestibulum auctor, magna sit amet pulvinar tristique, nunc felis viverra tortor, venenatis convallis leo mauris eu massa. Intege', '1', '2010-10-28 04:43:36', '1', '4', '1');


-- --------------------------------------------------
# -- Table structure for table `mod_poll_options`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_poll_options`;
CREATE TABLE `mod_poll_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `value` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_poll_options`
-- --------------------------------------------------

INSERT INTO `mod_poll_options` (`id`, `question_id`, `value`, `position`) VALUES ('5', '1', 'Very Hard', '5');
INSERT INTO `mod_poll_options` (`id`, `question_id`, `value`, `position`) VALUES ('4', '1', 'Hard', '4');
INSERT INTO `mod_poll_options` (`id`, `question_id`, `value`, `position`) VALUES ('3', '1', 'Easy', '3');
INSERT INTO `mod_poll_options` (`id`, `question_id`, `value`, `position`) VALUES ('2', '1', 'Very Easy', '2');
INSERT INTO `mod_poll_options` (`id`, `question_id`, `value`, `position`) VALUES ('1', '1', 'Piece of cake', '1');


-- --------------------------------------------------
# -- Table structure for table `mod_poll_questions`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_poll_questions`;
CREATE TABLE `mod_poll_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_poll_questions`
-- --------------------------------------------------

INSERT INTO `mod_poll_questions` (`id`, `question`, `created`, `status`) VALUES ('1', 'How do you find CMS pro! Installation?', '2010-10-13 07:42:18', '1');


-- --------------------------------------------------
# -- Table structure for table `mod_poll_votes`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_poll_votes`;
CREATE TABLE `mod_poll_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `voted_on` datetime NOT NULL,
  `ip` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_poll_votes`
-- --------------------------------------------------

INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('1', '2', '2010-10-14 14:00:55', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('2', '1', '2010-10-14 14:01:27', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('3', '1', '2010-10-14 14:02:04', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('4', '1', '2010-10-14 14:02:13', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('5', '3', '2010-10-14 14:02:16', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('6', '4', '2010-10-14 14:02:21', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('7', '3', '2010-10-14 14:02:24', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('8', '1', '2010-10-14 14:02:27', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('9', '2', '2010-10-14 14:02:31', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('10', '5', '2010-10-14 14:02:35', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('11', '1', '2010-10-14 14:02:38', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('12', '2', '2010-10-14 14:02:43', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('13', '1', '2010-10-14 14:02:46', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('14', '1', '2010-10-14 14:02:50', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('15', '1', '2010-10-14 14:05:26', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('16', '1', '2010-10-14 14:05:29', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('17', '4', '2010-10-14 14:05:33', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('18', '2', '2010-10-14 14:05:36', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('19', '1', '2010-10-14 14:05:40', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('20', '3', '2010-10-14 14:05:46', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('21', '2', '2010-10-14 14:05:49', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('22', '2', '2010-10-14 14:21:37', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('23', '1', '2010-10-14 14:21:53', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('24', '5', '2010-10-14 14:21:59', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('25', '1', '2010-10-14 14:35:27', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('26', '1', '2010-10-15 00:42:05', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('27', '3', '2010-10-15 00:49:42', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('28', '2', '2010-10-15 01:22:00', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('29', '2', '2010-10-15 01:24:51', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('30', '1', '2010-10-15 01:37:21', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('31', '1', '2010-10-15 01:38:48', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('32', '1', '2010-10-15 01:41:30', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('33', '1', '2010-10-15 01:42:21', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('34', '1', '2010-10-15 04:53:42', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('35', '3', '2010-10-15 05:09:14', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('36', '3', '2010-11-24 21:00:27', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('37', '3', '2010-11-28 00:56:07', '127.0.0.1');
INSERT INTO `mod_poll_votes` (`id`, `option_id`, `voted_on`, `ip`) VALUES ('38', '1', '2011-06-11 16:42:14', '127.0.0.1');


-- --------------------------------------------------
# -- Table structure for table `mod_slider`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_slider`;
CREATE TABLE `mod_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL DEFAULT '',
  `filename` varchar(150) NOT NULL DEFAULT '',
  `url` varchar(150) NOT NULL DEFAULT '',
  `page_id` int(6) DEFAULT '0',
  `urltype` enum('int','ext') DEFAULT NULL,
  `position` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_slider`
-- --------------------------------------------------

INSERT INTO `mod_slider` (`id`, `title`, `filename`, `url`, `page_id`, `urltype`, `position`) VALUES ('9', 'Extrime Sports4', 'sports_4.jpg', '#', '0', '', '1');
INSERT INTO `mod_slider` (`id`, `title`, `filename`, `url`, `page_id`, `urltype`, `position`) VALUES ('7', 'Extrime Sports2', 'sports_2.jpg', '#', '0', '', '2');
INSERT INTO `mod_slider` (`id`, `title`, `filename`, `url`, `page_id`, `urltype`, `position`) VALUES ('8', 'Extrime Sports3', 'sports_3.jpg', '#', '0', '', '3');
INSERT INTO `mod_slider` (`id`, `title`, `filename`, `url`, `page_id`, `urltype`, `position`) VALUES ('6', 'Extrime Sports1', 'sports_1.jpg', '#', '0', '', '4');


-- --------------------------------------------------
# -- Table structure for table `mod_slider_config`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_slider_config`;
CREATE TABLE `mod_slider_config` (
  `animation` varchar(30) NOT NULL,
  `anispeed` varchar(6) NOT NULL DEFAULT '0',
  `anitime` varchar(10) NOT NULL DEFAULT '0',
  `shownav` tinyint(1) NOT NULL DEFAULT '0',
  `shownavhide` tinyint(1) NOT NULL DEFAULT '0',
  `controllnav` tinyint(1) NOT NULL DEFAULT '0',
  `hoverpause` tinyint(1) NOT NULL DEFAULT '0',
  `showcaption` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_slider_config`
-- --------------------------------------------------

INSERT INTO `mod_slider_config` (`animation`, `anispeed`, `anitime`, `shownav`, `shownavhide`, `controllnav`, `hoverpause`, `showcaption`) VALUES ('fade', '500', '3000', '1', '1', '1', '1', '1');
INSERT INTO `mod_slider_config` (`animation`, `anispeed`, `anitime`, `shownav`, `shownavhide`, `controllnav`, `hoverpause`, `showcaption`) VALUES ('fade', '500', '3000', '1', '1', '1', '1', '1');
INSERT INTO `mod_slider_config` (`animation`, `anispeed`, `anitime`, `shownav`, `shownavhide`, `controllnav`, `hoverpause`, `showcaption`) VALUES ('fade', '500', '3000', '1', '1', '1', '1', '1');
INSERT INTO `mod_slider_config` (`animation`, `anispeed`, `anitime`, `shownav`, `shownavhide`, `controllnav`, `hoverpause`, `showcaption`) VALUES ('fade', '500', '3000', '1', '1', '1', '1', '1');


-- --------------------------------------------------
# -- Table structure for table `mod_tabs`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_tabs`;
CREATE TABLE `mod_tabs` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `body` text,
  `position` int(6) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_tabs`
-- --------------------------------------------------

INSERT INTO `mod_tabs` (`id`, `title`, `body`, `position`, `active`) VALUES ('1', 'Website Design', '&lt;img width=&quot;305&quot; height=&quot;220&quot; style=&quot;margin-left: 15px; float: right;&quot; alt=&quot;webdesign.png&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/webdesign.png&quot; /&gt;\r\n&lt;h1&gt;Website Design&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis  facilisis dapibus tincidunt. Aliquam non mauris ac urna pretium  malesuada. Mauris viverra fringilla lectus, nec congue neque adipiscing  ultrices.&lt;/p&gt;\r\n&lt;p&gt;Nulla vel magna in leo mattis congue in eget quam. Proin  dignissim nunc vitae nunc euismod sollicitudin. Nullam pretium placerat  eleifend. Aliquam erat volutpat. Nunc et massa nisl, lacinia pharetra  eros. In sit amet augue a ante tincidunt viverra.&lt;/p&gt;\r\n&lt;br class=&quot;clear&quot; /&gt;', '1', '1');
INSERT INTO `mod_tabs` (`id`, `title`, `body`, `position`, `active`) VALUES ('2', 'Content Management', '&lt;img width=&quot;305&quot; height=&quot;220&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/cms.png&quot; alt=&quot;cms.png&quot; style=&quot;margin-left: 15px; float: right;&quot; /&gt;\r\n&lt;h1&gt;Content Management&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis  facilisis dapibus tincidunt. Aliquam non mauris ac urna pretium  malesuada. Mauris viverra fringilla lectus, nec congue neque adipiscing  ultrices.&lt;/p&gt;\r\n&lt;p&gt;Nulla vel magna in leo mattis congue in eget quam. Proin  dignissim nunc vitae nunc euismod sollicitudin. Nullam pretium placerat  eleifend. Aliquam erat volutpat. Nunc et massa nisl, lacinia pharetra  eros. In sit amet augue a ante tincidunt viverra.&lt;/p&gt;&lt;br class=&quot;clear&quot; /&gt;', '2', '1');
INSERT INTO `mod_tabs` (`id`, `title`, `body`, `position`, `active`) VALUES ('3', 'E-Commerce', '&lt;img width=&quot;305&quot; height=&quot;220&quot; style=&quot;margin-left: 15px; float: right;&quot; alt=&quot;ecommerce.png&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/ecommerce.png&quot; /&gt;\r\n&lt;h1&gt;E-Commerce&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis  facilisis dapibus tincidunt. Aliquam non mauris ac urna pretium  malesuada. Mauris viverra fringilla lectus, nec congue neque adipiscing  ultrices.&lt;/p&gt;\r\n&lt;p&gt;Nulla vel magna in leo mattis congue in eget quam. Proin  dignissim nunc vitae nunc euismod sollicitudin. Nullam pretium placerat  eleifend. Aliquam erat volutpat. Nunc et massa nisl, lacinia pharetra  eros. In sit amet augue a ante tincidunt viverra.&lt;/p&gt;\r\n&lt;br class=&quot;clear&quot; /&gt;', '3', '1');
INSERT INTO `mod_tabs` (`id`, `title`, `body`, `position`, `active`) VALUES ('4', 'Search Engines', '&lt;img width=&quot;305&quot; height=&quot;220&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/seo.png&quot; alt=&quot;seo.png&quot; style=&quot;margin-left: 15px; float: right;&quot; /&gt;\r\n&lt;h1&gt;Search Engines&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis  facilisis dapibus tincidunt. Aliquam non mauris ac urna pretium  malesuada. Mauris viverra fringilla lectus, nec congue neque adipiscing  ultrices.&lt;/p&gt;\r\n&lt;p&gt;Nulla vel magna in leo mattis congue in eget quam. Proin  dignissim nunc vitae nunc euismod sollicitudin. Nullam pretium placerat  eleifend. Aliquam erat volutpat. Nunc et massa nisl, lacinia pharetra  eros. In sit amet augue a ante tincidunt viverra.&lt;/p&gt;<br />\r\n&lt;p&gt;&lt;a href=&quot;#&quot; class=&quot;button&quot;&gt;Read More&lt;/a&gt;&lt;/p&gt;&lt;br class=&quot;clear&quot; /&gt;', '4', '1');


-- --------------------------------------------------
# -- Table structure for table `mod_twitter`
-- --------------------------------------------------
DROP TABLE IF EXISTS `mod_twitter`;
CREATE TABLE `mod_twitter` (
  `username` varchar(150) DEFAULT NULL,
  `counter` int(1) NOT NULL DEFAULT '5',
  `speed` varchar(6) NOT NULL,
  `timeout` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `mod_twitter`
-- --------------------------------------------------

INSERT INTO `mod_twitter` (`username`, `counter`, `speed`, `timeout`) VALUES ('cms_pro', '5', '300', '10000');
INSERT INTO `mod_twitter` (`username`, `counter`, `speed`, `timeout`) VALUES ('cms_pro', '5', '300', '10000');


-- --------------------------------------------------
# -- Table structure for table `modules`
-- --------------------------------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `body` text,
  `show_title` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL,
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `info` text,
  `modalias` varchar(50) NOT NULL,
  `hasconfig` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `modules`
-- --------------------------------------------------

INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('1', 'Testimonials', '&lt;p class=&quot;testimonial&quot;&gt;&lt;em&gt;Etiam non lacus ac velit lobortis rutrum sed id turpis. Ut dictum, eros eu blandit pellentesque, nisi nisl dapibus mauris, sed feugiat enim urna sit amet nibh. Suspendisse sed tortor nisi.&lt;/em&gt;&lt;/p&gt;\r\n&lt;em&gt;John Smith&lt;/em&gt;, &lt;strong&gt;www.somesite.com&lt;/strong&gt;', '1', '1', '0', '', '', '0', '2010-07-20 14:10:15', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('2', 'News Slider', '', '1', '2', '1', 'Displays latest news items', 'newsslider', '1', '2010-07-20 14:10:15', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('8', 'More Pages', '&lt;ul class=&quot;lists&quot;&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Home&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Page Types&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Templates&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;About Us&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Services &lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Projects&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Blog&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Contact Us&lt;/a&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', '1', '0', '0', '', '', '0', '2010-07-22 11:38:51', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('3', 'An unordered list', 'This modul contains a dummy list of items\r\n&lt;ul&gt;\r\n    &lt;li&gt;List item 1&lt;/li&gt;\r\n    &lt;li&gt;List item 2&lt;/li&gt;\r\n    &lt;li&gt;List item 3&lt;/li&gt;\r\n    &lt;li&gt;List item 4&lt;/li&gt;\r\n&lt;/ul&gt;', '1', '1', '0', '', '', '0', '2010-07-20 14:10:15', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('4', 'Info Point', '&lt;ul id=&quot;infopoint-list&quot;&gt;\r\n    &lt;li&gt;&lt;img alt=&quot;&quot; src=&quot;http://localhost/cms_pro/uploads/icons/iphone.png&quot; /&gt; Cum sociis natoque penatibus et magnis dis parturient montes&lt;/li&gt;\r\n    &lt;li&gt;&lt;img alt=&quot;&quot; src=&quot;http://localhost/cms_pro/uploads/icons/green.png&quot; /&gt; Curabitur mollis, lectus sit amet bibendum faucibus ligula&lt;/li&gt;\r\n    &lt;li&gt;&lt;img alt=&quot;&quot; src=&quot;http://localhost/cms_pro/uploads/icons/installer_box.png&quot; /&gt; Morbi sodales accumsan arcu sed venenatis. Vivamus leo diam&lt;/li&gt;\r\n    &lt;li&gt;&lt;img alt=&quot;&quot; src=&quot;http://localhost/cms_pro/uploads/icons/headphone.png&quot; /&gt; Cras ullamcorper suscipit  justo, at mattis odio auctor quis alteno&lt;/li&gt;\r\n    &lt;li&gt;&lt;img alt=&quot;&quot; src=&quot;http://localhost/cms_pro/uploads/icons/coins.png&quot; /&gt; Vestibulum  auctor, magna sit amet pulvinar tristique, nunc felis viverra&lt;/li&gt;\r\n    &lt;li&gt;&lt;img alt=&quot;&quot; src=&quot;http://localhost/cms_pro/uploads/icons/color_wheel.png&quot; /&gt; Integer aliquet libero sed lorem consequat ut tempus faucibus&lt;/li&gt;\r\n&lt;/ul&gt;', '1', '1', '0', '', '', '0', '2010-07-20 14:10:15', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('5', 'Our Contact Numbers', '&lt;strong&gt;Office&lt;/strong&gt; +1-416-123456789&lt;br /&gt;\r\n&lt;strong&gt;helpdesk&lt;/strong&gt; +1-416-123456789&lt;br /&gt;', '1', '2', '0', '', '', '0', '2010-07-20 14:10:15', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('6', 'jQuery Slider', '', '0', '3', '1', 'jQuery Slider is one great way to display portfolio pieces, eCommerce product images, or even as an image gallery.', 'jqueryslider', '1', '2010-07-20 14:10:15', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('11', 'Contact Information', '&lt;ul&gt;\r\n    &lt;li&gt;&lt;b&gt;E-mail:&lt;/b&gt; &lt;a href=&quot;mailto:info@mywebsite.com&quot;&gt;info@mywebsite.com&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;b&gt;Telephone:&lt;/b&gt; 0080 000 000&lt;/li&gt;\r\n    &lt;li&gt;&lt;b&gt;Fax:&lt;/b&gt; 0080 000 000&lt;/li&gt;\r\n    &lt;li&gt;&lt;b&gt;Address:&lt;/b&gt;     1600 Amphitheatre Parkway                 Toronto, ON M2K 1Z7&lt;/li&gt;\r\n&lt;/ul&gt;', '1', '0', '0', '', '', '0', '2010-07-22 11:44:15', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('9', 'Even More Pages', '&lt;ul class=&quot;lists&quot;&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Updates&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;News&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Press Releases&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;New Offers&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Our Staff &lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Policy&lt;/a&gt;&lt;/li&gt;\r\n    &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Events&lt;/a&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', '1', '0', '0', '', '', '0', '2010-07-22 11:39:22', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('10', 'Latest Twitts', '', '1', '4', '1', 'Shows your latest twitts', 'twitts', '1', '2010-07-22 11:42:08', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('13', 'Ajax Poll', '', '1', '5', '1', 'jQuery Ajax poll module.', 'poll', '1', '2010-10-25 14:12:20', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('7', 'jQuery Tabs', '', '0', '7', '1', 'jQuery Dynamic Tabs', 'jtabs', '1', '2010-12-20 12:12:20', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('12', 'Event Manager', '', '1', '8', '1', 'Easily publish and manage your company events.', 'events', '1', '2010-12-28 10:12:14', '1');
INSERT INTO `modules` (`id`, `title`, `body`, `show_title`, `position`, `system`, `info`, `modalias`, `hasconfig`, `created`, `active`) VALUES ('14', 'Vertical Navigation', '', '1', '9', '1', 'Vertical flyout menu module', 'vmenu', '0', '2010-12-27 08:12:14', '1');


-- --------------------------------------------------
# -- Table structure for table `pages`
-- --------------------------------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `contact_form` tinyint(1) NOT NULL DEFAULT '0',
  `gallery_id` int(4) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `pages`
-- --------------------------------------------------

INSERT INTO `pages` (`id`, `title`, `slug`, `contact_form`, `gallery_id`, `position`, `keywords`, `description`, `created`, `active`) VALUES ('1', 'Home', 'Home', '0', '0', '1', 'wojoliteCMS, WoJo Lite CMS, Content Menagement System, Lightweight CMS', 'WojoLite CMS is a web content management system made for the peoples who don&#39;t have much technical knowledge of HTML or PHP but know how to use a simple notepad with computer keyboard.', '2010-07-22 20:11:55', '1');
INSERT INTO `pages` (`id`, `title`, `slug`, `contact_form`, `gallery_id`, `position`, `keywords`, `description`, `created`, `active`) VALUES ('2', 'What is CMS Pro!', 'What-is-CMS-Pro', '0', '0', '2', 'CMS Pro!, Content Management System, Lightweight CMS', 'CMS Pro! is a php based database dependent CMS which require one database and obviously php language support on your web hosting server.', '2010-07-22 20:11:55', '1');
INSERT INTO `pages` (`id`, `title`, `slug`, `contact_form`, `gallery_id`, `position`, `keywords`, `description`, `created`, `active`) VALUES ('3', 'Contact Info', 'Contact-Info', '1', '0', '3', '', '', '2010-07-22 20:11:55', '1');
INSERT INTO `pages` (`id`, `title`, `slug`, `contact_form`, `gallery_id`, `position`, `keywords`, `description`, `created`, `active`) VALUES ('5', 'Demo Gallery', 'Demo-Gallery', '0', '1', '0', '', '', '2010-07-22 20:11:55', '1');
INSERT INTO `pages` (`id`, `title`, `slug`, `contact_form`, `gallery_id`, `position`, `keywords`, `description`, `created`, `active`) VALUES ('6', 'Three Column Page', 'Tree-Column-Page', '0', '0', '0', '', '', '2010-07-22 20:26:17', '1');
INSERT INTO `pages` (`id`, `title`, `slug`, `contact_form`, `gallery_id`, `position`, `keywords`, `description`, `created`, `active`) VALUES ('7', 'All Modules', 'All-Modules', '0', '0', '0', '', '', '2010-07-22 20:40:19', '1');
INSERT INTO `pages` (`id`, `title`, `slug`, `contact_form`, `gallery_id`, `position`, `keywords`, `description`, `created`, `active`) VALUES ('8', 'More Pages', 'More-Pages', '0', '0', '0', '', '', '2010-08-09 22:06:58', '1');


-- --------------------------------------------------
# -- Table structure for table `posts`
-- --------------------------------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `show_title` tinyint(1) NOT NULL DEFAULT '1',
  `body` text NOT NULL,
  `position` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `posts`
-- --------------------------------------------------

INSERT INTO `posts` (`id`, `page_id`, `title`, `show_title`, `body`, `position`, `active`) VALUES ('1', '1', 'Welcome to CMS Pro!', '1', 'Welcome to CMS Pro!. The Lightweight CMS.&lt;br /&gt;\r\n&lt;br /&gt;\r\nCongratulation !! your installation of Cms Pro!&amp;nbsp; was successful.&lt;br /&gt;\r\n&lt;br /&gt;\r\nThis is the home page of your default installation of CMS Pro!.&lt;br /&gt;\r\nYou can edit or add content to your  Web site  from the administration panel of CMS Pro! by clicking the link below.&lt;br /&gt;\r\n&lt;a href=&quot;admin/index.php&quot; class=&quot;but&quot;&gt;&lt;span&gt;Administration panel&lt;/span&gt;&lt;/a&gt; &lt;hr /&gt;\r\n&lt;div class=&quot;col-31&quot;&gt;\r\n&lt;h3&gt;Who we are?&lt;/h3&gt;\r\n&lt;img width=&quot;290&quot; height=&quot;190&quot; alt=&quot;Who Are We?&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/demo_1.jpg&quot; class=&quot;image&quot; style=&quot;border: 1px solid rgb(226, 226, 226); background: none repeat scroll 0% 0% rgb(238, 238, 238); margin: 1px; padding: 5px; -moz-border-radius: 5px 5px 5px 5px;&quot; /&gt;\r\n&lt;p&gt;Nulla sollicitudin nulla mauris. Donec congue facilisis lorem, ornare tincidunt orci ullamcorper nec.&lt;/p&gt;\r\n&lt;p&gt;Nam pellentesque auctor turpis nec &lt;strong&gt;dapibus&lt;/strong&gt;. Vivamus interdum dignissim tincidunt. Vestibulum dapibus laoreet arcu, et pharetra augue ultricies quis.&lt;/p&gt;\r\n&lt;p&gt;Sed luctus condimentum mollis. Etiam lacus turpis, hendrerit vitae &lt;em&gt;feugiat&lt;/em&gt; sit amet, cursus ac quam. Curabitur metus mi.&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;col-32&quot;&gt;\r\n&lt;h3&gt;What we do?&lt;/h3&gt;\r\n&lt;img width=&quot;290&quot; height=&quot;190&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/demo_2.jpg&quot; alt=&quot;What we do?&quot; style=&quot;border: 1px solid rgb(226, 226, 226); background: none repeat scroll 0% 0% rgb(238, 238, 238); margin: 1px; padding: 5px; -moz-border-radius: 5px 5px 5px 5px;&quot; /&gt;\r\n&lt;p&gt;Nulla sollicitudin nulla mauris. Donec congue facilisis lorem, ornare tincidunt orci ullamcorper nec.&lt;/p&gt;\r\n&lt;p&gt;Nam pellentesque auctor turpis nec &lt;strong&gt;dapibus&lt;/strong&gt;. Vivamus interdum dignissim tincidunt. Vestibulum dapibus laoreet arcu, et pharetra augue ultricies quis.&lt;/p&gt;\r\n&lt;p&gt;Sed luctus condimentum mollis. Etiam lacus turpis, hendrerit vitae &lt;em&gt;feugiat&lt;/em&gt; sit amet, cursus ac quam. Curabitur metus mi.&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;col-33&quot;&gt;\r\n&lt;h3&gt;What is this?&lt;/h3&gt;\r\n&lt;img width=&quot;290&quot; height=&quot;190&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/demo_3.jpg&quot; alt=&quot;What Is This?&quot; style=&quot;border: 1px solid rgb(226, 226, 226); background: none repeat scroll 0% 0% rgb(238, 238, 238); margin: 1px; padding: 5px; -moz-border-radius: 5px 5px 5px 5px;&quot; /&gt;\r\n&lt;p&gt;Nulla sollicitudin nulla mauris. Donec congue facilisis lorem, ornare tincidunt orci ullamcorper nec.&lt;/p&gt;\r\n&lt;p&gt;Nam pellentesque auctor turpis nec &lt;strong&gt;dapibus&lt;/strong&gt;. Vivamus interdum dignissim tincidunt. Vestibulum dapibus laoreet arcu, et pharetra augue ultricies quis.&lt;/p&gt;\r\n&lt;p&gt;Sed luctus condimentum mollis. Etiam lacus turpis, hendrerit vitae &lt;em&gt;feugiat&lt;/em&gt; sit amet, cursus ac quam. Curabitur metus mi.&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;clear&quot;&gt;&amp;nbsp;&lt;/div&gt;', '1', '1');
INSERT INTO `posts` (`id`, `page_id`, `title`, `show_title`, `body`, `position`, `active`) VALUES ('2', '2', 'What is CMS Pro!', '1', '&lt;div style=&quot;text-align: center;&quot;&gt;&lt;img width=&quot;585&quot; height=&quot;230&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/sampleimage_4.jpg&quot; alt=&quot;sampleimage_4.jpg&quot; class=&quot;image&quot; /&gt;&lt;/div&gt;\r\n&lt;p&gt;Morbi sodales accumsan arcu sed venenatis. Vivamus leo diam,  dignissim eu convallis in, posuere quis magna. Curabitur mollis, lectus  sit amet bibendum faucibus, nisi ligula ultricies purus, in malesuada  arcu sem ut mauris. Proin lobortis rutrum ultrices.&lt;/p&gt;\r\n&lt;h3&gt;Company Background&lt;/h3&gt;\r\n&lt;p&gt;Etiam non lacus ac velit lobortis rutrum sed id turpis. Ut  dictum, eros eu blandit pellentesque, nisi nisl dapibus mauris, sed  feugiat enim urna sit amet nibh. Suspendisse sed tortor nisi. Nulla  facilisi. In sed risus in est cursus ornare. Fusce tempor hendrerit  commodo. Cum sociis natoque penatibus et magnis dis parturient montes,  nascetur ridiculus mus. Nam nec odio nulla. Cras ullamcorper suscipit  justo, at mattis odio auctor quis. In hac habitasse platea dictumst.  Morbi ut turpis vitae risus egestas feugiat quis eget quam. Vivamus  vitae augue sed lacus placerat sollicitudin quis vel arcu. Vestibulum  auctor, magna sit amet pulvinar tristique, nunc felis viverra tortor,  venenatis convallis leo mauris eu massa. Integer aliquet libero sed  lorem consequat ut tempus libero viverra. Donec ut ipsum vitae leo  volutpat commodo.&lt;/p&gt;\r\n&lt;h3&gt;John Smith, CEO&lt;/h3&gt;\r\n&lt;a rel=&quot;prettyPhoto&quot; href=&quot;http://localhost/cms_pro/uploads/images/gallery/mygallery/MIL05006.JPG&quot;&gt;&lt;img width=&quot;116&quot; height=&quot;150&quot; class=&quot;/&quot; alt=&quot;Sample Image&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/blank_profile_image.jpg&quot; style=&quot;padding: 5px; margin-right: 15px; float: left; border: 1px solid rgb(226, 226, 226); background: none repeat scroll 0% 0% rgb(238, 238, 238);&quot; /&gt;&lt;/a&gt;\r\n&lt;p&gt;Etiam non lacus ac velit lobortis rutrum sed id turpis. Ut dictum, eros eu blandit pellentesque, nisi nisl dapibus mauris, sed feugiat enim urna sit amet nibh. Suspendisse sed tortor nisi. Nulla facilisi. In sed risus in est cursus ornare. Fusce tempor hendrerit commodo.&lt;/p&gt;\r\n&lt;p&gt;Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam nec odio nulla. Cras ullamcorper suscipit justo, at mattis odio auctor quis.&lt;/p&gt;\r\n&lt;p&gt;In hac habitasse platea dictumst.ivamus leo diam,  dignissim eu convallis in, posuere quis magna. Curabitur mollis, lectus  sit amet bibendum faucibus, nisi ligula ultricies purus&lt;/p&gt;', '1', '1');
INSERT INTO `posts` (`id`, `page_id`, `title`, `show_title`, `body`, `position`, `active`) VALUES ('3', '3', 'Contact Information', '1', '&lt;h3&gt;Where to Find Us&lt;/h3&gt;\r\n&lt;img width=&quot;150&quot; height=&quot;150&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/thumbs/thumb_contact-us.jpg&quot; alt=&quot;thumb_contact-us.jpg&quot; style=&quot;padding: 5px; margin-right: 15px; float: left; border: 1px solid rgb(226, 226, 226); background: none repeat scroll 0% 0% rgb(238, 238, 238);&quot; /&gt;Etiam non lacus ac velit lobortis rutrum sed id turpis. Ut dictum, eros  eu blandit pellentesque, nisi nisl dapibus mauris, sed feugiat enim urna  sit amet nibh. &lt;br /&gt;\r\n&lt;br /&gt;\r\nSuspendisse sed tortor nisi. Nulla facilisi. In sed  risus in est cursus ornare. Fusce tempor hendrerit commodo. Cum sociis  natoque penatibus et magnis dis parturient montes, nascetur ridiculus  mus. &lt;br /&gt;\r\n&lt;br /&gt;\r\nNam nec odio nulla. Cras ullamcorper suscipit justo, at mattis odio  auctor quis. In hac habitasse platea dictumst. Morbi ut turpis vitae  risus egestas feugiat quis eget quam. Vivamus vitae augue sed lacus  placerat sollicitudin quis vel arcu. &lt;br /&gt;\r\n&lt;br /&gt;\r\nVestibulum auctor, magna sit amet  pulvinar tristique, nunc felis viverra tortor, venenatis convallis leo  mauris eu massa. Integer aliquet libero sed lorem consequat ut tempus  libero viverra. Donec ut ipsum vitae leo volutpat commodo.', '1', '1');
INSERT INTO `posts` (`id`, `page_id`, `title`, `show_title`, `body`, `position`, `active`) VALUES ('4', '5', 'Gallery Demo', '1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut  tempor eros. Proin bibendum, lacus vitae venenatis convallis, libero  ipsum imperdiet sem, ac consequat massa risus vel sem. Nunc nec ante non  arcu mattis viverra. Morbi accumsan, augue ac dignissim tempus, lacus  libero molestie est, in eleifend lorem purus eu mauris. Nulla at metus a  enim faucibus placerat vitae a justo. Maecenas rhoncus ante libero.&lt;/p&gt;', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `title`, `show_title`, `body`, `position`, `active`) VALUES ('5', '6', 'Three Column Page', '1', '&lt;p&gt;&lt;img width=&quot;150&quot; height=&quot;58&quot; style=&quot;padding: 5px; margin-right: 15px; float: left; border: 1px solid rgb(226, 226, 226); background: none repeat scroll 0% 0% rgb(238, 238, 238);&quot; alt=&quot;thumb_sampleimage_4.jpg&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/thumbs/thumb_sampleimage_4.jpg&quot; /&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed  ut tempor eros. Proin bibendum, lacus vitae venenatis convallis, libero  ipsum imperdiet sem, ac consequat massa risus vel sem. Nunc nec ante non  arcu mattis viverra. Morbi accumsan, augue ac dignissim tempus, lacus  libero molestie est, in eleifend lorem purus eu mauris. Nulla at metus a  enim faucibus placerat vitae a justo. Maecenas rhoncus ante libero.  Phasellus vitae porta nunc.&lt;/p&gt;', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `title`, `show_title`, `body`, `position`, `active`) VALUES ('6', '7', 'All Module Positions', '1', '&lt;p&gt;&lt;img width=&quot;120&quot; height=&quot;150&quot; style=&quot;padding: 5px; margin-left: 15px; float: right; border: 1px solid rgb(226, 226, 226); background: none repeat scroll 0% 0% rgb(238, 238, 238);&quot; alt=&quot;thumb_TAH02017.JPG&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/thumbs/thumb_TAH02017.JPG&quot; /&gt;Aliquam vitae metus non elit laoreet varius. Pellentesque et enim lorem.  Suspendisse potenti. Nam ut iaculis lectus. Ut et leo odio. In euismod  lobortis nisi, eu placerat nisi laoreet a.&lt;/p&gt;\r\n&lt;p&gt;Cras lobortis lobortis elit,  at pellentesque erat vulputate ac. Phasellus in sapien non elit semper  pellentesque ut a turpis. Quisque mollis auctor feugiat. Fusce a nisi  diam, eu dapibus nibh.Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere  cubilia Curae; Etiam a justo libero, aliquam auctor felis. Nulla a odio  ut magna ultrices vestibulum.&lt;/p&gt;\r\n&lt;p&gt;Integer urna magna, euismod sed pharetra  eget, ornare in dolor. Etiam bibendum mi ut nisi facilisis lobortis.  Phasellus turpis orci, interdum adipiscing aliquam ut, convallis  volutpat tellus. Nunc massa nunc, dapibus eget scelerisque ac, eleifend  eget ligula. Maecenas accumsan tortor in quam adipiscing hendrerit.  Donec ac risus nec est molestie malesuada ac id risus. In hac habitasse  platea dictumst. In quam dui, blandit id interdum id, facilisis a leo.&lt;/p&gt;\r\nNullam fringilla quam pharetra enim interdum accumsan. Phasellus nec  euismod quam. Donec tempor accumsan posuere. Phasellus ac metus orci, ac  venenatis magna. Suspendisse sit amet odio at enim ultricies  pellentesque eget ac risus. Vestibulum eleifend odio ut tellus faucibus  malesuada feugiat nisi rhoncus. Proin nec sem ut augue placerat blandit  ut ut orci. Cras aliquet venenatis enim, quis rutrum urna sollicitudin  vel.\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;hr /&gt;\r\n&lt;img width=&quot;150&quot; height=&quot;58&quot; alt=&quot;thumb_sampleimage_4.jpg&quot; src=&quot;http://localhost/cms_pro/uploads/images/pages/thumbs/thumb_sampleimage_4.jpg&quot; style=&quot;padding: 5px; margin-right: 15px; float: left; border: 1px solid rgb(226, 226, 226); background: none repeat scroll 0% 0% rgb(238, 238, 238);&quot; /&gt;Aliquam vitae metus non elit laoreet varius. Pellentesque et enim lorem.  Suspendisse potenti. Nam ut iaculis lectus. Ut et leo odio. In euismod  lobortis nisi, eu placerat nisi laoreet a. Cras lobortis lobortis elit,  at pellentesque erat vulputate ac. Phasellus in sapien non elit semper  pellentesque ut a turpis. Quisque mollis auctor feugiat. Fusce a nisi  diam, eu dapibus nibh.', '0', '1');
INSERT INTO `posts` (`id`, `page_id`, `title`, `show_title`, `body`, `position`, `active`) VALUES ('9', '8', 'More Sample Pages', '1', '&lt;p&gt;Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere  cubilia Curae; Etiam a justo libero, aliquam auctor felis. Nulla a odio  ut magna ultrices vestibulum. Integer urna magna, euismod sed pharetra  eget, ornare in dolor. Etiam bibendum mi ut nisi facilisis lobortis.  Phasellus turpis orci, interdum adipiscing aliquam ut, convallis  volutpat tellus.&lt;/p&gt;\r\n&lt;div style=&quot;text-align: center;&quot;&gt;&lt;object width=&quot;640&quot; height=&quot;505&quot;&gt;\r\n&lt;param name=&quot;movie&quot; value=&quot;http://www.youtube.com/v/BYm_Mn7Hxag?fs=1&amp;amp;hl=en_US&amp;amp;color1=0x006699&amp;amp;color2=0x54abd6&quot; /&gt;\r\n&lt;param name=&quot;allowFullScreen&quot; value=&quot;true&quot; /&gt;\r\n&lt;param name=&quot;allowscriptaccess&quot; value=&quot;always&quot; /&gt;&lt;embed width=&quot;640&quot; height=&quot;505&quot; src=&quot;http://www.youtube.com/v/BYm_Mn7Hxag?fs=1&amp;amp;hl=en_US&amp;amp;color1=0x006699&amp;amp;color2=0x54abd6&quot; type=&quot;application/x-shockwave-flash&quot; allowscriptaccess=&quot;always&quot; allowfullscreen=&quot;true&quot;&gt;&lt;/embed&gt;&lt;/object&gt;&lt;/div&gt;\r\n&lt;hr /&gt;\r\n&lt;p&gt;Pellentesque et enim lorem.  Suspendisse potenti. Nam ut iaculis lectus. Ut et leo odio. In euismod  lobortis nisi, eu placerat nisi laoreet a. Cras lobortis lobortis elit,  at pellentesque erat vulputate ac. Phasellus in sapien non elit semper  pellentesque ut a turpis. Quisque mollis auctor feugiat. Fusce a nisi  diam, eu dapibus nibh.&lt;/p&gt;', '0', '1');


-- --------------------------------------------------
# -- Table structure for table `settings`
-- --------------------------------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `site_name` varchar(100) NOT NULL DEFAULT '',
  `company` varchar(100) NOT NULL DEFAULT '',
  `site_url` varchar(150) NOT NULL DEFAULT '',
  `site_email` varchar(50) NOT NULL DEFAULT '',
  `theme` varchar(32) NOT NULL DEFAULT '',
  `seo` tinyint(1) NOT NULL DEFAULT '0',
  `backup` varchar(64) NOT NULL DEFAULT '',
  `thumb_w` varchar(5) NOT NULL DEFAULT '',
  `thumb_h` varchar(5) NOT NULL DEFAULT '',
  `short_date` varchar(50) NOT NULL,
  `long_date` varchar(50) NOT NULL,
  `offline` tinyint(1) NOT NULL DEFAULT '0',
  `logo` varchar(100) DEFAULT NULL,
  `metakeys` text,
  `metadesc` text,
  `version` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `settings`
-- --------------------------------------------------

INSERT INTO `settings` (`site_name`, `company`, `site_url`, `site_email`, `theme`, `seo`, `backup`, `thumb_w`, `thumb_h`, `short_date`, `long_date`, `offline`, `logo`, `metakeys`, `metadesc`, `version`) VALUES ('Your Site Name', 'Your Company Name', 'http://localhost/cms_pro', 'site@mail.com', 'grey', '1', '11-Jun-2011_16-47-30.sql', '150', '150', '%d %b %Y', '%a %d, %M %Y', '0', 'logo.png', 'metakeys, separated,by coma', 'Your website description goes here', '1.1.7');
INSERT INTO `settings` (`site_name`, `company`, `site_url`, `site_email`, `theme`, `seo`, `backup`, `thumb_w`, `thumb_h`, `short_date`, `long_date`, `offline`, `logo`, `metakeys`, `metadesc`, `version`) VALUES ('Your Site Name', 'Your Company Name', 'http://localhost/cms_pro', 'site@mail.com', 'grey', '1', '11-Jun-2011_16-47-30.sql', '150', '150', '%d %b %Y', '%a %d, %M %Y', '0', 'logo.png', 'metakeys, separated,by coma', 'Your website description goes here', '1.1.7');


-- --------------------------------------------------
# -- Table structure for table `stats`
-- --------------------------------------------------
DROP TABLE IF EXISTS `stats`;
CREATE TABLE `stats` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `day` date NOT NULL DEFAULT '0000-00-00',
  `pageviews` int(10) NOT NULL DEFAULT '0',
  `uniquevisitors` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `stats`
-- --------------------------------------------------

INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('1', '2010-08-12', '7', '2');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('2', '2010-08-14', '5', '2');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('3', '2010-08-26', '5', '3');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('4', '2010-08-30', '1', '1');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('5', '2010-09-04', '185', '3');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('6', '2010-09-15', '1', '1');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('7', '2010-09-16', '2', '1');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('8', '2010-09-17', '11', '2');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('9', '2010-09-19', '13', '2');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('10', '2010-10-18', '2', '1');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('11', '2010-10-19', '14', '2');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('12', '2010-10-20', '291', '10');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('13', '2010-10-21', '156', '4');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('14', '2010-10-22', '191', '9');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('15', '2010-10-23', '95', '4');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('16', '2010-10-25', '17', '2');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('17', '2010-10-27', '21', '2');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('18', '2010-10-28', '306', '12');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('19', '2010-10-29', '4', '2');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('20', '2010-11-04', '11', '2');
INSERT INTO `stats` (`id`, `day`, `pageviews`, `uniquevisitors`) VALUES ('21', '2011-06-11', '13', '3');


-- --------------------------------------------------
# -- Table structure for table `users`
-- --------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(32) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `userlevel` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------
# Dumping data for table `users`
-- --------------------------------------------------

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fname`, `lname`, `userlevel`, `active`) VALUES ('1', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'site@mail.com', '', '', '1', '1');


