<div class="menu"><!--меню сверху страницы-->
    <ul class="menu_down">
        <li id="menu_main"          class="button"><a href="#"                class="window_btn" window-id="window_main">Главная</a></li>
        <li id="menu_app"           class="button"><a href="#"                class="window_btn" window-id="window_app">Приложение</a></li>
        <li id="menu_select_region" class="button"><a href="district_map.php" class="window_btn" window-id="window_select_region">Выбор региона</a></li>
        <li id="menu_show_map"      class="button"><a href="yandex_map.php"   class="window_btn" window-id="window_show_map">Просмотр карты</a></li>


        <li id="menu_login" class="button hidden"><a href="#" class="window_btn" window-id="window_login">Вход</a></li>
        <li id="menu_profile" class="button hidden"><a href="#" class="window_btn" window-id="window_profile">Профиль</a>
            <ul class="submenu">
                <li class="button"><a href="#" class="window_btn" window-id="window_profile">Личный кабинет</a></li>
                <li class="button"><a href="#" class="window_btn" window-id="window_settings">Настройки</a></li>
                <li class="button"><a href="#" class="window_btn" window-id="window_logout">Выйти</a></li>
            </ul>
        </li>
    </ul>
</div>
<?php include "user.php";//подключение всплывающего окна выхода

