<?php
require_once "header.php";
?>
    <div id="map"></div>
    <div class="form_add" style="display:none;">
    <form action>
        <input type="text" id="name" placeholder="Название">
        <br>
        <input type="text" id="description" placeholder="Описание">
        <br>
        <input type="button" value="Submit" id="btn_add">
    </form>
    </div>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
    <script src="js/map.js"></script>
    <script src="js/add_obj.js"></script>
<?php
include "footer.php";
?>