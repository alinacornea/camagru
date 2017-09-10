<?php
  session_start();
  include('../../shared/header.php');
?>
<link rel="stylesheet" href="../style/view_style.css">
<div class="booth" align="center">
  <video autoplay="true"id = "video" width="50%" height="50%"> </video>
  <div class="bottom"><a href="#" id="capture" class="booth-capture"> Take picture </a>

  <input type="button" class="booth-capture" onclick="save()" value="Save picture"/></div>
  <input type="hidden" name="image_data" id="image_data" />

  <canvas id ="canvas" width="400" height="300"> </canvas>
</div>

<script  src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"> </script>

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
  }

  document.getElementById('capture').addEventListener('click', function(){
    context.drawImage(video, 0, 0, 400, 300);
  });

  function save(){
    test = document.getElementById("test");
    finish = document.getElementById('finish'),
        finish.addEventListener('click',
            function (ev) {
                var data = canvas.toDataURL('image/png');
                var data_img = photo.getAttribute('src');
                var check = document.getElementById("video").getAttribute("style");
                var check_img = document.getElementById("photo").getAttribute("style");
                var check_canvas = document.getElementById("canvas").getAttribute("style")

                if (check_canvas == "display:block") {
                    test.setAttribute('value', data);
                } else if (check_img == "display:block") {
                    test.setAttribute('value', data_img);
                }
                document.getElementById("photo").setAttribute("src", "./script/image.php");
                setTimeout(document.getElementById('zdp').submit(), 40);
            }, false);
    }



    // var value = canvas.toDataURL('image/png');
    //
    // $.ajax({
    // url:'t.php',
    // type:'POST',
    // data:{
    //     data:value
    //   }
    // });

    //
    // var ajax = new XMLHttpRequest();
    // var url = "camera.php";
    //
    // ajax.open("POST", url, false);
    // ajax.setRequestHeader('Content-Type', 'application/x-www-form-ulrencoded');
    // ajax.send(value);

</script>


<?php
    include('../../shared/footer.php');
?>

<!-- function save() {

    test = document.getElementById("test");
    finish = document.getElementById('finish'),
        finish.addEventListener('click',
            function (ev) {
                var data = canvas.toDataURL('image/png');
                var data_img = photo.getAttribute('src');
                var check = document.getElementById("video").getAttribute("style");
                var check_img = document.getElementById("photo").getAttribute("style");
                var check_canvas = document.getElementById("canvas").getAttribute("style")

                if (check_canvas == "display:block") {
                    test.setAttribute('value', data);
                } else if (check_img == "display:block") {
                    test.setAttribute('value', data_img);
                }
                document.getElementById("photo").setAttribute("src", "./script/image.php");
                setTimeout(document.getElementById('zdp').submit(), 40);
            }, false);
}
 -->

<!--
<?php
// session_start();
// header ("Content-type: image/png");
// $extension = pathinfo($_SESSION['img_name'], PATHINFO_EXTENSION);
// if ($extension == "png") {
// 	$destination = imagecreatefrompng($_SESSION['img_name']);
// }
// else
//     $destination = imagecreatefromjpeg($_SESSION['img_name']);
// if (!empty($_SESSION['calque']))
// {
// 	if ($_SESSION['calque'] === "negative")
// 		imagefilter($destination, IMG_FILTER_NEGATE);
// 	else if ($_SESSION['calque'] === "grayscale")
// 		imagefilter($destination, IMG_FILTER_GRAYSCALE);
// }
