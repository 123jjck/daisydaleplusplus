
<?php

session_start();

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

include("db_connection.php"); 
global $db;
$db->set_charset("utf8");

$safePost = Array();

foreach($_POST as $key => $value) {
  $safePost[$key] = $db->escape_string($value);
}


if (isset($safePost["username"]) && isset($safePost["password"])) {
   if (preg_match("/[^a-z,A-Z,0-9,а-я,А-Я,\_]/u", $safePost["username"])) { 
    $error = "Ваш логин содержит недопустимые символы.";
  } else {
    if (strlen($safePost["username"]) < 3 ) {
        $error = "Короткий логин";
    }  else if (strlen($safePost["username"]) > 40) {
        $error = "Длинный логин";
      } else {
      if (strlen($safePost["password"]) < 6) {
        $error = "Короткий пароль";
      } else {
        $c = $db->query("SELECT * FROM users WHERE USERNAME = '" . $safePost["username"] . "';");

        if ($c->num_rows == 0) {
          $ava = "IsBodyPart>true|BodyPartTypeId>5|MediaResourceID>67|LayerID>25|BodyPartId>30|Id>30|Color>NaN;IsBodyPart>true|BodyPartTypeId>6|MediaResourceID>68|LayerID>39|BodyPartId>31|Id>31|Color>16762375;IsBodyPart>true|BodyPartTypeId>7|MediaResourceID>74|LayerID>29|BodyPartId>40|Id>40|Color>NaN;IsBodyPart>true|BodyPartTypeId>8|MediaResourceID>98|LayerID>49|BodyPartId>73|Id>73|Color>NaN;IsBodyPart>true|BodyPartTypeId>2|MediaResourceID>55|LayerID>9|BodyPartId>1|Id>1|Color>NaN;IsBodyPart>true|BodyPartTypeId>3|MediaResourceID>56|LayerID>19|BodyPartId>2|Id>2|Color>16762375;IsBodyPart>false|GoodID>8712|MediaResourceID>27527|GoodTypeID>4|LayerID>45|Id>8712;IsBodyPart>false|GoodID>9235|MediaResourceID>29235|GoodTypeID>94|LayerID>57|Id>9235";
          $inv = "";
          $hash = password_hash(md5($safePost["password"]), PASSWORD_DEFAULT);
          $date = date("Y-m-d") . "T" . date("H-m-s") . ".0";
          $ticket = generateTicket();
          $bginv = ';339;349;430;431;';
          $qwery = $db->query("INSERT INTO `users`(`USERNAME`, `PASSWORD`, `ROLEFLAGS`, `LEVEL`, `AVATAR`, `TICKET`, `INVENTORY`, `REGDATE`, `BGInv`) VALUES ('" . $safePost["username"] . "', '" . $hash . "', 2 ,  999, '" . $ava . "', '" . $ticket . "',  '" . $inv . "', '" . $date . "', '" . $bginv . "');");
          if (!$qwery) { 
             echo $db->error;
             exit;   
          }
          $_SESSION["ticket"] = $ticket;
          $_SESSION["roleflags"] = 2;
          $_SESSION["userId"] = $id;
          header("Location: /");
        } else {
          $error = "Смешарик с таким ником уже существует.";
        }
      }
    }
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
	<form action='' method='POST'>
                <p class="message"><?php if (isset($error)) { echo $error; } ?></p>

                <h1>Регистрация</h1>

                <input name='username'  placeholder='Логин' /><br/>
                <input name='password' type='password' placeholder='Пароль'  /><br/>
                <br/>
                <button class='meow-btn' type='submit' name='btnLogin'> ОК </button> <a href='/' class='meow-btn' style='text-decoration:none; background:#ff8787; padding: 16px 15px;'> Назад </a> <br/>
      </form>
      </div>

</body>
</html>
