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

Insert into `soen343`.`Student` (FirstName, LastName, `password`, email) values ('Georges','Mathieu',password('pass123'),'gm@email.com');
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email) values ('Stephano','Pace',password('pass123'),'sp@email.com');
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email) values ('Olivier','C',password('pass123'),'oc@email.com');
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email) values ('Nicholas','Burdet',password('pass123'),'nb@email.com');
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email) values ('Joey','T',password('pass123'),'jt@email.com');
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email) values ('Julien','P',password('pass123'),'jp@email.com');
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email) values ('Adam','Acaro',password('pass123'),'aa@email.com');