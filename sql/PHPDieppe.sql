-- MySQL Script generated by MySQL Workbench
-- Thu Apr  5 16:47:31 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema PHPdieppe
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema PHPdieppe
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `PHPdieppe` DEFAULT CHARACTER SET utf8 ;
USE `PHPdieppe` ;

-- -----------------------------------------------------
-- Table `PHPdieppe`.`T_ROLES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PHPdieppe`.`T_ROLES` (
  `ID_ROLE` INT NOT NULL AUTO_INCREMENT,
  `ROLLABEL` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID_ROLE`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PHPdieppe`.`T_USERS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PHPdieppe`.`T_USERS` (
  `ID_USER` INT NOT NULL AUTO_INCREMENT,
  `USERNAME` VARCHAR(45) NOT NULL,
  `USEFIRSTNAME` VARCHAR(80) NOT NULL,
  `USERMAIL` VARCHAR(200) NOT NULL,
  `USEPASSWORD` CHAR(40) NOT NULL,
  `T_ROLES_ID_ROLE` INT NOT NULL,
  PRIMARY KEY (`ID_USER`, `T_ROLES_ID_ROLE`),
  INDEX `fk_T_USERS_T_ROLES_idx` (`T_ROLES_ID_ROLE` ASC),
  CONSTRAINT `fk_T_USERS_T_ROLES`
    FOREIGN KEY (`T_ROLES_ID_ROLE`)
    REFERENCES `PHPdieppe`.`T_ROLES` (`ID_ROLE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PHPdieppe`.`T_ARTICLE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PHPdieppe`.`T_ARTICLE` (
  `ID_ARTICLE` INT NOT NULL AUTO_INCREMENT,
  `ARTTITLE` VARCHAR(200) NOT NULL,
  `ARTCHAPO` VARCHAR(200) NOT NULL,
  `ARTCONTENT` TEXT NOT NULL,
  `ARTDATETIME` DATETIME NOT NULL,
  `T_USERS_ID_USER` INT NOT NULL,
  `T_USERS_T_ROLES_ID_ROLE` INT NOT NULL,
  PRIMARY KEY (`ID_ARTICLE`, `T_USERS_ID_USER`, `T_USERS_T_ROLES_ID_ROLE`),
  INDEX `fk_T_ARTICLE_T_USERS1_idx` (`T_USERS_ID_USER` ASC, `T_USERS_T_ROLES_ID_ROLE` ASC),
  CONSTRAINT `fk_T_ARTICLE_T_USERS1`
    FOREIGN KEY (`T_USERS_ID_USER` , `T_USERS_T_ROLES_ID_ROLE`)
    REFERENCES `PHPdieppe`.`T_USERS` (`ID_USER` , `T_ROLES_ID_ROLE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PHPdieppe`.`T_CATEGORIES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PHPdieppe`.`T_CATEGORIES` (
  `ID_CATEGORIE` INT NOT NULL AUTO_INCREMENT,
  `CATLABEL` VARCHAR(120) NOT NULL,
  PRIMARY KEY (`ID_CATEGORIE`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PHPdieppe`.`T_ARTICLE_has_T_CATEGORIES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PHPdieppe`.`T_ARTICLE_has_T_CATEGORIES` (
  `T_ARTICLE_ID_ARTICLE` INT NOT NULL,
  `T_ARTICLE_T_USERS_ID_USER` INT NOT NULL,
  `T_ARTICLE_T_USERS_T_ROLES_ID_ROLE` INT NOT NULL,
  `T_CATEGORIES_ID_CATEGORIE` INT NOT NULL,
  PRIMARY KEY (`T_ARTICLE_ID_ARTICLE`, `T_ARTICLE_T_USERS_ID_USER`, `T_ARTICLE_T_USERS_T_ROLES_ID_ROLE`, `T_CATEGORIES_ID_CATEGORIE`),
  INDEX `fk_T_ARTICLE_has_T_CATEGORIES_T_CATEGORIES1_idx` (`T_CATEGORIES_ID_CATEGORIE` ASC),
  INDEX `fk_T_ARTICLE_has_T_CATEGORIES_T_ARTICLE1_idx` (`T_ARTICLE_ID_ARTICLE` ASC, `T_ARTICLE_T_USERS_ID_USER` ASC, `T_ARTICLE_T_USERS_T_ROLES_ID_ROLE` ASC),
  CONSTRAINT `fk_T_ARTICLE_has_T_CATEGORIES_T_ARTICLE1`
    FOREIGN KEY (`T_ARTICLE_ID_ARTICLE` , `T_ARTICLE_T_USERS_ID_USER` , `T_ARTICLE_T_USERS_T_ROLES_ID_ROLE`)
    REFERENCES `PHPdieppe`.`T_ARTICLE` (`ID_ARTICLE` , `T_USERS_ID_USER` , `T_USERS_T_ROLES_ID_ROLE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_T_ARTICLE_has_T_CATEGORIES_T_CATEGORIES1`
    FOREIGN KEY (`T_CATEGORIES_ID_CATEGORIE`)
    REFERENCES `PHPdieppe`.`T_CATEGORIES` (`ID_CATEGORIE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
