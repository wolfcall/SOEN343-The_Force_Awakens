<?php
include "../Class/StudentMapper.php";
include "../Class/RoomMapper.php";
include "../Class/ReservationMapper.php";

// Start the session
session_start();

$oldPass = htmlspecialchars($_POST["oldPass"]);
$newPass = htmlspecialchars($_POST["newPass"]);

$oldEmail = htmlspecialchars($_POST["oldEmail"]);
$newEmail = htmlspecialchars($_POST["newEmail"]);

$student = new StudentMapper($oldEmail);

//Should pop up with Javascript if old password doesn't match
//Although it will not overwrite in the database.

if(empty($newEmail))
{
	header("Location: Home.php");
}
else
{
	$student->updateEmailAddress($oldEmail, $newEmail);
	$_SESSION["email"] = $newEmail;
	header("Location: Home.php");	
}

if(empty($newPass))
{
	header("Location: Home.php");
}
else
{
	$student->updatePassword($oldEmail, $oldPass, $newPass);
	$_SESSION["email"] = $newEmail;
	header("Location: Home.php");	
}

?>