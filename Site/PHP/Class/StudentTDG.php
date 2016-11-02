<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

class StudentTDG
{
	/*
		No Default Constructor is Necessary for this class
	*/
		
	/* 
		No insert methods are necessary for this class, as the Student cannot edit the information for any Room
	*/

    /* 
		The Get methods for all Entities in the Student table can be found here
    */
    public function getFirstName($email){
		
		$conn = getServerConn();
		
		$sql = "SELECT firstName FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["firstName"];
    }
    
    public function getLastName($email){
		
		$conn = getServerConn();
		
		$sql = "SELECT lastName FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["lastName"];
    }
  
    public function getEmailAddress($email){
		
		$conn = getServerConn();
		
		$sql = "SELECT email FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["email"];
    }
    
    public function getProgram($email){
		
		$conn = getServerConn();
		
		$sql = "SELECT program FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["program"];
    }
	
	public function getSID($email){
		
		$conn = getServerConn();
		
		$sql = "SELECT studentID FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["studentID"];
    }
	
	public function getPassword($email){
		
		$conn = getServerConn();
		
		$sql = "SELECT password FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["password"];
    }
	
	/* The Update methods for all Entities in the Student table can be found here
     */
    public function updateFirstName($email, $first){
		
		$conn = getServerConn();
		
		$sql = "Update student SET firstName ='".$first."' WHERE email ='".$email."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
    
    public function updateLastName($email, $last){
		
		$conn = getServerConn();
		
		$sql = "Update student SET lastName ='".$last."' WHERE email ='".$email."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
  
    public function updateEmailAddress($email, $new){
		
		$conn = getServerConn();
		
		$sql = "Update student SET email ='".$new."' WHERE email ='".$email."' ";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
    
    public function updateProgram($email, $program){
		
		$conn = getServerConn();
		
		$sql = "Update student SET program ='".$program."' WHERE email ='".$email."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	public function updateSID($email, $id){
		
		$conn = getServerConn();
		
		$sql = "Update student SET studentID ='".$id."' WHERE email ='".$email."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	/*
		Should be called by a changedetails.php file
		Should validate previous password to set new one
	*/
	public function updatePassword($email, $oldPass, $newPass) {
		
		$conn = getServerConn();
		
        $sql = "Update student SET password = password('".$newPass."') WHERE email ='".$email."' AND password = password('".$oldPass."')";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
}
?>