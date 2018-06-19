$(window).on("load",function(){
    
    var a = $("#federal_map")[0];
    
    var svgDoc = a.contentDocument;
    
    	
    
    var obj = ["#Central","#Volga","#Urals","#Siberia","#Far_Eastern","#Northwestern","#KC","#KL","#path4765"]
    var colors = ["#a1e736","#fbe230","8ecdef","#c2cdd3","#f1ce82","#9eb8f9","#d27387","#eea268"]
    //$("#Central",svgDoc).attr("a","'/CFD_map.php'");
	obj.forEach(element => {
        colors.forEach(color=>{
            $(element,svgDoc).css("fill",color);
            $(element,svgDoc).css("stroke",color);
       
        $(element,svgDoc).css("transition","0.2s");

        $(element,svgDoc).hover(function(){
            $(element,svgDoc).css("opacity","0.7");     
		    $(element,svgDoc).css("transition:","3s");
             
        });
        $(element,svgDoc).mouseout(function(){
            $(element,svgDoc).css("opacity","1");
            
        });
    });
});
    $("[data-tooltip]",svgDoc).mousemove(function (eventObject) {

        $data_tooltip = $(this).attr("data-tooltip");
        
        $("#tooltip").text($data_tooltip)
                     .css({ 
                         "top" : eventObject.pageY - 55,
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
     
     $("#Central",svgDoc).click(function(){
        window.location = "/CFD_map.php"
     });
     
});