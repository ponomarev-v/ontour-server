<?php
class Regions{

    public static function GetReg($reg = 'RF'){
        $db  = Core::DB();
        $res = $db -> where('reg', $reg) -> get('region');
        if (isset($res) && !empty($res)){
            return $res;
        } else {
            throw new Exception('ошибка получения данных из бд');
        }
    }
    
    public static function Update_Obj_Val($query = 'RF'){
        $res = FindSmth('object', 'reg', $query)
        if(isset($res) && !empty($res)){
            return count($res);
        } else {
            throw new Exception('ошибка получения кольчества объектов');
        }
    }
}