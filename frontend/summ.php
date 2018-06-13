<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/jquery-3.3.1.js" type="text/javascript"></script>
    <title>Document</title>
</head>
<body>
    <form id="sum">
    <h2>Enter a</h2>
    <input type="text" name="a" id="a">
    <h2>Enter b</h2>
    <input type="text" name="b" i ="b">
    </form>
    <input type="submit" name="send" id="send">
    <script type="text/javascript">
    $("#send").click(function(){
        $.ajax({
            type:"POST",
            url:"http://ontourapi.kvantorium33.ru/?method=vg.aa",
            success: function(data)
            {
                    data = eval("(" + data + ")");
                    if(data.result == "success") {
                        alert($("#a").value);
                }
            }
        });
        
    });
    </script>
</body>
</html>