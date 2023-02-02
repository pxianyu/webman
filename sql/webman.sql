/*
Navicat MySQL Data Transfer

Source Server         : 1
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : webman

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2023-02-02 10:51:16
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
-- admins1 admins123
INSERT INTO `admins` VALUES ('1', 'admins1', '$2y$07$68tutssSF7bmmLW3IPUF8uhY/syXrtplmQYhKJWReTNbk0gUpJ7IO', '1', '127.0.0.1', '2023-02-02 09:46:18', '王旋', '22', '1', '2023-02-02 09:46:18', '2023-01-31 18:24:01', '0', '0');
INSERT INTO `admins` VALUES ('3', '112345', '$2y$07$JqadqC/RG8/8WP/7MSeK2OAjsgaFSSwHT3BiHzq0JoeYMpwXayQwG', '1', '', null, '456', '0', '1', null, null, '0', '0');
INSERT INTO `admins` VALUES ('4', '112345', '$2y$07$mz/KkainUzlaO748Avz8jOQUZOhEbR19GQ3sSazjMAvzzPeBEGgYS', '1', '', null, '456', '0', '1', null, null, '0', '0');
INSERT INTO `admins` VALUES ('5', '112345', '$2y$07$twcbvEtI5E9KZ2b7o86B7.WizyYCSd4r/E6jHAzt9gJD0OKJIidJy', '1', '', null, '456', '0', '1', null, null, '0', '0');
INSERT INTO `admins` VALUES ('6', '112345', '$2y$07$dxXvJ677PglfABDT0sNfbOFZcmKAeMfQvZXiEzJ7mk3fabfrlTITy', '1', '', null, '456', '0', '1', null, null, '0', '0');
INSERT INTO `admins` VALUES ('7', '112345', '$2y$07$fFo0VaYZtoCT0iGI3LlHOuaRKpOg9KlEGcQ4dB/yIWj52empix4HW', '1', '', null, '456', '0', '1', null, null, '0', '0');

-- ----------------------------
-- Table structure for admin_logs
-- ----------------------------
DROP TABLE IF EXISTS `admin_logs`;
CREATE TABLE `admin_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL COMMENT '管理员ID',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '请求地址',
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '请求方式',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '请求参数',
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'IP地址',
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户代理',
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '日志描述',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '日志类型 1:操作日志 2:登录日志',
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '响应时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `admin_logs_admin_id_index` (`admin_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of admin_logs
-- ----------------------------

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `banner_group_id` bigint(20) unsigned NOT NULL COMMENT '分组序号',
  `pic` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片地址',
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '跳转链接',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '副标题/描述',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `banner_group_id` (`banner_group_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='轮播图表';

-- ----------------------------
-- Records of banners
-- ----------------------------

-- ----------------------------
-- Table structure for banner_groups
-- ----------------------------
DROP TABLE IF EXISTS `banner_groups`;
CREATE TABLE `banner_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分组名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='轮播分组表';

-- ----------------------------
-- Records of banner_groups
-- ----------------------------

-- ----------------------------
-- Table structure for configs
-- ----------------------------
DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置名称',
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置键',
  `option` longtext COLLATE utf8mb4_unicode_ci COMMENT '选项',
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '配置值',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '配置类型 1:input 2:textarea 3:select 4:radio 5:checkbox 6:file 7:image 8:color 9:date 10:time 11:datetime',
  `config_group_id` int(10) unsigned NOT NULL DEFAULT '1',
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `suffix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '默认值的后缀',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `configs_key_unique` (`key`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of configs
-- ----------------------------

-- ----------------------------
-- Table structure for config_groups
-- ----------------------------
DROP TABLE IF EXISTS `config_groups`;
CREATE TABLE `config_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '组名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of config_groups
-- ----------------------------

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '组件key',
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单图标',
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'vue路由',
  `component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '组件地址',
  `roles` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限标识',
  `menuType` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单类型',
  `redirect` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '重定向地址',
  `sort` int(10) unsigned DEFAULT '255' COMMENT '菜单排序',
  `isHide` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态(0:禁用,1:启用)',
  `isAffix` tinyint(1) NOT NULL DEFAULT '0' COMMENT '固定(0:禁用,1:启用)',
  `isLink` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '是否跳转(0:禁用,1:启用)',
  `isKeepAlive` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否缓存(0:禁用,1:启用)',
  `isIframe` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否iframe(0:禁用,1:启用)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='菜单表';

-- ----------------------------
-- Records of menus
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Api名称',
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '路由',
  `sort` int(10) unsigned DEFAULT '255' COMMENT '菜单排序',
  `isHide` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态(0:禁用,1:启用)',
  `auth_open` tinyint(1) NOT NULL DEFAULT '0' COMMENT '权限验证1验证0不验证',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='APi权限表';

-- ----------------------------
-- Records of permissions
-- ----------------------------

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
  `rules` longtext NOT NULL,
  `permissions` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('3', '你家婆', null, '2023-02-01 14:01:15', '2023-02-01 14:01:15', '0', '', '');

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`,`role_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_roles
-- ----------------------------
INSERT INTO `user_roles` VALUES ('1', '1', '1', '2023-02-01 14:31:48', '2023-02-01 14:31:48');
