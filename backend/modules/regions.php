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
        $res = Utils::FindSmth('object', 'reg', $query);
        if(isset($res) && !empty($res)){
            return count($res);
        } else {
            throw new Exception('ошибка получения кольчества объектов');
        }
    }
    //будет возращать кол-во обьектов в регионе
    public static function DataObjsInRegion($idobj)
    {
        echo $idobj;
        $db  = Core::DB();
        $obj = $db->get('object')->where('reg', $idobj,BETWEEN);
        return $obj;
    }

}