<?php
session_start();
require("db_connection.php"); 

function generateTicket() {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function checkRegister($username, $password, $dbh) {
  if (preg_match("/[^a-z,A-Z,0-9,а-я,А-Я,\_]/u", $username)) { 
    $error = "Ваш логин содержит недопустимые символы.";
  } else if(mb_strlen($username) < 3) {
    $error = "Короткий логин";
  } else if(mb_strlen($username) > 16) {
    $error = "Длинный логин";
  } else if(mb_strlen($password) < 6) {
    $error = "Короткий пароль";
  } else if(mb_strlen($password) > 32) {
    $error = "Длинный пароль";
  } else {
    $query = $dbh->prepare("SELECT * FROM users WHERE USERNAME = :nick");
    $query->bindParam('nick', $username);
    $query->execute();
    $userInfo = $query->fetch(PDO::FETCH_ASSOC);
    $error = $userInfo ? 'Игрок с таким ником уже существует' : false;
  }
  return $error;
}

if(isset($_POST['username']) && isset($_POST['password'])) {
  $error = checkRegister($_POST['username'], $_POST['password'], $dbh);
  if(empty($error)) {
    $ava = "IsBodyPart>true|BodyPartTypeId>5|MediaResourceID>67|LayerID>25|BodyPartId>30|Id>30|Color>NaN;IsBodyPart>true|BodyPartTypeId>6|MediaResourceID>68|LayerID>39|BodyPartId>31|Id>31|Color>16762375;IsBodyPart>true|BodyPartTypeId>7|MediaResourceID>74|LayerID>29|BodyPartId>40|Id>40|Color>NaN;IsBodyPart>true|BodyPartTypeId>8|MediaResourceID>98|LayerID>49|BodyPartId>73|Id>73|Color>NaN;IsBodyPart>true|BodyPartTypeId>2|MediaResourceID>55|LayerID>9|BodyPartId>1|Id>1|Color>NaN;IsBodyPart>true|BodyPartTypeId>3|MediaResourceID>56|LayerID>19|BodyPartId>2|Id>2|Color>16762375;IsBodyPart>false|GoodID>8712|MediaResourceID>27527|GoodTypeID>4|LayerID>45|Id>8712;IsBodyPart>false|GoodID>9235|MediaResourceID>29235|GoodTypeID>94|LayerID>57|Id>9235";
    $inv = "";
    $hash = password_hash(md5($_POST["password"]), PASSWORD_DEFAULT);
    $date = date("Y-m-d") . "T" . date("H-i-s") . ".0";
    $ticket = generateTicket();
    $bginv = ';339;349;430;431;';

    $query = $dbh->prepare("INSERT INTO users(USERNAME, PASSWORD, ROLEFLAGS, LEVEL, AVATAR, TICKET, INVENTORY, REGDATE, BGInv) VALUES(:nick, :pass, :role, :lvl, :ava, :ticket, :inv, :regdate, :bginv);");
    $query->bindParam('nick', $_POST['username']);
    $query->bindParam('pass', $hash);
    $query->bindValue('role', 2);
    $query->bindValue('lvl', 999);
    $query->bindParam('ava', $ava);
    $query->bindParam('ticket', $ticket);
    $query->bindParam('inv', $inv);
    $query->bindParam('regdate', $date);
    $query->bindParam('bginv', $bginv);
    if(!$query->execute()) exit;
    
    $_SESSION["ticket"] = $ticket;
    $_SESSION["roleflags"] = 2;
    $_SESSION["userId"] = $dbh->lastInsertId();
    header("Location: /");
  }
} 
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Создать аккаунт - DD++</title>
      <link rel="icon" type="image/png" href="/favicon.png" />
      <link rel="stylesheet" type="text/css" href="/style.css">
   </head>
   <body>
      <div class="loginbox">
         <img class="logo" src="/logo.png">
         <form action="" method="POST">
            <p class="message"><?php if (isset($error)) { echo $error; } ?></p>
            <h1>Регистрация</h1>
            <input name="username" minlength="3" maxlength="16" placeholder="Логин" /><br/>
            <input name="password" type="password" minlength="3" maxlength="32" placeholder="Пароль" /><br/>
            <br/>
            <button class="meow-btn" type="submit" style="display: inline-block;" name="btnLogin">ОК</button>&nbsp;<a href="/" class="meow-btn" style="text-decoration: none; background: #ff8787; display: inline-block;">Назад</a><br/>
         </form>
      </div>
   </body>
</html>
