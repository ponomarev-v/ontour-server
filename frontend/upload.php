<?php include "header.php";/*подключение головы сайта*/ ?>
<input type="hidden" name="MAX_FILE_SIZE" value="30000">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="filename"><br>
        <input type="submit" value="Загрузить"><br>
    </form>
<script>
$.ajax({
    type: "POST",
    url: "http://api.turneon.ru/?method=user.TestFunc",
    xhrFields: {withCredentials: true},
    success: function (data) {
        data = eval("(" + data + ")");
        if (data.result == "success") {
           alert("success load file");
        } else {
            alert("error load file");
        }
    }
});

</script>
<?php include "footer.php";/*подключение ног сайта*/ ?>