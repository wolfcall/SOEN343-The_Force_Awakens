<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';
include "../Class/Student.php";

$oldEmail = $_SESSION['email'];
$newEmail = htmlspecialchars($_POST["newEmail"]);
$oldPass = htmlspecialchars($_POST["oldPass"]);
$newPass = htmlspecialchars($_POST["newPass"]);

/**
echo $oldPass;
echo $newPass;
echo $oldEmail;
echo $newEmail;
*/
$user = new Student($oldEmail);

echo $valid = $user->setNewPassword($oldPass, $newPass);


/**echo $valid = $user->setNewPassword($oldPass, $newPass);
echo "go fuck yourself";*/



//header("Location: Home.php");
exit();

/*
*	Get old data from the user
*   Validate password
*   old password must be entered to change to new password
*   password not required for new email
*/

?>