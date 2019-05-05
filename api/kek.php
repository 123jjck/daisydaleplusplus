<?php
header('Content-Type: text/plain; charset=utf-8');
include("/var/www/html/db_connection.php");
global $dbh;
	$q = $dbh->prepare("SELECT * FROM users WHERE TICKET = :ticket");
			$q->execute(array('ticket' => $_GET['ticket']));
				$a = $q->fetch(PDO::FETCH_ASSOC);
echo "id=" . $a['ID']  . "&username=" . $a['USERNAME']  . "&level=" . $a['LEVEL'] . "&regdate=" . $a['REGDATE'] . "&roleflags=" . $a['ROLEFLAGS'] . "&money=".$a["MONEY"]."&gold=".$a["GOLD"]."&magic=".$a["MAGIC"]."&avatar=" . $a['AVATAR'] . "&inventory=" . $a['INVENTORY'] . "&isbanned=" . $a['ISBANNED'] . "&bg=" . $a['BG'];
