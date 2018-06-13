<?php
    namespace API{
        class AB{
            public function func()
            {
                $b = $_REQUEST['b'];
                $a = $_REQUEST['a'];
                return ($a + $b);
            }
        }
}