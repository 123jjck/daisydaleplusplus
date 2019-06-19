<?php


$dbh = new PDO("mysql:host=localhost;dbname=daisy;charset=UTF8", 'root', '');


if (isset($_POST["ticket"])) {
	$spkidaly = $dbh->prepare("SELECT * FROM users WHERE TICKET = :ticket");
	$spkidaly->execute(array('ticket' => $_POST["ticket"]));
	if (!$spkidaly) {
		exit;
	}
//$id = ($_POST["id"] - 100000);
	$id = $_POST["id"];
	$a = $spkidaly->fetch(PDO::FETCH_ASSOC);
	if ($a['ROLEFLAGS'] >= 131086) {
		$q = $dbh->prepare("UPDATE users SET ISBANNED = 1 WHERE ID = :id");
		$q->execute(array('id' => $id));
	}
}
