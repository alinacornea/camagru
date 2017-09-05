<?php
  include('shared/header.php');
?>

<link rel="stylesheet" href="front/style/index.css">
  <section class="main">

    <div class="left">
      <?php
        require_once('config/database.php');
        try{
          $db = getDB();
          $stmt = $db->prepare("SELECT * FROM Images");
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
            $login = $data['login'];
            $comments = $data['comments'];
            $creation = $data['creation_date'];
          ?>

          <div class="each">
            <div id = "title"> <?php echo $login;?> </div>
            <div align="center"><img id = "image1" src = "front/save/user_images/<?php echo $img;?>" /> </div>
            <div align="right">
              <!-- <a href="admin/database/like_this.php?id=<?php echo $id; ?>"> -->
              <?php
                session_start();
                $login = $_SESSION['login'];
              ?>
                <img id= "likes" src = "front/images/icon_star.png"/>
              <!-- </a>  -->
              <?php echo " Like ".$likes;?>

              </div>



            <div id="comments" align=""> <?php echo $comments;?></div>
          </div>

      <?php } }
          catch(PDOException $e) {
          echo '{"Error inserting":{"text":'. $e->getMessage() .'}}';
        }
        // include('../shared/footer.php');
      ?>
      </div>

    </div>
    <div class="right"> right side
      <div id="right-up"> <a href= "front/save/upload_picture.php"> Upload picture </a></div>
      <div id="right-center"><a href= "front/save/take_picture.php?login=<?php echo $_GET['login'];?>"> Take picture </a> </div>
      <div id="right-bottom"><a href= "front/save/edit_picture.php?login=<?php echo $_GET['login'];?>"> Edit picture </a></div>

    </div>

  </section>


<?php
  include('shared/footer.php');
?>
