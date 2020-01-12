<?php

include ("db_connection.php");
global $dbh;

if (isset($_POST["ticket"]))
{
    $rolecheck = $dbh->prepare("SELECT ROLEFLAGS FROM users WHERE TICKET = :ticket");
    $rolecheck->execute(array(
        'ticket' => $_POST["ticket"]
    ));
    $a = $rolecheck->fetch(PDO::FETCH_ASSOC);
    if (!$a) exit;
    //$id = ($_POST["id"] - 100000);
    if ((int)$a['ROLEFLAGS'] >= 131086)
    {
        $q = $dbh->prepare("UPDATE users SET ISBANNED = 1 WHERE ID = :id");
        $q->execute(array(
            'id' => $_POST['id']
        ));
    }
}

