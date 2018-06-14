<div id="register_window" class="modal"><!--окно регистрации-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                 Регистрация ON TOUR
            </h1>
            <form id="register_form">
                Имя:<br>
                <input type="text" class="name"><br>
                Фамилия:<br>
                <input type="text" class="surname"><br>
                Отчество:<br>
                <input type="text" class="patronymic"><br>
                Пол:<br>
                Мужской
                <input type="radio" checked="checked" name="a" class="sex_man" onchange="t01();">
                <input type="radio" name="a" class="sex_woman" onchange="t02();">
                Женский<br>
                Возраст:<br>
                <input type="number" class="age"><br>
                Школа:<br>
                <input type="number" class="school"><br>
                Пароль:<br>
                <input type="password" class="password"><br>
                Почта:<br>
                <input type="email" class="email"><br>
                Номер телефона:<br>
                <input type="text" class="phone">
                <p>
                    <input type="submit" value="Зарегистрироваться">
                </p>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.phone').mask('8(000)000-00-00');
        $(".btn_register").click(function () {
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
                        $("#register_error").html("оишбка");
                    }
                }
            });
            e.preventDefault();
        });
    });
</script>