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
    <canvas class="canvas_video"id="canvas_video" ondrop="drop_st(event)" ondragover="allowDrop(event)"width="450" height="400" ></canvas>
  <canvas id="canvas" width="450" height="375" ></canvas>
  <form name="form1" action="camera.php" method="post">
    <input id="start" type="button" class="booth-capture" onclick="window.location.reload()" value="New pic"/>
    <input id="capture" type="button" class="booth-capture" value="Take pic"/>
    <input type="submit" name="submit" id = "save" class="booth-capture" value="Save pic"/>
    <input name="hidden" type="hidden" id="hidden">
  </form>
    <p>
      <div id="filterButtons"></div>
    </p>
    <div class="stick">
    <img id="img" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/2.png' style="margin-right:20px">
    <img id="img2" width="15%" height="15%" draggable="true" ondragstart="drag_st(event)" src='../images/butterfly.png' style="margin-right:20px">
    <img id="img5" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/baloons.png' style="margin-right:20px">
    <img id="img6" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/rose.png' style="margin-right:20px">
    <img id="img7" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/hat.png' style="margin-right:20px">
    <img id="img8" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/mask.png' style="margin-right:20px">
    <img id="img9" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/stick1.png' style="margin-right:20px">
    <img id="img10" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/emoji.png' style="margin-right:20px">
    <img id="img11" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/bird.png' style="margin-right:20px">
    <img id="img4" width="15%" height="15%" draggable="true" ondragstart="drag_st(event)" src='../images/code.png' style="margin-right:20px">
    <img id="img12" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/mustache.png' style="margin-right:20px">
    <img id="img14" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/v.png' style="margin-right:20px">
    <img id="img3" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/heart_black.png' style="margin-right:20px">
    <img id="img15" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/unicorn.png' style="margin-right:20px">
    <img id="img1" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/gl.svg' style="margin-right:20px">
    <img id="img16" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/holoween1.png' style="margin-right:20px">
    <img id="img17" width="20%" height="20%" draggable="true" ondragstart="drag_st(event)" src='../images/kiss.png' style="margin-right:20px">
    </div>
    </div>
