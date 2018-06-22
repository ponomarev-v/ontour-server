<?php
    namespace API{
        class Map{
            public static function Add(){
                $data = array(
                    'cx' => \Utils::Request('cx'),
                    'cy' => \Utils::Request('cy'),
                    'kind' => \Utils::Request('kind'),
                    'name' => \Utils::Request('name'),
                    'description' => \Utils::Request('description')
                );
                if($id = \Objects::Add_obj($data, $_SESSION['userid'])) {
                    return true;
                }
            }
            public static function Details(){
                $cx   = \Utils::Request('cx');
                $cy   = \Utils::Request('cy');
                $name = \Utils::Request('name');
                return \Objects::Get_obj($cx, $cy, $name );
            }
        }
    }