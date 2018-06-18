<?php
include_once "header.php";
?>
<div id="tooltip"></div>
    <!--я бы эту карту сделал бы height:calc(100% - 100px), но тогда видна только левая верхняя часть SVG...-->
    <object type="image/svg+xml" data="images/CFD_map2.svg" id="central_map">
    <p>Ваш браузер не поддерживает svg</p>
    </object>
    <script src="js/central_map.js"></script> 
    <?php
include_once "footer.php";
?>