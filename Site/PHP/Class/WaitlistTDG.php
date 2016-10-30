<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

class waitlistTDG
{
	/* All times should be in the following format : STR_TO_DATE('10/24/11 10:00 PM','%m/%d/%Y %h:%i %p').
	*/
	
	/* The Insert method to add a new waitlist into the waitlist table
	*/
	public function addWaitlist($sID, $rID, $start, $end)
	{
		$conn = getServerConn();
		
		$sql = "INSERT INTO waitlist (studentID, roomID, startTimeDate, endTimeDate) " +
		"Values ('".$sID."','".$rID."','".$start."','".$end."'";
		
		$result = $conn->query($sql);
				
		closeServerConn($conn);				
	}
			
	/* The Get methods for all Entities in the waitlist table can be found here
     */
    public function getWaitlistID($wID){
		
		$conn = getServerConn();
		
		$sql = "SELECT waitlistID FROM waitlist WHERE waitlistID ='".wID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["waitlistID"];
    }
    
    public function getStudentID($wID){
		
		$conn = getServerConn();
		
		$sql = "SELECT studentID FROM waitlist WHERE waitlistID ='".wID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["studentID"];
    }
      
    public function getRoomID($wID){
		
		$conn = getServerConn();
		
		$sql = "SELECT roomID FROM waitlist WHERE waitlistID ='".wID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["roomID"];
    }
	
	public function getStart($wID){
		
		$conn = getServerConn();
		
		$sql = "SELECT startTimeDate FROM waitlist WHERE waitlistID ='".wID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["startTimeDate"];
    }
	
	public function getEnd($wID){
		
		$conn = getServerConn();
		
		$sql = "SELECT endTimeDate FROM waitlist WHERE waitlistID ='".wID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["endTimeDate"];
    }
	
	
	/* The Update methods for all Entities in the waitlist table can be found here
     */
	public function updateWaitlistID($wID, $new){
		
		$conn = getServerConn();
		
		$sql = "Update waitlist SET waitlistID ='".$new."' WHERE waitlistID ='".wID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
    
    public function updateStudentID($wID, $sID){
		
		$conn = getServerConn();
		
		$sql = "Update waitlist SET studentID ='".$sID."' WHERE waitlistID ='".wID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
      
    public function updateRoomID($wID, $rID){
		
		$conn = getServerConn();
		
		$sql = "Update waitlist SET roomID ='".$rID."' WHERE waitlistID ='".wID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	public function updateStart($wID, $start){
		
		$conn = getServerConn();
		
		$sql = "Update waitlist SET startTimeDate ='".$start."' WHERE waitlistID ='".wID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	public function updateEnd($wID, $end){
		
		$conn = getServerConn();
		
		$sql = "Update waitlist SET endTimeDate ='".$end."' WHERE waitlistID ='".wID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
}
