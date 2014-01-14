/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.1
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : task

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2014-01-14 21:55:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `content` text,
  `isget` int(11) NOT NULL DEFAULT '0',
  `ispost` int(11) NOT NULL DEFAULT '0',
  `gettime` datetime DEFAULT NULL,
  `posttime` datetime DEFAULT NULL,
  `pv` int(11) NOT NULL DEFAULT '0',
  `type` varchar(250) DEFAULT NULL,
  `resource` varchar(250) DEFAULT NULL,
  `shoturl` varchar(250) DEFAULT NULL,
  `postnum` int(11) NOT NULL DEFAULT '0',
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link` (`link`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6602 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for article_joke
-- ----------------------------
DROP TABLE IF EXISTS `article_joke`;
CREATE TABLE `article_joke` (
  `id` bigint(20) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `content` text,
  `picurl` varchar(250) DEFAULT NULL,
  `localpic` varchar(250) DEFAULT NULL,
  `gettime` datetime DEFAULT NULL,
  `posttime` datetime DEFAULT NULL,
  `ispost` int(11) NOT NULL DEFAULT '0',
  `postuser` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for diffbot
-- ----------------------------
DROP TABLE IF EXISTS `diffbot`;
CREATE TABLE `diffbot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(250) DEFAULT NULL,
  `used` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for en_article
-- ----------------------------
DROP TABLE IF EXISTS `en_article`;
CREATE TABLE `en_article` (
  `articleid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) DEFAULT NULL,
  `link` varchar(250) NOT NULL,
  `source` varchar(500) DEFAULT NULL,
  `snippet` varchar(500) DEFAULT NULL,
  `istweet` int(11) NOT NULL DEFAULT '0',
  `redirect` varchar(500) DEFAULT NULL,
  `posttime` int(11) DEFAULT NULL,
  `gettime` int(11) NOT NULL,
  `ispost` int(1) NOT NULL DEFAULT '0',
  `content` text,
  `images` text,
  `media` text,
  `replynum` int(11) DEFAULT '0',
  PRIMARY KEY (`articleid`,`link`),
  KEY `articleid` (`articleid`,`link`) USING BTREE,
  KEY `link` (`link`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for getuser
-- ----------------------------
DROP TABLE IF EXISTS `getuser`;
CREATE TABLE `getuser` (
  `userid` varchar(50) NOT NULL,
  `screen_name` varchar(100) NOT NULL,
  `fansNum` int(11) NOT NULL DEFAULT '0',
  `statuses_count` int(11) NOT NULL DEFAULT '0',
  `atnum` int(11) NOT NULL DEFAULT '0',
  `atuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hotword
-- ----------------------------
DROP TABLE IF EXISTS `hotword`;
CREATE TABLE `hotword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotword` varchar(250) DEFAULT NULL,
  `gettime` datetime DEFAULT NULL,
  `postnum` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hotword` (`hotword`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2609 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `src` varchar(250) DEFAULT NULL,
  `dir` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7208 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for reply
-- ----------------------------
DROP TABLE IF EXISTS `reply`;
CREATE TABLE `reply` (
  `mid` bigint(20) NOT NULL,
  `ispost` int(11) NOT NULL DEFAULT '0',
  `gettime` datetime DEFAULT NULL,
  `posttime` datetime DEFAULT NULL,
  `puser` varchar(50) DEFAULT NULL,
  `gtext` text,
  `guser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for send
-- ----------------------------
DROP TABLE IF EXISTS `send`;
CREATE TABLE `send` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) DEFAULT NULL,
  `postid` varchar(250) DEFAULT NULL,
  `posttime` datetime DEFAULT NULL,
  `heart` int(11) NOT NULL DEFAULT '0',
  `review` int(11) NOT NULL DEFAULT '0',
  `forward` int(11) NOT NULL DEFAULT '0',
  `collect` int(11) NOT NULL DEFAULT '0',
  `userid` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13049 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for twitter_reply
-- ----------------------------
DROP TABLE IF EXISTS `twitter_reply`;
CREATE TABLE `twitter_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `isreply` int(11) NOT NULL DEFAULT '0',
  `gettime` datetime DEFAULT NULL,
  `replytime` datetime DEFAULT NULL,
  `replyer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
