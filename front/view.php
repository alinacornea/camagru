<?php
  session_start();
  include('../shared/header.php');
  require_once('../config/database.php');

  $login = $_SESSION['login'];

  $db = getDB();
  function get_comment($id, $login){
    try{
      $db = getDB();
      $stmt = $db->prepare("SELECT * FROM Comments WHERE user =:login AND img_id =:id");
      $stmt->bindParam("login", $login,PDO::PARAM_STR) ;
      $stmt->bindParam("id", $id, PDO::PARAM_INT) ;
      $stmt->execute();
      while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
        $log= $data['login_com'];
        $com = $data['comments'];
        echo $log.": ";
        echo $com."<br/>";
      }
    }
    catch(PDOException $e) {
    echo '{"Error inserting":{"text":'. $e->getMessage() .'}}';
    }
  }

  if (isset($_POST['post']) == "Post" && isset($_GET['id']) && isset($_POST['comment'])) {

      $comment = $_POST['comment'];
      $id = $_GET['id'];
      $login = $_GET['login'];
      $creation = date('Y-m-d H:i:s');
      $sql = "INSERT INTO Comments(img_id, login_com, user, comments, creation_date) VALUES (:id,:login,:login,:comment,:creation)";
      $stmt= $db->prepare($sql);
      $stmt->bindParam("id", $id,PDO::PARAM_INT) ;
      $stmt->bindParam("user", $login,PDO::PARAM_STR) ;
      $stmt->bindParam("login", $login,PDO::PARAM_STR) ;
      $stmt->bindParam("comment", $comment, PDO::PARAM_STR);
      $stmt->bindParam("creation", $creation,PDO::PARAM_STR) ;
      $stmt->execute();
  }


  try{
    $stmt = $db->prepare("SELECT * FROM Images WHERE login =:login ");
    $stmt->bindParam("login", $login,PDO::PARAM_STR) ;
    $stmt->execute();
    ?>
    <div class ="images">
    <?php
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $id = $data['id'];
      $title = $data['title'];
      $img = $data['img_path'];
      $likes = $data['likes'];
      $comments = $data['comments'];
      $creation = $data['creation_date'];
    ?>

    <link rel="stylesheet" media= "all" href ="style/view_picture.css"/>
    <div class="each">
      <div class="likes"><?php echo $likes;?><img width="10%" src = "images/icon_star.png"/></div>

        <div align="center"><img class="image" src = "save/user_images/<?php echo $img;?>"/></div>
        <div id="myModal" class="modal">
          <span class="close">×</span>
          <img class="modal-content" id="img">
        </div>

        <script>
          var modal = document.getElementById('myModal');
          var images =document.getElementsByClassName('image');
          var modalImg = document.getElementById("img");

          var i;
          for (i = 0; i < images.length; ++i) {
              images[i].onclick = function(){
                  modal.style.display = "block";
                  modalImg.src = this.src;
              }
          }
          var span = document.getElementsByClassName("close")[0];

          span.onclick = function() {
          modal.style.display = "none";
        }
        </script>


        <div class="comments"><?php get_comment($id, $login); ?></div>

        <form action="view.php?id=<?php echo $id;?>&login=<?php echo $login;?>" method="post">
          <input type="comment" id="new_comment" name="comment" placeholder="Add a comment... ">
          <input type="submit" id="post" name="post" size="8" value="Post">
        <a title="Delete Picture" href="../admin/database/delete.php?id=<?php echo $id;?>"><img id="delete" src="images/delete.ico" alt="Delete" onclick="return confirm('Are you sure you want to delete this picture?')"></a>
        </form>
     </div>
<?php } }
    catch(PDOException $e) {
    echo '{"Error inserting":{"text":'. $e->getMessage() .'}}';
  }
?>
</div>

<?php include('../shared/footer.php'); ?>
