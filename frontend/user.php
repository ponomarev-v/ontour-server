<div id="window_login" class="modal"><!--окно логина-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="form_window">
            <h1>
                Вход ON TOUR
            </h1>
            <form>
                <input type="hidden" name="method" value="user.login"><br>
                <input type="text"     name="login"    placeholder="телефон или mail" class="form" required><br>
                <input type="password" name="password" placeholder="Пароль"           class="form" required>
                <div class="error"></div><br>
                <input type="button" value="Забыли пароль" id="btn_forgot_password">
                <input type="submit" value="Войти">
            </form>
        </div>
    </div>
</div>

<div id="window_logout" class="modal"><!--окно выхода-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="form_window">
            <h1>
                Вы точно хотите выйти?
            </h1>
            <form>
                <input type="hidden" name="method" value="user.logout"><br>
                <input type="submit" value="Да, выйти">
                <input type="button" value="Нет, остаться" id="btn_logout_none">
            </form>
        </div>
    </div>
</div>

<div id="window_profile" class="modal"><!--окно профиля-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="form_window">
            <h1>
                Редактирование профиля
            </h1>
            <form>
                <input type="text"     name="name"     placeholder="Имя"               class="form"><br>
                <input type="number"   name="age"      placeholder="Возраст"           class="form"><br>
                <input type="text"     name="school"   placeholder="Учебное заведение" class="form"><br>
                <input type="password" placeholder="Пароль"            class="form"><br>
                <input type="email"    name="email"    placeholder="Электронная почта" class="form"><br>
                <input type="text"     name="phone"    placeholder="Номер телефона"    class="form phone">
                <ul class="menu">
                    <li id="btn_change_password"><a href=#>Сменить пароль</a></li>
                </ul>
                <div class="error"></div><br>
                <input type="submit" value="Сохранить">
            </form>
        </div>
    </div>
</div>

<div id="window_register" class="modal"><!--окно регистрации-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="form_window">
            <h1>
                Регистрация ON TOUR
            </h1>
            <form>
                <input type="hidden" name="method" value="user.register"><br>
                <input type="text" name="name" placeholder="Имя" class="form" required><br>
                <input type="text" name="email" placeholder="Электронная почта" class="form" required><br>
                <input type="text" name="phone" placeholder="Номер телефона" class="form phone" required><br>
                <input type="password" name="password" placeholder="Пароль" class="form" required>
                <input type="button" id="show_password_register" value="&#128065;"><br>
                <div class="error"></div><br>
                <input type="submit" value="Зарегистрироваться">
            </form>
        </div>
    </div>
</div>

<div id="window_change_password" class="modal"><!--окно регистрации-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="form_window">
            <h1>
                Смена пароля
            </h1>
            <form>
                <input type="text" placeholder="Старый пароль" class="form" required name="old_password"><br>
                <input type="text" placeholder="Новый пароль" class="form" required name="new_password"><br>
                <input type="text" placeholder="Повтор пароля" class="form" required name="new_password_repeat"><br>
                <div class="error"></div><br>
                <input type="submit" value="Сменить пароль">
            </form>
        </div>
    </div>
</div>

<div id="window_forgot_password" class="modal"><!--окно регистрации-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="form_window">
            <h1>
                Зайдите на свою дибильную почту и перейдите там по ссылке
            </h1>
        </div>
    </div>
</div>

<script>

    function load_user_info(user_info) {
        if(user_info && 'token' in user_info && user_info.token) {
            $("#menu_register").addClass("hidden");
            $("#menu_login").addClass("hidden");
            $("#menu_logout").removeClass("hidden");
            $("#window_profile form [name='name']").val(data["name"]);
            $("#profile_age").val(data["age"]);
            $("#profile_school").val(data["school"]);
            $("#profile_password").val(data["password"]);
            $("#profile_email").val(data["email"]);
            // проверить длину строки телефона
            ph = "8" + "(" + data["phone"][0] + data["phone"][1] + data["phone"][2] + ")" +
                data["phone"][3] + data["phone"][4] + data["phone"][5] + "-" + data["phone"][6] +
                data["phone"][7] + "-" + data["phone"][8] + data["phone"][9];
            $("#profile_phone").val(ph);

        } else {
            $("#menu_register").removeClass("hidden");
            $("#menu_login").removeClass("hidden");
            $("#menu_logout").addClass("hidden");
        }
    }
    
    $(document).ready(function() {
        exec_ajax_request({method: "user.info"}, function(data)
        {
            data = eval("(" + data + ")");
            if(data.result == "success") {
                load_user_info(data);
            }
        }, null);

        exec_ajax_request({method: "user.logout"}, function(data)
        {
            data = eval("(" + data + ")");
            if(data.result == "success") {
                user_logout(data);
            }
        }, null);

        register_ajax_form("#window_login form", function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                load_user_info(data);
            } else {
                $("#window_login .error").html(data["message"]);
            }
        }, null);

        register_ajax_form("#window_register form", function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                load_user_info(data);
            } else {
                $("#window_register .error").html(data["message"]);
            }
        }, null);
    });

    //ТУТ ФУНКЦИИ, СВЯЗАННЫЕ С ДЕЙСТВИЯМИ В ОКНАХ
