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
	private $test;
	
	/* 
		Constructors for the Student Mapper object
	*/
	public function __construct($email) {

		$this->studentActive = new StudentDomain();
		$this->studentData = new StudentTDG();
		
		$conn = getServerConn();
						
		$sql = "SELECT * FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
				
		$this->setFirstName($row["firstName"]);
		$this->setLastName($row["lastName"]);
		$this->setEmailAddress($row["email"]);
		$this->setProgram($row["program"]);
		$this->setSID($row["studentID"]);
		
		closeServerConn($conn);
	}
	
	public function getTest(){
		return $this->test;
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
		
	/*	Update methods for the Student TDG object
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
}
?>
