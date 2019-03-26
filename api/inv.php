<?php

$db = new mysqli('localhost', 'root', '', 'daisy');

$q = $db->query("UPDATE users SET INVENTORY  = '" . $_POST['inventory'] . "' WHERE TICKET = '" . $_POST['ticket'] ."';");
