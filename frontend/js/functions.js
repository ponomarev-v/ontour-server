// function showAllObj(){
//     $.ajax({
//         type:"POST",
//         url:"http://api.turneon.ru/?method=map.GetObjs",
//         xhrFields: {withCredentials: true},
//         success: function (data) {
//             data = eval("(" + data + ")");
//             if (data.result == "success") {
//                 json_string = JSON.stringify(data);
//                 objects = JSON.parse(json_string)
//                 delete objects.result
//                 for(key in objects){
                    
//                     var myPlacemark = new ymaps.Placemark([objects[key]['cx'], objects[key]['cy']], {
//                         hintContent: 'Содержимое всплывающей подсказки',
//                         balloonContent: objects[key]['name'] + "<br>"+objects[key]['description']
//                     });
//                     myMap.geoObjects.add(myPlacemark);
//                 }
//             }
//         }
//     });
// }