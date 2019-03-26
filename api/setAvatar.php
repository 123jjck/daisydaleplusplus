<?php


$db = new mysqli('localhost', 'root', '', 'daisy');

$q = $db->query("UPDATE users SET AVATAR  = '" . $_POST['avatar'] . "' WHERE TICKET = '" . $_POST['ticket'] ."';");
