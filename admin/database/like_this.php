<?php
    session_start();
    require_once('../../config/database.php');
    $id = $_GET['action'];
    $login = $_SESSION['login'];

    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM Images WHERE login = :login AND id = :id");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $likes = $result['likes'] + 1;
    $sql = "UPDATE Images SET likes=:likes WHERE login = :login AND id = :id";
    $stmt= $db->prepare($sql);
    $stmt->bindParam(':login', $login,PDO::PARAM_STR);
    $stmt->bindParam(':likes', $likes,PDO::PARAM_INT);
    $stmt->bindParam(':id', $id,PDO::PARAM_INT);

    $stmt->execute();
    echo "<script>window.open('../../index.php', '_self')</script>";
  // else{
  //   echo "<script>alert('Make sure you entered everything right')</script>";
  //   echo "<script>window.open('create_account.php', '_self')</script>";
  // }

?>
