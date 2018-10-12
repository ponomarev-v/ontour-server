<?php
    namespace API{
        class Map{
            //добавление обьекта
            public static function Add(){
                $data = array(
                    'cx'          => \Utils::Request('cx'),
                    'cy'          => \Utils::Request('cy'),
                    'kind'        => \Utils::Request('kind'),
                    'name'        => \Utils::Request('name'),
                    'description' => \Utils::Request('description'),
                    'reg'         => \Utils::Request('reg')
                );
                if($id = \Objects::Add_obj($data, $_SESSION['userid']))
                    return true;
            }
            //дичь какая-то хз зачем ну надо
            public static function Details(){
                $cx   = \Utils::Request('cx');
                $cy   = \Utils::Request('cy');
                $name = \Utils::Request('name');
                return \Objects::Get_obj($cx, $cy, $name );
            }
            //все обьекты из БД
            public static function GetObjs(){
                return \Objects::GetAllObj();
            }
            //не работает
            public static function Get(){
                $zoom = \Utils::Request('zoom');
                $cx   = \Utils::Request('cx');
                $cy   = \Utils::Request('cy');
                return \Objects::Get();
            }
            //удаление обьекта
            public static function Delete(){
                $cx   = \Utils::Request('cx');
                $cy   = \Utils::Request('cy');
                $del = \Utils::Request('delete');
                if ($del == 1)
                    return \Objects::Delete_obj($cx, $cy);
            }
            //поиск обьекта
            public static function FindTarget(){
                $str = \Utils::Request('find');
                return \Objects::Find_obj($str);
            }
            public static function AddtoFav(){
                $act = \Utils::Request('act');
                $objid = \Utils::Request('objid');
                $id = $_SESSION['userid'];
                return \Objects::Add_to_Fav($act, $objid, $id);
            }
            
        }
    }