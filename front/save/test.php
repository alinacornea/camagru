<script src='jquery.min.js'></script>
<!-- <script src='ajaxupload.js'></script> -->


<script>
var preview = $('#preview'); //id of the preview image
new AjaxUpload('imageUpload', {
  action: 't.php', //the php script that receives and saves the image
   name: 'image', //The saveimagephp will find the image info in the variable $_FILES['image']
   onSubmit: function(file, extension) {
   preview.attr('src', 'loading.gif'); //replace the image SRC with an animated GIF with a 'loading...' message
   },
   onComplete: function(file, response) {
   preview.load(function(){
   preview.unbind();
   });
   preview.attr('src', response); //make the preview image display the uploaded file
   $('#uploadedimg').val(response); //drop the path to the file into the hidden field
  }
});

</script>


<form action="t.php">
     <img id="preview" src="" width="100px" height="100px" />
     <label>Upload a picture: <input id="imageUpload" type="file" name="image"/></label>
      <input type="hidden" name="uploadedImg"></input>
     <input type="submit" value="Save the picture"/>
 </form>
