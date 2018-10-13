<?php
include "header.php";
?>
<!-- <?php print_r($_SERVER); ?> -->
<div class="center">
    <h1>Приложение</h1>
</div>
<script>
    function loadRegion(id) {
        $.ajax({
            type: "POST",
            url: "http://api.turneon.ru/?method=region.get&id="+id,
            xhrFields: {withCredentials: true},
            success: function (data) {
                alert(data);
                response = eval("(" + data + ")");
                /*
                if (response.result == "success") {
                    if (response.data == "Vladimir") {
                        window.location = "/Vladimir_map.php"
                    } else {
                        window.location = "/district_map.php"
                    }
                }
                */
            }
        });
    }

    $(document).ready(function(){
        current_region = $.cookie('region');
        if(current_region)
            loadRegion(current_region);
        else
            loadRegion('auto');
    });
</script>
<?php
include "footer.php";