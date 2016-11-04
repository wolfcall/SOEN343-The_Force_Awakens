<?php
include "../Class/StudentMapper.php";

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);

$_SESSION["email"] = $email;

$log = new StudentMapper($email);
$validate = $log->checkUserAndPass($email,$password);

$wrongPass = "Invalid Password Entered. Please try again";
$noUser = "Account not Found. Please enter an email for an Existing Account";

if ($validate == true)
{
	header("Location: ../Pages/Home.php");
}
else
{
	$exist = $log->checkUserExist($email);
	
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