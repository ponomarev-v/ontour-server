<?php
include "header.php";
?>
<!-- <?php print_r($_SERVER); ?> -->
<div class="content">
    <h3 class="map_header"></h3>
    <div class="map_content"></div>
    <div class="map_footer"></div>
</div>
<script>
    var svg = null;
    function loadRegion(id) {
        $.ajax({
            type: "POST",
            url: "http://api.turneon.ru/?method=region.get&id="+id,
            xhrFields: {withCredentials: true},
            success: function (data) {
                response = eval("(" + data + ")");
                if (response.result == "success") {
                    $(".map_header").text(response.name);
                    if(svg) {
                        $(".map_content").removeChild(svg);
                    }
                    svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                    for(elem in response.items) {
                        path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                        path.setAttribute('d', elem.path);
                        svg.appendChild(path);
                    }
                    $(".map_content").appendChild(svg);
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