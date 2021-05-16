<?php
require("db_connection.php"); 

if(!(isset($_POST['level']) && isset($_POST['id']))) exit('error');
if(mb_strlen($_POST["level"]) > 5) exit('error');
if(preg_match("/[^a-z,A-Z,0-9,а-я,А-Я,\_]/u", $_POST["level"])) exit('error');

$q = $dbh->prepare("UPDATE users SET LEVEL = :level WHERE ID = :id");
$q->execute(array('level' => $_POST["level"], 'id' => $_POST['id']));

echo $_POST['level'];
