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
		$accessQuery = "SELECT 'studentID' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['studentID'];
    }
    
    public function getRoomID() {
        $accessQuery = "SELECT 'roomID' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['roomID'];
    }
    
    public function getStart() {
        $accessQuery = "SELECT 'startTimeDate' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['startTimeDate'];
    }
     
	public function getEnd() {
        $accessQuery = "SELECT 'endTimeDate' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['endTimeDate'];
    }
	
	public function getTitle() {
		$accessQuery = "SELECT 'title' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['title'];
    }
    
	public function getDescription() {
		$accessQuery = "SELECT 'description' FROM 'soen343'.'reservation'" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['description'];
    }
    
    
    public function setReservationID($reID){
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('reservatioID')" +
					"VALUES(<{reservationID: '$reID'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
    
    public function setStudentID($sID){
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('studentID')" +
					"VALUES(<{reservationID: '$sID'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
    
    public function setRoomID($rID){
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('roomID')" +
					"VALUES(<{reservationID: '$rID'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
    
	public function setStartTimeDate($start){
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('startTimeDate')" +
					"VALUES(<{reservationID: '$start'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
	    
	public function setEndTimeDate($end){
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('endTimeDate')" +
					"VALUES(<{reservationID: '$end'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
	
	public function setTitle($title){
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('title')" +
					"VALUES(<{reservationID: '$title'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
	
	public function setDescription($desc){
		$insertQuery = "INSERT INTO 'soen343'.'reservation'('description')" +
					"VALUES(<{reservationID: '$desc'}>)" +
					"WHERE ('reservationID' = <{$this->reservationID}>)";
					
		mysqli_query($conn, $insertQuery);
    }		
		
    //To clear the object in case user login fails?
    function __destruct() {
       //echo "Object destroyed";
   }
}