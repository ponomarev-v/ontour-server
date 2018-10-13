<?php

class Regions
{

    public static function GetByID($id)
    {
        return Core::DB()
            ->where('id', $id)
            ->getOne('region', array('id', 'parent', 'name', 'geoip'));
    }

    public static function GetByGeoIP($geoip)
    {
        return Core::DB()
            ->where('geoip', $geoip)
            ->getOne('region', array('id', 'parent', 'name', 'geoip'));
    }

    public static function GetChildren($parent)
    {
        return Core::DB()
            ->arrayBuilder()
            ->where('parent', $parent)
            ->get('region', array('id', 'parent', 'name', 'geoip', 'path'));
    }


    public static function Update_Obj_Val($query = 'rf')
    {
        $query .= '%';
        $obj = 'object';
        $res = Core::DB()->rawQuery("SELECT count(*) FROM $obj WHERE 'reg' LIKE '$query'");
        if(isset($res) && !empty($res)) {
            return $res;
        } else {
            throw new Exception('ошибка получения кольчества объектов');
        }
    }

    //будет возращать кол-во обьектов в регионе
    public static function DataObjsInRegion($idobj)
    {
        echo $idobj;
        $db = Core::DB();
        return $db->where('reg', $idobj, 'LIKE')->get('object');
    }

}