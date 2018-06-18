$(window).on("load",function(){
    var vladimirMap = $("#vladimir_map")[0];
    var svgVladimir = vladimirMap.contentDocument;
    var objVladimir = ["#path4482"]
    objVladimir.forEach(element => {
        $(element,svgCentral).css("fill","#a1e736");
        $(element,svgCentral).css("stroke","#71a12a");
    });
    $(element,svgCentral).hover(function(){
        $(element,svgCentral).css("opacity","0.7");     
        });
    $(element,svgCentral).mouseout(function(){
        $(element,svgCentral).css("opacity","1");   
        });
    $("[data-tooltip]",svgCentral).mousemove(function (eventObject) {

        $data_tooltip_central = $(this).attr("data-tooltip");
        
        $("#tooltip").text($data_tooltip_central)
                     .css({ 
                         "top" : eventObject.pageY + 45,
                        "left" : eventObject.pageX + 45,
                        
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