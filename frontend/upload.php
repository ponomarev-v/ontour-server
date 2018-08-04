<?php include "header.php";/*подключение головы сайта*/ ?>
<input type="hidden" name="MAX_FILE_SIZE" value="30000">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="filename"><br>
        <input type="submit" value="Загрузить"><br>
    </form>

<script>
function loadFile(){
$.ajax({
    type: "POST",
    url: "http://api.turneon.ru/?method=user.TestFunc&filename=<?php echo $_FILES['filename']['name'] ?>&tmp_name=<?php echo $_FILES['filename']['tmp_name']?>",
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
}
</script>
<?php 

if($_FILES){
    echo $_FILES["filename"]["tmp_name"];
   
}
?>
<script>
loadFile();
</script>

<?php include "footer.php";/*подключение ног сайта*/ ?>