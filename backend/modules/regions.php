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
    private static function CombinateRegs($ParReg){
        if (isset($ParReg) && !empty($ParReg)){
            
        }
    }
    public static function Update_Obj_Val($reg = 'RF'){
        $db  = Core::DB();
        $res = $db -> where('reg', $reg) -> get('object');
        if(isset($res) && !empty($res)){
            return count($res);
        } else {
            throw new Exception('ошибка получения кольчества объектов');
        }
    }
}