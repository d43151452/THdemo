/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : user_system

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-11-13 15:42:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for chat
-- ----------------------------
DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `send_id` int(11) NOT NULL,
  `send_name` varchar(255) NOT NULL,
  `get_id` int(11) NOT NULL,
  `send_time` datetime NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chat
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel_num` varchar(11) NOT NULL,
  `reg_time` datetime NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('5', 'a', 'NDI5N2Y0NGIxMzk1NTIzNTI0NWIyNDk3Mzk5ZDdhOTM=', '13371304447', '2018-11-12 15:08:49', 'YU5ESTVOMlkwTkdJeE16azFOVEl6TlRJME5XSXlORGszTXprNVpEZGhPVE09MTIz');
INSERT INTO `users` VALUES ('8', 'd', 'NDI5N2Y0NGIxMzk1NTIzNTI0NWIyNDk3Mzk5ZDdhOTM=', '13371304448', '2018-11-12 16:20:21', 'ZE5ESTVOMlkwTkdJeE16azFOVEl6TlRJME5XSXlORGszTXprNVpEZGhPVE09MTIz');
INSERT INTO `users` VALUES ('9', 'e', 'NDI5N2Y0NGIxMzk1NTIzNTI0NWIyNDk3Mzk5ZDdhOTM=', '13371304446', '2018-11-12 16:20:21', null);
INSERT INTO `users` VALUES ('10', 'f', 'NDI5N2Y0NGIxMzk1NTIzNTI0NWIyNDk3Mzk5ZDdhOTM=', '13371304446', '2018-11-12 16:20:21', null);
