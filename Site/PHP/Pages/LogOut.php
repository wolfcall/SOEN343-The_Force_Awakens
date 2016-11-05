<?php

//Destroy all session variables
session_start();

unset($_SESSION['email']);
unset($_SESSION['userMSG']);

header("Location: ../../index.php");

?>