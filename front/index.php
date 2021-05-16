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

require("db_connection.php"); 

if (isset($_POST["username"]) && isset($_POST["password"])) {
  $a = $dbh->prepare("SELECT ID, PASSWORD, ROLEFLAGS FROM users WHERE USERNAME = :uname");
  $a->bindParam('uname', $_POST['username']);
  $a->execute();
  $fetched  = $a->fetch(PDO::FETCH_ASSOC);
  if (!$fetched) {
    $error = "Нет такого смешарика";
  } else {    
    if (password_verify(md5($_POST["password"]), $fetched['PASSWORD'])) {
      $token = generateTicket();
	    
      $updTik = $dbh->prepare("UPDATE users SET TICKET = :token WHERE USERNAME = :uname;");
      $updTik->bindParam('token', $token);
      $updTik->bindParam('uname', $_POST['username']);
      $updTik->execute();
	    
      $_SESSION["userId"] = $fetched["ID"];
      $_SESSION["ticket"] = $token;
      $_SESSION["roleflags"] = $fetched["ROLEFLAGS"];
      header("Location: /");
    } else {
      $error = "Неправильный пароль";
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
                	<button class='meow-btn' type='submit' style="display: inline-block;" name='btnLogin'>Войти</button>&nbsp;<a class='meow-btn' style='background:#ff8787; display: inline-block;' href='/register.php' name='btnReg'>Создать аккаунт</a>
		</form>
	</div>
</body>
</html>
