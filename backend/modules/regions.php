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
        $res = Core::DB() -> rawQuery("SELECT count(*) FROM 'object' WHERE 'reg' LIKE '$query'");
        if(isset($res) && !empty($res)){
            return $res;
        } else {
            throw new Exception('ошибка получения кольчества объектов');
        }
    }
    //будет возращать кол-во обьектов в регионе
    public static function DataObjsInRegion($idobj)
    {
        echo $idobj;
        $db  = Core::DB();
        return $db ->where('reg', $idobj,'LIKE')->get('object');
    }

}