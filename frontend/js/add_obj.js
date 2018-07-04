function btn_subbmit(){                   
    x = window.coords[0]
    
    y  = window.coords[1]
    tmp = "cx="+x+"&"+"cy="+y
    obl = "Владимир"
    // alert(tmp)
    // alert($("#form_addobj").serialize())
    alert(window.firstGeoObject.getAddressLine())
    if(window.firstGeoObject.getAddressLine().search("Владимир") != 0 && window.firstGeoObject.getAddressLine().search("Владимирская") != 0){
        $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium33.ru/?method=map.add&"+tmp+"&kind=1"+"&"+$("#form_addobj").serialize()+"&obl="+obl,
            xhrFields: {withCredentials: true},
            success: function (data) {
                data = eval("(" + data + ")");
                if (data.result == "success") {
                    alert("success")
                    showAllObj()
                } else {
                    alert("error add obj")
                }
            }
        });
    } else{
        alert("Пока что можно добавлять лишь во владимирской области")
    }
    
    
}