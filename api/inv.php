<?php
include ("db_connection.php");
global $dbh;

if (isset($_POST["inventory"]) && isset($_POST["ticket"]))
{
    //костыльное ограничение вещей в инвентаре
    $count = mb_substr_count($_POST['inventory'], '<ID>');
    if ($count > 240) exit;
    $q = $dbh->prepare("UPDATE users SET INVENTORY  = :inventory WHERE TICKET = :token");
    $q->execute(array(
        'inventory' => $_POST['inventory'],
        'token' => $_POST['ticket']
    ));
}
