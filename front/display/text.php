<?php
  // phpinfo();
  header("Content-type: image/png");
  $handle = ImageCreate(130, 150) or die ("can't create the image");
  $bg_color = imagecolorallocate($handle, 250, 0, 0);
  $txt_color = imagecolorallocate($handle, 0, 0, 0);

  // imagestring($handle, 150,25, 56, "working", $txt_color);
  imagettftext($handle, 20, 15, 30, 40, $txt_color, "hello");

  $s = imagepng($handle);

  print($s);


  // $file = $_GET['file'];
  // if(!file_exists('upload2.png')) {
  //   $img = imagecreatefrompng('dw-manipulate-me.png');
  //   imagefilter($img,IMG_FILTER_GRAYSCALE);
  //   imagepng($img,'upload2.png');
  //   imagedestroy($img);
  // }
?>
