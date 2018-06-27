<?php
include_once "header.php";
?>
<div id="tooltip"></div>
    <object type="image/svg+xml" data="images/Vladimir_map.svg" id="vladimir_map">
    <p>Ваш браузер не поддерживает svg</p>
    </object>
    <div class="container wrapper" style="margin-top:-140px;">
    <div class="row">
        <div class="col-md-3 block">
            <p class="num_obj">0</p>
            <p class="info">Объектов</p>
        </div>
        <div class="col-md-3 block">
            <p class="num_photo">0</p>
            <p class="info">Фотографий</p>
        </div>
        <div class="col-md-3 block">
            <p class="num_events">0</p>
            <p class="info">Событие</p>
        </div>
        
    </div>
    <div class="row">
    <button class="button_info">Подробнее</button>
    </div>
</div>
    <script src="js/count_obj.js"></script>
    <script src="js/vladimir_map.js"></script> 
    <?php
include_once "footer.php";
?>