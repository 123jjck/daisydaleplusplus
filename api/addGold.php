<?php
require_once("db_connection.php"); 
$query = $dbh->prepare("UPDATE users SET GOLD = GOLD + :amount WHERE TICKET = :ticket");
$query->bindParam('ticket', $_POST['ticket']);
$query->bindParam('amount', $_POST['amount']);
$query->execute();
?>
