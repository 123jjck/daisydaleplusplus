<?php
include("db_connection.php"); 
global $dbh;
	$ava = $_POST['avatar'];
/*	$avared = preg_replace("/[^0-9]/", ';', strval($ava));
	$avacolors = explode(";", $avared);
	foreach ($avacolors as $color) {
		if(strlen($color) >= 6 && $color != 16762375) {
    $goodcolor = $color;
  }
}

if(isset($GLOBALS["goodcolor"])) {
$bestcolor = 'Color>';
$bestcolor .= $GLOBALS["goodcolor"];
  $avaecho = str_replace("Color>16762375", $bestcolor, $ava);
$q = $dbh->prepare("UPDATE users SET AVATAR  = :avatar WHERE TICKET = :token");
 $q->execute(array('avatar' => $avaecho, 'token' => $_POST['ticket']));
} else {
*/
 $q = $dbh->prepare("UPDATE users SET AVATAR  = :avatar WHERE TICKET = :token");
 $q->execute(array('avatar' => $ava, 'token' => $_POST['ticket']));
//}
