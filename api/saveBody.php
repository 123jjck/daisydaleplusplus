<?php
include("db_connection.php"); 
global $dbh;
$query = $dbh->prepare('UPDATE users SET BODY_COLOR = :bodycolor, EARS_COLOR = :earscolor, EARS = :ears, EYES = :eyes, HORNS = :horns, LEGS = :legs, LEGS_COLOR = :legscolor, MOUTH = :mouth, NOSE = :nose, PEAK = :peak WHERE TICKET = :ticket');
$query->bindParam('bodycolor', $_POST['body_color']);
$query->bindParam('earscolor', $_POST['ears_color']);
$query->bindParam('ears', $_POST['ears']);
$query->bindParam('eyes', $_POST['eyes']);
$query->bindParam('horns', $_POST['horns']);
$query->bindParam('legs', $_POST['legs']);
$query->bindParam('legscolor', $_POST['legs_color']);
$query->bindParam('mouth', $_POST['mouth']);
$query->bindParam('nose', $_POST['nose']);
$query->bindParam('peak', $_POST['peak']);
$query->bindParam('ticket', $_POST['token']);
$query->execute();
?>
