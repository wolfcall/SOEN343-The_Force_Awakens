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
		
	public function __construct($reID) {

		$this->reservationActive = new ReservationDomain();
		$this->reservationData = new ReservationTDG();
	}	
	
	/* 
		Constructors for the Student Mapper object
	
	
	public function __construct($reID) {

		$this->reservationActive = new ReservationDomain();
		$this->reservationData = new ReservationTDG();
		
		$conn = getServerConn();
						
		$sql = "SELECT * FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
				
		$this->setFirstName($row["firstName"]);
		$this->setLastName($row["lastName"]);
		$this->setEmailAddress($row["email"]);
		$this->setProgram($row["program"]);
		$this->setSID($row["studentID"]);
		
		closeServerConn($conn);
	}
	
	*/

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
	public function getREID(){
		return $this->reservationActive->getREID();
    }
    
    public function getSID() {
        return $this->reservationActive->getSID();
    }
    
    public function getRID() {
        return $this->reservationActive->getRID();
    }
	
	public function getStartTimeDate() {
        return $this->reservationActive->getStartTimeDate();
    }	
	
	public function getEndTimeDate() {
        return $this->reservationActive->getEndTimeDate();
    }
	
	public function getTitle() {
        return $this->reservationActive->getTitle();
    }
	
	public function getDescription() {
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
