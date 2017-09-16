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

<style>
#img1{
  width:100px;
  height:100px;
}
#img2{
  width:100px;
  height:100px;
}
</style>


<link rel="stylesheet" href="../style/view.css">
<link rel="stylesheet" href="../style/filters.css">
<div class="booth" align="center">
  <img id="img1" draggable="true" ondragstart="drag_st(event)" src='2.png'>
  <video  id="video" width="35%" height="30%"></video>
  <form name="form1" action="camera.php" method="post">
    <input id="start" type="button" class="booth-capture" value="Start webcam"/>
    <input id="capture" type="button" class="booth-capture" value="Take picture"/>
    <input type="button" id = "save" class="booth-capture" value="Save picture"/>
    <input name="hidden" type="hidden" id="hidden">
    <input name="img_style" type="hidden" id="img_style">
    <div id="stack" class="playground"></div>
  </form>
    <p>
      <div id="filterButtons"></div>
      <canvas id="canvas" ondrop="drop_st(event)" ondragover="allowDrop(event)" width="400" height="300" style="border: 1px solid gray" ></canvas>
    </p>
</div>

<script src = "style_picture.js"></script>

<?php
    include('../../shared/footer.php');
?>
