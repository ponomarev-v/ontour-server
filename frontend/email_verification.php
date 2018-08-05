<html>
<head>
</head>
<body>
Ваша Почта подтверждена
<a href="index.php">
    <?php
    // Создаем поток
    if(isset($_GET['blog'])) {
        echo $_GET['blog'];
    }

    $context = stream_context_create($opts);
    echo $context;
    ?>
    <!--<form>-->
        <input type="submit" value="Назад" class="button">
    <!--</form>-->
</a>
</body>
</html>