<?php
include "header.php";
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
    <script src="js/yandex_map.js"></script>
    <script src="js/add_obj.js"></script>
<?php
include "footer.php";
?>