<?php
/* Данные от базы */
$host = 'localhost'; // Хост
$user = 'root'; // Юзер
$password = ''; // Пароль
$dbname = 'daisy'; // Название базы данных
try
{
    $db = new mysqli($host, $user, $password, $dbname);
    if (!$db) throw new Exception('Connection error');
}
catch(Exception $e)
{
    echo 'Ошибка! Попробуйте зайти в следующий раз!';
    die;
}

try
{
    $dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo 'Ошибка! Попробуйте зайти в следующий раз!';
    die;
}
