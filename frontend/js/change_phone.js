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
    $("#change_phone_window .close").click(function () {
        $("#change_phone_window").hide();
    });
    $("#change_phone_window").click(function (e) {
        if (e.target == this)
            $("#change_phone_window").hide();
    });
    $("#change_phone_form").submit(function (e) {
        $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium33.ru/?method=user.change_phone",
            data: $("#change_phone_form").serialize(),
            xhrFields: {withCredentials: true},
            success: function (data) {
                data = eval("(" + data + ")");
                if (data.result == "success") {
                    $("#change_phone_error").html("");
                    $("#change_phone_window").hide();
                    $("#menu_main").show();
                    createchange_phone(data);
                } else {
                    $("#change_phone_error").html("Неправильный логин или пароль");
                }
            }
        });
        e.preventDefault();
    });

    $("#btn_change_phone").click(function () {
        $("#profile_window").hide();
        $("#change_phone_window").show();
    });

    $("#submit_new_phone").click(function () {
        $("#profile_window").show();
        $("#change_phone_window").hide();
    });
});