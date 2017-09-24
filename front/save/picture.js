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
      name: "Shadow",
      filter: "drop-shadow(16px 16px 20px blue)"
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
        canvas.className = "photo";
        document.getElementById("hidden").value = canvas.toDataURL('image/png');
        canvas.addEventListener('dragstart', dragStart, false);

      }

      // var draggedElement;
      // var x, y, z = 0;
      //
      // function dragStart(e) {
      //   draggedElement = e.target;
      //   x = e.clientX - draggedElement.offsetLeft;
      //   y = e.clientY - draggedElement.offsetTop;
      //   e.dataTransfer.setDragImage(draggedElement, x-240, y);
      // }

      // function drop(e) {
      //   z++;
      //   draggedElement.style.left = (e.clientX - x - 30) + "px";
      //   draggedElement.style.top = (e.clientY - y - 30) + "px";
      //   draggedElement.style.zIndex = z;
      //   if (e.stopPropagation) {
      //     e.stopPropagation();
      //   }
      //   e.preventDefault();
      //   return false;
      // }
      //
      // function dragEnter(e) {e.preventDefault();
      //   return true;
      // }
      //
      // function dragOver(e) {  e.preventDefault(); }
      //
      document.getElementById("start").addEventListener('click', start);
      document.getElementById("capture").addEventListener('click', takePhoto);
      //
      // var container = document.body;
      // // container.addEventListener('drop', drop, false);
      // container.addEventListener('dragenter', dragEnter, false);
      // container.addEventListener('dragover', dragOver, false);


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
      document.getElementById("start").disabled = true;
      document.getElementById("capture").disabled = true;

      alert("Sorry, you can't capture video from your webcam in this web browser. Try the latest desktop version of Firefox, Chrome or Opera.");
    }
  })();

  // save picture sending to php
  document.getElementById('save').addEventListener('click' ,function(){
    document.forms["form1"].submit();
  });



  function redrag(){

  (function()  {
         var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
                                     window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
         window.requestAnimationFrame = requestAnimationFrame;
       })();

       var imagesOnCanvas = [];

   function renderScene() {
       requestAnimationFrame(renderScene);

       var canvas = document.getElementById('canvas');
       var ctx = canvas.getContext('2d');
       ctx.clearRect(0,0,
           canvas.width,
           canvas.height
       );

       for(var x = 0,len = imagesOnCanvas.length; x < len; x++) {
           var obj = imagesOnCanvas[x];
           obj.context.drawImage(obj.image,obj.x,obj.y, 80,80);

       }
   }

       requestAnimationFrame(renderScene);

       window.addEventListener("load",function(){
           var canvas = document.getElementById('canvas');
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
           var canvas = document.getElementById('canvas');

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
     }



  // drag and drop sticker on a image functions
  function allowDrop(e){
      e.preventDefault();}

  function drag_st(e)
  {
      //store the position of the mouse relativly to the image position
      // e.dataTransfer.setData("mouse_position_x",(e.clientX || e.pageX) - e.target.offsetLeft );
      // e.dataTransfer.setData("mouse_position_y",(e.clientY || e.pageY) - e.target.offsetTop  );
      var begin = e.dataTransfer.setData("image_id",e.target.id);
  }

  function drop_st(e)
  {
      e.preventDefault();
      var canvas = document.getElementById('canvas');
      var image = document.getElementById(e.dataTransfer.getData("image_id"));
      ctx = canvas.getContext('2d');


      var x = e.dataTransfer.getData("mouse_position_x");
      var y = e.dataTransfer.getData("mouse_position_y");

      // the image is drawn on the canvas at the position of the mouse when we lifted the mouse button
      // alert(x + ',' + y + ',' + e.clientX + ',' + e.clientY);


      //  imagesOnCanvas.push({
      //    context: ctx,
      //    image: image,
      //    x:e.clientX - canvas.offsetLeft - mouse_position_x,
      //    y:e.clientY - canvas.offsetTop - mouse_position_y,
      //    width: image.offsetWidth,
      //    height: image.offsetHeight
      //  });


      ctx.drawImage(image , e.clientX - canvas.offsetLeft - x, e.clientY - canvas.offsetTop - y, 85, 85);
      // need to work an redrag when is on canvas!!!!!
      image.addEventListener("click", redrag, false);


      document.getElementById("hidden").value = canvas.toDataURL('image/png');
  }
