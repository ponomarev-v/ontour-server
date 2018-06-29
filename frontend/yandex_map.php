<?php
include "header.php";
?>
    <div id="map"></div>
    <div class="form_add" style="display:none;">
    <form action>
        <input type="text" id="name" placeholder="Название">
        <br>
        <input type="text" id="description" placeholder="Описание">
        <br>
        <input type="button" value="Submit" id="btn_add">
        </form>
    </div>
    <script src="js/yandex_map.js"></script>
    <script>
    function btn_subbmit(){                   
        x = window.coords[0]
        y = x = window.coords[1]
        tmp = "cx="+x+"&"+"cy="+y
        // alert(tmp)
        // alert($("#form_addobj").serialize())
        $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium33.ru/?method=map.add&"+tmp+"&kind=0"+"&"+$("#form_addobj").serialize(),
                xhrFields: {withCredentials: true},
                success: function (data) {
                    data = eval("(" + data + ")");
                    if (data.result == "success") {
                        alert("success")
                    } else {
                        alert("error add obj")
                    }
                }
            });
    }
    </script>
    <script src="js/map.js"></script>
<?php
include "footer.php";
?>