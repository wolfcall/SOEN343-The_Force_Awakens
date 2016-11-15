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
	
	public function addReservation($sID, $rID, $start, $end, $title, $desc, $conn, $wait){
		$this->reservationData->addReservation($sID, $rID, $start, $end, $title, $desc, $conn, $wait);
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
	public function getReservation($reID, $conn){
		return $this->reservationData->getReservation($reID, $conn);
	}
	
	public function getREID($sID, $conn){
		return $this->reservationData->getREID($sID, $conn);
    }
    
    public function getSID($reID){
        return $this->reservationActive->getSID($reID);
    }
    
    public function getRID($reID){
        return $this->reservationActive->getRID($reID);
    }
	
	public function getStartTimeDate($reID){
        return $this->reservationActive->getStartTimeDate($reID);
    }	
	
	public function getEndTimeDate($reID){
        return $this->reservationActive->getEndTimeDate($reID);
    }
	
	public function getTitle($reID){
       return $this->reservationActive->getTitle($reID);
    }
	
	public function getDescription($reID){
        return $this->reservationActive->getDescription($reID);
    }
    
	public function getReservations($sID, $conn){
		return $this->reservationData->getReservations($sID, $conn);
	}

	public function getReservationsByDate($start, $conn) {
		return $this->reservationData->getReservationsByDate($start, $conn);
	}

	public function getReservationsByRoomAndDate($rID, $start, $conn) {
		return $this->reservationData->getReservationsByRoomAndDate($rID, $start, $conn);
	}
	
	/*	Update methods for the Reservation TDG and Domain objects
	*/
	public function updateReservationID($reID, $new, $conn){
		$this->reservationData->updateReservationID($reID, $new, $conn);
		$this->reservationActive->setREID($new);
    }
	
	public function updateStudentID($reID, $sID, $conn){
		$this->reservationData->updateStudentID($reID, $sID, $conn);
		$this->reservationActive->setSID($sID);
    }
	
	public function updateRoomID($reID, $rID, $conn){
		$this->reservationData->updateRoomID($reID, $rID, $conn);
		$this->reservationActive->setRID($rID);
    }
	
	public function updateStart($reID, $start, $conn){
		$this->reservationData->updateStart($reID, $start, $conn);
		$this->reservationActive->setStartTimeDate($start);
    }
	
	public function updateEnd($reID, $end, $conn){
		$this->reservationData->updateEnd($reID, $end, $conn);
		$this->reservationActive->setEndTimeDate($end);
    }
	
	public function updateTitle($reID, $title, $conn){
		$this->reservationData->updateTitle($reID, $title, $conn);
		$this->reservationActive->setTitle($title);
    }
	
	public function updateDescription($reID, $desc, $conn){
		$this->reservationData->updateDescription($reID, $desc, $conn);
		$this->reservationActive->setDescription($desc);
    }	
	
	public function deleteReservation($reID, $conn) {
			$this->reservationData->deleteReservation($reID, $conn);
	}
}
?>
