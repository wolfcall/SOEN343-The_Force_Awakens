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
$rID = $_POST['rID'];

if($action == "delete")
{	
	//Dropped date from message for the moment since its not being posted - NB
	$date = $_POST['date'];

	$reservation->deleteReservation($rID, $conn);

	$_SESSION["userMSG"] = "You have successfully deleted Reservation ID#" .$rID;
	$_SESSION["msgClass"] = "success";

	$db->closeServerConn($conn);
	
	header("Location: Home.php");
}
elseif($action == "modify")
{
	$_SESSION['modify'] = true;
	$_SESSION['reservation'] = $rID;
	
	$db->closeServerConn($conn);
	
	header("Location: Home.php");
}
/*elseif($action == "modifying")
{
	$_SESSION["userMSG"] = "You are modifying a Reservation";
	$_SESSION["msgClass"] = "success";
	header("Location: Home.php");
}*/

?>