/*




    function createProfile(user_info) {
        $("#createProfile_error").html("");
        $("#menu_logout").show();
        $("#menu_profile").show();
        $("#menu_main").show();
        $("#menu_login").hide();
        $("#menu_register").hide();
    }

    function userInfo(data) {
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
    }

    function clearPassword(user_info) {
        $("#old_password").val("");
        $("#new_password").val("");
        $("#new_password_repeat").val("");
    }

    //КОНЕЦ

    $(document).ready(function() {

        //AJAX ЗАПРОСЫ

        $("#change_password_form").submit(function (e) {
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium.ru/?method=user.change_password",
                data: $("#change_password_form").serialize(),
                xhrFields: {withCredentials: true},
                success: function (data) {
                    data = eval("(" + data + ")");
                    if (data.result == "success") {
                        Profile(data);
                    } else {
                        $("#change_password_error").html(data["message"]);
                    }
                }
            });
            e.preventDefault();
        });

        $("#register_form").submit(function (e) {
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium.ru/?method=user.register",
                data: $("#register_form").serialize(),
                xhrFields: {withCredentials: true},
                success: function (data) {
                    data = eval("(" + data + ")");
                    if (data.result == "success") {
                        Register(data);
                    } else {
                        $("#register_error").html(data["message"]);
                    }
                }
            });
            e.preventDefault();
        });

        $("#logout_form").submit(function(e) {
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium.ru/?method=user.logout",
                data: $("#logout_form").serialize(),
                xhrFields: {withCredentials: true},
                success: function(data)
                {
                    data = eval("(" + data + ")");
                    if(data.result == "success") {
                        logOut(data);
                    } else {
                        $("#login_error").html("Неправильный логин или пароль");
                    }
                }
            });
            e.preventDefault();
        });

        $("#login_form").submit(function(e) {
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium.ru/?method=user.login",
                data: $("#login_form").serialize(),
                xhrFields: {withCredentials: true},
                success: function(data)
                {
                    data = eval("(" + data + ")");
                    if(data.result == "success") {
                        logIn(data);
                    } else {
                        $("#login_error").html(data["message"]);
                    }
                }
            });
            e.preventDefault();
        });

        $("#btn_profile").click(function () {
            $("#profile_window").show();
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium.ru/?method=user.info",
                xhrFields: {withCredentials: true},
                success: function (data) {
                    data = eval("(" + data + ")");
                    if (data.result == "success") {
                        userInfo(data);
                    } else {
                        $("#profile_error").html(data["message"]);
                    }
                }
            });
        });

        $("#profile_form").submit(function (e) {
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium.ru/?method=user.profile",
                data: $("#profile_form").serialize(),
                xhrFields: {withCredentials: true},
                success: function (data) {
                    data = eval("(" + data + ")");
                    if (data.result == "success") {
                        Profile(data);
                    } else {
                        $("#profile_error").html(data["message"]);
                    }
                }
            });
            e.preventDefault();
        });

        $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium.ru/?method=user.info",
            xhrFields: {withCredentials: true},
            success: function(data)
            {
                data = eval("(" + data + ")");
                if(data.result == "success") {
                    createProfile(data);
                }
            }
        });

        //КОНЕЦ

        //ОБРАБОТКА ЗАКРЫТИЙ ОКОН ЧЕРЕЗ КРЕСТИК



        //КОНЕЦ

        //ОБРАБОТКА ЗАКРЫТИЙ ОКОН

        //КОНЕЦ

        //МАСКА ДЛЯ ТЕЛЕФОНОВ

        $('#phone_register').mask('8(000)000-00-00');
        $('.phone').mask('8(000)000-00-00');
        $('#profile_phone').mask('8(000)000-00-00');

        //КОНЕЦ

        //ОБРАБОТКА РАЗЛИЧНЫХ КНОПОК

        $("#btn_change_password").click(function () {
            $("#profile_window").hide();
            $("#change_password_window").show();
        });

        $(".btn_register").click(function () {
            $("#login_window").hide();
            $("#register_window").show();
        });

        $("#btn_logout").click(function () {
            $("#logout_window").show();
        });

        $("#btn_logout_none").click(function () {
            $("#logout_window").hide();
        });

        $("#btn_register").click(function () {
            $("#login_window").hide();
            $("#register_window").show();
        });

        $("#btn_login").click(function () {
            $("#login_window").show();
        });

        $("#btn_forgot_password").click(function () {
            $("#forgot_password_window").show();
            $("#login_window").hide();
        });

        $("#show_password_register").click(function () {
            if ($("#password_register").attr("type") == "text")
                $("#password_register").attr("type", "password");
            else
                $("#password_register").attr("type", "text");
        });

        //КОНЕЦ
    });
    */
</script>