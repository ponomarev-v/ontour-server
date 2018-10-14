var active_window = null;
var registered_windows = new Array();
var api_url = "http://api.turneon.ru";

function close_active_window() {
    if(active_window)
        $(active_window).hide();
    active_window = null;
}

function close_active_window_h(e) {
    if (e.target == this)
        close_active_window();
}

function show_window(id) {
    if(active_window != id) {
        close_active_window();
        if(registered_windows.indexOf(id) < 0) {
            $(id).click(close_active_window_h);
            registered_windows.push(id);
        }
        active_window = id;
        if ($("form [name='password']").attr("type") == "text")
            $("form [name='password']").attr("type", "password");
        $(id).show();
    }
}

function register_ajax_form(id, handler, error) {
    $(id).submit(function (e) {
        exec_ajax_request($(this).serialize(), handler, error);
        e.preventDefault();
    });
}

function exec_ajax_request(data, handler, error) {
    $.ajax({
        type: "POST",
        url: api_url,
        data: data,
        xhrFields: {withCredentials: true},
        success: handler,
        error: error
    });
}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

$(document).ready(function() {
    $(".close").click(close_active_window);
    $('.phone').mask('8(000)000-00-00');
    $(".window_btn").click(function () {
        win = $(this).attr('window-id');
        if(win) {
            show_window("#"+win);
        }
    });
});
