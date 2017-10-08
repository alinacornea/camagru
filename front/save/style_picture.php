<?php
  include('../../shared/header.php');
  $file = $_GET['file'];
  $id = $_GET['id'];
  $img_name = "uploads/".$file;
  $type = $_GET['type'];
  if ($id == 1){
    $imgname1 = "uploads/result1_".$file;
    if ($type == "image/png"){
      $img = imagecreatefrompng ($img_name);
      imagefilter($img, IMG_FILTER_GRAYSCALE);
      imagepng($img, $imgname1 );
    }
    else if ($type == "image/jpeg"){
      $img = imagecreatefromjpeg ($img_name);
      imagefilter($img, IMG_FILTER_GRAYSCALE);
      imagejpeg($img, $imgname1 );
    }
    else if ($type == "image/gif"){
      $img = imagecreatefromgif ($img_name);
      imagefilter($img, IMG_FILTER_GRAYSCALE);
      imagegif($img, $imgname1 ); // save image as gif
    }
  }
  if ($id == 2){
    $imgname2 = "uploads/result2_".$file;
    if ($type == "image/png"){
      $img = imagecreatefrompng ($img_name);
      imagefilter($img,IMG_FILTER_MEAN_REMOVAL);
      imagepng($img, $imgname2 );
    }
    else if ($type == "image/gif"){
      $img = imagecreatefromgif ($img_name);
      imagefilter($img, IMG_FILTER_MEAN_REMOVAL);
      imagegif($img, $imgname2 );
    }
    else if ($type == "image/jpeg"){
      $img = imagecreatefromjpeg ($img_name);
      imagefilter($img, IMG_FILTER_MEAN_REMOVAL);
      imagejpeg($img, $imgname2 );
    }
    imagedestroy($img);
  }
  if ($id == 3){
    $imgname3 = "uploads/result3_".$file;
    if ($type == "image/png"){
      $img = imagecreatefrompng ($img_name);
      imagefilter($img,IMG_FILTER_COLORIZE, 100, 0, 0);
      imagepng($img, $imgname3 );
    }
    else if ($type == "image/gif"){
      $img = imagecreatefromgif ($img_name);
      imagefilter($img, IMG_FILTER_COLORIZE, 100, 0, 0);
      imagegif($img, $imgname3 );
    }
    else if ($type == "image/jpeg"){
      $img = imagecreatefromjpeg ($img_name);
      imagefilter($img, IMG_FILTER_COLORIZE, 100, 0, 0);
      imagejpeg($img, $imgname3 );
    }
    imagedestroy($img);
  }

  if ($id == 4){
    $imgname4 = "uploads/result4_".$file;
    if ($type == "image/png"){
      $img = imagecreatefrompng ($img_name);
      imagefilter($img, IMG_FILTER_COLORIZE,100,50,0);
      imagepng($img, $imgname4 );
    }
    else if ($type == "image/gif"){
      $img = imagecreatefromgif ($img_name);
      imagefilter($img, IMG_FILTER_COLORIZE,100,50,0);
      imagegif($img, $imgname4 );
    }
    else if ($type == "image/jpeg"){
      $img = imagecreatefromjpeg ($img_name);
      imagefilter($img, IMG_FILTER_COLORIZE,100,50,0);
      imagejpeg($img, $imgname4 );
    }
    imagedestroy($img);
  }

?>


<link rel="stylesheet" href="../style/index1.css">
    <div class= "edit">
      <a href="style_picture.php?id=<?php if($id>0&&$id<=4){echo($id-1);}else{echo "4";}?>&type=<?php echo $type;?>&file=<?php echo $file; ?>"> <img src="../images/arrow-back.png" class="arrow-back"> </a>
      <img src="<?php if($id==1){echo$imgname1;}else if($id == 2){echo$imgname2;} else if($id==3){echo$imgname3;} else if($id==4){echo$imgname4;}else{echo$img_name;}?>" class="image">
      <a href="style_picture.php?id=<?php if($id>=0&&$id<4){echo($id+1);}else{echo "0";}?>&type=<?php echo $type;?>&file=<?php echo $file; ?>"><img src="../images/arrow-next.png"class="arrow-next"> </a>
    </div>
    <div align="center" class="inside">
      <form action="save_pic.php?id=<?php echo$id;?>&image=<?php echo$file;?>" method="post" enctype="multipart/form-data" >
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
