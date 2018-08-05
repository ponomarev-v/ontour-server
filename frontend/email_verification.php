<html>
<head>
</head>
<body>
Ваша Почта подтверждена http://api.turneon.ru/?method=user.EmailVerification
<a href="index.php">
    <?php
    // массив для переменных, которые будут переданы с запросом
    $paramsArray = array(
        'id' => $_GET['id'],
        'key' => $_GET['key']
    );
    $myCurl = curl_init();
    curl_setopt_array($myCurl, array(
        CURLOPT_URL => 'http://api.turneon.ru/?method=user.EmailVerification',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $paramsArray)
    ));
    $response = curl_exec($myCurl);
    curl_close($myCurl);

    echo "Ответ на Ваш запрос: ".$response;
    ?>
    <!--<form>-->
        <input type="submit" value="Назад" class="button">
    <!--</form>-->
</a>
</body>
</html>