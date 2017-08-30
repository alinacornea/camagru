<?php  session_start(); ?>

<?php
// require_once('../../initialize.php');
  include('../../shared/header.php');
?>

  <html>
  <title>Create_account</title>
  <link rel="stylesheet" media= "all" href ="../style/create_account.css"/>
  <body>
    <h2> Registration form: </h2>
    <div align="center">
      <form id = "board" action="create_action.php" method="post" >
    <div class="container" align="left">
      <label><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="first" value= "" required />

      <label><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="last" value= "" required />

      <label><b>Phone number</b></label>
      <input type="text" placeholder="Enter Phone (XXX) XXX-XXXX" name="phone" value="" required />

      <label><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" value= "" required />

      <label><b>Login</b></label>
      <input type="text" placeholder="Enter Login" name="login" value= "" required />

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password     Note: your password must include at least 1 digit and 1 capital letter" name="passwd" value="" required/>

      <label><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="pssswd" value="" required/>
      <input type="checkbox" checked="checked"> By creating an account you agree to our <a href="privacy_terms.php">Terms & Privacy</a>.
      <input type="submit" class="signupbtn"  name="submit" value="Create an account"/>
    </div>
  </form>
</div>
  </body>
  </html>

<?php
  include('../../shared/footer.php');
?>
