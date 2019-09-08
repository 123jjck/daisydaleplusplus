<?php

/*
	минимальный ресурсный сервер
	(c) Дейзи
*/

define('root','http://sharaball.ru/fs/');
define('fname', $_GET['filename']);

if (file_exists("./" . fname)) {
	//возврат файла, если он существует локально
	echo(file_get_contents("./" . fname));
	exit;
} else {
	//запрос файла
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, root . fname);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($ch);
	$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if ($code == 404) {
		//выдаём ошибку если нас наебали
		http_response_code(404);
		exit;
	} else if ($code == 200){
		//200 ок, возвращаем файл быдлоюзверю
		echo($res);
		exit;
	}
}

?>
