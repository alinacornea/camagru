<?php  session_start(); ?>

<?php
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
<<<<<<< HEAD
      <input type="text" placeholder="Enter a Valid Phone: XXX-XXX-XXXX" name="phone" value="" required />
=======
      <input type="text" placeholder="Enter Phone (XXX) XXX-XXXX" name="phone" value="" required />
>>>>>>> 70fe96da1fb3867371367e7ec0f410364ce567e0

      <label><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" value= "" required />

      <label><b>Login</b></label>
      <input type="text" placeholder="Enter Login" name="login" value= "" required />

      <label><b>Password</b></label>
<<<<<<< HEAD
      <input type="password" placeholder="Enter Password     Note: your password must include at least 3 digits and 3 letters, 1 special character" name="passwd" value="" required/>
=======
      <input type="password" placeholder="Enter Password     Note: your password must include at least 3 digits and 3 letters" name="passwd" value="" required/>
>>>>>>> 70fe96da1fb3867371367e7ec0f410364ce567e0

      <label><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="repeat" value="" required/>

      <input type="checkbox" checked="checked" required /> <label>By creating an account you agree to our  </label> <a href="terms_privacy.php"> Terms & Privacy</a>.
      <input type="submit" class="signupbtn"  name="submit" value="Create an account"/>
    </div>
  </form>
</div>
  </body>
  </html>

<?php
  include('../../shared/footer.php');
?>
