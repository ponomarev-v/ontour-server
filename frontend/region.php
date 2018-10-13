<?php
include "header.php";
?>
<!-- <?php print_r($_SERVER); ?> -->
    <div class="center">
        <h1>Приложение</h1>
    </div>
    <script>
        $.ajax({
            type: "POST",
            url: "http://api.turneon.ru/?method=user.GeoIpLocation",
            xhrFields: {withCredentials: true},
            success: function (data) {
                data = eval("(" + data + ")");
                if (data.result == "success") {
                    if (data.data == "Vladimir") {
                        window.location = "/Vladimir_map.php"
                    } else {
                        window.location = "/district_map.php"
                    }
                }
            }
        });
    </script>
<?php
include "footer.php";