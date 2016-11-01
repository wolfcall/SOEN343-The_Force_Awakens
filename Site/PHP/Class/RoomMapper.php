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
	public function __construct($rID) {

		$this->roomActive = new RoomDomain();
		$this->roomData = new RoomTDG();
		
		$conn = getServerConn();
						
		$this->roomActive->setName($this->roomData->getName($rID));
		$this->roomActive->setLocation($this->roomData->getLocation($rID));
		$this->roomActive->setDescription($this->roomData->getDescription($rID));
		$this->roomActive->setRID($rID);
				
		closeServerConn($conn);
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
}
?>
