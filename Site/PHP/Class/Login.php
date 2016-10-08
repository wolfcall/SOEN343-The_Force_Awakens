<?php

	// Start the session
	session_start();

	$_SESSION["email"] = htmlspecialchars($_POST["email"]);

class Login{
	
	private $param;
	
	function __construct($param){
		$this->param = $param;
		var_dump($this->param);
	}
	
	//to connect to Wolfcall server
	private function openConnection()
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
	//to close connection to Wolfcall server
	private function closeConnection($conn)
	{
		$conn->close();
	}
	//get email from html
	function getEmailFromBootstrap()
	{
		return $_POST["email"];
	}
	//get password from html
	function getPasswordFromBootstrap()
	{
		return $_POST["password"];
	}
	//make sure the user logs in with good credentials
	private function checkUserAndPass()
	{
		$conn = $this->openConnection();
		var_dump($_POST);
		$sql = "SELECT email, password FROM student WHERE email ='".$this->getEmailFromBootstrap()."' AND password = password('".$this->getPasswordFromBootstrap()."')";
		
		$result = $conn->query($sql);
		
		$this->closeConnection($conn);
		echo "<br /> ".$result->num_rows."<br />";
		if ($result->num_rows > 0) {
			return true;
		}
		else 
			return false;
		
	}
	//make sure the user exists in the db (to use if wrong password)
	private function checkUserExist()
	{
		openConnection();
		
		$sql = "SELECT email, password FROM student WHERE email =".getEmailFromBootstrap();
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			return true;
		}
		else
			return false;
		
			closeConnection();
	}
	//Call this to save credentials for a new user
	function setCredentials()
	{
		$this->openConnection();
		$sql = "INSERT INTO student (email, password)
		VALUES (".getEmailFromBootstrap().", ".getPasswordFromBootstrap().")";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$email = getEmailFromBootstrap();
		closeConnection();
	}
	//CALL THIS when a user wants to login
	function allowLogin()
	{
		echo "dfhasiugfhdafsi";
		echo $this->checkUserAndPass()."pass";
		if ($this->checkUserAndPass() == true)
		{
			header("Location: ../Pages/Reservation.php");
			//line to redirect to next page
			exit();
		}
		else
		{
			if (checkUserExist() == true)
			{
			header("Location: ../../HTML/index.php");
			alert("Wrong Password");
			//exit();
			}
			else 
				{
					setCredentials();	
					header("Location: ../../Pages/Reservation.php");
					exit();
				}	
			
		}
	}
	
}
?>