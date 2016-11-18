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

//Modify specific flag
$modifying = false;
if($_POST["action"] == "modifying")
{
	$modifying = true;
}

//Reservation ID for modification purposes only
$reservationID = htmlspecialchars($_POST["reservationID"]);

$wrongTime = "Your End Time must be after your Start Time! Please try again.";
$tooLong = "You cannot reserve for a time of more than 3 hours!";
$currentTime = "You cannot make a reservation on a time that already passed!";

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

//This holds the number of weeks repeated for a reservation. Defaults to 0 in case modify comes through here
$repeatReservation = 0;
if(htmlspecialchars($_POST["repeatReservation"]) > 0) $repeatReservation = htmlspecialchars($_POST["repeatReservation"]);

//Variable to hold the number of reservations to add in sequence (week repeats)
$reserveCount = 1 + $repeatReservation;

//Getting the ID of the Room 1
//Should Obtain Either 1,2,3,4,5
$rID = htmlspecialchars($_POST["roomID"]);

$student = new StudentMapper($email, $conn);
$reservation = new ReservationMapper();
$room = new RoomMapper($rID, $conn);

$name = $room->getName();

$startEx = explode(":", $start);
$startFloat = ($startEx[0] + ($startEx[1]/60));

$endEx = explode(":", $end);
$endFloat = ($endEx[0] + ($endEx[1]/60));

date_default_timezone_set('US/Eastern');
$ourTime = date('H:i');
$ourTimeEx = explode(":", $ourTime);
$ourTimeFloat = ($ourTimeEx[0] + ($ourTimeEx[1]/60));

$ourDate = date('y-m-d');
$ourDateFormat = strtotime($ourDate);

$dateAmer = date('y-m-d', strtotime($passedDate));
$dateAmerFormat = strtotime($dateAmer);

$dateDiff = $ourDateFormat - $dateAmerFormat;

/*
*	Check if the reservation will be before the current time
*/
if($ourTimeFloat > $startFloat && $dateDiff == 0)
{
	$_SESSION["userMSG"] = $currentTime;
	$_SESSION["msgClass"] = "failure";
}
/*
*	If reservation will last more than 3 hours
*/
else if ( ($endFloat-$startFloat) > 3)
{
	$_SESSION["userMSG"] = $tooLong;
	$_SESSION["msgClass"] = "failure";
}
/*
*	Check if the end time of the reservation will be before the start time
*/
else if ($endFloat <= $startFloat)
{
	$_SESSION["userMSG"] = $wrongTime;
	$_SESSION["msgClass"] = "failure";
}	
/*
*	Continue with the Reservation normally
*/
else
{
	//Check for presence of more than 3 reservations in the same week 
	//before actually adding the reservation
	$currentReservations = $reservation->getReservations($sID, $conn);

	$multiReserveSuccess = true;
	
	//For multi reservations, this count the number of successes and waitlists and weekfailures (cant reserve more than 3 in that week)
	$successes = 0;
	$waitlists = 0;
	$weekfailures = 0;
	
	for($a = 0; $a < $reserveCount; $a++)
	{
		$res = new ReservationMapper();
		
		//Converting the Date to the Proper Format
		//Should Obtain DD/MM/YYYY	
		$dateEU = date('d-m-Y', strtotime($passedDate . ' + ' . (7*$a) . ' days'));
		$dateAmer = date('m/d/Y', strtotime($passedDate . ' + ' . (7*$a) . ' days'));
		//changed to newStart to facilitate repeat reservations
		$newStart = $dateAmer." ".$start;
		$newEnd = $dateAmer." ".$end;
		
		//Get the list of reservations in same room and on same day
		$availableTimes = $reservation->getReservationsByRoomAndDate($rID, $newStart, $conn);

		//Get start and end time of new reservation, convert the difference to mins to find duration
		$startDate = new DateTime($newStart);
		$endDate = new DateTime($newEnd);
		
		if(checkWeek($dateEU, $sID, $currentReservations) && checkOverlap($startDate, $endDate, $availableTimes)) 
		{
			if($modifying)
			{
				//Updates reservation instead of adding a new one
				$res->setStartTimeDate($newStart);
				$res->setEndTimeDate($newEnd);
				$res->setTitle($title);
				$res->setDescription($desc);
				$res->setREID($reservationID);
				$res->setWait(0);
				
				$unit->registerDirtyReservation($res);
				
				$_SESSION["userMSG"] = "You have successfully updated your reservation ID ".$reservationID." for ".$newStart." to ".$newEnd." in Room ".$name."!";
				$_SESSION["msgClass"] = "success";
			}
			else
			{
				//Just realize display message is in format mm/dd/yyyy
				$res->setSID($sID);
				$res->setRID($rID);
				$res->setStartTimeDate($newStart);
				$res->setEndTimeDate($newEnd);
				$res->setTitle($title);
				$res->setDescription($desc);
				$res->setWait(0);
				
				$unit->registerNewReservation($res);
				
				if($reserveCount == 1) {
					//Display for single reservation (no repeat)
					$_SESSION["userMSG"] = "You have successfully made a reservation for ".$newStart." to ".$newEnd. " in Room ".$name."!";
					$_SESSION["msgClass"] = "success";
				}
				else
				{
					$reserves++;
				}
			}
		}
		else if ($_SESSION["userMSG"] == "This option overlaps, you've been added to the Waitlist!") 
		{
			if($reserveCount == 1) 
			{
				//Display for single reservation (no repeat)
				$res->setSID($sID);
				$res->setRID($rID);
				$res->setStartTimeDate($newStart);
				$res->setEndTimeDate($newEnd);
				$res->setTitle($title);
				$res->setDescription($desc);
				$res->setWait(1);
				
				$unit->registerNewReservation($res);
			}
			else
			{
				$waitlists++;
			}
		}
	}
	//To display message after multireservation
	if($reserveCount > 1)
	{
		$_SESSION["userMSG"] = "Multireservations happened!";
		$_SESSION["msgClass"] = "success";
	}
}

