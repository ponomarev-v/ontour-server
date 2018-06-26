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

if(param['data'] == 'Vladimir'){
    x = 56.129042;
    y = 40.407030;
} else {
    x = 55.755814;
    y = 37.617635;
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
