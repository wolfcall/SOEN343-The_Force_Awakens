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

// Start the session
session_start();

include_once dirname(__FILE__).'\\..\\Utilities\\ServerConnection.php';
include "../Utilities/ServerConneciton.php";

$_SESSION["email"] = htmlspecialchars($_POST["email"]);

class Room
{
    //The only thing locally stored should be the waitID
	//Everything else is stored in the database and referenced based on this ID
	//A copy of the waitID will also be stored in the database
	
	private $waitID = "";
    
	public function __construct($reID, $wID, $rID, $start, $end, $order) {
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('reservationID','waitID','roomID','startTimeDate','endTimeDate', 'order')" +
						"VALUES (<{reservationID: '$reID'}>,<{waitID: '$sId'}>,<{roomID: '$rID'}>,<{startTimeDate: '$start'}>,<{endTimeDate: '$end'}>,<{order: '$order'}>)";

		mysqli_query($conn, $insertQuery);
			
		$this->waitID = $wID;
		
		closeServerConn($conn);
    }
    
     /* The general gets and sets are here
     */
    public function getwaitID(){
		return $this->waitID;
    }
    
    public function getReservationID(){
		
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'reservationID' FROM 'soen343'.'waitlist'" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['reservationID'];
		
		closeServerConn($conn);
    }
    
    public function getRoomID() {
        
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'roomID' FROM 'soen343'.'waitlist'" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['roomID'];
		
		closeServerConn($conn);
    }
    
    public function getStart() {
        
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'startTimeDate' FROM 'soen343'.'waitlist'" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['startTimeDate'];
		
		closeServerConn($conn);
    }
     
	public function getEnd() {
        
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'endTimeDate' FROM 'soen343'.'waitlist'" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['endTimeDate'];
		
		closeServerConn($conn);
    }
	
	public function getOrder() {
		
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'order' FROM 'soen343'.'waitlist'" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['order'];
		
		closeServerConn($conn);
    }
	
	 public function setReservationID($reID){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('reservatioID')" +
					"VALUES(<{reservationID: '$reID'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
    
    public function setWaitID($wID){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('waitID')" +
					"VALUES(<{reservationID: '$wID'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
    
    public function setRoomID($rID){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('roomID')" +
					"VALUES(<{reservationID: '$rID'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
    
	public function setStartTimeDate($start){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('startTimeDate')" +
					"VALUES(<{reservationID: '$start'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
	    
	public function setEndTimeDate($end){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('endTimeDate')" +
					"VALUES(<{reservationID: '$end'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
	
	public function setTitle($order){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'waitlist'('order')" +
					"VALUES(<{reservationID: '$order'}>)" +
					"WHERE ('waitID' = <{$this->waitID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
	    
    //To clear the object in case user login fails?
    function __destruct() {
       //echo "Object destroyed";
   }
}