<div id="change_phone_window" class="modal" style="display: none"><!--окно смены телефона-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                смена номера телефона
            </h1>
            <form id="change_phone_form">
                <h3>
                    Старый номер телефона
                </h3>
                <input type="text" name="old_phone" class="phone">
                <h3>
                    Новый номер телефона
                </h3>
                <input type="text" name="new_phone" class="phone">
                <h3>
                </h3>
                <input type="submit" id="submit_new_phone">
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.phone').mask('8(000)000-00-00');
        $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium33.ru/?method=user.info",
            xhrFields: {withCredentials: true},
            success: function (data) {
                data = eval("(" + data + ")");
                if (data.result == "success") {
                }
            }
        });
        $("#change_phone_window .close").click(function () {
            $("#change_phone_window").hide();
        });
        $("#change_phone_window").click(function (e) {
            if (e.target == this)
                $("#change_phone_window").hide();
        });
        $("#change_phone_form").submit(function (e) {
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium33.ru/?method=user.change_phone",
                data: $("#change_phone_form").serialize(),
                xhrFields: {withCredentials: true},
                success: function (data) {
                    data = eval("(" + data + ")");
                    if (data.result == "success") {
                        $("#change_phone_error").html("");
                        $("#change_phone_window").hide();
                        $("#profile_window").show();
                        $("#profile_window" .phone).html(data [0]);
                    } else {
                        $("#change_phone_error").html("Не удалось изменить номер телефона");
                    }
                }
            });
            e.preventDefault();
        });

        $("#btn_change_phone").click(function () {
            $("#profile_window").hide();
            $("#change_phone_window").show();
        });
    });
</script>