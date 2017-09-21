<?php
  session_start();
  include('shared/header.php');
  require_once('config/database.php');
  include('admin/database/sent_mail.php');

  $db = getDB();
  $user = $_SESSION['login'];

  if (isset($_GET['action']) && $user){

      $id = $_GET['action'];
      $stmt = $db->prepare("SELECT * FROM Images WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $likes = $result['likes'] + 1;
      $sql = "UPDATE Images SET likes=:likes WHERE id = :id";
      $stmt= $db->prepare($sql);
      $stmt->bindParam(':likes', $likes,PDO::PARAM_INT);
      $stmt->bindParam(':id', $id,PDO::PARAM_INT);
      $stmt->execute();
  }

  if (isset($_POST['post']) == "Post" && isset($_GET['id']) && $user && isset($_POST['comment'])) {

      $comClass = new comClass();

      $comment = $_POST['comment'];
      $id = $_GET['id'];
      $login = $_GET['login'];
      $creation = date('Y-m-d H:i:s');
      $sql = "INSERT INTO Comments(img_id, login_com, user, comments, creation_date) VALUES (:id,:user,:login,:comment,:creation)";
      $stmt= $db->prepare($sql);
      $stmt->bindParam("id", $id,PDO::PARAM_INT) ;
      $stmt->bindParam("user", $user,PDO::PARAM_STR) ;
      $stmt->bindParam("login", $login,PDO::PARAM_STR) ;
      $stmt->bindParam("comment", $comment, PDO::PARAM_STR);
      $stmt->bindParam("creation", $creation,PDO::PARAM_STR) ;
      $stmt->execute();

      $comClass->send_mail($login);
  }

  else if (!$user && (isset($_GET['action']) || isset($_POST['post']) == "Post")){
    echo "<script>alert('You need to log in first')</script>";
    echo "<script>window.open('admin/user/login.php', '_self')</script>";

  }
  try{
    $stmt = $db->prepare("SELECT * FROM `Images` WHERE `login` != '$user'");
    $stmt->execute();

?>

<link rel="stylesheet" href="front/style/index.css">

  <section class="main">

    <div class="left">
        <div class ="images">
          <?php
          while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            $id = $data['id'];
            $title = $data['title'];
            $img = $data['img_path'];
            $likes = $data['likes'];
            $login = $data['login'];
            $creation = $data['creation_date'];
          ?>
          <div class="each">
            <form action="" method="get" align="right">
              <div id = "title"> <?php echo $login;?> </div>
              <input type="hidden" name="action" value="<?php echo $id;?>">
              <input title ="LIKE" type="image" id="likes" src = "front/images/silver.png"/>
            </form>

            <div align="center"><img id = "image1" src = "front/save/user_images/<?php echo $img;?>" onclick="lightbox()"/> </div>

            <div align="right">
              <div class="comments" align="left">
                <?php
                $st = $db->prepare("SELECT * FROM Comments WHERE  img_id = :id");
                $st->bindParam("id", $id,PDO::PARAM_INT) ;
                $st->execute();
                while ($com = $st->fetch(PDO::FETCH_ASSOC)){
                  $l =$com['login_com'];
                  $comments = $com['comments'];
                  echo "<font color='#B22222'>".$l.": </font>";
                  echo $comments."<br/>";
                }
                ?>
              </div>

            <form action="index.php?id=<?php echo $id;?>&login=<?php echo $login;?>" method="post">
              <input type="comment" id = "new_comment" name="comment" placeholder="Add a comment... "> <br/>
              <input type="submit" id = "post" name="post" size="8" value="Post">
              <input type="button" id = "nb_likes" value="<?php echo $likes;?>">
            </form>
           </div>
          </div>

      <?php } }
          catch(PDOException $e) {
          echo '{"Error inserting":{"text":'. $e->getMessage() .'}}';
        }
      ?>
      </div>

    </div>
    <div class="right">
      <div> <a href= "front/save/upload_picture.php"> <img src="front/images/upload.ico" width="100%" height="100%" style="margin-top:30px;"></a></div>
      <div><a href= "front/save/take_picture.php"> <img src="front/images/edit2.jpg" width="100%" height="100%" style="margin-top:30px;"></a> </div>
      <div><a href= "front/save/edit_picture.php"><img src="front/images/globe2.jpg" width="100%" height="100%" style="margin-top:30px;"> </a></div>
    </div>
  </section>


<?php
  include('shared/footer.php');
?>
