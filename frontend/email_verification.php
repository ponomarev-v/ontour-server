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

    ?>
    <!--<form>-->
        <input type="submit" value="Назад" class="button">
    <!--</form>-->
</a>
</body>
</html>