<?php
define("ROOT_PATH", __DIR__);
require_once(ROOT_PATH.'/config.php');

spl_autoload_register(function ($class_name) {
    $items = explode('\\', strtolower($class_name));
    foreach(array('lib', 'modules') as $item) {
        $path = implode(DIRECTORY_SEPARATOR, array_merge(array($item), $items)).'.php';
        if(file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

echo Utils::Request('aaa');
