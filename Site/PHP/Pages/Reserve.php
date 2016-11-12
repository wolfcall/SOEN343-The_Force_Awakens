<?php
include "../Class/StudentMapper.php";
include "../Class/RoomMapper.php";
include "../Class/ReservationMapper.php";

// Start the session
session_start();

$wrongTime = "Your End Time must be after your Start Time! Please try again.";
$tooLong = "You cannot reserve for a time of more than 3 hours!";

$title = htmlspecialchars($_POST["title"]);
$desc = htmlspecialchars($_POST["description"]);

$passedDate = htmlspecialchars($_POST["dateDrop"]);
$start = htmlspecialchars($_POST["startTime"]);
$end = htmlspecialchars($_POST["endTime"]);

$first = htmlspecialchars($_POST["firstName"]);
$last = htmlspecialchars($_POST["lastName"]);
$sID = htmlspecialchars($_POST["studentID"]);
$prog = htmlspecialchars($_POST["program"]);
$email = htmlspecialchars($_POST["email"]);

/*
*	Getting the ID of the Room 1
*	Should Obtain Either 1,2,3,4,5
*	Correlates to the Database ID's for the rooms!
*/

//Getting the ID of the Room 1
//Should Obtain Either 1,2,3,4,5
$rID = htmlspecialchars($_POST["roomNum"]);

$student = new StudentMapper($email);
$room = new RoomMapper($rID);
$reservation = new ReservationMapper();

$name = $room->getName();

$startEx = explode(":", $start);
$startFloat = ($startEx[0] + ($startEx[1]/60));

$endEx = explode(":", $end);
$endFloat = ($endEx[0] + ($endEx[1]/60));

/*
*	If reservation will last more than 3 hours
*/
if ( ($endFloat-$startFloat) > 3)
{
	$_SESSION["userMSG"] = $tooLong;
	$_SESSION["msgClass"] = "failure";
}

else if ($endFloat <= $startFloat)
{
	$_SESSION["userMSG"] = $wrongTime;
	$_SESSION["msgClass"] = "failure";
}	
else
{
	//Converting the Date to the Proper Format
	//Should Obtain DD/MM/YYYY
	$date = date('d-m-Y', strtotime($passedDate));

	//Check for presence of more than 3 reservations in the same week 
	//before actually adding the reservation

	//INSTEAD PULL BASED ON STUDENT ID, THEN CHANGE THE DATES OF EACH
	//NOT BASED ON DATE
	$currentReservations = $reservation->getReservations($sID);
	
	if(checkWeek($date, $sID, $currentReservations)) {
		$date = date('m/d/Y', strtotime($passedDate));
		$start = $date." ".$start;//." ".$Meridiem1;
		$end = $date." ".$end;//." ".$Meridiem2;

		//Just realize display message is in format mm/dd/yyyy
		$reservation->addReservation($sID, $rID, $start, $end, $title, $desc);
		$_SESSION["userMSG"] = "You have successfully made a reservation for ".$start." to ".$end. " in Room ".$name."!";
		$_SESSION["msgClass"] = "success";
	}
	
	else {
		$_SESSION["userMSG"] = "You have already made 3 reservations this week";
	  	$_SESSION["msgClass"] = "failure";
	  }
}

header("Location: Home.php");


function checkWeek($d, $s, $current) {
	//Using slashes like we are, strtotime assumes mm/dd/yyyy, so fix
	//Reformate date and check for week in the year (of date being added)
	$reformatDate = date("j-m-Y", strtotime($d));

	// //Reformate date and check for week in the year (of date being added)

	$year = date("Y", strtotime($reformatDate));
	$week = date("W", strtotime($reformatDate));

	//Create counter, to be used to track if less than 3 reservations were made for that week 
	$counter = 0;

	//Check database table for all reservations under this student's ID
	// Compare the dates pulled with the week found
	for($x = 0; $x < count($current); $x++) {

		//Using slashes makes strtotime assume american date, aka m/d/y
		$tempDate = date("j-m-Y", strtotime($current[$x]["startTimeDate"]));
		$tempWeek = date("W", strtotime($tempDate));

		//    echo "Current week: " . $week . " Pulled week: " . $tempWeek;
		//    echo "<br>";

		if($week == $tempWeek) {
			$counter++;
		}
	}
	
	//return true if there aren't already 3 reservations made for that week
	if($counter < 3) {
		return true;
	}
	return false;
}

function checkOverlap($start) {

}
?>