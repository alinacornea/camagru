<?php session_start();
?>
<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="icon" href="http://localhost:8080/camagru/front/images/icon_star.png"/>
  <link rel="stylesheet" href="http://localhost:8080/camagru/front/style/header_style.css">
  </head>
  <body>
    <header>
      <h1>
        <svg  height="70px">
        <radialGradient id="gr-radial"
                    cx="100%" cy="100%" r="100%">
      <animate attributeName="r"
               values="0%;100%;100%;0%"
               dur="4s" repeatCount="indefinite" />
      <stop stop-color="#FFF" offset="0">
        <animate attributeName="stop-color"
                 values="#0F0;#FFF;#FF0;#FFF"
                 dur="5s" repeatCount="indefinite" />
      </stop>
      <stop stop-color="rgba(250, 70, 70, 1)" offset="100%"/>
    </radialGradient>
    <text text-anchor="middle"
          x="50%"
          y="55%"
          dy=".0001em"
          class="text"
          >
      Camagru -
    </text>
    <div id="create"> <?php if ($_SESSION[login]) echo $_SESSION[login].","; ?>  create your world !!
  </svg>
  <a title="Home"href="http://localhost:8080/camagru/index.php"> <img id="home" src="http://localhost:8080/camagru/front/images/rotate.gif" alt="Home"></a>
        <!-- <a title="Admin" href="http://localhost:8080/camagru/admin/user/admin.php"><img id="admin" src="http://localhost:8080/camagru/front/images/admin.png" alt="Admin"></a> -->
        <a title="View" href="http://localhost:8080/camagru/front/view.php"><img id="view" src="http://localhost:8080/camagru/front/images/account.png" alt="View"></a>
        <a title="Logout" href="http://localhost:8080/camagru/admin/user/logout.php"><img id="logout" src="http://localhost:8080/camagru/front/images/logout.png" alt="Logout"></a>
        <a title="Login" href="http://localhost:8080/camagru/admin/user/login.php"> <img id="login"src="http://localhost:8080/camagru/front/images/log.png" alt="Login"></a>
      </h1>
      </div>
    </header>
    <div class ="content">
