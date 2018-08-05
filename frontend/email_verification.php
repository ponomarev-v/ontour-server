<html>
<head>
</head>
<body>
Ваша Почта подтверждена
<a href="index.php">
    <?php
    // Создаем поток
    $opts = array(
        'http'=>array(
            'method'=>"GET",
            'header'=>"Accept-language: en\r\n" .
                "Cookie: foo=bar\r\n"
        )
    );

    $context = stream_context_create($opts);
    echo $context;
    ?>
    <!--<form>-->
        <input type="submit" value="Назад" class="button">
    <!--</form>-->
</a>
</body>
</html>