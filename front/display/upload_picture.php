<?php
  include('../../shared/header.php');
  if(!empty($_FILES['file']))
  {
    $permitted = array('image/gif', 'image/jpeg', 'image/jpg','image/png', 'image/pjpeg', 'text/plain'); //Set array of permittet filetypes
    $error = true; //Define an error boolean variable
    $filetype = ""; //Just define it empty.

    foreach( $permitted as $key => $value ) //Run through all permitted filetypes
    {
      if( $_FILES['file']['type'] == $value ) //If this filetype is actually permitted
        {
            $error = false; //Yay! We can go through
            $filetype = explode("/",$_FILES['file']['type']); //Save the filetype and explode it into an array at /
            $filetype = $filetype[0]; //Take the first part. Image/text etc and stomp it into the filetype variable
        }
    }
    if( $error == false ) //If the file is permitted
    {
        move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $_FILES["file"]["name"]); //Move the file from the temporary position till a new one.
        if($filetype == "image" ) //If the filetype is image, show it!
        {
          echo '<img src="uploads/'.$_FILES["file"]["name"].'" class="image">';
          ?>
          <div class="inside" align="center">
            <form action="save_picture.php?login=<?php echo $_GET['login'];?>" method="post" enctype="multipart/form-data" >
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
    else{
      echo "Not permitted filetype.";
      }
  }
?>


<link rel="stylesheet" href="../style/index.css">
  <div align="center">
      <form action="upload_picture.php?login=<?php echo $_GET['login'];?>" method="post" enctype="multipart/form-data">
          <input type="file"name="file" id="file" class="inputfile">
          <label for="file"><b> Choose a file</b> </label> <br/>
          <input type="submit" value="Upload Image" name="submit">
        </form>
      </div>

<?php
  include('../../shared/footer.php');
?>
