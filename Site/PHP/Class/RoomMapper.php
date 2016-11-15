<?php

// Start the session
session_start();
include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

include "RoomDomain.php";
include "RoomTDG.php";

class RoomMapper
{
	private $roomActive;
	private $roomData;
		
	/* 
		Constructors for the Student Mapper object
	*/
        
	public function __construct($rID, $conn) {

		$this->roomActive = new RoomDomain();
		$this->roomData = new RoomTDG();
		
		//$conn = getServerConn();
						
		$this->roomActive->setName($this->roomData->getName($rID, $conn));
		$this->roomActive->setLocation($this->roomData->getLocation($rID, $conn));
		$this->roomActive->setDescription($this->roomData->getDescription($rID, $conn));
		$this->roomActive->setRID($rID);
				
		//closeServerConn($conn);
	}
	
	/* Get methods for the Student Domain object
	*/
	public function getName(){
		return $this->roomActive->getName();
    }
    
    public function getLocation() {
        return $this->roomActive->getLocation();
    }
    
    public function getDescription() {
        return $this->roomActive->getDescription();
    }
	 
	public function getRID(){
		return $this->roomActive->getRID();
    }
    
    public function getRoomName($rID){
        return $this->roomActive->getName($rID);
    }
    
    public function getRoomLocation($rID){
        return $this->roomActive->getLocation($rID);
    }
	
	public function checkBusy($rID, $conn){
        return $this->roomData->checkBusy($rID, $conn);
    }
	
	public function setBusy($status, $rID, $conn){
        return $this->roomData->setBusy($status, $rID, $conn);
    }
}
?>
