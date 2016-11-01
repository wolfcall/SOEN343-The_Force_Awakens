<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

include "WaitlistDomain.php";
include "WaitlistTDG.php";

class WaitlistMapper
{
	private $waitlistActive;
	private $waitlistData;
		
	public function __construct(){
		$this->waitlistActive = new WaitlistDomain();
		$this->waitlistData = new WaitlistTDG();
	}	

	public function addWaitlist($sID, $rID, $start, $end){
		$this->waitlistData->addWaitlist($sID, $rID, $start, $end);
    }	
		
	/* Set methods for the Reservation Domain object
	*/
	public function setWID($wID){
		$this->waitlistActive->setWID($wID);
    }
    
    public function setSID($sID) {
        $this->waitlistActive->setSID($sID);
    }
    
    public function setRID($rID) {
        $this->waitlistActive->setRID($rID);
    }
	
	public function setStartTimeDate($start) {
        $this->waitlistActive->setStartTimeDate($start);
    }	
	
	public function setEndTimeDate($end) {
        $this->waitlistActive->setEndTimeDate($end);
    }
	
	/* Get methods for the Reservation Domain object
	*/
	public function getWID(){
		return $this->waitlistActive->getWID();
    }
    
    public function getSID() {
        return $this->waitlistActive->getSID();
    }
    
    public function getRID() {
        return $this->waitlistActive->getRID();
    }
	
	public function getStartTimeDate() {
        return $this->waitlistActive->getStartTimeDate();
    }	
	
	public function getEndTimeDate() {
        return $this->waitlistActive->getEndTimeDate();
    }
	
	/*	Update methods for the Reservation TDG and Domain objects
	*/
	public function updateWailistID($wID, $new){
		$this->waitlistData->updateWaitlistID($wID, $new);
		$this->waitlistActive->setREID($new);
    }
	
	public function updateStudentID($reID, $sID){
		$this->waitlistData->updateStudentID($reID, $sID);
		$this->waitlistActive->setSID($sID);
    }
	
	public function updateRoomID($reID, $rID){
		$this->waitlistData->updateRoomID($reID, $rID);
		$this->waitlistActive->setRID($rID);
    }
	
	public function updateStart($reID, $start){
		$this->waitlistData->updateStart($reID, $start);
		$this->waitlistActive->setStartTimeDate($start);
    }
	
	public function updateEnd($reID, $end){
		$this->waitlistData->updateEnd($reID, $end);
		$this->waitlistActive->setEndTimeDate($end);
    }
}
?>
