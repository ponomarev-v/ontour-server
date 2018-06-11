<?php

class Utils
{
    public static function Request($name, $default = null)
    {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }

    public static function GetArg($name, $default = null)
    {
        global $argv;
        if(isset($argv) && is_array($argv)) {
            $prev_arg = "";
            $_argv = $argv;
            $_argv[] = 1;
            foreach($_argv as $arg) {
                if($prev_arg == '-' . $name)
                    return $arg;
                $prev_arg = $arg;
            }
        }
        return $default;
    }

    public static function DefVal($val, $def)
    {
        return empty($val) ? $def : $val;
    }

    public static function FormatArray(&$array, $formatter)
    {
        foreach($array as &$item)
            $item = $formatter($item);
    }

    public static function ArrayGet($names, &$array, $default = null, $check_empty = false, $delimeter = '.')
    {
        if(is_array($array)) {
            if(!is_array($names)) {
                $path = explode($delimeter, $names);
                $p = &$array;

                foreach($path as $v) {
                    if(!isset($p[$v])) {
                        return $default;
                    }
                    $p = &$p[$v];
                }

                if($check_empty)
                    if(!empty($p)) return $p;
                    else
                        return $p;
                return $p;
            } else {
                foreach($names as $name) {
                    $res = null;
                    if(self::doArrayGet($name, $array, $res, $check_empty, $delimeter))
                        return $res;
                }
            }
        }
        return $default;
    }

    private static function doArrayGet($name, &$array, &$result, $check_empty, $delimeter)
    {
        $path = explode($delimeter, $name);
        $p = &$array;
        $sz = sizeof($path);
        $result = null;
        for($i = 0; $i < $sz; $i++) {
            if(isset($p[$path[$i]])) {
                $p = &$p[$path[$i]];
                if($i == $sz - 1) {
                    if($check_empty) {
                        if(!empty($p)) {
                            $result = $p;
                            return true;
                        }
                    } else {
                        $result = $p;
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public static function DecodeDate($date)
    {
        if(intval($date) > 0 && date('Y', intval($date)) >= 2000) {
            return intval($date);
        } else {
            if($d = date_parse($date)) {
                if($d['error_count'] == 0 && $d['year'] > 0)
                    return mktime($d['hour'], $d['minute'], $d['second'], $d['month'], $d['day'], $d['year']);
            }
        }
        return null;
    }

    public static function ForceDirectories($dirName)
    {
        if(strlen($dirName) > 0 && !is_dir($dirName)) {
            $info = pathinfo($dirName);
            if(!is_dir($info["dirname"])) self::ForceDirectories($info["dirname"]);
            if(is_dir($info["dirname"])) {
                mkdir($dirName, 0777);
                chmod($dirName, 0777);
            }
        }
    }

    public static function CreateGUID($namespace = '', $format = true)
    {
        $uid = uniqid("", true);
        $data = $namespace . getmypid();
        if(array_key_exists('REQUEST_TIME', $_SERVER)) $data .= $_SERVER['REQUEST_TIME'];
        if(array_key_exists('HTTP_USER_AGENT', $_SERVER)) $data .= $_SERVER['HTTP_USER_AGENT'];
        if(array_key_exists('LOCAL_ADDR', $_SERVER)) $data .= $_SERVER['LOCAL_ADDR'];
        if(array_key_exists('LOCAL_PORT', $_SERVER)) $data .= $_SERVER['LOCAL_PORT'];
        if(array_key_exists('REMOTE_ADDR', $_SERVER)) $data .= $_SERVER['REMOTE_ADDR'];
        if(array_key_exists('REMOTE_PORT', $_SERVER)) $data .= $_SERVER['REMOTE_PORT'];
        if(array_key_exists('HOSTNAME', $_SERVER)) $data .= $_SERVER['HOSTNAME'];
        $hash = strtoupper(hash('ripemd128', $uid . md5($data)));
        if($format) {
            return '{' .
                substr($hash, 0, 8) .
                '-' .
                substr($hash, 8, 4) .
                '-' .
                substr($hash, 12, 4) .
                '-' .
                substr($hash, 16, 4) .
                '-' .
                substr($hash, 20, 12) .
                '}';
        } else {
            return $hash;
        }
    }
}