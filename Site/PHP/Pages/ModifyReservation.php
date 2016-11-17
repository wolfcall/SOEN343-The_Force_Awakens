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

$rID = $_POST['rID'];
$action = $_POST['action'];
$reID = $_POST['reID'];

$roomAsked = new RoomMapper($rID, $conn);
$roomAnswer = $roomAsked->checkBusy($rID, $conn);
$roomName = $roomAsked->getName();

$reservation = new ReservationMapper($reID, $conn);

if($action == "delete")
{	
	//Dropped date from message for the moment since its not being posted - NB
	$date = $_POST['date'];
	
	if($roomAnswer == 0)
	{
		$roomAsked->setBusy(true);
		$unit->registerDirtyRoom($roomAsked);
		$unit->registerDeletedReservation($reservation);
		$roomAsked->setBusy(0);
		$unit->registerDirtyRoom($roomAsked);
		
	}
	else
	{
		$_SESSION["userMSG"] = "Room ".$roomName." is being used by another Student!";
		$_SESSION["msgClass"] = "failure";
	}

	$unit->commit();
	$reservation->deleteReservation($reID, $conn);

	$db->closeServerConn($conn);
	
	header("Location: Home.php");
}
elseif($action == "modify")
{
	$_SESSION['modify'] = true;
	$_SESSION['reservation'] = $reID;
}

$unit->commit();
$db->closeServerConn($conn);

header("Location: Home.php");

?>