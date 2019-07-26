<?php

include("db_connection.php"); 
global $dbh;

if (isset($_POST["inventory"]) && isset($_POST["ticket"])) {
	 $inv = $dbh->prepare("SELECT INVENTORY FROM users WHERE TICKET = :token");
	 $inv->execute(array('token' => $_POST['ticket']));
	 $fetch = $inv->fetch(PDO::FETCH_ASSOC);
	 $str = $fetch['INVENTORY'];
   //костыльное ограничение вещей в инвентаре 
     $count = mb_substr_count($str, '<ID>');
	 if ($count > 240) {
     exit();
     } else {
	 $q = $dbh->prepare("UPDATE users SET INVENTORY  = :inventory WHERE TICKET = :token");
	 $q->execute(array('inventory' => $_POST['inventory'], 'token' => $_POST['ticket']));
	 }
}
