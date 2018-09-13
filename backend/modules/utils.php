<?php

class Utils
{

    public static function generateRandomString()
    {
        $length = 16;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    //утилита БД которая говорит есть такое или нет
    //кароче tabel это таблица obj это столбец find то что мы ищем
    //если нет указаной table ставит user
    public static function FindBd($obj,$find)
    {
       /* if (empty($NeedTable))
        {
            $NowTable = "user";
        }
        else
        {
            $NowTable = $NeedTable;
        } */
        $NeedTable = "user";
        $db = Core::DB();
        $result = $db->where($obj, $find)->get($NeedTable);
        if(!empty($result)) {
            return true;
        }else{
            return false;
        }
        throw new Exception('Непредвиденная ошибка при проверке данных данных.'.(Config::DEBUG ? ' '.$msg : ''));
    }
    //получаем полную дату как люди в массив
    public static function GetNormalTime($time)
    {
        $result['time'] = date("H:i", $time);
        $result['day'] = date("d.m.Y", $time);
        return $result;
    }
    //узнаем ip user вроде не врет
    public static function GetIp()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
        elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
        else $ip = $remote;
        return $ip;
    }
    //ты ему ip а он о том где юзер живет там город и тд
    public static function UserRegion($ip)
    {
        $url ="http://ipgeobase.ru:7020/geo?ip=$ip";
        $xml = simplexml_load_file($url);
        $json = json_encode($xml);
        $arr = json_decode($json,true);
        $result = $arr['ip'];
        return $result;
    }
    //хз шо
    public static function Request($name, $default = null)
    {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }
//хз шо
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
//хз шо
    public static function DefVal($val, $def)
    {
        return empty($val) ? $def : $val;
    }
//хз шо
    public static function FormatArray(&$array, $formatter)
    {
        foreach($array as &$item)
            $item = $formatter($item);
    }
//хз шо
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
//хз шо
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
//дата
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
//хз шо
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
//хз шо
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

    // удаляем лишнее у номера телефона
    public static function FormatPhone($phone)
    {
        // эта говно работает
        $phone = trim($phone);
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if(strlen($phone) == 11 && ($phone[0] == '8' || $phone[0] == '7'))
            $phone = substr($phone, 1);
        if(strlen($phone) != 10)
            $phone = null;
        return $phone;
    }
//смс?
    public static function SendSMS($phone, $message)
    {
        $db = Core::DB();
        $db->insert('sms', array(
            'phone'    => $phone,
            'message'  => $message,
            'date_add' => time(),
        ));
    }
    // загрузка
    public static function UploadPicObjMap()
    {
        $db = Core::DB();
        $uploaddir = '/www/turneon-server/upload/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "Файл корректен и был успешно загружен.\n";
                $typefile =  end(explode("/", $_FILES['userfile']['type']));
                $filenamenew = uniqid('pic-');
                $result = $filenamenew . "." . $typefile;
                rename($uploadfile,  $uploaddir . $result);
            $db->insert('Picturesobjects', array('name' => $filenamenew, 'formatfile'=>$typefile , 'description'=> "test"));
            if($msg = $db->getLastError())
                throw new Exception('Непредвиденная ошибка при сохранении данных.'.(Config::DEBUG ? ' '.$msg : ''));
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }
        echo '<pre>';

        echo 'Некоторая отладочная информация:';
        print_r($_FILES);

        print "</pre>";
    }
    //эта функция осуществляет поиск в базе данных TabName - имя таблицы, ColName - имя столбца, query - запрос (просто первые символы того, что хотим)
    public static function FindSmth($TabName, $ColName, $query){
        $db = Core::DB();
        if (isset($TabName) && !empty($TabName) && isset($ColName) && !empty($ColName) && isset($query) && !empty($query)){
            $query = $query.'%'; 
            $res   = $db -> rawQuery("SELECT * FROM $TabName WHERE $ColName LIKE '$query'");
            return $res;
        } else {
            throw new Exception('некорректно введены данные');
        }        
    }
}