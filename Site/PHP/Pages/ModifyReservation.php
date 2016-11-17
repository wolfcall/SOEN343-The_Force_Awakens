<?php
include "../Class/ReservationMapper.php";
include "../Class/RoomMapper.php";
include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

// Start the session
session_start();

$db = new ServerConnection();
$conn = $db->getServerConn();

$reservation = new ReservationMapper();

$action = $_POST['action'];
$reID = $_POST['reID'];

if($action == "delete")
{	
	//Dropped date from message for the moment since its not being posted - NB
	$date = $_POST['date'];

	$reservation->deleteReservation($reID, $conn);

	$db->closeServerConn($conn);
	
	header("Location: Home.php");
}
elseif($action == "modify")
{
	$_SESSION['modify'] = true;
	$_SESSION['reservation'] = $reID;
}

$db->closeServerConn($conn);
	
header("Location: Home.php");

?>