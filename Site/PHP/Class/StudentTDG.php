<?php

// Start the session
session_start();

include dirname(__FILE__)."StudentMapper";

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
	
	/* 
		The Update methods for all Entities in the Student table can be found here
		Student ID cannot be updated
		First Name cannot be updated
		Last Name cannot be updated
		Program cannot be updated
     */

    public function updateEmailAddress($email, $new, $conn) {
		
		$sql = "Update student SET email ='".$new."' WHERE email ='".$email."' ";
		$result = $conn->query($sql);
    }
	
	//	Should be called by a changedetails.php file
	//	Should validate previous password to set new one
	
	public function updatePassword($email, $oldPass, $newPass, $conn) {
		
		$sql = "Update student SET password = password('".$newPass."') WHERE email ='".$email."' AND password = password('".$oldPass."')";
		$result = $conn->query($sql);
		
		if ($conn->affected_rows > 0)
		{
			$_SESSION["msgClass"] = "success";
			return true;
		}
		else
		{
			$_SESSION["msgClass"] = "failure";
			return false;
		}
    }
	
	//Encrypt password for local storing	
	public function hashPassword($pass, $conn){
		
		var_dump("deeper");
		echo "<br>";
		
		var_dump(empty($pass));
		echo "<br>";
		
		die();
		
		$sql = "SELECT password = password('".$pass."')";
		$result = $conn->query($sql);
		
		return $row["password"];
	}

	/*
		Unit of Work (TDG Functions for Student)
	*/
	public function updateStudent($studentUpdateList, $conn){
       
	    foreach($studentUpdateList as &$studentUpdated)
		{
			if(empty($studentUpdated->getNewPass()))
			{
				//Then update the Email
				$sql = "Update student SET email ='".$studentUpdated->getNewEmail()."' WHERE email ='".$studentUpdated->getEmailAddress()."' ";
				$result = $conn->query($sql);	
			}
			else if(empty($studentUpdated->getNewEmail()))
			{
				$sql = "Update student SET password = '".$studentUpdated->getNewPass()."' WHERE email ='".$studentUpdated->getEmailAddress()."' AND password = '".$studentUpdate->getOldPass()."'";
				var_dump($sql);
				die();
				
				
				//First Update the Password
				$sql = "Update student SET password = '".$studentUpdated->getNewPass()."' WHERE email ='".$studentUpdated->getEmailAddress()."' AND password = '".$studentUpdate->getOldPass()."'";
				$result = $conn->query($sql);
			}
		}
		/*		
		foreach($studentUpdateList as &$studentUpdated)
		{
			//Then update the Email
			$sql = "Update student SET email ='".$studentUpdated->getNewEmail()."' WHERE email ='".$studentUpdated->getEmailAddress()."' ";
			$result = $conn->query($sql);	
		}
		*/
    }
}
?>