<?php

/* 
 * Original creator: (Georges )
 * Last change date: 10/08/16
 *
 * Version history:
 * 10/05/16
 * Changed connection schema to soen343 to access correct tables (NB)
 */

class ServerConnection
{ 
	function getServerConn(){
		$servernamelocal = "";
		$servernameremote = "";
		$port = 3306;
		$username = "";
		$password = "";
		$schema = "";
		
		$conn = new mysqli($servernameremote, $username, $password, $schema, $port);
		
		if($conn->connect_error||$conn == NULL){
			$conn  = new mysqli($servernamelocal, $username, $password, $schema, $port);
			
			if($conn->connect_error)
				die("Connection failed: " . $conn->connect_error);
		}
		
		//echo $conn;
		return $conn;
		
	}
	//closes a connection takes a connection object
	function closeServerConn($conn){
		$conn->close();
	}
}
?>