<?php
include "../Class/StudentMapper.php";
include "../Class/RoomMapper.php";
include "../Class/ReservationMapper.php";
include "../../Javascript/Home.js";


// Start the session
session_start();

$oldPass = htmlspecialchars($_POST["oldPass"]);
$newPass = htmlspecialchars($_POST["newPass"]);

$oldEmail = htmlspecialchars($_POST["oldEmail"]);
$newEmail = htmlspecialchars($_POST["newEmail"]);

$student = new StudentMapper($oldEmail);

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
	$msg = $student->updatePassword($oldEmail, $oldPass, $newPass);
}
//If Password only is empty
else if (empty($newPass))
{
	$checkEmail = $student->getEmailAddressFromDB($newEmail);
	//Check to see if new email already exists in the DB	
	if (empty($checkEmail))
	{
		$msg = $begin.$changeEmail."!";
		$student->updateEmailAddress($oldEmail, $newEmail);
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
	$checkEmail = $student->getEmailAddressFromDB($newEmail);
	//Check to see if new email already exists in the DB
	if (empty($checkEmail))
	{
		$msg = $begin.$changeEmail." and".$changePass."!";
		$student->updatePassword($oldEmail, $oldPass, $newPass);
		$student->updateEmailAddress($oldEmail, $newEmail);
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

header("Location: Home.php");
?>