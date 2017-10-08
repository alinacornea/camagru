<?php
  class comClass
  {
    /* User Login */
    public function send_mail($login)
    {
      try{
        $db = getDB();
        $st = $db->prepare("SELECT * FROM Users WHERE  login = :login");
        $st->bindParam("login", $login,PDO::PARAM_STR) ;
        $st->execute();
        $com = $st->fetch(PDO::FETCH_ASSOC);
        $email = $com['email'];

        $To = $email;
        $Subject = "New comment on your picture!";
        $Message = "Hi ".$login. ","."<br/>" ."You have a new_comment, check your Camagru account!!" ."<br/>";
        $Headers = "From: camagru@gmail.com \r\n" .
        "Reply-To: camagru@gmail.com \r\n" .
        "Content-type: text/html; charset=UTF-8 \r\n";

        mail($To, $Subject, $Message, $Headers);
      }
      catch(PDOException $e) {
          echo '{"error login":{"text":'. $e->getMessage() .'}}';
      }
    }
  }
?>
