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

<link rel="stylesheet" href="../style/filter_cam.css">
<div class="booth">
  <video  id="video"></video>
  <canvas id="canvas" ondrop="drop_st(event)" ondragover="allowDrop(event)" width="400" height="300" ></canvas>
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
    <img id="img1" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='2.png'>
    <img id="img2" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='gl.svg'>
    <img id="img8" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/stick7.png'>
    <img id="img9" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/stick6.png'>
    <img id="img10" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/stick1.png'>
    <img id="img11" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/stick6.gif'>
    <img id="img13" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/stick3.png'>
    </div>
</div>

<script src = "picture.js"></script>

<?php
    include('../../shared/footer.php');
?>
