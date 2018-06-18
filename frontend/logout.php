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
