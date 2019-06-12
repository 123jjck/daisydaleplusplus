<?php
$db = new mysqli('localhost', 'root', '', 'daisy');
$db->query("UPDATE users SET GOLD=gold+".$_POST['amount']." WHERE TICKET='".$_POST['ticket']."'");
?>