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
                <input type="button" value="Забыли пароль" id="btn_forgot_password">
                <input type="submit" value="Войти">
                </p>
            </form>
        </div>
    </div>
</div>

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
                <input type="password" placeholder="Пароль"            class="form" id="profile_password"><br>
                <input type="email"    name="email"    placeholder="Электронная почта" class="form" id="profile_email"><br>
                <input type="text"     name="phone"    placeholder="Номер телефона"    class="form" id="profile_phone">
                <ul class="menu">
                    <li id="btn_change_password"><a href=#>Сменить пароль</a></li>
                </ul>
                <p>
                <div id="profile_error"></div><br>
                <input type="submit" value="Сохранить">
                </p>
            </form>
        </div>
    </div>
</div>

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

<div id="change_password_window" class="modal"><!--окно регистрации-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                Смена пароля
            </h1>
            <form id="change_password_form">
                <input type="text" placeholder="Старый пароль" class="form" required id="old_password" name="old_password"><br>
                <input type="text" placeholder="Новый пароль" class="form" required id="new_password" name="new_password"><br>
                <input type="text" placeholder="Повтор пароля" class="form" required id="new_password_repeat"><br>
                <p>
                <div id="change_password_error"></div>
                <br>
                <input type="submit" value="Сменить пароль">
                </p>
            </form>
        </div>
    </div>
</div>

<div id="forgot_password_window" class="modal"><!--окно регистрации-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                Зайдите на свою дибильную почту и перейдите там по ссылке
            </h1>
        </div>
    </div>
</div>

<script>

    //ТУТ ФУНКЦИИ, СВЯЗАННЫЕ С ДЕЙСТВИЯМИ В ОКНАХ

    function logOut(user_info) {
        $("#logout_error").html("");
        $("#menu_login").show();
        $("#menu_register").show();
        $("#menu_logout").hide();
        $("#menu_profile").hide();
        $("#menu_main").hide();
        $("#logout_window").hide();
    }

    function logIn(user_info) {
        $("#login_error").html("");
        $("#menu_main").show();
        $("#menu_logout").show();
        $("#menu_profile").show();
        $("#menu_register").hide();
        $("#menu_login").hide();
        $("#login_window").hide();
    }

    function Profile(user_info) {
        $("#profile_error").html("");
        $("#profile_window").hide();
        $("#menu_main").show();
    }

    function Register(user_info) {
        $("#register_error").html("");
        $("#menu_main").show();
        $("#menu_logout").show();
        $("#menu_profile").show();
        $("#menu_register").hide();
        $("#menu_login").hide();
        $("#register_window").hide();
    }

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
                url: "http://api.turneon.ru/?method=user.change_password",
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
                url: "http://api.turneon.ru/?method=user.register",
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
                url: "http://api.turneon.ru/?method=user.logout",
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
                url: "http://api.turneon.ru/?method=user.login",
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
                url: "http://api.turneon.ru/?method=user.info",
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
                url: "http://api.turneon.ru/?method=user.profile",
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
            url: "http://api.turneon.ru/?method=user.info",
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

        $("#change_password_window .close").click(function () {
            $("#change_password_window").hide();
        });

        $("#register_window .close").click(function () {
            $("#register_window").hide();
        });

        $("#logout_window .close").click(function () {
            $("#logout_window").hide();
        });

        $("#login_window .close").click(function () {
            $("#login_window").hide();
        });

        $("#profile_window .close").click(function () {
            $("#profile_window").hide();
        });

        $("#forgot_password_window .close").click(function () {
            $("#forgot_password_window").hide();
        });

        //КОНЕЦ

        //ОБРАБОТКА ЗАКРЫТИЙ ОКОН

        $("#register_window").click(function (e) {
            if (e.target == this)
                $("#register_window").hide();
        });

        $("#forgot_password_window").click(function (e) {
            if (e.target == this)
                $("#forgot_password_window").hide();
        });

        $("#change_password_window").click(function (e) {
            if (e.target == this)
                $("#change_password_window").hide();
        });

        $("#profile_window").click(function (e) {
            if (e.target == this)
                $("#profile_window").hide();
        });

        $("#logout_window").click(function (e) {
            if(e.target == this)
                $("#logout_window").hide();
        });

        $("#login_window").click(function (e) {
            if(e.target == this)
                $("#login_window").hide();
        });

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
</script>