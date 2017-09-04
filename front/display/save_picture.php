<?php
  session_start();
  require_once('../../config/database.php');
  $file = $_GET['image'];
  $id = $_GET['id'];
  if ($_POST['submit'] === "Save Image")
  {
    $login = $_SESSION['login'];

    try{
      $db = getDB();
      $stmt = $db->prepare("INSERT INTO Images(title,img_path,login,likes,comments,creation_date) VALUES (:title,:img,:login,:likes,:comments,:creation)");
      $stmt->bindParam("title", $title,PDO::PARAM_STR) ;
      $stmt->bindParam("img", $img,PDO::PARAM_STR) ;
      $stmt->bindParam("login", $login,PDO::PARAM_STR) ;
      $stmt->bindParam("likes", $likes,PDO::PARAM_INT) ;
      $stmt->bindParam("comments", $comments,PDO::PARAM_STR);
      $creation = date('Y-m-d H:i:s');
      $stmt->bindParam("creation", $creation,PDO::PARAM_STR) ;
      $stmt->execute();
      $id=$db->lastInsertId(); // Last inserted row id
      $db = null;
      return true;
    }
    else{
      $db = null;
      return false;
      }
    }
    catch(PDOException $e) {
      echo '{"Error inserting":{"text":'. $e->getMessage() .'}}';
    }
  }

?>
