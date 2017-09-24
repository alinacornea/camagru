<?php
  require_once('database.php');

  try {
    $conn = new PDO('mysql:host=localhost;', $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec('CREATE DATABASE IF NOT EXISTS camagru');
    if ($conn)
    {
      echo "Conection succesfully" . "<br/>";
    }
  }
  catch (PDOException $e) {
      echo "Conection failed" . $e->getMessage() ."<br/>";
      die();
  }

try {
  $conn = new PDO('mysql:host=localhost;dbname=camagru', $DB_USER, $DB_PASSWORD);
  $conn->exec("CREATE TABLE IF NOT EXISTS Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    login VARCHAR(50) NOT NULL,
    activation VARCHAR(200) NOT NULL,
    hash VARCHAR(200) NOT NULL,
    active INT
  )");

  $first = "Alina";
  $last = "Cornea";
  $phone = "978-406-5814";
  $email = "alinacornea18@gmail.com";
  $login = "alcornea";
  $activation = "1";
  $pass = "qe898xn4!";
  $active = "1";

  $stmt = $conn->prepare("INSERT INTO Users(first_name,last_name, phone,email,login,activation,hash, active) VALUES (:first,:last,:phone,:email,:login,:activation,:hash, :active)");
  $stmt->bindParam("first", $first,PDO::PARAM_STR) ;
  $stmt->bindParam("last", $last,PDO::PARAM_STR) ;
  $stmt->bindParam("phone", $phone,PDO::PARAM_INT) ;
  $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
  $stmt->bindParam("login", $login,PDO::PARAM_STR) ;
  $hash= hash('whirlpool', $pass); //Password encryption
  $stmt->bindParam("activation", $activation,PDO::PARAM_STR) ;
  $stmt->bindParam("hash", $hash,PDO::PARAM_STR) ;
  $stmt->bindParam("active", $active,PDO::PARAM_INT) ;
  $stmt->execute();


  $conn->exec("CREATE TABLE IF NOT EXISTS Images (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    title VARCHAR(50) NOT NULL,
    img_path CHAR(255) NOT NULL,
    login VARCHAR(50) NOT NULL,
    likes INT,
    comments_nb INT,
    creation_date DATE
  )");

  $conn->exec("CREATE TABLE IF NOT EXISTS Comments (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    img_id CHAR(255) NOT NULL,
    login_com VARCHAR(50) NOT NULL,
    user VARCHAR(50) NOT NULL,
    comments TEXT NOT NULL,
    creation_date DATE
  )");

  if ($conn)
  {
    echo "Conection succesfully, Database was created" . "<br/>";
  }
}
catch (PDOException $e) {
    echo "Conection failed" . $e->getMessage() ."<br/>";
    die();
}


?>
