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
    case 'Sobinka':
    x = 55.993837;
    y = 40.017943;
    break;

    case 'Selevanovo':
    x = 56.151973;
    y = 38.854247;
    break;

    case 'Myrom':
    x = 55.579169;
    y = 42.052411;
    break;

    case 'Gorohovec':
    x = 56.201695;
    y = 42.691194;
    break;

    default:
    x = 55.755814;
    y = 37.617635;
    break;
}




function init() {
    myMap = new ymaps.Map("map", {
        center: [x, y],
        zoom: 12
    });

    myPlacemark = new ymaps.Placemark([x, y], {
        hintContent: 'Москва!',
        balloonContent: 'Столица России'
    });

    myMap.geoObjects.add(myPlacemark);
}
