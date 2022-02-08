<?php

/*
	минимальный ресурсный сервер
	(c) Дейзи, Jjck
*/

define('root','http://sharaball.ru/fs/');
define('fname', $_GET['filename']);
define('error', "Пошёл нафиг!");

function validate_name($filename) {
	if (strlen($filename) > 255) { // no mb_* since we check bytes
		echo error;
		exit;
	}
	$invalidCharacters = '|\'\\?*&<";:>+[]=/';
	if (strpbrk($filename, $invalidCharacters) !== false) {
		echo error;
		exit;
	}

	$path_info = pathinfo('./' . $filename);
	if($path_info['extension'] !== 'swf' &&
	$path_info['extension'] !== 'png' &&
	$path_info['extension'] !== 'jpg') {
		echo error;
		exit;
	}
}

function sendBack($filename) {
	header("Content-Description: File Transfer"); 
	if(pathinfo('./' . $filename)['extension'] == 'swf') header("Content-Type: application/x-shockwave-flash");
	if(pathinfo('./' . $filename)['extension'] == 'png') header("Content-Type: image/png");
	if(pathinfo('./' . $filename)['extension'] == 'jpg') header("Content-Type: image/jpeg");
	$size = filesize('./' . $filename);
	header('Content-Length: ' . $size);
	header("Cache-control: public");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*4) . " GMT");
	exit(file_get_contents("./" . $filename));
	//header("Location: /fs/" . $name);
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

	if(detect_encoding($filename) == 'windows-1251') { // возможный фикс проблем с кодировкой на некоторых браузерах
		$filename = iconv('Windows-1251', 'UTF-8', $filename);
	}
	
	if (file_exists("./" . $filename)) {
		sendBack($filename);
		exit;
	}
}

function check_404($filename) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, root . $filename);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($ch);
	$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if ($code == 404) {
		http_response_code(404);
		echo error;
		exit;
	}
}

function download($filename) {
	
	$ch = curl_init();
	$file = fopen("./" . fname, "w");
	curl_setopt($ch, CURLOPT_URL, root . fname);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_BUFFERSIZE, 65536);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_NOPROGRESS, true);
	curl_setopt($ch, CURLOPT_FILE, $file);
	curl_exec($ch);
}

validate_name(fname);
check_exists(fname);
check_404(fname);
download(fname);
sendBack(fname);
?>
