/*
 Navicat Premium Data Transfer

 Source Server         : test
 Source Server Type    : MySQL
 Source Server Version : 50720
 Source Host           : localhost:3306
 Source Schema         : mingrenwang

 Target Server Type    : MySQL
 Target Server Version : 50720
 File Encoding         : 65001

 Date: 14/07/2021 00:55:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO `images` VALUES (30, 'upload/20210619103618毛泽东.jpg', '毛泽东');
INSERT INTO `images` VALUES (36, 'upload/2021062115313920210619103122钟南山.jpg', '钟南山');
INSERT INTO `images` VALUES (37, 'upload/20210713153458songyingxing.jpg', '宋应星');
INSERT INTO `images` VALUES (39, 'upload/20210713153938chengkaijia.jpg', '程开甲');
INSERT INTO `images` VALUES (40, 'upload/20210713161920qianxuesen.jpg', '钱学森');
INSERT INTO `images` VALUES (41, 'upload/20210713162106yumin.jpg', '于敏');
INSERT INTO `images` VALUES (42, 'upload/20210713162309linming.jpg', '林鸣');
INSERT INTO `images` VALUES (43, 'upload/20210713162354malijuli.jpg', '玛丽·居里');
INSERT INTO `images` VALUES (44, 'upload/20210713162937yuanlongping.jpg', '袁隆平');
INSERT INTO `images` VALUES (45, 'upload/20210713163056qibaishi.jpg', '齐白石');
INSERT INTO `images` VALUES (46, 'upload/20210713163229tuyouyou.jpg', '屠呦呦');
INSERT INTO `images` VALUES (47, 'upload/20210713163309wumengchao.jpg', '吴孟超');
INSERT INTO `images` VALUES (48, 'upload/20210713163406yangchongrui.jpg', '杨崇瑞');
INSERT INTO `images` VALUES (50, 'upload/20210713163559yegongshao.jpg', '叶恭绍');
INSERT INTO `images` VALUES (51, 'upload/20210713163650linqiaozhi.jpg', '林巧稚');
INSERT INTO `images` VALUES (52, 'upload/20210713163750wuliande.jpg', '伍连德');

SET FOREIGN_KEY_CHECKS = 1;
