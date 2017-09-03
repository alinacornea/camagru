<?php
  // phpinfo();
  include('../../shared/header.php');
  header("Content-type: image/png");
  $handle = ImageCreate(130, 50) or die ("can't create the image");
  $txt_color = imagecolorallocate($handle, 250, 0, 0);
  $bg_color = imagecolorallocate($handle, 0, 0, 0);

  imagestring($handle, 5, 5, 18, "hello", $txt_color);

  print(imagepng($handle));


  // $file = $_GET['file'];
  // if(!file_exists('upload2.png')) {
  //   $img = imagecreatefrompng('dw-manipulate-me.png');
  //   imagefilter($img,IMG_FILTER_GRAYSCALE);
  //   imagepng($img,'upload2.png');
  //   imagedestroy($img);
  // }
?>




<link rel="stylesheet" href="../style/index3.css">
    <div class= "edit">
      <a href="style_picture.php"> <img src="../images/arrow-back.png" class="arrow-back"> </a>
      <img src="uploads/<?php echo $result; ?>" class="image">
      <a href="style_picture.php"><img src="../images/arrow-next.png"class="arrow-next"> </a>
    </div>
    <div align="center" class="inside">
      <form action="save_picture.php" method="post" enctype="multipart/form-data" >
          <input type="submit" value="Save Image" name="submit">
      </form>
    </div>
    <div align = "center">
      <form action="upload_picture.php" method="post" enctype="multipart/form-data">
          <input type="file"name="file" id="file" class="inputfile">
          <label for="file"><b> Choose a file</b> </label> <br/>
          <input type="submit" value="Upload Image" name="submit">
      </form>
    </div>
<?php
  include('../../shared/footer.php');
?>
