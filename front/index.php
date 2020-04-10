<?php

session_start();


if (isset($_SESSION["userId"])) {
    header("Location: /game.php");    
}

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

if (isset($_POST["username"]) && isset($_POST["password"])) {
  $a = $db->query("SELECT ID, PASSWORD, ROLEFLAGS FROM users WHERE USERNAME = '" . $_POST['username'] . "';");
  if ($a->num_rows == 0) {
    $error = "Нет такого смешарика";
  } else {
    $fetched = $a->fetch_assoc();
    
    if (password_verify(md5($_POST["password"]), $fetched['PASSWORD'])) {
      $token = generateTicket();
      $db->query("UPDATE users SET TICKET = '" . $token . "' WHERE USERNAME = '" . $_POST["username"] . "';");
      $_SESSION["userId"] = $fetched["ID"];
      $_SESSION["ticket"] = $token;
      $_SESSION["roleflags"] = $fetched["ROLEFLAGS"];
      header("Location: /");
    } else {
      $error = "Неправильный пароль.";
    }
  } 
}
?>

<!DOCTYPE html>
<html>
<head>
    	<meta charset="utf-8" />
	<title>Вход - DD++</title>
 	<link rel="icon" type="image/png" href="/favicon.png" />
	<link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>
	<div class="loginbox">
		<img class="logo" src="/logo.png">
		<form action='' method='POST'>
                	<p class="message"><?php if (isset($error)) { echo $error; } ?></p>
			<h1>Вход</h1>
                	<input name='username'  placeholder='Логин' /><br/>
                	<input name='password' type='password' placeholder='Пароль'  /><br/>
                	<br/>
                	<button class='meow-btn' type='submit' name='btnLogin'> Войти </button>  <a class='meow-btn' style='background:#ff8787; padding: 16px 15px;' href='/register.php' name='btnReg'> Создать аккаунт </button>  <a/>
		</form>
	</div>
</body>
</html>
