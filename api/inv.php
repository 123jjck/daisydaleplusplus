<?php

$db = new mysqli('localhost', 'root', '', 'daisy');

$q = $db->query("UPDATE USERS SET INVENTORY  = '" . $_POST['inventory'] . "' WHERE TICKET = '" . $_POST['ticket'] ."';");
