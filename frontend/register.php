<div id="register_window" class="modal"><!--окно регистрации-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                Регистрация ON TOUR
            </h1>
            <form id="register_form">
                <input type="text" name="name" placeholder="Имя" class="form" required><br>
                <input type="text" name="email" placeholder="Электронная почта" class="form" required><br>
                <input type="text" name="phone" placeholder="Номер телефона" class="form" required id="phone_register"><br>
                <input type="password" name="password" placeholder="Пароль" class="form" required id="password_register">
                <input type="password" placeholder="Повтор пароля" class="form" required id="password_register_repeat">
                <input type="button" id="show_password_register" value="&#128065;"><br>
                <p>
                    <div id="register_error"></div><br>
                    <input type="submit" value="Зарегистрироваться">
                </p>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#phone_register').mask('8(000)000-00-00');

        $(".btn_register").click(function () {
            $("#login_window").hide();
            $("#register_window").show();
        });

        $("#show_password_register").click(function () {
            $("#password_register").attr("type", "text");
        });

        $("#register_window .close").click(function () {
            $("#register_window").hide();
        });

        $("#register_window").click(function (e) {
            if (e.target == this)
                $("#register_window").hide();
        });

        $("#register_form").submit(function (e) {
            if ($("#password_register") != $("#password_register_repeat"))
                alert("Пароли не совпадают");
            else
                $.ajax({
                    type: "POST",
                    url: "http://ontourapi.kvantorium33.ru/?method=user.register",
                    data: $("#register_form").serialize(),
                    xhrFields: {withCredentials: true},
                    success: function (data) {
                        data = eval("(" + data + ")");
                        if (data.result == "success") {
                            $("#register_error").html("");
                            $("#register_window").hide();
                            $("#menu_main").show();
                            $("#menu_logout").show();
                            $("#menu_profile").show();
                            $("#menu_register").hide();
                            $("#menu_login").hide();
                        } else {
                            $("#register_error").html(data["message"]);
                        }
                    }
                });
            e.preventDefault();
        });
    });
</script>