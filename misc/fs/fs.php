<?php
$root = "http://sharaball.ru/fs/";

$url = $root.$_GET["filename"]; 
$headers = get_headers($url, 1);
$type = $headers["Content-Type"];
header('Content-Type: '.$type);
exit(file_get_contents($url));
?>
