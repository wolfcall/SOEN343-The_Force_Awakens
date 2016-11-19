<?php
 include_once "../Class/RoomMapper.php";
 include_once "../Class/StudentMapper.php";
 include_once "../Class/ReservationMapper.php";
 include_once "../Class/Unit.php";
 include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

//echo get_include_path();
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

//Need start date for reservation being modified
$oldRes = $reservation->getReservation($reID, $conn);
$start = substr($oldRes["startTimeDate"],0,10);
$end = substr($oldRes["endTimeDate"],0,10);

//Reformate start date, to be used in sql statement
$dateElementsStart = explode("/", $start);
$reformatStart = $dateElementsStart[1]."/".$dateElementsStart[2]."/".$dateElementsStart[0];

if($action == "delete")
{	
	//Dropped date from message for the moment since its not being posted - NB
	$date = $_POST['date'];

	if($roomAnswer == 0)
	{
		$roomAsked->setBusy(true);
		$unit->registerDirtyRoom($roomAsked);
		$unit->registerDeletedReservation($reservation);
		updateWaitlist($reservation, $rID, $reformatStart, $conn);
		$roomAsked->setBusy(0);
		$unit->registerDirtyRoom($roomAsked);
		
	}
	else
	{
		$_SESSION["userMSG"] = "Room ".$roomName." is being used by another Student!";
		$_SESSION["msgClass"] = "failure";
	}
}
elseif($action == "modify")
{
	$_SESSION['modify'] = true;
	$_SESSION['reservation'] = $reID;
}

$unit->commit();
$db->closeServerConn($conn);


header("Location: Home.php");

function updateWaitlist($reserve, $roomID, $start, $conn) {
	include '../Utilities/Function.php';
	global $unit;
	$previousID = $reserve->getID();
	//Get all individuals on waitlist for room on this date
	$waitingReserves = $reserve->getReservationsByRoomAndDate($roomID, $start, 1, $conn);

	//For each reservation on waiting list for this section, checkWeek and Overlap, and add if passes
	foreach($waitingReserves as $reservation) {
		//Values for checkWeek
		//Reformate start date for checkWeek
		$waitStartDate = substr($reservation->getStartTimeDate(),0,10);
		$dateElementsStart = explode("/", $waitStartDate);
		$dateEU = $dateElementsStart[2]."-".$dateElementsStart[1]."-".$dateElementsStart[0];
		
		//Get current reservations for this student
		$sID = $reservation->getSID();
	 	$currentReservations = $reserve->getReservations($sID, $conn);
	 	//All values for checkWeek present

		//Values for checkOverlap
		//Reformate before converting to DateTime
		$dateAmerStart = $dateElementsStart[1]."/".$dateElementsStart[2]."/".$dateElementsStart[0];
		$reformStart = $dateAmerStart.substr($reservation->getStartTimeDate(),10);

		//Reformate enddatetime
		$waitEndDate = substr($reservation->getEndTimeDate(),0,10);
		$dateElementsEnd = explode("/", $waitEndDate);
		$dateAmerEnd = $dateElementsEnd[1]."/".$dateElementsEnd[2]."/".$dateElementsEnd[0];
		$reformEnd = $dateAmerEnd.substr($reservation->getEndTimeDate(),10);

		//Convert to DateTime
		$startDateTime = new DateTime($reformStart);
		$endDateTime = new DateTime($reformEnd);

		//Get all reservations for the room that shares the start date 
		$availableTimes = $reserve->getReservationsByRoomAndDate($roomID, $start, 0, $conn);
		//All values for checkOverlap present

		//For each entry found, try to insert in order
		//If new value is insertable, add it

		if(checkWeek($dateEU, $currentReservations) && checkOverlap($startDateTime, $endDateTime, $availableTimes, $previousID)) {
			$res = new ReservationMapper($reID, $conn);

			$res->setStartTimeDate($reformStart);
			$res->setEndTimeDate($reformEnd);
			$res->setTitle($reservation->getTitle());
			$res->setDescription($reservation->getDescription());
			$res->setREID($reservation->getID());
			$res->setWait(0);

			$unit->registerDirtyReservation($res);
	 	}
	}
}
?>