<?php
  session_start();
  require_once('../../config/database.php');

  $login = $_SESSION['login'];
  $id = $_GET['id'];

  $db = getDB();
  try{
    $stmt = $db->prepare("DELETE from Images where id =:id AND login =:login");
    $stmt->bindParam('login', $login, PDO::PARAM_STR);
    $stmt->bindParam('id', $id, PDO::PARAM_INT);
    $stmt->execute();
  }
  catch(PDOException $e) {
  echo '{"Error deleting your picture:":{"text":'. $e->getMessage() .'}}';
}
  echo "<script>window.open('../../front/view.php', '_self')</script>";
?>
