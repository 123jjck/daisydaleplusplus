<?php
include("db_connection.php"); 
global $db;
$db->query("UPDATE users SET BODY_COLOR=".$_POST['body_color'].",EARS_COLOR=".$_POST['ears_color'].",EARS=".$_POST['ears'].",EYES=".$_POST['eyes'].",HORNS=".$_POST['horns'].",LEGS=".$_POST['legs'].",LEGS_COLOR=".$_POST['legs_color'].",MOUTH=".$_POST['mouth'].",NOSE=".$_POST['nose'].",PEAK=".$_POST['peak']." WHERE TICKET='".$_POST['token']."'");
?>
