<h1 align="center">Тестовое задание dZENcode</h1>

<h3>SPA-приложение: Комментарии.</h3>

<p>Развернутое приложение - <a href="https://dzencode.romance.in.ua" target="_blank">https://dzencode.romance.in.ua</a></p>

<p>Репозиторий - <a href="https://github.com/DmytroTiulpa/dzencode.git" target="_blank">https://github.com/DmytroTiulpa/dzencode.git</a></p>

<p>Для локальной установки приложения необходимо:</p>
<ul>
	<li>Скачать приложение с репозитория</li>
	<li>Создать локальную базу данных</li>
	<li>Переименовать <span style="color: lightgreen;">.env.example</span> в <span style="color: lightgreen;">.env</span></li>
	<li>В файле <span style="color: lightgreen;">.env</span> указать настройки к созданной базе данных (название БД, логин и пароль для подключения)</li>
	<li>Обновить все зависимости при помощи команды <span style="color: lightgreen;">npm install</span></li>
	<li>Выполнить миграцию при помощи команды <span style="color: lightgreen;">php artisan migrate</span></li>
	<li>Заполнить таблицу комментариев тестовыми данными командой <span style="color: lightgreen;">php artisan db:seed</span></li>
</ul>