</div>
<script>
(function() {
    // A button for each filter will be created dynamically
    var filters = [ {
      name: "Reset",
      filter: ""
    }, {
      name: "Blur",
      filter: "blur(2px)"
    }, {
      name: "BnW",
      filter: "grayscale(100%)"
    }, {
      name: "Bright",
      filter: "brightness(120%)"
    },{
      name: "Invert",
      filter: "invert(100%)"
    },{
      name: "Sepia",
      filter: "sepia(100%)"
    },{
      name: "Contrast",
      filter: "contrast(200%)"
    },{
      name: "Saturate",
      filter: "saturate(150%)"
    },{
      name: "Smurf",
      filter: "invert(90%)",
      filter: "hue-rotate(175deg)"
    },{
      name: "Hue",
      filter: "hue-rotate(90deg)"
    }];

    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var canvasContext = canvas.getContext('2d');
    var canvas_video = document.getElementById('canvas_video');
    var contexVideo = canvas_video.getContext('2d');

    navigator.mediaDevices.getUserMedia = (navigator.mediaDevices.getUserMedia ||  navigator.mediaDevices.webkitGetUserMedia ||  navigator.mediaDevices.mozGetUserMedia ||  navigator.mediaDevices.msGetUserMedia);

    if (navigator.mediaDevices.getUserMedia) { function gotStream(stream) {
        if (navigator.mediaDevices.mozGetUserMedia) {
          video.mozSrcObject = stream;
        }
        else {
          var vendorURL = window.URL || window.webkitURL;
          video.src = vendorURL.createObjectURL(stream);
        }
        video.play();
      }

      function error(message) {
        console.log(message);
      }

      function start() { this.disabled = true;  navigator.getUserMedia( {
          audio: false, video: {
                mandatory: {
                  maxWidth: 450,
                  maxHeight: 400
                }
              }
        }, gotStream, error);
      }

      function takePhoto() {
        canvasContext.filter = video.style.webkitFilter;
        canvasContext.drawImage(video, 0, 0, canvas.width, canvas.height);
        canvasContext.drawImage(canvas_video, 0, 0, canvas.width, canvas.height);
        canvas.className = "photo";
        document.getElementById("hidden").value = canvas.toDataURL('image/png');
        canvas.addEventListener('dragstart', dragStart, false);

      }

      start();
      document.getElementById("capture").addEventListener('click', takePhoto);



      function findFilterByName (filterArray, name) {
        for(var i = 0; i < filterArray.length; i++) {
          if(filterArray[i].name === name) {
            return filterArray[i];
          }
        }
        // Not found
        return null;
      };


      thisBrowserSupportsCssFilters = function () {
        var prefixes = " -webkit- -moz- -o- -ms- ".split(" ");
        var el = document.createElement('div');
        el.style.cssText = prefixes.join('filter:blur(2px); ');
        return !!el.style.length && ((document.documentMode === undefined || document.documentMode > 9));
      };

      if(thisBrowserSupportsCssFilters()) {
        var buttonsDiv = document.getElementById("filterButtons");

        filters.forEach(function(item){
          var button = document.createElement("button");
          button.id = item.name;
          button.innerHTML = item.name;
          buttonsDiv.appendChild(button);
        });

        function filterClicked (event) {
          event = event || window.event;
          var target = event.target || event.srcElement;
          if(target.nodeName === "BUTTON") {
            var filter = findFilterByName(filters, target.id);
            if(filter) {
              video.style.filter = filter.filter;
              video.style.webkitFilter = filter.filter;
            }
          }
        };
        buttonsDiv.addEventListener("click", filterClicked, false);
      }

    }

    else {
      document.getElementById("capture").disabled = true;
      alert("Sorry, you can't capture video from your webcam in this web browser. Try the latest desktop version of Firefox, Chrome or Opera.");
    }

  })();

  (function() {
          var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
                                      window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
          window.requestAnimationFrame = requestAnimationFrame;
        })();

        var imagesOnCanvas = [];

    function getheight(){
      var height;


      return height;
    }

    function renderScene() {
        requestAnimationFrame(renderScene);

        var canvas = document.getElementById('canvas_video');
        var ctx = canvas.getContext('2d');
        ctx.clearRect(0,0,
            canvas.width,
            canvas.height
        );

        for(var x = 0,len = imagesOnCanvas.length; x < len; x++) {
            var obj = imagesOnCanvas[x];
            var height = 95;
            var width = 95;
            if (obj.image == document.getElementById('img12')){
              height = 30;
            }
            else if (obj.image == document.getElementById('img8')){
              height = 50;
              width = 120;
            }
            else if (obj.image == document.getElementById('img14') || obj.image == document.getElementById('img7')){
              height = 190;
              width = 210;
            }
            obj.context.drawImage(obj.image,obj.x,obj.y, width, height);

        }
    }

        requestAnimationFrame(renderScene);

        window.addEventListener("load",function(){
            var canvas = document.getElementById('canvas_video');
    canvas.onmousedown = function(e) {
        var downX = e.offsetX,downY = e.offsetY;

        // scan images on canvas to determin if event hit an object
        for(var x = 0,len = imagesOnCanvas.length; x < len; x++) {
            var obj = imagesOnCanvas[x];
            if(!isPointInRange(downX,downY,obj)) {
                continue;
            }

            startMove(obj,downX,downY);
            break;
        }

    }
        },false);

    function startMove(obj,downX,downY) {
        var canvas = document.getElementById('canvas_video');

        var origX = obj.x, origY = obj.y;
        canvas.onmousemove = function(e) {
            var moveX = e.offsetX, moveY = e.offsetY;
            var diffX = moveX-downX, diffY = moveY-downY;


            obj.x = origX+diffX;
            obj.y = origY+diffY;
        }

        canvas.onmouseup = function() {
            // stop moving
            canvas.onmousemove = function(){};
        }
    }

    function isPointInRange(x,y,obj) {
        return !(x < obj.x ||
            x > obj.x + obj.width ||
            y < obj.y ||
            y > obj.y + obj.height);
    }



  function allowDrop(e){
      e.preventDefault();
  }

  function drag_st(e){
      //store the position of the mouse relativly to the image position
      e.dataTransfer.setData("mouse_position_x",(e.clientX || e.pageX) - e.target.offsetLeft );
      e.dataTransfer.setData("mouse_position_y",(e.clientY || e.pageY) - e.target.offsetTop  );
      e.dataTransfer.setData("image_id",e.target.id);
      // start();
  }

  function drop_st(e){
      e.preventDefault();
      var image = document.getElementById(e.dataTransfer.getData("image_id"));
      var mouse_position_x = e.dataTransfer.getData("mouse_position_x");
      var mouse_position_y  = e.dataTransfer.getData("mouse_position_y");

      var canvas = document.getElementById('canvas_video');
      ctx = canvas.getContext('2d');


      imagesOnCanvas.push({
        context: ctx,
        image: image,
        x:e.clientX - canvas.offsetLeft - mouse_position_x,
        y:e.clientY - canvas.offsetTop - mouse_position_y,
        width: image.offsetWidth,
        height: image.offsetHeight
      });
      // need to work an redrag when is on canvas!!!!!

      document.getElementById("hidden").value = canvas.toDataURL('image/png');
  }

  // save picture sending to php
  document.getElementById('save').addEventListener('click' ,function(){
  document.forms["form1"].submit();

  });

</script>

<?php
    include('../../shared/footer.php');
?>
