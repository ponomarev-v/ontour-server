<?php

namespace API {
    class Region
    {
        public static function Get()
        {
            $root = self::GetInfo();
            if(empty($root)) {
                $root = array(
                    'id'     => '',
                    'parent' => '',
                    'name'   => 'World',
                    'geoip'  => '',
                );
            }
            $root['items'] = \Regions::GetChildren($root['id']);
            if(!empty($root['parent'])) {
                $root['parentInfo'] = \Regions::GetByID($root['parent']);
            } else {
                $root['parentInfo'] = null;
            }
            return $root;
        }

        public static function GetInfo()
        {
            $id = \Utils::Request('id');
            if($id == "auto") {
                if($geoip = $_SERVER['GEOIP_COUNTRY_CODE'] . '-' . $_SERVER['GEOIP_REGION'])
                    return \Regions::GetByGeoIP($geoip);
            } else {
                return \Regions::GetByID($id);
            }
        }

        //обновляем кол-во объектов
        public static function UpdateObjVal()
        {
            $reg = \Utils::Request('reg');
            if(!isset($reg) || empty($reg)) {
                return \Regions::Update_Obj_Val();
            } else {
                return \Regions::Update_Obj_Val($reg);
            }
        }
    }
}