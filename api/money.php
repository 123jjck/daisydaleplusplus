<?php
require_once("db_connection.php"); 
$query = $dbh->prepare('UPDATE users SET GOLD = GOLD - :priceRu, MONEY = MONEY - :priceSm WHERE TICKET = :ticket');
$query->bindParam('priceRu', $_POST['priceRu']);
$query->bindParam('priceSm', $_POST['priceSm']);
$query->bindParam('ticket', $_POST['ticket']);
$query->execute();
?>
