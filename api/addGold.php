<?php
include("db_connection.php"); 
global $db;
$db->query("UPDATE users SET GOLD=gold+".$_POST['amount']." WHERE TICKET='".$_POST['ticket']."'");
?>
