<?php include "header.php" ?>
<div id="tooltip"></div>
<div align="center">
    <object type="image/svg+xml" data="images/district_map.svg" id="federal_map" width="70%">
        <p>Ваш браузер не поддерживает svg</p>
    </object>
</div>
<div class="container wrapper">
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

<script src="js/detect_coords.js"></script>
<script src="js/federal_map.js"></script>
<?php include "footer.php" ?>