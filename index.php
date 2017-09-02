<?php
  include('shared/header.php');
?>

<link rel="stylesheet" href="front/style/index.css">
<!-- <head>
  <meta charset="utf-8">
  <title>Vintage - store </title>
  <link rel="icon" href="images/rose.png"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono&effect=destruction">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
</head> -->

  <section class="main">

    <div class="left"> left side  will display pictures</div>
    <div class="right"> right side
      <div id="right-up"> <a href= "front/display/upload_picture.php?login=<?php echo $_GET['login'];?>"> Upload picture </a></div>
      <div id="right-center"><a href= "front/display/take_picture.php?login=<?php echo $_GET['login'];?>"> Take picture </a> </div>
      <div id="right-bottom"><a href= "front/display/edit_picture.php?login=<?php echo $_GET['login'];?>"> Edit picture </a></div>

    </div>

  </section>


<?php
  include('shared/footer.php');
?>
