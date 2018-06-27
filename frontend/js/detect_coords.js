$(document).ready(function(){
    function displayError(error) {
        var errors = {
          1: 'Нет прав доступа к геоданным',
          2: 'Местоположение невозможно определить',
          3: 'Таймаут соединения'
        };

        if(window.location == "http://localhost/"){//only for debug
          if(window.location != "http://localhost/district_map.php" && errors[error.code] == "Нет прав доступа к геоданным" ){
            window.location = "http://localhost/district_map.php"
          }
        } else{

        if(window.location != "http://ontour.kvantorium33.ru/district_map.php" && errors[error.code] == "Нет прав доступа к геоданным" ){
            window.location = "http://ontour.kvantorium33.ru/district_map.php"
        }
      }
        
        //alert("Ошибка: " + errors[error.code]);
      }
      var country,city,state;
      function displayPosition(position) {
        var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + position.coords.latitude + '%2C' + position.coords.longitude + '&language=ru';
        $.getJSON(GEOCODING).done(function(location) {
      
           
          for (var i = 0; i < location.results[0].address_components.length; i++) {
             switch(location.results[0].address_components[i].types[0]) {
               case 'locality':
                 
                 city = location.results[0].address_components[i].long_name;
                 window.city = city;
                 break;
               case 'administrative_area_level_1':
                 state = location.results[0].address_components[i].long_name;
                 window.state = state;
                 break;
               case 'country':
                 country = location.results[0].address_components[i].long_name;
                 window.country = country;
                 break;
             }
          } 
          
          if(window.country == "Россия" & window.state == "Владимирская область"){
           window.location = "/Vladimir_map.php"
        }
        })
        
      }
     
   
        if (navigator.geolocation) {
            var timeoutVal = 10 * 1000 * 1000;
            navigator.geolocation.getCurrentPosition(
              displayPosition,
              displayError, {
                enableHighAccuracy: true,
                timeout: timeoutVal,
                maximumAge: 0
              }
            );
          } else {
            alert("Geolocation не поддерживается данным браузером");
          }
     
      
});