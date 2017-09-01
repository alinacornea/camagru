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
  }''
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

  $conn->exec("CREATE TABLE IF NOT EXISTS Images (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    title VARCHAR(50) NOT NULL,
    category VARCHAR(50) NOT NULL,
    img_path CHAR(255) NOT NULL,
    login VARCHAR(50) NOT NULL,
    likes INT,
    comments TEXT NOT NULL,
    creation_date DATE
  )");

  $conn->exec("CREATE TABLE IF NOT EXISTS Test (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    category VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    color CHAR(255) NOT NULL
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
