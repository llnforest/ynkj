/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : ynkj

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-03-27 18:53:10
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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台管理员表';

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '超管', '1', '', '', '0.0.0.0', '2018-03-27 15:10:02', '2017-10-18 00:07:01', '1', '1', null);

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
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=169 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='行为日志表';

-- ----------------------------
-- Records of tp_admin_log
-- ----------------------------
INSERT INTO `tp_admin_log` VALUES ('153', '4', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-22 18:23:55');
INSERT INTO `tp_admin_log` VALUES ('154', '4', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-23 00:43:05');
INSERT INTO `tp_admin_log` VALUES ('155', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-23 00:57:58');
INSERT INTO `tp_admin_log` VALUES ('156', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-23 01:10:40');
INSERT INTO `tp_admin_log` VALUES ('157', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-23 09:45:49');
INSERT INTO `tp_admin_log` VALUES ('158', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-23 23:54:33');
INSERT INTO `tp_admin_log` VALUES ('159', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-24 16:56:16');
INSERT INTO `tp_admin_log` VALUES ('160', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-25 10:36:26');
INSERT INTO `tp_admin_log` VALUES ('161', '0', '0', '管理员超管登录后台', '/index/publics/login.html', '', '后台登录', '2018-03-25 12:24:28');
INSERT INTO `tp_admin_log` VALUES ('162', '0', '0', '管理员超管登录后台', '/index/publics/login.html', '', '后台登录', '2018-03-25 12:24:35');
INSERT INTO `tp_admin_log` VALUES ('163', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '', '后台登录', '2018-03-25 12:24:53');
INSERT INTO `tp_admin_log` VALUES ('164', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-25 12:29:45');
INSERT INTO `tp_admin_log` VALUES ('165', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-25 16:11:53');
INSERT INTO `tp_admin_log` VALUES ('166', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-25 23:46:47');
INSERT INTO `tp_admin_log` VALUES ('167', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-26 19:09:06');
INSERT INTO `tp_admin_log` VALUES ('168', '1', '0', '管理员超管登录后台', '/index/publics/login.html', '超管', '后台登录', '2018-03-27 15:10:02');

-- ----------------------------
-- Table structure for tp_auth_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_access`;
CREATE TABLE `tp_auth_access` (
  `role_id` mediumint(8) unsigned NOT NULL COMMENT '角色',
  `rule_name` varchar(255) NOT NULL COMMENT '规则唯一英文标识,全小写',
  `type` varchar(30) DEFAULT NULL COMMENT '权限规则分类，请加应用前缀,如admin_',
  `menu_id` int(11) DEFAULT NULL COMMENT '后台菜单ID',
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `rule_name` (`rule_name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='权限授权表';

-- ----------------------------
-- Records of tp_auth_access
-- ----------------------------
INSERT INTO `tp_auth_access` VALUES ('5', 'system/index/index', 'admin_url', '10');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/admin/password', 'admin_url', '11');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/upload/image', 'admin_url', '12');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/auth/default', 'admin_url', '1');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/admin/index', 'admin_url', '2');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/admin/index', 'admin_url', '9');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/admin/add', 'admin_url', '15');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/admin/edit', 'admin_url', '16');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/admin/status', 'admin_url', '17');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/admin/delete', 'admin_url', '18');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/auth/role', 'admin_url', '3');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/auth/roleadd', 'admin_url', '4');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/auth/roleedit', 'admin_url', '5');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/auth/roledelete', 'admin_url', '6');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/auth/authorize', 'admin_url', '7');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/auth/log', 'admin_url', '19');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/auth/viewlog', 'admin_url', '13');
INSERT INTO `tp_auth_access` VALUES ('5', 'index/auth/clear', 'admin_url', '14');

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
  PRIMARY KEY (`id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `model` (`model`) USING BTREE,
  KEY `parent_id` (`parent_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台菜单表';

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
INSERT INTO `tp_auth_menu` VALUES ('20', '0', 'house', 'house', 'index', '', '1', '1', '房源管理', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('21', '0', 'user', 'user', 'index', '', '1', '1', '用户管理', '', '', '1', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('22', '0', 'base', 'banner', 'index', '', '1', '1', '基础管理', '', '', '2', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('23', '22', 'base', 'banner', 'index', '', '1', '1', 'banner管理', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('24', '22', 'base', 'label', 'index', '', '1', '1', '标签管理', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('25', '22', 'base', 'search', 'index', '', '1', '1', '筛选管理', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('26', '22', 'base', 'notice', 'index', '', '1', '1', '通知管理', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('27', '20', 'house', 'house', 'index', '', '1', '1', '房源管理', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('28', '21', 'user', 'user', 'index', '', '1', '1', '用户管理', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('29', '21', 'user', 'request', 'index', '', '1', '1', '用户需求', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('30', '21', 'user', 'reserve', 'index', '', '1', '1', '用户预约', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('31', '21', 'user', 'favourite', 'index', '', '1', '1', '用户关注', '', '', '0', '', '0', '', '');
INSERT INTO `tp_auth_menu` VALUES ('32', '20', 'user', 'record', 'index', '', '1', '1', '看房管理', '', '', '0', '', '0', '', '');

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
  PRIMARY KEY (`id`) USING BTREE,
  KEY `pid` (`pid`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='角色表';

-- ----------------------------
-- Records of tp_auth_role
-- ----------------------------
INSERT INTO `tp_auth_role` VALUES ('1', '超级管理员', '0', '1', '拥有网站最高管理员权限！', '0000-00-00 00:00:00', '2017-12-25 22:57:45', '0');
INSERT INTO `tp_auth_role` VALUES ('5', '经纪人角色', '0', '1', '', '2018-03-23 01:08:59', '2018-03-23 01:08:59', '0');

-- ----------------------------
-- Table structure for tp_auth_role_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_role_user`;
CREATE TABLE `tp_auth_role_user` (
  `role_id` int(11) unsigned DEFAULT '0' COMMENT '角色 id',
  `user_id` int(11) DEFAULT '0' COMMENT '用户id',
  KEY `group_id` (`role_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='用户角色对应表';

-- ----------------------------
-- Records of tp_auth_role_user
-- ----------------------------
INSERT INTO `tp_auth_role_user` VALUES ('1', '1');

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
  PRIMARY KEY (`menu_id`) USING BTREE,
  KEY `module` (`module`,`status`,`type`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='权限规则表';

-- ----------------------------
-- Records of tp_auth_rule
-- ----------------------------
INSERT INTO `tp_auth_rule` VALUES ('20', 'house', 'admin_url', 'house/house/index', '', '房源管理', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('21', 'user', 'admin_url', 'user/user/index', '', '用户管理', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('22', 'base', 'admin_url', 'base/banner/index', '', '基础管理', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('23', 'base', 'admin_url', 'base/banner/index', '', 'banner管理', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('24', 'base', 'admin_url', 'base/label/index', '', '标签管理', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('25', 'base', 'admin_url', 'base/search/index', '', '筛选管理', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('26', 'base', 'admin_url', 'base/notice/index', '', '通知管理', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('27', 'house', 'admin_url', 'house/house/index', '', '房源管理', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('28', 'user', 'admin_url', 'user/user/index', '', '用户管理', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('29', 'user', 'admin_url', 'user/request/index', '', '用户需求', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('30', 'user', 'admin_url', 'user/reserve/index', '', '用户预约', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('31', 'user', 'admin_url', 'user/favourite/index', '', '用户关注', '1', '', '0');
INSERT INTO `tp_auth_rule` VALUES ('32', 'user', 'admin_url', 'user/record/index', '', '看房管理', '1', '', '0');

-- ----------------------------
-- Table structure for tp_base_banner
-- ----------------------------
DROP TABLE IF EXISTS `tp_base_banner`;
CREATE TABLE `tp_base_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) DEFAULT NULL COMMENT '标题',
  `type` tinyint(1) DEFAULT NULL COMMENT '显示位置 1首页上部banner 2首页中部四图',
  `url` varchar(100) NOT NULL COMMENT '链接地址',
  `href` varchar(100) DEFAULT NULL COMMENT '超链接',
  `updown` tinyint(1) NOT NULL DEFAULT '1' COMMENT '上下架： 0 下架 1上架',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='banner 表';

-- ----------------------------
-- Records of tp_base_banner
-- ----------------------------

-- ----------------------------
-- Table structure for tp_base_label
-- ----------------------------
DROP TABLE IF EXISTS `tp_base_label`;
CREATE TABLE `tp_base_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) DEFAULT NULL COMMENT '标题',
  `url` varchar(100) DEFAULT NULL COMMENT 'icon链接地址',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='标签表';

-- ----------------------------
-- Records of tp_base_label
-- ----------------------------
INSERT INTO `tp_base_label` VALUES ('4', '新房', '\\images\\label\\20180324\\6558dd1b7849d65c2f4c00fa3d407bae.png', '0');
INSERT INTO `tp_base_label` VALUES ('5', '二手房', '\\images\\label\\20180324\\59f49916fe0c0d5054f86e27f4c352cc.png', '0');

-- ----------------------------
-- Table structure for tp_base_notice
-- ----------------------------
DROP TABLE IF EXISTS `tp_base_notice`;
CREATE TABLE `tp_base_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `content` varchar(255) NOT NULL COMMENT '通知内容',
  `banner_url` varchar(100) NOT NULL COMMENT '顶部banner地址',
  `house_url` varchar(100) NOT NULL COMMENT '房型图片地址',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='新闻通知表';

-- ----------------------------
-- Records of tp_base_notice
-- ----------------------------

-- ----------------------------
-- Table structure for tp_base_search
-- ----------------------------
DROP TABLE IF EXISTS `tp_base_search`;
CREATE TABLE `tp_base_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `term` varchar(50) DEFAULT NULL COMMENT '条件',
  `type` tinyint(1) DEFAULT NULL COMMENT '类型: 1区域 2价格 3房型',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='筛选基础表';

-- ----------------------------
-- Records of tp_base_search
-- ----------------------------
INSERT INTO `tp_base_search` VALUES ('2', '蜀山区', '1', '0');
INSERT INTO `tp_base_search` VALUES ('3', '包河区', '1', '0');
INSERT INTO `tp_base_search` VALUES ('4', '三室一厅', '3', '0');
INSERT INTO `tp_base_search` VALUES ('5', '两室一厅', '3', '0');
INSERT INTO `tp_base_search` VALUES ('6', '0-80', '2', '0');
INSERT INTO `tp_base_search` VALUES ('7', '80-90', '2', '0');

-- ----------------------------
-- Table structure for tp_house
-- ----------------------------
DROP TABLE IF EXISTS `tp_house`;
CREATE TABLE `tp_house` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `label_id` int(11) NOT NULL DEFAULT '0' COMMENT '标签管理',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `fangxing` int(11) NOT NULL COMMENT '房型 search_id',
  `quyu` int(11) NOT NULL COMMENT '区域 search_id',
  `price` int(11) NOT NULL COMMENT '售价',
  `mianji` varchar(11) DEFAULT NULL COMMENT '建筑面积',
  `guapai_date` date DEFAULT NULL COMMENT '挂牌日期',
  `chaoxiang` varchar(50) DEFAULT NULL COMMENT '朝向',
  `louceng` varchar(50) DEFAULT NULL COMMENT '楼层',
  `louxing` varchar(50) DEFAULT NULL COMMENT '楼型',
  `dianti` tinyint(1) NOT NULL DEFAULT '1' COMMENT '电梯: 0无 1有',
  `zhuangxiu` varchar(50) DEFAULT NULL COMMENT '装修',
  `niandai` varchar(20) DEFAULT NULL COMMENT '年代 建造年份',
  `yongtu` varchar(50) DEFAULT NULL COMMENT '用途',
  `quanshu` varchar(50) DEFAULT NULL COMMENT '权属',
  `shoufu` varchar(100) DEFAULT NULL COMMENT '首付预算',
  `xiaoqu` varchar(50) DEFAULT NULL COMMENT '小区名称',
  `description` varchar(255) DEFAULT NULL COMMENT '房源介绍',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '经纪人id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '房源状态: 0下架 1上架(审核通过)  2经理审核 3审核不通过 4成交',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `delete_time` datetime NOT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `label_id` (`label_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='房源信息表';

-- ----------------------------
-- Records of tp_house
-- ----------------------------
INSERT INTO `tp_house` VALUES ('1', '4', '测试标题', '4', '2', '5000', null, null, null, null, null, '1', null, null, null, null, null, null, null, '1', '0', '0', '2018-03-20 00:29:59', '2018-03-27 18:35:01', '0000-00-00 00:00:00');
INSERT INTO `tp_house` VALUES ('2', '5', '测试房源', '4', '3', '100', '90', null, '南北向', '15', '塔楼', '0', '中装', '2017', '商品房', '个人', '20', '天鹅湖畔小区', '政务区，近地铁', '1', '2', '0', '2018-03-27 17:21:22', '2018-03-27 18:35:04', '0000-00-00 00:00:00');
INSERT INTO `tp_house` VALUES ('3', '4', '新房上市', '4', '2', '100', '', null, '', '', '', '1', '', '', '', '', '', '', '', '1', '0', '0', '2018-03-27 18:34:42', '2018-03-27 18:34:42', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for tp_house_detail
-- ----------------------------
DROP TABLE IF EXISTS `tp_house_detail`;
CREATE TABLE `tp_house_detail` (
  `house_id` int(11) NOT NULL COMMENT '房源id',
  `shuifeijiexi` text COMMENT '税费解析',
  `zhuangxiumiaoshu` text COMMENT '装修描述',
  `huxingjieshao` text COMMENT '户型介绍',
  `hexinmaidian` text COMMENT '核心卖点',
  PRIMARY KEY (`house_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='房源详情表';

-- ----------------------------
-- Records of tp_house_detail
-- ----------------------------
INSERT INTO `tp_house_detail` VALUES ('2', '满两年，3个点税费', '家具齐全，中等装修', '客厅非常大，南北通透', '地铁近，市中心，商业中心');
INSERT INTO `tp_house_detail` VALUES ('3', '', '', '', '');

-- ----------------------------
-- Table structure for tp_house_image
-- ----------------------------
DROP TABLE IF EXISTS `tp_house_image`;
CREATE TABLE `tp_house_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `house_id` int(11) NOT NULL COMMENT '房源id',
  `url` varchar(100) DEFAULT NULL COMMENT '图片地址',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `house_id` (`house_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='房源图集表';

-- ----------------------------
-- Records of tp_house_image
-- ----------------------------
INSERT INTO `tp_house_image` VALUES ('7', '2', '\\images\\house\\20180327\\7f44759f0f58af584aeae02d2eb333fa_thumb.png', '0');
INSERT INTO `tp_house_image` VALUES ('6', '2', '\\images\\house\\20180327\\c733fa98d48a9f7cb7809bcd68ab4a7c_thumb.png', '2');

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `phone` varchar(50) NOT NULL COMMENT '手机号码',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `head_url` varchar(100) DEFAULT NULL COMMENT '头像地址',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `delete_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户表';

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('2', '13585788049', '508df4cb2f4d8f80519256258cfb975f', null, null, '2018-03-25 11:46:30', '2018-03-25 11:47:57', null);

-- ----------------------------
-- Table structure for tp_user_favourite
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_favourite`;
CREATE TABLE `tp_user_favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `house_id` int(11) NOT NULL DEFAULT '0' COMMENT '房源id',
  `favourite_date` date DEFAULT NULL COMMENT '关注日期',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `house_id` (`house_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='用户关注表';

-- ----------------------------
-- Records of tp_user_favourite
-- ----------------------------

-- ----------------------------
-- Table structure for tp_user_record
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_record`;
CREATE TABLE `tp_user_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `house_id` int(11) NOT NULL DEFAULT '0' COMMENT '房源id',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '经纪人id',
  `record_date` date DEFAULT NULL COMMENT '看房日期',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `house_id` (`house_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='看房记录表';

-- ----------------------------
-- Records of tp_user_record
-- ----------------------------

-- ----------------------------
-- Table structure for tp_user_request
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_request`;
CREATE TABLE `tp_user_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `label_id` int(11) NOT NULL COMMENT '标签id',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注信息',
  `type` tinyint(1) DEFAULT '1' COMMENT '类型: 1买 2卖',
  `status` tinyint(1) DEFAULT '0' COMMENT '审核状态: 0待审核 1审核通过 2审核失败 3已发布',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '经纪人id',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户需求表';

-- ----------------------------
-- Records of tp_user_request
-- ----------------------------
INSERT INTO `tp_user_request` VALUES ('1', '2', '4', '是这样子的吗', '2', '1', '1', '2018-03-25 11:46:30', '2018-03-26 00:06:24');

-- ----------------------------
-- Table structure for tp_user_request_image
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_request_image`;
CREATE TABLE `tp_user_request_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `request_id` int(11) NOT NULL COMMENT '需求id',
  `url` varchar(100) DEFAULT NULL COMMENT '图片地址',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `request_id` (`request_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户需求图集表';

-- ----------------------------
-- Records of tp_user_request_image
-- ----------------------------
INSERT INTO `tp_user_request_image` VALUES ('1', '1', '\\images\\label\\20180324\\6558dd1b7849d65c2f4c00fa3d407bae.png');
INSERT INTO `tp_user_request_image` VALUES ('2', '1', '\\images\\label\\20180324\\6558dd1b7849d65c2f4c00fa3d407bae.png');
INSERT INTO `tp_user_request_image` VALUES ('3', '1', '\\images\\label\\20180324\\6558dd1b7849d65c2f4c00fa3d407bae.png');
INSERT INTO `tp_user_request_image` VALUES ('4', '1', '\\images\\label\\20180324\\6558dd1b7849d65c2f4c00fa3d407bae.png');

-- ----------------------------
-- Table structure for tp_user_reserve
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_reserve`;
CREATE TABLE `tp_user_reserve` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `house_id` int(11) NOT NULL DEFAULT '0' COMMENT '房源id',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '经纪人id',
  `reserve_date` date DEFAULT NULL COMMENT '预约日期',
  `status` tinyint(1) DEFAULT '0' COMMENT '审核状态: 0待处理 1预约通过 2预约失败',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `house_id` (`house_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='用户预约表';

-- ----------------------------
-- Records of tp_user_reserve
-- ----------------------------
