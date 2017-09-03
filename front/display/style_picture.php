<?php
  include('../../shared/header.php');
  $file = $_GET['file'];
  $id = $_GET['id'];
  $img_name = "uploads/".$file;

  function image_type($file){

    return $type;
  }

  if ($id == 1){
    $img = imagecreatefrompng ($img_name);
    imagefilter($img, IMG_FILTER_GRAYSCALE);
    $imgname = "uploads/result_".$file;
    imagepng($img, $imgname ); // save image as gif
    imagedestroy($img);

  }
?>


<link rel="stylesheet" href="../style/index.css">
    <div class= "edit">
      <a href="style_picture.php?id=<?php if($id>0&&$id<=4){echo($id-1);}else{echo "4";}?>&file=<?php echo $file; ?>"> <img src="../images/arrow-back.png" class="arrow-back"> </a>
      <img src="<?php if($id==1){echo$imgname;}else{echo$img_name;}?>" class="image">
      <a href="style_picture.php?id=<?php if($id>=0&&$id<4){echo($id+1);}else{echo "0";}?>&file=<?php echo $file; ?>"><img src="../images/arrow-next.png"class="arrow-next"> </a>
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

<!-- if ($id == 2) {echo "1";} else if ($id == 3) {echo "2";} else {echo "0";} -->
