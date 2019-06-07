<?php

$dbh = new PDO("mysql:host=localhost;dbname=daisy;charset=UTF8", 'root', '');

if (isset($_POST["inventory"]) && isset($_POST["ticket"])) {
	 $q = $dbh->prepare("UPDATE users SET BGInv  = :inventory WHERE TICKET = :token");
	 $q->execute(array('inventory' => $_POST['inventory'], 'token' => $_POST['ticket']));
	 }
