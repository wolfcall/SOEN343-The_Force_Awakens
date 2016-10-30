-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema soen343
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `soen343` ;

-- -----------------------------------------------------
-- Schema soen343
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `soen343` DEFAULT CHARACTER SET utf8 ;
USE `soen343` ;

-- -----------------------------------------------------
-- Table `soen343`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `soen343`.`student` ;

CREATE TABLE IF NOT EXISTS `soen343`.`student` (
  `studentID` INT(11) NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(45) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(70) NOT NULL,
  `program` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`studentID`),
  UNIQUE INDEX `email` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `soen343`.`room`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `soen343`.`room` ;

CREATE TABLE IF NOT EXISTS `soen343`.`room` (
  `name` VARCHAR(10) NOT NULL,
  `roomID` INT(11) NOT NULL AUTO_INCREMENT,
  `location` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45),
  PRIMARY KEY (`roomID`),
  UNIQUE INDEX `id_UNIQUE` (`roomID` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'This is the table to store Room object data.\nRoom objects will only be created at the time the first reservation is created';


-- -----------------------------------------------------
-- Table `soen343`.`reservation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `soen343`.`reservation` ;

CREATE TABLE IF NOT EXISTS `soen343`.`reservation` (
  `reservationID` INT(11) NOT NULL AUTO_INCREMENT,
  `studentID` INT(11) NOT NULL,
  `roomID` INT(11) NOT NULL,
  `startTimeDate` DATETIME NOT NULL,
  `endTimeDate` DATETIME NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`reservationID`),
  UNIQUE INDEX `reservationID_UNIQUE` (`reservationID` ASC),
  INDEX `fk_reservation_student_idx` (`studentID` ASC),
  INDEX `fk_reservation_room1_idx` (`roomID` ASC),
  CONSTRAINT `fk_reservation_student`
    FOREIGN KEY (`studentID`)
    REFERENCES `soen343`.`student` (`studentID`)
    ON DELETE cascade
    ON UPDATE cascade,
  CONSTRAINT `fk_reservation_room1`
    FOREIGN KEY (`roomID`)
    REFERENCES `soen343`.`room` (`roomID`)
    ON DELETE cascade
    ON UPDATE cascade)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Room reservations will be stored here\nWill be associated to the ID of the user who instantiated the reservation\nWill be associated to the ID of the room it will take place';


-- -----------------------------------------------------
-- Table `soen343`.`waitlist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `soen343`.`waitlist` ;

CREATE TABLE IF NOT EXISTS `soen343`.`waitlist` (
  `roomID` INT(11) NOT NULL,
  `waitlistID` INT(11) NOT NULL,
  `startTimeDate` DATETIME NOT NULL,
  `endTimeDate` DATETIME NOT NULL,
  `studentID` INT(11) NOT NULL,
  PRIMARY KEY (`waitlistID`),
  INDEX `fk_waitlist_room1_idx` (`roomID` ASC),
  INDEX `fk_waitlist_student1_idx` (`studentID` ASC),
  CONSTRAINT `fk_waitlist_room1`
    FOREIGN KEY (`roomID`)
    REFERENCES `soen343`.`room` (`roomID`)
    ON DELETE cascade
    ON UPDATE cascade,
  CONSTRAINT `fk_waitlist_student1`
    FOREIGN KEY (`studentID`)
    REFERENCES `soen343`.`student` (`studentID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'This will store the waitlist for specific rooms\nWill have an association to UserID who is on the waiting list\nWill have an association to roomID that the user is waiting for';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

Insert into `soen343`.`Student` (FirstName, LastName, `password`, email, program) values ('Georges','Mathieu',password('pass123'),'gm@email.com', 'SOEN' );
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email, program) values ('Stephano','Pace',password('pass123'),'sp@email.com', 'SOEN' );
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email, program) values ('Olivier','C',password('pass123'),'oc@email.com', 'SOEN' );
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email, program) values ('Nicholas','Burdet',password('pass123'),'nb@email.com', 'SOEN' );
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email, program) values ('Joey','T',password('pass123'),'jt@email.com', 'SOEN' );
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email, program) values ('Julien','P',password('pass123'),'jp@email.com', 'SOEN' );
Insert into `soen343`.`Student` (FirstName, LastName, `password`, email, program) values ('Adam','Acaro',password('123'),'aa@email.com', 'SOEN' );

Insert into `soen343`.`room` (name, location) values ('California', 'H9327');
Insert into `soen343`.`room` (name, location) values ('Hawaii', 'H9337');
Insert into `soen343`.`room` (name, location) values ('Iowa', 'H9323');
Insert into `soen343`.`room` (name, location) values ('Florida', 'H9345');
Insert into `soen343`.`room` (name, location) values ('Navada', 'H9822');
Insert into `soen343`.`room` (name, location) values ('New Mexico', 'H9312');
Insert into `soen343`.`room` (name, location) values ('New York', 'H9145');
Insert into `soen343`.`room` (name, location) values ('Texas', 'H9311');
Insert into `soen343`.`room` (name, location) values ('Oklahoma', 'H9312');
Insert into `soen343`.`room` (name, location) values ('Maine', 'H9329');
