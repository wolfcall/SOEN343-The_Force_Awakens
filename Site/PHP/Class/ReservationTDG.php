<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

class ReservationTDG
{
    /* All times should be in the following format : STR_TO_DATE('10/24/11 10:00 PM','%m/%d/%Y %h:%i %p').
	 * 
	 * STR_TO_DATED('".date('m/j/Y g:i' , $start)."', '%m/%d/%Y %h:%i %p')
	 * STR_TO_DATED('".date('m/j/Y g:i' , $end)."', '%m/%d/%Y %h:%i %p')
	*/
	
	/* The Insert method to add a new reservation into the reservation table
	*/
	public function addReservation($sID, $rID, $start, $end, $title, $desc)
	{
		$conn = getServerConn();
		
		$sql = "INSERT INTO reservation (studentID, roomID, startTimeDate, endTimeDate, title, description) " +
		"Values ('".$sID."','".$rID."','".$start."','".$end."','".$title."','".$desc."'";
		
		$result = $conn->query($sql);
				
		closeServerConn($conn);				
	}
			
	/* The Get methods for all Entities in the reservation table can be found here
     */
    public function getReservationID($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT reservationID FROM reservation WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["reservationID"];
    }
    
    public function getStudentID($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT studentID FROM reservation WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["studentID"];
    }
      
    public function getRoomID($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT roomID FROM reservation WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["roomID"];
    }
	
	public function getStart($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT startTimeDate FROM reservation WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["startTimeDate"];
    }
	
	public function getEnd($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT endTimeDate FROM reservation WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["endTimeDate"];
    }
	
	public function getTitle($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT title FROM reservation WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["title"];
    }
	
	public function getDescription($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT description FROM reservation WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["description"];
    }
	
	/* The Update methods for all Entities in the reservation table can be found here
     */
	
	public function updateReservationID($reID, $new){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET reservationID ='".$new."' WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
    
    public function updateStudentID($reID, $sID){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET studentID ='".$sID."' WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
      
    public function updateRoomID($reID, $rID){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET roomID ='".$rID."' WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	public function updateStart($reID, $start){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET startTimeDate ='".$start."' WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	public function updateEnd($reID, $end){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET endTimeDate ='".$end."' WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	public function updateTitle($reID, $title){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET title ='".$title."' WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	public function updateDescription($reID, $desc){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET description ='".$desc."' WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
}
?>