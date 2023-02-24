/*
Navicat MySQL Data Transfer

Source Server         : 1
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : webman

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2023-02-24 16:20:10
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
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除flg',
  `department_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'admins1', '$2y$07$68tutssSF7bmmLW3IPUF8uhY/syXrtplmQYhKJWReTNbk0gUpJ7IO', '1', '127.0.0.1', '2023-02-24 10:45:54', '王旋', '109', '1', '2023-02-20 17:09:27', '2023-01-31 18:24:01', '0', null, '0');
INSERT INTO `admins` VALUES ('4', 'ceshi1223', '$2y$07$pKHrOHaVBANQMtdnvFn.1u/XWaq9SHIoTwgCdqSgie.5tWfdW9Cre', '1', '', null, '123', '0', '0', '2023-02-24 15:12:19', '2023-02-24 15:12:19', '0', null, '0');

-- ----------------------------
-- Table structure for admin_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_has_roles`;
CREATE TABLE `admin_has_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`,`role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of admin_has_roles
-- ----------------------------
INSERT INTO `admin_has_roles` VALUES ('3', '4', '8');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

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
  `creator_id` int(11) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `banner_group_id` (`banner_group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='轮播图表';

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES ('1', '1', '1', '123', '123', null, '1', '0', null, null, null);
INSERT INTO `banners` VALUES ('2', '1', '2', '3333', '222', null, '1', '0', null, null, null);
INSERT INTO `banners` VALUES ('3', '1', '3', '22223', '4444', null, '10', '0', null, null, null);
INSERT INTO `banners` VALUES ('4', '1', '2223', '333333333', '11231231231', null, null, '0', '2023-02-21 15:18:40', '2023-02-21 15:18:40', null);

-- ----------------------------
-- Table structure for banner_groups
-- ----------------------------
DROP TABLE IF EXISTS `banner_groups`;
CREATE TABLE `banner_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分组名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='轮播分组表';

-- ----------------------------
-- Records of banner_groups
-- ----------------------------
INSERT INTO `banner_groups` VALUES ('1', '13', '2023-02-17 18:03:26', '2023-02-17 18:03:26', null);
INSERT INTO `banner_groups` VALUES ('2', '13', '2023-02-17 18:04:13', '2023-02-17 18:04:13', null);
INSERT INTO `banner_groups` VALUES ('3', '14', '2023-02-17 18:10:36', '2023-02-17 18:10:36', null);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of config_groups
-- ----------------------------

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `department_name` varchar(255) NOT NULL COMMENT '部门名称',
  `principals` varchar(255) DEFAULT NULL COMMENT '负责人',
  `mobile` varchar(255) DEFAULT NULL COMMENT '负责人联系方式',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `status` varchar(255) DEFAULT '1' COMMENT '状态',
  `sort` varchar(255) NOT NULL DEFAULT '1' COMMENT '排序',
  `creator_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES ('1', '0', '总公司', '大王', '1224564312', '20123@qq.com', '1', '1', '1', null, null, null);
INSERT INTO `departments` VALUES ('2', '1', '第一个部门', '小', '123123123', '123123@123.com', '1', '1', '3', null, null, null);

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(10) NOT NULL DEFAULT '1',
  `description` varchar(1000) DEFAULT NULL,
  `creator_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '组件key',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单图标',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'vue路由',
  `component` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '组件地址',
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限标识',
  `menuType` tinyint(1) DEFAULT '1' COMMENT '菜单类型',
  `redirect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '重定向地址',
  `sort` int(10) unsigned DEFAULT '255' COMMENT '菜单排序',
  `isHide` tinyint(1) DEFAULT '0' COMMENT '状态(0:禁用,1:启用)',
  `isAffix` tinyint(1) DEFAULT '0' COMMENT '固定(0:禁用,1:启用)',
  `isLink` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '是否跳转(0:禁用,1:启用)',
  `isKeepAlive` tinyint(1) DEFAULT '0' COMMENT '是否缓存(0:禁用,1:启用)',
  `isIframe` tinyint(1) DEFAULT '0' COMMENT '是否iframe(0:禁用,1:启用)',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='菜单表';

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', '0', 'home', 'home', null, 'home', 'home', 'home', '1', null, '255', '0', '0', null, '0', '0');
INSERT INTO `menus` VALUES ('2', '0', 'inde', 'index', null, 'index', 'index', 'index', '1', null, '255', '0', '0', null, '0', '0');

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
  PRIMARY KEY (`id`) USING BTREE,
  KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='APi权限表';

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', '0', 'title', null, '255', '0', '0');
INSERT INTO `permissions` VALUES ('2', '1', 'title1', null, '255', '0', '0');
INSERT INTO `permissions` VALUES ('3', '1', 'titie1_1', null, '255', '0', '0');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `data_range` smallint(1) unsigned DEFAULT '0' COMMENT '数据权限 1 全部数据 2 自定义数据 3 仅本人数据 4 部门数据 5 部门及以下数据',
  `desc` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', '超管', '1', null, '2023-02-24 14:10:22', '2023-02-24 14:10:22', null);

-- ----------------------------
-- Table structure for role_has_departments
-- ----------------------------
DROP TABLE IF EXISTS `role_has_departments`;
CREATE TABLE `role_has_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of role_has_departments
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_menus
-- ----------------------------
DROP TABLE IF EXISTS `role_has_menus`;
CREATE TABLE `role_has_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of role_has_menus
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
