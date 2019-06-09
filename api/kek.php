<?php
header('Content-Type: text/plain; charset=utf-8');
$dbh = new PDO("mysql:host=localhost;dbname=daisy;charset=UTF8", 'root', '');
	$q = $dbh->prepare("SELECT * FROM users WHERE TICKET = :ticket");
			$q->execute(array('ticket' => $_GET['ticket']));
				$a = $q->fetch(PDO::FETCH_ASSOC);
				$inv = $a['BGInv'];
	$invred = str_replace("IsUsed>0|IsLimited>0|", '', $inv);
	$invred2 = str_replace("|", ';', $invred);
	$invre14 = preg_replace("/[^0-9,;]/", '', $invred2);
	$ava = $a['AVATAR'];
	$avared = preg_replace("/[^0-9]/", ';', $ava);
	$avacolors = explode(";", $avared);
	foreach ($avacolors as $color) {
		if(strlen($color) >= 6 && $color != 16762375)
    $goodcolor = $color;
}

if(!isset($GLOBALS["goodcolor"])) {
	echo "id=" . $a['ID']  . "&username=" . $a['USERNAME']  . "&level=" . $a['LEVEL'] . "&regdate=" . $a['REGDATE'] . "&roleflags=" . $a['ROLEFLAGS'] . "&money=".$a["MONEY"]."&gold=".$a["GOLD"]."&magic=".$a["MAGIC"]."&avatar=" . $ava . "&inventory=" . $a['INVENTORY'] . "&isbanned=" . $a['ISBANNED'] . "&bg=" . $a['BG'] . "&bginven=" . $invre14;
} else {
$bestcolor = 'Color>';
$bestcolor .= $GLOBALS["goodcolor"];
$avaecho = str_replace("Color>16762375", $bestcolor, $ava);
echo "id=" . $a['ID']  . "&username=" . $a['USERNAME']  . "&level=" . $a['LEVEL'] . "&regdate=" . $a['REGDATE'] . "&roleflags=" . $a['ROLEFLAGS'] . "&money=".$a["MONEY"]."&gold=".$a["GOLD"]."&magic=".$a["MAGIC"]."&avatar=" . $avaecho . "&inventory=" . $a['INVENTORY'] . "&isbanned=" . $a['ISBANNED'] . "&bg=" . $a['BG'] . "&bginven=" . $invre14;
}
