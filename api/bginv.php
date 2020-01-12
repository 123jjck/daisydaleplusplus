<?php
include ("db_connection.php");
global $dbh;

if (isset($_POST["inventory"]) && isset($_POST["ticket"]))
{
    $inv = $_POST["inventory"];
    $invred = str_replace("IsUsed>0|IsLimited>0|", '', $inv);
    $invred2 = str_replace("|", ';', $invred);
    $invred3 = preg_replace("/[^0-9,;]/", '', $invred2);
    //костыльное ограничение вещей в инвентаре фонов
    $count = mb_substr_count($invred3, ';');
    if ($count > 350) exit(); 

    $q = $dbh->prepare("UPDATE users SET BGInv  = :inventory WHERE TICKET = :token");
    $q->execute(array(
        'inventory' => $invred3,
        'token' => $_POST['ticket']
    ));
}

