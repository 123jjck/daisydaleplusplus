<?php
$dbh = new PDO("mysql:host=localhost;dbname=daisy;charset=UTF8", 'root', '');

$q = $dbh->prepare("UPDATE users SET AVATAR  = :avatar WHERE TICKET = :token");
 $q->execute(array('avatar' => $_POST['avatar'], 'token' => $_POST['ticket']));
