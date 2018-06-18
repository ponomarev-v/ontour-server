$(window).on("load",function(){
    var centralMap = $("#central_map")[0];
    var svgCentral = centralMap.contentDocument;
    var objCentral = ["#path96","#path94","#path92","#path46","#path50","#path60","#path68","#path54","#path62","#path4926","#path44","#path78","#path66","#path98","#path74","#path64","#path82","#path42"]
    var objVolga = ["#path52","#path84","#path88","#path106"]
    objVolga.forEach(element => {
        var regionColor = $(element,svgCentral).css("fill","#fbe230");
        var borderColor = $(element,svgCentral).css("stroke","#fff");
        $(element,svgCentral).hover(function(){
            var regionOpacity = $(element,svgCentral).css("opacity","0.7");     
        });
        $(element,svgCentral).mouseout(function(){
            regionOpacity = $(element,svgCentral).css("opacity","1");   
        });
    });

    objCentral.forEach(element => {
        var regionColor = $(element,svgCentral).css("fill","#a1e736");
        var borderColor = $(element,svgCentral).css("stroke","#71a12a");
    $(element,svgCentral).hover(function(){
        var regionColor = $(element,svgCentral).css("opacity","0.7");     
        });
    $(element,svgCentral).mouseout(function(){
        var regionColor = $(element,svgCentral).css("opacity","1");   
        });
    });
    $("[data-tooltip]",svgCentral).mousemove(function (eventObject) {

        $data_tooltip_central = $(this).attr("data-tooltip");
        
        $("#tooltip").text($data_tooltip_central)
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
});