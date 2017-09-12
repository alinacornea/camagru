<?php
  session_start();
  include('../../shared/header.php');
?>
<link rel="stylesheet" href="../style/view_style.css">
<div class="booth" align="center">
  <video autoplay="true"id = "video" width="50%" height="50%"> </video>
  <div class="bottom">
    <img src="" id="photo" name="photo">
    <input id="capture" type="button" class="booth-capture" value="Take picture"/>
    <input id="save" type="button" class="booth-capture" onclick="save();" value="Save picture"/>

  </div>


  <canvas id ="canvas" width="400" height="300"> </canvas>
  <div id="status"></div>
</div>

<script  src="ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"> </script>

<script type="text/Javascript">

  function getXMLHttpRequest() {

       var xhr = null;

       if (window.XMLHttpRequest || window.ActiveXObject) {
           if (window.ActiveXObject) {
               try {
                   xhr = new ActiveXObject("Msxml2.XMLHTTP");
               } catch(e) {
                   xhr = new ActiveXObject("Microsoft.XMLHTTP");
               }
           } else {
               xhr = new XMLHttpRequest();
           }
       } else {
           alert("You dont support XMLHTTPRequest...");
           return null;
       }

       return xhr;
   }




  var video = document.querySelector("#video");

  var canvas = document.getElementById('canvas'),
      context = canvas.getContext('2d');

  navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

  if (navigator.getUserMedia) {
      navigator.getUserMedia({video: true}, handleVideo, videoError);
  }

  function handleVideo(stream) {
      video.src = window.URL.createObjectURL(stream);
  }

  function videoError(e) {
    alert("Error was detected!!")
  }

  document.getElementById('capture').addEventListener('click', function(){
    context.drawImage(video, 0, 0, 400, 300);
  });

  function save()
  {
     var canvasData = canvas.toDataURL("image/png");
     document.write(canvasData);


     var xhr = getXMLHttpRequest();
     xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
           photo.setAttribute('src', xhr.responseText);
          }
    };
     xhr.open('POST', rootURI + 'camera.php', true);
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //  ajax.send("imgData=" + canvasData);
     xhr.send(JSON.stringify(canvasData));

  }

</script>


<?php
    include('../../shared/footer.php');
?>
