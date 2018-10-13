<?php

namespace API {
    class Region
    {
        public static function Get()
        {
            $parent = \Utils::Request('parent');
            if($parent == "auto") {
                $reg = "";
            }
            return \Regions::GetReg($parent);
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