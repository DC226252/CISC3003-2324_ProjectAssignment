CREATE SCHEMA IF NOT EXISTS `Hotel_DB` DEFAULT CHARACTER SET utf8mb3;
USE `Hotel_DB`;

CREATE TABLE IF NOT EXISTS `Hotel_DB`.`Customer` (
    `customerID` VARCHAR(64) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `contact` VARCHAR(255) NULL DEFAULT NULL,
    PRIMARY KEY (`customerID`)
);
CREATE TABLE IF NOT EXISTS `Hotel_DB`.`Staff` (
    `staffID` VARCHAR(64) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `position` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `contact` VARCHAR(255) NULL DEFAULT NULL,
    PRIMARY KEY (`staffID`)
);
CREATE TABLE IF NOT EXISTS `Hotel_DB`.`Room` (
    `roomID` VARCHAR(64) NOT NULL,
    `roomNum` VARCHAR(255) NOT NULL UNIQUE,
    `type` TINYINT UNSIGNED NOT NULL,
    `status` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`roomID`)
);
CREATE TABLE IF NOT EXISTS `Hotel_DB`.`RoomType` (
    `type` TINYINT UNSIGNED NOT NULL,
    `format` VARCHAR(255) NOT NULL,
    `price` DOUBLE UNSIGNED NOT NULL,
    `size` INT UNSIGNED NOT NULL,
    `capacity` INT UNSIGNED NOT NULL,
    `bed` VARCHAR(255) NOT NULL,
    `services` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`type`)
);
CREATE TABLE IF NOT EXISTS `Hotel_DB`.`Account` (
    `accountID` VARCHAR(64) NOT NULL,
    `customerID` VARCHAR(64) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(64) NOT NULL,
    `privilege` TINYINT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (`accountID`),
    FOREIGN KEY (`customerID`)
        REFERENCES `Hotel_DB`.`Customer` (`customerID`)
        ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE IF NOT EXISTS `Hotel_DB`.`Reservation` (
    `reservationID` VARCHAR(64) NOT NULL,
    `customerID` VARCHAR(64) NOT NULL,
    `roomID` VARCHAR(64) NOT NULL,
    `makeDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `checkinDate` TIMESTAMP NULL DEFAULT NULL,
    `checkoutDate` TIMESTAMP NULL DEFAULT NULL,
    `status` VARCHAR(255) NOT NULL,
    `price` DOUBLE UNSIGNED NOT NULL,
    PRIMARY KEY (`reservationID`),
    FOREIGN KEY (`customerID`)
        REFERENCES `Hotel_DB`.`Customer` (`customerID`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`roomID`)
        REFERENCES `Hotel_DB`.`Room` (`roomID`)
        ON DELETE CASCADE ON UPDATE RESTRICT
);