DROP SCHEMA IF EXISTS `POS`;
CREATE SCHEMA `POS`;
USE `POS`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

CREATE TABLE `category`(
    `ID` TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) DEFAULT NULL,
    `IMG` VARCHAR(100) DEFAULT NULL
);

-- --------------------------------------------------------

CREATE TABLE `product`(
    `ID` TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) DEFAULT NULL,
    `type` TINYINT UNSIGNED NOT NULL,
    `price` INT UNSIGNED NOT NULL DEFAULT 0,
    `nutrient` TEXT DEFAULT "Không có thông tin",
    `additives` TEXT DEFAULT "Không có thông tin",
    `decoration` TEXT DEFAULT "Không có thông tin",
    `IMG` VARCHAR(100) DEFAULT NULL,
    FOREIGN KEY(`type`) REFERENCES `category`(`ID`)
);

-- --------------------------------------------------------

CREATE TABLE `table`(
    `ID` TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(10)
);
 
-- --------------------------------------------------------

CREATE TABLE `order`(
    `ID` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `table` TINYINT UNSIGNED DEFAULT 1,
    `total_price` INT DEFAULT 0,
    `status` TINYINT CHECK (`status` IN (0,1)),
    `payment_date` CHAR(10),
    FOREIGN KEY(`table`) REFERENCES `table`(`ID`)
);

-- --------------------------------------------------------

CREATE TABLE `cart`(
    `orderID` INT UNSIGNED NOT NULL,
    `productID` TINYINT UNSIGNED NOT NULL,
    `quantity` TINYINT UNSIGNED,
    `note` TEXT DEFAULT NULL,
    `total_price` INT DEFAULT 0,
    PRIMARY KEY(`orderID`, `productID`),
    FOREIGN KEY(`orderID`) REFERENCES `order`(`ID`) ON DELETE CASCADE,
    FOREIGN KEY(`productID`) REFERENCES `product`(`ID`)
);

-- --------------------------------------------------------

CREATE TABLE `credit_card`(
    `orderID` INT UNSIGNED PRIMARY KEY,
    `cardNumber` TEXT,
    `expiryDate` CHAR(10),
    `CVV` TEXT,
    FOREIGN KEY(`orderID`) REFERENCES `order`(`ID`) ON DELETE CASCADE
);

-- --------------------------------------------------------
CREATE TABLE `ATM`(
    `orderID` INT UNSIGNED PRIMARY KEY,
    `cardNumber` TEXT,
    FOREIGN KEY(`orderID`) REFERENCES `order`(`ID`) ON DELETE CASCADE
);

-- --------------------------------------------------------
CREATE TABLE `MOMO`(
    `orderID` INT UNSIGNED PRIMARY KEY,
    `phoneNumber` CHAR(10),
    FOREIGN KEY(`orderID`) REFERENCES `order`(`ID`) ON DELETE CASCADE
);

-- --------------------------------------------------------
CREATE TABLE `ZaloPay`(
    `orderID` INT UNSIGNED PRIMARY KEY,
    `phoneNumber` CHAR(10),
    FOREIGN KEY(`orderID`) REFERENCES `order`(`ID`) ON DELETE CASCADE
);

-- --------------------------------------------------------
CREATE TABLE `cash`(
    `orderID` INT UNSIGNED PRIMARY KEY,
    FOREIGN KEY(`orderID`) REFERENCES `order`(`ID`) ON DELETE CASCADE
);

-- -----INSERT INFORMATION----------------------------------

INSERT INTO `table` (`name`) VALUES
("Mang đi"),
("Bàn 1"),
("Bàn 2"),
("Bàn 3"),
("Bàn 4");

-- --------------------------------------------------------

INSERT INTO `category` (`name`, `IMG`) VALUES
("Tất cả", "../images/allfood.png"),
("Burger","../images/hamburger.png"),
("Coca","../images/coca.png"),
("Nước ép","../images/orangejuice.png"),
("Mỳ Ý","../images/spaghetti.png"),
("Tráng miệng","../images/cake.png"),
("Kem","../images/chocolateIC.png"),
("Đồ chiên","../images/friedChicken.png");


-- --------------------------------------------------------

INSERT INTO `product` (`name`, `type`,`price`, `IMG`) VALUES
("Cheeseburger",2, 50000,"../images/hamburger.png"),
("Coca",3, 12000,"../images/coca.png"),
("Nước cam ép",4, 30000,"../images/orangejuice.png"),
("Nước chanh",4, 20000,"../images/lemonade.png"),
("Mì ý",5, 60000,"../images/spaghetti.png"),
("Mì ý đặc biệt",5, 80000,"../images/sspaghetti.png"),
("Bánh kem sô cô la",6, 40000,"../images/cake.png"),
("Kem sô cô la",7, 35000,"../images/chocolateIC.png"),
("Gà rán",8, 65000,"../images/friedChicken.png"),
("Khoai tây chiên",8, 45000,"../images/fried.png"),
("Phô mai que",8, 45000,"../images/friedCheese.png"),
("Kem trà xanh",7, 40000,"../images/greenTeaIC.png"),
("Bánh mousse mật ong",6, 45000,"../images/honeyMousse.png"),
("Hotdog Hàn Quốc",8, 55000,"../images/hotDog.png"),
("Bánh mousse chanh dây",6, 55000,"../images/lemonMousse.png"),
("Kem sữa tươi",7, 30000,"../images/milkIC.png"),
("Nước ép lựu",4, 35000,"../images/pomegranateJuice.png"),
("Kem dâu",7, 45000,"../images/strawberryIC.png"),
("Nước ép dâu tây",4, 35000,"../images/strawberryJuice.png"),
("Nước ép cà chua",4, 30000,"../images/tomatoJuice.png");


-- --------------------------------------------------------
-- temp bill
/*
INSERT INTO `order`(`status`) VALUES(0);

INSERT INTO `cart`(`orderID`, `productID`, `quantity`) VALUES
(1,1,1),
(1,2,2),
(1,6,4);
*/