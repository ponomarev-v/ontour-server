<?php
    namespace API{
        class Region{
            //получаем карту
            public static function Get(){
                $reg = \Utils::Request('reg');
                if(isset($reg) && !empty($reg)){
                    return \Regions::GetReg($reg);
                }
                elseif (!isset($reg) || empty($reg)){
                    return \Regions::GetReg();
                }else{
                    throw new \Exception('некорректные данные');
                }
            }
            //обновляем кол-во объектов
            public static function UpdateObjVal(){
                $reg = \Utils::Request('reg');
                if(isset($res) && !empty($res)){
                    return Update_Obj_Val();
                } else {
                    return Update_Obj_Val($reg);
                }
            }
        }
    }