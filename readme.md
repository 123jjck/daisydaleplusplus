# DaisyDale++

**DaisyDale++** - это форк open-source сервера для аватарчата, частично совместимого с клиентом игры "Шарарам"

# Плюсы DD++
Из плюсов можно выделить:

1. **Лёгкую установку**. Для запуска на localhost теперь не нужно редактировать никакие файлы, всё работает из коробки, а также добавлены ссылки на нужный софт

2. **Поддержку**. Официальный репозиторий больше не поддерживается, в то время как этот будет постоянно обновляться

3. **Wiki**. В нашем репозитории есть собственная вики с информацией о Дейзи Дейле, которую не предоставляют в официальном репозитории 

# Требования
Для создания сервера с Дейзи Дейлом вам нужны

1. Adobe Media Server (для: [Windows x64](https://download.macromedia.com/pub/adobemediaserver/5_0_15/AdobeMediaServer5_x64.exe), [Linux x64](https://download.macromedia.com/pub/adobemediaserver/5_0_15/AdobeMediaServer5_x64.tar.gz)) (для 32-х битных систем Windows можно попробовать использовать [эту](http://download.macromedia.com/pub/flashmediaserver/updates/3_5_4/Windows/FlashMediaServer3.5.exe) версию), apache **не** ставим и **убираем** использовние порта 80)

2. [XAMPP](https://bit.ly/2TgobyD) или другой вебсервер с PHP

3. SWF База Файлов Шарарама 

4. [MariaDB](https://mariadb.org/download/) или [MySQL](https://dev.mysql.com/downloads/mysql/) (для хранения аккаунтов) (в случае с [XAMPP](https://bit.ly/2TgobyD) идёт в комплекте)

# Установка

1. Первым делом необходимо перенести папку `daisy` из репозитория в папку `applications` в корне Adobe Media Server.
2. Заливаем флешки на вебсервер в папку `fs` или используем [минимальное флеш хранилище](https://github.com/123jjck/ddplusplus/tree/master/misc/minfs)
3. Копируем файлы из всех папок репозитория (кроме папок `daisy`, `misc` и файла `dump.sql`) и вставляем их в корень вашего сайта (для XAMPP это `htdocs`)
4. В PhpMyAdmin создаём базу данных под названием `daisy` с кодировкой `utf8_general_ci` и импортируем туда `dump.sql`
5. Запускаем Adobe Media Server и Adobe Media Administration Server
6. Теперь вы можете зайти на `localhost` и наслаждаться игрой

# Дополнительные шаги для запуска сервера на VDS/VPS
7. Если на вашей базе данных стоит пароль, либо она расположена на удалённом сервере - меняем данные от базы данных в файле `db_connection.php`
* Если сайт и сервер располагаются на одной машине, крайне рекомендуется ограничить доступ к api файлам для посторонних людей:
1. Создайте отдельную папку для этих файлов 
2. Отредактируйте переменную `msHost` в файле `main.asc`
3. Создайте файл `.htaccess` в папке со следующим содержанием:
```
<RequireAll>
    Require local
</RequireAll>
```
# Лицензия

Делайте что хотите, но на ваш страх и риск.
