<?php
include("db_connection.php"); 
global $dbh;
$db->query("UPDATE users SET GOLD=gold-".$_POST['priceRu'].",MONEY=money-".$_POST['priceSm']." WHERE TICKET='".$_POST['ticket']."'");
?>
