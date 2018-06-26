$(window).on("load",function(){
    var vladimirMap = $("#vladimir_map")[0];
    var svgVladimir = vladimirMap.contentDocument;
    var objVladimir = ["#path4482","#path4502","#path4476","#path4496","#path4468","#path4498","#path4472","#path4474","#polyline4109","#path4466","#path4470","#path4486","#path4488","#path4490","#path4500","#path4478","#path4484","#path4494","#path4492","#path4480","#path4504"]
    var state;
    objVladimir.forEach(element => {
        $(element,svgVladimir).css("fill","#a1e736");
        $(element,svgVladimir).css("stroke","#71a12a");
        $(element,svgVladimir).css("transition","0.2s");
        $(element,svgVladimir).click(function(){
            window.location = "http://ontour.kvantorium33.ru/yandex_map.php"
        });
    $(element,svgVladimir).hover(function(){
        $(element,svgVladimir).css("opacity","0.7");     
        });
    $(element,svgVladimir).mouseout(function(){
        $(element,svgVladimir).css("opacity","1");   
        });
    });
    $("[data-tooltip]",svgVladimir).mousemove(function (eventObject) {

        $data_tooltip_central = $(this).attr("data-tooltip");
        
        $("#tooltip").text($data_tooltip_central)
                     .css({ 
                         "top" : eventObject.pageY + 35,
                        "left" : eventObject.pageX,
                        
                     })
                     .show();
                    
    }).mouseout(function () {

        $("#tooltip").hide()
                     .text("")
                     .css({
                         "top" : 0,
                        "left" : 0
                     });
    });
   
    $("#path4498",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Vladimir";
    });
    $("#path4476",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Sydogda";
    });
    $("#path4488",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Kameskovo";
    });
    $("#path4486",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Syzdal";
    });
    $("#path4490",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Kovrov";
    });
    $("#path4500",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Kovrov";
    });
    $("#path4496",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Radyznyi";
    });
    $("#path4468",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Sobinka";
    });
    $("#path4480",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Selevanovo";
    });
    $("#path4478",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Myrom";
    });
    $("#path4504",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Myrom";
    });

    $("#path4492",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Gorohovec";
    });
    $("#path4494",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Vazniki";
    });
    $("#path4482",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Gys-Xrystalnyi";
    });
    $("#path4502",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Gys-Xrystalnyi";
    });
    $("#path4484",svgVladimir).click(function(){
        window.location = "http://ontour.kvantorium33.ru/yandex_map.php?data=Melenki";
    });
});