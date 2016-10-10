<?php

// Start the session
session_start();

include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';
include "../Class/user.php";

$oldEmail = htmlspecialchars($_POST["curEmail"];
$newEmail = htmlspecialchars($_POST["newEmail"];
$newPass = htmlspecialchars($_POST["oldPass"];
$oldPass = htmlspecialchars($_POST["newPass"];

$user = new User($oldEmail);


echo var_dump($oldEmail);

/*
*	Get old data from the user
*   Validate password
*   old password must be entered to change to new password
*   password not required for new email
*/

?>