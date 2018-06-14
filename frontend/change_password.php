<div id="change_password_window" class="modal" style="display: none"><!--окно смены телефона-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                смена пароля
            </h1>
            <form id="change_password_form">
                <h3>
                    Старый пароль
                </h3>
                <input type="text" name="old_password">
                <h3>
                    Новый пароль
                </h3>
                <input type="text" name="new_password">
                <h3>
                </h3>
                <input type="submit" id="submit_new_password">
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
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
        $("#change_password_window .close").click(function () {
            $("#change_password_window").hide();
        });
        $("#change_password_window").click(function (e) {
            if (e.target == this)
                $("#change_password_window").hide();
        });
        $("#change_password_form").submit(function (e) {
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium33.ru/?method=user.change_password",
                data: $("#change_password_form").serialize(),
                xhrFields: {withCredentials: true},
                success: function (data) {
                    data = eval("(" + data + ")");
                    if (data.result == "success") {
                        $("#change_password_error").html("");
                        $("#change_password_window").hide();
                        $("#profile_window").show();
                        $("#profile_window".password).html(data [2]);
                    } else {
                        $("#change_password_error").html("Не удалось изменить пароль");
                    }
                }
            });
            e.preventDefault();
        });

        $("#btn_change_password").click(function () {
            $("#profile_window").hide();
            $("#change_password_window").show();
        });
    });
</script>
