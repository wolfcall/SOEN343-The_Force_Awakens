<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';
include "../Class/user.php";

$oldEmail = $_SESSION['email'];
$newEmail = htmlspecialchars($_POST["newEmail"]);
$oldPass = htmlspecialchars($_POST["oldPass"]);
$newPass = htmlspecialchars($_POST["newPass"]);

$user = new User($oldEmail);

$valid = $user->setNewPassword($oldPass, $newPass);

if($valid == true)
{
	echo "old password matches";
}
else
{
	eccho "doesn't match";
}


//header("Location: Home.php");
exit();

/*
*	Get old data from the user
*   Validate password
*   old password must be entered to change to new password
*   password not required for new email
*/

?>