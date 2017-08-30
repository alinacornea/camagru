
<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="icon" href="http://localhost:8080/camagru/front/images/icon_star.png"/>
  <link rel="stylesheet" href="http://localhost:8080/camagru/front/style/header.css">
</head>

<body>
    <header>
      <h1>
        <a title="Home"href="http://localhost:8080/camagru/index.php"> <img id="home" src="http://localhost:8080/camagru/front/images/home.png" alt="Home"></a>
        <svg >
        <radialGradient id="gr-radial"
                    cx="100%" cy="100%" r="100%">
      <animate attributeName="r"
               values="0%;100%;100%;0%"
               dur="3s" repeatCount="indefinite" />
      <stop stop-color="#FFF" offset="0">
        <animate attributeName="stop-color"
                 values="#FFF;#FF0;#FF0;#FFF"
                 dur="5s" repeatCount="indefinite" />
      </stop>
      <stop stop-color="rgba(250, 180, 150, 2)" offset="100%"/>
    </radialGradient>
    <text text-anchor="middle"
          x="50%"
          y="50%"
          dy=".10em"
          class="text"
          >
      Camagru -
    </text>
  </svg>
        <a title="Admin" href="http://localhost:8080/camagru/admin/user/admin.php"><img id="admin" src="http://localhost:8080/camagru/front/images/admin.png" alt="Admin"></a>
        <a title="Logout" href="http://localhost:8080/camagru/admin/user/logout.php"><img id="logout" src="http://localhost:8080/camagru/front/images/out.png" alt="Logout"></a>
        <a title="Login" href="http://localhost:8080/camagru/admin/user/login.php"> <img id="login"src="http://localhost:8080/camagru/front/images/log.png" alt="Login"></a>
        <div id="create"> create your own world</div>
      </h1>
    </header>
