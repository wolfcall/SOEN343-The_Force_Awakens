<?php

include "../Class/RoomMapper.php";
include "../Class/StudentMapper.php";
include "../Class/ReservationMapper.php";

include "../Class/Unit.php";
include_once dirname(__FILE__).'/../Utilities/ServerConnection.php';

session_start();

$db = new ServerConnection();
$conn = $db->getServerConn();

$unit = new UnitOfWork($conn);

//In case the User clicks out of the Modal
$rID = $_POST['rID'];
$action = $_POST['action'];

//In case the User clicks out of the Modal
$_SESSION['roomID'] = $rID;
$_SESSION['action'] = $action;
$_SESSION['reID'] = $reID;

$roomAsked = new RoomMapper($rID, $conn);
$roomAnswer = $roomAsked->checkBusy($rID, $conn);
$roomName = $roomAsked->getName();

//Temporary fix until datePicker is changed (?)
$passedDate = htmlspecialchars($_POST["dateDrop"]);
$_SESSION['selectedDate'] = $passedDate;

if($roomAnswer == 0)
{
	$roomAsked->setBusy(true);
	$unit->registerDirtyRoom($roomAsked);
	$_SESSION['roomReserveID'] = $rID;
	echo "<input type = 'hidden' id='CRAroomAvailable' value='true' />";
}
else
{
	//$_SESSION["userMSG"] = "Room ".$roomName." is being used by another Student!";
	echo "<input type = 'hidden' id='CRAuserMsg' value='Room ".$roomName." is being used by another Student!' />";
	//$_SESSION["msgClass"] = "failure";
	echo "<input type = 'hidden' id='CRAmsgClass' value='failure' />";
	$_SESSION['roomAvailable'] = false;
	echo "<input type = 'hidden' id='CRAroomAvailable' value='false' />";
}

$unit->commit();
$db->closeServerConn($conn);

if($action == "modify" or $action == "delete")
{
	if($roomAnswer == 0)
	{
		//header("Location: ModifyReservation.php");
	}
	else
	{
		//header("Location: Home.php");
	}
}
else
{
	if($roomAnswer == 0)
	{
		$_SESSION['roomAvailable'] = true;
	}
	//header("Location: Home.php");
}