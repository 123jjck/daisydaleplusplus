<?php

session_start();

include("db_connection.php"); 
global $db;
$db->set_charset("utf8");
$errlvl = "Ошибка! Длинный уровень. Максимальная длина: 5 символов";
$errlv2 = "Ошибка! Уровень не должен содержать недопустимые символы";
$errdate = "Ошибка! Неправильная дата";

if (!isset($_SESSION["userId"]) || !isset($_POST["level"])) {
    exit;    
}
    if (strlen($_POST["level"]) > 5) {
        echo $errlvl;
        } else {
                if (preg_match("/[^a-z,A-Z,0-9,а-я,А-Я,\_]/u", $_POST["level"])) {
                echo $errlv2;
                } else {
                        if (!checkdate ((int)$_POST["regmonth"],(int)$_POST["regday"],(int)$_POST["regyear"])) {
                        echo $errdate;
		                } else {
$q = $db->query("SELECT * FROM users WHERE ID = " . $_SESSION["userId"] . ";");
$a = $q->fetch_assoc();
$prevLevel = $a['LEVEL'];

$level = $_POST["level"];
$regdate = $_POST["regyear"] . "-" . $_POST["regmonth"] . "-" . $_POST["regday"] . "T" . explode("T", $a['REGDATE'])[1];

$level = strval($level);


$db->query("UPDATE users SET LEVEL = '" . $level . "' WHERE ID = " . $_SESSION["userId"] . ";");
$db->query("UPDATE users SET REGDATE = '" . $regdate . "' WHERE ID = " . $_SESSION["userId"] . ";");

$res = "ОК, данные обновлены!";

echo $res;
    }
        }
            }
?>
