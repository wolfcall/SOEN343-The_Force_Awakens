<?php

// Start the session
session_start();

class StudentDomain
{
	private $firstName = "";
    private $lastName = "";
    private $emailAddress = "";
    private $program = "";
	private $sID = "";
	
	/*
		No Default Constructor is Necessary for this class
	*/
	
	/* Get methods for the Student Domain object
	*/
	public function getFirstName(){
		return $this->firstName;
    }
    
    public function getLastName(){
		return $this->lastName;
    }
    
    public function getEmailAddress() {
        return $this->emailAddress;
    }
    
    public function getProgram() {
        return $this->program;
    }
	
	public function getSID() {
        return $this->sID;
    }
	
	/* Set methods for the Student Domain object
	*/
	public function setFirstName($first){
		$this->firstName = $first;
    }
    
    public function setLastName($last){
		$this->lastName = $last;
    }
    
    public function setEmailAddress($email) {
        $this->emailAddress = $email;
    }
    
    public function setProgram($program) {
        $this->program = $program;
    }
	
	public function setSID($sID) {
        $this->sID = $sID;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
}
?>