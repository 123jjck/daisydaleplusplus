# DaisyDale++

**DaisyDale++** - это форк open-source сервера для аватарчата, частично совместимого с клиентом игры "Шарарам"

# Требования
Для создания сервера с Дейзи Дейлом вам нужны

1. [Adobe Flash Media Server](https://adobe.ly/2GY8WUp) (желательно версию 5, apache не ставим и убираем использовние порта 80)

2. [Xampp](https://bit.ly/2TgobyD) или другой сервер

3. Swf база файлов Шарарама 

4. [MariaDB](https://mariadb.org/download/) или [MySQL](https://dev.mysql.com/downloads/mysql/) (для хранения аккаунтов) (в случае с [XAMPP](https://bit.ly/2TgobyD) идёт в комплекте)

# Установка

1. Первым делом необходимо перенести папку daisy из репозитория в папку applications в корне Adobe Media Server.
2. Заливаем флешки на вебсервер в папку fs
4. Копируем файлы из всех папок репозитория (кроме папки daisy и файла dump.sql) и вставляем их в корень вашего сайта (для XAMPP это htdocs)
7. В PhpMyAdmin создайте базу данных и импортируйте туда dump.sql
8. Запустите Adobe Media Server 5 и Adobe Media Administration Server
9. Для запуска сервера откройте Administration Console, нажмите ажмите на кнопку new instance слева внизу, выберите пункт daisy и нажмите Enter
10. Теперь вы можете зайти на localhost и наслаждаться игрой

# Дополнительные шаги установки для запуска сервера на VDS/VPS
11. При необходимости редактируем файл ServerAction.php, меняем localhost на IP адрес сервера
12. Открываем папку daisy и редактируем main.asc, меняем переменную msHost, ставим домен для апишки (также можно указывать IP)
14. Открывем файл .htaccess и добавляем следующие строки:
    RewriteCond %{REMOTE_ADDR} !^YO\.UR\.I\.P$
    RewriteRule ^kek\.php$ - [F,L]
    RewriteRule ^ban\.php$ - [F,L]
(где YOUR IP - IP адрес вашего сервера)

# Лицензия

Делайте что хотите, но на ваш страх и риск.
