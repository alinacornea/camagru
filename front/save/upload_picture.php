<?php
  session_start();
  include('../../shared/header.php');
  if (!isset($_SESSION['login']))
  {
    $msg =  "You need to log in first";
    echo "<script> alert('$msg');window.open('../../admin/user/login.php', '_self'); </script>";
    die();
  }
  if(!empty($_FILES['file']['name']) && $_POST['submit'] === "Upload Image")
  {
    $permitted = array('image/gif', 'image/jpeg','image/png', 'image/pjpeg', 'text/plain'); //Set array of permittet filetypes
    $error = true; //Define an error boolean variable
    $filetype = ""; //Just define it empty.
    foreach( $permitted as $key => $value ) //Run through all permitted filetypes
    {
      if( $_FILES['file']['type'] == $value ) //If this filetype is actually permitted
        {
            $error = false; //Yay! We can go through
            $filetype = explode("/",$_FILES['file']['type']); //Save the filetype and explode it into an array at /
            $filetype = $filetype[0]; //Take the first part. Image/text etc and stomp it into the filetype variable
            $type = $filetype[1];//send the variale type to the style for using gd later
        }
    }
    if ($error == true){
          echo "<script>alert('Not a permitted filetype.')</script>";
          echo "<script>window.open('upload_picture.php', '_self')</script>";
    }
    if($error == false ) //If the file is permitted
    {
        move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $_FILES["file"]["name"]); //Move the file from the temporary position till a new one.
        if($filetype == "image" ) //If the filetype is image, show it!
        {
          $file = $_FILES["file"]["name"];
          echo '<div class="edit">';
          echo '<a href="style_picture.php?id=4&type='.$_FILES['file']['type'].'&file='.$file.'"> <img src="../images/arrow-back.png" class="arrow-back"> </a>';
          echo '<img src="uploads/'.$file.'" class="image">';
          echo '<a href="style_picture.php?id=1&type='.$_FILES['file']['type'].'&file='.$file.'"><img src="../images/arrow-next.png"class="arrow-next"> </a>';
          echo '</div>';
          ?>
          <div class="inside" align="center">
            <form action="save_pic.php?login=<?php echo $_GET['login'];?>" method="post" enctype="multipart/form-data" >
              <input type="submit" value="Save Image" name="submit">
            </form>
          </div>
        <?php
        }
        elseif($filetype == "text") //If its text, print it.
        {
          echo nl2br(file_get_contents("uploads/".$_FILES["file"]["name"]) );
        }
    }
  }
?>


<link rel="stylesheet" href="../style/index1.css">
  <div align="center">
      <form action="upload_picture.php?id=0&file=<?php echo $file?>" method="post" enctype="multipart/form-data">
          <input type="file"name="file" id="file" class="inputfile">
          <label for="file"> Choose a file </label> <br/>
          <input type="submit" value="Upload Image" name="submit">
        </form>
      </div>

<?php
  include('../../shared/footer.php');
?>
