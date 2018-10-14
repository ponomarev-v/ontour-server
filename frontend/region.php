<?php
include "header.php";
?>
<!-- <?php print_r($_SERVER); ?> -->
<div class="center">
    <h3 class="map_header"></h3>
    <div class="map_content"></div>
    <div class="map_footer"></div>
</div>
<script>
    function loadRegion(id) {
        $.ajax({
            type: "POST",
            url: "http://api.turneon.ru/?method=region.get&id="+id,
            xhrFields: {withCredentials: true},
            success: function (data) {
                response = eval("(" + data + ")");
                if (response.result == "success") {
                    $(".map_header").text(response.data.name);
                }
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