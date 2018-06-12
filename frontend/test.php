<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>dsds</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="/js/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>
<div id="res"></div>
<form id="login_form">
    <input type="hidden" name="method" value="user.login">
    <input type="text" name="login">
    <input type="password" name="password">
    <input type="submit">
</form>
<script>
    $( document ).ready(function() {

        $("#login_form").submit(function(e) {

            $.ajax({
                type: "POST",
                url: "http://ontourapi.kvantorium33.ru",
                data: $("#login_form").serialize(),
                success: function(data)
                {
                    alert(data);
                }
            });
            e.preventDefault();
        });
    });
</script>
</body>
</html>