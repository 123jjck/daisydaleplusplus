<?php
include("db_connection.php"); 
global $dbh;
$query = $dbh->prepare("UPDATE users SET GOLD = GOLD + :amount WHERE TICKET = :ticket");
$query->bindParam('ticket', $_POST['ticket']);
$query->bindParam('amount', $_POST['amount']);
$query->execute();
?>
