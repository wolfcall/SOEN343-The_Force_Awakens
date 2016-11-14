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
	
	//Verify User Credentials
    public function checkUserAndPass($email, $pass, $conn){
		
		$sql = "SELECT studentId, email, password FROM student WHERE email ='".$email."' AND password = password('".$pass."')";
		$result = $conn->query($sql);
		
		if ($result->num_rows == 1){
			$row = $result->fetch_assoc();
			return $row["studentId"];
		}else 
			return false;
	}
	
	//Verify User exsitence in the db
	public function checkUserExist($email, $conn){
		
		$sql = "SELECT * FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0)
			return true;
		else 
			return false;
	}
		
	/* 
		The Get methods for all Entities in the Student table can be found here
    */
    public function getFirstName($email, $conn){
		
		$sql = "SELECT firstName FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		return $row["firstName"];
    }
    
    public function getLastName($email, $conn) {
		
		$sql = "SELECT lastName FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		return $row["lastName"];
    }
  
    public function getEmailAddress($email, $conn) {
		
		$sql = "SELECT email FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		return $row["email"];
    }
    
    public function getProgram($email, $conn) {
		
		$sql = "SELECT program FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		return $row["program"];
    }
	
	public function getSID($email, $conn) {
		
		$sql = "SELECT studentID FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		return $row["studentID"];
    }
	
	public function getPassword($email, $conn) {
		
		$sql = "SELECT password FROM student WHERE email ='".$email."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		return $row["password"];
    }
	
	/* The Update methods for all Entities in the Student table can be found here
     */
    public function updateFirstName($email, $first, $conn) {
		
		$sql = "Update student SET firstName ='".$first."' WHERE email ='".$email."'";
		$result = $conn->query($sql);
    }
    
    public function updateLastName($email, $last, $conn) {
		
		$sql = "Update student SET lastName ='".$last."' WHERE email ='".$email."'";
		$result = $conn->query($sql);
    }
  
    public function updateEmailAddress($email, $new, $conn) {
		
		$sql = "Update student SET email ='".$new."' WHERE email ='".$email."' ";
		$result = $conn->query($sql);
    }
    
    public function updateProgram($email, $program, $conn) {
		
		$sql = "Update student SET program ='".$program."' WHERE email ='".$email."'";
		$result = $conn->query($sql);
    }
	
	public function updateSID($email, $id, $conn) {
		
		$sql = "Update student SET studentID ='".$id."' WHERE email ='".$email."'";
		$result = $conn->query($sql);
    }
	
	/*
		Should be called by a changedetails.php file
		Should validate previous password to set new one
	*/
	public function updatePassword($email, $oldPass, $newPass, $conn) {
		
		$sql = "Update student SET password = password('".$newPass."') WHERE email ='".$email."' AND password = password('".$oldPass."')";
		$result = $conn->query($sql);
		
		if ($conn->affected_rows > 0)
		{
			$string = "Password Updated Successfully";
			$_SESSION["msgClass"] = "success";
		}
		else
		{
			$string = "Your current Password is not the one you entered. Please try again!";
			$_SESSION["msgClass"] = "failure";
		}
		return $string;
    }
}
?>