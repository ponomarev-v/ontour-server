<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>turneon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--хрен знает что-->
    <link rel="stylesheet" href="css/style.css"><!--общие стили-->
    <link rel="stylesheet" href="css/menu.css"><!--стили меню-->
    <link rel="stylesheet" href="css/window.css"><!--стили всплывающих окон-->
    <link rel="stylesheet" href="css/bootstrap-grid.min.css"><!--сетка адаптивной верстки-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><!--кодировка-->
    <script src="js/jquery-3.3.1.js"></script><!--скрипт jquery-->
    <script src="js/jquery.mask.js"></script><!--скрипт jquery.mask-->
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script><!--скрипт яндекс.карт-->
</head>
<body>
<div class="header">
    <div class="header_up">
        <?php include "menu_up.php"; ?><!--подключение меню-->
    </div>
    <div class="header_down">
        <a href="district_map.php" class="logo">
            <img src="images/logo.png" height=100%><!--логотип-->
        </a>
        <?php include "menu_down.php"; ?><!--подключение меню-->
    </div>
</div>
