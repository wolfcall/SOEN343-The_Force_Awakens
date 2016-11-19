<?php
session_start();

function checkWeek($d, $current) {
	$_SESSION["confirmedRes"] = 0;
	//returns true if you are modifying a reservation, it is assumed existing reservations are within 3/week limit
	if($_SESSION["modifying"])
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
	// Compare the dates pulled with the week found when not looking at waitlist value
	for($x = 0; $x < count($current); $x++) {
		//Only if not on waitlist
		if($current[$x]["waitlisted"] == "0") {
			//Using slashes makes strtotime assume american date, aka m/d/y
			$tempDate = date("j-m-Y", strtotime($current[$x]["startTimeDate"]));
			$tempWeek = date("W", strtotime($tempDate));
		
			if($week == $tempWeek) {
				$counter++;
			}
		}
	}
	
	//return true if there aren't already 3 reservations made for that week

	$_SESSION["confirmedRes"] = $counter;
	if($counter < 3) {
		return true;
	}
	
	$_SESSION["userMSG"] = "You have already made 3 reservations this week";
	$_SESSION["msgClass"] = "failure";
	array_push($_SESSION["statusArray"], "weeklimited");
	
	return false;
}

function checkOverlap($start, $end, $current, $previousID) {
	$newStartTime = $start->format("Hi");
	$newEndTime = $end->format("Hi");
	//made global to get variable above
	for($x = 0; $x < count($current); $x++) {
		//Added IF check for modification, won't check overlap against itself
		//Added if check for soon to be deleted value
		if(($current[$x]->getID() != $_SESSION["reservationID"]) && ($current[$x]->getID() != $previousID))
		{
			//Get start and end time of new reservation, convert the difference to mins to find duration
			$startTime = new DateTime($current[$x]->getStartTimeDate());
			$endTime = new DateTime($current[$x]->getEndTimeDate());

			$tempStart = $startTime->format("Hi");
			$tempEnd = $endTime->format("Hi");
			
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
				if($_SESSION["sID"] == $current[$x]->getSID())
				{
					$_SESSION["selfReservation"] = true;
					return false;
				}
				$startFormat = $startTime->format("H:i");
				$endFormat = $endTime->format("H:i");

				//If there's an overlap, add new date to waitlist
				$_SESSION["userMSG"] = "This option overlaps, you've been added to the Waitlist!";
				$_SESSION["msgClass"] = "failure";
				return false;
			}
		}
	}
	
	return true;
}
?>