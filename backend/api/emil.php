<?php
namespace API {
    
    class bg
    {
        public function bg() {
            $a = \Utils::Request('a');
            $b = \Utils::Request('b');
            return $a+$b;
        }
        }
    }






        