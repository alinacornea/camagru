<?php
  $file = $_FILES['image']; // 'image' because that was the name we set in the javascript code
  echo $file;
  $path = 'http://example.com/images'; //whatever path on the server your images are being stored in
  $location = $path. $_FILES["file"]["name"]; //this is where the file will go
  move_uploaded_file($_FILES["file"]["tmp_name"], $location); // move the file there
  echo $location; //send the file location back to the javascript
?>
