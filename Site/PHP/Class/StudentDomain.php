<?php

// Start the session
session_start();

class StudentDomain
{
	private $firstName;
    private $lastName;
    private $emailAddress;
    private $program;
	private $sID;	
	
	/* Default Constructor for the Student Domain object
	*/
	public function __construct($first, $last, $email, $program, $sID) {
		$this->firstName = $first;
		$this->lastName = $last;
        $this->emailAddress = $email;
        $this->program = $program;
        $this->sID = $sid;
    }
	
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
}
