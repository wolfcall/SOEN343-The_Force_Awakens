<?php

// Start the session
session_start();

class WaitlistDomain
{
	private $wID;	
	private $sID;	
	private $rID;
	private $startTimeDate;
	private $endTimeDate;
		
	/* Default Constructor for the Room Domain object
	*/
	public function __construct($wID, $sID, $rID, $start, $end) {
		$this->wID = $wID;
		$this->sID = $sID;
		$this->rID = $rID;
		$this->startTimeDate = $start;
		$this->endTimeDate = $end;
    }
	
	/* Get methods for the Room Domain object
	*/
	public function getWID(){
		return $this->wID;
    }
    
    public function getSID() {
        return $this->sID;
    }
    
    public function getRID() {
        return $this->rID;
    }
	
	public function getStartTimeDate() {
        return $this->startTimeDate;
    }	
	
	public function getEndTimeDate() {
        return $this->endTimeDate;
    }
	
	/* Set methods for the Room Domain object
	*/
	public function setWID($wID){
		$this->wID = $wID;
    }
    
    public function setSID($sID) {
        $this->sID = $sID;
    }
    
    public function setRID($rID) {
        $this->rID = $rID;
    }
	
	public function setStartTimeDate($start) {
        $this->startTimeDate = $start;
    }	
	
	public function setEndTimeDate($end) {
        $this->endTimeDate = $end;
    }
}
?>