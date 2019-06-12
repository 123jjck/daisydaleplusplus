<?php
$db = new mysqli('localhost', 'root', '', 'daisy');
$db->query("UPDATE users SET MONEY=money+".$_POST['amount']." WHERE TICKET='".$_POST['ticket']."'");
?>
