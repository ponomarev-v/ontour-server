<?php
$dir = dir('/');
while($item = $dir->read())
    echo $item."<br>";


session_start();
echo session_id();
