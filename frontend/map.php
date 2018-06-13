<div id="map"></div><!--карта-->
<script type="text/javascript">//скрипт для карты (не смог в отдельный js кинуть)
    ymaps.ready(init);
    var myMap
    function init(){
        myMap = new ymaps.Map("map", {
            center: [56.1365500, 40.3965800],
            zoom: 11
        });
    }
</script>