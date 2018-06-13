<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form id="sum">
    <h2>Enter a</h2>
    <input type="text" name="a">
    <h2>Enter b</h2>
    <input type="text" name="b">
    </form>

    <script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            type:"POST",
            url:"http://ontourapi.kvantorium33.ru/?method=vg.aa",
            success: function(data)
            {
                data = eval("(" + data + ")");
                if(data.result == "success") {
                   document.write("True")
                }
            }
        });
    });
    </script>
</body>
</html>