<?php

include("/var/www/html/db_connection.php");
global $dbh;

$q = $dbh->prepare("UPDATE users SET AVATAR  = :avatar WHERE TICKET = :token");
 $q->execute(array('avatar' => $_POST['avatar'], 'token' => $_POST['ticket']));
