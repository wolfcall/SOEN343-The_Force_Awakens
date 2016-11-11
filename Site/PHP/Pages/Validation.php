<?php
include "../Class/StudentMapper.php";

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);

$_SESSION["email"] = $email;

$wrongPass = "Invalid Password Entered. Please try again";
$noUser = "Account not Found. Please enter an email for an Existing Account";
$blankEmail = "The email field cannot be blank. Please enter a valid account email address";
$blankPass = "The password field cannot be blank. Please enter a valid password for your account";
    
if (empty($email))
{
    echo "<script type='text/javascript'>alert('$blankEmail');
		window.location.replace('../../index.php');
		</script>";
}
elseif (empty($password))
{
    echo "<script type='text/javascript'>alert('$blankPass');
		window.location.replace('../../index.php');
		</script>";
}
    
$log = new StudentMapper($email);
$validate = $log->checkUserAndPass($email,$password);
$_SESSION["sID"] = $validate;

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