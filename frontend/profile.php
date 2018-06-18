<div id="profile_window" class="modal"><!--окно профиля-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="form" align="center">
            <h1>
                Редактирование профиля
            </h1>
            <form id="profile_form">
                <input type="text"     name="name"     placeholder="Имя"               class="form" value=""><br>
                <input type="text"     name="surname"  placeholder="Фамилия"           class="form" value=""><br>
                <input type="number"   name="age"      placeholder="Возраст"           class="form" value=""><br>
                <input type="text"     name="school"   placeholder="Учебное заведение" class="form" value=""><br>
                <input type="password" name="password" placeholder="Пароль"            class="form" value=""><br>
                <input type="email"    name="email"    placeholder="Электронная почта" class="form" value=""><br>
                <input type="text"     name="phone"    placeholder="Номер телефона"    class="form" value="" id="phone_profile">
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
        $('#phone_profile').mask('8(000)000-00-00');
        $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium33.ru/?method=user.info",
            xhrFields: {withCredentials: true},
            success: function (data) {
                data = eval("(" + data + ")");
                if (data.result == "success") {
                    $("#name").attr(value(data["name"]));
                    $("#surname").attr(value(data["surname"]));
                    $("#age").attr(value(data["age"]));
                    $("#school").attr(value(data["school"]));
                    $("#password").attr(value(data["password"]));
                    $("#email").attr(value(data["email"]));
                    $("#phone").attr(value(data["phone"]));
                } else {
                    $("#profile_error").html(data["message"]);
                }
            }
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
                        createProfile(data);
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