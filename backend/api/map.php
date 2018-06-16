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
                if($id = \Objects::Add_obj($data)) {
                    return true;
                }
            }
            public static function Get(){

            }
        }
    }