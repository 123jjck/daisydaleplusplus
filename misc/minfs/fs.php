<?php

/*
	минимальный ресурсный сервер
	(c) Дейзи
*/

define('root','http://sharaball.ru/fs/');
define('fname', $_GET['filename']);


function sendBack($name) {
	header("Content-Description: File Transfer"); 
	if(pathinfo('./' . $name)['extension'] == 'swf') header("Content-Type: application/x-shockwave-flash");
	if(pathinfo('./' . $name)['extension'] == 'png') header("Content-Type: image/png");
	if(pathinfo('./' . $name)['extension'] == 'jpg') header("Content-Type: image/jpeg");
	$size = filesize('./' . $name);
	header('Content-Length: ' . $size);
	header("Cache-control: public");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*4) . " GMT");
	exit(file_get_contents("./" . $name));
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

function check_exists() { // проверка на существование файла
	

	$name = urldecode(fname); // на всякий случай 

	if(detect_encoding($name) == 'windows-1251') {
		$name = iconv('Windows-1251', 'UTF-8', $name);
		sendBack($name);
		exit;
	}
	
	if (file_exists("./" . fname)) {
		sendBack(fname);
		exit;
	}
}

function check_404() { // проверка на 404
	

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, root . fname);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($ch);
	$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if ($code == 404) {
		http_response_code(404);
		echo "Пошёл нафиг!";
		exit;
	}
}

function download() { // скачивание
	
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




check_exists();
check_404();
download();
sendBack(fname);

?>
