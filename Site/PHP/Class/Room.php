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
    //The only thing locally stored should be the roomID
	//Everything else is stored in the database and referenced based on this ID
	//A copy of the roomID will also be stored in the database
	
	private $roomID = "";
    
	public function __construct($n, $rID, $loc, $desc) {
        
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'room'('name','roomID','location','description')" +
					"VALUES(<{name: '$n'}>,<{roomID: '$rID'}>,<{location: '$loc'}>,<{description: '$desc'}>)";
		
		mysqli_query($conn, $insertQuery); 
		
		$this->roomID = $rID;
		
		closeServerConn($conn);
    }
    
    /* The general gets and sets are here
     */
    public function getName(){
		
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'name' FROM 'soen343'.'room'" +
					"WHERE ('roomID' = <{$this->roomID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['name'];
		
		closeServerConn($conn);
    }
    
    public function getRoomID(){
		
		/**$accessQuery = "SELECT 'roomID' FROM 'soen343'.'room'" +
					"WHERE ('roomID' = <{$this->roomID}>";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['roomID'];
		*/
		return $this->roomID;
		
    }
    
    public function getLocation() {
        
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'location' FROM 'soen343'.'room'" +
					"WHERE ('roomID' = <{$this->roomID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['location'];
		
		closeServerConn($conn);
    }
    
    public function getDescription() {
        
		$conn = getServerConn();
		
		$accessQuery = "SELECT 'description' FROM 'soen343'.'room'" +
					"WHERE ('roomID' = <{$this->roomID}>)";
					
		$result = mysqli_query($conn, $accessQuery);
		$row = mysqli_fetch_array($result);
		
		return $row['description'];
		
		closeServerConn($conn);
    }
    
    public function setName($Name){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'room'('name')" +
					"VALUES(<{name: '$n'}>)" +
					"WHERE ('roomID' = <{$this->roomID}>)";
					
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
    
    public function setRoomID($roomID){	
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'room'('roomID')" +
					"VALUES(<{roomID: '$rID'}>)" +
					"WHERE ('roomID' = <{$this->roomID}>)";
		
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
    
    public function setLocation($location){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'room'('location')" +
					"VALUES(<{location: '$loc'}>)" +
					"WHERE ('roomID' = <{$this->roomID}>)";
		
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
    
	  public function setDescription($description){
		
		$conn = getServerConn();
		
		$insertQuery = "INSERT INTO 'soen343'.'room'('description')" +
					"VALUES(<{description: '$desc'}>)" +
					"WHERE ('roomID' = <{$this->roomID}>)";
		
		mysqli_query($conn, $insertQuery);
		
		closeServerConn($conn);
    }
	    
    //To clear the object in case user login fails?
    function __destruct() {
       //echo "Object destroyed";
   }
}