<?php
$dir = dir('/tmp/php_session');

while($item = $dir->read())
    echo $item."<br>";


session_start();
echo session_id();
