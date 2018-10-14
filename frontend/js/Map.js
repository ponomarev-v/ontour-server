ymaps.ready(init);
var myMap,  myPlacemark;
var get = location.search;
var x,y;
var tmp = new Array();
var tmp2 = new Array();
var param = new Array();
if(get != ''){
    tmp = get.substr(1).split('&');
    for(var i = 0;i < tmp.length;i++){
        tmp2 = tmp[i].split('=');
        param[tmp2[0]] = tmp2[1];
    }
}

var town = param['data'];

switch(town){
    case 'Vladimir':
    x = 56.129042;
    y = 40.407030;
    break;

    case 'Sydogda':
    x = 55.949879;
    y = 40.856295;
    break;

    case 'Kameskovo':
    x = 56.348916;
    y = 40.995588;
    break;

    case 'Syzdal':
    x = 56.419836;
    y = 40.449457;
    break;

    case 'Kovrov':
    x = 56.363628;
    y = 41.311220;
    break;

    case 'Radyznyi':
    x = 55.996052;
    y = 40.332281;
    break;
    case 'Sobinka':
    x = 55.993837;
    y = 40.017943;
    break;

    case 'Selevanovo':
    x = 55.870031;
    y = 41.772074;
    break;

    case 'Myrom':
    x = 55.579169;
    y = 42.052411;
    break;

    case 'Gorohovec':
    x = 56.201695;
    y = 42.691194;
    break;

    case 'Vazniki':
    x = 56.247021;
    y = 42.158862;
    break;

    case 'Gys-Xrystalnyi':
    x = 55.619818;
    y = 40.657902;
    break;

    case 'Melenki':
    x = 55.338715;
    y = 41.634030;
    break;

    case 'Yuriev-Polskiy':
    x = 56.499250;
    y = 39.680814;
    break;

    case 'Kolcygino':
    x = 56.293901;
    y = 39.376042;
    break;

    case 'Petyshki':
    x = 55.930967;
    y = 39.459900;
    break;

    case 'Kirzach':
    x = 56.161694;
    y = 38.872025;
    break;

    case 'Aleksandrov':
    x = 56.397774;
    y = 38.727621;
    break;

    default:
    x = 55.755814;
    y = 37.617635;
    break;
}



var myPlacemark,objectManager;

function init () {
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
