<?php
include("db_connection.php"); 
global $db;
$db->query("UPDATE users SET MONEY=money+".$_POST['amount']." WHERE TICKET='".$_POST['ticket']."'");
?>
