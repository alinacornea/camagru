<?php
  include('../../shared/header.php');

  if(isset($_GET['code']) && isset($_GET['id'])){
    // get values
    $activation = trim($_GET['code']);
    $login = trim($_GET['id']);
  }
?>

  <title>Reset password </title>
  <link rel="stylesheet" media= "all" href = "../style/login.css"/>
  <div class="forgot" align="center">
  <h4> Please enter a new password. </h4>
  <form action="change_password.php?code=<?php echo $activation;?>&id=<?php echo $login;?>" method="post">
    <input type="password" name="new" placeholder = "New Password" value= "" />
    <input type="password" name="confirm" placeholder = "Confirm Password" value= "" />
    <input type="submit" name="reset" value = "Change Password"/>
  </form>
</div>


<?php
  include('../../shared/footer.php');
?>
