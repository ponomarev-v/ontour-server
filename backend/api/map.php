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
            public static function Get(){
                $cx = \Utils::Request('cx');
                $cy = \Utils::Request('cy');
                if ($res = \Objects::Get_obj($cx, $cy))
                    return $res;
            }
        }
    }