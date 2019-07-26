<?php
//mysqli 
$db = new mysqli('localhost', 'root', '', 'daisy');
// pdo
$dbh = new PDO("mysql:host=localhost;dbname=daisy;charset=UTF8", 'root', '');
