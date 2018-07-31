<html>
<head>
    <title>Загрузка файлов на сервер</title>
</head>
<body>

<?php
if ( ! $_FILES )
{
    echo '
		  <h2>Форма для загрузки файлов</h2>
		  <form action="" method="post" enctype="multipart/form-data">
		  <input type="file" name="filename"><br>
		  <input type="submit" value="Загрузить"><br>
		  </form>
	';
}
else
{
    // Проверяем загружен ли файл
    if(  is_uploaded_file($_FILES["filename"]["tmp_name"])  )
    {
        // Если файл загружен успешно, перемещаем его
        // из временной директории в конечную
        move_uploaded_file
        (
            $_FILES["filename"]["tmp_name"],
            __DIR__  .  '/www/'  .  $_FILES["filename"]["name"]
        );
    } else {
        echo("Ошибка загрузки файла");
    }
}
?>

</body>
</html>