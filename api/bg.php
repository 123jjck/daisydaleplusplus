<?php
include("db_connection.php"); 
global $dbh;
$q = $dbh->prepare("UPDATE users SET BG  = :bg WHERE TICKET = :token");
 $q->execute(array('bg' => $_POST['bg'], 'token' => $_POST['ticket']));
?>
