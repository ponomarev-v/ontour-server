<html>
<head>Загрузка  файлов на сервер</head>
<body>
<input type="hidden" name="MAX_FILE_SIZE" value="30000">
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="filename"><br>
        <input type="submit" value="Загрузить"><br>
    </form>
<script>
//print_r($_FILES);
$.ajax({
    type: "POST",
    url: "http://api.turneon.ru/?method=user.TestFunc",
    xhrFields: {withCredentials: true},
    success: function (data) {
        data = eval("(" + data + ")");
        if (data.result == "success") {
           alert("success load file");
        } else {
            alert("error load file");
        }
    }
});

</script>
</body>
</html>