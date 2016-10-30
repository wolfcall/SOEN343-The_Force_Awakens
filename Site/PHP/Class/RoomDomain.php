<?php

// Start the session
session_start();

class RoomDomain
{
	private $name;
    private $location;
    private $description;
	private $rID;	
	
	/* Default Constructor for the Room Domain object
	*/
	public function __construct($name, $location, $desc, $rID) {
		$this->name = $name;
		$this->location = $location;
        $this->description = $desc;
        $this->rID = $rID;
    }
	
	/* Get methods for the Room Domain object
	*/
	public function getName(){
		return $this->name;
    }
    
    public function getLocation() {
        return $this->location;
    }
    
    public function getDescription() {
        return $this->description;
    }
	
	public function getRID() {
        return $this->rID;
    }
	
	/* Set methods for the Room Domain object
	*/
	public function setName($name){
		$this->name = $fname;
    }
    
    public function setLocation($location){
		$this->location = $location;
    }
    
    public function setDescription($desc) {
        $this->description = $desc;
    }
      
	public function setRID($rID) {
        $this->rID = $rID;
    }
}