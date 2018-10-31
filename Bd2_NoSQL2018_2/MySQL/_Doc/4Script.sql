-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema FotoDeteccionesBD
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema FotoDeteccionesBD
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `FotoDeteccionesBD` DEFAULT CHARACTER SET utf8 ;
USE `FotoDeteccionesBD` ;

-- -----------------------------------------------------
-- Table `FotoDeteccionesBD`.`Vehiculos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FotoDeteccionesBD`.`Vehiculos` ;

CREATE TABLE IF NOT EXISTS `FotoDeteccionesBD`.`Vehiculos` (
  `placa` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`placa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FotoDeteccionesBD`.`Lugares`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FotoDeteccionesBD`.`Lugares` ;

CREATE TABLE IF NOT EXISTS `FotoDeteccionesBD`.`Lugares` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FotoDeteccionesBD`.`fotodetecciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FotoDeteccionesBD`.`fotodetecciones` ;

CREATE TABLE IF NOT EXISTS `FotoDeteccionesBD`.`fotodetecciones` (
  `fecha` TIMESTAMP NOT NULL,
  `velocidad` INT NOT NULL,
  `Vehiculos_placa` VARCHAR(20) NOT NULL,
  `Lugares_id` INT NOT NULL,
  PRIMARY KEY (`fecha`, `Vehiculos_placa`, `Lugares_id`),
  INDEX `fk_fotodetecciones_Vehiculos_idx` (`Vehiculos_placa` ASC),
  INDEX `fk_fotodetecciones_Lugares1_idx` (`Lugares_id` ASC),
  CONSTRAINT `fk_fotodetecciones_Vehiculos`
    FOREIGN KEY (`Vehiculos_placa`)
    REFERENCES `FotoDeteccionesBD`.`Vehiculos` (`placa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fotodetecciones_Lugares1`
    FOREIGN KEY (`Lugares_id`)
    REFERENCES `FotoDeteccionesBD`.`Lugares` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
