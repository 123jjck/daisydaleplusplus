<?php
/*
	минимальный ресурсный сервер
	(c) Дейзи, Jjck
*/
if(!isset($_GET['filename'])) die;
define('root','https://www.smeshariki.ru/fs/');
define('fname', $_GET['filename']);

function validate_name($filename) {
	if (strlen($filename) > 255) return false; // no mb_* since we check bytes
	$invalidCharacters = '|\'\\?*&<";:>+[]=/!';
	if (strpbrk($filename, $invalidCharacters) !== false) return false;
	$path_info = pathinfo('./' . $filename);
	if($path_info['extension'] !== 'swf' && $path_info['extension'] !== 'png' && $path_info['extension'] !== 'jpg') return false;
	return true;
}

function sendBack($filename) {
	switch(pathinfo('./' . $filename)['extension']) {
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

	$size = filesize('./' . $filename);
	header('Content-Length: ' . $size);
	header("Cache-control: public");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*4) . " GMT");
	readfile('./' . $filename);
}

function detect_encoding($string) { 
	static $list = array('utf-8', 'windows-1251');
  
	foreach ($list as $item) {
	  $sample = iconv($item, $item, $string);
	  if (md5($sample) == md5($string))
		return $item;
	}
	return null;
}

function check_exists($filename) {
	$filename = urldecode($filename); // на всякий случай 

	if(detect_encoding($filename) == 'windows-1251') $filename = iconv('Windows-1251', 'UTF-8', $filename); // возможный фикс проблем с кодировкой на некоторых браузерах

	return file_exists("./" . $filename);
}

function check_404($filename) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, root . $filename);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($ch);
	$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	return $code == 404; 
}

function download($filename) {
	$ch = curl_init();
	$file = fopen("./" . $filename, "w");
	curl_setopt($ch, CURLOPT_URL, root . $filename);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_BUFFERSIZE, 65536);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_NOPROGRESS, true);
	curl_setopt($ch, CURLOPT_FILE, $file);
	curl_exec($ch);
}

if(!validate_name(fname)) die;

if(check_exists(fname)) {
	sendBack(fname);
} else if(!check_404(fname)) {
	download(fname);
	sendBack(fname);
} else {
	http_response_code(404);
}
?>
