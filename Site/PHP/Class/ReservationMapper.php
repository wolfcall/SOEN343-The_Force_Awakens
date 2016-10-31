<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

include_once dirname(__FILE__).'ReservationDomain.php';
include_once dirname(__FILE__).'ReservationTDG';

class StudentMapper
{
	$reservation = new ReservationDomain();
    $reservationData = new ReservationTDG();
	
	/*
		General Constructor for the Reservation Class
	*/
	
	
	/* Get methods for the Reservation Domain object
	*/
	public function getREID(){
		return reservation->reID;
    }
    
    public function getSID() {
        return reservation->sID;
    }
    
    public function getRID() {
        return reservation->rID;
    }
	
	public function getStartTimeDate() {
        return reservation->startTimeDate;
    }	
	
	public function getEndTimeDate() {
        return reservation->endTimeDate;
    }
	
	public function getTitle() {
        return reservation->title;
    }
	
	public function getDescription() {
        return reservation->description;
    }
	
	/* Set methods for the Reservation Domain object
	*/
	public function setREID($reID){
		reservation->reID = $reID;
    }
    
    public function setSID($sID) {
        reservation->sID = $sID;
    }
    
    public function setRID($rID) {
        reservation->rID = $rID;
    }
	
	public function setStartTimeDate($start) {
        reservation->startTimeDate = $start;
    }	
	
	public function setEndTimeDate($end) {
        reservation->endTimeDate = $end;
    }
	
	public function setTitle($title) {
        reservation->title = $title;
    }
	
	public function setDescription($desc) {
		reservation->description = $desc;
    }
}
?>