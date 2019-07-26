<?php
include("db_connection.php"); 
global $dbh;
 if (strlen($_POST["level"]) <= 5) {
	$q = $dbh->prepare("UPDATE users SET LEVEL = :level WHERE TICKET = :ticket");
			$q->execute(array('level' => $_POST["level"], 'ticket' => $_POST['ticket']));
 }
