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

if(empty($newEmail) and empty($newPass))
{
	$msg = "No Data has been saved!";
}
else if (empty($newEmail))
{
	$msg = $begin.$changePass."!";
	$student->updatePassword($oldEmail, $oldPass, $newPass);
}
else if (empty($newPass))
{
	$msg = $begin.$changeEmail."!";
	$student->updateEmailAddress($oldEmail, $newEmail);
	$_SESSION["email"] = $newEmail;
}
else
{
	$msg = $begin.$changeEmail." and".$changePass."!";
	$student->updatePassword($oldEmail, $oldPass, $newPass);
	$student->updateEmailAddress($oldEmail, $newEmail);
	$_SESSION["email"] = $newEmail;
}

$_SESSION["userMSG"] = $msg;

//var_dump($msg);
//die();

header("Location: Home.php");

?>