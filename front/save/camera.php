<?php
    session_start();
    require_once('../../config/database.php');
    $login = $_SESSION['login'];
<<<<<<< HEAD
    define('UPLOAD_DIR', 'user_images/');
    $name = uniqid() . '.png';
    $file = UPLOAD_DIR . $name;
    $img = $_POST['hidden'];

=======
    define('UPLOAD_DIR', 'uploads/');
    $file = UPLOAD_DIR . uniqid() . '.png';
    $img = $_POST['hidden'];
    $img_style = $_POST['img_style'];

    print($img_style);
>>>>>>> 70fe96da1fb3867371367e7ec0f410364ce567e0

    $data = str_replace('data:image/png;base64,', '', $img);
    $data = str_replace(' ', '+', $data);
    $decode = base64_decode($data);
    file_put_contents($file, $decode);
<<<<<<< HEAD
    // echo '<img src="data:image/gif;base64,' . $data . '" />';

    if ($_POST['submit'] === "Save pic")
    {
      $likes = 0;
      $comments_nb = 0;
      print("here");

      try{
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Images(title,img_path,login,likes,comments_nb,creation_date) VALUES (:name,:name,:login,:likes,:comments_nb,:creation)");
        $stmt->bindParam("name", $name,PDO::PARAM_STR) ;
        $stmt->bindParam("name", $name,PDO::PARAM_STR) ;
        $stmt->bindParam("login", $login,PDO::PARAM_STR) ;
        $stmt->bindParam("likes", $likes,PDO::PARAM_INT) ;
        $stmt->bindParam("comments_nb", $comments_nb,PDO::PARAM_INT);
        $creation = date('Y-m-d H:i:s');
        $stmt->bindParam("creation", $creation,PDO::PARAM_STR) ;
        $stmt->execute();
        $id=$db->lastInsertId(); // Last inserted row id
        $db = null;
      }

      catch(PDOException $e) {
        echo '{"Error inserting":{"text":'. $e->getMessage() .'}}';
      }

      echo "<script>alert('$login, your picture was saved!')</script>";
      echo "<script>window.open('../../index.php', '_self')</script>";
    }
=======

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
>>>>>>> 70fe96da1fb3867371367e7ec0f410364ce567e0
?>
