$(document).ready(function() {
    $('#phone').mask('8(000)000-00-00');
    $("#btn_register").click(function () {
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
                    createProfile(data);
                } else {
                    $("#register_error").html("Ничего не вышло =(");
                }
            }
        });
        e.preventDefault();
    });
});