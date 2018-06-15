<div id="menu"><!--меню сверху страницы-->
    <ul class="menu">
        <li id="menu_register"><a href=# class="btn_register">Регистрация</a></li>
        <li id="menu_login"><a href=# id="btn_login">Вход</a></li>
        <li id="menu_profile" style="display: none"><a href=# id="btn_profile">Личный кабинет</a></li>
        <li id="menu_logout" style="display: none"><a href=# id="btn_logout">Выход</a></li><br>
        <li id="menu_main" style="display: none"><a href=#>Меню после входа</a></li>
    </ul>
</div>
<?php
include "login.php";//подключение всплывающего окна логина
include "register.php";//подключение всплывающего окна регистрации
include "profile.php";//подключение всплывающего окна регистрации
include "logout.php";//подключение всплывающего окна выхода