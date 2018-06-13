<div id="menu"><!--меню сверху страницы-->
    <ul class="menu">
        <li><a href=#>Личный кабинет</a>
            <ul class="submenu">
                <li><a href=#>Настройки</a></li>
                <li><a href=#>О приложении</a></li>
            </ul>
        </li>
        <li><a href=#>Цели</a>
            <ul class="submenu">
                <li><a href=#>Обмен баллами</a></li>
                <li><a href=#>История</a></li>
            </ul>
        </li>
        <li><a href=#>Места</a>
            <ul class="submenu">
                <li><a href=#>Комментарии</a></li>
                <li><a href=#>Фото</a></li>
                <li><a href=#>Истории</a></li>
            </ul>
        </li>
        <li><a href=#>Таблица лидеров</a></li>
        <li><a href=#>Баланс</a></li>
        <li><a href=#>Квесты</a></li>
        <li id="menu_login"><a href=# id="btn_login">Вход</a></li>
        <li id="menu_logout" style="display: none;"><a href=# id="btn_profile">Профиль</a>
            <ul class="submenu">
                <li><a href=#>1</a></li>
                <li><a href=#>2</a></li>
                <li><a href=# id="btn_logout">Выход</a></li>
            </ul>
        </li>
    </ul>
</div>
<?php
include "login.php";//подключение всплывающего окна логина
include "register.php";//подключение всплывающего окна регистрации