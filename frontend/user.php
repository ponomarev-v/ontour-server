<div id="window_login" class="modal window_with_password"><!--окно логина-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="form_window">
            <h1>
                Вход ON TOUR
            </h1>
            <form>
                <input type="hidden" name="method" value="user.login">
                <input type="text"     name="login"    placeholder="телефон или mail" class="form">
                <input type="password" name="password" placeholder="Пароль"           class="form">
                <input type="button" class="show_password button" value="&#128065;">
                <input type="submit" class="button" value="Войти">
            </form>
            <a id="btn_forgot_password" class="window_btn button" href="#" window-id="window_forgot_password">Забыли пароль?</a><br><br>
            Еще нет аккаунта?&#8195;&#8195;<a id="btn_register" class="window_btn button" href="#" window-id="window_register">Зарегистрироваться</a>
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
                <input type="hidden" name="method" value="user.logout">
                <input type="submit" value="Да, выйти" class="button">
                <input type="button" value="Нет, остаться" class="button" id="btn_logout_none">
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
                <input type="hidden" name="method" value="user.profile">
                <input type="number" name="age"    placeholder="Возраст"           class="form">
                <input type="text"   name="school" placeholder="Учебное заведение" class="form">
                <input type="email"  name="email"  placeholder="Электронная почта" class="form">
                <input type="text"   name="phone"  placeholder="Номер телефона"    class="form phone">
                <input type="button" value="Сменить пароль" id="btn_change_password" class="button window_btn" window-id="window_change_password">
                <input type="submit" value="Сохранить" class="button">
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
                <input type="hidden" name="method" value="user.register">
                <input type="text"     name="name"     placeholder="Имя"               class="form">
                <input type="text"     name="email"    placeholder="Электронная почта" class="form">
                <input type="text"     name="phone"    placeholder="Номер телефона"    class="form phone">
                <input type="password" name="password" placeholder="Пароль"            class="form">
                <input type="button" class="show_password button" value="&#128065;">
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
                <input type="hidden" name="method"  value="user.change_password">
                <input type="text" class="form" placeholder="Старый пароль" name="old_password">
                <input type="text" class="form" placeholder="Новый пароль"  name="new_password">
                <input type="text" class="form" placeholder="Повтор пароля" name="new_password_repeat">
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
                Будет доработано
            </h1>
        </div>
    </div>
</div>

<script>
    function load_user_info(user_info) {
        if (user_info && 'token' in user_info && user_info.token) {
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
        exec_ajax_request({method: "user.info"}, function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                load_user_info(data);
            } else {
                load_user_info(null);
            }
        }, null);
    }

    function change_user_info() {
        exec_ajax_request({method: "user.profile"}, function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                load_user_info(data);
            } else {
                //load_user_info(null);
            }
        }, null);
    }

    function change_password_user_info() {
        exec_ajax_request({method: "user.change_password"}, function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                close_active_window();
            } else {
                $("#window_password .error").html(data["message"]);
            }
        }, null);
    }

    $(document).ready(function () {
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

        $("#btn_change_password").click(function () {
            update_user_info();
        });

        $("#window_settings .close").click(function () {
            update_user_info();
        });

        $("input.form").attr("autocomplete", "off");
        $("input.form").attr("spellcheck", "false");
        $("#window_login input.form").attr("required", "true");
        $("#window_logout input.form").attr("required", "true");
        $("#window_register input.form").attr("required", "true");
        $("#window_change_password input.form").attr("required", "true");
    });
</script>