<?php
  session_start();
  require_once('../../config/database.php');
  include('../../shared/header.php');
  include('userClass.php');

  if (($_POST['submit'] === "SUBMIT EMAIL")){


      $userClass = new userClass();

      $email=$_POST['enter'];
      $id=$userClass->userLogin($login,$pass);
      if($id === true)
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
  <div class="forgot">

  <form action="">

    <input type="text" name="enter" placeholder = "ENTER YOUR EMAIL">
    <input type="submit" name = "create" value = "SUBMIT EMAIL">
  </form>
</div>
</body>
</html>

<?php
  include('../../shared/footer.php');
?>
