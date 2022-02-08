<?php
$fname = $_GET["filename"];

function validate_name($filename) {
	if (strlen($filename) > 255) { // no mb_* since we check bytes
		return false;
	}
	$invalidCharacters = '|\'\\?*&<";:>+[]=/';
	if (strpbrk($filename, $invalidCharacters) !== false) {
		return false;
	}

	$path_info = pathinfo('./' . $filename);
	if($path_info['extension'] !== 'swf' &&
	$path_info['extension'] !== 'png' &&
	$path_info['extension'] !== 'jpg') {
		return false;
	}
	return true;
}

if(!validate_name($fname)) exit("Пошёл нафиг!");

if (file_exists("./" . $fname)) { //возврат файла, если он существует локально 
	header("Content-Description: File Transfer"); 
	if(pathinfo('./' . $fname)['extension'] == 'swf') header("Content-Type: application/x-shockwave-flash");
	if(pathinfo('./' . $fname)['extension'] == 'png') header("Content-Type: image/png");
	if(pathinfo('./' . $fname)['extension'] == 'jpg') header("Content-Type: image/jpeg");
	$size = filesize('./' . $fname);
	header('Content-Length: ' . $size);
	header("Cache-control: public");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*4) . " GMT");

	exit(file_get_contents("./" . $fname));
} else {
    $root = "http://sharaball.ru/fs/";
    $url = $root . $fname; 
    $headers = get_headers($url, 1);
    $type = $headers["Content-Type"];

	header("Content-Description: File Transfer");
	header('Content-Type: ' . $type);
	header('Content-Length: ' . $headers["Content-Length"]);
	header("Cache-control: public");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*4) . " GMT");

	if(($content = @file_get_contents($url)) === FALSE) {
		exit("Пошёл нафиг!");
	}
    exit($content);
}
?>
