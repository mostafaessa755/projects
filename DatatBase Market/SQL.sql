/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : pandamarket

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 01/10/2019 18:53:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `CatID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CatName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Priority` int(11) NOT NULL,
  PRIMARY KEY (`CatID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for favorite
-- ----------------------------
DROP TABLE IF EXISTS `favorite`;
CREATE TABLE `favorite`  (
  `ProID` int(11) UNSIGNED NOT NULL,
  `UserID` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`ProID`, `UserID`) USING BTREE,
  INDEX `UserID`(`UserID`) USING BTREE,
  CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`ProID`) REFERENCES `products` (`ProID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for orderdatails
-- ----------------------------
DROP TABLE IF EXISTS `orderdatails`;
CREATE TABLE `orderdatails`  (
  `Price` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Reqcomment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Rating` int(11) NOT NULL,
  `ProID` int(11) UNSIGNED NOT NULL,
  `OrderID` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`ProID`, `OrderID`) USING BTREE,
  INDEX `OrderID`(`OrderID`) USING BTREE,
  CONSTRAINT `orderdatails_ibfk_1` FOREIGN KEY (`ProID`) REFERENCES `products` (`ProID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `orderdatails_ibfk_2` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `OrderID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `OrderDate` date NOT NULL,
  `ShipID` int(11) UNSIGNED NOT NULL,
  `InfID` int(11) UNSIGNED NOT NULL,
  `UserID` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`OrderID`) USING BTREE,
  INDEX `ShipID`(`ShipID`) USING BTREE,
  INDEX `InfID`(`InfID`) USING BTREE,
  INDEX `UserID`(`UserID`) USING BTREE,
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ShipID`) REFERENCES `shippingmethods` (`ShipID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`InfID`) REFERENCES `shippinginfo` (`InfID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `ProID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ProName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Price` int(11) NOT NULL,
  `QtyReq` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Priority` int(11) NOT NULL,
  PRIMARY KEY (`ProID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for productscategories
-- ----------------------------
DROP TABLE IF EXISTS `productscategories`;
CREATE TABLE `productscategories`  (
  `CatID` int(11) UNSIGNED NOT NULL,
  `ProID` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`CatID`, `ProID`) USING BTREE,
  INDEX `ProID`(`ProID`) USING BTREE,
  CONSTRAINT `productscategories_ibfk_1` FOREIGN KEY (`CatID`) REFERENCES `categories` (`CatID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `productscategories_ibfk_2` FOREIGN KEY (`ProID`) REFERENCES `products` (`ProID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shippinginfo
-- ----------------------------
DROP TABLE IF EXISTS `shippinginfo`;
CREATE TABLE `shippinginfo`  (
  `InfID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `PhoneNumber` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `City` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Country` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UserID` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`InfID`) USING BTREE,
  UNIQUE INDEX `PhoneNumber`(`PhoneNumber`) USING BTREE,
  INDEX `UserID`(`UserID`) USING BTREE,
  CONSTRAINT `shippinginfo_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shippingmethods
-- ----------------------------
DROP TABLE IF EXISTS `shippingmethods`;
CREATE TABLE `shippingmethods`  (
  `ShipID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ShipName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Price` int(11) NOT NULL,
  PRIMARY KEY (`ShipID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for shoppingcart
-- ----------------------------
DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE `shoppingcart`  (
  `Quantity` int(11) NOT NULL,
  `ProID` int(11) UNSIGNED NOT NULL,
  `UserID` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`ProID`, `UserID`) USING BTREE,
  INDEX `UserID`(`UserID`) USING BTREE,
  CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`ProID`) REFERENCES `products` (`ProID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `shoppingcart_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for specification
-- ----------------------------
DROP TABLE IF EXISTS `specification`;
CREATE TABLE `specification`  (
  `specID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Details` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ProID` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`specID`, `ProID`) USING BTREE,
  INDEX `ProID`(`ProID`) USING BTREE,
  CONSTRAINT `specification_ibfk_1` FOREIGN KEY (`ProID`) REFERENCES `products` (`ProID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `statID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `StatusDate` date NOT NULL,
  `OrderID` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`statID`, `OrderID`) USING BTREE,
  INDEX `OrderID`(`OrderID`) USING BTREE,
  CONSTRAINT `status_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `UserID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Gender` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BirthDate` date NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`UserID`) USING BTREE,
  UNIQUE INDEX `UserName`(`UserName`) USING BTREE,
  UNIQUE INDEX `Email`(`Email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for verification
-- ----------------------------
DROP TABLE IF EXISTS `verification`;
CREATE TABLE `verification`  (
  `VerifCode` int(11) NOT NULL,
  `VerifType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `VerifDate` date NOT NULL,
  `UserID` int(11) UNSIGNED NOT NULL,
  UNIQUE INDEX `VerifCode`(`VerifCode`) USING BTREE,
  INDEX `UserID`(`UserID`) USING BTREE,
  CONSTRAINT `verification_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
