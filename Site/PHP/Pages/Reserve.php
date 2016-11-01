<?php
include "../Class/StudentMapper.php";
include "../Class/RoomMapper.php";
include "../Class/ReservationMapper.php";

// Start the session
session_start();

$title = htmlspecialchars($_POST["title"]);
$desc = htmlspecialchars($_POST["description"]);

$date = htmlspecialchars($_POST["dateDrop"]);
$start = htmlspecialchars($_POST["startTime"]);
$end = htmlspecialchars($_POST["endTime"]);

$first = htmlspecialchars($_POST["firstName"]);
$last = htmlspecialchars($_POST["lastName"]);
$sID = htmlspecialchars($_POST["studentID"]);
$prog = htmlspecialchars($_POST["program"]);
$email = htmlspecialchars($_POST["email"]);

$rID = htmlspecialchars($_POST["roomNum"]);

$student = new StudentMapper($email);
$room = new RoomMapper($rID);
$reservation = new ReservationMapper();

$reservation->addReservation($sID, $rID, $start, $end, $title, $desc);

var_dump($sID);
echo "<br>";
var_dump($rID);		
echo "<br>";
var_dump($title);	
echo "<br>";
var_dump($desc);	
echo "<br>";

var_dump($start);	
echo "<br>";
var_dump($end);		
echo "<br>";
var_dump($date);
echo "<br>";




die();


header("Location: Home.php");
?>