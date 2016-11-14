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
	
	//Replacement for the * in sql due to special formatting required for the DateTime columns
	private $star;
	
	public function __construct() {
		$this->star = "reservationID, studentID, roomID, date_format(startTimeDate,'%Y/%m/%d %H:%i') as startTimeDate, date_format(endTimeDate,'%Y/%m/%d %H:%i') as endTimeDate, title, description, waitlisted";
	}

		
	/* The Insert method to add a new reservation into the reservation table
	*/
	public function addReservation($sID, $rID, $start, $end, $title, $desc, $conn)
	{
		$startTrans = "STR_TO_DATE('".$start."', '%m/%d/%Y %H:%i')";
		$endTrans = "STR_TO_DATE('".$end."', '%m/%d/%Y %H:%i')";

		$sql = "INSERT INTO reservation (studentID, roomID, startTimeDate, endTimeDate, title, description) 
			Values ('".$sID."','".$rID."',".$startTrans.",".$endTrans.",'".$title."','".$desc."')";
		
		$result = $conn->query($sql);
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
	public function getReservation($reID, $conn)
	{
		$sql = "SELECT {$this->star} FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$singleReservation = array("title" => $result["title"],
												"description" => $result["description"],
												"reservationID" => $result["reservationID"],
                                                "studentID" => $result["studentID"],
                                                "roomID" => $result["roomID"],
                                                "startTimeDate" => $result["startTimeDate"],
                                                "endTimeDate" => $result["endTimeDate"]);
		
		echo $singleReservation;
		die();
		return $singleReservation;
	}	
	 
    public function getREID($sID, $conn){
		
		$sql = "SELECT reservationID FROM reservation WHERE studentID ='".$sID."'";
		$result = $conn->query($sql);
		
		$num = array();
		while($row = $result->fetch_assoc())
		{
			array_push($num, $row["reservationID"]);
		}
		
		return $num;
    }
    
    public function getStudentID($reID, $conn){
		
		$sql = "SELECT studentID FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		return $row["studentID"];
    }
      
    public function getRoomID($reID, $conn){
		
		$sql = "SELECT roomID FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		return $row["roomID"];
    }
	
	public function getStart($reID, $conn){
		
		$sql = "SELECT startTimeDate FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		return $row["startTimeDate"];
    }
	
	public function getEnd($reID, $conn){
		
		$sql = "SELECT endTimeDate FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		return $row["endTimeDate"];
    }
	
	public function getTitle($reID, $conn){

		$sql = "SELECT title FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		return $row["title"];
    }
	
	public function getDescription($reID, $conn){

		$sql = "SELECT description FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		return $row["description"];
    }
	
	//Get reservations by Student ID
	public function getReservations($sID, $conn) {
		
		$sql = "SELECT {$this->star} FROM reservation WHERE studentID ='".$sID."'";
		$result = $conn->query($sql);

		$reservesDates = array();
        $singleReservation = array();
		
		while($row = $result->fetch_assoc())
		{   
                        $singleReservation = array("title" => $row["title"],
												"description" => $row["description"],
												"reservationID" => $row["reservationID"],
                                                "studentID" => $row["studentID"],
                                                "roomID" => $row["roomID"],
                                                "startTimeDate" => $row["startTimeDate"],
                                                "endTimeDate" => $row["endTimeDate"]);
			array_push($reservesDates, $singleReservation);
		}
		
		return $reservesDates;
	}
    
	//Get reservations by Date ONLY
	public function getReservationsByDate($start, $conn) {
		
		$date = substr($start,0,10);
		
		//Need to reformate date so that it can be used in the database
		$dateElements = explode("/", $date);
		$reformatDate = $dateElements[2]."-".$dateElements[0]."-".$dateElements[1];

		$sql = "SELECT {$this->star} FROM reservation WHERE date(startTimeDate) = str_to_date('".$reformatDate."','%Y-%d-%m')"
				. " and waitlisted = false";

		$result = $conn->query($sql);

		$reservesTimes = array();

		if(!is_null($reservesTimes)) {
			while($row = $result->fetch_assoc())
			{
				$temp = new ReservationDomain($row["reservationID"], $row["studentID"], $row["roomID"], $row["startTimeDate"], $row["endTimeDate"], $row["title"], $row["description"]);
				array_push($reservesTimes, $temp);
			}
		}

		return $reservesTimes; 
	}
	
	//Get reservations by room ID AND Date (for overlap checking)
	public function getReservationsByRoomAndDate($roomID, $start, $conn) {
		
		$date = substr($start,0,10);

		//Need to reformate date so that it can be used in the database
		$dateElements = explode("/", $date);
		$reformatDate = $dateElements[2]."-".$dateElements[0]."-".$dateElements[1];

		$sql = "SELECT ".$this->star." FROM reservation WHERE date(startTimeDate) = date '".$reformatDate."'"
				. " AND roomID = '".$roomID."' and waitlisted = false";
		
		$result = $conn->query($sql);

		$reservesTimes = array();

		if($result != null) {
			while($row = $result->fetch_assoc())
			{
				$temp = new ReservationDomain($row["reservationID"], $row["studentID"], $row["roomID"], $row["startTimeDate"], $row["endTimeDate"], $row["title"], $row["description"]);
				array_push($reservesTimes, $temp);
			}
		}

		return $reservesTimes; 
	}

	/* The Update methods for all Entities in the reservation table can be found here
     */
	
	public function updateReservationID($reID, $new, $conn){

		$sql = "Update reservation SET reservationID ='".$new."' WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
    }
    
    public function updateStudentID($reID, $sID, $conn){
		
		$sql = "Update reservation SET studentID ='".$sID."' WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
	}
      
    public function updateRoomID($reID, $rID, $conn){
	
		$sql = "Update reservation SET roomID ='".$rID."' WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
	}
	
	public function updateStart($reID, $start, $conn){
		
		$startTrans = "STR_TO_DATE('".$start."', '%m/%d/%Y %H:%i')";
		$sql = "Update reservation SET startTimeDate ='".$startTrans."' WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
	}
	
	public function updateEnd($reID, $end, $conn){
	
		$endTrans = "STR_TO_DATE('".$end."', '%m/%d/%Y %H:%i')";	
		$sql = "Update reservation SET endTimeDate ='".$endTrans."' WHERE reservationID ='".reID."'";
		$result = $conn->query($sql);
	}
	
	public function updateTitle($reID, $title, $conn){
		
		$sql = "Update reservation SET title ='".$title."' WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
	}
	
	public function updateDescription($reID, $desc, $conn){
		
		$sql = "Update reservation SET description ='".$desc."' WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
	}
    

	public function deleteReservation($reID, $conn){
	
		$sql = "DELETE FROM reservation WHERE reservationID ='".$reID."'";
		$result = $conn->query($sql);
	}
}
?>