<?php

/* 
 * Original creator: (Unknown)
 * Last change date: 10/05/16
 *
 * Version history:
 * 10/05/16
 * Changed connection schema to soen343 to access correct tables (NB)
 */

function getServerCon(){
	$servernamelocal = "192.168.2.36";
	$servernameremote = "wolfcall.ddns.net";
	$port = 3306;
	$username = "SOEN341user";
	$password = "G3tR3ck3dS0n";
	$schema = "soen343";
	
	$conn = new mysqli($servernameremote, $username, $password, $schema, $port);
	
	if($conn->connect_error){
		$conn  = new mysqli($servernamelocal, $username, $password, $schema, $port);
		
		if($conn->connect_error)
			die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}
//closes a connection takes a connection object
function closeServerCon($conn){
	$conn->close();
}

?>
