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
    //The only thing locally stored should be the roomID
	//Everything else is stored in the database and referenced based on this ID
	//A copy of the roomID will also be stored in the database
	
	private $roomID = "";
    
	public function __construct($n, $rID, $loc, $desc) {
        $insertQuery = "INSERT INTO 'soen343'.'room'('name','roomID','location','description')" +
					"VALUES(<{name: '$n'}>,<{roomID: '$rID'}>,<{location: '$loc'}>,<{description: '$desc'}>)";
		
		mysqli_query($conn, $insertQuery); 
		
		$this->roomID = $rID;
    }
    
    /* The general gets and sets are here
     */
    public function getName(){
		$accessQuery = "SELECT 'name' FROM 'soen343'.'room'" +
					"WHERE ('roomID' = <{$this->roomID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['name'];
    }
    
    public function getRoomID(){
		
		/**$accessQuery = "SELECT 'roomID' FROM 'soen343'.'room'" +
					"WHERE ('roomID' = <{$this->roomID}>";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['roomID'];
		*/
		return this->roomID;
		
    }
    
    public function getLocation() {
        $accessQuery = "SELECT 'location' FROM 'soen343'.'room'" +
					"WHERE ('roomID' = <{$this->roomID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['location'];
    }
    
    public function getDescription() {
        $accessQuery = "SELECT 'description' FROM 'soen343'.'room'" +
					"WHERE ('roomID' = <{$this->roomID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['description'];
    }
    
    public function setName($Name){
		$insertQuery = "INSERT INTO 'soen343'.'room'('name')" +
					"VALUES(<{name: '$n'}>)" +
					"WHERE ('roomID' = <{$this->roomID}>)";
					
		mysqli_query($conn, $insertQuery);
    }
    
    public function setRoomID($roomID){	
		$insertQuery = "INSERT INTO 'soen343'.'room'('roomID')" +
					"VALUES(<{roomID: '$rID'}>)" +
					"WHERE ('roomID' = <{$this->roomID}>)";
		
		mysqli_query($conn, $insertQuery);
    }
    
    public function setLocation($location){
		$insertQuery = "INSERT INTO 'soen343'.'room'('location')" +
					"VALUES(<{location: '$loc'}>)" +
					"WHERE ('roomID' = <{$this->roomID}>)";
		
		mysqli_query($conn, $insertQuery);
    }
    
	  public function setDescription($description){
		$insertQuery = "INSERT INTO 'soen343'.'room'('description')" +
					"VALUES(<{description: '$desc'}>)" +
					"WHERE ('roomID' = <{$this->roomID}>)";
		
		mysqli_query($conn, $insertQuery);
    }
	    
    //To clear the object in case user login fails?
    function __destruct() {
       //echo "Object destroyed";
   }
}