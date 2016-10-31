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
		
		$this->studentActive->setFirstName($row["firstName"]);
		$this->studentActive->setLastName($row["lastName"]);
		$this->studentActive->setEmailAddress($row["email"]);
		$this->studentActive->setProgram($row["program"]);
		$this->studentActive->setSID($row["studentID"]);
		
		closeServerConn($conn);
	}
	
	public function getTest(){
		return $this->test;
    }
	
	/* Set methods for the Student Domain object
	*/
	public function setFirstName($first){
		$this->$studentActive->setFirstName($first);
    }
    
    public function setLastName($last){
		$this->$studentActive->setLastName($last);
    }
    
    public function setEmailAddress($new) {
        $this->$studentActive->setEmailAddress($new);
    }
    
    public function setProgram($program) {
        $this->$studentActive->setProgram($program);
    }
	
	public function setSID($sID) {
        $this->$studentActive->setSID($sID);
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
	
	public function updateFirstName($email, $first){
		$studentData->updateFirstName($email, $first);
		$studentActive->setFirstName($first);
    }
    
    public function updateLastName($last){
		$studentData->updateFirstName($email, $last);
		$studentActive->setLastName($last);
    }
    
    public function updateEmailAddress($email, $new) {
        $studentData->updateEmailAddress($email, $new);
		$studentActive->setEmailAddress($new);
    }
    
    public function updateProgram($email, $program) {
        $studentData->updateProgram($email,$program);
		$studentActive->setProgram($program);
    }
	
	public function updateSID($email, $sID) {
        $studentData->updateSID($email, $sID);
		$studentActive->setSID($sID);
    }*/
}
?>
