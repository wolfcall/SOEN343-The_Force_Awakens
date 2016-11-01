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

var_dump($oldPass);	
echo "<br>";
var_dump($newPass);		
echo "<br>";
var_dump($oldEmail);
echo "<br>";
var_dump($newEmail);
echo "<br>";


die();



header("Location: Home.php");
?>