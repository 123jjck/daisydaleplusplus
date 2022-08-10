<?php
if(!isset($_GET['filename'])) die;
$fname = $_GET["filename"];

function validate_name($filename) {
	if (strlen($filename) > 255) return false; // no mb_* since we check bytes
	$invalidCharacters = '|\'\\?*&<";:>+[]=/';
	if (strpbrk($filename, $invalidCharacters) !== false) return false;
	$path_info = pathinfo('./' . $filename);
	if($path_info['extension'] !== 'swf' && $path_info['extension'] !== 'png' && $path_info['extension'] !== 'jpg') return false;
	return true;
}

if(!validate_name($fname)) die;

if (file_exists("./" . $fname)) { //возврат файла, если он существует локально 
    switch(pathinfo('./' . $fname)['extension']) {
		case "swf":
			$content_type = "application/x-shockwave-flash";
			break;
		case "png":
			$content_type = "image/png";
			break;
		case "jpg":
			$content_type = "image/jpeg";
			break;
		default:
			$content_type = "application/octet-stream";
	}
	header("Content-Type: $content_type");

	$size = filesize('./' . $fname);
	header('Content-Length: ' . $size);
	header("Cache-control: public");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*4) . " GMT");

	readfile('./' . $fname);
} else {
    $root = "http://sharaball.ru/fs/";
    $url = $root . $fname; 
    $headers = get_headers($url, 1);
    $type = $headers["Content-Type"];

	header('Content-Type: ' . $type);
	header('Content-Length: ' . $headers["Content-Length"]);
	header("Cache-control: public");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*4) . " GMT");

	if(($content = @file_get_contents($url)) === FALSE) die;
    exit($content);
}
?>
