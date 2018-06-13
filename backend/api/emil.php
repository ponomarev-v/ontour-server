<?php
namespace API {
    class vg{ 
   
        public function AA() {
            $a = \Utils::Request('a');
            $b = \Utils::Request('b');
            return $a+$b;
        }
    
}
}