$_SESSION['roomAvailable'] = false;

$unit->commit();
$db->closeServerConn($conn);

header("Location: ClearRoom.php");

function checkWeek($d, $s, $current) {
	//returns true if you are modifying a reservation, it is assumed existing reservations are within 3/week limit
	global $modifying;
	global $weekfailures;
	if($modifying)
	{
		return true;
	}
	
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
	
	$_SESSION["userMSG"] = "You have already made 3 reservations this week";
	$_SESSION["msgClass"] = "failure";
	$weekfailures++; //This should modify the variable outside the function
	return false;
}

function checkOverlap($start, $end, $current) {
	$newStartTime = $start->format("Hi");
	$newEndTime = $end->format("Hi");
	//made global to get variable above
	global $reservationID;
	for($x = 0; $x < count($current); $x++) {
		//Added IF check for modification, won't check overlap against itself
		if($current[$x]->getID() != $reservationID)
		{
			//Get start and end time of new reservation, convert the difference to mins to find duration
			$startTime = new DateTime($current[$x]->getStartTimeDate());
			$endTime = new DateTime($current[$x]->getEndTimeDate());

			$tempStart = $startTime->format("Hi");
			$tempEnd = $endTime->format("Hi");
			
		//	echo "Start: " . $tempStart . " End: " . $tempEnd."<br>";
			
			//If pulled value starts after the ending of the new reservation, ignore this case
			if($tempStart >= $newEndTime) {
				continue;
			}

			//If pulled value ends before the start of the new reservation, ignore this case
			else if($tempEnd <= $newStartTime) {
				continue;
			}
			//If it's not ignored, then this case is a conflict, return false
			else {
				$startFormat = $startTime->format("H:i");
				$endFormat = $endTime->format("H:i");

				//If there's an overlap, add new date to waitlist
				$_SESSION["userMSG"] = "This option overlaps, you've been added to the waitlist";
				$_SESSION["msgClass"] = "failure";
				return false;
			}
		}
	}
	
	return true;
}


//Get duration of reservation, from start to end, in mins
//LEAVE FOR NOW, MIGHT NEED DURATION IN FUTURE

// function getDuration($startTime, $endTime) {
// 	$diff = date_diff($startTime, $endTime);
// 	$dateArray = explode(":", $diff->format('%h:%i'));
// 	$totalMinutes = $dateArray[0]*60 + $dateArray[1];
// 	return $totalMinutes;
// }
?>