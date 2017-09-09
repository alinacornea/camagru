<?php
  session_start();
  include('../../shared/header.php');

?>
<style>

.booth{
  margin-top:20px;

}
#video{
  background-color:#666;
  border:2px solid #800000;
}

.bottom{
  display:flex;
  justify-content:center;
}

.booth-capture{
  margin-top:30px;
  width:20%;
  max-width:200px;
  height:45px;
  margin-left:10px;
  font-family: monospace;
  font-size:16px;
  color:#fff;
  text-decoration:none;
  cursor:pointer;
  text-shadow:1px 1px 0px #000000;
  display:flex;
  justify-content:center;
  align-items:center;
  background: #EB5757;
  background: -webkit-linear-gradient(to bottom, #000000, #EB5757);
  background: linear-gradient(to bottom, #000000, #EB5757);
  margin-top:10px;
  border:none;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  border-bottom-left-radius:5px;
  box-shadow: inset 0px 1px 0px #BD871A, 0px 5px 0px 0px #800000, 0px 10px 5px #999;
}

#canvas{
  margin-top:30px;
  width:50%;
  height:50%;
}

</style>



<div class="booth" align="center">
  <video autoplay="true"id = "video" width="50%" height="50%"> </video>
  <div class="bottom"><a href="#" id="capture" class="booth-capture"> Take picture </a>
  <input type="button" class="booth-capture" onclick="save()" value="Save picture"/></div>
  <canvas id ="canvas" width="400" height="300"> </canvas>
</div>

  <form method="post" accept-charset="utf-8" name="form1">
      <input name="hidden_data" id='hidden_data' type="hidden"/>
  </form>


<script>

  var video = document.querySelector("#video");

  var canvas = document.getElementById('canvas'),
      context = canvas.getContext('2d');
      // photo = document.getElementById('photo');

  navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

  if (navigator.getUserMedia) {
      navigator.getUserMedia({video: true}, handleVideo, videoError);
  }

  function handleVideo(stream) {
      video.src = window.URL.createObjectURL(stream);
  }

  function videoError(e) {
    alert("Error was detected!!")
      // do something
  }

  document.getElementById('capture').addEventListener('click', function(){
    context.drawImage(video, 0, 0, 400, 300);
    // window.location.href = canvas.toDataURL("image/png");
    var data = canvas.toDataURL('image/png');
    
});

  });

</script>


<?php
    include('../../shared/footer.php');
?>
