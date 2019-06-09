<?php
header('Content-Type: text/plain; charset=utf-8');
$dbh = new PDO("mysql:host=localhost;dbname=daisy;charset=UTF8", 'root', '');
	$q = $dbh->prepare("SELECT * FROM users WHERE TICKET = :ticket");
			$q->execute(array('ticket' => $_GET['ticket']));
				$a = $q->fetch(PDO::FETCH_ASSOC);
				$inv = $a['BGInv'];
	$ava = $a['AVATAR'];
	echo "id=" . $a['ID'] . "&username=" . $a['USERNAME'] . "&level=" . $a['LEVEL'] . "&regdate=" . $a['REGDATE'] . "&roleflags=" . $a['ROLEFLAGS'] . "&money=".$a["MONEY"]."&gold=".$a["GOLD"]."&magic=".$a["MAGIC"]."&avatar=" . $ava . "&inventory=" . $a['INVENTORY'] . "&isbanned=" . $a['ISBANNED'] . "&bg=" . $a['BG'] . "&bginven=" . $inv;
