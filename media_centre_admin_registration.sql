/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100139
 Source Host           : localhost:3306
 Source Schema         : apa

 Target Server Type    : MariaDB
 Target Server Version : 100139
 File Encoding         : 65001

 Date: 21/11/2019 17:42:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for media_centre_admin_registration
-- ----------------------------
DROP TABLE IF EXISTS `media_centre_admin_registration`;
CREATE TABLE `media_centre_admin_registration`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `datetime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `added by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `invite_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of media_centre_admin_registration
-- ----------------------------
INSERT INTO `media_centre_admin_registration` VALUES (19, '20, June 2019 16:00:20', 'anthony baru', '$2y$10$nd2qnZXW6OU8wGl.R0B10OECRe0.ZFm3GI0XfNQM2x.uoJDM/6yIa', 'anthonybaru@gmail.com', 'anthony', NULL, '9e6f437264dbcd37999cfa257027c195f91c9cd1a62b05b44f396bb5f3ee4b4189080d061a274e1f', '2019-06-20 16:00:20');

SET FOREIGN_KEY_CHECKS = 1;
