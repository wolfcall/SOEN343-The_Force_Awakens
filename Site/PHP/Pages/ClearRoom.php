<?php
include "../Class/ReservationMapper.php";
include "../Class/RoomMapper.php";
include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

// Start the session
session_start();

$db = new ServerConnection();
$conn = $db->getServerConn();

$rID = $_SESSION['roomID'];

$roomAsked = new RoomMapper($rID, $conn);
$roomAsked->setBusy(0, $rID, $conn);
$name = $roomAsked->getName();

$_SESSION['roomAvailable'] = false;
$_SESSION["userMSG"] = "You have close the window, room ".$name." has been unlocked!";
$_SESSION["msgClass"] = "failure";

header("Location: Home.php");

$db->closeServerConn($conn);

?>