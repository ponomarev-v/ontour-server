<?php
class Regions{

    public static function GetReg($parent){
        $db  = Core::DB();
        $db->where('parent', $parent);
        $res =  $db->get('region');
        return $res;
    }
    
    public static function Update_Obj_Val($query = 'rf'){
        $query.='%';
        $obj = 'object';
        $res = Core::DB() -> rawQuery("SELECT count(*) FROM $obj WHERE 'reg' LIKE '$query'");
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