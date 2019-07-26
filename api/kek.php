<?php
header('Content-Type: text/plain; charset=utf-8');
include("db_connection.php"); 
global $dbh;
	$q = $dbh->prepare("SELECT * FROM users WHERE TICKET = :ticket");
			$q->execute(array('ticket' => $_GET['ticket']));
				$a = $q->fetch(PDO::FETCH_ASSOC);
				$inv = $a['BGInv'];
	$ava = $a['AVATAR'];
	echo "id=" . $a['ID'] . "&username=" . $a['USERNAME'] . "&level=" . $a['LEVEL'] . "&regdate=" . $a['REGDATE'] . "&roleflags=" . $a['ROLEFLAGS'] . "&money=".$a["MONEY"]."&gold=".$a["GOLD"]."&magic=".$a["MAGIC"]."&avatar=" . $ava . "&inventory=" . $a['INVENTORY'] . "&isbanned=" . $a['ISBANNED'] . "&bg=" . $a['BG'] . "&bginven=" . $inv . '&body_color='.$a['BODY_COLOR'].'&legs='.$a['LEGS'].'&legs_color='.$a['LEGS_COLOR'].'&ears='.$a['EARS'].'&ears_color='.$a['EARS_COLOR'],'&eyes='.$a['EYES'].'&nose='.$a['NOSE'].'&mouth='.$a['MOUTH'].'&peak='.$a['PEAK'].'&horns='.$a['HORNS'].'&house_id='.$a['HOUSE_ID'].'&house_str='.$a['HOUSE_STR'];
