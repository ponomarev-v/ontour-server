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
                    center: [56.1365500, 40.3965800],
                    zoom: 10
                }, {
                    searchControlProvider: 'yandex#search'
                });

            // Слушаем клик на карте.
            myMap.events.add('click', function (e) {
                var coords = e.get('coords');

                // Если метка уже создана – просто передвигаем ее.
                if (myPlacemark) {
                    myPlacemark.geometry.setCoordinates(coords);
                }
                // Если нет – создаем.
                else {
                    myPlacemark = createPlacemark(coords);
                    myMap.geoObjects.add(myPlacemark);
                    // Слушаем событие окончания перетаскивания на метке.
                    myPlacemark.events.add('dragend', function () {
                        getAddress(myPlacemark.geometry.getCoordinates());
                    });
                }
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
                <li><a href=#>Личный кабинет</a>
                    <ul class="submenu">
                        <li><a href=#>Настройки</a></li>
                        <li><a href=#>О приложении</a></li>
                    </ul>
                </li>
                <li><a href=#>Цели</a>
                    <ul class="submenu">
                        <li><a href=#>Обмен баллами</a></li>
                        <li><a href=#>История</a></li>
                    </ul>
                </li>
                <li><a href=#>Места</a>
                    <ul class="submenu">
                        <li><a href=#>Комментарии</a></li>
                        <li><a href=#>Фото</a></li>
                        <li><a href=#>Истории</a></li>
                    </ul>
                </li>
                <li><a href=#>Таблица лидеров</a>
                </li>
                <li><a href=#>Баланс</a>
                </li>
                <li><a href=#>Квесты</a>
                </li>
                <li><a href=# id="myBtn">Вход</a>
                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <div id="form" align="center">
                                <h1>
                                    Вход ON TOUR
                                </h1>
                                <form>
                                    <h3>
                                        Имя
                                    </h3>
                                    <input type="text" name="name">
                                    <h3>
                                        Пароль
                                    </h3>
                                    <input type="password" name="pas">
                                    <h3>
                                    </h3>
                                    <input type="submit">
                                </form>
                                <h3>
                                    Если у вас нет аккаунта, Вы можете
                                </h3>
                                <button id="myBtn">зарегестрироваться</button>
                                <div id="myModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <p>Some text in the Modal..</p>
                                    </div>
                                </div>
                                <script>
                                    var modal = document.getElementById('myModal');
                                    var btn = document.getElementById("myBtn");
                                    var span = document.getElementsByClassName("close")[0];
                                    btn.onclick = function () {
                                        modal.style.display = "block";
                                    }
                                    span.onclick = function () {
                                        modal.style.display = "none";
                                    }
                                    window.onclick = function (event) {
                                        if (event.target == modal) {
                                            modal.style.display = "none";
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <script>
                        var modal = document.getElementById('myModal');
                        var btn = document.getElementById("myBtn");
                        var span = document.getElementsByClassName("close")[0];
                        btn.onclick = function () {
                            modal.style.display = "block";
                        }
                        span.onclick = function () {
                            modal.style.display = "none";
                        }
                        window.onclick = function (event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    </script>

                </li>
            </ul>
        </div>
    </div>
</div>
</body>

</html>