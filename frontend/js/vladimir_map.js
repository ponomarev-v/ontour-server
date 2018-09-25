$(window).on("load",function(){
    var vladimirMap = $("#vladimir_map")[0];
    var svgVladimir = vladimirMap.contentDocument;
    var objVladimir = ["#Sobinka","#Gys-Xrystalnyi","#Selevanovo","#Myrom_obl","#Kovrov_obl","#Kameskovo","#Sydogda","#Myrom","#Gys-Xrystalnyi","#Kovrov","#Vladimir","#Radyznyi","#Vazniki","#Gorohovec","#Syzdal","#Melenki","#Kolcygino","#Petyshki","#Yuriev-Polskiy","#Aleksandrov","#Kirzach"]
    var state;
    objVladimir.forEach(element => {
        $(element,svgVladimir).css("fill","#a1e736");
        $(element,svgVladimir).css("stroke","#71a12a");
        $(element,svgVladimir).css("transition","0.2s");
        var data = $(element,svgVladimir).attr("data");
        $(element,svgVladimir).click(function(){
            window.location = "/yandex_map.php?data="+data
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
    
    $("#vladimir_map").css("visibility","visible")
});