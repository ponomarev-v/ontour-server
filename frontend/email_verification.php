<html>
<head>
</head>
<body>
Ваша Почта подтверждена
<a href="index.php">
    <?php
    // массив для переменных, которые будут переданы с запросом
    $paramsArray = array(
        'id' => $_GET['id'],
        'key' => $_GET['key']
    );
    // преобразуем массив в URL-кодированную строку
    $vars = http_build_query($paramsArray);
    // создаем параметры контекста
    $options = array(
        'http' => array(
            'method'  => 'POST',  // метод передачи данных
            'header'  => 'Content-type: application/x-www-form-urlencoded',  // заголовок
            'content' => $vars,  // переменные
        )
    );
    $context  = stream_context_create($options);  // создаём контекст потока
    $result = file_get_contents('http://api.turneon.ru/?method=user.EmailVerification', false, $context); //отправляем запрос
    var_dump($result); // вывод результата
    ?>
    <!--<form>-->
        <input type="submit" value="Назад" class="button">
    <!--</form>-->
</a>
</body>
</html>