<html>
<head>
    <title>Загрузка файлов на сервер</title>
</head>
<body>

<!-- Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так -->
<form action="upload.php" method="post" enctype="multipart/form-data">
    Send these files:<br>
    <input name="userfile[]" type="file"><br>
    <input name="userfile[]" type="file"><br>
    <input type="submit" value="Отправить файлы ">
</form>

</body>
</html>