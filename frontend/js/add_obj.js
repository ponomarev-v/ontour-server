function btn_subbmit(){                   
    x = window.coords[0]
    y  = window.coords[1]
    tmp = "cx="+x+"&"+"cy="+y
    // alert(tmp)
    // alert($("#form_addobj").serialize())
    $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium33.ru/?method=map.add&"+tmp+"&kind=1"+"&"+$("#form_addobj").serialize(),
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
}