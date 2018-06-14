$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "http://ontourapi.kvantorium33.ru/?method=user.info",
        xhrFields: {withCredentials: true},
        success: function (data) {
            data = eval("(" + data + ")");
            if (data.result == "success") {
                createProfile(data);
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
                    $("#profile_error").html("Неправильный логин или пароль");
                }
            }
        });
        e.preventDefault();
    });

    $("#profile_window").click(function (e) {
        if (e.target == this)
            $("#profile_window").hide();
    });

    $("#btn_change_email").click(function () {
        $("#btn_change_email").show();
        $("#profile_window").hide();
    });

    $("#btn_change_password").click(function () {
        $("#btn_change_password").show();
        $("#profile_window").hide();
    });

    $("#btn_change_phone").click(function () {
        $("#btn_change_phone").show();
        $("#profile_window").hide();
    });

    $("#btn_change_login").click(function () {
        $("#btn_change_login").show();
        $("#profile_window").hide();
    });
});