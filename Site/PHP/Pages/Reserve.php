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

	$reservation->addReservation($sID, $rID, $start, $end, $title, $desc);

	header("Location: Home.php");
}
?>