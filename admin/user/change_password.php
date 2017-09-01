<?php
  session_start();
  include('../../shared/header.php');
  require_once('../../config/database.php');
  include('userClass.php');

  // get values
  if(isset($_GET['code']) && isset($_GET['id'])){
    $activation = trim($_GET['code']);
    $login = trim($_GET['id']);
  }

  // post values
  if ($_POST['reset'] === "Change Password")
  {
    $new = $_POST['new'];
    $confirm = $_POST['confirm'];
    $userClass = new userClass();
    // check if they match
    if ($new == $confirm)
    {
      // check if it is a strong password
      $var=$userClass->checkPassword($new);
      if ($var){

        $data=$userClass->userEmail($login);
        $code = $data['activation'];

        $id=$userClass->userReset($new, $login);
        print($code);
        print"<br/>";
        print($activation);
        print"<br/>";
        print($id);

        if ($code == $activation && $id){
          $_SESSION['login']=$login;
          $msg = "$login, Your password was changed succesfully!.";
			    echo "<script>alert('$msg');window.open('../../index.php?login=$login', '_self');</script>";
        }
        else{
           $msg = "$login, Try again, something went wrong!.";
		       echo "<script>alert('$msg');window.open('reset_password.php?code=$activation&id=$login', '_self');</script>";
        }
      }
      else {
        # code...
        $msg = "$login, Password must contain 6 characters of letters, numbers and at least one special character.";
  		  echo "<script>alert('$msg');window.open('reset_password.php?code=$activation&id=$login', '_self');</script>";
      }
    }
    else{
      $msg = "$login, Passwords did not match!";
  	  echo "<script>alert('$msg');window.open('reset_password.php?code=$activation&id=$login', '_self');</script>";
    }
 }
?>
