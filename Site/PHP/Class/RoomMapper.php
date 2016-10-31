<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

include_once dirname(__FILE__).'StudentDomain.php';
include_once dirname(__FILE__).'StudentTDG.php';

class StudentMapper
{
	student = new StudentDomain();
    studentData = new StudentTDG();
	
	/* Constructors for the Student Mapper object
	
	public function __construct($email) {

		$conn = getServerConn();
		
		$sql = "SELECT * FROM student WHERE email ='".$this->getEmailAddress()."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$student->setFirstName($row["firstName"]);
		$student->setLastName($row["lastName"]);
		$student->setEmailAddress($row["email"]);
		$student->setProgram($row["program"]);
		$student->setSID($row["studentID"]);
		
		closeServerConn($conn);
	}
	*/
	/* Get methods for the Student Domain object
	*/
	public function getFirstName(){
		return $student->getFirstName();
    }
    
    public function getLastName(){
		return $student->getLastName();
    }
    
    public function getEmailAddress() {
        return $studnet->getEmailAddress();
    }
    
    public function getProgram() {
        return $student->getProgram();
    }
	
	public function getSID() {
        return $student->getSID();
    }
	
	/* Set methods for the Student Domain object
	*/
	public function setFirstName($email, $first){
		$studentData->updateFirstName($email, $first);
		$student->setFirstName($first);
    }
    
    public function setLastName($last){
		$studentData->updateFirstName($email, $last);
		$student->setLastName($last);
    }
    
    public function setEmailAddress($email, $new) {
        $studentData->updateEmailAddress($email, $new);
		$student->setEmailAddress($new);
    }
    
    public function setProgram($email, $program) {
        $studentData->updateProgram($email,$program);
		$student->setProgram($program);
    }
	
	public function setSID($email, $sID) {
        $studentData->updateSID($email, $sID);
		$student->setSID($sID);
    }
}
