$(window).on("load",function(){
    
    var a = $("#map")[0];
    var svgDoc = a.contentDocument;
    var obj = ["#Central","#Volga","#Urals","#Siberia","#Far_Eastern","#Northwestern","#KC","#KL","#path4765"]
    obj.forEach(element => {
        var regionColor = $(element,svgDoc).css("fill","#1076C8");
        var borderColor = $(element,svgDoc).css("stroke","#fff");
       


        $(element,svgDoc).mousemove(function(){
            var regionColor = $(element,svgDoc).css("fill","#0A4C82");     
             
        });
        $(element,svgDoc).mouseout(function(){
            var regionColor = $(element,svgDoc).css("fill","#1076C8");
            
        });
    });
    $("[data-tooltip]",svgDoc).mousemove(function (eventObject) {

        $data_tooltip = $(this).attr("data-tooltip");
        
        $("#tooltip").text($data_tooltip)
                     .css({ 
                         "top" : eventObject.pageY - 25,
                        "left" : eventObject.pageX - 25,
                        
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