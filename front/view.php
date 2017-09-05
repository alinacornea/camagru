<?php
  session_start();
  include('../shared/header.php');
  require_once('../config/database.php');

  $login = $_SESSION['login'];

  try{
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM Images WHERE login =:login");
    $stmt->bindParam("login", $login,PDO::PARAM_STR) ;
    $stmt->execute();
    ?>
    <div class ="images">
    <?php
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $title = $data['title'];
      $img = $data['img_path'];
      $likes = $data['likes'];
      $comments = $data['comments'];
      $creation = $data['creation_date'];
    ?>

    <link rel="stylesheet" media= "all" href ="style/view.css"/>
    <div class="each">
      <div class = "title"> <?php echo $title;?> </div>
        <div><img class= "image1" src = "save/user_images/<?php echo $img;?>"/>
         <img class= "likes" src = "images/icon_star.png"/><?php echo "Likes ".$likes;?></div>
        <div class="comments"> <?php echo $comments;?></div>
    </div>

<?php } }
    catch(PDOException $e) {
    echo '{"Error inserting":{"text":'. $e->getMessage() .'}}';
  }
  // include('../shared/footer.php');
?>
</div>
