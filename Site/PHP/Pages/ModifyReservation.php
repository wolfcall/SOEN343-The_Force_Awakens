<?php
include "../Class/ReservationMapper.php";
include "../Class/RoomMapper.php";

// Start the session
session_start();

$reservation = new ReservationMapper();

$action = $_POST['action'];
$rID = $_POST['rID'];

if($action == "delete")
{	
	//Dropped date from message for the moment since its not being posted - NB
	$date = $_POST['date'];

	$reservation->deleteReservation($rID);

	$_SESSION["userMSG"] = "You have successfully deleted Reservation ID#" .$rID;
	$_SESSION["msgClass"] = "success";

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
	
	header("Location: Home.php");
}

?>