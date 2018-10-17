<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>turneon</title>
    <script src="/js/jquery-3.3.1.js"></script><!--скрипт jquery-->
    <script src="/getSVG.js"></script><!--скрипт app-->
</head>
<body>
<div id="window_settings" class="modal"><!--окно профиля-->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="form_window">
            <form>
                <input type="text" name="parent" placeholder="Имя" class="form">
                <input type="hidden" name="method" value="region.get">
                <input type="submit" value="Сохранить" class="button">
            </form>
        </div>
    </div>
</div>
<script>
    var api_url = "http://api.turneon.ru";

    function exec_ajax_request(data, handler, error) {
        $.ajax({
            type: "GET",
            url: api_url,
            data: data,
            xhrFields: {withCredentials: true},
            success: handler,
            error: error
        });
    }

    function register_ajax_form(id, handler, error) {
        $(id).submit(function (e) {
            exec_ajax_request($(this).serialize(), handler, error);
            e.preventDefault();
        });
    }

    register_ajax_form("#window_settings form", function (data) {
        data = eval("(" + data + ")");
        if (data.result == "success") {
            AttrSet((data.items).0).path, "path");
        }
    }, null);

    AttrSet = function (element, attr) {
        if (attr.href) {
            element.setAttributeNS(SVG.xlink, 'href', attr.href);
            delete attr.href;
        }
        for (var i in attr) {
            element.setAttribute(i, attr[i]);
        }
    }
</script>
</body>
</html>