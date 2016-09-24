<?php
class Login{
	private $email = "";
	private $password = "";
	
	function Login()
	{
		$email = "";
		$password = "";
	}
	function Login($email, $password)
	{
		$email = $email;
		$password = $password;
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
	
	function getEmail()
	{
		return $email;
	}
	function getPassword()
	{
		return $password;
	}
	//Call this to save an email
	function setEmail($email)
	{
		$email = getEmailFromBootstrap();
	}
	//call this to save a password
	function setPassword($password)
	{
		$password = getPasswordFromBootstrap();
	}
	
}
?>