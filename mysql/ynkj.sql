/*
 Navicat MySQL Data Transfer

 Source Server         : 本地连接
 Source Server Type    : MySQL
 Source Server Version : 50714
 Source Host           : 127.0.0.1:3306
 Source Schema         : ynkj

 Target Server Type    : MySQL
 Target Server Version : 50714
 File Encoding         : 65001

 Date: 23/03/2018 01:18:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员自增ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '管理员的密码',
  `nick_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '管理员的简称',
  `status` int(11) NULL DEFAULT 1 COMMENT '用户状态 0：禁用； 1：正常 ；',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '邮箱',
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '手机号',
  `last_login_ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '最后登录ip',
  `last_login_time` datetime(0) NULL DEFAULT NULL COMMENT '最后登录时间',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '注册时间',
  `role` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '角色ID',
  `is_agent` tinyint(3) NOT NULL DEFAULT 1 COMMENT '是否经纪人 0否1是',
  `delete_time` datetime(0) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台管理员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '超管', 1, '', '', '0.0.0.0', '2018-03-23 01:10:41', '2017-10-18 00:07:01', '1', 1, NULL);

-- ----------------------------
-- Table structure for tp_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin_log`;
CREATE TABLE `tp_admin_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(10) NOT NULL DEFAULT 0 COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `log` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '日志备注',
  `log_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '执行的URL',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '执行者',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `create_time` datetime(0) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 157 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '行为日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_admin_log
-- ----------------------------
INSERT INTO `tp_admin_log` VALUES (153, 4, 0, '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-22 18:23:55');
INSERT INTO `tp_admin_log` VALUES (154, 4, 0, '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-23 00:43:05');
INSERT INTO `tp_admin_log` VALUES (155, 1, 0, '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-23 00:57:58');
INSERT INTO `tp_admin_log` VALUES (156, 1, 0, '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-23 01:10:40');

-- ----------------------------
-- Table structure for tp_auth_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_access`;
CREATE TABLE `tp_auth_access`  (
  `role_id` mediumint(8) UNSIGNED NOT NULL COMMENT '角色',
  `rule_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '规则唯一英文标识,全小写',
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '权限规则分类，请加应用前缀,如admin_',
  `menu_id` int(11) NULL DEFAULT NULL COMMENT '后台菜单ID',
  INDEX `role_id`(`role_id`) USING BTREE,
  INDEX `rule_name`(`rule_name`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限授权表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_auth_access
-- ----------------------------
INSERT INTO `tp_auth_access` VALUES (5, 'system/index/index', 'admin_url', 10);
INSERT INTO `tp_auth_access` VALUES (5, 'index/admin/password', 'admin_url', 11);
INSERT INTO `tp_auth_access` VALUES (5, 'index/upload/image', 'admin_url', 12);
INSERT INTO `tp_auth_access` VALUES (5, 'index/auth/default', 'admin_url', 1);
INSERT INTO `tp_auth_access` VALUES (5, 'index/admin/index', 'admin_url', 2);
INSERT INTO `tp_auth_access` VALUES (5, 'index/admin/index', 'admin_url', 9);
INSERT INTO `tp_auth_access` VALUES (5, 'index/admin/add', 'admin_url', 15);
INSERT INTO `tp_auth_access` VALUES (5, 'index/admin/edit', 'admin_url', 16);
INSERT INTO `tp_auth_access` VALUES (5, 'index/admin/status', 'admin_url', 17);
INSERT INTO `tp_auth_access` VALUES (5, 'index/admin/delete', 'admin_url', 18);
INSERT INTO `tp_auth_access` VALUES (5, 'index/auth/role', 'admin_url', 3);
INSERT INTO `tp_auth_access` VALUES (5, 'index/auth/roleadd', 'admin_url', 4);
INSERT INTO `tp_auth_access` VALUES (5, 'index/auth/roleedit', 'admin_url', 5);
INSERT INTO `tp_auth_access` VALUES (5, 'index/auth/roledelete', 'admin_url', 6);
INSERT INTO `tp_auth_access` VALUES (5, 'index/auth/authorize', 'admin_url', 7);
INSERT INTO `tp_auth_access` VALUES (5, 'index/auth/log', 'admin_url', 19);
INSERT INTO `tp_auth_access` VALUES (5, 'index/auth/viewlog', 'admin_url', 13);
INSERT INTO `tp_auth_access` VALUES (5, 'index/auth/clear', 'admin_url', 14);

-- ----------------------------
-- Table structure for tp_auth_menu
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_menu`;
CREATE TABLE `tp_auth_menu`  (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `parent_id` smallint(6) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级ID',
  `app` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '应用名称app',
  `model` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '控制器',
  `action` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作名称',
  `url_param` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'url参数',
  `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '菜单类型  1：权限认证+菜单；0：只作为菜单',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态，1显示，0不显示',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '菜单名称',
  `icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '菜单图标',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '备注',
  `sort` smallint(6) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序ID',
  `rule_param` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '验证规则',
  `nav_id` int(11) NULL DEFAULT 0 COMMENT 'nav ID ',
  `request` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '请求方式（日志生成）',
  `log_rule` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '日志规则',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `status`(`status`) USING BTREE,
  INDEX `model`(`model`) USING BTREE,
  INDEX `parent_id`(`parent_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台菜单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_auth_menu
-- ----------------------------
INSERT INTO `tp_auth_menu` VALUES (1, 0, 'index', 'auth', 'default', '', 0, 1, '系统管理', '', '', 6, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (2, 1, 'index', 'admin', 'index', '', 0, 1, '权限管理', '', '', 0, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (3, 2, 'index', 'auth', 'role', '', 1, 1, '角色管理', '', '', 1, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (4, 3, 'index', 'auth', 'roleAdd', '', 1, 0, '添加角色', '', '', 0, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (5, 3, 'index', 'auth', 'roleEdit', '', 1, 0, '编辑角色', '', '', 0, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (6, 3, 'index', 'auth', 'roleDelete', '', 1, 0, '删除角色', '', '', 0, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (7, 3, 'index', 'auth', 'authorize', '', 1, 0, '授权角色', '', '', 0, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (8, 1, 'index', 'auth', 'menu', '', 1, 1, '菜单管理', '', '', 1, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (9, 2, 'index', 'admin', 'index', '', 1, 1, '用户管理', '', '', 0, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (19, 1, 'index', 'auth', 'log', '', 1, 1, '操作日志', '', '', 0, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (10, 0, 'system', 'index', 'index', '', 1, 0, '系统操作', '', '', 0, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (11, 10, 'index', 'admin', 'password', '', 1, 0, '修改密码', '', '', 0, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (12, 10, 'index', 'upload', 'image', '', 1, 0, '上传图片', '', '', 0, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (13, 19, 'index', 'auth', 'viewLog', '', 1, 0, '日志详情', '', '', 0, '', 0, '', '');
INSERT INTO `tp_auth_menu` VALUES (14, 19, 'index', 'auth', 'clear', '', 1, 0, '清空日志', '', '', 0, '', 0, 'POST', '');
INSERT INTO `tp_auth_menu` VALUES (15, 9, 'index', 'admin', 'add', '', 1, 0, '增加用户', '', '', 0, '', 0, 'POST', '用户名：{name}');
INSERT INTO `tp_auth_menu` VALUES (16, 9, 'index', 'admin', 'edit', '', 1, 0, '修改用户', '', '', 0, '', 0, 'POST', '用户ID：{id}');
INSERT INTO `tp_auth_menu` VALUES (17, 9, 'index', 'admin', 'status', '', 1, 0, '修改状态', '', '', 0, '', 0, 'POST', '用户ID：{id}，修改后状态：{data}');
INSERT INTO `tp_auth_menu` VALUES (18, 9, 'index', 'admin', 'delete', '', 1, 0, '删除用户', '', '', 0, '', 0, 'POST', '用户ID：{id}');

-- ----------------------------
-- Table structure for tp_auth_role
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_role`;
CREATE TABLE `tp_auth_role`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色名称',
  `pid` smallint(6) NULL DEFAULT 0 COMMENT '父角色ID',
  `status` tinyint(1) UNSIGNED NULL DEFAULT NULL COMMENT '状态',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  `sort` int(3) NOT NULL DEFAULT 0 COMMENT '排序字段',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pid`(`pid`) USING BTREE,
  INDEX `status`(`status`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_auth_role
-- ----------------------------
INSERT INTO `tp_auth_role` VALUES (1, '超级管理员', 0, 1, '拥有网站最高管理员权限！', '0000-00-00 00:00:00', '2017-12-25 22:57:45', 0);
INSERT INTO `tp_auth_role` VALUES (5, '经纪人角色', 0, 1, '', '2018-03-23 01:08:59', '2018-03-23 01:08:59', 0);

-- ----------------------------
-- Table structure for tp_auth_role_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_role_user`;
CREATE TABLE `tp_auth_role_user`  (
  `role_id` int(11) UNSIGNED NULL DEFAULT 0 COMMENT '角色 id',
  `user_id` int(11) NULL DEFAULT 0 COMMENT '用户id',
  INDEX `group_id`(`role_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户角色对应表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of tp_auth_role_user
-- ----------------------------
INSERT INTO `tp_auth_role_user` VALUES (1, 1);

-- ----------------------------
-- Table structure for tp_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_rule`;
CREATE TABLE `tp_auth_rule`  (
  `menu_id` int(11) NOT NULL COMMENT '后台菜单 ID',
  `module` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '规则所属module',
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '权限规则分类，请加应用前缀,如admin_',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `url_param` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '额外url参数',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否有效(0:无效,1:有效)',
  `rule_param` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则附加条件',
  `nav_id` int(11) NULL DEFAULT 0 COMMENT 'nav id',
  PRIMARY KEY (`menu_id`) USING BTREE,
  INDEX `module`(`module`, `status`, `type`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限规则表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_base_babel
-- ----------------------------
DROP TABLE IF EXISTS `tp_base_babel`;
CREATE TABLE `tp_base_babel`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '标题',
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'icon链接地址',
  `sort` int(11) NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '标签表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_base_banner
-- ----------------------------
DROP TABLE IF EXISTS `tp_base_banner`;
CREATE TABLE `tp_base_banner`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '标题',
  `type` tinyint(1) NULL DEFAULT NULL COMMENT '显示位置 1首页上部banner 2首页中部四图',
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '链接地址',
  `sort` int(11) NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'banner 表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_base_notice
-- ----------------------------
DROP TABLE IF EXISTS `tp_base_notice`;
CREATE TABLE `tp_base_notice`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '通知内容',
  `banner_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '顶部banner地址',
  `house_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '房型图片地址',
  `sort` int(11) NULL DEFAULT 0 COMMENT '排序',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '新闻通知表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_base_search
-- ----------------------------
DROP TABLE IF EXISTS `tp_base_search`;
CREATE TABLE `tp_base_search`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `term` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '条件',
  `type` tinyint(1) NULL DEFAULT NULL COMMENT '类型: 1区域 2价格 3房型',
  `sort` int(11) NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '筛选基础表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_house
-- ----------------------------
DROP TABLE IF EXISTS `tp_house`;
CREATE TABLE `tp_house`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `fangxing` int(11) NOT NULL COMMENT '房型 search_id',
  `quyu` int(11) NOT NULL COMMENT '区域 search_id',
  `price` int(11) NOT NULL COMMENT '售价',
  `mianji` int(11) NULL DEFAULT NULL COMMENT '建筑面积',
  `guapai_date` date NULL DEFAULT NULL COMMENT '挂牌日期',
  `chaoxiang` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '朝向',
  `louceng` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '楼层',
  `louxing` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '楼型',
  `dianti` tinyint(1) NOT NULL DEFAULT 1 COMMENT '电梯: 0无 1有',
  `zhuangxiu` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '装修',
  `niandai` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '年代 建造年份',
  `youtu` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用途',
  `quanshu` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '权属',
  `shoufu` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '首付预算',
  `xiaoqu` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '小区名称',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '房源介绍',
  `admin_id` int(11) NULL DEFAULT NULL COMMENT '经纪人id',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '房源状态: 0下架 1上架 2经理审核 3成交',
  `sort` int(11) NULL DEFAULT 0 COMMENT '排序',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_id`(`admin_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '房源信息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_house_detail
-- ----------------------------
DROP TABLE IF EXISTS `tp_house_detail`;
CREATE TABLE `tp_house_detail`  (
  `house_id` int(11) NOT NULL COMMENT '房源id',
  `shuifeijiexi` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '税费解析',
  `zhuangxiumiaoshu` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '装修描述',
  `huxingjieshao` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '户型介绍',
  `hexinmaidian` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '核心卖点',
  PRIMARY KEY (`house_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '房源详情表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_house_image
-- ----------------------------
DROP TABLE IF EXISTS `tp_house_image`;
CREATE TABLE `tp_house_image`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `house_id` int(11) NOT NULL COMMENT '房源id',
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图片地址',
  `sort` int(11) NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `house_id`(`house_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '房源图集表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '手机号码',
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `head_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '头像地址',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_user_favourite
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_favourite`;
CREATE TABLE `tp_user_favourite`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NULL DEFAULT NULL COMMENT '用户id',
  `house_id` int(11) NULL DEFAULT NULL COMMENT '房源id',
  `favourite_date` date NULL DEFAULT NULL COMMENT '关注日期',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `house_id`(`house_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户关注表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for tp_user_record
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_record`;
CREATE TABLE `tp_user_record`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NULL DEFAULT NULL COMMENT '用户id',
  `house_id` int(11) NULL DEFAULT NULL COMMENT '房源id',
  `admin_id` int(11) NULL DEFAULT NULL COMMENT '经纪人id',
  `record_date` date NULL DEFAULT NULL COMMENT '看房日期',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_id`(`admin_id`) USING BTREE,
  INDEX `house_id`(`house_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '看房记录表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for tp_user_request
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_request`;
CREATE TABLE `tp_user_request`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `label_id` int(11) NOT NULL COMMENT '标签id',
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图片地址',
  `type` tinyint(1) NULL DEFAULT 1 COMMENT '类型: 1买 2卖',
  `status` tinyint(1) NULL DEFAULT 0 COMMENT '审核状态: 0待审核 1审核通过 2审核失败',
  `admin_id` int(11) NULL DEFAULT NULL COMMENT '经纪人id',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_id`(`admin_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户需求表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_user_request_image
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_request_image`;
CREATE TABLE `tp_user_request_image`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `request_id` int(11) NOT NULL COMMENT '需求id',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注信息',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `request_id`(`request_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户需求图集表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tp_user_reserve
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_reserve`;
CREATE TABLE `tp_user_reserve`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NULL DEFAULT NULL COMMENT '用户id',
  `house_id` int(11) NULL DEFAULT NULL COMMENT '房源id',
  `admin_id` int(11) NULL DEFAULT NULL COMMENT '经纪人id',
  `reserve_date` date NULL DEFAULT NULL COMMENT '预约日期',
  `status` tinyint(1) NULL DEFAULT 0 COMMENT '审核状态: 0待处理 1预约通过 2预约失败',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_id`(`admin_id`) USING BTREE,
  INDEX `house_id`(`house_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户预约表' ROW_FORMAT = Fixed;

SET FOREIGN_KEY_CHECKS = 1;