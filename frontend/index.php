<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Быстрый старт. Размещение интерактивной карты на странице</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>
    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            var myPlacemark,
                myMap = new ymaps.Map('map', {
                    center: [55.753994, 37.622093],
                    zoom: 9
                }, {
                    searchControlProvider: 'yandex#search'
                });

            // Слушаем клик на карте.
            myMap.events.add('click', function (e) {
                var coords = e.get('coords');
                
                myPlacemark = createPlacemark(coords);
                myMap.geoObjects.add(myPlacemark);
                // Слушаем событие окончания перетаскивания на метке.
                myPlacemark.events.add('dragend', function () {
                    getAddress(myPlacemark.geometry.getCoordinates());
                });

                getAddress(coords);
            });

            // Создание метки.
            function createPlacemark(coords) {
                return new ymaps.Placemark(coords, {
                    iconCaption: 'поиск...'
                }, {
                    preset: 'islands#violetDotIconWithCaption',
                    draggable: true
                });
            }

            // Определяем адрес по координатам (обратное геокодирование).
            function getAddress(coords) {
                myPlacemark.properties.set('iconCaption', 'поиск...');
                ymaps.geocode(coords).then(function (res) {
                    var firstGeoObject = res.geoObjects.get(0);

                    myPlacemark.properties
                        .set({
                            // Формируем строку с данными об объекте.
                            iconCaption: [
                                // Название населенного пункта или вышестоящее административно-территориальное образование.
                                firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                                // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                                firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                            ].filter(Boolean).join(', '),
                            // В качестве контента балуна задаем строку с адресом объекта.
                            balloonContent: "" +
                            "<div align='center'>" +
                            "   <p>" +
                            firstGeoObject.getAddressLine() +
                            "   </p>" +
                            "   <form>" +
                            "       <input type='text' name='name' value='название метки'><br>" +
                            "       <input type='text' name='dis' value='описание'><br>" +
                            "       <input type='submit' value='добавить метку'>" +
                            "   </form>" +
                            "</div>"
                        });
                });
            }
        }

    </script>
</head>

<body>
<div id="body">
    <div id="map"></div>
    <div id="header">
        <div id="logo">
            <img src="https://cdn.discordapp.com/attachments/454304599755587584/454640730229571605/ontour2.png"
                 height=100%>
        </div>
        <div id="menu">
            <ul class="menu">
                <li><a href=#>Menu 1</a>
                    <ul class="submenu">
                        <li><a href=#>Sudmenu 1</a></li>
                        <li><a href=#>Sudmenu 1</a></li>
                        <li><a href=#>Sudmenu 1</a></li>
                    </ul>
                </li>
                <li><a href=#>Menu 2</a>
                    <ul class="submenu">
                        <li><a href=#>Sudmenu 2</a></li>
                        <li><a href=#>Sudmenu 2</a></li>
                        <li><a href=#>Sudmenu 2</a></li>
                    </ul>
                </li>
                <li><a href=#>Menu 3</a>
                    <ul class="submenu">
                        <li><a href=#>Sudmenu 3</a></li>
                        <li><a href=#>Sudmenu 3</a></li>
                        <li><a href=#>Sudmenu 3</a></li>
                    </ul>
                </li>
                <li><a href=#>Menu 4</a>
                    <ul class="submenu">
                        <li><a href=#>Sudmenu 4</a></li>
                        <li><a href=#>Sudmenu 4</a></li>
                        <li><a href=#>Sudmenu 4</a></li>
                    </ul>
                </li>
                <li><a href=#>Menu 5</a>
                    <ul class="submenu">
                        <li><a href=#>Sudmenu 5</a></li>
                        <li><a href=#>Sudmenu 5</a></li>
                        <li><a href=#>Sudmenu 5</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
</body>

</html>