<?php
require_once('../../config/database.php');
include('userClass.php');

$userClass = new userClass();

if ($_POST['submit'] === "Create an account")
{
	$first = $_POST['first'];
	$last = $_POST['last'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$login = $_POST['login'];
	$pass = $_POST['passwd'];
	$repeat = $_POST['repeat'];
	$table = "Users";

	if($pass === $repeat){

		$var=$userClass->checkPassword($pass);
		if($var){
			$activation = md5($email.time());
			$id=$userClass->userRegistration($first,$last,$phone,$email,$login,$activation,$pass);
			if ($id === true)
			{
				$To = $email;
				$link = "http://localhost:8080/camagru/admin/user/activation.php?code=$activation&id=$login";
				$Subject = "Verify your e-mail";
				$Message = "Hi ".$first. ","."<br/>" ."Your account on Camagru was created succesfully." ."<br/>"."Click the link in order to activate"."<br/><br/> <a
				href=".$link.">$link<br/></a>";
				$Headers = "From: camagru@gmail.com \r\n" .
				"Reply-To: camagru@gmail.com \r\n" .
				"Content-type: text/html; charset=UTF-8 \r\n";

				mail($To, $Subject, $Message, $Headers);
				
				echo "<script>alert('$login, please verify your email in order to finish you registration!')</script>";
				echo "<script>window.open('../../index.php', '_self')</script>";
			}
			else {
				$msg = "$login, this account already exists, pick a new login";
				echo "<script>alert('$msg');window.open('create_account.php', '_self');</script>";
			}
		}

		else{
			$msg = "$login, Password must contain 6 characters of letters, numbers and at least one special character.";
			echo "<script>alert('$msg');history.back();</script>";
		}
	}

	else{
		$msg = "$login, passwords did not match!";
		echo "<script>alert('$msg');history.back();</script>";
	}
}

?>
