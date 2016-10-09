<?php


// Start the session
session_start();

include_once dirname(__FILE__).'\\..\\Utilities\\ServerConnection.php';
var_dump(dirname(__FILE__).'\\..\\Utilities\\ServerConnection.php');
$_SESSION["email"] = htmlspecialchars($_POST["email"]);

include "../Utilities/ServerConneciton.php";

class Login
{
	private $param;
	
	function __construct($param)
	{
		$this->param = $param;
		var_dump($this->param);
	}

	//Open connection to Wolfcall Server
	/*private function openConnection()
	{
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
	
	//Close Connection to Wolfcall Server
	private function closeConnection($conn)
	{
		$conn->close();
	}*/
	
	//Obtain email from Index.php
	private function getEmailFromBootstrap()
	{
		return $_POST["email"];
	}
	
	//Obtain password from Index.php
	private function getPasswordFromBootstrap()
	{
		return $_POST["password"];
	}
	
	//Verify User Credentials
	public function checkUserAndPass()
	{
		var_dump("hello");
		$conn = getServerConn();
		
		$sql = "SELECT email, password FROM student WHERE email ='".$this->getEmailFromBootstrap()."' AND password = password('".$this->getPasswordFromBootstrap()."')";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0)
			return true;
		else 
			return false;
		closeServerConn($conn);
	}
	
	//Verify User exsitence in the db
	public function checkUserExist()
	{
		$conn = getServerConn();
		
		$sql = "SELECT * FROM student WHERE email ='".$this->getEmailFromBootstrap()."'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0)
			return true;
		else 
			return false;
		closeServerConn($conn);
	}
}
?>