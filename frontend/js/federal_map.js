$(window).on("load",function(){
    
    var a = $("#federal_map")[0];
    var svgDoc = a.contentDocument;
    var obj = ["#Central","#Volga","#Urals","#Siberia","#Far_Eastern","#Northwestern","#KC","#KL","#path4765"]
    //$("#Central",svgDoc).attr("a","'/CFD_map.php'");
	obj.forEach(element => {
        var regionColor = $(element,svgDoc).css("fill","#1076C8");
        var borderColor = $(element,svgDoc).css("stroke","#fff");
 

        $(element,svgDoc).hover(function(){
            var regionColor = $(element,svgDoc).css("opacity","0.7");     
			 var transition = $(element,svgDoc).css("transition:","3s");
             
        });
        $(element,svgDoc).mouseout(function(){
            var regionColor = $(element,svgDoc).css("opacity","1");
            
        });
    });
    $("[data-tooltip]",svgDoc).mousemove(function (eventObject) {

        $data_tooltip = $(this).attr("data-tooltip");
        
        $("#tooltip").text($data_tooltip)
                     .css({ 
                         "top" : eventObject.pageY + 145,
                        "left" : eventObject.pageX + 145,
                        
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
	  $("#Far_Eastern",svgDoc).css("stroke","#f1ce82");
	 $("#Siberia",svgDoc).css("fill","#c2cdd3");
	 $("#Siberia",svgDoc).css("stroke","#c2cdd3");
	 $("#Urals",svgDoc).css("fill","#8ecdef");
	  $("#Urals",svgDoc).css("stroke","#8ecdef");
	 $("#Northwestern",svgDoc).css("fill","#9eb8f9");
	  $("#Northwestern",svgDoc).css("stroke","#9eb8f9");
	 $("#Volga",svgDoc).css("fill","#fbe230");
	 $("#Volga",svgDoc).css("stroke","#fbe230");
	 $("#Central",svgDoc).css("fill","#a1e736");
	 $("#Central",svgDoc).css("stroke","#a1e736");
	 $("#KL",svgDoc).css("fill","#eea268");
	 $("#KL",svgDoc).css("stroke","#eea268");
	 $("#KC",svgDoc).css("fill","#d27387");
     $("#KC",svgDoc).css("stroke","#d27387");
     
     $("#Central",svgDoc).click(function(){
        var central = $("#Central",svgDoc);
        window.location = "/CFD_map.php"
     });
     
});