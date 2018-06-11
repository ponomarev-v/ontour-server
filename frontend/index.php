<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Быстрый старт. Размещение интерактивной карты на странице</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>
    <script type="text/javascript">
        ymaps.ready(init);
        var myMap,
            myPlacemark;

        function init(){
            myMap = new ymaps.Map("map", {
                center: [55.76, 37.64],
                zoom: 7
            });

            myPlacemark = new ymaps.Placemark([55.76, 37.64], {
                hintContent: 'Москва!',
                balloonContent: 'Столица России'
            });

            myMap.geoObjects.add(myPlacemark);
            myMap.controls.remove('fullscreenControl');
            myMap.controls.add('SearchControl', {
                float: 'left',
                // «Панель маршрута» будет первой слева.
                floatIndex: '400'
            });

        }
    </script>
    <style>
        body {
            margin: 0;
        }
        #map {
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: 0;
        }
        #header {
            width: 100%;
            height: 100px;
            position: absolute;
            z-index: 1;
            opacity: 0.5;
        }
    </style>
</head>

<body>
<div id="map"></div>
<div id="header"><h1>fv,jdfnvjkndfjv</h1></div>
</body>

</html>s