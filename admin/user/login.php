<?php
  session_start();
  require_once('../../config/database.php');
  include('../../shared/header.php');
  include('userClass.php');

if (isset($_SESSION['login']))
{
  $msg =  "You already logged in as ".$_SESSION['login'] ;
  echo "<script> alert('$msg');window.open('../../index.php?login=$login', '_self'); </script>";
  die();
}

if (($_POST['submit'] === "SUBMIT")){


    $userClass = new userClass();
    $login=$_POST['login'];
    $pass=$_POST['passwd'];
    if(strlen(trim($login)) > 1 && strlen(trim($pass)) > 1)
    {
      $id=$userClass->userLogin($login,$pass);
      if($id == true)
      {
        $_SESSION['login']=$login;
        echo "<script>alert('$login, you log in succesfully!')</script>";
        echo "<script>window.open('../../index.php?login=$login', '_self')</script>";
      }
      else
      {
        echo "<script>alert('$login, please check details again!')</script>";
        echo "<script>window.open('login.php', '_self')</script>";
      }
    }
  }

?>
  <html>
  <title>Log in </title>
  <link rel="stylesheet" media= "all" href = "../style/login.css"/>
  <body>
  <div class="content">
  <form action = "" method="post">
    <input type= "login" name="login" placeholder = "LOGIN" value="<?php echo $_SESSION['login']; ?>" />
    <br />
    <input type = "password" name="passwd" placeholder= "PASSWORD" value="<?php echo $_SESSION['passwd'];?>" />
    <br />
    <input type="submit" name="submit" value="SUBMIT" />
    <br />
  </form>
  <form action="create_account.php">
    <input type="submit" name = "create" value = "CREATE AN ACCOUNT" onclick="location.href='create_account.php';">
  </form>
  <h4> <a href="forgot_passwd.php"> Forgot password?</a> </h4>
</div>
</body>
</html>

<?php
  include('../../shared/footer.php');
?>
