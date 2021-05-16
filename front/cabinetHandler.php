<?php
session_start();
require("db_connection.php");

$errlvllen = "Ошибка! Длинный уровень. Максимальная длина: 5 символов";
$errlvlreg = "Ошибка! Уровень не должен содержать недопустимые символы";
$errdate = "Ошибка! Неправильная дата";

if (!(isset($_SESSION["userId"]) && isset($_POST["level"]) && isset($_POST['regmonth']) && isset($_POST['regday']) && isset($_POST['regyear'])))
{
    exit;
}
if (mb_strlen($_POST["level"]) > 5)
{
    echo $errlvllen;
}
else
{
    if (preg_match("/[^a-z,A-Z,0-9,а-я,А-Я,\_]/u", $_POST["level"]))
    {
        echo $errlvlreg;
    }
    else
    {
        if (!checkdate((int)$_POST["regmonth"], (int)$_POST["regday"], (int)$_POST["regyear"]))
        {
            echo $errdate;
        }
        else
        {
            $getRegDate = $dbh->prepare("SELECT REGDATE FROM users WHERE ID = :id");
            $getRegDate->bindParam('id', $_SESSION['userId']);
            $getRegDate->execute();
            $previousRegdate = $getRegDate->fetch(PDO::FETCH_ASSOC)['REGDATE'];

            $level = $_POST["level"];
            $regdate = $_POST["regyear"] . "-" . $_POST["regmonth"] . "-" . $_POST["regday"] . "T" . explode("T", $previousRegdate)[1];

            $query = $dbh->prepare("UPDATE users SET LEVEL = :lvl, REGDATE = :regdate WHERE ID = :id");
            $query->bindParam('lvl', $level);
            $query->bindParam('regdate', $regdate);
            $query->bindParam('id', $_SESSION['userId']);
            $query->execute();
            echo "ОК, данные обновлены!";
        }
    }
}
?>
