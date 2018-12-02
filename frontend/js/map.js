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
        })

        var remoteObjectManager = new ymaps.RemoteObjectManager('http://api.turneon.ru/?method=map.ScreenObj&bbox=%b',
        {   
          paddingTemplate: 'myCallback_%b',
          clusterHasBalloon: true,
        // Опции объектов задаются с префиксом geoObject.
        geoObjectOpenBalloonOnClick: true
        });

    myMap.geoObjects.add(remoteObjectManager);

function onAddCluster (e) {
    // Выведем количество кластеров в коллекции. 
    console.log(remoteObjectManager.clusters.getLength()); // --> 1, 2, 3..
}
remoteObjectManager.clusters.events.add(['add'], onAddCluster);
}
