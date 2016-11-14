<?php
include "../Class/ReservationMapper.php";
include "../Class/RoomMapper.php";
include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

// Start the session
session_start();

$conn = getServerConn();

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

	closeServerConn($conn);
	
	header("Location: Home.php");
}
else
{
	$_SESSION['modify'] = true;
	$_SESSION['reservation'] = $rID;
	
	
	//Really shouldn't be calling the database all the time (need that identity map eventually)
	//$reserve = array();
	//$reserve = $reservation->getReservation($rID);
	//$startDateTime = explode(" ", $reserve["startTimeDate"]);
	//$_SESSION['reserveDate'] = $reserve["startTimeDate"];
	
	closeServerConn($conn);
	
	header("Location: Home.php");
}

?>