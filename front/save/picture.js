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

    navigator.getUserMedia = (navigator.getUserMedia ||  navigator.webkitGetUserMedia ||  navigator.mozGetUserMedia ||  navigator.msGetUserMedia);

    if (navigator.getUserMedia) { function gotStream(stream) {
        if (navigator.mozGetUserMedia) {
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

      var draggedElement;
      var x, y, z = 0;

      function dragStart(e) {
        draggedElement = e.target;
        x = e.clientX - draggedElement.offsetLeft;
        y = e.clientY - draggedElement.offsetTop;
        e.dataTransfer.setDragImage(draggedElement, x-240, y);
      }

      function drop(e) {
        z++;
        draggedElement.style.left = (e.clientX - x - 30) + "px";
        draggedElement.style.top = (e.clientY - y - 30) + "px";
        draggedElement.style.zIndex = z;
        if (e.stopPropagation) {
          e.stopPropagation();
        }
        e.preventDefault();
        return false;
      }

      function dragEnter(e) {e.preventDefault();
        return true;
      }

      function dragOver(e) {  e.preventDefault(); }

      document.getElementById("start").addEventListener('click', start);
      document.getElementById("capture").addEventListener('click', takePhoto);

      var container = document.body;
      container.addEventListener('drop', drop, false);
      container.addEventListener('dragenter', dragEnter, false);
      container.addEventListener('dragover', dragOver, false);


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

  // drag and drop sticker on a image functions
  function allowDrop(e){
      e.preventDefault();}

  function drag_st(e)
  {
      //store the position of the mouse relativly to the image position
      // e.dataTransfer.setData("mouse_position_x",(e.clientX || e.pageX) - e.target.offsetLeft );
      // e.dataTransfer.setData("mouse_position_y",(e.clientY || e.pageY) - e.target.offsetTop  );
      e.dataTransfer.setData("image_id",e.target.id);
  }

  function drop_st(e)
  {
      e.preventDefault();
      var canvas = document.getElementById('canvas');

      var image = document.getElementById(e.dataTransfer.getData("image_id") );
      ctx = canvas.getContext('2d');

      var x = e.dataTransfer.getData("mouse_position_x");
      var y = e.dataTransfer.getData("mouse_position_y");

      // the image is drawn on the canvas at the position of the mouse when we lifted the mouse button
      // alert(x + ',' + y + ',' + e.clientX + ',' + e.clientY);
      ctx.drawImage(image , e.clientX - canvas.offsetLeft - x, e.clientY - canvas.offsetTop - y, 80, 80);
      document.getElementById("hidden").value = canvas.toDataURL('image/png');
  }
