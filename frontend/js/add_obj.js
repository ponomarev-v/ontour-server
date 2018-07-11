function btn_subbmit(){
    x = window.coords[0];
    
    y  = window.coords[1];
    tmp = "cx="+x+"&"+"cy="+y;
    obl = "Владимир";
    // alert(tmp)
    // alert($("#form_addobj").serialize())
   // alert("http://api.turneon.ru/?method=map.add&"+tmp+"&kind=1"+"&"+$("#form_addobj").serialize()+"&reg="+obl)
        $.ajax({
            type: "POST",
            url: "http://api.turneon.ru/?method=map.add&"+tmp+"&kind=1"+"&"+$("#form_addobj").serialize()+"&reg="+obl,
            xhrFields: {withCredentials: true},
            success: function (data) {
                data = eval("(" + data + ")");
                if (data.result == "success") {
                    $.ajax({  
                        url: "../yandex_map.php",  
                        cache: false,  
                        success: function(html){  
                            $("#mp").html(html);  
                    }  });
                   
                } else {
                    alert("error add obj");
                }
            }
        });
    
    
    
}