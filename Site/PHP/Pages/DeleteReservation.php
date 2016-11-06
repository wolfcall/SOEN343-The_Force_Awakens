<?php
include "../Class/ReservationMapper.php";

// Start the session
session_start();

$reservation = new ReservationMapper();

$deleteList = $_POST['deleteList'];
$count = count($deleteList);

foreach($deleteList as &$reserve)
{
    $reservation->deleteReservation($reserve);
}

if($count > 0)
{
    $_SESSION["userMSG"] = "You have successfully deleted " . $count . " reservations!";
    $_SESSION["msgClass"] = "success";
}
else
{
    $_SESSION["userMSG"] = "You have not selected any reservations for deletion!";
    $_SESSION["msgClass"] = "failure";
}
header("Location: Home.php");
?>