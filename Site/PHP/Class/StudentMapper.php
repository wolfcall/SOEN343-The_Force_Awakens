<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

include "StudentDomain.php";
include "StudentTDG.php";

class StudentMapper
{
	private $studentActive;
	private $studentData;
		
	/* 
	*	Constructors for the Student Mapper object
	*	If the parameter is null, the student is logging in from the Index page
	*	In which case they simply need access to the checkUserAndPass or checkUserExist methods
	*	No variables need to be instantiated until they actually log in
	*/
	public function __construct($email) {

		if(empty($email))
		{
			$this->studentActive = new StudentDomain();
			$this->studentData = new StudentTDG();
		}
		else
		{
			$this->studentActive = new StudentDomain();
			$this->studentData = new StudentTDG();
		
			$this->setFirstName($this->studentData->getFirstName($email));
			$this->setLastName($this->studentData->getLastName($email));
			$this->setEmailAddress($email);
			$this->setProgram($this->studentData->getProgram($email));
			$this->setSID($this->studentData->getSID($email));			
		}
	}

	public function checkUserAndPass($email, $pass){
		return $this->studentData->checkUserAndPass($email, $pass); 
	}
	
	public function checkUserExist($email){
		return $this->studentData->checkUserExist($email);
	}
	
	/* Set methods for the Student Domain object
	*/
	public function setFirstName($first){
		$this->studentActive->setFirstName($first);
    }
    
    public function setLastName($last){
		$this->studentActive->setLastName($last);
    }
    
    public function setEmailAddress($new) {
        $this->studentActive->setEmailAddress($new);
    }
    
    public function setProgram($program) {
        $this->studentActive->setProgram($program);
    }
	
	public function setSID($sID) {
        $this->studentActive->setSID($sID);
    }
	
	/* Get methods for the Student Domain object
	*/
	public function getFirstName(){
		return $this->studentActive->getFirstName();
    }
    
    public function getLastName(){
		return $this->studentActive->getLastName();
    }
    
    public function getEmailAddress() {
        return $this->studentActive->getEmailAddress();
    }
    
    public function getProgram() {
        return $this->studentActive->getProgram();
    }
	
	public function getSID() {
        return $this->studentActive->getSID();
    }
		
	/*	Update methods for the Student TDG and Domain objects
	*/
	public function updateFirstName($email, $first){
		$this->studentData->updateFirstName($email, $first);
		$this->setFirstName($first);
    }
    
    public function updateLastName($email,$last){
		$this->studentData->updateLastName($email, $last);
		$this->setLastName($last);
    }
    
    public function updateEmailAddress($email, $new) {
        $this->studentData->updateEmailAddress($email, $new);
		$this->setEmailAddress($new);
    }
    
    public function updateProgram($email, $program) {
        $this->studentData->updateProgram($email,$program);
		$this->setProgram($program);
    }
	
	public function updateSID($email, $sID) {
        $this->studentData->updateSID($email, $sID);
		$this->setSID($sID);
    }
    
    public function updatePassword($email, $oldPass, $newPass) {
        $this->studentData->updatePassword($email, $oldPass, $newPass);
    }
}
?>
