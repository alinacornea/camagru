<?php
    session_start();
    require_once('../../config/database.php');
    $login = $_SESSION['login'];
    define('UPLOAD_DIR', 'uploads/');
    $file = UPLOAD_DIR . uniqid() . '.png';
    $img = $_POST['hidden'];
    $img_style = $_POST['img_style'];

    print($img_style);

    $data = str_replace('data:image/png;base64,', '', $img);
    $data = str_replace(' ', '+', $data);
    $decode = base64_decode($data);
    file_put_contents($file, $decode);

    $img = imagecreatefrompng($file);
    if ($img_style === "grayscale(100%)"){
        imagefilter($img, IMG_FILTER_GRAYSCALE);}
    if ($img_style === "brightness(180%)"){
      imagefilter($img, IMG_FILTER_BRIGHTNESS, 50);}
    if ($img_style === "invert(100%)"){
      imagefilter($img, IMG_FILTER_NEGATE);}
    if ($img_style === "blur(2px)"){
      for ($i = 0; $i < 5; $i++) {
      imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);
    }}
    if ($img_style === "contrast(200%)"){
      imagefilter($img, IMG_FILTER_CONTRAST, -40);}
    if ($img_style === "sepia(100%)"){
      imagefilter($img,IMG_FILTER_GRAYSCALE);
      imagefilter($img,IMG_FILTER_BRIGHTNESS,-15);
      imagefilter($img, IMG_FILTER_CONTRAST, -3);
      imagefilter($img, IMG_FILTER_COLORIZE,47,38,15);}
    imagepng($img, $file);
    imagedestroy($img);

  class deleteClass {

  public function delete($path) {
      if (is_dir($path)) {
          array_map(function($value) {
                $this->delete($value);
                rmdir($value);
            },glob($path . '/*', GLOB_ONLYDIR));
            array_map('unlink', glob($path."/*"));
        }
    }
  }
  $name = new deleteClass();

  // save it in database
  $name->delete("uploads");

  echo "<script>alert('$login, your picture was saved!')</script>";
  echo "<script>window.open('../../index.php', '_self')</script>";
?>
