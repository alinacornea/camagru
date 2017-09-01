<?php
  include('../../shared/header.php');
  require_once('../../config/database.php');
  include('userClass.php');

  if ($_POST['reset'] === "SEND PASSWORD RESET INSTRUCTIONS"){
      $userClass = new userClass();
      $email=$_POST['enter'];
      // get more  info  about user from database
      $data=$userClass->userEmail($email);
      $login = $data['login'];
      $activation = $data['activation'];
      // check if this email actually exist
      if (!$data){
        echo "<script>alert('Sorry, was not found an account with this email: $email ')</script>";
        echo "<script>window.open('login.php', '_self')</script>";
      }
      else{
      // send a email
        $To = $email;
        $link = "http://localhost:8080/camagru/admin/user/reset_password.php?code=$activation&id=$login";
        $Subject = "Forgot password?";
        $Message = "Hi ".$login. ","."<br/>" ."As you have requested for reset password instructions, here they are, please follow the URL." ."<br/><br/> <a
        href=".$link.">$link<br/></a>";
        $Headers = "From: camagru@gmail.com \r\n" .
        "Reply-To: camagru@gmail.com \r\n" .
        "Content-type: text/html; charset=UTF-8 \r\n";
        mail($To, $Subject, $Message, $Headers);
        
        echo "<script>alert('$login, Password reset instructions have been mailed to you')</script>";
        echo "<script>window.open('login.php', '_self')</script>";
    }
 }

?>

  <title>Forgot password </title>
  <link rel="stylesheet" media= "all" href = "../style/login.css"/>
  <div class="forgot" align="center">
  <h4> Enter your email or username below and we will send you a link to reset your password </h4>
  <form action="forgot_passwd.php" method="post">
    <input type="text" name="enter" placeholder = "ENTER  EMAIL OR LOGIN" value= "" />
    <input type="submit" name="reset" value = "SEND PASSWORD RESET INSTRUCTIONS"/>
  </form>
</div>


<?php
  include('../../shared/footer.php');
?>
