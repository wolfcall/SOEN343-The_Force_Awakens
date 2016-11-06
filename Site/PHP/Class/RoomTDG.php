<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

class RoomTDG
{
    /*
		No Default Constructor is Necessary for this class
	*/
	/* 
		No Set methods are necessary for this class, as the Student cannot edit the information for any Room
	*/
	
	/* 
		No insert/update methods are necessary for this class, as the Student cannot edit the information for any Room
	*/
	
	/* 
		The Get methods for all Entities in the room table can be found here
     */
    public function getName($rID){
		
		$conn = getServerConn();
		
		$sql = "SELECT name FROM room WHERE roomID ='".$rID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["name"];
    }
    
    public function getRoomID($rID){
		
		$conn = getServerConn();
		
		$sql = "SELECT roomID FROM room WHERE roomID ='".$rID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["roomID"];
    }
  
    public function getLocation($rID){
		
		$conn = getServerConn();
		
		$sql = "SELECT location FROM room WHERE roomID ='".$rID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["location"];
    }
	
	public function getDescription($rID){
		
		$conn = getServerConn();
		
		$sql = "SELECT description FROM room WHERE roomID ='".$rID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		closeServerConn($conn);
		return $row["description"];
    }
	
	public function getAllRooms(){
		$conn = getServerConn();
		$sql = "Select * from room";
		$result = $conn->query($sql);
		
		$resultSet = array();
		
		while($row = $result->fetch_assoc()){
			$resultSet[] = $row;
		}
		
		closeServerConn($conn);
		
		return $resultSet;
	}
}
