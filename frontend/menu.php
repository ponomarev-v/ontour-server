<div class="menu_header"><!--меню сверху страницы-->
    <ul class="menu">
        <li id="menu_app" class="button"><a href="/app.php">Приложение</a></li>
        <li id="menu_region" class="button"><a href="/region.php">Выбор региона</a></li>
        <li id="menu_map" class="button"><a href="/map.php">Карта</a></li>
        <li id="menu_login" class="button hidden"><a href="#" class="window_btn" window-id="window_login">Вход</a></li>
        <li id="menu_profile" class="button hidden"><a href="#" class="window_btn" window-id="window_profile">Профиль</a>
            <ul class="submenu">
                <li class="button"><a href="#" class="window_btn" window-id="window_settings">Личный кабинет</a></li>
                <li class="button"><a href="#" class="window_btn" window-id="window_logout">Выйти</a></li>
            </ul>
        </li>
    </ul>
</div>
<?php include "user.php";