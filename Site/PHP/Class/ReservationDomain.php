<?php

// Start the session
session_start();

class ReservationDomain
{
	private $reID;	
	private $sID;	
	private $rID;
	private $startTimeDate;
	private $endTimeDate;
	private $title;
	private $description;
	
	
	/* Default Constructor for the Room Domain object
	*/
	public function __construct($reID, $sID, $rID, $start, $end, $title, $desc) {
		$this->reID = $reID;
		$this->sID = $sID;
		$this->rID = $rID;
		$this->startTimeDate = $start;
		$this->endTimeDate = $end;
		$this->title = $title;
		$this->description = $desc;
    }
	
	/* Get methods for the Room Domain object
	*/
	public function getREID(){
		return $this->reID;
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
	
	public function getTitle() {
        return $this->title;
    }
	
	public function getDescription() {
        return $this->description;
    }
	
	/* Set methods for the Room Domain object
	*/
	public function setREID($reID){
		$this->reID = $reID;
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
	
	public function setTitle($title) {
        $this->title = $title;
    }
	
	public function setDescription($desc) {
		$this->description = $desc;
    }
}