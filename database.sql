-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema blog
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema blog
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8 ;
USE `blog` ;

-- -----------------------------------------------------
-- Table `blog`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `login` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `validate` TINYINT(1) NULL DEFAULT '0',
  `admin` TINYINT(1) NULL DEFAULT '0',
  `validatekey` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) VISIBLE,
  UNIQUE INDEX `mail_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `validatekey_UNIQUE` (`validatekey` ASC) VISIBLE)
  ENGINE = InnoDB
  AUTO_INCREMENT = 65
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `blog`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`post` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `excerpt` TEXT NULL DEFAULT NULL,
  `content` LONGTEXT NOT NULL,
  `lastdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_post_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_post_user1`
  FOREIGN KEY (`user_id`)
  REFERENCES `blog`.`user` (`id`))
  ENGINE = InnoDB
  AUTO_INCREMENT = 29
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `blog`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`comment` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `post_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `content` LONGTEXT NOT NULL,
  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validate` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `fk_comment_user_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_comment_post1_idx` (`post_id` ASC) VISIBLE,
  CONSTRAINT `fk_comment_post1`
  FOREIGN KEY (`post_id`)
  REFERENCES `blog`.`post` (`id`),
  CONSTRAINT `fk_comment_user`
  FOREIGN KEY (`user_id`)
  REFERENCES `blog`.`user` (`id`))
  ENGINE = InnoDB
  AUTO_INCREMENT = 282
  DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
