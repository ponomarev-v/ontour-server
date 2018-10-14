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
        if(svg) {
            parentBounds = svg.parentNode.getBoundingClientRect();
            svg.currentScale = Math.min(
                (0.7 * parentBounds.width)/(svg_bounds.right - svg_bounds.left),
                window.innerHeight/(svg_bounds.bottom - svg_bounds.top)
            );
            svgHeight = svg.currentScale * (svg_bounds.bottom - svg_bounds.top);
            svgWidth = svg.currentScale * (svg_bounds.right - svg_bounds.left);
            svg.setAttribute('viewBox', (svg_bounds.left) + ' ' + (svg_bounds.top) + ' ' + (svg.currentScale * svg_bounds.right) + ' ' + (svg.currentScale * svg_bounds.bottom));
            $(svg).css({
                width: (svgWidth) + "px",
                height: (svgHeight) + "px",
            });
            $(svg.parentNode).css({
                height: (svgHeight) + "px",
                paddingLeft: ((parentBounds.width - svgWidth)/2) + "px",
            });
        }
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
                    svg_init = false;
                    $(svg).css({width: "1px", height: "1px"});
                    $(".map_content").append(svg);
                    for(elem in response.items) {
                        if(response.items[elem].path){
                            path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                            path.setAttribute('d', response.items[elem].path);
                            path.setAttribute('id', response.items[elem].id);
                            path.setAttribute('style', 'fill: #fefee9; fill-opacity: 0.5; opacity: 1; stroke:#646464; stroke-width:0.3; stroke-opacity:1;');
                            svg.appendChild(path);
                            rect = path.getBoundingClientRect();
                            if(!svg_init || (svg_bounds.left > rect.left)) svg_bounds.left = rect.left;
                            if(!svg_init || (svg_bounds.top > rect.top)) svg_bounds.top = rect.top;
                            if(!svg_init || (svg_bounds.right < rect.right)) svg_bounds.right = rect.right;
                            if(!svg_init || (svg_bounds.bottom < rect.bottom)) svg_bounds.bottom = rect.bottom;
                            svg_init = true;
                            /*
                            text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                            text.setAttribute('x', rect.left + rect.width/2);
                            text.setAttribute('y', rect.top + rect.height/2);
                            text.setAttribute('fill', '#fff');
                            text.textContent = response.items[elem].name;
                            svg.appendChild(text);
                            */
                        }
                    }
                    parentBounds = svg.parentNode.getBoundingClientRect();
                    svg_bounds.left = svg_bounds.left - parentBounds.left;
                    svg_bounds.right = svg_bounds.right - parentBounds.left;
                    svg_bounds.top = svg_bounds.top - parentBounds.top;
                    svg_bounds.bottom = svg_bounds.bottom - parentBounds.top;
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