<div id="window_login" class="modal window_with_password"><!--окно логина-->
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
                <input type="button" class="show_password button" value="&#128065;"><br>
                <input type="submit" class="button" value="Войти"><br>
                <a id="btn_forgot_password" class="window_btn" href="#" window-id="window_forgot_password">Забыли пароль?</a>
            </form><br>
                Еще нет аккаунта?&#8195;&#8195;
            <ul class="menu_down">
                <li id="menu_register" class="button"><a href=# class="window_btn" window-id="window_register">Зарегистрироваться</a></li>
            </ul>
            <div class="error"></div>
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
                <input type="submit" value="Да, выйти" class="button">
                <input type="button" value="Нет, остаться" id="btn_logout_none" class="button">
            </form>
            <div class="error"></div>
        </div>
    </div>
</div>

<div id="window_settings" class="modal"><!--окно профиля-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="form_window">
            <h1>
                Редактирование профиля
            </h1>
            <form>
                <input type="hidden" name="method" value="user.profile"><br>
                <input type="text"     name="name"     placeholder="Имя"               class="form"><br>
                <input type="number"   name="age"      placeholder="Возраст"           class="form"><br>
                <input type="text"     name="school"   placeholder="Учебное заведение" class="form"><br>
                <input type="email"    name="email"    placeholder="Электронная почта" class="form"><br>
                <input type="text"     name="phone"    placeholder="Номер телефона"    class="form phone"><br>
                <input type="button" value="Сменить пароль" id="btn_change_password"   class="button window_btn" window-id="window_change_password">
                <input type="submit" class="button" value="Сохранить">
            </form>
            <div class="error"></div>
        </div>
    </div>
</div>

<div id="window_register" class="modal window_with_password"><!--окно регистрации-->
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
                <input type="button" class="show_password button" value="&#128065;"><br>
                <input type="submit" class="button" value="Зарегистрироваться">
            </form>
            <div class="error"></div>
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
                <input type="hidden" name="method" value="user.change_password"><br>
                <input type="text" placeholder="Старый пароль" class="form" required name="old_password"><br>
                <input type="text" placeholder="Новый пароль" class="form" required name="new_password"><br>
                <input type="text" placeholder="Повтор пароля" class="form" required name="new_password_repeat"><br>
                <input type="submit" class="button" value="Сменить пароль">
            </form>
            <div class="error"></div>
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
            $("#menu_profile").removeClass("hidden");
            $("#window_settings form [name='name']").val(user_info["name"]);
            $("#window_settings form [name='age']").val(user_info["age"]);
            $("#window_settings form [name='school']").val(user_info["school"]);
            $("#window_settings form [name='email']").val(user_info["email"]);
            // проверить длину строки телефона
            ph = "8" + "(" + user_info["phone"][0] + user_info["phone"][1] + user_info["phone"][2] + ")" +
                user_info["phone"][3] + user_info["phone"][4] + user_info["phone"][5] + "-" + user_info["phone"][6] +
                user_info["phone"][7] + "-" + user_info["phone"][8] + user_info["phone"][9];
            $("#window_settings form [name='phone']").val(ph);
        } else {
            $("#menu_register").removeClass("hidden");
            $("#menu_login").removeClass("hidden");
            $("#menu_logout").addClass("hidden");
            $("#menu_profile").addClass("hidden");
        }
    }
    
    function update_user_info() {
        exec_ajax_request({method: "user.info"}, function(data)
        {
            data = eval("(" + data + ")");
            if(data.result == "success") {
                load_user_info(data);
            } else {
                load_user_info(null);
            }
        }, null);
    }

    function change_user_info() {
        exec_ajax_request({method: "user.profile"}, function(data)
        {
            data = eval("(" + data + ")");
            if(data.result == "success") {
                load_user_info(data);
            } else {
                //load_user_info(null);
            }
        }, null);
    }

    function change_password_user_info() {
        exec_ajax_request({method: "user.change_password"}, function(data)
        {
            data = eval("(" + data + ")");
            if(data.result == "success") {
                close_active_window();
            } else {
                $("#window_password .error").html(data["message"]);
            }
        }, null);
    }
    
    $(document).ready(function() {
        update_user_info();

        register_ajax_form("#window_login form", function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                close_active_window();
                load_user_info(data);
            } else {
                $("#window_login .error").html(data["message"]);
            }
        }, null);

        register_ajax_form("#window_settings form", function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                close_active_window();
                change_user_info(data);
            } else {
                $("#window_settings .error").html(data["message"]);
            }
        }, null);

        register_ajax_form("#window_logout form", function (data) {
            close_active_window();
            update_user_info();
            $("#menu_profile").addClass("hidden");
        }, null);

        register_ajax_form("#window_register form", function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                load_user_info(data);
                close_active_window();
            } else {
                $("#window_register .error").html(data["message"]);
            }
        }, null);

        register_ajax_form("#window_change_password form", function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                change_password_user_info(data);
            } else {
                $("#window_change_password .error").html(data["message"]);
            }
        }, null);


        $(".show_password").click(function () {
            if ($("form [name='password']").attr("type") == "text")
                $("form [name='password']").attr("type", "password");
            else
                $("form [name='password']").attr("type", "text");
        });

        $("#btn_logout_none").click(function () {
            close_active_window();
        });
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