# DaisyDale

**DaisyDale** - это первый open-source сервер для аватарчата, частично совместимый с клиентом игры "Шарарам."

# Требования
Для создания сервера с Дейзи Дейлом вам нужны

1. [Adobe Flash Media Server](https://adobe.ly/2GY8WUp) (желательно версию 5, apache не ставим и убираем использовние порта 80)

2. [Xampp](https://bit.ly/2TgobyD) или другой сервер

3. Swf база файлов Шарарама 

4. [MariaDB](https://mariadb.org/download/) или [MySQL](https://dev.mysql.com/downloads/mysql/) (для хранения аккаунтов) (в случае с [XAMPP](https://bit.ly/2TgobyD) идёт в комплекте)

# Установка

1. Первым делом необходимо перенести папку daisy из репозитория в папку applications в корне Adobe Media Server.
2. Открываем папку daisy и редактируем main.asc, меняем переменную msHost, ставим домен для апишки (для локалки достаточно localhost)
3. Заливаем флешки на вебсервер в папку fs
4. Копируем файлы из всех папок репозитория (кроме папки daisy и файла dump.sql) и вставляем их в корень вашего сайта (для XAMPP это htdocs)
5. В PhpMyAdmin создайте базу данных и импортируйте туда dump.sql
6. Запустите Adobe Media Server 5 и Adobe Media Administration Server
7. Для запуска сервера откройте Administration Console, нажмите ажмите на кнопку new instance слева внизу, выберите пункт daisy и нажмите Enter
8. Теперь вы можете зайти на localhost и наслаждаться игрой

# Лицензия

Делайте что хотите, но на ваш страх и риск.
