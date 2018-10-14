ymaps.ready(init);
var myMap,  myPlacemark, objectManager;

function init () {
    pt = getUrlParameter('pt');
    x = 55.753215;
    y = 37.622504;
    if(pt) {
        pt = pt.split(',');
        if(pt.length == 2) {
            x = pt[0];
            y = pt[1];
        }
    }
    var myMap = new ymaps.Map('map', {
            center: [x, y],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        }),
        objectManager = new ymaps.ObjectManager({
            // Чтобы метки начали кластеризоваться, выставляем опцию.
            clusterize: true,
            // ObjectManager принимает те же опции, что и кластеризатор.
            gridSize: 32,
            clusterDisableClickZoom: true
        });

    
    myMap.geoObjects.add(objectManager);
    var json_res_start;
    $.ajax({
            type:"POST",
            url:"http://api.turneon.ru/?method=map.GetObjs",
            xhrFields: {withCredentials: true},
            success: function (data) {
                data = eval("(" + data + ")");
                if (data.result == "success") {
                    json_string = JSON.stringify(data);
                    objects = JSON.parse(json_string)
                    delete objects.result
                    json_res_start = '{"type": "FeatureCollection","features": ['
                    json_res_end = "]}"
                    
                   // alert(json_res)
                    for(key in objects){
                        
                        cx = objects[key]['cx']
                        cy = objects[key]['cy']
                        id = objects[key]['id']
                        balloonHeader = objects[key]['name']
                        balloonContent = objects[key]['description']
                        obj = {"type":"Future","id":id,"geometry":{"type":"Point","coordinates":[cx,cy]},"properties":{"balloonContentHeader": balloonHeader, "balloonContentBody": balloonContent}}
                        json_res_start +=JSON.stringify(obj)+","
                        //alert(JSON.stringify(obj))
                    }
                    
                    json_res_start = json_res_start.substring(0, json_res_start.length - 1)+json_res_end
                    json = JSON.parse(json_res_start)
                    objectManager.add(json)
                }
            }
        });

        function onObjectEvent (e) {
            var objectId = e.get('objectId');
            if (e.get('type') == 'mouseenter') {
                // Метод setObjectOptions позволяет задавать опции объекта "на лету".
                objectManager.objects.setObjectOptions(objectId, {
                    preset: 'islands#yellowIcon'
                });
            } else {
                objectManager.objects.setObjectOptions(objectId, {
                    preset: 'islands#blueIcon'
                });
            }
        }
    
        function onClusterEvent (e) {
            var objectId = e.get('objectId');
            if (e.get('type') == 'mouseenter') {
                objectManager.clusters.setClusterOptions(objectId, {
                    preset: 'islands#yellowClusterIcons'
                });
            } else {
                objectManager.clusters.setClusterOptions(objectId, {
                    preset: 'islands#blueClusterIcons'
                });
            }
        }
        objectManager.objects.events.add(['mouseenter', 'mouseleave'], onObjectEvent);
    objectManager.clusters.events.add(['mouseenter', 'mouseleave'], onClusterEvent);
    window.manager = objectManager

    myMap.events.add('click', function (e) {
        var coords = e.get('coords');
    

        if (myPlacemark) {
            myMap.geoObjects.remove(myPlacemark);
            myPlacemark = 0;
        }
        else {
            myPlacemark = createPlacemark(coords);
            myMap.geoObjects.add(myPlacemark);
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
           
            draggable: true
        });
    }
    function getAddress(coords) {
        myPlacemark.properties.set('iconCaption', 'поиск...');
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);
            window.firstGeoObject = firstGeoObject;
           myPlacemark.properties
                .set({
                   iconCaption: [
                        
                     firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                        
                        firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                    ].filter(Boolean).join(', '),
                   
                    balloonContent: "<script>function btn_subbmit(){alert('Hi')}</script>" +
                    "<div align='center'>" +
                    "   <h3>" + firstGeoObject.getAddressLine() + "</h3>" +
                    "   <form id='form_addobj'>" +
                    "       Название<br>" +
                    "       <input type='text' name='name' id='name'><br>" +
                    "       Описание<br>" +
                    "       <textarea name='description' id='description'></textarea><br>" +
                    "       <input type='button' id='btn' value='Отправить'  onClick='btn_subbmit()'>" +
                    "   </form>" +
                    "</div>",
                });
                window.coords = coords
        });
       
    }

}
