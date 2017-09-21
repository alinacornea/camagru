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


<<<<<<< HEAD
<link rel="stylesheet" href="../style/filter.css">
=======
<link rel="stylesheet" href="../style/display.css">
<link rel="stylesheet" href="../style/filter_cam.css">
>>>>>>> 70fe96da1fb3867371367e7ec0f410364ce567e0
<div class="booth">
  <video  id="video"></video>
  <canvas id="canvas" ondrop="drop_st(event)" ondragover="allowDrop(event)" width="400" height="300" ></canvas>
  <form name="form1" action="camera.php" method="post">
    <input id="start" type="button" class="booth-capture" value="Start webcam"/>
    <input id="capture" type="button" class="booth-capture" value="Take pic"/>
<<<<<<< HEAD
    <input type="submit" name="submit" id = "save" class="booth-capture" value="Save pic"/>
    <input name="hidden" type="hidden" id="hidden">
  </form>
    <p>
      <div id="filterButtons"></div>
    </p>
    <div class="stick">
    <img id="img1" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='2.png'>
    <img id="img2" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='gl.svg'>
    <!-- <img id="img3" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/frame1.jpeg'>
    <img id="img4" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/frame2.png'>
    <img id="img5" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/frame4.png'>
    <img id="img6" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/frame3.png'> -->
    <img id="img8" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/stick7.png'>
    <img id="img9" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/stick6.png'>
    <img id="img10" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/stick1.png'>
    <img id="img11" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/stick6.gif'>
    <img id="img13" width="80" height="80" draggable="true" ondragstart="drag_st(event)" src='../images/stick3.png'>
    </div>
</div>

<script src = "picture.js"></script>
=======
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
>>>>>>> 70fe96da1fb3867371367e7ec0f410364ce567e0

<?php
    include('../../shared/footer.php');
?>
