<?php
define("ROOT_PATH", __DIR__);

require_once(ROOT_PATH . '/config.php');

function load_class($class_name)
{
    $items = explode('\\', strtolower($class_name));
    foreach(array('lib', 'modules') as $item) {
        $path = implode(DIRECTORY_SEPARATOR, array_merge(array(ROOT_PATH, $item), $items)) . '.php';
        if(file_exists($path)) {
            require_once $path;
            return true;
        }
    }
}

function load_api_class($class_name)
{
    $path = implode(DIRECTORY_SEPARATOR, array(ROOT_PATH, 'api', $class_name)) . '.php';
    if(file_exists($path)) {
        require_once $path;
        return true;
    }
}

spl_autoload_register('load_class');