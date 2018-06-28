function func(){
str =    '<form action>'+
'<input type="text" id="name" placeholder="Название">'+
'<br>'+
'<input type="text" id="description" placeholder="Описание">'+
'<br>'+
'<input type="button" value="Submit" id="btn_add">'+
'</form>'

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
                                "   <h3>" + firstGeoObject.getAddressLine() + "</h3>" +
                                "   <form method='post' id='form_addobj'>" +
                                "       Название<br>" +
                                "       <input type='text' name='name'><br>" +
                                "       Описание<br>" +
                                "       <textarea name='dis'></textarea><br>" +
                                "       <input type='submit' id='btn'>" +
                                "   </form>" +
                                "</div>",
                            });
                            
                    });
                }
}