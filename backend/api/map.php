<?php
    namespace API{
        class Map{
            public static function Add(){
                $data = array(
                    'cx'          => \Utils::Request('cx'),
                    'cy'          => \Utils::Request('cy'),
                    'kind'        => \Utils::Request('kind'),
                    'name'        => \Utils::Request('name'),
                    'description' => \Utils::Request('description'),
                    'obl'         => \Utils::Request('obl')
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

            public static function GetObjs(){
                return \Objects::GetAllObj();
            }

            public static function Delete(){

                $cx   = \Utils::Request('cx');
                $cy   = \Utils::Request('cy');
                $del = \Utils::Request('delete');
                if ($del == 1)
                    return \Objects::Delete_obj($cx, $cy);

            }
            public static function Find_Target(){
                $str = \Utils::Request('find');
                return \Objects::Find_obj($str);
            }

        }
    }