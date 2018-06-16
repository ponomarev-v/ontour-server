<?php
    namespace API{
        class Map{
            public static function add(){
                $data = array(
                    'cx' => \Utils::Request('cx'),
                    'cy' => \Utils::Request('cy'),
                    'kind' => \Utils::Request('kind'),
                    'name' => \Utils::Request('name'),
                    'description' => \Utils::Request('description')
                );

            }
        }
    }