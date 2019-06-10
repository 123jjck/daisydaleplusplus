<?php
$dbh = new PDO("mysql:host=localhost;dbname=daisy;charset=UTF8", 'root', '');
 if (strlen($_POST["level"]) <= 5) {
	$q = $dbh->prepare("UPDATE users SET LEVEL = :level WHERE TICKET = :ticket");
			$q->execute(array('level' => $_POST["level"], 'ticket' => $_POST['ticket']));
 }
