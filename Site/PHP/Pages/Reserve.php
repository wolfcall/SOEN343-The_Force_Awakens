<?php
include "../Class/StudentMapper.php";
include "../Class/RoomMapper.php";
include "../Class/ReservationMapper.php";

// Start the session
session_start();

$wrongTime = "Your End Time cannot be the same as/before your Start Time! Please try again.";
$tooLong = "You cannot reserve for a time of more than 3 hours!";

$title = htmlspecialchars($_POST["title"]);
$desc = htmlspecialchars($_POST["description"]);

$date = htmlspecialchars($_POST["dateDrop"]);
$start = htmlspecialchars($_POST["startTime"]);
$end = htmlspecialchars($_POST["endTime"]);

$first = htmlspecialchars($_POST["firstName"]);
$last = htmlspecialchars($_POST["lastName"]);
$sID = htmlspecialchars($_POST["studentID"]);
$prog = htmlspecialchars($_POST["program"]);
$email = htmlspecialchars($_POST["email"]);

$rID = htmlspecialchars($_POST["roomNum"]);

$student = new StudentMapper($email);
$room = new RoomMapper($rID);
$reservation = new ReservationMapper();

/*
*	Must Consider the case of a reservation of 30 mins!!!
*/
if ( ($end-$start) > 3)
{
	echo "<script type='text/javascript'>alert('$tooLong');
	window.location.replace('Home.php');
	</script>";
	die();
}

else if ($end <= $start)
{
	echo "<script type='text/javascript'>alert('$wrongTime');
	window.location.replace('Home.php');
	</script>";
	die();
}	
else
{
	//Getting the ID of the Room 1
	//Should Obtain Either 1,2,3,4,5
	$rID = substr($rID,4);

	//Converting the Date to the Proper Format
	//Should Obtain DD/MM/YYYY
	$date = date('d/m/Y', strtotime($date));

	//Converting Start Time to the Proper Format
	//Should Obtain DD/MM/YYYY TIME AM/PM
	$Meridiem1 = "AM";
	$Meridiem2 = "AM";

	if($start >= 12 and $start <= 24)
	{
		$Meridiem1 = "PM";
		$start=$start-12;
		$start=$start.":00";
	}

	if($end >= 12 and $end <= 24)
	{
		$Meridiem2 = "PM";
		$end=$end-12;
		$end=$end.":00";
	}

	$start = $date." ".$start." ".$Meridiem1;
	$end = $date." ".$end." ".$Meridiem2;

//Check for presence of more than 3 reservations in the same week 
//before actually adding the reservation

//	$currentReservations = $reservation->getReservations($sID);
//	var_dump($currentReservations);

	$reservation->addReservation($sID, $rID, $start, $end, $title, $desc);

//	checkWeek($date, $sID, $currentReservations);

	header("Location: Home.php");
}

function checkWeek($d, $s, $current) {
	//Reformate date and check for week in the year (of date being added)
	$reformatDate = date("j/m/Y", strtotime($d));
	$year = date("Y", strtotime($d));
	$week = date("W", strtotime($reformatDate));

	//Create counter, to be used to track if less than 3 reservations were made for that week 
	$counter = 0;

	//Check database table for all reservations under this student's ID
	// Compare the dates pulled with the week found
	for($x = 0; $x < $current.count; $x++) {

		echo $current[0];
		 $tempDate = date("j/m/Y", strtotime($current[$x]));
		 $tempWeek = date("W", strtotime($tempDate));

		echo $week . " " . $tempWeek;
		echo "<br>";

	}
}
?>