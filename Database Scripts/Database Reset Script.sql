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
  `waitlisted` boolean default false,
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


set global event_scheduler = on;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

Drop event if exists soen343.`past_reservation_cleanup`;
CREATE EVENT IF NOT EXISTS soen343.`past_reservation_cleanup`
ON SCHEDULE
  EVERY 1 DAY
  Starts curdate() + interval 6 - weekday(curdate()) DAY
  COMMENT 'Clean up past reservations at 1AM!'
  DO
    DELETE FROM soen343.reservation
    where soen343.reservation.endTimeDate < sysdate();

Insert into `soen343`.`Student` (studentID, FirstName, LastName, `password`, email, program) values (26863477,'Georges','Mathieu',password('pass123'),'gm@email.com', 'Software Engineering');
Insert into `soen343`.`Student` (studentID, FirstName, LastName, `password`, email, program) values (27454716,'Stefano','Pace',password('pass123'),'sp@email.com', 'Software Engineering');
Insert into `soen343`.`Student` (studentID, FirstName, LastName, `password`, email, program) values (27228805,'Olivier','Cameron-Chevrier',password('pass123'),'oc@email.com', 'Software Engineering');
Insert into `soen343`.`Student` (studentID, FirstName, LastName, `password`, email, program) values (29613773,'Nicholas','Burdet',password('pass123'),'nb@email.com', 'Software Engineering');
Insert into `soen343`.`Student` (studentID, FirstName, LastName, `password`, email, program) values (27513062,'Joey','Tedeschi',password('pass123'),'jt@email.com', 'Software Engineering');
Insert into `soen343`.`Student` (studentID, FirstName, LastName, `password`, email, program) values (27419112,'Julian','Ippolito',password('pass123'),'jp@email.com', 'Software Engineering');
Insert into `soen343`.`Student` (studentID, FirstName, LastName, `password`, email, program) values (27459157,'Adam','Trudeau-Acaro',password('123'),'aa@email.com', 'Software Engineering');

Insert into `soen343`.`room` (name, location, description) values ('California', 'H9327', 'Beautiful');
Insert into `soen343`.`room` (name, location, description) values ('Hawaii', 'H9337', 'Beautiful');
Insert into `soen343`.`room` (name, location, description) values ('Iowa', 'H9323', 'Beautiful');
Insert into `soen343`.`room` (name, location, description) values ('Florida', 'H9345', 'Beautiful');
Insert into `soen343`.`room` (name, location, description) values ('Nevada', 'H9822', 'Beautiful');
/*Insert into `soen343`.`room` (name, location, description) values ('New Mexico', 'H9312', 'Beautiful');
Insert into `soen343`.`room` (name, location, description) values ('New York', 'H9145', 'Beautiful');
Insert into `soen343`.`room` (name, location, description) values ('Texas', 'H9311', 'Beautiful');
Insert into `soen343`.`room` (name, location, description) values ('Oklahoma', 'H9312', 'Beautiful');
Insert into `soen343`.`room` (name, location, description) values ('Maine', 'H9329', 'Beautiful');*/

Insert into `soen343`.`reservation` (studentID, roomId, startTimeDate, endTimeDate, title, description)
	values (26863477, 1, STR_TO_DATE('12/11/2016 13:00:00', '%d/%m/%Y %T'), STR_TO_DATE('12/11/2016 17:00:00', '%d/%m/%Y %T'), ';lkhdsa','dodoahohj');
    Insert into `soen343`.`reservation` (studentID, roomId, startTimeDate, endTimeDate, title, description)
	values (26863477, 2, STR_TO_DATE('13/11/2016 13:00:00', '%d/%m/%Y %T'), STR_TO_DATE('13/11/2016 14:00:00', '%d/%m/%Y %T'), ';lkhdsa','fdsa');
    Insert into `soen343`.`reservation` (studentID, roomId, startTimeDate, endTimeDate, title, description)
	values (26863477, 5, STR_TO_DATE('13/11/2016 13:00:00', '%d/%m/%Y %T'), STR_TO_DATE('13/11/2016 15:00:00', '%d/%m/%Y %T'), ';lkhdsa','sfd');
    