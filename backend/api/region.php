<?php

namespace API {
    class Region
    {
        public static function Get()
        {
            $id = \Utils::Request('id');
            $root = null;
            if($id == "auto") {
                if($geoip = $_SERVER['GEOIP_COUNTRY_CODE'] . '-' . $_SERVER['GEOIP_REGION'])
                    $root = \Regions::GetByGeoIP($geoip);
            } else {
                $root = \Regions::GetByID($id);
            }
            if(empty($root)) {
                $root = array(
                    'id'     => '',
                    'parent' => '',
                    'name'   => 'World',
                    'geoip'  => '',
                );
            }

            $root['items'] = \Regions::GetChildren($root['id']);
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