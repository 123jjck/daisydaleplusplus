# Минимальное флеш-хранилище by Daisy

Минимальное флеш-хранилище позволит скачивать .swf файлы напрямую с серверов SharaBall по необходимости, экономив место и трафик

# Установка
1. Переместите файл `fs.php` в директорию `/fs/` на вашем сайте
2. Замените всё содержимое файла `.htaccess` в корневой директории на это
```
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule ^fs/(.*)!(.*).swf$ /fs/fs.php?filename=$1.swf
RewriteRule ^fs/(.*)!(.*).png$ /fs/fs.php?filename=$1.png
RewriteRule ^fs/(.*)!.swf$ /fs/fs.php?filename=$1.swf
RewriteRule ^async/ServerAction ServerAction.php
RewriteRule ^async/Ping ping.php
RewriteRule ^logout logout.php
Options -Indexes
</IfModule>
```
* Не забудьте [включить модуль cURL в PHP](https://stackoverflow.com/questions/1347146/howto-enable-curl-in-php-xampp)
