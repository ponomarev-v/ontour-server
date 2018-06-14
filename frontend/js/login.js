function createProfile(user_info) {
    $("#menu_login").hide();
    $("#menu_register").hide();
    $("#menu_logout").show();
    $("#menu_profile").show();
    $("#menu_main").show();
}

$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "http://ontourapi.kvantorium33.ru/?method=user.info",
        xhrFields: {withCredentials: true},

        success: function(data)
        {
            data = eval("(" + data + ")");
            if(data.result == "success") {
                createProfile(data);
            }
        }
    });

    $("#btn_logout").click(function () {
        $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium33.ru/?method=user.logout",
            xhrFields: {withCredentials: true},
            success: function(data)
            {
                data = eval("(" + data + ")");
                if(data.result == "success") {
                    $("#menu_logout").hide();
                    $("#menu_profile").hide();
                    $("#menu_register").show();
                    $("#menu_login").show();
                    $("#menu_main").hide();
                }
            }
        });
    });

    $("#btn_login").click(function () {
        $("#login_window").show();
    });

    $("#login_window .close").click(function () {
        $("#login_window").hide();
    });

    $("#login_window").click(function (e) {
        if(e.target == this)
            $("#login_window").hide();
    });

    $("#login_form").submit(function(e) {
        $.ajax({
            type: "POST",
            url: "http://ontourapi.kvantorium33.ru/?method=user.login",
            data: $("#login_form").serialize(),
            xhrFields: {withCredentials: true},
            success: function(data)
            {
                data = eval("(" + data + ")");
                if(data.result == "success") {
                    $("#login_error").html("");
                    $("#login_window").hide();
                    $("#menu_main").show();
                    createProfile(data);
                } else {
                    $("#login_error").html("Неправильный логин или пароль");
                }
            }
        });
        e.preventDefault();
    });

    $("#btn_profile").click(function () {
        $("#profile_window").show();
    });

    $("#btn_register").click(function () {
        $("#login_window").hide();
        $("#register_window").show();

    });
});