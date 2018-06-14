$(document).ready(function() {
    $('#phone').mask('8(000)000-00-00');
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
                    $("#profile_window").show();
                    $("#profile_window" .phone).html(data [0]);
                } else {
                    $("#change_phone_error").html("Не удалось изменить номер телефона");
                }
            }
        });
        e.preventDefault();
    });

    $("#btn_change_phone").click(function () {
        $("#profile_window").hide();
        $("#change_phone_window").show();
    });
});