<?php

$dbh = new PDO("mysql:host=localhost;dbname=daisy;charset=UTF8", 'root', '');

if (isset($_POST["inventory"]) && isset($_POST["ticket"])) {
	$inv = $_POST["inventory"];
	$invred = str_replace("IsUsed>0|IsLimited>0|", '', $inv);
	$invred2 = str_replace("|", ';', $invred);
	$invred3 = preg_replace("/[^0-9,;]/", '', $invred2);
	
	 $q = $dbh->prepare("UPDATE users SET BGInv  = :inventory WHERE TICKET = :token");
	 $q->execute(array('inventory' => $invred3, 'token' => $_POST['ticket']));
	 }
