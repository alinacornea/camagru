
<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Camagru</title>
  <link rel="icon" href="#"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme">
  <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="../front/style/header.css">
</head>

<body>
    <header>
      <h1>
        <a title="Home"href="#"> <img id="home" src="" alt="Home"></a>
        <svg >

    <!-- Gradient -->
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

    <!-- Text -->
    <text text-anchor="middle"
          x="50%"
          y="50%"
          dy=".20em"
          class="text"
          >
      Camagru
    </text>
  </svg>
        <a title="Admin" target="_blank" href="#"><img id="admin" src="" alt="Admin"></a>
        <a title="Logout" href="#"><img id="logout" src="" alt="Logout"></a>
        <a title="Login" href="#"> <img id="login"src="" alt="Login"></a>
      </h1>
    </header>
