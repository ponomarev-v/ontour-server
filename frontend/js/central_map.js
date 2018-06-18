$(window).on("load",function(){
    var centralMap = $("#central_map")[0];
    var svgCentral = centralMap.contentDocument;
    var objCentral = ["#path207","#path4717","#path4719","#path4733","#path4725","#path203","#path4731","#path4759","#path4721","#path4723","#path4739","#path4737","#path4735","#path4741","#path4753","#path4749","#path4745","#path4743","#path4751","#path4747"]
    var objVolga = ["#path52","#path84","#path88","#path106"]
    objVolga.forEach(element => {
        $(element,svgCentral).css("fill","#fbe230");
        $(element,svgCentral).css("stroke","#fff");
        $(element,svgCentral).css("stroke-width",2);
        $(element,svgCentral).hover(function(){
            $(element,svgCentral).css("opacity","0.7");     
        });
        $(element,svgCentral).mouseout(function(){
            $(element,svgCentral).css("opacity","1");   
        });
    });

    objCentral.forEach(element => {
       $(element,svgCentral).css("fill","#a1e736");
       $(element,svgCentral).css("stroke","#71a12a");
    $(element,svgCentral).hover(function(){
        $(element,svgCentral).css("opacity","0.7");     
        });
    $(element,svgCentral).mouseout(function(){
        $(element,svgCentral).css("opacity","1");   
        });
    });
    $("[data-tooltip]",svgCentral).mousemove(function (eventObject) {

        $data_tooltip_central = $(this).attr("data-tooltip");
        
        $("#tooltip").text($data_tooltip_central)
                     .css({ 
                         "top" : eventObject.pageY + 35,
                        "left" : eventObject.pageX ,
                        
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
    $("#path4723",svgCentral).click(function(){
        window.location = 'http://ontour.kvantorium33.ru/Vladimir_map.php'
    });
});