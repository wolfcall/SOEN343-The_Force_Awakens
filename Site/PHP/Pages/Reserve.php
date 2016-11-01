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


?>