<?php
require_once('../../config/database.php');
$db = getDB();
$cat = "fruit";
$name="peach";
$color="red";

// $stmt = $db->prepare("INSERT INTO Test(category, name, color) VALUES (:cat, :name, :color)");
$stmt = $db->prepare("SELECT * FROM Test where name= :name");
// $stmt->bindParam("cat", $cat,PDO::PARAM_STR) ;
$stmt->bindParam("name", $name,PDO::PARAM_STR) ;
// $stmt->bindParam("color", $color,PDO::PARAM_STR) ;
$stmt->execute();

while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
  echo $data['color'];
}

?>
