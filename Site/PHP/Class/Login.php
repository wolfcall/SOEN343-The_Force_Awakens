<?php

// Start the session
session_start();

include "../Utilities/ServerConnection.php";

$_SESSION["email"] = htmlspecialchars($_POST["email"]);

class Login
{
	private $param;
	
	function __construct($param)
	{
		$this->param = $param;
	}
	
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