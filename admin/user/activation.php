<?php
  session_start();
  require_once('../../config/database.php');
  if(isset($_GET['code']) && isset($_GET['id'])){

    $activation = trim($_GET['code']);
    $login = trim($_GET['id']);

    $db = getDB();
    $stmt = $db->prepare("SELECT COUNT(*) AS num FROM Users WHERE login = :login AND activation = :activation");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':activation', $activation);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result['num'] == 1){
        $active=1;
        //Token is valid. Verify the email address
        $sql = "UPDATE Users SET active=:active WHERE login = :login";
        $stmt= $db->prepare($sql);
        $stmt->bindParam(':login', $login,PDO::PARAM_STR);
        $stmt->bindParam(':active', $active,PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['login']=$login;
        echo "<script>alert('$login, your account was succesfully created and verified!')</script>";
        echo "<script>window.open('../../index.php?login=$login', '_self')</script>";

  }
  else{
    echo "<script>alert('Make sure you entered everything right')</script>";
    echo "<script>window.open('create_account.php', '_self')</script>";
  }
 }
?>
