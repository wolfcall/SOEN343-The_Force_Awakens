<?php
include "../Class/ReservationMapper.php";

// Start the session
session_start();

$reservation = new ReservationMapper();

$delete = $_POST['reID'];
$date = $_POST['date'];
$room = $_POST['rID'];

$reservation->deleteReservation($delete);

$_SESSION["userMSG"] = "You have successfully deleted Reservation #" .$delete . " on " .$date;
$_SESSION["msgClass"] = "success";


header("Location: Home.php");
?>