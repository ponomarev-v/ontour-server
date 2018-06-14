<div id="register_window" class="modal"><!--окно регистрации-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                 Регистрация ON TOUR
            </h1>
            <form id="register_form">
                <h3>
                    Логин
                </h3>
                <input type="text" name="login">
                <h3>
                    Телефон
                </h3>
                <input type="text" name="phone" id="phone">
                <h3>
                    Почта
                </h3>
                <input type="email" name="email">
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
        $('#phone').mask('8(000)000-00-00');
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
                xhrFields: {withCredentials: true},
                success: function(data)
                {
                    data = eval("(" + data + ")");
                    if(data.result == "success") {
                        $("#register_error").html("");
                        $("#register_window").hide();
                        $("#menu_main").show();
                        createProfile(data);
                    } else {
                        $("#register_error").html(data[message]);
                    }
                }
            });
            e.preventDefault();
        });
    });
</script>