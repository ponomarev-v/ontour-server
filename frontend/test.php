<html xmlns="http://www.w3.org/1999/html">
<head>Загрузка  файлов на сервер</head>
<body>
<div id="TestFunc">
    <form enctype="multipart/form-data" action="" method="post">
        <input type="hidden" name="method" value="TestFunc">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000">
        <input type="file" name="uploadFile">
        <input type="submit" name="upload" value="Загрузить">
    </form>
    <div class="error"></div>
</div>
<script>
    register_ajax_form("#TestFunc form", function (data) {
        data = eval("(" + data + ")");
        if (data.result == "success") {
            alert("success");
        } else {
            $("#TestFunc .error").html(data["message"]);
        }
    }, null);
</script>
</body>
</html>
