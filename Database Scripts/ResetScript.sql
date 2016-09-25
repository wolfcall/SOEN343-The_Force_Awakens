Drop schema if exists soen343;
Create schema Soen343;

-- -----------------------------------------------------
-- Table `soen341`.`Student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soen343`.`Student` (
  `idStudent` INT NOT NULL AUTO_INCREMENT,
  `FirstName` VARCHAR(45) NOT NULL,
  `LastName` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(70) UNIQUE NOT NULL,
  PRIMARY KEY (`idStudent`))
ENGINE = InnoDB;