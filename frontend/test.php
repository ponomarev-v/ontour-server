<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="js/jquery-3.3.1.js"></script>
    <title>Document</title>
</head>
<body>
<p>Начало</p>
<form id="sum">
<input name="a" type="text" id="a">
<input name="b" type="text" id="b">
<input type="submit">
<script type="text/javascript">
    $("#sum").on("submit",function(){
        $(this).serialize();
    });
</script>
<p>Конец</p>
</form>

</body>
</html>