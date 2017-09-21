
<?php
class userClass
{
  /* User Login */
  public function userLogin($login,$passwd)
  {
    try{
      $db = getDB();
      $hash= hash('whirlpool', $passwd); //Password encryption
      $stmt = $db->prepare("SELECT * FROM Users WHERE (login=:login or email=:login) AND hash=:hash");
      $stmt->bindParam("login", $login,PDO::PARAM_STR) ;
      $stmt->bindParam("hash", $hash,PDO::PARAM_STR) ;
      $stmt->execute();
      // see if the account was verified

      $count=$stmt->rowCount();
      $data=$stmt->fetch(PDO::FETCH_ASSOC);
      $active = $data['active'];
      $db = null;
      if($count && $active != 0)
      {
        return true;
      }
      else{
        return false;
      }
    }
    catch(PDOException $e) {
        echo '{"error login":{"text":'. $e->getMessage() .'}}';
    }
  }

  /* User Registration */
  public function userRegistration($first,$last,$phone,$email,$login,$activation,$pass)
  {
    try{
      $db = getDB();
      $st = $db->prepare("SELECT id FROM Users WHERE login=:login OR email=:email");
      $st->bindParam("login", $login,PDO::PARAM_STR);
      $st->bindParam("email", $email,PDO::PARAM_STR);
      $st->execute();
      $count=$st->rowCount();
      $active = 0;
      if($count<1)
      {
        $stmt = $db->prepare("INSERT INTO Users(first_name,last_name, phone,email,login,activation,hash, active) VALUES (:first,:last,:phone,:email,:login,:activation,:hash, :active)");
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
        $id=$db->lastInsertId(); // Last inserted row id
        $db = null;
        return true;
      }
      else{
      $db = null;
      return false;
      }
    }
    catch(PDOException $e) {
      echo '{"Error inserting":{"text":'. $e->getMessage() .'}}';
    }
  }

  /* User Details */
  public function userDetails($uid)
  {
    try{
      $db = getDB();
      $stmt = $db->prepare("SELECT email,login,name FROM Users WHERE id=:id");
      $stmt->bindParam("uid", $uid,PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
      return $data;
    }
    catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
  }

  public function checkPassword($pwd){
  	if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/', $pwd)){
  		return true;
  	}
  	return false;
  }

  public function userEmail($email)
  {
    try{
      $db = getDB();
      $stmt = $db->prepare("SELECT * FROM Users WHERE login=:email or email=:email");
      $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
      $stmt->bindParam("login", $email,PDO::PARAM_STR) ;
      $stmt->execute();
      $data = $stmt->fetch(PDO::FETCH_ASSOC);
      return $data;
    }

    catch(PDOException $e) {
        echo '{"error email":{"text":'. $e->getMessage() .'}}';
    }
  }

  public function userReset($new, $user)
  {
    try{
      $db = getDB();
      $hash= hash('whirlpool', $new);
      $sql = "UPDATE Users SET hash=:hash WHERE login=:user";
      $stmt= $db->prepare($sql);
      $stmt->bindParam(':user', $user,PDO::PARAM_STR);
      $stmt->bindParam(':hash', $hash,PDO::PARAM_STR);
      $stmt->execute();
      return true;
    }
    catch(PDOException $e) {
        echo '{"error pass":{"text":'. $e->getMessage() .'}}';
        return false;
    }
  }
}
?>
