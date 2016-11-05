<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

class ReservationTDG
{
    /* All times should be in the following format : STR_TO_DATE('10/24/11 10:00 PM','%m/%d/%Y %h:%i %p').
	 * 
	 * STR_TO_DATE('".$start."', '%m/%d/%Y %h:%i %p')
	 * STR_TO_DATE('".$end."', '%m/%d/%Y %h:%i %p')
	 * 
	*/
	
	/* The Insert method to add a new reservation into the reservation table
	*/
	public function addReservation($sID, $rID, $start, $end, $title, $desc)
	{
		$conn = getServerConn();
		
		$startTrans = "STR_TO_DATE('".$start."', '%m/%d/%Y %h:%i %p')";
		$endTrans = "STR_TO_DATE('".$end."', '%m/%d/%Y %h:%i %p')";
		
		$sql = "INSERT INTO reservation (studentID, roomID, startTimeDate, endTimeDate, title, description) 
			Values ('".$sID."','".$rID."',".$startTrans.",".$endTrans.",'".$title."','".$desc."')";
		
		$result = $conn->query($sql);
		
		closeServerConn($conn);		
	}
	
	/*
	*	The Check method will take the Original start time and end time of the reservation as well as the room ID
	*	It will check check all 30 minute increments between the start and end times of the game
	*	Select time(startTimeDate) as time, date(startTimeDate) as date from reservation; 
	*	Allows us to seperate the time from the date
	
	public function checkAvailabilities($start, $end, $rID)
	{
		$conn = getServerConn();
		
		$startTrans = "STR_TO_DATE('".$start."', '%m/%d/%Y %h:%i %p')";
		$endTrans = "STR_TO_DATE('".$end."', '%m/%d/%Y %h:%i %p')";
				
		$sql = "SELECT time(startTimeDate) as time, date(startTimeDate) as date FROM reservation WHERE roomID ='".$rID."'";
		
		$result = $conn->query($sql);
		
		closeServerConn($conn);		
	}
	*/
				
	/* The Get methods for all Entities in the reservation table can be found here
     */
    public function getREID($sID){
		
		$conn = getServerConn();
		
		$sql = "SELECT reservationID FROM reservation WHERE studentID ='".$sID."'";
		$result = $conn->query($sql);
		
		$num = array();
		while($row = $result->fetch_assoc())
		{
			array_push($num, $row["reservationID"]);
		}
				
		closeServerConn($conn);
		
		return $num;
    }
    
    public function getStudentID($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT studentID FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["studentID"];
    }
      
    public function getRoomID($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT roomID FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["roomID"];
    }
	
	public function getStart($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT startTimeDate FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["startTimeDate"];
    }
	
	public function getEnd($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT endTimeDate FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["endTimeDate"];
    }
	
	public function getTitle($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT title FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["title"];
    }
	
	public function getDescription($reID){
		
		$conn = getServerConn();
		
		$sql = "SELECT description FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["description"];
    }

	public function getReservations($sID) {
		$conn = getServerConn();

		$sql = "SELECT * FROM reservation WHERE studentID ='".$sID."'";
		$result = $conn->query($sql);

		$reservesDates = array();
		while($row = $result->fetch_assoc())
		{
			array_push($reservesDates, $row["startTimeDate"]);
		}
		
		closeServerConn($conn);
		return $reservesDates;
	}

	public function getReservationsByDate($start) {
		$conn = getServerConn();

		$date = substr($start,0,10);

		//Need to reformate date so that it can be used in the database
		$dateElements = explode("/", $date);
		$reformateDate = $dateElements[2]."-".$dateElements[0]."-".$dateElements[1];

		$sql = "SELECT * FROM reservation WHERE startTimeDate LIKE '".$reformateDate."%'";

		echo $sql;
		$result = $conn->query($sql);

		$reservesTimes = array();
		while($row = $result->fetch_assoc())
		{
			$temp = array($row["startTimeDate"], $row["endTimeDate"]);
			array_push($reservesTimes, $temp);
		}
		
		closeServerConn($conn);
		return $reservesTimes; 
	}
	
	/* The Update methods for all Entities in the reservation table can be found here
     */
	
	public function updateReservationID($reID, $new){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET reservationID ='".$new."' WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
    
    public function updateStudentID($reID, $sID){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET studentID ='".$sID."' WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
      
    public function updateRoomID($reID, $rID){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET roomID ='".$rID."' WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	public function updateStart($reID, $start){
		
		$conn = getServerConn();
		
		$startTrans = "STR_TO_DATE('".$start."', '%m/%d/%Y %h:%i %p')";
		
		$sql = "Update reservation SET startTimeDate ='".$startTrans."' WHERE reservationID ='".reID."'";

		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	public function updateEnd($reID, $end){
		
		$conn = getServerConn();
		
		$endTrans = "STR_TO_DATE('".$end."', '%m/%d/%Y %h:%i %p')";
		
		$sql = "Update reservation SET endTimeDate ='".$endTrans."' WHERE reservationID ='".reID."'";

		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	public function updateTitle($reID, $title){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET title ='".$title."' WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
	
	public function updateDescription($reID, $desc){
		
		$conn = getServerConn();
		
		$sql = "Update reservation SET description ='".$desc."' WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		
		closeServerConn($conn);
    }
}
?>