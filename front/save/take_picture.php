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

<link rel="stylesheet" href="../style/filter.css">
<div class="booth">
  <div class="container">
    <video class="video"id="video"></video>
    <canvas class="canvas_video"id="canvas_video" ondrop="drop_st(event)" ondragover="allowDrop(event)"width="400" height="300" ></canvas>
  <canvas id="canvas" width="400" height="300" ></canvas>
  <form name="form1" action="camera.php" method="post">
    <input id="start" type="button" class="booth-capture" value="Start webcam"/>
    <input id="capture" type="button" class="booth-capture" value="Take pic"/>
    <input type="submit" name="submit" id = "save" class="booth-capture" value="Save pic"/>
    <input name="hidden" type="hidden" id="hidden">
  </form>
    <p>
      <div id="filterButtons"></div>
    </p>
    <div class="stick">
    <img id="img" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='2.png' style="margin-right:20px">
    <img id="img1" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='gl.svg' style="margin-right:20px">
    <img id="img2" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/emoji.png' style="margin-right:20px">
    <img id="img3" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/heart_black.png' style="margin-right:20px">
    <img id="img4" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/laugh.png' style="margin-right:20px">
    <img id="img5" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/baloons.png' style="margin-right:20px">
    <img id="img6" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/rose.png' style="margin-right:20px">
    <img id="img7" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/stick7.png' style="margin-right:20px">
    <img id="img8" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/stick6.png' style="margin-right:20px">
    <img id="img9" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/stick1.png' style="margin-right:20px">
    <img id="img10" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/stick6.gif' style="margin-right:20px">
    <img id="img11" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/bird.png' style="margin-right:20px">
    <img id="img12" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/stick3.png' style="margin-right:20px">
    <img id="img13" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/lion.png' style="margin-right:20px">
    </div>
    </div>
</div>
<script src = "picture.js"></script>

<?php
    include('../../shared/footer.php');
?>
