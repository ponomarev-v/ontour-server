$(window).on("load",function(){
    var Federal_Map = Object.create(Map);
    Federal_Map.map = $("#federal_map")[0];
    Federal_Map.content = Federal_Map.map.contentDocument;
    $("#federal_map").find("path").each(function(i){
        alert(i.target.id);
    })
    Federal_Map.objects = ["#Central","#Volga","#Urals","#Siberia",
    "#Far_Eastern","#Northwestern","#KC","#KL"]
    Federal_Map.objects.forEach(element => {    

        $(element,Federal_Map.content).hover(function(){
            $(element,Federal_Map.content).css("opacity","0.7");     
             
        });
        $(element,Federal_Map.content).mouseout(function(){
           $(element,Federal_Map.content).css("opacity","1");
            
        });
    });

    $("[data-tooltip]",Federal_Map.content).mousemove(function (eventObject) {

        $data_tooltip = $(this).attr("data-tooltip");
        
        $("#tooltip").text($data_tooltip)
                     .css({ 
                         "top" : eventObject.pageY + 55,
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
	
     $("#Central",Federal_Map.content).click(function(){
        window.location = "/CFD_map.php"
     });
     $("#federal_map").css("visibility","visible")
});