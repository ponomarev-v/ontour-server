<?php
include "header.php";
?>
<div class="content">
    <h3 class="map_header"></h3>
    <div class="map_content"></div>
    <div class="map_footer"></div>
</div>
<script>
    var svg = null;
    var svg_bounds = null;
    
    function adjustSvg() {
        /*
        if(svg) {
            bounds = {left: 0, top: 0, right: 0, bottom: 0};
            for(elem = 0; elem < svg.children.length; elem++) {
                rect = svg.children[elem].getBoundingClientRect();
                if(elem == 0 || (bounds.left > rect.left)) bounds.left = rect.left;
                if(elem == 0 || (bounds.top > rect.top)) bounds.top = rect.top;
                if(elem == 0 || (bounds.right < rect.right)) bounds.right = rect.right;
                if(elem == 0 || (bounds.bottom < rect.bottom)) bounds.bottom = rect.bottom;
            }
            rect = svg.getBoundingClientRect();

            $(svg).css({
                width: bounds.right + "px",
                height: bounds.bottom + "px",
                marginLeft: (rect.left - bounds.left) + "px",
                marginTop: (rect.top - bounds.top) + "px"
            });
        }
        */
    }
    
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
                        $(".map_content").remove(svg);
                    }
                    svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                    svg_bounds = {left: 0, top: 0, right: 0, bottom: 0};
                    $(svg).css({width: "1px", height: "1px"});
                    $(".map_content").append(svg);
                    for(elem in response.items) {
                        if(response.items[elem].path){
                            path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                            path.setAttribute('d', response.items[elem].path);
                            svg.appendChild(path);
                            rect = path.getBoundingClientRect();
                            if(elem == 0 || (svg_bounds.left > rect.left)) svg_bounds.left = rect.left;
                            if(elem == 0 || (svg_bounds.top > rect.top)) svg_bounds.top = rect.top;
                            if(elem == 0 || (svg_bounds.right < rect.right)) svg_bounds.right = rect.right;
                            if(elem == 0 || (svg_bounds.bottom < rect.bottom)) svg_bounds.bottom = rect.bottom;
                        }
                    }
                    adjustSvg();
                }
            }
        });
    }

    $(document).ready(function(){
        current_region = <?php echo empty($_REQUEST['reg']) ? "$.cookie('region')" : json_encode($_REQUEST['reg']) ?>;
        if(current_region)
            loadRegion(current_region);
        else
            loadRegion('auto');
    });

    $(window).resize(adjustSvg);
</script>
<?php
include "footer.php";