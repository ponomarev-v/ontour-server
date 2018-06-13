<?php
    namespace API{
        class ARA{
            public function func()
            {
                $b = $_REQUEST['b'];
                $a = $_REQUEST['a'];
                return ($a + $b);
            }
        }
}