$(window).on("load",function(){
    
    var a = $("#map")[0];
    var svgDoc = a.contentDocument;
    var obj = ["#Central","#Volga","#Urals","#Siberia","#Far_Eastern","#Northwestern","#KC","#KL","#path4765"]
    obj.forEach(element => {
        var regionColor = $(element,svgDoc).css("fill","#1076C8");
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
                         "top" : eventObject.pageY - 5,
                        "left" : eventObject.pageX - 5,
                        
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
});