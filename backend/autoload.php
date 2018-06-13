<?php
function load_class($class_name)
{
    $items = explode('\\', strtolower($class_name));
    foreach(array('lib', 'modules') as $item) {
        $path = implode(DIRECTORY_SEPARATOR, array_merge(array($item), $items)) . '.php';
        echo $path."\n";
        if(file_exists($path)) {
            require_once $path;
            return true;
        }
    }
}

function load_api_class($class_name)
{
    $path = implode(DIRECTORY_SEPARATOR, array('api', $class_name)) . '.php';
    if(file_exists($path)) {
        require_once $path;
        return true;
    }
}

spl_autoload_register('load_class');