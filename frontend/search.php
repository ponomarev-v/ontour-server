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
    <form class="search_form" action="">
    <input type="hidden" name="method" value="map.find_target">
    <input type="search" class="search" class="window_btn" window-id="window_show_target" name="find" placeholder="Поиск по сайту">
        <input type="submit" class="search button" value="Найти">
</form>
</div>
<script src="/js/app.js"></script>
<script>
    function show_target_info(data) {
        $("#window_show_target .target").html(data["message"]);
    }

    $(document).ready(function () {
        register_ajax_form("#window_find_target form", function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                show_target_info(data);
            } else {
                $("#window_show_target .error").html(data["message"]);
            }
        }, null);
    });
</script>