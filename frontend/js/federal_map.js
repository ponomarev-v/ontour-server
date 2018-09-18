$(window).on("load",function(){
    var Federal_Map = Object.create(Map);
    Federal_Map.map = $("#federal_map")[0];
    Federal_Map.content = Federal_Map.map.contentDocument;
    Federal_Map.objects = ["#Central","#Volga","#Urals","#Siberia",
    "#Far_Eastern","#Northwestern","#KC","#KL","#path4765"]
    Federal_Map.objects.forEach(element => {
        $(element,Federal_Map.content).css("transition","0.2s");

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
	// $("#Far_Eastern",Federal_Map.content).css("fill","#f1ce82");
	 // $("#Far_Eastern",Federal_Map.content).css("stroke","#f1ce82");
	 //$("#Siberia",Federal_Map.content).css("fill","#c2cdd3");
	// $("#Siberia",Federal_Map.content).css("stroke","#c2cdd3");
	 //$("#Urals",Federal_Map.content).css("fill","#8ecdef");
	  //$("#Urals",Federal_Map.content).css("stroke","#8ecdef");
	// $("#Northwestern",Federal_Map.content).css("fill","#9eb8f9");
	  //$("#Northwestern",Federal_Map.content).css("stroke","#9eb8f9");
	 //$("#Volga",Federal_Map.content).css("fill","#fbe230");
	// $("#Volga",Federal_Map.content).css("stroke","#fbe230");
	 //$("#Central",Federal_Map.content).css("fill","#a1e736");
	 ///$("#Central",Federal_Map.content).css("stroke","#a1e736");
	// $("#KL",Federal_Map.content).css("fill","#eea268");
	// $("#KL",Federal_Map.content).css("stroke","#eea268");
	// $("#KC",Federal_Map.content).css("fill","#d27387");
    // $("#KC",Federal_Map.content).css("stroke","#d27387");
     
     $("#Central",Federal_Map.content).click(function(){
        window.location = "/CFD_map.php"
     });
     $("#federal_map").css("visibility","visible")
});