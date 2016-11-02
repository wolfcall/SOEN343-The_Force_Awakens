<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

include "ReservationDomain.php";
include "ReservationTDG.php";

class ReservationMapper
{
	private $reservationActive;
	private $reservationData;
		
	public function __construct() {

		$this->reservationActive = new ReservationDomain();
		$this->reservationData = new ReservationTDG();
	}
	
	
	public function addReservation($sID, $rID, $start, $end, $title, $desc){
		$this->reservationData->addReservation($sID, $rID, $start, $end, $title, $desc);
    }	
	
	/* Set methods for the Reservation Domain object
	*/
	public function setREID($reID){
		$this->reservationActive->setREID($reID);
    }
    
    public function setSID($sID) {
        $this->reservationActive->setSID($sID);
    }
    
    public function setRID($rID) {
        $this->reservationActive->setRID($rID);
    }
	
	public function setStartTimeDate($start) {
        $this->reservationActive->setStartTimeDate($start);
    }	
	
	public function setEndTimeDate($end) {
        $this->reservationActive->setEndTimeDate($end);
    }
	
	public function setTitle($title) {
        $this->reservationActive->setTitle($title);
    }
	
	public function setDescription($desc) {
		$this->reservationActive->setDescription($desc);
    }
	
	/* Get methods for the Reservation Domain object
	*/
	
	/*	The REID takes the sID as a parameter so it can find the appropriate information of the student's reservation
	*	Only get from the database
	*/
	public function getREID($sID){
		return $this->reservationData->getREID($sID);
    }
    
    public function getSID($reID) {
        return $this->reservationActive->getSID();
    }
    
    public function getRID($reID) {
        return $this->reservationActive->getRID();
    }
	
	public function getStartTimeDate($reID) {
        return $this->reservationActive->getStartTimeDate();
    }	
	
	public function getEndTimeDate($reID) {
        return $this->reservationActive->getEndTimeDate();
    }
	
	public function getTitle($reID) {
        return $this->reservationActive->getTitle();
    }
	
	public function getDescription($reID) {
        return $this->reservationActive->getDescription();
    }
	
	/*	Update methods for the Reservation TDG and Domain objects
	*/
	public function updateReservationID($reID, $new){
		$this->reservationData->updateReservationID($reID, $new);
		$this->reservationActive->setREID($new);
    }
	
	public function updateStudentID($reID, $sID){
		$this->reservationData->updateStudentID($reID, $sID);
		$this->reservationActive->setSID($sID);
    }
	
	public function updateRoomID($reID, $rID){
		$this->reservationData->updateRoomID($reID, $rID);
		$this->reservationActive->setRID($rID);
    }
	
	public function updateStart($reID, $start){
		$this->reservationData->updateStart($reID, $start);
		$this->reservationActive->setStartTimeDate($start);
    }
	
	public function updateEnd($reID, $end){
		$this->reservationData->updateEnd($reID, $end);
		$this->reservationActive->setEndTimeDate($end);
    }
	
	public function updateTitle($reID, $title){
		$this->reservationData->updateTitle($reID, $title);
		$this->reservationActive->setTitle($title);
    }
	
	public function updateDescription($reID, $desc){
		$this->reservationData->updateDescription($reID, $desc);
		$this->reservationActive->setDescription($desc);
    }	
}
?>
