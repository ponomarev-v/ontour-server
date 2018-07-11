<?php
include "header.php";/*подключение головы сайта*/
include "footer.php";/*подключение ног сайта*/
?>

<script>
     $.ajax({
            type: "POST",
            url: "http://api.turneon.ru/?method=user.location"
            xhrFields: {withCredentials: true},
            success: function (data) {
                data = eval("(" + data + ")");
                if (data.result == "success") {
                    if(data.data == "Vladimir"){
                        window.location = "/district_map.php"
                    }
                }
            }
        });
</script>