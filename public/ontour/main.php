<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Карта</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>
    <script type="text/javascript">
        ymaps.ready(init);
        var myMap;
        <?php
        $x = random_int(-100, 100);
        $y = random_int(-100, 100);
        ?>
        function init() {
            myMap = new ymaps.Map("map", {
                center: [<?php echo $x; ?>, <?php echo $y; ?>],
                zoom: 2
            });
            myMap.geoObjects.add(new ymaps.Placemark([<?php echo $x; ?>, <?php echo $y; ?>], {
                hintContent: 'рандомная точка',
                balloonContent: 'перезагрузи страницу - убедишься'
            }));
        }
    </script>
</head>

<body>
<div id="map" style="width: 100%; height: 100%"></div>
</body>

</html>