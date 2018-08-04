<?php include "header.php";/*подключение головы сайта*/ ?>
<input type="hidden" name="MAX_FILE_SIZE" value="30000">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="filename" accept="image/jpeg,image/png"><br>
        <input type="submit" value="Загрузить"><br>
    </form>


<?php 

if($_FILES){
    $uploaddir = '/www/turneon-server/upload/';
    $uploadfile = $uploaddir . basename($_FILES['filename']['name']);
    if(!is_uploaded_file($_FILES['filename']['tmp_name'])){
        if(move_uploaded_file($_FILES['filename']['tmp_name'],$uploadfile )){
            echo "Успешная загрузка";
        } else {
            echo "Не удалось загрузить файл";
        }
} else {
    echo "Файл уже загружен";
}
   
}
?>

<?php include "footer.php";/*подключение ног сайта*/ ?>