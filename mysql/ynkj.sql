/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : ynkj

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-03-22 18:45:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员自增ID',
  `name` varchar(255) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '管理员的密码',
  `nick_name` varchar(255) DEFAULT NULL COMMENT '管理员的简称',
  `status` int(11) DEFAULT '1' COMMENT '用户状态 0：禁用； 1：正常 ；',
  `email` varchar(255) DEFAULT '' COMMENT '邮箱',
  `phone` varchar(15) NOT NULL COMMENT '手机号',
  `last_login_ip` varchar(16) DEFAULT NULL COMMENT '最后登录ip',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `create_time` datetime DEFAULT NULL COMMENT '注册时间',
  `role` varchar(255) DEFAULT NULL COMMENT '角色ID',
  `is_agent` tinyint(3) NOT NULL DEFAULT '1' COMMENT '是否经纪人 0否1是',
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='后台管理员表';

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('4', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '超管', '1', '', '', '0.0.0.0', '2018-03-22 18:23:55', '2017-10-18 00:07:01', '1', '1', null);

-- ----------------------------
-- Table structure for tp_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin_log`;
CREATE TABLE `tp_admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `log` longtext NOT NULL COMMENT '日志备注',
  `log_url` varchar(255) NOT NULL COMMENT '执行的URL',
  `username` varchar(255) NOT NULL COMMENT '执行者',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `create_time` datetime NOT NULL COMMENT '操作时间',
  `system_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=154 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';

-- ----------------------------
-- Records of tp_admin_log
-- ----------------------------
INSERT INTO `tp_admin_log` VALUES ('153', '4', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-22 18:23:55', '0');

-- ----------------------------
-- Table structure for tp_auth_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_access`;
CREATE TABLE `tp_auth_access` (
  `role_id` mediumint(8) unsigned NOT NULL COMMENT '角色',
  `rule_name` varchar(255) NOT NULL COMMENT '规则唯一英文标识,全小写',
  `type` varchar(30) DEFAULT NULL COMMENT '权限规则分类，请加应用前缀,如admin_',
  `menu_id` int(11) DEFAULT NULL COMMENT '后台菜单ID',
  KEY `role_id` (`role_id`),
  KEY `rule_name` (`rule_name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限授权表';

-- ----------------------------
-- Records of tp_auth_access
-- ----------------------------
INSERT INTO `tp_auth_access` VALUES ('3', 'index/upload/image', 'admin_url', '48');
INSERT INTO `tp_auth_access` VALUES ('3', 'index/admin/password', 'admin_url', '47');
INSERT INTO `tp_auth_access` VALUES ('3', 'system/index/index', 'admin_url', '46');
INSERT INTO `tp_auth_access` VALUES ('3', 'customer/index/index', 'admin_url', '11');
INSERT INTO `tp_auth_access` VALUES ('3', 'customer/contact/index', 'admin_url', '24');
INSERT INTO `tp_auth_access` VALUES ('3', 'customer/contact/contactadd', 'admin_url', '33');
INSERT INTO `tp_auth_access` VALUES ('3', 'customer/contact/contactedit', 'admin_url', '34');
INSERT INTO `tp_auth_access` VALUES ('3', 'customer/contact/contactdelete', 'admin_url', '35');
INSERT INTO `tp_auth_access` VALUES ('3', 'customer/contact/editstatus', 'admin_url', '92');
INSERT INTO `tp_auth_access` VALUES ('3', 'reserve/order/index', 'admin', '14');
INSERT INTO `tp_auth_access` VALUES ('3', 'reserve/order/index', 'admin', '9');
INSERT INTO `tp_auth_access` VALUES ('3', 'reserve/order/editstatus', 'admin', '100');

-- ----------------------------
-- Table structure for tp_auth_menu
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_menu`;
CREATE TABLE `tp_auth_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `parent_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `app` char(20) NOT NULL COMMENT '应用名称app',
  `model` char(20) NOT NULL COMMENT '控制器',
  `action` char(20) NOT NULL COMMENT '操作名称',
  `url_param` char(50) NOT NULL COMMENT 'url参数',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '菜单类型  1：权限认证+菜单；0：只作为菜单',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态，1显示，0不显示',
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `icon` varchar(50) NOT NULL COMMENT '菜单图标',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序ID',
  `rule_param` varchar(255) NOT NULL COMMENT '验证规则',
  `nav_id` int(11) DEFAULT '0' COMMENT 'nav ID ',
  `request` varchar(255) NOT NULL COMMENT '请求方式（日志生成）',
  `log_rule` varchar(255) NOT NULL COMMENT '日志规则',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `model` (`model`),
  KEY `parent_id` (`parent_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

-- ----------------------------
-- Records of tp_auth_menu
-- ----------------------------
INSERT INTO `tp_auth_menu` VALUES ('1', '0', 'index', 'auth', 'default', '', '0', '1', '系统管理', '', '', '6', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('2', '1', 'index', 'admin', 'index', '', '0', '1', '权限管理', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('3', '2', 'index', 'auth', 'role', '', '1', '1', '角色管理', '', '', '1', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('4', '3', 'index', 'auth', 'roleAdd', '', '1', '0', '添加角色', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('5', '3', 'index', 'auth', 'roleEdit', '', '1', '0', '编辑角色', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('6', '3', 'index', 'auth', 'roleDelete', '', '1', '0', '删除角色', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('7', '3', 'index', 'auth', 'authorize', '', '1', '0', '授权角色', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('8', '1', 'index', 'auth', 'menu', '', '1', '1', '菜单管理', '', '', '1', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('9', '2', 'index', 'admin', 'index', '', '1', '1', '用户管理', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('19', '1', 'index', 'auth', 'log', '', '1', '1', '操作日志', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('10', '0', 'system', 'index', 'index', '', '1', '0', '系统操作', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('11', '10', 'index', 'admin', 'password', '', '1', '0', '修改密码', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('12', '10', 'index', 'upload', 'image', '', '1', '0', '上传图片', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('13', '19', 'index', 'auth', 'viewLog', '', '1', '0', '日志详情', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('14', '19', 'index', 'auth', 'clear', '', '1', '0', '清空日志', '', '', '0', '', '0', 'POST', '');
INSERT INTO `tp_auth_menu` VALUES ('15', '9', 'index', 'admin', 'add', '', '1', '0', '增加用户', '', '', '0', '', '0', 'POST', '用户名：{name}');
INSERT INTO `tp_auth_menu` VALUES ('16', '9', 'index', 'admin', 'edit', '', '1', '0', '修改用户', '', '', '0', '', '0', 'POST', '用户ID：{id}');
INSERT INTO `tp_auth_menu` VALUES ('17', '9', 'index', 'admin', 'status', '', '1', '0', '修改状态', '', '', '0', '', '0', 'POST', '用户ID：{id}，修改后状态：{data}');
INSERT INTO `tp_auth_menu` VALUES ('18', '9', 'index', 'admin', 'delete', '', '1', '0', '删除用户', '', '', '0', '', '0', 'POST', '用户ID：{id}');

-- ----------------------------
-- Table structure for tp_auth_role
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_role`;
CREATE TABLE `tp_auth_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `pid` smallint(6) DEFAULT '0' COMMENT '父角色ID',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '状态',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `sort` int(3) NOT NULL DEFAULT '0' COMMENT '排序字段',
  `system_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of tp_auth_role
-- ----------------------------
INSERT INTO `tp_auth_role` VALUES ('1', '超级管理员', '0', '1', '拥有网站最高管理员权限！', '0000-00-00 00:00:00', '2017-12-25 22:57:45', '0', '0');

-- ----------------------------
-- Table structure for tp_auth_role_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_role_user`;
CREATE TABLE `tp_auth_role_user` (
  `role_id` int(11) unsigned DEFAULT '0' COMMENT '角色 id',
  `user_id` int(11) DEFAULT '0' COMMENT '用户id',
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户角色对应表';

-- ----------------------------
-- Records of tp_auth_role_user
-- ----------------------------
INSERT INTO `tp_auth_role_user` VALUES ('1', '2');

-- ----------------------------
-- Table structure for tp_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_rule`;
CREATE TABLE `tp_auth_rule` (
  `menu_id` int(11) NOT NULL COMMENT '后台菜单 ID',
  `module` varchar(20) NOT NULL COMMENT '规则所属module',
  `type` varchar(30) NOT NULL DEFAULT '1' COMMENT '权限规则分类，请加应用前缀,如admin_',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `url_param` varchar(255) DEFAULT NULL COMMENT '额外url参数',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `rule_param` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  `nav_id` int(11) DEFAULT '0' COMMENT 'nav id',
  PRIMARY KEY (`menu_id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限规则表';

-- ----------------------------
-- Records of tp_auth_rule
-- ----------------------------
