$(window).on("load",function(){
    var Central_Map = Object.create(Map);

    Central_Map.map = $("#central_map")[0];
    Central_Map.content = Central_Map.map.contentDocument;
    Central_Map.objects = ["#Vladimir","#Bransk","#Smolensk","#Ivanovo","#Kostroma",
                           "#Tver","#Yroslavl","#Kalyga","#Kyrsk","#Lipeck","#Moskva",
                           "#Moskva_obl","#Orlov","#Tyla","#Belgorod","#Razan","#Tambov","#Voronez",
                           "#path42"];
    
    Central_Map.objects.forEach(element => {
        $(element,Central_Map.content).css("fill","#a1e736");
        $(element,Central_Map.content).css("stroke","#71a12a");
        $(element,Central_Map.content).css("transition","0.2s");
       
        $(element,Central_Map.content).hover(function(){
            $(element,Central_Map.content).css("opacity","0.7");     
            });
        $(element,Central_Map.content).mouseout(function(){
            $(element,Central_Map.content).css("opacity","1");   
        });
    });
    $("[data-tooltip]",Central_Map.content).mousemove(function (eventObject) {

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

    $("#path96",Central_Map.content).click(function(){
        window.location = "/Vladimir_map.php"
    });

    $("#central_map").css("visibility","visible")
});