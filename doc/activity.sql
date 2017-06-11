/*
 Navicat Premium Data Transfer

 Source Server         : blog
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : xyp

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 06/11/2017 19:24:27 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `activity`
-- ----------------------------
DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `act_user` varchar(32) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `act_title` varchar(64) DEFAULT NULL,
  `act_content` text,
  `act_location` varchar(64) DEFAULT NULL,
  `act_time` datetime DEFAULT NULL,
  `act_user_need` int(10) DEFAULT NULL,
  `act_wechat` varchar(64) DEFAULT NULL,
  `act_type` varchar(10) DEFAULT NULL,
  `act_review` int(11) DEFAULT '0',
  `act_have_done` int(11) DEFAULT '0',
  `act_enough_user` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
