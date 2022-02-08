<?php
$fname = $_GET["filename"];
if(strpos(fname, ".php")) {
	exit();
}
if (file_exists("./" . $fname)) {
	exit(file_get_contents("./" . $fname));
} else {
    $root = "http://sharaball.ru/fs/";
    $url = $root.$fname; 
    $headers = get_headers($url, 1);
    $type = $headers["Content-Type"];
    header('Content-Type: '.$type);
    exit(file_get_contents($url));
}
?>
