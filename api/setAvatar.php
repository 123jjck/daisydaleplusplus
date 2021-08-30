<?php
require_once("db_connection.php"); 
$query = $dbh->prepare("UPDATE users SET AVATAR = :avatar WHERE TICKET = :token");
$query->execute(array('avatar' => $_POST['avatar'], 'token' => $_POST['ticket']));
?>
