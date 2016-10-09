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

class Reservation
{
    //The only thing locally stored should be the reservationID
	//Everything else is stored in the database and referenced based on this ID
	//A copy of the reservationID will also be stored in the database
	
	private $reservationID = "";
    
    public function __construct($reID, $sID, $rID, $start, $end, $title, $desc) {
        $insertQuery = "INSERT INTO 'soen343'.'reservation'('reservationID','studentID','roomID','startTimeDate','endTimeDate', 'title', 'description')" +
						"VALUES (<{reservationID: '$reID'}>,<{studentID: '$sId'}>,<{roomID: '$rID'}>,<{startTimeDate: '$start'}>,<{endTimeDate: '$end'}>,<{title: '$title'}>,<{description: '$desc'}>)";

		mysqli_query($conn, $insertQuery);
			
		$this->reservationID = $reID;
    }
    
    /* The general gets and sets are here
     */
    public function getReservationID(){
		return $this->reservationID;
    }
    
    public function getStudentID(){
		
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'studentID' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['studentID'];
		
		closeServerConn($conn);
    }
    
    public function getRoomID() {
        
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'roomID' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['roomID'];
		
		closeServerConn($conn);
    }
    
    public function getStart() {
        
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'startTimeDate' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['startTimeDate'];
		
		closeServerConn($conn);
    }
     
	public function getEnd() {
        
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'endTimeDate' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['endTimeDate'];
		
		closeServerConn($conn);
    }
	
	public function getTitle() {
		
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'title' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['title'];
		
		closeServerConn($conn);
    }
    
	public function getDescription() {
		
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'description' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['description'];
		
		closeServerConn($conn);
    }
    
    
    public function setReservationID($reID){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('reservatioID')" +
					"VALUES(<{reservationID: '$reID'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
    
    public function setStudentID($sID){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('studentID')" +
					"VALUES(<{reservationID: '$sID'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
    
    public function setRoomID($rID){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('roomID')" +
					"VALUES(<{reservationID: '$rID'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
    
	public function setStartTimeDate($start){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('startTimeDate')" +
					"VALUES(<{reservationID: '$start'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
	    
	public function setEndTimeDate($end){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('endTimeDate')" +
					"VALUES(<{reservationID: '$end'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
	
	public function setTitle($title){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('title')" +
					"VALUES(<{reservationID: '$title'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
	
	public function setDescription($desc){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('description')" +
					"VALUES(<{reservationID: '$desc'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }		
		
    //To clear the object in case user login fails?
    function __destruct() {
       //echo "Object destroyed";
   }
}