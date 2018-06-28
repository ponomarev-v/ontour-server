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
                <div id="login_error"></div><br>
                <input type="submit" value="Войти">
                </p>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.phone').mask('8(000)000-00-00');

        function createProfile(user_info) {
            $("#menu_login").hide();
            $("#menu_register").hide();
            $("#menu_logout").show();
            $("#menu_profile").show();
            $("#menu_main").show();
        }

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
                        $("#menu_main").show();
                        $("#menu_logout").show();
                        $("#menu_profile").show();
                        $("#menu_register").hide();
                        $("#menu_login").hide();
                        $("#login_window").hide();
                    } else {
                        $("#login_error").html(data["message"]);
                    }
                }
            });
            e.preventDefault();
        });

        $("#btn_register").click(function () {
            $("#login_window").hide();
            $("#register_window").show();

        });
    });
</script>
<div id="logout_window" class="modal"><!--окно логина-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                Вы точно хотите выйти?
            </h1>
            <form id="logout_form">
                <p>
                    <input type="submit" value="Да, выйти">
                    <input type="button" value="Нет, остаться" id="btn_logout_none">
                </p>
            </form>
        </div>
    </div>
</div>
<script>
    function logOut(user_info) {
        $("#menu_login").show();
        $("#menu_register").show();
        $("#menu_logout").hide();
        $("#menu_profile").hide();
        $("#menu_main").hide();
    }

    $(document).ready(function() {

        $("#btn_logout").click(function () {
            $("#logout_window").show();
        });

        $("#btn_logout_none").click(function () {
            $("#logout_window").hide();
        });

        $("#logout_window .close").click(function () {
            $("#logout_window").hide();
        });

        $("#logout_window").click(function (e) {
            if(e.target == this)
                $("#logout_window").hide();
        });

        $("#logout_form").submit(function(e) {
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium33.ru/?method=user.logout",
                data: $("#logout_form").serialize(),
                xhrFields: {withCredentials: true},
                success: function(data)
                {
                    data = eval("(" + data + ")");
                    if(data.result == "success") {
                        $("#logout_window").hide();
                        logOut(data);
                    } else {
                        $("#login_error").html("Неправильный логин или пароль");
                    }
                }
            });
            e.preventDefault();
        });

        $("#btn_register").click(function () {
            $("#login_window").hide();
            $("#register_window").show();

        });

    });
</script>
<div id="profile_window" class="modal"><!--окно профиля-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                Редактирование профиля
            </h1>
            <form id="profile_form">
                <input type="text"     name="name"     placeholder="Имя"               class="form" id="profile_name"><br>
                <input type="number"   name="age"      placeholder="Возраст"           class="form" id="profile_age"><br>
                <input type="text"     name="school"   placeholder="Учебное заведение" class="form" id="profile_school"><br>
                <input type="password" name="password" placeholder="Пароль"            class="form" id="profile_password"><br>
                <input type="email"    name="email"    placeholder="Электронная почта" class="form" id="profile_email"><br>
                <input type="text"     name="phone"    placeholder="Номер телефона"    class="form" id="profile_phone">
                <p>
                <div id="profile_error"></div><br>
                <input type="submit" value="Сохранить">
                </p>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $("#btn_profile").click(function () {
            $("#profile_window").show();
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium33.ru/?method=user.info",
                xhrFields: {withCredentials: true},
                success: function (data) {
                    data = eval("(" + data + ")");
                    if (data.result == "success") {
                        $("#profile_name").val(data["name"]);
                        $("#profile_age").val(data["age"]);
                        $("#profile_school").val(data["school"]);
                        $("#profile_password").val(data["password"]);
                        $("#profile_email").val(data["email"]);
                        data["phone"] = "8" + "(" + data["phone"][0] + data["phone"][1] + data["phone"][2] + ")" +
                            data["phone"][3] + data["phone"][4] + data["phone"][5] + "-" + data["phone"][6] +
                            data["phone"][7] + "-" + data["phone"][8] + data["phone"][9];
                        $('#profile_phone').mask('8(000)000-00-00');
                        $("#profile_phone").val(data["phone"]);
                    } else {
                        $("#profile_error").html(data["message"]);
                    }
                }
            });
        });

        $('#profile_phone').mask('8(000)000-00-00');

        $("#profile_window .close").click(function () {
            $("#profile_window").hide();
        });
        $("#profile_window").click(function (e) {
            if (e.target == this)
                $("#profile_window").hide();
        });
        $("#profile_form").submit(function (e) {
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium33.ru/?method=user.profile",
                data: $("#profile_form").serialize(),
                xhrFields: {withCredentials: true},
                success: function (data) {
                    data = eval("(" + data + ")");
                    if (data.result == "success") {
                        $("#profile_error").html("");
                        $("#profile_window").hide();
                        $("#menu_main").show();
                    } else {
                        $("#profile_error").html(data["message"]);
                    }
                }
            });
            e.preventDefault();
        });
    });
</script>
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