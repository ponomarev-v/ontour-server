<?php
//время по мск вкл кажись на все последущие влияет
date_default_timezone_set("Europe/Moscow");

require_once(__DIR__ . '/autoload.php');

if(isset($_SERVER['HTTP_ORIGIN'])) {
    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Allow-Credentials: true');
}

try {
    $token = \Utils::Request('token');
    if($token) {
        session_id($token);
    }
    if(!is_dir('/tmp/php_session'))
        mkdir('/tmp/php_session');
    session_start();
    $method = Utils::Request('method');
    $method = explode('.', $method);
    if(sizeof($method) == 2) {
        $class_name = 'API\\' . $method[0];
        if(load_api_class($method[0]) && class_exists($class_name)) {
            $instance = new $class_name;
            $method = $method[1];
            if($method != "ScreenObj"){
            if(method_exists($instance, $method)) {
                $res = $instance->$method();
                
                if(!is_array($res)) {
                        $res = array('data' => $res);
                }
                $keys = array_keys($res);
                if(sizeof($keys) > 0 && $keys[0] == 0 && $keys[sizeof($keys) - 1] == sizeof($keys) - 1)
                    $res = array('count' => sizeof($res), 'items' => $res);
                $res = array_merge(array('result' => 'success'), $res);
            } else {
                
                throw new Exception('Unknown method');
            }
        } else {
            if(method_exists($instance, $method)) {
                $res = $instance->$method();
                
                if(!is_array($res)) {
                        $res = array('data' => $res);
                }
            }
        }
        } else {
            throw new Exception('Unknown class');
        }
    } else {
        throw new Exception('Invalid method');
    }

} catch(Exception $e) {
    $res = array(

        'result'  => 'error',
        'message' => $e->getMessage(),
    );
    if(Config::DEBUG) {
        $res['dbquery'] = Core::DB()->getLastQuery();
        $res['dberror'] = Core::DB()->getLastError();
    }
}
if (isset($res)){
    echo json_encode($res);
}

