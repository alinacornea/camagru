<?php
    session_start();
    require_once('../../config/database.php');
    $login = $_SESSION['login'];

    define('UPLOAD_DIR', 'user_images/');
    $name = uniqid() . '.png';
    $file = UPLOAD_DIR . $name;
    $img = $_POST['hidden'];
    $data = str_replace('data:image/png;base64,', '', $img);
    $data = str_replace(' ', '+', $data);
    $decode = base64_decode($data);
    file_put_contents($file, $decode);

    if ($_POST['submit'] === "Save pic")
    {
      $likes = 0;

      try{
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Images(title,img_path,login,likes,creation_date) VALUES (:name,:name,:login,:likes,:creation)");
        $stmt->bindParam("name", $name,PDO::PARAM_STR) ;
        $stmt->bindParam("name", $name,PDO::PARAM_STR) ;
        $stmt->bindParam("login", $login,PDO::PARAM_STR) ;
        $stmt->bindParam("likes", $likes,PDO::PARAM_INT) ;
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
?>
