<?php
  session_start();
  require_once('../../config/database.php');

  $file = $_GET['image'];
  $id = $_GET['id'];

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
  if ($_POST['submit'] === "Save Image")
  {
    $login = $_SESSION['login'];
    if ($id != 0){
      $path = "uploads/result".$id."_".$file;
    }
    else{
      $path = "uploads/".$file;
    }

    $img = $id ."_".$file;
    copy($path, "user_images/$img");
    $likes = 0;
    $comments_nb = 0;

    try{
      $db = getDB();
      $stmt = $db->prepare("INSERT INTO Images(title,img_path,login,likes,comments_nb,creation_date) VALUES (:file,:img,:login,:likes,:comments_nb,:creation)");
      $stmt->bindParam("file", $file,PDO::PARAM_STR) ;
      $stmt->bindParam("img", $img,PDO::PARAM_STR) ;
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
    $name->delete("uploads");

    echo "<script>alert('$login, your picture was saved!')</script>";
    echo "<script>window.open('../../index.php', '_self')</script>";
  }

?>
