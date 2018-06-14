$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "http://ontourapi.kvantorium33.ru/?method=user.info",
        xhrFields: {withCredentials: true},
        success: function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
            }
        }
    });
    $("#change_login_window .close").click(function () {
        $("#change_login_window").hide();
    });
    $("#change_login_window").click(function (e) {
        if (e.target == this)
            $("#change_login_window").hide();
    });
    $("#change_login_form").submit(function (e) {
        $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium33.ru/?method=user.change_login",
            data: $("#change_login_form").serialize(),
            xhrFields: {withCredentials: true},
            success: function (data) {
                data = eval("(" + data + ")");
                if (data.result == "success") {
                    $("#change_login_error").html("");
                    $("#change_login_window").hide();
                    $("#menu_main").show();
                    createchange_login(data);
                } else {
                    $("#change_login_error").html("Неправильный логин или пароль");
                }
            }
        });
        e.preventDefault();
    });

    $("#btn_change_login").click(function () {
        $("#profile_window").hide();
        $("#change_login_window").show();
    });
});