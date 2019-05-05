<?php
$dbh = new PDO("mysql:host=localhost;dbname=daisy;charset=UTF8", 'root', '');
$q = $dbh->prepare("UPDATE users SET BG  = :bg WHERE TICKET = :token");
 $q->execute(array('bg' => $_POST['bg'], 'token' => $_POST['ticket']));
?>
