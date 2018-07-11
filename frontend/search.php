<div id="window_show_target" class="modal"><!--окно регистрации-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="form_window">
            <h1>
                Результаты поиска
            </h1>
            <div class="target">


            </div>
            <div class="error"></div>
        </div>
    </div>
</div>


<div id="window_find_target">
    <form class="search_form">
        <input type="hidden" name="method" value="map.find_target">
        <input type="search" class="search" name="find" placeholder="Поиск по сайту">
        <input type="submit" class="search button window_btn" value="Найти" window-id="window_show_target">
    </form>
</div>


<script>
    function show_target_info(data) {
        $.each(data, function (index, value) {
            if (index == "result") {
            } else {
                $("#window_show_target .target").append("<div class='target_item' style='border-bottom: solid 1px lightgreen'></div>");
                $("#window_show_target .target .target_item").append("<h3 class='name'></h3>" +
                    "<p class='description'></p>" +
                    "<input type='button' value='показать на карте' class='button show_on_the_map center'><br><br>");
                $("#window_show_target .target .target_item .name").html(data[index]["name"]);
                $("#window_show_target .target .target_item .description").html(data[index]["description"]);
                $("#window_show_target .target .target_item").attr("class", index);
            }
        });
    }

    $(document).ready(function () {
        register_ajax_form("#window_find_target form", function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                $("#window_show_target .target").empty();
                show_target_info(data);
                $(".show_on_the_map").click(function () {
                    alert("сейчас должно было кинуть на карту с центром в координатах этого места")
                });
            } else {
                $("#window_show_target .error").html(data["message"]);
            }
        }, null);
    });
</script>