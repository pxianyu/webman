/*
Navicat MySQL Data Transfer

Source Server         : 1
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : webman

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2023-02-01 15:01:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(120) NOT NULL COMMENT '账号',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 0禁止1正常',
  `last_login_ip` varchar(255) DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '最后登录时间',
  `nickname` varchar(255) NOT NULL COMMENT '昵称',
  `login_num` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `is_root` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是超管',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `company_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '公司id',
  `delete_flg` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除flg',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'admins1', '$2y$07$68tutssSF7bmmLW3IPUF8uhY/syXrtplmQYhKJWReTNbk0gUpJ7IO', '1', '127.0.0.1', '2023-02-01 09:26:38', '王旋', '21', '1', '2023-02-01 10:26:38', '2023-01-31 18:24:01', '0', '0');
INSERT INTO `admins` VALUES ('3', '112345', '$2y$07$JqadqC/RG8/8WP/7MSeK2OAjsgaFSSwHT3BiHzq0JoeYMpwXayQwG', '1', '', null, '456', '0', '1', null, null, '0', '0');
INSERT INTO `admins` VALUES ('4', '112345', '$2y$07$mz/KkainUzlaO748Avz8jOQUZOhEbR19GQ3sSazjMAvzzPeBEGgYS', '1', '', null, '456', '0', '1', null, null, '0', '0');
INSERT INTO `admins` VALUES ('5', '112345', '$2y$07$twcbvEtI5E9KZ2b7o86B7.WizyYCSd4r/E6jHAzt9gJD0OKJIidJy', '1', '', null, '456', '0', '1', null, null, '0', '0');
INSERT INTO `admins` VALUES ('6', '112345', '$2y$07$dxXvJ677PglfABDT0sNfbOFZcmKAeMfQvZXiEzJ7mk3fabfrlTITy', '1', '', null, '456', '0', '1', null, null, '0', '0');
INSERT INTO `admins` VALUES ('7', '112345', '$2y$07$fFo0VaYZtoCT0iGI3LlHOuaRKpOg9KlEGcQ4dB/yIWj52empix4HW', '1', '', null, '456', '0', '1', null, null, '0', '0');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `delete_flg` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('3', '你家婆', null, '2023-02-01 14:01:15', '2023-02-01 14:01:15', '0');

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`,`role_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_roles
-- ----------------------------
