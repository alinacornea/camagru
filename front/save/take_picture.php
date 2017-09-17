<?php
  session_start();
  include('../../shared/header.php');
  if (!isset($_SESSION['login']))
  {
    $msg =  "You need to log in first";
    echo "<script> alert('$msg');window.open('../../admin/user/login.php', '_self'); </script>";
    die();
  }
?>


<link rel="stylesheet" href="../style/display.css">
<link rel="stylesheet" href="../style/filter_cam.css">
<div class="booth">
  <video  id="video"></video>
  <canvas id="canvas" ondrop="drop_st(event)" ondragover="allowDrop(event)" width="400" height="300" ></canvas>
  <form name="form1" action="camera.php" method="post">
    <input id="start" type="button" class="booth-capture" value="Start webcam"/>
    <input id="capture" type="button" class="booth-capture" value="Take pic"/>
    <input type="button" id = "save" class="booth-capture" onclick="save();" value="Save pic"/>
    <input name="hidden" type="hidden" id="hidden">
  </form>
  <div class="stick">
  <img id="img1" draggable="true" ondragstart="drag_st(event)" src='2.png'>
  <img id="img2" draggable="true" ondragstart="drag_st(event)" src='gl.svg'>
  </div>
    <p>
      <div id="filterButtons"></div>
    </p>
</div>

<script src = "style_picture.js"></script>

<?php
    include('../../shared/footer.php');
?>
