<?php
    // require_once('../../config/database.php');
    function check_insert($id, $user){
      $db = getDB();
      $stmt = $db->prepare("SELECT * FROM Likes WHERE img_id = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$result){
        $flag = 1;
        $sql = "INSERT INTO Likes(img_id, user, liked) VALUES(:id, :user, :flag)";
        $stmt= $db->prepare($sql);
        $stmt->bindParam(':id', $id,PDO::PARAM_INT);
        $stmt->bindParam(':user', $user,PDO::PARAM_STR);
        $stmt->bindParam(':flag', $flag,PDO::PARAM_INT);
        $stmt->execute();
        return (true);
      }

      while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        if ($result['user'] === $user && $result['liked'] === 1){
          $flag = 0;
          $sql = "UPDATE Likes SET liked=:flag WHERE img_id = :id and user=:user";
          $stmt= $db->prepare($sql);
          $stmt->bindParam(':flag', $flag,PDO::PARAM_INT);
          $stmt->bindParam(':id', $id,PDO::PARAM_INT);
          $stmt->bindParam(':user', $user,PDO::PARAM_INT);
          $stmt->execute();
          return false;
        }
        else{
          // $flag = 1;
          // $sql = "INSERT INTO Likes(img_id, user, liked) VALUES(:id, :user, :flag)";
          // $stmt= $db->prepare($sql);
          // $stmt->bindParam(':id', $id,PDO::PARAM_INT);
          // $stmt->bindParam(':user', $user,PDO::PARAM_STR);
          // $stmt->bindParam(':flag', $flag,PDO::PARAM_INT);
          // $stmt->execute();
          return true;
        }
      }
    }

?>
