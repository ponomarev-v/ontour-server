<div id="profile_window" class="modal"><!--окно профиля-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                Редактирование профиля
            </h1>
            <form id="profile_form">
                <input type="text" name="name" placeholder="Имя" class="form" id="profile_name"><br>
                <input type="number" name="age" placeholder="Возраст" class="form" id="profile_age"><br>
                <input type="text" name="school" placeholder="Учебное заведение" class="form" id="profile_school"><br>
                <input type="password" name="password" placeholder="Пароль" class="form" id="profile_password"><br>
                <input type="email" name="email" placeholder="Электронная почта" class="form" id="profile_email"><br>
                <input type="text" name="phone" placeholder="Номер телефона" class="form" id="profile_phone">
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

        $('#profile_phone').mask('8(000)000-00-00');

        $("#btn_profile").click(function () {
            $("#profile_window").show();
            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium33.ru/?method=user.info",
                data: $("#profile_form").serialize(),
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

        $("#profile_window").click(function (e) {
            if (e.target == this)
                $("#profile_window").hide();
        });
    });
</script>