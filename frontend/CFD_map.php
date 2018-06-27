<?php
include_once "header.php";
?>
<div id="tooltip"></div>
<div class="center">
    <!--я бы эту карту сделал бы height:calc(100% - 100px), но тогда видна только левая верхняя часть SVG...-->
    <object type="image/svg+xml" data="images/CFD_map.svg" id="central_map">
    <p>Ваш браузер не поддерживает svg</p>
    </object>
    </div>
    <div class="container wrapper" style="margin-top:-140px;">
    <div class="row">
        <div class="col-md-3 block">
            <p class="num_obj">0</p>
            <p class="info">Объектов</p>
        </div>
        <div class="col-md-3 block">
            <p class="num_photo">0</p>
            <p class="info">Заданий</p>
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
    <script src="js/central_map.js"></script> 
    <?php
include_once "footer.php";
?>