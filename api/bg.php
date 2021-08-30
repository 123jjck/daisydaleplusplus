<?php
require_once("db_connection.php"); 
$query = $dbh->prepare("UPDATE users SET BG = :bg WHERE TICKET = :token");
$query->execute(array('bg' => $_POST['bg'], 'token' => $_POST['ticket']));
?>
