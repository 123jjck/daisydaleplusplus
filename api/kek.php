<?php
header('Content-Type: text/plain; charset=utf-8');
$db = new mysqli('localhost', 'root', '', 'daisy');
$db->set_charset("utf8");

$q = $db->query("SELECT * FROM USERS WHERE TICKET = '" . $_GET['ticket'] ."';");

$a = $q->fetch_assoc();

echo "username=" . $a['USERNAME']  . "&level=" . $a['LEVEL'] . "&regdate=" . $a['REGDATE'] . "&roleflags=" . $a['ROLEFLAGS'] . "&money=".$a["MONEY"]."&gold=".$a["GOLD"]."&magic=".$a["MAGIC"]."&avatar=" . $a['AVATAR'] . "&inventory=" . $a['INVENTORY'];
