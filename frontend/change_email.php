<div id="change_email_window" class="modal" style="display: none"><!--окно смены телефона-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                смена почты
            </h1>
            <form id="change_email_form">
                <h3>
                    Старая почта
                </h3>
                <input type="text" name="old_email">
                <h3>
                    Новая почта
                </h3>
                <input type="text" name="new_email">
                <h3>
                </h3>
                <input type="submit" id="submit_new_email">
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
        $("#change_email_window .close").click(function () {
            $("#change_email_window").hide();
            $("#profile_window").show();
        });
        $("#change_email_window").click(function (e) {
            if (e.target == this)
                $("#change_email_window").hide();
        });
        $("#change_email_form").submit(function (e) {
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium33.ru/?method=user.change_email",
                data: $("#change_email_form").serialize(),
                xhrFields: {withCredentials: true},
                success: function (data) {
                    data = eval("(" + data + ")");
                    if (data.result == "success") {
                        $("#change_email_error").html("");
                        $("#change_email_window").hide();
                        $("#profile_window").show();
                        $("#profile_window" .email).html(data [1]);
                    } else {
                        $("#change_email_error").html("Не удалось изменить почту");
                    }
                }
            });
            e.preventDefault();
        });

        $("#btn_change_email").click(function () {
            $("#profile_window").hide();
            $("#change_email_window").show();
        });
    });
</script>
