<?php
include "../Class/ReservationMapper.php";
include "../Class/RoomMapper.php";

// Start the session
session_start();

$reservation = new ReservationMapper();

$action = $_POST['action'];
$rID = $_POST['rID'];
var_dump($action);

var_dump($rID);

die();

//Dropped date from message for the moment since its not being posted - NB
$date = $_POST['date'];

$reservation->deleteReservation($delete);

$_SESSION["userMSG"] = "You have successfully deleted Reservation ID#" .$delete;
$_SESSION["msgClass"] = "success";


header("Location: Home.php");
?>