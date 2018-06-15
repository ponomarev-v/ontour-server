<div id="login_window" class="modal"><!--окно логина-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                Вход ON TOUR
            </h1>
            <form id="login_form">
                <input type="text"     name="login"    placeholder="телефон или mail" class="form" required><br>
                <input type="password" name="password" placeholder="Пароль"           class="form" required>
                <p>
                    <input type="text" name="login_error" style="display: none"><br>
                    <input type="submit" value="Войти">
                </p>
            </form>
        </div>
    </div>
</div>
<script>
    function createProfile(user_info) {
        $("#menu_login").hide();
        $("#menu_register").hide();
        $("#menu_logout").show();
        $("#menu_profile").show();
        $("#menu_main").show();
    }

    $(document).ready(function() {
        $('.phone').mask('8(000)000-00-00');
        $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium33.ru/?method=user.info",
            xhrFields: {withCredentials: true},

            success: function(data)
            {
                data = eval("(" + data + ")");
                if(data.result == "success") {
                    createProfile(data);
                }
            }
        });

        $("#btn_login").click(function () {
            $("#login_window").show();
        });

        $("#login_window .close").click(function () {
            $("#login_window").hide();
        });

        $("#login_window").click(function (e) {
            if(e.target == this)
                $("#login_window").hide();
        });

        $("#login_form").submit(function(e) {
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium33.ru/?method=user.login",
                data: $("#login_form").serialize(),
                xhrFields: {withCredentials: true},
                success: function(data)
                {
                    data = eval("(" + data + ")");
                    if(data.result == "success") {
                        $("#login_error").html("");
                        $("#login_window").hide();
                        $("#menu_main").show();
                        createProfile(data);
                    } else {
                        $("#login_error").html(data["message"]);
                    }
                }
            });
            e.preventDefault();
        });

        $("#btn_profile").click(function () {
            $("#profile_window").show();
        });

        $("#btn_register").click(function () {
            $("#login_window").hide();
            $("#register_window").show();

        });

        $("#btn_logout").click(function () {
            $("#logout_window").show();
        });
    });
</script>
