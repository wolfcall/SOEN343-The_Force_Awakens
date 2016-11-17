<?php

include "../Class/RoomMapper.php";
include "../Class/StudentMapper.php";
include "../Class/ReservationMapper.php";

include "../Class/Unit.php";
include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

// Start the session
session_start();

$db = new ServerConnection();
$conn = $db->getServerConn();

$unit = new UnitOfWork($conn);

$rID = $_POST['roomNum'];

//In case the User clicks out of the Modal
$_SESSION['roomID'] = $rID;

$roomAsked = new RoomMapper($rID, $conn);
$roomAnswer = $roomAsked->checkBusy($rID, $conn);
$roomName = $roomAsked->getName();

if($roomAnswer == 0)
{
	$roomAsked->setBusy(true);
	$unit->registerDirtyRoom($roomAsked);
	$_SESSION['roomAvailable'] = true;
	$_SESSION['roomReserveID'] = $rID;
}
else
{
	$_SESSION["userMSG"] = "Room ".$roomName." is being used by another Student!";
	$_SESSION["msgClass"] = "failure";
	$_SESSION['roomAvailable'] = false;
}

$unit->commit();
$db->closeServerConn($conn);

header("Location: Home.php");
?>