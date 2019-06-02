<?php

/*
	минимальный ресурсный сервер
	(c) Дейзи
*/

$root = "http://sharaball.ru/fs/";
$fname = $_GET["filename"];

function sendBack($fname) {

	// вообще наверное лучше просто отправить файл 
	// и не тратить время на еще один HTTP запрос
	// readfile($fname);
	header("Location: /fs/" . $GLOBALS["fname"]);
	
}


function check_exists() {
	// проверка на существование файла

	if (file_exists("./" . $GLOBALS["fname"])) {
		sendBack("./" .$GLOBALS["fname"]);
		exit;
	}
}

function check_404($url) {
	// проверка на 404

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($ch);
	$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if ($code == 404) {
		http_response_code(404);
		echo "Пошёл нафиг!";
		exit;
	}
}

function download($url) {
	// скачивание

	$ch = curl_init();
	$file = fopen("./" . $GLOBALS["fname"], "w");
	curl_setopt($ch, CURLOPT_URL, $root . $GLOBALS["fname"]);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_BUFFERSIZE, 65536);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_NOPROGRESS, true);
	curl_setopt($ch, CURLOPT_FILE, $file);
	curl_exec($ch);
}




check_exists($fname);
check_404($fname);
download($fname);
sendBack($fname);

?>
