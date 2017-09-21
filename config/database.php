<?php
  session_start();
  function getdb(){
    $DB_DNS = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "root";
    $DB_NAME = "camagru";

    try {
      $conn = new PDO('mysql:host=localhost;dbname=camagru', $DB_USER, $DB_PASSWORD);
      $conn->exec("set names utf8");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $conn->exec('CREATE DATABASE IF NOT EXISTS camagru');
      if ($conn)
       {
        //  echo "Conection succesfully" . "<br/>";
         return $conn;
       }
    }
    catch (PDOException $e) {
        echo "Error: Conection failed" . $e->getMessage() ."<br/>";
        die();
    }
  }
?>
