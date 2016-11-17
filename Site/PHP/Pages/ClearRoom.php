<?php
include "../Class/ReservationMapper.php";
include "../Class/RoomMapper.php";
include "../Class/Unit.php";
include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

// Start the session
session_start();

$db = new ServerConnection();
$conn = $db->getServerConn();

$unit = new UnitOfWork($conn);

$rID = $_SESSION['roomID'];

$roomAsked = new RoomMapper($rID, $conn);
$name = $roomAsked->getName();

$roomAsked->setBusy(0);
$unit->registerDirtyRoom($roomAsked);

$_SESSION['roomAvailable'] = false;
$_SESSION["userMSG"] = "You have close the window, room ".$name." has been unlocked!";
$_SESSION["msgClass"] = "failure";

$unit->commit();
$db->closeServerConn($conn);

header("Location: Home.php");
?>