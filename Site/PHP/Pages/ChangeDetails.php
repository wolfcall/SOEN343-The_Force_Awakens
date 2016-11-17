<?php
include "../Class/StudentMapper.php";
include "../Class/RoomMapper.php";
include "../Class/ReservationMapper.php";
include "../../Javascript/Home.js";
include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

// Start the session
session_start();

$db = new ServerConnection();
$conn = $db->getServerConn();

$oldPass = htmlspecialchars($_POST["oldPass"]);
$newPass = htmlspecialchars($_POST["newPass"]);

$oldEmail = htmlspecialchars($_POST["oldEmail"]);
$newEmail = htmlspecialchars($_POST["newEmail"]);

$student = new StudentMapper($oldEmail, $conn);

$begin = "You have successfully changed your";
$changePass = " password";
$changeEmail = " email";
$msg = "";

//Should pop up with Javascript if old password doesn't match
//Although it will not overwrite in the database.

//Both Email and password are empty
if(empty($newEmail) and empty($newPass))
{
	$msg = "No Data has been saved!";
	$_SESSION["msgClass"] = "failure";
}
//If Email only is empty
else if (empty($newEmail))
{
	$msg = $student->updatePassword($oldEmail, $oldPass, $newPass, $conn);
}
//If Password only is empty
else if (empty($newPass))
{
	$checkEmail = $student->getEmailAddressFromDB($newEmail, $conn);
	//Check to see if new email already exists in the DB	
	if (empty($checkEmail))
	{
		$msg = $begin.$changeEmail."!";
		$student->updateEmailAddress($oldEmail, $newEmail, $conn);
		$_SESSION["email"] = $newEmail;
		$_SESSION["msgClass"] = "success";
	}
	else 
	{
		$msg = "Email already exists! Please select a new one.";
		$_SESSION["msgClass"] = "failure";
	}
}
//If both fields are filled
else
{
	$checkEmail = $student->getEmailAddressFromDB($newEmail, $conn);
	//Check to see if new email already exists in the DB
	if (empty($checkEmail))
	{
		$temp = $student->updatePassword($oldEmail, $oldPass, $newPass, $conn);
		
		if($temp === true)
		{
			$msg = $begin.$changeEmail." and".$changePass."!";
		}
		else
		{
			$msg = $begin.$changeEmail.", but your current password is not the one you entered. Please try again!";
		}
		
		$student->updateEmailAddress($oldEmail, $newEmail, $conn);
		$_SESSION["email"] = $newEmail;
		$_SESSION["msgClass"] = "success";
	}
	else 
	{
		$msg = "Email already exists! Please select a new one.";
		$_SESSION["msgClass"] = "failure";
	}
}

$_SESSION["userMSG"] = $msg;

$db->closeServerConn($conn);

header("Location: Home.php");
?>