<?php
include "../Class/Login.php";

$log = new Login();

$validate = $log->checkUserAndPass();

$wrongPass = "Invalid Password Entered. Please try again";
$noUser = "Account not Found. Please enter an email for an Existing Account";

if ($validate == true)
{
	header("Location: ../Pages/Reservation.php");
	exit();
}
else
{
	$exist = $log->checkUserExist();
	
	if ($exist == true)
	{
		echo "<script type='text/javascript'>alert('$wrongPass');
		window.location.replace('../../index.php');
		</script>";
	}
	else 
	{
		echo "<script type='text/javascript'>alert('$noUser');
		window.location.replace('../../index.php');
		</script>";
	}	
}
?>