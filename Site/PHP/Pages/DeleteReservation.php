<?php
include "../Class/ReservationMapper.php";
include "../Class/RoomMapper.php";

// Start the session
session_start();

$reservation = new ReservationMapper();

$delete = $_POST['delete'];
//Dropped date from message for the moment since its not being posted - NB
$date = $_POST['date'];

$reservation->deleteReservation($delete);

$_SESSION["userMSG"] = "You have successfully deleted Reservation ID#" .$delete;
$_SESSION["msgClass"] = "success";


header("Location: Home.php");
?>