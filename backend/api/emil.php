<?php
namespace API{
    class Sum{
       
        public function sum(){
            $a = \Utils::Request('a');
            $b = \Utils::Request('b');
            return $this->a+$this->b;
        }
    }
}
?>