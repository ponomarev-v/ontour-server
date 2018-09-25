<?php
include "header.php";
?>
<div id="tooltip"></div>
<div class="content">
    <h3 class="map_header">
        Россия
    </h3>
    <object type="image/svg+xml" data="images/district_map2.svg" id="federal_map" width="70%">
        <p>Ваш браузер не поддерживает svg</p>
    </object>
</div>
<script>
    $(window).on("load",function(){
        $("#federal_map").css("visibility","visible")
    });
</script>
<?php
include "footer.php";