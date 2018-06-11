<?php
$dir = dir('/tmp/php_sess');

while($item = $dir->read())
    echo $item."<br>";


session_start();
echo session_id();
