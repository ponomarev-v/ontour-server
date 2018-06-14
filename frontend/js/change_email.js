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
    $("#change_email_window .close").click(function () {
        $("#change_email_window").hide();
    });
    $("#change_email_window").click(function (e) {
        if (e.target == this)
            $("#change_email_window").hide();
    });
    $("#change_email_form").submit(function (e) {
        $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium33.ru/?method=user.change_email",
            data: $("#change_email_form").serialize(),
            xhrFields: {withCredentials: true},
            success: function (data) {
                data = eval("(" + data + ")");
                if (data.result == "success") {
                    $("#change_email_error").html("");
                    $("#change_email_window").hide();
                    $("#menu_main").show();
                    createchange_email(data);
                } else {
                    $("#change_email_error").html("Неправильный логин или пароль");
                }
            }
        });
        e.preventDefault();
    });

    $("#btn_change_email").click(function () {
        $("#profile_window").hide();
        $("#change_email_window").show();
    });

    $("#submit_new_email").click(function () {
        $("#profile_window").show();
        $("#change_email_window").hide();
    });
});