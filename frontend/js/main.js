$(window).on("load",function(){
    
    var a = $("#map")[0];
    var svgDoc = a.contentDocument;
    var obj = ["#Central","#Volga","#Urals","#Siberia","#Far_Eastern","#Northwestern","#KC","#KL","#path4765"]
    $("#Far_Eastern",svgDoc).css("fill","#1076C8");
    
    obj.forEach(element => {
        var regionColor = $(element,svgDoc).css("fill","#f1ce82");
        var borderColor = $(element,svgDoc).css("stroke","#fff");
       


        $(element,svgDoc).mousemove(function(){
            var regionColor = $(element,svgDoc).css("opacity","0.7");     
             
        });
        $(element,svgDoc).mouseout(function(){
            var regionColor = $(element,svgDoc).css("opacity","1");
            
        });
    });
    $("[data-tooltip]",svgDoc).mousemove(function (eventObject) {

        $data_tooltip = $(this).attr("data-tooltip");
        
        $("#tooltip").text($data_tooltip)
                     .css({ 
                         "top" : eventObject.pageY,
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
    $("#Far_Eastern",svgDoc).css("fill","#f1ce82");
	 $("#Siberia",svgDoc).css("fill","#c2cdd3");
	 $("#Urals",svgDoc).css("fill","#8ecdef");
	 $("#Northwestern",svgDoc).css("fill","#9eb8f9");
	 $("#Volga",svgDoc).css("fill","#fbe230");
	 $("#Central",svgDoc).css("fill","#a1e736");
	 $("#KL",svgDoc).css("fill","#eea268");
	 $("#KC",svgDoc).css("fill","#d27387");
});