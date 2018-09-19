<script>
    var gets = (function () {
        var a = window.location.search;
        var b = new Object();
        a = a.substring(1).split("&");
        for (var i = 0; i < a.length; i++) {
            c = a[i].split("=");
            b[c[0]] = c[1];
        }
        return b;
    })();

    exec_ajax_request({method: "EmailVerification"}, function (data) {
        data = gets['page'];
        if (data.result == "success") {
            load_user_info(data);
        } else {
            //load_user_info(null);
        }
    }, null);
</script>