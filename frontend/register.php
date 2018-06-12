<div id="register_window" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                 Регистрация ON TOUR
            </h1>
            <form id="register_form">
                <h3>
                    Имя
                </h3>
                <input type="text" name="register">
                <h3>
                    Телефон
                </h3>
                <input type="text" name="phone">
                <h3>
                    Пароль
                </h3>
                <input type="password" name="password">
                <h3>
                </h3>
                <div id="register_error"></div>
                <input type="submit">
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#btn_register").click(function () {
            $("#login_window").hide();
            $("#register_window").show();
        });

        $("#register_window .close").click(function () {
            $("#register_window").hide();
        });

        $("#register_window").click(function (e) {
            if(e.target == this)
                $("#register_window").hide();
        });

        $("#register_form").submit(function(e) {

            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium33.ru/?method=user.register",
                data: $("#register_form").serialize(),
                success: function(data)
                {
                    data = eval("(" + data + ")");
                    if(data.result == "success") {
                        $("#register_error").html("");
                        $("#register_window").hide();
                        $("#menu_register").hide();
                        $("#menu_logout").show();
                        $("#btn_profile").html("Профиль");
                        $("#btn_profile").attr("title", "Click here!");
                    } else {
                        $("#register_error").html("Не вышло =(");
                    }
                }
            });
            e.preventDefault();
        });
    });
</script>