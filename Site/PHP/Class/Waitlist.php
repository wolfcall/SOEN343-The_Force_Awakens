<?php
/* 
 * Original Creator: Stefano Pace
 * Last Change Date: 01/10/2016 (SP)
 * 
 * Version History: 
 * 1/10/2016 (SP)
 * -Added variables and general methods
 * 
*/

//MySQL Database Connect 
session_start();
include '../Utilities/ServerConnection.php';
$conn = getCon();

class Room
{
    //The only thing locally stored should be the waitID
	//Everything else is stored in the database and referenced based on this ID
	//A copy of the waitID will also be stored in the database
	
	private $waitID = "";
    
	public function __construct($reID, $wID, $rID, $start, $end, $order) {
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('reservationID','waitID','roomID','startTimeDate','endTimeDate', 'order')" +
						"VALUES (<{reservationID: '$reID'}>,<{waitID: '$sId'}>,<{roomID: '$rID'}>,<{startTimeDate: '$start'}>,<{endTimeDate: '$end'}>,<{order: '$order'}>)";

		mysqli_query($conn, $insertQuery);
			
		$this->waitID = $wID;
    }
    
     /* The general gets and sets are here
     */
    public function getwaitID(){
		return $this->waitID;
    }
    
    public function getReservationID(){
		$accessQuery = "SELECT 'reservationID' FROM 'soen343'.'waitlist'" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['reservationID'];
    }
    
    public function getRoomID() {
        $accessQuery = "SELECT 'roomID' FROM 'soen343'.'waitlist'" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['roomID'];
    }
    
    public function getStart() {
        $accessQuery = "SELECT 'startTimeDate' FROM 'soen343'.'waitlist'" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['startTimeDate'];
    }
     
	public function getEnd() {
        $accessQuery = "SELECT 'endTimeDate' FROM 'soen343'.'waitlist'" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['endTimeDate'];
    }
	
	public function getOrder() {
		$accessQuery = "SELECT 'order' FROM 'soen343'.'waitlist'" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['order'];
    }
	
	 public function setReservationID($reID){
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('reservatioID')" +
					"VALUES(<{reservationID: '$reID'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
    
    public function setWaitID($wID){
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('waitID')" +
					"VALUES(<{reservationID: '$wID'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
    
    public function setRoomID($rID){
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('roomID')" +
					"VALUES(<{reservationID: '$rID'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
    
	public function setStartTimeDate($start){
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('startTimeDate')" +
					"VALUES(<{reservationID: '$start'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
	    
	public function setEndTimeDate($end){
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('endTimeDate')" +
					"VALUES(<{reservationID: '$end'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
	
	public function setTitle($order){
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('order')" +
					"VALUES(<{reservationID: '$order'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
	    
    //To clear the object in case user login fails?
    function __destruct() {
       //echo "Object destroyed";
   }
}