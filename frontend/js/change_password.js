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
    $("#change_password_window .close").click(function () {
        $("#change_password_window").hide();
    });
    $("#change_password_window").click(function (e) {
        if (e.target == this)
            $("#change_password_window").hide();
    });
    $("#change_password_form").submit(function (e) {
        $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium33.ru/?method=user.change_password",
            data: $("#change_password_form").serialize(),
            xhrFields: {withCredentials: true},
            success: function (data) {
                data = eval("(" + data + ")");
                if (data.result == "success") {
                    $("#change_password_error").html("");
                    $("#change_password_window").hide();
                    $("#profile_window").show();
                    $("#profile_window" .password).html(data [2]);
                } else {
                    $("#change_password_error").html("Не удалось изменить пароль");
                }
            }
        });
        e.preventDefault();
    });

    $("#btn_change_password").click(function () {
        $("#profile_window").hide();
        $("#change_password_window").show();
    });
});