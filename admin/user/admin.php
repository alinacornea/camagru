<?php
  session_start();
  include('../../shared/header.php');
?>

  <html>
  <title>Log in </title>
  <link rel="stylesheet" media= "all" href = "../style/log.css"/>
  <body>
  <div class="content">
  <form action = "" method="post">
    <input type= "login" name="login" placeholder = "ADMIN LOGIN" value="<?php echo $_SESSION['login']; ?>" />
    <br />
    <input type = "password" name="passwd" placeholder= "ADMIN PASSWORD" value="<?php echo $_SESSION['passwd'];?>" />
    <br />
    <input type="submit" name="submit" value="SUBMIT" />
    <br />
  </form>
</div>
</body>
</html>

<?php
  include('../../shared/footer.php');
?>
